<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class RegisterAndLoginController extends Controller
{
    public function registerpage()
    {
        return view('main/registerpage');
    }

    public function loginpage()
    {
        return view('main/loginpage');
    }

    public function login(Request $request)
    {
        $credentials=$request->validate([
            'studentid'=>['required'],
            'password'=>['required']
        ]);
        if(Auth::attempt($credentials)){

            $user = Auth::user(); // Get the authenticated user

            // Store user information in the session
            $request->session()->put('studentid', $user->studentid);
            return response()->json([
                "success"=>true,
                "message"=>$user
            ]);
        }
        return response()->json(["success"=>false]); 
    }
    public function studentNumExists(Request $request){
        $data=$request->all();
        $studNumber=$data['studentid'];
        $result=DB::table('users')
            ->where('studentid',$studNumber)
            ->first();
        if(empty($result)){
            return response()->json(["success"=>false]);   
        }
        return response()->json(["success"=>true]);
    }
    public function register(Request $request)
    {  
        $data = $request->all();
        $check = $this->create($data);  
        return response()->json(["success"=>true]);
    }

    public function create(array $data)
    {
        return DB::table('users')
        ->insert([
            'studentid' => $data['studentid'],
            'email' => $data['email'],
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'yearlevel' => $data['yearlevel'],
            'program' => $data['program'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function success()
    {
        if(Auth::check()){
            return view('main.home');
        }
   
        return redirect("login")->withSuccess('are not allowed to access');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // Validate and update the user's profile details
            DB::table('users')
                ->where('studentid', $user->studentid)
                ->update([
                    'email' => $request->input('email'),
                    'yearlevel' => $request->input('yearlevel'),
                    'program' => $request->input('program'),
                ]);

            return response()->json([
                "success" => true,
                "message" => "Profile updated successfully",
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "User not found",
            ], 404);
        }
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg|max:5120', // Max file size in KB (5MB)
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = $user->studentid . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = 'users/' . $avatarName;
            $avatar->move(public_path('users'), $avatarName);

            DB::table('users')
                ->where('studentid', $user->studentid)
                ->update([
                    'avatar' => $avatarPath,
                ]);

            return response()->json([
                "success" => true,
                "message" => "Photo uploaded successfully",
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "No file uploaded",
            ]);
        }
    }

}
