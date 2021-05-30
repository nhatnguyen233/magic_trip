@extends('layouts.user.app')

@section('content')
    <div class="hero_in cart_section last">
        <div class="wrapper">
            <div class="container">
                <div class="bs-wizard clearfix">
                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">@lang('message.cart')</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('cart.index') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">@lang('message.book_tour')</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('book-tour.create') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">@lang('message.confirm')</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('book-tour.index') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">@lang('message.payment')</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum">@lang('message.finish')</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#0" class="bs-wizard-dot"></a>
                    </div>
                </div>
                <!-- End bs-wizard -->
                <div id="confirm">
                    <h4>@lang('message.book_success')</h4>
                    <p>@lang('message.receive_inf')</p>
                </div>
            </div>
        </div>
    </div>
    <!--/hero_in-->
@endsection

@section('script')

@endsection

