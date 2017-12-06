<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraphController extends Controller
{
    protected $type;
    function __construct(Type $type)
    {
        $this->type = $type;
    }

    public function index()
    {
        $data['title'] = 'View Graphs';
        $data['onGraph'] = 1;
        $data['paras'] = 1;
        $data['types'] = $this->type->getTypes();
        switch (session('type'))
        {
            case 'admin':
                $data['username'] = Auth::user()->username;
                $data['user_type'] = Auth::user()->type;
                $data['template'] = 'templates.admin_template';
                break;
            case 'user':
                $data['username'] = Auth::user()->username;
                $data['type'] = Auth::user()->type;
                $data['template'] = 'templates.user_template';
                break;
            default:
                $data['template'] = 'templates.public_template';
                break;
        }
        return view('public.view_graph', $data);
    }

    public function filterPosts(Request $request)
    {
        dd($request->radioButton);
        $data['title'] = 'View Graphs';
        $data['onGraph'] = 1;
//        $data['paras'] = 1;
        $data['types'] = $this->type->getTypes();
        switch (session('type'))
        {
            case 'admin':
                $data['username'] = Auth::user()->username;
                $data['user_type'] = Auth::user()->type;
                $data['template'] = 'templates.admin_template';
                break;
            case 'user':
                $data['username'] = Auth::user()->username;
                $data['type'] = Auth::user()->type;
                $data['template'] = 'templates.user_template';
                break;
            default:
                $data['template'] = 'templates.public_template';
                break;
        }
        return view('public.view_graph', $data);
    }
}
