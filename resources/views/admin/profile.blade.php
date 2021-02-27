@extends('admin.layout.master')

@section('body')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

<div class="container-fluid">

    
    {{-- profile Data  --}}
    <div class="card mt-5">
        <div class="header mb-5">
            <h3 class="bg-secondary p-3 text-white"> Profile </h3>
            <div class="clearfix"></div>
        </div>
        <div class="card-body p-5" >
            <form method="POST" action="/admin/profile" enctype="multipart/form-data">

                @csrf
                    
                {{-- User Image --}}
                <div class="row col-12 mx-0 px-0">
                    @if($user->image)
                    <img  class="img-thumbnail thumbnail-extra" src="{{  asset( "/storage//" . $user->image->image) }}" 
                            onerror="this.src='/storage/users/user-default.png'">
                    @else 
                    <img class="img-thumbnail thumbnail-extra" src="{{ asset( "/storage/users/user-default.png") }}" >
                    @endif
                </div>

                <input type="hidden" name="user_id" value="{{ $user->id }}" >
                <div class="form-group">
                <label for="admin_name">Email</label>
                <input value="{{ $user->email }}" type="email" class="form-control" id="email" name="email" autocomplete="off">
                </div>
            
                <div class="form-group">
                    <label for="admin_name">Name</label>
                    <input value="{{ $user->name }}" type="text" class="form-control" id="Name" name="name" autocomplete="off">
                </div>
                    
                <div class="form-group">
                    <label for="admin_name">Phone Number</label>
                    <input value="{{ $user->phonenumber }}" type="text" class="form-control" id="phone" name="phone" autocomplete="off">
                </div>

                <div class="input-group">

                    <div class="input-group-prepend">
                        <span class="input-group-text" value="" id="basic-addon1">Password</span>
                    </div>

                
                    <input placeholder="Enter New Password" type="password" class="form-control passwordInput" id="password" name="password" autocomplete="off">
                    
                    <div class="input-group-append">
                        <span class="input-group-text bg-light cursor" id="basic-addon2" onclick="togglePassword()">
                            <i class="fas fa-lock    "></i>
                        </span>
                    </div>

                </div>
                <br>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input value="{{ $user->image }}"  type="file" class="form-control  @error('image') border-danger @enderror" id="image"  name="image">

                    @error('image')
                        @foreach ($errors->get('image') as $error)
                        <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                        @endforeach
                    @enderror

                </div>
            
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-dark ">Edit Profile</button>
                </div>

            </form>
        </div>
    </div>


    {{-- My Addresses --}}
    <div class="card  mt-5">

        <div class="header mb-5">
            <h3 class="bg-secondary p-3 text-white"> Addresses </h3>
            <div class="clearfix"></div>
        </div>

        <div class="card-body px-5 py-0"> 
            <div class="row col-12 mx-0 px-0">

                <div class="table-responsive">

                    <table class="table table-light table-striped table-hover">
                        <thead>
                            <th> ID </th>
                            <th> Area Name</th>
                            <th> Street Name</th>
                            <th> Building Number</th>
                            <th> Floor Number</th>
                            <th> Apartment Number</th>
                            <th> Address </th>
                            <th> City </th>
                            <th> Country  </th>
                            <th> Action  </th>
                        </thead>
                    <tbody>
                        @foreach ($user->address as $addres)
                            <tr id="addres{{$addres->id}}">
                                <td> {{ $addres->id }} </td>
                                <td> {{ $addres->region }} </td>
                                <td> {{ $addres->street }} </td>
                                <td> {{ $addres->building_number }} </td>
                                <td> {{ $addres->floor_number }} </td>
                                <td> {{ $addres->apartment_number }} </td>
                                <td> {{ $addres->address }} </td>
                                <td> {{ $addres->city }} </td>
                                <td> {{ $addres->country }} </td>
                                <td> <span> <a onclick="deleteAddress({{ $addres->id }})"> <i style="cursor: pointer;" class="fas fa-trash ml-2 text-danger cursor   "></i> </a> </span> </td>
                            </tr>
                        @endforeach

                        @if (count($user->address) == 0)
                            <tr>
                                <td colspan="10" class="text-center text-md" style="font-weight: bold;"> there is no addressess to display</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  

    {{-- Add Addresses  --}}
    <div class="card  mt-5 mb-5">

        <div class="header mb-5">
            <h3 class="bg-secondary p-3 text-white"> Add Address </h3>
            <div class="clearfix"></div>
        </div>

        <div class="card-body px-5 py-0"> 
            <form method="post" action="/admin/save-address">
                @csrf

                <div class="form-group">
                    <div class="row">
              
                      <div class="form-group col-md-6">
                    <label>Area Name</label>
                    <input value="{{ old('region') }}" required type="text" class="form-control @error('region') border-danger @enderror" name="region">
                  
                    @error('region')
                          @foreach ($errors->get('region') as $error)
                          <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                          @endforeach
                    @enderror
                      </div>
              
                    <div class="form-group col-md-6">
                    <label >Street Name</label>
                    <input value="{{ old('street') }}" required type="text" class="form-control @error('street') border-danger @enderror" name="street">
                  
                    @error('street')
                      @foreach ($errors->get('street') as $error)
                      <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                      @endforeach
                    @enderror
                      </div>
              
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
              
                      <div class="form-group col-md-6">
                    <label>Building Number</label>
                    <input value="{{ old('building_number') }}" required type="number" class="form-control @error('building_number') border-danger @enderror" name="building_number">
                  
                    @error('building_number')
                          @foreach ($errors->get('building_number') as $error)
                          <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                          @endforeach
                    @enderror
                      </div>
              
                    <div class="form-group col-md-6">
                    <label >Floor Number</label>
                    <input value="{{ old('floor_number') }}" required type="number" class="form-control @error('floor_number') border-danger @enderror" name="floor_number">
                  
                    @error('floor_number')
                      @foreach ($errors->get('floor_number') as $error)
                      <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                      @endforeach
                    @enderror
                      </div>
              
                    </div>
                  </div>

                {{-- Address --}}
                <div class="form-group">
                    <div class="row">

                <div class="form-group col-md-6">
                    <label for="admin_name">description</label>
            
                    <textarea 
                        placeholder="please enter your address here"
                        id="address"
                        name="address" 
                        value="{{ old('address') }}"
                        class="form-control @error('address') border-danger @enderror"> </textarea>
                
                    
                    @error('address')
                            @foreach ($errors->get('address') as $error)
                            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                            @endforeach
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label >Apartment Number</label>
                    <input value="{{ old('apartment_number') }}" required type="number" class="form-control @error('apartment_number') border-danger @enderror" name="apartment_number">
                  
                    @error('apartment_number')
                      @foreach ($errors->get('apartment_number') as $error)
                      <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                      @endforeach
                    @enderror
                      </div>


                </div>
            </div>
                {{-- City & Country --}}
                {{-- <div class="form-group row d-flex justify-content-between alig-item-between"> --}}
                    {{-- <div class="col-md-6" >
                        <label for="City">City</label>
                        <input placeholder="Enter City" value="{{ old('city') }}" required type="text" class="form-control @error('city') border-danger @enderror" id="city" name="city">
                        @error('city')
                            @foreach ($errors->get('city') as $error)
                            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                            @endforeach
                        @enderror
                    </div> --}}

                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-6" >
                                <label for="city">City</label>
                                <input placeholder="Enter city" value="{{ old('city') }}" required type="text" class="form-control @error('city') border-danger @enderror" id="city" name="city">
                    
                                @error('city')
                                    @foreach ($errors->get('city') as $error)
                                    <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                                    @endforeach
                                @enderror
                            </div>
            
                    <div class="col-md-6" >
                        <label for="Country">Country</label>
                        <input placeholder="Enter Country" value="{{ old('country') }}" required type="text" class="form-control @error('country') border-danger @enderror" id="Country" name="country">
            
                        @error('country')
                            @foreach ($errors->get('country') as $error)
                            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                            @endforeach
                        @enderror
                    </div>
            
                </div> 
                    </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Save Address</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

<script>

    function togglePassword () {
        var x = document.getElementsByClassName("passwordInput")[0];
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }


    alertify.warning('Warning message');

    function deleteAddress (id) {

alertify.confirm("Are you sure that you want to delete Address",
    function(){
        // address say ok

          // Send Ajax Request to changer order status
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:'POST',
                url:'/admin/delete-profile-address/' + id,
                data: { 
                    _token: _token
                },
                success:function(data) {
                    $("#addres" + id).hide("slow");
                    alertify.success('address Deleted Successfully ');
                },
                fail: function(fail){
                    alertify.error('Failed to Delete address , try again later !!');
                }
            });
    });

}

</script>