<?php

namespace App\Http\Controllers;

use App\Library\PaystackFacade;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function purchase($slug)
    {
        $data['page_title'] = 'Call Order - Purchase';
        $data['order'] = Order::where('slug', $slug)->firstOrFail();
        $items = json_decode($data['order']->items);
        $data['sum'] = array_sum(array_map(fn($i) => $i->price * $i->quantity, $items)) ?? 0.00;
        return view('customer.purchase', $data);
    }

    public function payment(Request $request)
    {
        $data = $request->all();
        $data['reference'] = strtoupper(bin2hex(openssl_random_pseudo_bytes(10)));
        Transaction::create($data);

        $result = PaystackFacade::initiate($data);

        if ($result->status) {
            return redirect()->to($result->data->authorization_url);
        }
        return back()->with('error', 'Unable to Make Payment');
    }

    public function verifyTransaction(Request $request)
    {
        $reference = $request->reference;
        $transaction = Transaction::where('reference', $reference)->firstOrFail();
        $result = PaystackFacade::verify($transaction->reference);
        if ($result->status && strtolower($result->data->status) == 'success' ) {
            $transaction->status = '1';
            $transaction->save();

            $order = Order::find($transaction->order_id);
            $order->is_confirmed = '1';
            $order->save();

            session()->flash('success', 'Payment Successful!');
        } else{
            session()->flash('info', 'Payment Not Verified contact admin!');
        }
        return redirect()->route('transaction.status');
    }

    public function transactionStatus(Request $request)
    {
        if (session()->has('success')) {
            $data['key'] = 'success';
            $data['status'] = session()->get('success');
        } elseif (session()->has('info')) {
            $data['key'] = 'info';
            $data['status'] = session()->get('info');
        }
        
        if (isset($data['key'])) {
            $data['page_title'] = 'Transaction Status';
            return view('customer.success', $data);
        }
    }

    public function createOrder(Request $request)
    {   
        $cart = $request->session()->get('cart_item');

        $total = array_sum(array_map(fn($cart_item) => ($cart_item['quantity'] * $cart_item['price']), $cart));

        $data = $request->all();
        $data['slug'] = $request->phone_number . '_' . bin2hex(random_bytes(20));
        $data['items'] = json_encode(array_values($cart));
        $data['total'] = $total;

        $request->session()->forget('cart_item');
        $result = Order::create($data);

        if ($result) {
            return redirect()->route('purchase.items', $result->slug);
        }
        return back()->with('error', 'Unable to create order');
    }
}
