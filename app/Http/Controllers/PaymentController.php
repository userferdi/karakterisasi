<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }

    public function bill()
    {
        return view('payment.bill');
    }

    public function receipt()
    {
        return view('payment.receipt');
    }

    public function history()
    {
        return view('payment.history');
    }
}
