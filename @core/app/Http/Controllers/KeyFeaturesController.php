<?php

namespace App\Http\Controllers;

use App\KeyFeatures;
use App\Language;
use Illuminate\Http\Request;

class KeyFeaturesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_key_features = KeyFeatures::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.pages.key-features')->with(['all_key_features' => $all_key_features,'all_languages' => $all_languages]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'description' => 'required|string',
            'image' => 'mimes:jpe,jpeg,png|max:6064'
        ]);
        $id = KeyFeatures::create($request->all())->id;
        if ($request->hasFile('image')){
            $image = $request->image;
            $image_extenstion = $request->image->getClientOriginalExtension();
            $image_ext = $image_extenstion;
            $image_name = 'key-feature-pic-' . $id . '.' . $image_extenstion;
            if (check_image_extension($request->image)) {
                $image->move('assets/uploads/key-feature/', $image_name);
                KeyFeatures::where('id',$id)->update(['image' => $image_ext]);
            }
        }
        return redirect()->back()->with(['msg' => 'New Key Feature Added...','type' => 'success']);
    }

    public function update(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'description' => 'required|string',
            'image' => 'mimes:jpe,jpeg,png|max:6064'
        ]);
        KeyFeatures::find($request->id)->update($request->all());
        if ($request->hasFile('image')){
            $image = $request->image;
            $image_extenstion = $request->image->getClientOriginalExtension();
            $image_ext = $image_extenstion;
            $image_name = 'key-feature-pic-' . $request->id . '.' . $image_extenstion;
            if (check_image_extension($request->image)) {
                $image->move('assets/uploads/key-feature/', $image_name);
                KeyFeatures::where('id',$request->id)->update(['image' => $image_ext]);
            }
        }
        return redirect()->back()->with(['msg' => 'Key Feature Updated...','type' => 'success']);
    }

    public function delete($id){
        KeyFeatures::find($id)->delete();
        return redirect()->back()->with(['msg' => 'Delete Success...','type' => 'danger']);
    }

    public function update_section_settings(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){

            $this->validate($request,[
               'home_01_'.$lang->slug.'_key_feature_section_title' => 'nullable|string',
               'home_01_'.$lang->slug.'_key_feature_section_description' => 'nullable|string',
            ]);

            $filed_one = 'home_01_'.$lang->slug.'_key_feature_section_title';
            $filed_two = 'home_01_'.$lang->slug.'_key_feature_section_description';
            update_static_option('home_01_'.$lang->slug.'_key_feature_section_title',$request->$filed_one);
            update_static_option('home_01_'.$lang->slug.'_key_feature_section_description', $request->$filed_two);
        }
        return redirect()->back()->with(['msg' => 'Settings Updated...','type' => 'success']);
    }
}
