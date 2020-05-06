<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Blog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRoleManageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin','capability']);

    }
    public function new_user(){
        return view('backend.user-role-manage.add-new-user');
    }
    public function new_user_add(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'username' => 'required|string|max:191|unique:admins',
            'email' => 'required|email|max:191',
            'role' => 'required|string|max:191',
            'image' => 'mimes:jpg,jpeg,png|max:2064',
            'password' => 'required|min:8|confirmed'
        ]);

       $id =  Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ])->id;

        if ($request->hasFile('image')){
            $image = $request->image;
            $image_extenstion = $request->image->getClientOriginalExtension();
            $image_name = 'admin-pic-'.$id .'.'.$image_extenstion;
            if (check_image_extension($request->image)){
                $image->move('assets/uploads/admins',$image_name);
                Admin::find($id)->update(['image' => $image_extenstion]);
            }
        }

        return redirect()->back()->with(['msg' => 'New User Added Success','type' =>'success' ]);
    }

    public function all_user(){

        $all_user = Admin::all()->except(Auth::id());
        return view('backend.user-role-manage.all-user')->with(['all_user' => $all_user]);
    }
    public function user_update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'role' => 'required|string|max:191',
            'image' => 'mimes:jpg,jpeg,png|max:2064'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];
        
        if (!empty($request->password) && !empty($request->password_confirmation)){
            $data['password'] = Hash::make($request->password);
        }
        Admin::find($request->user_id)->update($data);

        if ($request->hasFile('image')){
            $image = $request->image;
            $image_extenstion = $request->image->getClientOriginalExtension();
            $image_name = 'admin-pic-'.$request->user_id .'.'.$image_extenstion;
            if (check_image_extension($request->image)){
                $image->move('assets/uploads/admins',$image_name);
                Admin::find($request->user_id)->update(['image' => $image_extenstion]);
            }
        }

        return redirect()->back()->with(['msg' => 'User Details Updated','type' =>'success' ]);
    }
    public function new_user_delete(Request $request,$id){
        $blog_post = Blog::where('user_id',$id)->first();
        if (!empty($blog_post)){
            return redirect()->back()->with(['msg' => 'You can not delete this user, because this user already acclimate with a blog post','type' =>'waning' ]);
        }
        $admin = Admin::find($id);
        if (file_exists('assets/uploads/admins/admin-pic-'.$id.'.'.$admin->image)){
            unlink('assets/uploads/admins/admin-pic-'.$id.'.'.$admin->image);
        }
        $admin->delete();
        return redirect()->back()->with(['msg' => 'User Deleted','type' =>'danger' ]);
    }
    public function user_password_change(Request $request){
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = Admin::findOrFail($request->ch_user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with(['msg'=>'Password Change Success..','type'=> 'success']);

    }
}
