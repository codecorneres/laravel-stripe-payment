@extends('layout.master')

@section('title','Stripe Payment Form')

    @section('content')

        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <div class="container">
            <div class='row'>
                <div class='col-md-4'></div>
                <div class='col-md-4'>
                    <form class="form-horizontal" method="POST" id="payment-form" role="form"
                        action="{!!route('paymentStripe')!!}">
                        @csrf
                        <div class='form-row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label>
                                <input autocomplete='off' class='form-control card-number' size='20' type='text'
                                    name="card_no">
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-xs-4 form-group cvc required'>
                                <label class='control-label'>CVV</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text' name="cvvNumber">
                            </div>
                            <div class='col-xs-4 form-group expiration required'>
                                <label class='control-label'>Expiration</label>
                                <input class='form-control card-expiry-month' placeholder='MM' size='4' type='text'
                                    name="ccExpiryMonth">
                            </div>
                            <div class='col-xs-4 form-group expiration required'>
                                <label class='control-label'>Month & Year</label>
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'
                                    name="ccExpiryYear">
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='hidden'
                                    name="amount" value="300">
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-md-12' style="margin-left:-10px;">
                                <div class='form-control total btn btn-primary'>
                                    Total:
                                    <span class='amount'>$100</span>
                                </div>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-md-12 form-group'>
                                <button class='form-control btn btn-success submit-button' type='submit'>Pay »</button>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>
                                    Please correct the errors and try again.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class='col-md-4'></div>
            </div>
        </div>
    @endsection

