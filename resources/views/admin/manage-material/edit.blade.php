@extends('admin.layout.master')

@section('body')
<div id="layoutSidenav_content">
  <main>
      <div class="container-fluid">
<div class="header my-3">
    <h3 class=" float-left"> Edit Variarnce </h3>
    <div class="clearfix"></div>
</div>

<div class="card p-5">
  {{-- Admin Form --}}
  <form method="POST" action="/admin/variance/{{ $variance->id }}" enctype="multipart/form-data">

    @csrf
    @method("PUT")

    {{-- Color & size  --}}
    <div class="form-group">
      <div class="row">
        <div class="form-group col-md-4">
          <label for="variance_type_en">Variance Type English</label>
          <input value="{{ $variance->variance_type_en }}" required type="text" class="form-control @error('variance_type_en') border-danger @enderror" id="variance_type_en" name="variance_type_en"> 
          
            @error('variance_type_en')
                  @foreach ($errors->get('variance_type_en') as $error)
                  <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                  @endforeach
            @enderror
        </div>

          <div class="form-group col-md-4">
            <label for="variance_type_ar">Variance Type Arabic</label>
            <input value="{{ $variance->variance_type_ar }}" required type="text" class="form-control @error('variance_type_ar') border-danger @enderror" id="variance_type_ar" name="variance_type_ar"> 
            
              @error('variance_type_ar')
                    @foreach ($errors->get('variance_type_ar') as $error)
                    <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                    @endforeach
              @enderror
          </div>

          
        <div class="form-group col-md-4">
          <label for="offer">Variance Offer</label>
          <input placeholder="Enter Offer" value="{{ $variance->offer }}" type="number" class="form-control @error('offer') border-danger @enderror" id="offer" name="offer"> 
            @error('offer')
                  @foreach ($errors->get('offer') as $error)
                  <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                  @endforeach
            @enderror
        </div>

      </div>
    </div>

     
    {{-- Image --}}
    <div class="form-group">
      <label for="images">Image</label>
      <input  multiple value="" type="file" class="form-control  @error('images') border-danger @enderror" id="images"  name="images[]">

      <div class="row col-12 mt-2 ">
        @foreach ($variance->images as $image)
            <div style="position: relative;" class="p_image{{ $image->id }}">
              <img  class="img-thumbnail thumbnail-extra" style="margin: 5px !important" src="{{  asset( "/storage//" . $image->image) }}">
              <a onclick="deleteImage({{ $image->id }})" style="position: absolute; right: 5px;top: 4px;" class="btn btn-danger btn-sm text-white"><i class="fa fa-trash fa-sm" aria-hidden="true"></i></a>
            </div>
        @endforeach
    </div>

    </div>

     {{-- Status  --}}
     <div class="form-group">

      <div class="form-check form-check-inline">
        <input {{ $variance->status == 1 ? "checked" : "" }} required class="form-check-input" type="radio" name="status" id="active" value="1" >
        <label class="form-check-label" for="active">Active </label>
      </div>

      <div class="form-check form-check-inline">
        <input {{ $variance->status == 0 ? "checked" : "" }} required class="form-check-input" type="radio" name="status" id="inactive" value="0">
        <label class="form-check-label" for="inactive">InActive</label>
      </div>

        @error('status')
            @foreach ($errors->get('status') as $error)
            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
            @endforeach
        @enderror

    </div>
 
    <button type="submit" class="btn btn-primary btn-block">Edit Varirance</button>
</form>

</div>


{{-- variance Product & prices  --}}
<div class="card p-5 my-3">
  
  @if ( @session()->has('message') )
      <div class="bg rounded bg-success text-white py-2 my-2 px-3 mx-0">
          {{  session()->get('message') }}
      </div>
  @endif

  @if($errors->any())
    @foreach ($errors->all() as $error)
    <div class="bg rounded bg-danger text-white py-2 my-2 px-0 mx-0"> {{  $error }}</div>
    @endforeach
  @endif

  <form method="post" action="/admin/assign-variance-attributes/{{ $variance->id }}">
    @csrf
    <button type="button" class="btn btn-inline-block btn-success col-md-3 col-4 mb-4" onclick="addNewAttributres(true)">  Add New  </button>
    <button type="button" class="btn btn-inline-block btn-danger col-md-3 col-4 mb-4" onclick="addNewAttributres(false)">  Remove  </button>

    <div class="form-group col-md-12 row atributes-list">

      @foreach ($variance->attributes as $attribute)
        <div class="col-12 row mx-0 px-0 my-3 formBoxContainer">
          <div class="col-md-4">
            <label for="v_price"> Price</label>
            <input placeholder="Enter Price EG" value="{{ $attribute->price }}" required type="number" class="form-control" id="prices" name="prices[]"> 
          </div>

          <div class="col-md-4">
            <label for="variance_weight"> Weight</label>
            <select  required class="form-control" id="weights" name="weights[]">
              <option @if($attribute->weight == 1000) selected @endif value="1000"> 1000</option>
              <option @if($attribute->weight == 500) selected @endif   value="500"> 500</option>
              <option @if($attribute->weight == 250) selected @endif   value="250"> 250</option>
              <option @if($attribute->weight == 200) selected @endif   value="200"> 200</option>
              <option @if($attribute->weight == 125) selected @endif   value="125"> 125</option>
              <option @if($attribute->weight == 100) selected @endif   value="100"> 100</option>
              <option @if($attribute->weight == 50) selected @endif   value="50"> 50</option>
            </select>
          </div>

          <div class="col-md-4">
            <label for="quantities"> QUANTITY</label>
            <input placeholder="Enter Quantity" value="{{ $attribute->quantity }}" type="number" class="form-control" id="quantities" name="quantities[]"> 
          </div>

        </div>
      @endforeach

    </div>

    <button class="btn btn-primary btn-block"> Save Attributes </button>

  </form>
    
</div>
</div>
</main>
@endsection

<script>

  function deleteImage (image_id) {
    let _token   = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          type:'POST',
          url:'/admin/manage-variance/delete-images',
          data: { 
            image_id: image_id ,
              _token: _token
          },
          success:function(data) {
              // toggle classes
             console.log("image deleted");
             $(".p_image" + image_id).hide();
  
          },
          fail: function(fail){
              console.log(fail);
          }
      });
  }
  
  function addNewAttributres(add = true) {
    if (add) { 
      $(".atributes-list").append(
      `
        <div class="col-12 row mx-0 px-0 my-3 formBoxContainer">
          <div class="col-md-4">
            <label for="v_price">Variance Price</label>
            <input placeholder="Enter Price EG" value="" required type="number" class="form-control" id="prices" name="prices[]"> 
          </div>

          <div class="col-md-4">
            <label for="variance_weight">Variance Weight</label>
            <select value="" required class="form-control" id="weights" name="weights[]">
              <option  value="1000"> 1000</option>
              <option  value="500"> 500</option>
              <option  value="250"> 250</option>
              <option  value="200"> 200</option>
              <option  value="125"> 125</option>
              <option  value="100"> 100</option>
              <option  value="50"> 50</option>
            </select>
          </div>

          <div class="col-md-4">
            <label for="quantities"> QUANTITY</label>
            <input placeholder="Enter Quantity" value="" type="number" class="form-control" id="quantities" name="quantities[]"> 
          </div>

        </div>
        `
      );
    } else {
      $(".formBoxContainer:last-child").remove()

    }
  }

  </script>