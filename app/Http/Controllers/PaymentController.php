<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_SECRET_KEY'));
        $this->gateway->setTestMode(env('PAYPAL_TESTMODE', true));
    }

    public function pay(Request $request)
    {
        try {
            $response = $this->gateway->purchase([
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY', 'USD'),
                'returnUrl' => route('payment.success', ['order_id' => $request->order_id]),
                'cancelUrl' => route('payment.cancel')
            ])->send();
            if($response->isRedirect()) {
                session('order_id', $request->order_id);
                $response->redirect();
            }else {
                return $response->getMessage();
            }
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function success(Request $request) {
        
        if($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase([
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ]);
            $response = $transaction->send();
            if($response->isSuccessful()) {
                $tnxData = $response->getData();
                $data['date'] = Carbon::now();
                $data['amount'] = $tnxData['transactions'][0]['amount']['total'];
                $data['payment_id'] = $tnxData['id'];
                $data['payer_id'] = $tnxData['payer']['payer_info']['payer_id'];
                $data['payer_email'] = $tnxData['payer']['payer_info']['email'];
                $data['currency'] = env('PAYPAL_CURRENCY', 'USD');
                $data['payment_status'] = $tnxData['payer']['status'];
                $data['order_id'] = $request->order_id;
                Payment::create($data);
                return redirect()->route('dashboard.orders.index')->with('message', 'Payment successfull!');
            }
        }else {
            return redirect()->route('dashboard.index')->with('info', 'Payment declined!');
        }
    }

    public function cancel(Request $request) {
        return redirect()->route('dashboard.index')->with('info', 'Payment declined!');
    }

    public function payment(Order $order)
    {
        return view('clients.payment', compact('order'));
    }
}
