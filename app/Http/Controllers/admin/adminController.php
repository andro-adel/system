<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\images;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{

    function index()
    {
  
      $admins =  new users();
  
      if (request('search')) {
        $admins =
          $admins->where('name', 'like', '%' . request('search') . '%')
          ->orwhere('phonenumber', 'like', '%' . request('search') . '%')
          ->orwhere('email', 'like', '%' . request('search') . '%');
      }
  
      $admins = $admins->paginate(20);
  
      return view('admin.manage-admins.index', [
        'admins' => $admins
  
      ]);
    }
  
    function create()
    {
      return view('admin.manage-admins.create');
    }
  
    function store(Request $request)
    {
  
      request()->validate([
        'username' => 'required|string|min:2|max:50',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|numeric|unique:users,phonenumber',
        'password' => 'nullable|min:6',
        'status' => 'required|boolean',
        'type' => 'required|boolean',
        'image' => 'mimes:jpeg,jpg,png,gif|max:2000'
      ]);
      // save admin object
      $admin = new users();
      $admin->name = request('username');
      $admin->type = request('type');
      $admin->email  = request('email');
      $admin->password = Hash::make(request('password'));
      $admin->phonenumber  = request('phone');
      $admin->status = request('status');
      $admin->save();
  
      // if there is an image so , save it
      if (request('image')) {
        $path = Storage::disk('public')->put('users', request('image'));
        $image =  new images();
        $image->image = $path;
        $image->imageable_type = "App\\Models\\users";
        $image->imageable_id =  $admin->id;
        $image->save();
      }
  
      return redirect('/admin/manage-admins')->with('message', 'user: ' . $admin->name . ' added successsfully');
    }
  
    function show($id)
    {
      $admin = users::findOrFail($id);
      return view('admin.manage-admins.edit', [
        'admin' => $admin
      ]);
    }
  
    function update($id)
    {
      // get the admin
      $admin = users::findOrFail($id);
  
      // check values
      request()->validate([
        'username' => 'required|string|min:2|max:50',
        'email' => 'required|email|unique:users,email,'  . $id,
        'phone' => 'required|numeric|unique:users,phonenumber,' . $id,
        'password' => 'nullable|min:6',
        'status' => 'required|boolean',
        'type' => 'required|boolean',
        'image' => 'mimes:jpeg,jpg,png,gif|max:2000'
      ]);
  
      $admin->name = request('username');
      $admin->email  = request('email');
      if (request('password')) {
        $admin->password = Hash::make(request('password'));
      }
      $admin->phonenumber  = request('phone');
      $admin->status = request('status');
      $admin->type = request('type');
      $admin->save();
  
      if (request('image')) {
        // if user dont have image 
        if ($admin->image) {
          Storage::delete($admin->image->image);
          $path = Storage::disk('public')->put('users', request('image'));
          $admin->image->image = $path;
          $admin->image->save();
        } else {
          $path = Storage::disk('public')->put('users', request('image'));
          $image =  new images();
          $image->image = $path;
          $image->imageable_type = "App\\Models\\users";
          $image->imageable_id =  $admin->id;
          $image->save();
        }
      }
  
      return redirect('/admin/manage-admins')->with('message', 'user: ' . $admin->name . ' updated successsfully');
    }
  
    public function destroy($id)
    {
      $admin = users::findOrFail($id);
      $admin->status = !$admin->status;
      $admin->save();
      return response()->json('user status change successfully', 200);
    }

    public function change($id)
    {
      $admin = users::findOrFail($id);
      $admin->type = !$admin->type;
      $admin->save();
      return response()->json('user type change successfully', 200);
    }

    public function delete($id)
    {
        try {
            $admin = users::findOrFail($id);
            $admin->delete();
            return response()->json("user deleted successfully");
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }
}
  