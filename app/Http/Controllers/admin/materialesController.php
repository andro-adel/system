<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\materiales;
use App\Models\students;
use Illuminate\Http\Request;

class materialesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = students::findOrFail(request('student_id'));

        $material = materiales::where('student_id', $student->id);

        if (request('search')) {
            $material =
                $material->where('materialgrade', 'like', '%' . request('search') . '%')
                ->orwhere('materialname', 'like', '%' . request('search') . '%');
        }

        $material = $material->paginate(10);

        return view('admin.manage-material.index', [
            'student' => $student,
            'materiales' =>  $material
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = students::findOrFail(request('student_id'));
        return view('admin.manage-material.create', [
            'student' => $student
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
            'materialname' => 'required|string',
            'materialgrade' => 'required|string',
            'status' => 'required|boolean',
            'student_id' => 'required|exists:students,id'
        ]);

        // get the student object
        $student = students::findOrFail(request('student_id'));
        // save address for that user
        $material =  new materiales();
        $material->student_id  = $student->id;
        $material->status = request('status');
        $material->materialname = request('materialname');
        $material->materialgrade = request('materialgrade');
        $material->save();

        
        return redirect('/admin/material?student_id=' . $student->id)->with('message', 'material for : ' . $student->name . ' added successsfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = materiales::findOrFail($id);

        return view('admin.manage-material.edit', [
            'address' => $address,
        ]);
    }

    public function update($id)
    {
        $address = materiales::findOrFail($id);

        // check values
        request()->validate([
            'status' => 'required|boolean',
        ]);

        $address->status = request('status');
        $address->save();
        return redirect('/admin/address?user_id=' . $address->user->id)->with('message', 'address: ' . $address->name . ' updated successsfully');
    }

    public function assignAttributes($id)
    {
        request()->validate([
            'materialname' => 'required|array',
            'materialname.*' => 'required|string',
            'materialgrade' => 'required|array',
            'materialgrade.*' => 'required|string',

        ]);
        $product_variarnce = students::findOrFail($id);
        $product_variarnce->attributes()->delete();
        // save variarnce weight and prices
        foreach (request('prices') as $index => $price) {
            $attribute = new materiales();
            $attribute->materialname = request('prices')[$index];
            $attribute->materialgrade = request('weights')[$index];
            $attribute->product_variance_id = $product_variarnce->id;
            $attribute->save();
        }
        return redirect()->back()->with('message', 'product variance: updated successsfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = materiales::findOrFail($id);
        $address->status = !$address->status;
        $address->save();
        return response()->json('address status change successfully', 200);
    }

    public function delete($id)
    {
        try {
            $address = materiales::findOrFail($id);
            $address->delete();
            return response()->json("address deleted successfully");
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }
}