@extends('admin.layout.master')

@section('body')
<div id="layoutSidenav_content">
  <main>
      <div class="container-fluid">
<div class="header my-3">
    <h5 class=" float-left"> Edit Address for <b>{{ $address->user->name }}  </b></h5>
    <div class="clearfix"></div>
</div>

<div class="card p-5">
  {{-- Admin Form --}}
<form method="post" action="/admin/address/{{ $address->id }}">

    @csrf
    @method("PUT")
  
    {{-- Area Name & Street Name --}}

    <div class="form-group row d-flex justify-content-between alig-item-between">
      <div class="col-md-6" >
          <label for="region">Area Name</label>
          <input placeholder="Enter region" value="{{ $address->region }}" required type="text" class="form-control @error('region') border-danger @enderror" id="region" name="region">
          @error('region')
              @foreach ($errors->get('region') as $error)
              <span class="text-sm text-danger mb-2"> {{  $error }}</span>
              @endforeach
          @enderror
      </div>

      <div class="col-md-6" >
          <label for="street">Street Name</label>
          <input placeholder="Enter street" value="{{ $address->street }}" required type="text" class="form-control @error('street') border-danger @enderror" id="street" name="street">

          @error('street')
              @foreach ($errors->get('street') as $error)
              <span class="text-sm text-danger mb-2"> {{  $error }}</span>
              @endforeach
          @enderror
      </div>
    </div> 

    {{-- Building Number & Role Number --}}

    <div class="form-group row d-flex justify-content-between alig-item-between">
      <div class="col-md-6" >
          <label for="building_number">Building Number</label>
          <input placeholder="Enter building_number" value="{{ $address->building_number }}" required type="number" class="form-control @error('building_number') border-danger @enderror" id="building_number" name="building_number">
          @error('building_number')
              @foreach ($errors->get('building_number') as $error)
              <span class="text-sm text-danger mb-2"> {{  $error }}</span>
              @endforeach
          @enderror
      </div>

      <div class="col-md-6" >
          <label for="floor_number">Role Number</label>
          <input placeholder="Enter floor_number" value="{{ $address->floor_number }}" required type="number" class="form-control @error('floor_number') border-danger @enderror" id="floor_number" name="floor_number">

          @error('floor_number')
              @foreach ($errors->get('floor_number') as $error)
              <span class="text-sm text-danger mb-2"> {{  $error }}</span>
              @endforeach
          @enderror
      </div>
    </div> 

    {{-- Apartment Number & Description --}}

    <div class="form-group row d-flex justify-content-between alig-item-between">
      <div class="col-md-6" >
          <label for="apartment_number">Apartment Number</label>
          <input placeholder="Enter apartment_number" value="{{ $address->apartment_number }}" required type="number" class="form-control @error('apartment_number') border-danger @enderror" id="apartment_number" name="apartment_number">
          @error('apartment_number')
              @foreach ($errors->get('apartment_number') as $error)
              <span class="text-sm text-danger mb-2"> {{  $error }}</span>
              @endforeach
          @enderror
      </div>

      <div class="col-md-6" >
          <label for="address">Description</label>
          <input placeholder="Enter address" value="{{ $address->address }}" type="text" class="form-control @error('address') border-danger @enderror" id="address" name="address">

          @error('address')
              @foreach ($errors->get('address') as $error)
              <span class="text-sm text-danger mb-2"> {{  $error }}</span>
              @endforeach
          @enderror
      </div>
    </div> 

{{-- City & Country --}}

<div class="form-group row d-flex justify-content-between alig-item-between">
  <div class="col-md-6" >
      <label for="City">City</label>
      <input placeholder="Enter City" value="{{ $address->city }}" required type="text" class="form-control @error('city') border-danger @enderror" id="city" name="city">
      @error('city')
          @foreach ($errors->get('city') as $error)
          <span class="text-sm text-danger mb-2"> {{  $error }}</span>
          @endforeach
      @enderror
  </div>

  <div class="col-md-6" >
      <label for="Country">Country</label>
      <input placeholder="Enter Country" value="{{ $address->country }}" required type="text" class="form-control @error('country') border-danger @enderror" id="Country" name="country">

      @error('country')
          @foreach ($errors->get('country') as $error)
          <span class="text-sm text-danger mb-2"> {{  $error }}</span>
          @endforeach
      @enderror
  </div>

</div> 
    

    {{-- City & Country --}}

    <div class="form-group row d-flex justify-content-between alig-item-between">
        <div class="col-md-6" >
            <label for="City">City</label>
            <input placeholder="Enter City" value="{{ $address->city }}" required type="text" class="form-control @error('city') border-danger @enderror" id="city" name="city">
            @error('city')
                @foreach ($errors->get('city') as $error)
                <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                @endforeach
            @enderror
        </div>
 
        <div class="col-md-6" >
            <label for="Country">Country</label>
            <input placeholder="Enter Country" value="{{ $address->country }}" required type="text" class="form-control @error('country') border-danger @enderror" id="Country" name="country">

            @error('country')
                @foreach ($errors->get('country') as $error)
                <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                @endforeach
            @enderror
        </div>

    </div> 

       {{-- Status  --}}
       <div class="form-group">

        <div class="form-check form-check-inline">
          <input {{$address->status == 1 ? "checked" : "" }} required class="form-check-input" type="radio" name="status" id="active" value="1" >
          <label class="form-check-label" for="active">Active </label>
        </div>
  
        <div class="form-check form-check-inline">
          <input {{ $address->status == 0 ? "checked" : "" }} required class="form-check-input" type="radio" name="status" id="inactive" value="0">
          <label class="form-check-label" for="inactive">InActive</label>
        </div>
  
          @error('status')
              @foreach ($errors->get('status') as $error)
              <span class="text-sm text-danger mb-2"> {{  $error }}</span>
              @endforeach
          @enderror
  
      </div>

 
    <button type="submit" class="btn btn-primary">Save Address</button>
</form>

</div>

</form>

</div>
</main>
@endsection