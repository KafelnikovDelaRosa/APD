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

    public function adminMultipleChoice(){
        return view('admin/codequest/multiplechoice');
    }

    public function adminFrontEnd(){
        $data=DB::table('frontend')->get();
        return view('admin/codequest/frontend',['challenges'=>$data]);
    }

    public function multipleChoiceForm(){
        return view('admin/codequest/postmultiplechoice');
    }

    public function frontEndForm(){
        return view('admin/codequest/postfrontend');
    }
    
    public function backEndForm(){
        return view('admin/codequest/postbackend');
    }

    public function editBackEndForm($id){
        $data=DB::table('backend')
        ->where('id',$id)
        ->get();
        return view('admin/codequest/editbackend',['values'=>$data,'id'=>$id]);
    }
    
    public function adminBackEnd(){
        $data=DB::table('backend')->get();
        return view('admin/codequest/backend',['challenges'=>$data]);
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

    public function postFrontEnd(Request $request){
        if($request->hasFile('graphics')){
            $graphics = $request->file('graphics');
            $graphicsName = $request->input('title') . '.' . $graphics->getClientOriginalExtension();
            $graphicsPath = 'admin/codeQuestUploads/graphics/frontend/' . $graphicsName;
            $graphics->move('admin/codeQuestUploads/graphics/frontend/', $graphicsName);
            DB::table('frontend')
            ->insert([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'graphics'=>$graphicsPath,
                'difficulty'=>$request->input('difficulty'),
                'points'=>$request->input('points'),
                'status'=>$request->input('status')
            ]);
            return response()->json([
                "success" => true,
            ]);
        }
    }

    public function postBackEnd(Request $request){
        //check if user has file before inserting graphics into the database
        if($request->hasFile('graphics')){
            $graphics=$request->file('graphics');
            $graphicsName = $request->input('title') . '.' . $graphics->getClientOriginalExtension();
            $graphicsPath = 'admin/codeQuestUploads/graphics/backend/' . $graphicsName;
            $graphics->move('admin/codeQuestUploads/graphics/backend/', $graphicsName);
        }
        else{
            $graphics=null;
        }
        DB::table('backend')
        ->insert([
            'title'=>$request->input("title"),
            'description'=>$request->input("description"),
            'graphics'=>($graphics==null)?null:$graphicsPath,
            'input'=>$request->input("input"),
            'output'=>$request->input("output"),
            'followup'=>$request->input("followup"),
            'difficulty'=>$request->input("difficulty"),
            'points'=>$request->input("points"),
            'status'=>$request->input("status")
        ]);
        return response()->json(["success"=>true]);
    }

    public function deleteBackEndPost(Request $request){
        $data=$request->all();
        DB::table('backend')
        ->where('id',$data['id'])
        ->delete();
        return response()->json(["success"=>true]);
    }

    public function updateBackEndStatus(Request $request){
        $data=$request->all();
        $prevStatus=$data['status'];
        $newStatus='';
        if($prevStatus=='inactive'){
            $newStatus='active';
        }
        else{
            $newStatus='inactive';
        }
        DB::table('backend')
        ->where('id',$data['id'])
        ->update(['status'=>$newStatus]);
        return response()->json(["success"=>true]);
    }

    public function updateBackEndPost(Request $request){
         if($request->hasFile('graphics')){
            $graphics=$request->file('graphics');
            $graphicsName = $request->input('title') . '.' . $graphics->getClientOriginalExtension();
            $graphicsPath = 'admin/codeQuestUploads/graphics/backend/' . $graphicsName;
            $graphics->move('admin/codeQuestUploads/graphics/backend/', $graphicsName);
        }
        else{
            $graphics=null;
        }
        DB::table('backend')
        ->where('id',$request->input('id'))
        ->update([
            'title'=>$request->input("title"),
            'description'=>$request->input("description"),
            'graphics'=>$graphics,
            'input'=>$request->input("input"),
            'output'=>$request->input("output"),
            'followup'=>$request->input("followup"),
            'difficulty'=>$request->input("difficulty"),
            'points'=>$request->input("points"),
        ]);
        return response()->json(["success"=>true]);
    }

    public function adminLogout(){
        Session::forget('adminsuccess');
        return redirect('/loginpage');
    }
}
