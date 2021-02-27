<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\images;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class homeController extends Controller
{
    public function index()
    {
        $lang = Lang::locale();

        return view('website.home', [
            "lang" => $lang,
        ]);
    }

    public function switch_language()
    {
        $lang = request('lang');
        if (!in_array($lang, ['ar', 'en'])) {
            return response()->json("pelase enter a valid languages", 400);
        } else {
            App::setLocale($lang);
            Session::put('lang', $lang);
            return redirect()->back();
        }
    }

    function create()
    {
      return view('website.home');
    }

    public function store(Request $request)
    {
  
      request()->validate([
        'name' => 'required|string|min:2|max:50',
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
      $customer->name = request('name');
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
        $path = Storage::disk('public')->put('students', request('image'));
        $image =  new images();
        $image->image = $path;
        $image->imageable_type = "App\\Models\\students";
        $image->imageable_id =  $customer->id;
        $image->save();
      }
  
      return redirect('/verifymail');
    }
}
