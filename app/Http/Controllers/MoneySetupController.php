<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Stripe\Stripe;
use Stripe\Charge;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Input;
use App\User;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
use Cartalyst\Stripe\Api\Charges;


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
        //if ($validator->passes()) {
               
      //  }
        if ($validator->fails()) {
            return redirect()->route('paymentStripe')
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $input = Arr::except($input,array('password'));//array_except($input,array('_token'));
            //print_r($input);
           
            try {
                $stripe = new Stripe();
                $stripe->setApiKey(env('STRIPE_SECRET'));
               // $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));
               // dd($request->get('card_no').','.$request->get('ccExpiryMonth').','.$request->get('ccExpiryYear').','. $request->get('cvvNumber'));
               
               // $token = $stripe->tokens()->create([
                //     'card' => [
                //         'number' =>  $request->get('card_no'), 
                //         'exp_month' => $request->get('ccExpiryMonth'),
                //         'exp_year' => $request->get('ccExpiryYear'),
                //         'cvc' => $request->get('cvvNumber'),
                //     ],
                // ]);
                
                //dd($token.'----34');
               
                //$token = 'tok_visa';
            
                // $charge = $stripe->charges()->create([
                //     'card' => $token, //$token['id'], 
                //     'currency' => 'usd',
                //     'amount' => 2049,
                //      'source' => 'tok_visa',
                //     'description' => 'Test charge',
                // ]);
                

                $charge = $stripe->paymentIntents()->create([
                    'amount' => 500,
                    'currency' => 'usd',
                    'payment_method' => 'pm_card_visa',
                    'description' => 'Test charge',
                  ]);
                // Log or handle the response
               // dd($charge);
               $confirm = $stripe->paymentIntents()->confirm(
                $charge['id'],
                [
                  'payment_method' => 'pm_card_visa',
                ]
              );

                //if ($confirm['status'] == 'requires_confirmation') {
                if ($confirm['status'] == 'succeeded') {
                    //echo "<pre>";print_r($charge);exit();
                //     return redirect()->route('paymentStripe')->with('status','Payment Requires confirmation...');
                // } else if($charge['status'] == 'succeeded'){
                    return redirect()->route('paymentStripe')->with('status','Payment succeeded...');
                } else {
                    Session::put('error', 'Money not add in the wallet!!');
                    return redirect()->route('paymentStripe');
                }
                
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
