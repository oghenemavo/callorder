<?php

namespace App\Library;

use Illuminate\Support\Facades\Facade;

class PaystackFacade extends Facade
{
    protected static function getFacadeAccessor() { 
        return 'paystack'; 
    }
}