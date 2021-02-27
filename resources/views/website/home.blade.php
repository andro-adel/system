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

<div class="row col-12 mx-0 px-0">

      @foreach ($errors->all() as $error)
      <span class="text-sm text-danger mb-2"> {{  $error }}</span>
      @endforeach


  <form method="post" action="/verifymail" enctype="multipart/form-data">
    @csrf

    <div class="row col-12 mx-0 px-0">
    
      @if ( @session()->has('error') )
          <div class="bg rounded bg-danger bg-sm text-white  alert-message p-2 m-2">
              {{  session()->get('error') }}
          </div>
      @endif

      <div class="col-12 mx-0 px-3 mb-5 mt-5 text-center">
        <h4  style="background-color:#8ac727;color: white" class="p-2 d-inline-block rounded text-center font-weight-bolder">{{ __('Fill out the form') }}</h4>
      </div>

      <div class="form-group col-12">
        <div class="row col-12">

          <div class="form-group col-md-6">
            <label class="regis @if(Lang::locale() == 'ar') text-arabicop @endif" style="color: #8ac727;font-size: 20px;font-weight: bold!important; ">{{ __('Full Name') }}</label>
            <input type="text" placeholder="{{ __('Enter Full Name') }}" required name="name" id="name" class="form-control @if(Lang::locale() == 'ar') text-arabicop @endif" value="{{ old("name") }}">
      
            @error('name')
                  @foreach ($errors->get('name') as $error)
                  <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                  @endforeach
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label class="regis @if(Lang::locale() == 'ar') text-arabicop @endif" style="color: #8ac727;font-size: 20px;font-weight: bold!important; ">{{ __('Email') }}</label>
            <input type="email" placeholder="{{ __('Enter Email') }}" required name="email" id="email" class="form-control @if(Lang::locale() == 'ar') text-arabicop @endif" value="{{ old("email") }}">
        
              @error('email')
                @foreach ($errors->get('email') as $error)
                <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                @endforeach
              @enderror
          </div>

        </div>
      </div>

      <div class="form-group col-12">
        <div class="row col-12">

          <div class="form-group col-md-6">
            <label class="regis @if(Lang::locale() == 'ar') text-arabicop @endif" style="color: #8ac727;font-size: 20px;font-weight: bold!important; ">{{ __('Phone Number') }}</label>
            <input type="number" placeholder="{{ __('Enter Phone Number') }}" required name="phone" id="phone" class="form-control @if(Lang::locale() == 'ar') text-arabicop @endif" value="{{ old("phonenumber") }}">
      
            @error('phonenumber')
                  @foreach ($errors->get('phonenumber') as $error)
                  <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                  @endforeach
            @enderror
          </div>

          <div class="form-group col-md-6">
              <label class="regis @if(Lang::locale() == 'ar') text-arabicop @endif" style="color: #8ac727;font-size: 20px;font-weight: bold!important; ">{{ __('The Grade Are You In') }}</label>
              <select type="text" required name="studentclass" id="studentclass" class="form-control @if(Lang::locale() == 'ar') text-arabicop @endif" value="{{ old("studentclass") }}">
                <option disabled selected value="Select Your Grade">{{ __('Select Your Grade') }}</option>
                <option value="Primary School">{{ __('Primary School') }}</option>
                <option value="Secondary School">{{ __('Secondary Shool') }}</option>
                <option value="Secondary Class">{{ __('Secondary Class') }}</option>
              </select>
        
              @error('studentclass')
                @foreach ($errors->get('studentclass') as $error)
                <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                @endforeach
              @enderror
          </div>

        </div>
      </div>

      <div class="form-group col-12">
        <div class="row col-12">

          <div class="form-group col-md-6">
              <label class="regis @if(Lang::locale() == 'ar') text-arabicop @endif" style="color: #8ac727;font-size: 20px;font-weight: bold!important; ">{{ __('Marital Status') }}</label>
              <select type="text" required name="marital_status" id="marital_status" class="form-control @if(Lang::locale() == 'ar') text-arabicop @endif" value="{{ old("marital_status") }}">
                <option disabled selected value="Select Marital Status">{{ __('Select Marital Status') }}</option>
                <option value="Single">{{ __('Single') }}</option>
                <option value="married">{{ __('married') }}</option>
            </select>
      
              @error('marital_status')
                    @foreach ($errors->get('marital_status') as $error)
                    <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                    @endforeach
              @enderror
          </div>

          <div class="form-group col-md-6">
            <label class="regis @if(Lang::locale() == 'ar') text-arabicop @endif" style="color: #8ac727;font-size: 20px;font-weight: bold!important; ">{{ __('Gender') }}</label>
            <select type="text" required name="gender" id="gender" class="form-control @if(Lang::locale() == 'ar') text-arabicop @endif" value="{{ old("gender") }}">
                <option disabled selected value="Select Gender">{{ __('Select Gender') }}</option>
                <option value="Male">{{ __('Male') }}</option>
                <option value="Female">{{ __('Female') }}</option>
            </select>
      
            @error('gender')
              @foreach ($errors->get('gender') as $error)
              <span class="text-sm text-danger mb-2"> {{  $error }}</span>
              @endforeach
            @enderror
          </div>

        </div>
      </div>

      <div class="form-group col-12">
        <div class="row col-12">

          <div class="form-group col-md-6">
            <label class="regis @if(Lang::locale() == 'ar') text-arabicop @endif" style="color: #8ac727;font-size: 20px;font-weight: bold!important; ">{{ __('Nationality') }}</label>
            <select type="text" required name="nationality" id="nationality" class="form-control @if(Lang::locale() == 'ar') text-arabicop @endif" value="{{ old("nationality") }}">
              <option disabled selected value="Select Nationality">{{ __('Select Nationality') }}</option>
              <option value="Egyptian">{{ __('Egyptian') }}</option>
            </select>
      
            @error('nationality')
                  @foreach ($errors->get('nationality') as $error)
                  <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                  @endforeach
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label class="regis @if(Lang::locale() == 'ar') text-arabicop @endif" style="color: #8ac727;font-size: 20px;font-weight: bold!important; ">{{ __('Birth Date') }}</label>
            <input type="date" placeholder="{{ __('Enter Birth Date') }}" required name="dateofbirth" id="dateofbirth" class="form-control @if(Lang::locale() == 'ar') text-arabicop @endif" value="{{ old("dateofbirth") }}">
        
              @error('dateofbirth')
                @foreach ($errors->get('dateofbirth') as $error)
                <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                @endforeach
              @enderror
            </div>

        </div>
      </div>

      <div class="form-group col-12">
        <div class="row col-12">

            <div class="form-group col-md-6">
              <label class="regis @if(Lang::locale() == 'ar') text-arabicop @endif" style="color: #8ac727;font-size: 20px;font-weight: bold!important; ">{{ __('Your School Name') }}</label>
              <input type="text" placeholder="{{ __('Enter Your School Name') }}" required name="nameofschool" id="nameofschool" class="form-control @if(Lang::locale() == 'ar') text-arabicop @endif" value="{{ old("nameofschool") }}">
        
              @error('nameofschool')
                    @foreach ($errors->get('nameofschool') as $error)
                    <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                    @endforeach
              @enderror
            </div>

          <div class="form-group col-md-6">
            <label class="regis @if(Lang::locale() == 'ar') text-arabicop @endif" style="color: #8ac727;font-size: 20px;font-weight: bold!important; ">{{ __('Religion') }}</label>
            <select type="text" required name="religion" id="religion" class="form-control @if(Lang::locale() == 'ar') text-arabicop @endif" value="{{ old("religion") }}">
              <option disabled selected value="Select Religion">{{ __('Select Religion') }}</option>
                <option value="Muslim">{{ __('Muslim') }}</option>
                <option value="Christian">{{ __('Christian') }}</option>
            </select>
        
              @error('religion')
                @foreach ($errors->get('religion') as $error)
                <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                @endforeach
              @enderror
          </div>

        </div>
      </div>

      {{-- Status  --}}
    <div hidden class="form-group">

      <div class="form-check form-check-inline">
        <input {{ old('status') == 1 || !old('status') ? "checked" : "" }}  required class="form-check-input" type="radio" name="status" id="active" value="1">
        <label class="form-check-label" for="active">Active </label>
      </div>

      <div class="form-check form-check-inline">
        <input {{ (old('status') == 0 && old('status') != null ) ? "checked" : "" }} required class="form-check-input" type="radio" name="status" id="inactive" value="0">
        <label class="form-check-label" for="inactive">InActive</label>
      </div>

        @error('status')
            @foreach ($errors->get('status') as $error)
            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
            @endforeach
        @enderror

    </div>

      {{-- Image --}}
     <div class="form-group col-md-12">
        <label class="regis @if(Lang::locale() == 'ar') text-arabicop @endif" style="color: #8ac727;font-size: 20px;font-weight: bold!important;">{{ __('Image') }}</label>
        <input value="{{ old('image') }}" type="file" class="form-control  @error('image') border-danger @enderror" id="image"  name="image">

          @error('image')
              @foreach ($errors->get('image') as $error)
              <span class="text-sm text-danger mb-2"> {{  $error }}</span>
              @endforeach
          @enderror

      </div>

      <div class="col-12 mx-0 px-3 mb-5 mt-5 text-center">
        <button type="submit" class="btn btn-primary" style="background-color: #8ac727!important;">{{ __('Submit') }}</button>
      </div>
      
    </div>

  </form>

</div>

@endsection

