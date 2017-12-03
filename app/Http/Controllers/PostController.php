<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/2/2017
 * Time: 12:13 AM
 */



namespace App\Http\Controllers;
use App\Incident;
use Illuminate\Support\Facades\Auth;

class PostController
{

    public function userIndex()
    {
        $data['title'] = 'My Posts';
        $data['myPosts'] = 1;
        $data['username'] = Auth::user()->username;
        $data['type'] = Auth::user()->type;
        return view('user.my_posts', $data);
    }

    public function adminIndex()
    {
        $data['title'] = 'Pending Posts';
        $data['pendingPosts'] = 1;
        $data['username'] = Auth::user()->username;
        $data['type'] = Auth::user()->type;
        return view('admin.users', $data);
    }

}