<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Cartalyst\Stripe\Stripe;

class MoneySetupController extends Controller
{
    public function paymentStripe(){
        return view('payment.paymentstripe');
    }
    public function postpaymentStripe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            //'amount' => 'required',
        ]);
      
        $input = $request->all();

        if ($validator->fails()) {
            return redirect()->route('paymentStripe')
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $input = Arr::except($input,array('password'));//array_except($input,array('_token'));
           
            try {
                $stripe = new Stripe();
                $stripe->setApiKey(env('STRIPE_SECRET'));
               
            //    $token = $stripe->tokens()->create([
            //         'card' => [
            //             'number' =>  $request->get('card_no'), 
            //             'exp_month' => $request->get('ccExpiryMonth'),
            //             'exp_year' => $request->get('ccExpiryYear'),
            //             'cvc' => $request->get('cvvNumber'),
            //         ],
            //     ]);
                
                // $charge = $stripe->charges()->create([
                //     //'card' => 'tok_visa', //$token['id'], 
                //     'amount' => 2000, 
                //     'currency' => 'inr',
                //     'card' => 'tok_in',
                //     'description' => 'Test Charge',
                // ]);

                //$token = $_POST['stripeToken'];

                // $charge = $stripe->charges()->create([
                // 'amount' => 999,
                // 'currency' => 'usd',
                // 'description' => 'Testing charge',
                // 'source' => $token['id'],
                // ]);
    

                // if ($charge['status'] == 'succeeded') {
                //     //echo "<pre>";print_r($charge);exit();
                //     return redirect()->route('paymentStripe')->with('status','Payment succeeded...');
                // } else {
                //    // echo "<pre>";print_r($charge);exit();
                //     Session::put('error', 'Money not add in the wallet!!');
                //     return redirect()->route('paymentStripe');
                // }
                
                echo "<pre>";
                $stripe = new \Stripe\StripeClient('sk_test_51OPdkJSAgPslsKeucJizC02L5UgbVAzP3XwOo2u7pw6LccD3jwefKWEXVpIi44aNVajyTmy0vOzZsjB52WC0B2r700WzgtsByO');
                print_r($stripe->products->all(['limit' => 3]));
                exit();
            //     $paymentIntents = $stripe->paymentIntents()->create([
            //         'amount' => 100,
            //         'currency' => 'inr',
            //         'payment_method' => 'pm_card_in',
            //         'description' => 'Test Payment Intents',
            //       ]);

            //    $confirm = $stripe->paymentIntents()->confirm(
            //     $paymentIntents['id'],
            //         [
            //         'payment_method' => 'pm_card_in',
            //         ]
            //     );
        
            //     if ($confirm['status'] == 'succeeded') {
            //         //echo "<pre>";print_r($charge);exit();
            //         return redirect()->route('paymentStripe');
            //     } else if ($confirm->status == 'requires_source_action' && $confirm->next_action->type == 'use_stripe_sdk'){
            //         // Session::put('success', 'Payment succeeded..');
            //         return redirect()->route('paymentStripe');
            //     } else {
            //        // echo "<pre>";print_r($charge);exit();
            //         Session::put('error', 'Money not add in the wallet!!');
            //         return redirect()->route('paymentStripe');
            //     }
                
            } catch (\Exception $e) {
                //dd($e->getMessage());
                Session::put('error', $e->getMessage());
                return redirect()->route('paymentStripe')->with('status','Payment Not Approved');
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                Session::put('error',$e->getMessage());
                return redirect()->route('paymentStripe');
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                Session::put('error',$e->getMessage());
                return redirect()->route('paymentStripe');
            }
        }
    }


}
