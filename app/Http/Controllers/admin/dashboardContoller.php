<?php

namespace App\Http\Controllers\admin;

use App\Models\address;
use App\Http\Controllers\Controller;
use App\Models\images;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class dashboardContoller extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        $user = users::findOrFail(Auth::user()->id);
        return view('admin.profile', [
            'user' => $user,
        ]);
    }

    public function updateProfile()
    {
        $id = request("user_id");
        request()->validate([
            "user_id" => "required|numeric|exists:users,id",
            'name' => 'required|string|min:2|max: 50',
            'email' => 'required|email|unique:users,email,'  . $id,
            'phone' => 'required|numeric|unique:users,phonenumber,' . $id,
            'password' => 'nullable|min:6',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2000'
        ]);

        $user = users::findOrFail($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->phoneNumber  = request('phone');

        // if user want to update his password 
        if (request('password')) {
            $user->password = Hash::make(request('password'));
        }
        $user->save();

        if (request('image')) {
            // if user dont have image 
            if ($user->image) {
                Storage::delete($user->image->image);
                $path = Storage::putFile('users', request('image'));
                $user->image->image = $path;
                $user->image->save();
            } else {
                $path = Storage::putFile('users', request('image'));
                $image =  new images();
                $image->image = $path;
                $image->imageable_type = "App\\Models\\users";
                $image->imageable_id =  $user->id;
                $image->save();
            }
        }

        return redirect('/admin/profile')->with('message', 'user profile updated');
    }

    public function saveAddress()
    {
        request()->validate([
            "address" => "nullable|string",
            'region' => 'required|string',
            'street' => 'required|string',
            'building_number' => 'required|numeric',
            'floor_number' => 'required|numeric',
            'apartment_number' => 'required|numeric',
            'city' => "required|string",
            'country' => "required|string",
        ]);

        $address =  new address();
        $address->address = request('address');
        $address->region = request('region');
        $address->street = request('street');
        $address->building_number = request('building_number');
        $address->floor_number = request('floor_number');
        $address->apartment_number = request('apartment_number');
        $address->city = request('city');
        $address->country = request('country');
        $address->user_id  = Auth::user()->id;
        $address->save();

        return redirect('/admin/profile')->with('message', 'user Address Created Successfully');
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
