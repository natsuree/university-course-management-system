Route::post('/payment/webhook', function(Request $request) {
    Log::info('Payment Webhook Received:', $request->all());

    return response()->json([
        'message' => 'Webhook received successfully'
    ]);
});