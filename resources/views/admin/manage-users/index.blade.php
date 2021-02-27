@extends('admin.layout.master')

@section('body')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
<div class="header my-3">
    <h3 class=" float-left"> Manage Users </h3>
    {{-- <a class="float-right btn btn-success cursor text-white" href="/admin/manage-users/create"> 
        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
        Create User
    </a> --}}
    <div class="clearfix"></div>
    <form class="w-50" method="GET" action="/admin/manage-users">
        <div class="form-group mt-1 d-flex flex-row">
            <input class="form-control d-inline-block" placeholder="Search for customer" name="search">
            <button class="btn btn-primary btn-sm text-white ml-3"> Search </button>
        </div>
    </form>
</div>

@if ( @session()->has('message') )
    <div class="bg rounded bg-success text-white  alert-message p-2 m-2">
        {{  session()->get('message') }}
    </div>
@endif

<div class="table-responsive">

    <table class="table table-light table-striped table-hover">
    <thead>
        <th> # </th>
        <th> Image </th>
        <th> Name </th>
        <th> Email </th>
        <th> PhoneNumber  </th>
        <th> Student Grade </th>
        <th> Marital Status </th>
        <th> Gender </th>
        <th> Nationality  </th>
        <th> Birth Date </th>
        <th> School Name  </th>
        <th> Religion  </th>
        <th> Status </th>
        <th> Action </th>
    </thead>
    <tbody>
        
        @foreach ($customers as $customer)
            <tr id="customer{{$customer->id}}">
                <td> <a href="/admin/manage-users/{{ $customer->id }}"> {{  $customer->id }} </a> </td>
                <td> 
                    @if ($customer->image)
                        <img class="img-thumbnail" src="{{  asset( "/storage//" . $customer->image->image) }}" 
                        onerror="this.src='/storage/user-default.png'">
                    @else
                    
                    <img class="img-thumbnail" src="{{ asset( "/storage/users/user-default.png") }}">
                    @endif
                </td>
                <td> <a href="/admin/manage-users/{{ $customer->id }}"> {{  $customer->name }} </a></td>
                <td> {{  $customer->email }} </td>
                <td> {{  $customer->phonenumber  }} </td>
                <td> {{  $customer->studentclass  }} </td>
                <td> {{  $customer->marital_status  }} </td>
                <td> {{  $customer->gender  }} </td>
                <td> {{  $customer->nationality  }} </td>
                <td> {{  $customer->dateofbirth  }} </td>
                <td> {{  $customer->nameofschool  }} </td>
                <td> {{  $customer->religion  }} </td>
                <td>
                    @if($customer->status == 1)
                        <span class="bg bg-success text-white text-sm px-2 rounded-pill statusBackground{{ $customer->id }}">Active </span>
                    @else
                        <span class="bg bg-danger text-white text-sm px-2 rounded-pill statusBackground{{ $customer->id }}">InActive </span>
                    @endif
                </td>
                <td>
                    {{-- <span> <a href="/admin/manage-users/{{ $customer->id }}"> <i class="fas fa-edit text-info mr-2"></i> </a> </span> --}}
                    <span> <a href="/admin/material?student_id={{ $customer->id }}"> <i class="fas fa-edit text-info mr-2"></i> </a> </span>
                    <hr>
                    <span> 
                        <a data-toggle="modal" data-target="#toggleStatuts" onclick="setcustomerId({{ $customer->id }})" class="cursor"> 
                            <i style="cursor: pointer" class="statusIcon{{ $customer->id }} @if($customer->status == 1) text-success fas fa-user-check  @else fas fa-user-times text-danger @endif" ></i> 
                        </a>
                    </span>

                    {{-- <span> <a href="/admin/address?user_id={{ $customer->id }}"> <i class="fas fa-map-marker-alt text-info ml-2" aria-hidden="true"></i> </a> </span> --}}

                    {{-- <span> <a onclick="deleteUser({{ $customer->id }})"> <i class="fas fa-trash ml-2 text-danger cursor   "></i> </a> </span> --}}

                </td>
            </tr>
        @endforeach
    </tbody>
 </table>

 <div class="container">
    {{ $customers->appends(request()->query())->links("pagination::bootstrap-4")}}
 </div>

</div>
</div>
</main>
@endsection



<!-- Modal To Toggle Status-->
<div class="modal fade" id="toggleStatuts" tabindex="-1" role="dialog" aria-labelledby="toggleStatutsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="toggleStatutsLabel">Change Customer Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure that you want to Change customer Status  ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="ChangecustomerStatus()">Change</button>
        </div>
      </div>
    </div>
  </div>



<script>

// variables
customer_id = null;

// this method to hide alert message after a specific number of seconds
setTimeout(()=> {
    $('.alert-message').hide();
}, 3000);


// method to set customer id
function setcustomerId(id) {
    customer_id = id;
}

// method to change customer status
function ChangecustomerStatus () {
    // Send Ajax Request to changer order status
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:'POST',
        url:'/admin/manage-users/' + customer_id,
        data: { 
            _method: "DELETE" ,
            _token: _token
        },
        success:function(data) {
            // toggle classes
            $('.statusBackground' + customer_id).toggleClass('bg-success bg-danger');
            $(".statusIcon" + customer_id).toggleClass('fa-user-times fa-user-check');
            $(".statusIcon" + customer_id).toggleClass('text-danger text-success');

            if ( $('.statusBackground' + customer_id).hasClass('bg-success') ) {
                $('.statusBackground' + customer_id).html("Active");
            } else {
                $('.statusBackground' + customer_id).html("InActive")
            }          
        },
        fail: function(fail){
            console.log(fail);
        }
    });

    // after change status close the popup modal
    $('#toggleStatuts').modal('hide');
}
function deleteUser (id) {

    alertify.confirm("Are you sure that you want to delete USER",
        function(){
            // user say ok

              // Send Ajax Request to changer order status
                let _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type:'POST',
                    url:'/admin/delete-users/' + id,
                    data: { 
                        _token: _token
                    },
                    success:function(data) {
                        $("#customer" + id).hide("slow");
                        alertify.success('User Deleteed Successfully ');
                    },
                    fail: function(fail){
                        alertify.error('Failed to Delete user , try again later !!');
                    }
                });
        });

}

</script>