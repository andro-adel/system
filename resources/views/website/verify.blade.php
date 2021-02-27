@extends('website.layout.master')

@section('body')
<!-- Start WOWSlider.com BODY section -->
<div id="wowslider-container1">
    <div class="ws_images"><ul>
            <li><a ><img src="data1/images/vpjk7f837q.jpg" alt="jquery image slider" title="" id="wows1_0"/></a></li>
            <li><img src="data1/images/wxvpyp3tsf.jpg" alt="" title="" id="wows1_1"/></li>
        </ul></div>
        <div class="ws_bullets"><div>
            <a  title=""><span><img src="data1/tooltips/vpjk7f837q.jpg" alt=""/>1</span></a>
            <a  title=""><span><img src="data1/tooltips/wxvpyp3tsf.jpg" alt=""/>2</span></a>
        </div></div><div class="ws_script" style="position:absolute;left:-99%"><a >slideshow html code</a> by WOWSlider.com v9.0</div>
    <div class="ws_shadow"></div>
    </div>	
    <script type="text/javascript" src="engine1/wowslider.js"></script>
    <script type="text/javascript" src="engine1/script.js"></script>
    <!-- End WOWSlider.com BODY section -->

<div class="container mx-5 my-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #8ac727;color: white;font-weight: bold;">{{ __('Thank you for your application auto-response') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('We’ll be in touch with you soon.') }}
                    {{-- {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>. --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
