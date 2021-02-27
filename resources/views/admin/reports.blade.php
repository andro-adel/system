@extends('admin.layout.master')

@section('body')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
<div class="header my-3">
    <h3 class=" float-left"> Order Report </h3>
    <div class="clearfix"></div>
    <div class="w-100 d-flex flex-row justify-content-between align-item-center">
         {{-- left search  --}}
         <div class="float-left d-flex flex-row align-items-center justify-content-center">
            <form method="post" action="/admin/order-reports?type=csv">
                @csrf
                <input type="hidden" name="date_from" value="{{ request('date_from') }}" >
                <input type="hidden" name="date_to" value="{{ request('date_to') }}" >
                <button class="btn btn-success btn-sm mr-2"> Excel</button>
            </form>

            <form method="post" action="/admin/order-reports?type=pdf">
                @csrf
                <input type="hidden" name="date_from" value="{{ request('date_from') }}" >
                <input type="hidden" name="date_to" value="{{ request('date_to') }}" >
                <button class="btn btn-danger btn-sm"> PDF</button>
            </form>

         </div>
        <form  method="get" action="/admin/reports">
            {{-- right search  --}}
            <div class="float-right d-flex flex-row align-items-center justify-content-center">
                <div class="form-group mt-1 ">
                    <label> From Date</label>
                    <input type="date" class="form-control" placeholder="date from" name="date_from" >
                </div>

                <div class="form-group mt-1  ml-2">
                    <label> To Date</label>
                    <input type="date" placeholder="date to" class="form-control" name="date_to" >
                </div>
                <div class="form-group mt-1  ml-2">
                    <button class="btn btn-primary btn-sm text-white "> Filter </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive">

    <table class="table table-light table-striped table-hover">
    <thead>
        <th> Student ID </th>
        <th> Student Name </th>
        <th> Student Email </th>
        <th> Student Grade </th>
        <th> Student Material </th>
        <th> Material Grade </th>
    </thead>
    <tbody>
        
        @foreach ($orders as $order)
        <tr>
            <td> {{ $order->id }}</td>
            <td> {{ $order->name }} </td>
            <td> {{ $order->email }} </td> 
            <td> {{ $order->studentclass }} </td> 
            <td>
                @foreach ($order->materiales as $material)
                    <p class="bg bg-light text-secondary rounded px-2 py-1 mb-2 text-sm font-weight-bolder"> {{  $material->materialname }}</p>
                @endforeach    

                @if (count($order->materiales) == 0) 
                    <p class="bg bg-warning text-white  rounded px-2 py-1 mb-2 text-sm font-weight-bolder"> No material</p>
                @endif
            </td>
            <td>
                @foreach ($order->materiales as $material)
                    <p class="bg bg-light text-secondary rounded px-2 py-1 mb-2 text-sm font-weight-bolder"> {{  $material->materialgrade }}</p>
                @endforeach    

                @if (count($order->materiales) == 0) 
                    <p class="bg bg-warning text-white  rounded px-2 py-1 mb-2 text-sm font-weight-bolder"> No material</p>
                @endif
            </td>
            {{-- <td> {{ $order->materiales[0]->materialname }} </td>
            <td> {{ $order->materiales[0]->materialgrade }} </td> --}}
        </tr>
        @endforeach

        
    </tbody>
 </table>

 <div class="container">
    {{ $orders->appends(request()->query())->links("pagination::bootstrap-4")}}
 </div>

</div>
</div>
</main>
@endsection
