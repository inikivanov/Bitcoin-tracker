<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribePost;
use App\Models\Subscription;

class SubscribeNotificationController extends Controller
{

    /**
     * Set Subscriptions
     */
    public function __invoke(StoreSubscribePost $request)
    {
        $response = Subscription::create([
            'email' => $request->email,
            'amount' => $request->amount
        ]);

        return response()->json([
            'data' => $response,
            'status' => 'success',
            'message' => 'Set Notifications success!'
        ], 200);
    }
}
