<?php

namespace App\Http\Controllers;

use App\Incident;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    protected $incident;

    public function __construct(Incident $incident)
    {
        $this->incident = $incident->where('status', 'approved')->orderBy('created_at', 'desc')->simplePaginate(10);
    }

    public function publicHome(Request $request){
        $data = [];
        $data['home'] = 1;
        $data['title'] = 'Home';
        if($request->session()->has('type')){
            switch ($this->getUserType()){
                case 'admin':
                    return redirect()->route('admin_home');
                case 'user':
                    return redirect()->route('user_home');
            }
        }
        $data['posts'] = $this->populatePosts();

//        dd($data['posts']->previousPageUrl());

        return view('public.home', $data);
    }

    public function userHome(){
        $data = [];
        $data['username'] = $this->getUsername();
        $data['type'] = $this->getUserType();
        $data['home'] = 1;
        $data['title'] = 'Home';
        if(session()->has('status')){
            $data['status'] = session()->pull('status');
        }
        $data['posts'] = $this->populatePosts();
        return view('user.home', $data);
    }

    public function adminHome(){
        $data = [];
        $data['username'] = $this->getUsername();
        $data['type'] = $this->getUserType();
        $data['home'] = 1;
        $data['title'] = 'Home';
        $data['posts'] = $this->populatePosts();

//        dd();
        if(session()->has('status')){
            $data['status'] = session()->pull('status');
        }
        return view('admin.home', $data);
    }

    public function contactIndex()
    {
        $data['title'] = 'Contact';
        $data['contact'] = 1;
        switch (session('type'))
        {
            case 'admin':
                $data['username'] = $this->getUsername();
                $data['type'] = $this->getUserType();
                $data['template'] = 'templates.admin_template';
                break;
            case 'user':
                $data['username'] = $this->getUsername();
                $data['type'] = $this->getUserType();
                $data['template'] = 'templates.user_template';
                break;
            default:
                $data['template'] = 'templates.public_template';
                break;
        }
        return view('public.contact', $data);
    }

    public function populatePosts()
    {
        if(count($this->incident) > 0)
        {
            return $this->incident;
        }

        return null;
    }

    public function getUsername(){
        return session('username');
    }

    public function getUserType(){
        return session('type');
    }
}
