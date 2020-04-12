<?php

namespace App\Http\Controllers;

use App\MostajerFactor;
use Illuminate\Http\Request;
use Shetabit\Payment\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Invoice;
use Shetabit\Payment\Facade\Payment;

class ZarinpalController extends Controller
{
    public function sendRequest(Request $request, $factor_id) {
        $mostajer_factor = MostajerFactor::find($factor_id);
        if (!$mostajer_factor) {
            return response()->json([
                "message" => "همچین فاکتوری پیدا نشد"
            ], 404);
        }
//        dd($mostajer_factor);
        return Payment::callbackUrl(env('APP_URL') . '/pardakht/factor/done/' . $mostajer_factor->id)->purchase(
            (new Invoice)->amount((int)$mostajer_factor->amount),
            function($driver, $transactionId) {
                // store transactionId in database.
                // we need the transactionId to verify payment in future
            })->pay();
    }

    public function done(Request $request, $factor_id) {
        $mostajer_factor = MostajerFactor::find($factor_id);

        if (!$mostajer_factor) {
            return response()->json([
                "message" => "همچین فاکتوری پیدا نشد"
            ], 404);
        }
//        dd($request->all());
        try {
            $receipt = Payment::amount((int)$mostajer_factor->amount)->transactionId($request->Authority)->verify();

            // you can show payment's referenceId to user
            echo $receipt->getReferenceId();

        } catch (InvalidPaymentException $exception) {
            /**
            when payment is not verified , it throw an exception.
            we can catch the excetion to handle invalid payments.
            getMessage method, returns a suitable message that can be used in user interface.
             **/
            echo $exception->getMessage();
        }
//        dd($request->all(), $mostajer_factor);
    }
}
