<?php

namespace App\Http\Controllers;

use App\ContactInfoItem;
use App\Language;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_contact_info = ContactInfoItem::all()->groupBy('lang');
        $all_language = Language::all();
        return view('backend.pages.contact-info')->with(['all_contact_info' => $all_contact_info,'all_languages' => $all_language]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'description' => 'required|string',
        ]);
        ContactInfoItem::create($request->all());
        return redirect()->back()->with(['msg' => 'New Contact Info Item Added...','type' => 'success']);
    }

    public function update(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'description' => 'required|string',
        ]);
        ContactInfoItem::find($request->id)->update($request->all());
        return redirect()->back()->with(['msg' => 'Contact Info Item Updated...','type' => 'success']);
    }

    public function delete($id){
        ContactInfoItem::find($id)->delete();
        return redirect()->back()->with(['msg' => 'Delete Success...','type' => 'danger']);
    }

    public function contact_info_title(Request $request){
        $all_language = Language::all();

        foreach ($all_language as $lang){

            $this->validate($request,[
                'contact_page_'.$lang->slug.'_contact_info_title' => 'nullable|string|max:191',
            ]);
            $field = 'contact_page_'.$lang->slug.'_contact_info_title';
            update_static_option('contact_page_'.$lang->slug.'_contact_info_title',$request->$field);

        }

        return redirect()->back()->with(['msg' => 'Settings Updated...','type' => 'success']);
    }
}
