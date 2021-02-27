@extends('admin.layout.master')

@section('body')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
<div class="header my-3">
    <h3 class=" float-left"> Add User </h3>
    <div class="clearfix"></div>
</div>

<div class="card p-5">
  {{-- User Form --}}
<form method="post" action="/admin/manage-users" enctype="multipart/form-data">

    @csrf
    
    {{-- Name --}}
    <div class="form-group">
      <label for="user_name">User Name</label>
      <input value="{{ old('username') }}" required type="text" class="form-control @error('username') border-danger @enderror" id="admin_name" name="username">
    
      @error('username')
            @foreach ($errors->get('username') as $error)
            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
            @endforeach
      @enderror

    </div>

    {{-- Email --}}
    <div class="form-group">
        <label for="user_mail">User Email</label>
        <input value="{{ old('email') }}" required type="email" class="form-control @error('email') border-danger @enderror" id="admin_mail" name="email">

        @error('email')
            @foreach ($errors->get('email') as $error)
            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
            @endforeach
        @enderror

    </div>

     {{-- PHONE --}}
     <div class="form-group">
        <label for="phone">User Mobile</label>
        <input value="{{ old('phone') }}" required type="text" class="form-control @error('phone') border-danger @enderror" id="phone" name="phone">

        @error('phone')
            @foreach ($errors->get('phone') as $error)
            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
            @endforeach
        @enderror

    </div>

    {{-- Password --}}
    <div class="form-group">
        <label for="password">password</label>
        <input value="{{ old('password') }}" required type="password" class="form-control  @error('password') border-danger @enderror" id="password"  name="password">

        @error('password')
            @foreach ($errors->get('password') as $error)
            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
            @endforeach
        @enderror

    </div>


     {{-- Image --}}
     <div class="form-group">
      <label for="image">Image</label>
      <input value="{{ old('image') }}" type="file" class="form-control  @error('image') border-danger @enderror" id="image"  name="image">

      @error('image')
          @foreach ($errors->get('image') as $error)
          <span class="text-sm text-danger mb-2"> {{  $error }}</span>
          @endforeach
      @enderror

  </div>

     {{-- Status  --}}
    <div class="form-group">

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
  
 
    <button type="submit" class="btn btn-primary">Save User</button>
</form>

</div>

</form>
</div>
</main>
@endsection