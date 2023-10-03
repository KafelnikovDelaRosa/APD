<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeController extends Controller
{
    //
    public function saveCode(Request $request){
        $data=$request->all();
        $fileName='tempCode_'.'.'.$data['language'];
        file_put_contents(public_path('codeUploads/'.$fileName),$data['content']);
        return response()->json(['success'=>true]);
    }
    public function runCode(Request $request){
        $data=$request->all();
        $extension=$data['language'];
        switch($extension){
            case 'cpp':
                $command='cd codeUploads && g++ tempCode_.cpp -o tempCode_.exe';
                break;
            case 'py':
                $command='cd codeUploads && python tempCode_.py';
                break;
            case 'js':
                $command='cd codeUploads && node tempCode_.js';
                break;
            case 'php':
                $command='cd codeUploads && php tempCode_.php';
                break;
            case 'java':
                $command='cd codeUploads && javac tempCode_.java && java tempCode';
                break;
        }
        $output=shell_exec("$command 2>&1");
        if($output==null){
            $stderr=explode("___SEPERATOR___",$output,2);
            return response()->json(['success'=>false,'error'=>$stderr]);
        }
        $stdout=explode("___SEPERATOR___",$output,2);
        return response()->json(['success'=>true,'result'=>$stdout]);
    }
}
