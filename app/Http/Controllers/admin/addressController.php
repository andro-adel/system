<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\address;
use App\Models\users;
use Illuminate\Http\Request;

class addressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = users::findOrFail(request('user_id'));

        $address = address::where('user_id', $user->id);

        if (request('search')) {
            $address =
                $address->where('address', 'like', '%' . request('search') . '%')
                ->orwhere('region', 'like', '%' . request('search') . '%')
                ->orwhere('street', 'like', '%' . request('search') . '%')
                ->orwhere('city', 'like', '%' . request('search') . '%')
                ->orwhere('country', 'like', '%' . request('search') . '%');
        }

        $address = $address->paginate(10);

        return view('admin.manage-address.index', [
            'user' => $user,
            'addresses' =>  $address
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = users::findOrFail(request('user_id'));
        return view('admin.manage-address.create', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'address' => 'nullable|string',
            'region' => 'required|string',
            'street' => 'required|string',
            'building_number' => 'required|numeric',
            'floor_number' => 'required|numeric',
            'apartment_number' => 'required|numeric',
            'city' => 'nullable|string|min:3',
            'country' => 'required|string|min:3',
            'status' => 'required|boolean',
            'user_id' => 'required|exists:users,id'
        ]);

        // get the user object
        $user = users::findOrFail(request('user_id'));
        // save address for that user
        $address =  new address();
        $address->address = request('address');
        $address->region = request('region');
        $address->street = request('street');
        $address->building_number = request('building_number');
        $address->floor_number = request('floor_number');
        $address->apartment_number = request('apartment_number');
        $address->city = request('city');
        $address->country = request('country');
        $address->user_id  = $user->id;
        $address->status = request('status');
        $address->save();
        return redirect('/admin/address?user_id=' . $user->id)->with('message', 'address for : ' . $user->name . ' added successsfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = address::findOrFail($id);

        return view('admin.manage-address.edit', [
            'address' => $address,
        ]);
    }

    public function update($id)
    {
        $address = address::findOrFail($id);

        // check values
        request()->validate([
            'address' => 'nullable|string',
            'region' => 'required|string',
            'street' => 'required|string',
            'building_number' => 'required|numeric',
            'floor_number' => 'required|numeric',
            'apartment_number' => 'required|numeric',
            'city' => 'nullable|string|min:3',
            'country' => 'required|string|min:3',
            'status' => 'required|boolean'
        ]);

        $address->address = request('address');
        $address->region = request('region');
        $address->street = request('street');
        $address->building_number = request('building_number');
        $address->floor_number = request('floor_number');
        $address->apartment_number = request('apartment_number');
        $address->city = request('city');
        $address->country = request('country');
        $address->status = request('status');
        $address->save();
        return redirect('/admin/address?user_id=' . $address->user->id)->with('message', 'address: ' . $address->name . ' updated successsfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = address::findOrFail($id);
        $address->status = !$address->status;
        $address->save();
        return response()->json('address status change successfully', 200);
    }

    public function delete($id)
    {
        try {
            $address = address::findOrFail($id);
            $address->delete();
            return response()->json("address deleted successfully");
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }
}
