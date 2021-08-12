<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProductsImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'supermarket_id' => auth()->user()->supermarket->id,
            'product' => $row['product'],
            'quantity' => $row['quantity'],
            'price' => $row['price'],
            'description' => $row['description'],
            'expires_at' => date('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($row['expiry_date'])),
        ]);
    }

}
