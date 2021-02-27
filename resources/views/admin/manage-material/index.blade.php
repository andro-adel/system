@extends('admin.layout.master')

@section('body')
  
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
<div class="header my-3">
    <h5 class=" float-left"> Manage material For <b>{{ $student->name }}</b> </h5>
    <a class="float-right btn btn-success cursor text-white" href="{{  '/admin/material/create?student_id='. $student->id }}"> 
        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
        Create material
    </a>
    <div class="clearfix"></div>
    <form class="w-50" method="GET" action="/admin/material">
        <div class="form-group mt-1 d-flex flex-row">
            <input type="hidden" name="user_id" value="{{ $student->id }}" >
            <input class="form-control d-inline-block" placeholder="Search for material" name="search">
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

    @if($materiales)
        <table class="table table-light table-striped table-hover">
            <thead>
                <th> # </th>
                <th> material name </th>
                <th> material grade </th>
                <th> Status</th>
                {{-- <th> Action </th> --}}
            </thead>
            <tbody>
                @foreach ($materiales as $material)
                    <tr id="address{{$material->id}}">
                        <td> <a href="/admin/address/{{ $material->id }}"> {{  $material->id }} </a> </td>
                        <td> {{ $material->materialname }} </td>
                        <td> {{ $material->materialgrade }} </td>
                        <td>
                            @if($material->status == 1)
                                <span class="bg bg-success text-white text-sm px-2 rounded-pill statusBackground{{ $material->id }}">Active </span>
                            @else
                                <span class="bg bg-danger text-white text-sm px-2 rounded-pill statusBackground{{ $material->id }}">InActive </span>
                            @endif
                        </td>
                        {{-- <td> --}}
                            {{-- <span> <a href="/admin/address/{{ $material->id }}"> <i class="fas fa-edit text-info mr-2 cursor"></i> </a> </span> --}}
                            {{-- <span> <a data-toggle="modal" data-target="#toggleStatuts" onclick="setAddressId({{ $material->id }})" class="cursor">  --}}
                                {{-- <i style="cursor: pointer;" class="statusIcon{{ $material->id }} @if($material->status == 1) text-success fas fa-check @else fas fa-times text-danger @endif"></i> </a></span> --}}
                                {{-- <span> <a onclick="deleteaddress({{ $address->id }})"> <i class="fas fa-trash ml-4 text-danger cursor   "></i> </a> </span> --}}
                        {{-- </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="container">
            {{ $materiales->appends(request()->query())->links("pagination::bootstrap-4")}}
        
         </div>

    @else 

    {{-- Empty Data Alert --}}
    <div class="bg rounded bg-info  text-white p-2 m-2">
        there is no material to show for this user
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
          <h5 class="modal-title" id="toggleStatutsLabel">Change material Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure that you want to Change material Status  ?
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
material_id = null;

// this method to hide alert message after a specific number of seconds
setTimeout(()=> {
    $('.alert-message').hide();
}, 3000);


// method to set address id
function setAddressId(id) {
    material_id = id;
}

// method to change address status
function ChangeAddressStatus () {
    // Send Ajax Request to changer order status
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:'POST',
        url:'/admin/material/' + material_id,
        data: { 
            _method: "DELETE" ,
            _token: _token
        },
        success:function(data) {
            // toggle class
            $('.statusBackground' + material_id).toggleClass('bg-success bg-danger');
            $(".statusIcon" + material_id).toggleClass('fa-check fa-times');
            $(".statusIcon" + material_id).toggleClass('text-danger text-success');

            if ( $('.statusBackground' + material_id).hasClass('bg-success') ) {
                $('.statusBackground' + material_id).html("Active");
            } else {
                $('.statusBackground' + material_id).html("InActive")
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


