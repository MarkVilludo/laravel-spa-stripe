<style>
    .StripeElement {
        background-color: white;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>

<form action="{{ route('subscribe.post') }}" method="POST" id="subscribe-form">
    <div class="form-group">
        <div class="row">
            @foreach($plans as $plan)
            <div class="col-md-4">
                <div class="subscription-option">
                    <input type="radio" id="plan-silver" name="plan" value='{{$plan->id}}'>
                    <label for="plan-silver">
                        <span class="plan-price">{{$plan->currency}}{{$plan->amount/100}}<small> /{{$plan->interval}}</small></span>
                        <span class="plan-name">{{$plan->product->name}}</span>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <input id="card-holder-name" type="text"><label for="card-holder-name">Card Holder Name</label>
    @csrf
    <div class="form-row">
        <label for="card-element">Credit or debit card</label>
        <div id="card-element" class="form-control">
        </div>
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>
    <div class="stripe-errors"></div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
    </div>
    @endif
    <div class="form-group text-center">
        <button  id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-lg btn-success btn-block">SUBMIT</button>
    </div>
</form>