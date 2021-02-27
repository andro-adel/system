@extends('admin.layout.master')

@section('body')
<div id="layoutSidenav_content">
  <main>
      <div class="container-fluid">
<div class="header my-3">
    <h3 class=" float-left"> Edit User </h3>
    <div class="clearfix"></div>
</div>

<div class="card p-5">

  {{-- User Image --}}
  <div class="row col-12 mx-0 px-0">
    @if($customer->image)
      <img  class="img-thumbnail thumbnail-extra" src="{{  asset( "/storage//" . $customer->image->image) }}" 
            onerror="this.src='/storage/users/user-default.png'">
    @else 
      <img class="img-thumbnail thumbnail-extra" src="{{ asset( "/storage/users/user-default.png") }}" >
    @endif
  </div>
  {{-- User Form --}}
<form method="POST" action="/admin/manage-users/{{  $customer->id }}" enctype="multipart/form-data">

    @csrf
    @method('PUT')
    
    {{-- Name --}}
    <div class="form-group">
      <label for="user_name">User Name</label>
      <input value="{{ $customer->name }}" required type="text" class="form-control @error('username') border-danger @enderror" id="admin_name" name="username">
    
      @error('username')
            @foreach ($errors->get('username') as $error)
            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
            @endforeach
      @enderror

    </div>

    {{-- Email --}}
    <div class="form-group">
        <label for="user_mail">User Email</label>
        <input value="{{ $customer->email }}" required type="email" class="form-control @error('email') border-danger @enderror" id="admin_mail" name="email">

        @error('email')
            @foreach ($errors->get('email') as $error)
            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
            @endforeach
        @enderror

    </div>

     {{-- PHONE --}}
     <div class="form-group">
        <label for="phone">User Mobile</label>
        <input value="{{ $customer->phoneNumber  }}" required type="text" class="form-control @error('phone') border-danger @enderror" id="phone" name="phone">

        @error('phone')
            @foreach ($errors->get('phone') as $error)
            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
            @endforeach
        @enderror

    </div>

    {{-- Password --}}
    <div class="form-group">
        <label for="password">password</label>
        <input value="" type="password" class="form-control  @error('password') border-danger @enderror" id="password"  name="password">

        @error('password')
            @foreach ($errors->get('password') as $error)
            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
            @endforeach
        @enderror

    </div>


    {{-- Image --}}
    <div class="form-group">
      <label for="image">Image</label>
      <input value="{{ old('image') }}"  type="file" class="form-control  @error('image') border-danger @enderror" id="image"  name="image">

      @error('image')
          @foreach ($errors->get('image') as $error)
          <span class="text-sm text-danger mb-2"> {{  $error }}</span>
          @endforeach
      @enderror

  </div>

     {{-- Status  --}}
    <div class="form-group">

      <div class="form-check form-check-inline">
        <input {{ $customer->status == 1 ? "checked" : "" }} required class="form-check-input" type="radio" name="status" id="active" value="1" >
        <label class="form-check-label" for="active">Active </label>
      </div>

      <div class="form-check form-check-inline">
        <input {{ $customer->status == 0 ? "checked" : "" }} required class="form-check-input" type="radio" name="status" id="inactive" value="0">
        <label class="form-check-label" for="inactive">InActive</label>
      </div>

        @error('status')
            @foreach ($errors->get('status') as $error)
            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
            @endforeach
        @enderror

    </div>
  
 
    <button type="submit" class="btn btn-primary">Edit User</button>
</form>

</div>

</form>
</div>
</main>
@endsection