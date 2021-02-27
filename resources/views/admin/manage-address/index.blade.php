@extends('admin.layout.master')

@section('body')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
<div class="header my-3">
    <h5 class=" float-left"> Manage Address For <b>{{ $user->name }}</b> </h5>
    <a class="float-right btn btn-success cursor text-white" href="{{  '/admin/address/create?user_id='. $user->id }}"> 
        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
        Create Address
    </a>
    <div class="clearfix"></div>
    <form class="w-50" method="GET" action="/admin/address">
        <div class="form-group mt-1 d-flex flex-row">
            <input type="hidden" name="user_id" value="{{ $user->id }}" >
            <input class="form-control d-inline-block" placeholder="Search for Address" name="search">
            <button class="btn btn-primary btn-sm text-white ml-3"> Search </button>
        </div>
    </form>
</div>

@if ( @session()->has('message') )
    <div class="bg rounded bg-success text-white p-2 m-2 alert-message">
        {{  session()->get('message') }}
    </div>
@endif

<div class="table-responsive">

    @if(count($addresses) > 0)
        <table class="table table-light table-striped table-hover">
            <thead>
                <th> # </th>
                <th> Area Name </th>
                <th> Street Name </th>
                <th> Building Number </th>
                <th> Role Number </th>
                <th> Apartment Number </th>
                <th> Description </th>
                <th> City </th>
                <th> Country  </th>
                <th> Status</th>
                <th> Action </th>
            </thead>
            <tbody>
                @foreach ($addresses as $address)
                    <tr id="address{{$address->id}}">
                        <td> <a href="/admin/address/{{ $address->id }}"> {{  $address->id }} </a> </td>
                        <td> {{ $address->region }} </td>
                        <td> {{ $address->street }} </td>
                        <td> {{ $address->building_number }} </td>
                        <td> {{ $address->floor_number }} </td>
                        <td> {{ $address->apartment_number }} </td>
                        <td> {{ $address->address }} </td>
                        <td> {{  $address->city }} </td>
                        <td> {{  $address->country  }} </td>
                        <td>
                            @if($address->status == 1)
                                <span class="bg bg-success text-white text-sm px-2 rounded-pill statusBackground{{ $address->id }}">Active </span>
                            @else
                                <span class="bg bg-danger text-white text-sm px-2 rounded-pill statusBackground{{ $address->id }}">InActive </span>
                            @endif
                        </td>
                        <td>
                            <span> <a href="/admin/address/{{ $address->id }}"> <i class="fas fa-edit text-info mr-2 cursor"></i> </a> </span>
                            <span> <a data-toggle="modal" data-target="#toggleStatuts" onclick="setAddressId({{ $address->id }})" class="cursor"> 
                                <i style="cursor: pointer;" class="statusIcon{{ $address->id }} @if($address->status == 1) text-success fas fa-map-marker-alt @else fas fa-map-marker-alt text-danger @endif"></i> </a></span>
                                {{-- <span> <a onclick="deleteaddress({{ $address->id }})"> <i class="fas fa-trash ml-4 text-danger cursor   "></i> </a> </span> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="container">
            {{ $addresses->appends(request()->query())->links("pagination::bootstrap-4")}}
        
         </div>

    @else 

    {{-- Empty Data Alert --}}
    <div class="bg rounded bg-info  text-white p-2 m-2">
        there is no address to show for this user
    </div>

    @endif

</div>
</div>
</main>
@endsection


<!-- Modal To Toggle Status-->
<div class="modal fade" id="toggleStatuts" tabindex="-1" role="dialog" aria-labelledby="toggleStatutsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="toggleStatutsLabel">Change Address Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure that you want to Change Address Status  ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="ChangeAddressStatus()">Change</button>
        </div>
      </div>
    </div>
  </div>

<script>

// variables
address_id = null;

// this method to hide alert message after a specific number of seconds
setTimeout(()=> {
    $('.alert-message').hide();
}, 3000);


// method to set address id
function setAddressId(id) {
    address_id = id;
}

// method to change address status
function ChangeAddressStatus () {
    // Send Ajax Request to changer order status
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:'POST',
        url:'/admin/address/' + address_id,
        data: { 
            _method: "DELETE" ,
            _token: _token
        },
        success:function(data) {
            // toggle class
            $('.statusBackground' + address_id).toggleClass('bg-success bg-danger');
            $(".statusIcon" + address_id).toggleClass('fa-map-marker-alt fa-map-marker-alt');
            $(".statusIcon" + address_id).toggleClass('text-danger text-success');

            if ( $('.statusBackground' + address_id).hasClass('bg-success') ) {
                $('.statusBackground' + address_id).html("Active");
            } else {
                $('.statusBackground' + address_id).html("InActive")
            }          
        },
        fail: function(fail){
            console.log(fail);
        }
    });

    // after change status close the popup modal
    $('#toggleStatuts').modal('hide');
}

function deleteaddress (id) {
    alertify.confirm("Are you sure that you want to delete Address",
    function(){
        // user say ok

    // Send Ajax Request to changer order status
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:'POST',
            url:'/admin/delete-address/' + id,
            data: { 
                _token: _token
            },
            success:function(data) {
                $("#address" + id).hide("slow");
                alertify.success('Address Deleteed Successfully ');
            },
            fail: function(fail){
                alertify.error('Failed to Delete Address , try again later !!');
            }
        });
});

}

</script>