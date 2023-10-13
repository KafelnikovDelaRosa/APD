<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AdminController extends Controller
{

    public function admindashboard()
    {
        return view('admin/admindashboard');
    }
    public function adminchallenges(){
        return view('admin/adminchallenges');
    }
    public function adminsubmissions()
    {
        return view('admin/adminsubmissions');
    }
    

    public function adminnews()
    {
        return view('admin/adminnews');
    }
    
    public function adminusers()
    {
        //return view('admin/adminusers');
        $data = User::all();
        return view('admin/adminusers', ['users'=>$data]);
    }

    public function adminadmins()
    {
        $data=DB::table('admins')->get();
        return view('admin/adminadmins',['admins'=>$data]);
    }
    public function deleteAdmin(Request $request){
        $data=$request->all();
        DB::table('admins')
        ->where('studentid',$data['studentid'])
        ->delete();
        return response()->json(["success"=>true]);
    }
    public function deleteUser(Request $request){
        $data=$request->all();
        DB::table('users')
        ->where('studentid',$data['studentid'])
        ->delete();
        return response()->json(["success"=>true]);
    }

    public function create(array $data)
    {
        return DB::table('news')
        ->insert([
            'title' => $data['title'],
            'content' => $data['content'],
            'author' => $data['author'],
        ]);
    }

    public function post(Request $request)
    {  
        $data = $request->all();
        $check = $this->create($data);  
        return response()->json(["success"=>true]);
    }
    public function adminLogout(){
        Session::flush();
        Auth::logout();
        return redirect('/loginpage');
    }
}
