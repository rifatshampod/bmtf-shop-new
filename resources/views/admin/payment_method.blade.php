@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Payment Methods')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Payment Methods')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
            </div>
          </div>

        <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-3">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">


                                        <!--<li class="nav-item border rounded mb-1">-->
                                        <!--    <a class="nav-link active" id="paypal-tab" data-toggle="tab" href="#paypalTab" role="tab" aria-controls="paypalTab" aria-selected="true">{{__('admin.Paypal')}}</a>-->
                                        <!--</li>-->

                                        <!--<li class="nav-item border rounded mb-1">-->
                                        <!--    <a class="nav-link" id="stripe-tab" data-toggle="tab" href="#stripeTab" role="tab" aria-controls="stripeTab" aria-selected="true">{{__('admin.Stripe')}}</a>-->
                                        <!--</li>-->

                                        <!--<li class="nav-item border rounded mb-1">-->
                                        <!--    <a class="nav-link" id="razorpay-tab" data-toggle="tab" href="#razorpayTab" role="tab" aria-controls="razorpayTab" aria-selected="true">{{__('admin.Razorpay')}}</a>-->
                                        <!--</li>-->

                                        <!--<li class="nav-item border rounded mb-1">-->
                                        <!--    <a class="nav-link" id="flutterwave-tab" data-toggle="tab" href="#flutterwaveTab" role="tab" aria-controls="flutterwaveTab" aria-selected="true">{{__('admin.Flutterwave')}}</a>-->
                                        <!--</li>-->



                                        <!--<li class="nav-item border rounded mb-1">-->
                                        <!--    <a class="nav-link" id="mollie-tab" data-toggle="tab" href="#mollieTab" role="tab" aria-controls="mollieTab" aria-selected="true">{{__('admin.Mollie')}}</a>-->
                                        <!--</li>-->

                                        <!--<li class="nav-item border rounded mb-1">-->
                                        <!--    <a class="nav-link" id="pay-stack-tab" data-toggle="tab" href="#payStackTab" role="tab" aria-controls="payStackTab" aria-selected="true">{{__('admin.PayStack')}}</a>-->
                                        <!--</li>-->

                                        <!--<li class="nav-item border rounded mb-1">-->
                                        <!--    <a class="nav-link" id="instamojo-tab" data-toggle="tab" href="#instamojoTab" role="tab" aria-controls="instamojoTab" aria-selected="true">{{__('admin.Instamojo')}}</a>-->
                                        <!--</li>-->

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link active" id="sslcommerz-tab" data-toggle="tab" href="#sslcommerzTab" role="tab" aria-controls="sslcommerzTab" aria-selected="true">{{__('admin.SslCommerz')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="bank-account-tab" data-toggle="tab" href="#bankAccountTab" role="tab" aria-controls="bankAccountTab" aria-selected="true">{{__('admin.Bank Account')}}</a>
                                        </li>
                                        @if ($bank)
                                            <li class="nav-item border rounded mb-1">
                                                <a class="nav-link" id="cash-tab" data-toggle="tab" href="#cashTab" role="tab" aria-controls="cashTab" aria-selected="true">{{__('admin.Cash On Deliver')}}</a>
                                            </li>
                                        @endif


                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-9">
                                    <div class="border rounded">
                                        <div class="tab-content no-padding" id="settingsContent">

                                            <div class="tab-pane fade" id="paypalTab" role="tabpanel" aria-labelledby="paypal-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-paypal') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Paypal Status')}}</label>
                                                                <div>
                                                                    @if ($paypal->status == 1)
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @else
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Account Mode')}}</label>
                                                                <select name="account_mode" id="account_mode" class="form-control">
                                                                    <option {{ $paypal->account_mode == 'live' ? 'selected' : '' }} value="live">{{__('admin.Live')}}</option>
                                                                    <option {{ $paypal->account_mode == 'sandbox' ? 'selected' : '' }} value="sandbox">{{__('admin.Sandbox')}}</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Country Name')}}</label>
                                                                <select name="country_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Country')}}
                                                                  </option>
                                                                  @foreach ($countires as $country)
                                                                  <option {{ $paypal->country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{ __('admin.Currency Name')}}</label>
                                                                <select name="currency_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Currency')}}
                                                                  </option>
                                                                  @foreach ($currencies as $currency)
                                                                  <option {{ $paypal->currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency rate')}} ( {{__('admin.Per')}} {{ $setting->currency_name }})</label>
                                                                <input type="text" class="form-control" name="currency_rate" value="{{ $paypal->currency_rate }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Paypal Client Id')}}</label>
                                                                <input type="text" class="form-control" name="paypal_client_id" value="{{ $paypal->client_id }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Paypal Secret Key')}}</label>
                                                                <input type="text" class="form-control" name="paypal_secret_key" value="{{ $paypal->secret_id }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="stripeTab" role="tabpanel" aria-labelledby="stripe-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-stripe') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Stripe Status')}}</label>
                                                                <div>
                                                                    @if ($stripe->status == 1)
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @else
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Country Name')}}</label>
                                                                <select name="country_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Country')}}
                                                                  </option>
                                                                  @foreach ($countires as $country)
                                                                  <option {{ $stripe->country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency Name')}}</label>
                                                                <select name="currency_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Currency')}}
                                                                  </option>
                                                                  @foreach ($currencies as $currency)
                                                                  <option {{ $stripe->currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency rate')}} ( {{__('admin.per')}} {{ $setting->currency_name }})</label>
                                                                <input type="text" class="form-control" name="currency_rate" value="{{ $stripe->currency_rate }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Stripe Key')}}</label>
                                                                <input type="text" class="form-control" name="stripe_key" value="{{ $stripe->stripe_key }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Stripe Secret')}}</label>
                                                                <input type="text" class="form-control" name="stripe_secret" value="{{ $stripe->stripe_secret }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="razorpayTab" role="tabpanel" aria-labelledby="razorpay-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-razorpay') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Razorpay Status')}}</label>
                                                                <div>
                                                                    @if ($razorpay->status == 1)
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @else
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Razorpay Key')}}</label>
                                                                <input type="text" class="form-control" name="razorpay_key" value="{{ $razorpay->key }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Razorpay Secret Key')}}</label>
                                                                <input type="text" class="form-control" name="razorpay_secret" value="{{ $razorpay->secret_key }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Name')}}</label>
                                                                <input type="text" class="form-control" name="name" value="{{ $razorpay->name }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Description')}}</label>
                                                                <input type="text" class="form-control" name="description" value="{{ $razorpay->description }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Country Name')}}</label>
                                                                <select name="country_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Country')}}
                                                                  </option>
                                                                  @foreach ($countires as $country)
                                                                  <option {{ $razorpay->country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency Name')}}</label>
                                                                <select name="currency_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Currency')}}
                                                                  </option>
                                                                  @foreach ($currencies as $currency)
                                                                  <option {{ $razorpay->currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency Rate')}} ({{__('admin.per')}} {{ $setting->currency_name }})</label>
                                                                <input type="text" class="form-control" name="currency_rate" value="{{ $razorpay->currency_rate }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Current Image')}}</label>
                                                                <div>
                                                                    <img src="{{ asset($razorpay->image) }}" width="200px" alt="">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.New Image')}}</label>
                                                                <input type="file" class="form-control-file" name="image">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Theme Color')}}</label>
                                                                <input type="color" value="{{ $razorpay->color }}" class="form-control" name="theme_color">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="flutterwaveTab" role="tabpanel" aria-labelledby="flutterwave-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-flutterwave') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Flutterwave Status')}}</label>
                                                                <div>
                                                                    @if ($flutterwave->status == 1)
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @else
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Public Key')}}</label>
                                                                <input type="text" class="form-control" name="public_key" value="{{ $flutterwave->public_key }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Secret Key')}}</label>
                                                                <input type="text" class="form-control" name="secret_key" value="{{ $flutterwave->secret_key }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Title')}}</label>
                                                                <input type="text" class="form-control" name="title" value="{{ $flutterwave->title }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Country Name')}}</label>
                                                                <select name="country_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Country')}}
                                                                  </option>
                                                                  @foreach ($countires as $country)
                                                                  <option {{ $flutterwave->country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency Name')}}</label>
                                                                <select name="currency_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Currency')}}
                                                                  </option>
                                                                  @foreach ($currencies as $currency)
                                                                  <option {{ $flutterwave->currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency Rate')}} ({{__('admin.Per')}} {{ $setting->currency_name }})</label>
                                                                <input type="text" class="form-control" name="currency_rate" value="{{ $flutterwave->currency_rate }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Current Image')}}</label>
                                                                <div>
                                                                    <img src="{{ asset($flutterwave->logo) }}" width="200px" alt="">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.New Image')}}</label>
                                                                <input type="file" class="form-control-file" name="image">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="mollieTab" role="tabpanel" aria-labelledby="mollie-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-mollie') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Mollie Status')}}</label>
                                                                <div>
                                                                    @if ($paystackAndMollie->mollie_status == 1)
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @else
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Mollie Key')}}</label>
                                                                <input type="text" class="form-control" name="mollie_key" value="{{ $paystackAndMollie->mollie_key }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Country Name')}}</label>
                                                                <select name="mollie_country_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Country')}}
                                                                  </option>
                                                                  @foreach ($countires as $country)
                                                                  <option {{ $paystackAndMollie->mollie_country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency Name')}}</label>
                                                                <select name="mollie_currency_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Currency')}}
                                                                  </option>
                                                                  @foreach ($currencies as $currency)
                                                                  <option {{ $paystackAndMollie->mollie_currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency Rate')}} ({{__('admin.per')}} {{ $setting->currency_name }})</label>
                                                                <input type="text" class="form-control" name="mollie_currency_rate" value="{{ $paystackAndMollie->mollie_currency_rate }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="payStackTab" role="tabpanel" aria-labelledby="pay-stack-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-paystack') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.PayStack Status')}}</label>
                                                                <div>
                                                                    @if ($paystackAndMollie->paystack_status == 1)
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @else
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Public Key')}}</label>
                                                                <input type="text" name="paystack_public_key" class="form-control" value="{{ $paystackAndMollie->paystack_public_key }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Secret Key')}}</label>
                                                                <input type="text" name="paystack_secret_key" class="form-control" value="{{ $paystackAndMollie->paystack_secret_key }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Country Name')}}</label>
                                                                <select name="paystack_country_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Country')}}
                                                                  </option>
                                                                  @foreach ($countires as $country)
                                                                  <option {{ $paystackAndMollie->paystack_country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency Name')}}</label>
                                                                <select name="paystack_currency_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Currency')}}
                                                                  </option>
                                                                  @foreach ($currencies as $currency)
                                                                  <option {{ $paystackAndMollie->paystack_currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency Rate')}} ({{__('admin.per')}} {{ $setting->currency_name }})</label>
                                                                <input type="text" class="form-control" name="paystack_currency_rate" value="{{ $paystackAndMollie->paystack_currency_rate }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="instamojoTab" role="tabpanel" aria-labelledby="instamojo-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-instamojo') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Instamojo Status')}}</label>
                                                                <div>
                                                                    @if ($instamojo->status == 1)
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @else
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Account Mode')}}</label>
                                                                <select name="account_mode" id="account_mode" class="form-control">
                                                                    <option value="Sandbox">{{__('admin.Sandbox')}}</option>
                                                                    <option value="Live">{{__('admin.Live')}}</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Api Key')}}</label>
                                                                <input type="text" name="api_key" class="form-control" value="{{ $instamojo->api_key }}">
                                                            </div>



                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Auth Token')}}</label>
                                                                <input type="text" name="auth_token" class="form-control" value="{{ $instamojo->auth_token }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.INR Currency Rate')}} ({{__('admin.per')}} {{ $setting->currency_name }})</label>
                                                                <input type="text" class="form-control" name="currency_rate" value="{{ $instamojo->currency_rate }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade show active" id="sslcommerzTab" role="tabpanel" aria-labelledby="sslcommerz-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-sslcommerz') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.SslCommerz Status')}}</label>
                                                                <div>
                                                                    @if ($sslcommerz->status == 1)
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @else
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Account Mode')}}</label>
                                                                <select name="account_mode" id="account_mode" class="form-control">
                                                                    <option {{ $sslcommerz->mode == 'live' ? 'selected' : '' }} value="live">{{__('admin.Live')}}</option>
                                                                    <option {{ $sslcommerz->mode == 'sandbox' ? 'selected' : '' }} value="sandbox">{{__('admin.Sandbox')}}</option>
                                                                </select>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Store Id')}}</label>
                                                                <input type="text" class="form-control" name="store_id" value="{{ $sslcommerz->store_id }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Store Password')}}</label>
                                                                <input type="text" class="form-control" name="store_password" value="{{ $sslcommerz->store_password }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Country Name')}}</label>
                                                                <select name="country_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Country')}}
                                                                  </option>
                                                                  @foreach ($countires as $country)
                                                                  <option {{ $sslcommerz->country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency Name')}}</label>
                                                                <select name="currency_name" id="" class="form-control select2">
                                                                    <option value="">{{__('admin.Select Currency')}}
                                                                  </option>
                                                                  @foreach ($currencies as $currency)
                                                                  <option {{ $sslcommerz->currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                                                  </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Currency Rate')}} ({{__('admin.Per')}} {{ $setting->currency_name }})</label>
                                                                <input type="text" class="form-control" name="currency_rate" value="{{ $sslcommerz->currency_rate }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="bankAccountTab" role="tabpanel" aria-labelledby="bank-account-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-bank') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Bank Payment Status')}}</label>
                                                                <div>
                                                                    @if ($bank->status == 1)
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @else
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Account Information')}}</label>
                                                                <textarea name="account_info" id="" cols="30" rows="10" class="text-area-5 form-control">{{ $bank->account_info }}</textarea>
                                                            </div>

                                                            <button class="btn btn-primary">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($bank)
                                                <div class="tab-pane fade" id="cashTab" role="tabpanel" aria-labelledby="cash-tab">
                                                    <div class="card m-0">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Cash on delivery Status')}}</label>
                                                                <div>
                                                                    @if ($bank->cash_on_delivery_status == 1)
                                                                        <a onclick="changeCashOnDeliveryStatus()" href="javascript:;">
                                                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        </a>
                                                                        @else
                                                                        <a onclick="changeCashOnDeliveryStatus()" href="javascript:;">
                                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
      </div>

      <script>
        function changeCashOnDeliveryStatus(id){
            var isDemo = "{{ env('APP_MODE') }}"
            if(isDemo == 'DEMO'){
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }
            $.ajax({
                type:"put",
                data: { _token : '{{ csrf_token() }}' },
                url: "{{ route('admin.update-cash-on-delivery') }}",
                success:function(response){
                    toastr.success(response)
                },
                error:function(err){
                    console.log(err);

                }
            })
        }
    </script>
@endsection
