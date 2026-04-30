<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        try {
            $payments = Payment::with('student')->get();
            return view('payments.index', compact('payments'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading payments: ' . $e->getMessage());
        }
    }

    public function processPayment(Request $request)
    {
        try {
            $request->validate([
                'student_id' => 'required|numeric',
                'amount' => 'required|numeric|min:0.01',
                'payment_method' => 'required|string'
            ]);

            $transactionId = 'TXN-' . Str::upper(Str::random(10));

            Payment::create([
                'student_id' => $request->student_id,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'transaction_id' => $transactionId,
                'status' => 'Completed'
            ]);

            return back()->with('success', 'Payment processed successfully. Transaction ID: ' . $transactionId);
        } catch (\Exception $e) {
            return back()->with('error', 'Error processing payment: ' . $e->getMessage());
        }
    }
}