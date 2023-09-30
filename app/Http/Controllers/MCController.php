<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MCController extends Controller
{
    public function updatePoints(Request $request)
    {

        $points = $request->input('points');

        // Get the authenticated user
        $user = Auth::user();

        if ($user) {
            DB::table('users')
                ->where('studentid', $user->studentid)
                ->increment('points', $points);

            return response()->json([
                "success" => true,
                "message" => "Points updated successfully",
            ]);
        }
        else {
            return response()->json([
                "success" => false,
                "message" => "User not found",
            ], 404);
        }
    }
}
