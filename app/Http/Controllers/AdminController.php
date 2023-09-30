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
        return view('admin/adminadmins');
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
}
