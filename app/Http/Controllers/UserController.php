<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data['title'] = 'Users';
        $data['users'] = 1;
        $data['username'] = Auth::user()->username;
        $data['type'] = Auth::user()->type;
        return view('admin.users', $data);
    }
}
