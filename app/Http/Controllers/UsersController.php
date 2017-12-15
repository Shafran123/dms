<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    protected $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        //show user list
        $data = [];
        $data['username'] = session('username');
        $data['password'] = session('type');
        $data['users'] = 1;
        $data['title'] = 'Users';
        $users = $this->user->all();
        $data['users'] = $users->toArray();
        return view('super.users', $data);
    }

    public function create()
    {
        //show registration form
        $data = [];
        $data['username'] = session('username');
        $data['password'] = session('type');
        $data['users'] = 1;
        $data['title'] = 'Add User';
        return view('super.register', $data);
    }

    public function store(Request $request)
    {
        //add user
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'job' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = $this->user;
        $user->name = $request['name'];
        $user->type = $request['type'];
        $user->job = $request['job'];
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->password = bcrypt($request['password']);
        $user->save();
        return redirect('/');
    }

    public function view($id)
    {
        $user = $this->user;
        $user = $user->find($id);
        if(count($user) < 1)
        {
            dd($user);
        }
        $data = [];
        $data['username'] = session('username');
        $data['password'] = session('type');
        $data['users'] = 1;
        $data['title'] = 'View User';
        $data['user'] = $user->toArray();
        return view('super.view_user', $data);
    }

    public function update(Request $request, $id, $field)
    {
        $user = $this->user;
        $user = $user->find($id);
        switch ($field){
            case 1://account type
                $request->validate([
                    'type' => 'required|string|max:255',
                ]);
                $user->type = $request['type'];
                $user->save();
                return redirect('/');
                break;
            case 2://email
                $request->validate([
                    'email' => 'required|string|email|max:255|unique:users',
                ]);
                $user->email = $request['email'];
                $user->save();
                return redirect('/');
                break;
            case 3://password
                $request->validate([
                    'password' => 'required|string|min:6|confirmed',
                ]);
                $user->password = bcrypt($request['password']);
                $user->save();
                return redirect('/');
                break;

        }
    }

    public function delete()
    {
        //delete user
    }


}
