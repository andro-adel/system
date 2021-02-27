<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\images;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class customerController extends Controller
{

    function index()
    {
  
      $customer =  new students();
  
      if (request('search')) {
        $customer =
          $customer->where('name', 'like', '%' . request('search') . '%')
          ->orwhere('phonenumber', 'like', '%' . request('search') . '%')
          ->orwhere('email', 'like', '%' . request('search') . '%');
      }
  
      $customer = $customer->paginate(20);
  
      return view('admin.manage-users.index', [
        'customers' => $customer
      ]);
    }
  
    function create()
    {
      return view('admin.manage-users.create');
    }
  
    function store(Request $request)
    {
  
      request()->validate([
        'username' => 'required|string|min:2|max:50',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|numeric|unique:users,phonenumber',
        'status' => 'required|boolean',
        'studentclass' => 'nullable|string',
        'marital_status' => 'nullable|string',
        'gender' => 'nullable|string',
        'nationality' => 'nullable|string',
        'dateofbirth' => 'nullable|date|date_format:Y-m-d',
        'religion' => 'nullable|string',
        'nameofschool' => 'nullable|string',
        'image' => 'mimes:jpeg,jpg,png,gif|max:2000'
      ]);
      // save customer object
      $customer = new students();
      $customer->name = request('username');
      $customer->email  = request('email');
      $customer->phonenumber  = request('phone');
      $customer->status = request('status');
      $customer->studentclass = request('studentclass');
      $customer->marital_status = request('marital_status');
      $customer->gender = request('gender');
      $customer->nationality = request('nationality');
      $customer->dateofbirth = request('dateofbirth');
      $customer->religion = request('religion');
      $customer->nameofschool = request('nameofschool');
      $customer->save();
  
      // if there is an image so , save it
      if (request('image')) {
        $path = Storage::disk('public')->put('users', request('image'));
        $image =  new images();
        $image->image = $path;
        $image->imageable_type = "App\\Models\\users";
        $image->imageable_id =  $customer->id;
        $image->save();
      }
  
      return redirect('/admin/manage-users')->with('message', 'student: ' . $customer->name . ' added successsfully');
    }
  
    function show($id)
    {
      $customer = students::findOrFail($id);
      return view('admin.manage-users.edit', [
        'customer' => $customer
      ]);
    }
  
    function update($id)
    {
      // get the customer
      $customer = students::findOrFail($id);
  
      // check values
      request()->validate([
        'username' => 'required|string|min:2|max:50',
        'email' => 'required|email|unique:users,email,'  . $id,
        'phone' => 'required|numeric|unique:users,phonenumber,' . $id,
        'password' => 'nullable|min:6',
        'status' => 'required|boolean',
        'studentclass' => 'nullable|string',
        'marital_status' => 'nullable|string',
        'gender' => 'nullable|string',
        'nationality' => 'nullable|string',
        'dateofbirth' => 'nullable|date|date_format:Y-m-d',
        'religion' => 'nullable|string',
        'nameofschool' => 'nullable|string',
        'image' => 'mimes:jpeg,jpg,png,gif|max:2000'
      ]);
  
      $customer->name = request('username');
      $customer->email  = request('email');
      $customer->password = Hash::make(request('password'));
      $customer->phonenumber  = request('phone');
      $customer->status = request('status');
      $customer->studentclass = request('studentclass');
      $customer->marital_status = request('marital_status');
      $customer->gender = request('gender');
      $customer->nationality = request('nationality');
      $customer->dateofbirth = request('dateofbirth');
      $customer->religion = request('religion');
      $customer->nameofschool = request('nameofschool');
      $customer->save();
  
      if (request('image')) {
        // if user dont have image 
        if ($customer->image) {
          Storage::delete($customer->image->image);
          $path = Storage::disk('public')->put('users', request('image'));
          $customer->image->image = $path;
          $customer->image->save();
        } else {
          $path = Storage::disk('public')->put('users', request('image'));
          $image =  new images();
          $image->image = $path;
          $image->imageable_type = "App\\Models\\users";
          $image->imageable_id =  $customer->id;
          $image->save();
        }
      }
  
      return redirect('/admin/manage-users')->with('message', 'student: ' . $customer->name . ' updated successsfully');
    }
  
    public function destroy($id)
    {
      $customer = students::findOrFail($id);
      $customer->status = !$customer->status;
      $customer->save();
      return response()->json('student status change successfully', 200);
    }
  
    public function delete($id)
    {
      try {
        $customer = students::findOrFail($id);
        $customer->delete();
        return response()->json("student deleted successfully");
      } catch (\Exception $e) {
        return response($e->getMessage(), 400);
      }
    }
  }