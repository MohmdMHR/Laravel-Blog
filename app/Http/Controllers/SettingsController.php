<?php

namespace LaravelBlog\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;
use LaravelBlog\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    //Updating profile settings
    public function update(){

        $this->validate(request(), [
        'site_name'=>'required',
        'address'=>'required',
        'contact_number'=>'required',
        'contact_email'=>'required'
        ]);

        $settings = Setting::first();

        $settings->site_name=request()->site_name;
        $settings->address=request()->address;
        $settings->contact_email=request()->contact_email;
        $settings->contact_number=request()->contact_number;

        $settings->save();


        Toastr::success('Settings Updated');

        return redirect()->back();

    }


    public function index(){

        return view('settings.settings')->with('settings', Setting::first());

    }

}
