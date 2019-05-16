<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    public function auth(Request $request)
    {
        $admin = Admin::where("email",$request->input("email"))
        ->where("password",$request->input("password"))
        ->first();

        $response["msg"]= $admin == null ? "FAILED" : "SUCCESS";
        $response["result"]=$admin;
        return $response;
    }
}
