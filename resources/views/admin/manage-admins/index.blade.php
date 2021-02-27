@extends('admin.layout.master')

@section('body')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
<div class="header my-3">
    <h3 class=" float-left"> Manage Admins </h3>
    <a class="float-right btn btn-success cursor text-white" href="/admin/manage-admins/create"> 
        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
        Create Admin
    </a>
    <div class="clearfix"></div>
    <form class="w-50" method="GET" action="/admin/manage-admins">
        <div class="form-group mt-1 d-flex flex-row">
            <input class="form-control d-inline-block" placeholder="Search for Admin" name="search">
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
        <th> image </th>
        <th> Name </th>
        <th> Email </th>
        <th> phoneNumber  </th>
        <th> Branch  </th>
        <th> Status </th>
        <th> Type </th>
        <th> Action </th>
    </thead>
    <tbody>
        
        @foreach ($admins as $admin)
            <tr>
                <td> <a href="/admin/manage-admins/{{ $admin->id }}"> {{  $admin->id }} </a> </td>
                <td> 
                    @if ($admin->image)
                        <img  class="img-thumbnail" src="{{  asset( "/storage//" . $admin->image->image) }}" 
                        onerror="this.src='/storage/users/user-default.png'">
                    @else
                    
                    <img class="img-thumbnail" src="{{ asset( "/storage/users/user-default.png") }}">
                    @endif
                </td>
                <td> <a href="/admin/manage-admins/{{ $admin->id }}"> {{  $admin->name }} </a></td>
                <td> {{  $admin->email }} </td>
                <td> {{  $admin->phonenumber  }} </td>
                <td> {{  ($admin->branch) ? $admin->branch->name_en : 'No' }} </td>
                <td>
                    @if($admin->status == 1)
                        <span class="bg bg-success text-white text-sm px-2 rounded-pill statusBackground{{ $admin->id }}">Active </span>
                    @else
                        <span class="bg bg-danger text-white text-sm px-2 rounded-pill statusBackground{{ $admin->id }}">InActive </span>
                    @endif
                </td>
                <td>
                    @if($admin->type == 1)
                        <span class="bg bg-secondary text-white text-sm px-2 rounded-pill {{ $admin->id }}">User </span>
                    @else
                        <span class="bg bg-primary text-white text-sm px-2 rounded-pill {{ $admin->id }}">Admin </span>
                    @endif
                </td>
                <td>
                    <span> <a href="/admin/manage-admins/{{ $admin->id }}"> <i class="fas fa-edit text-info mr-2"></i> </a> </span>

                    <span> 
                        <a data-toggle="modal" data-target="#toggleStatuts" onclick="setAdminId({{ $admin->id }})" class="cursor"> 
                            <i style="cursor: pointer;" class="statusIcon{{ $admin->id }} @if($admin->status == 1) text-success fas fa-user-check  @else fas fa-user-times text-danger @endif" ></i> 
                        </a>
                    </span>
                    <span> <a href="/admin/address?user_id={{ $admin->id }}"> <i class="fas fa-map-marker-alt text-info ml-2" aria-hidden="true"></i> </a> </span>

                </td>
            </tr>
        @endforeach
    </tbody>
 </table>

 <div class="container">
    {{ $admins->appends(request()->query())->links("pagination::bootstrap-4")}}
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
          <h5 class="modal-title" id="toggleStatutsLabel">Change Admin Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure that you want to Change Admin Status  ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="ChangeAdminStatus()">Change</button>
        </div>
      </div>
    </div>
  </div>

<script>

// variables
admin_id = null;

// this method to hide alert message after a specific number of seconds
setTimeout(()=> {
    $('.alert-message').hide();
}, 3000);


// method to set admin id
function setAdminId(id) {
    admin_id = id;
}

// method to change admin status
function ChangeAdminStatus () {
    // Send Ajax Request to changer order status
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:'POST',
        url:'/admin/manage-admins/' + admin_id,
        data: { 
            _method: "DELETE" ,
            _token: _token
        },
        success:function(data) {
            // toggle classes
            $('.statusBackground' + admin_id).toggleClass('bg-success bg-danger');
            $(".statusIcon" + admin_id).toggleClass('fa-user-times fa-user-check');
            $(".statusIcon" + admin_id).toggleClass('text-danger text-success');

            if ( $('.statusBackground' + admin_id).hasClass('bg-success') ) {
                $('.statusBackground' + admin_id).html("Active");
            } else {
                $('.statusBackground' + admin_id).html("InActive")
            }          
        },
        fail: function(fail){
            console.log(fail);
        }
    });

    // after change status close the popup modal
    $('#toggleStatuts').modal('hide');
}

</script>