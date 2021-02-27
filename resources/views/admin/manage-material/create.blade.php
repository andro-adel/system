@extends('admin.layout.master')

@section('body')
<div id="layoutSidenav_content">
  <main>
      <div class="container-fluid">
  
<div class="header my-3">
    <h3 class=" float-left"> Add Material </h3>
    <div class="clearfix"></div>
</div>

<form method="post" action="/admin/material">

  {{-- Admin Form --}}

  <input type="hidden" name="student_id" value="{{ $student->id }}" >

      @csrf



{{-- variance Product & prices  --}}
<div class="card p-5 my-3">
  
  {{-- <button type="button" class="btn btn-inline-block btn-success col-md-3 col-4 mb-4" onclick="addNewAttributres(true)">  Add New  </button>
  <button type="button" class="btn btn-inline-block btn-danger col-md-3 col-4 mb-4" onclick="addNewAttributres(false)">  Remove  </button> --}}


  <div class="form-group col-md-12 row atributes-list">

    <div class="col-12 row mx-0 px-0 my-3">

      <div class="col-md-6">
        <label for="materialname">Material Name</label>
        <select value="{{ old('materialname') }}" required class="form-control" id="materialname" name="materialname">
          <option  value="English"> English</option>
          <option  value="Math"> Math </option>
          <option  value="History"> History</option>
        </select>
      </div>

      <div class="col-md-6">
        <label for="materialgrade">Material Grade</label>
        <select value="{{ old('materialgrade') }}" required class="form-control" id="materialgrade" name="materialgrade">
          <option  value="Excellent"> Excellent</option>
          <option  value="Very Good"> Very Good</option>
          <option  value="Good"> Good</option>
          <option  value="Acceptable"> Acceptable</option>
          <option  value="Fail"> Fail</option>
        </select>
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

    </div>

  </div>
    
</div>

<button type="submit" class="btn btn-primary btn-block my-5">Save Materiales</button>

</form>

<script>

  function addNewAttributres(add = true) {
    if (add) { 
      $(".atributes-list").append(
      `
        <div class="col-12 row mx-0 px-0 my-3 formBoxContainer">

            <div class="col-md-6">
            <label for="materialname">Material Name</label>
            <select value="" required class="form-control" id="materialname" name="materialname[]">
              <option  value="English"> English</option>
              <option  value="Math"> Math </option>
              <option  value="History"> History</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="materialgrade">Material Grade</label>
            <select value="" required class="form-control" id="materialgrade" name="materialgrade[]">
              <option  value="Excellent"> Excellent</option>
              <option  value="Very Good"> Very Good</option>
              <option  value="Good"> Good</option>
              <option  value="Acceptable"> Acceptable</option>
              <option  value="Fail"> Fail</option>
            </select>
          </div>

        </div>
        `
      );
    } else {
      $(".formBoxContainer:last-child").remove()

    }
  }

</script>
</div>
</main>
@endsection