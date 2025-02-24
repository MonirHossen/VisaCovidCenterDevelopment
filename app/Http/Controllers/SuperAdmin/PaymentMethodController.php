<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods= PaymentMethod::all();
        return view('SuperAdmin.method.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('SuperAdmin.method.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,JPG',
            'status' => 'required',
        ]);

        if($request->hasFile('image')){
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/paymentMethod/';
            $image_new_name    = $request->name.'_payment_method_'.now()->timestamp.'.'.$image->getClientOriginalExtension();

            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $data['image'] = $folder_path.$image_new_name;
        }
        $data['name'] = $request->name;
        $data['status'] = $request->status;

        try {
            PaymentMethod::create($data);
            // return back()->withToastSuccess('Successfully saved.');
            Session::flash('message', 'Successfully saved.');
            Session::flash('type', 'success');
            return back();
        } catch (\Exception $exception) {
            return back()->withErrors('Something went wrong. ' . $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentMethod= PaymentMethod::findOrFail($id);
        return view('SuperAdmin.method.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpeg,png,jpg,JPG',
            'status' => 'required',
        ]);

        $paymentMethod= PaymentMethod::findOrFail($id);

        if($request->hasFile('image')){
            if ($paymentMethod->image != null)
            {
                File::delete(public_path($paymentMethod->image)); //Old image delete
            }

            $image             = $request->file('image');
            $folder_path       = 'uploads/images/paymentMethod/';
            $image_new_name    = $paymentMethod->name.'_payment_method_'.now()->timestamp.'.'.$image->getClientOriginalExtension();

            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $img = $folder_path.$image_new_name;
        }else{
            $img = $paymentMethod->image;
        }

        $paymentMethod->name = $request->name;
        $paymentMethod->image = $img;
        $paymentMethod->status = $request->status;

        //return $data;
        try {
            $paymentMethod->save();

            // return back()->withToastSuccess('Successfully updated.');
            Session::flash('message', 'Updated successfully!');
            Session::flash('type', 'success');
            return back();
        } catch (\Exception $exception) {
            return back()->withErrors('Something went wrong. ' . $exception->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        try {
            if ($paymentMethod->image != null){
                File::delete(public_path($paymentMethod->image)); //Old image delete
            }
            $paymentMethod->delete();

            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Deleted !!',
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'type' => 'error',
            ]);
        }
    }
}
