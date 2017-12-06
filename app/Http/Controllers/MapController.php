<?php

namespace App\Http\Controllers;

use App\Incident;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    protected $user, $incident, $type;

    function __construct(User $user, Incident $incident, Type $type)
    {
        $this->user = $user;
        $this->incident = $incident;
        $this->type = $type;
    }

    public function index()
    {
        $data['title'] = 'View Map';
        $data['onMap'] = 1;
        switch (session('type'))
        {
            case 'admin':
                $data['username'] = Auth::user()->username;
                $data['user_type'] = Auth::user()->type;
                $data['template'] = 'templates.admin_template';
                break;
            case 'user':
                $data['username'] = Auth::user()->username;
                $data['user_type'] = Auth::user()->type;
                $data['template'] = 'templates.user_template';
                break;
            default:
                $data['template'] = 'templates.public_template';
                break;
        }
        $incidents = $this->getIncidents();
        if (isset($incidents))
        {
            for ($i = 0; $i < count($incidents); $i++)
            {
                $incidents[$i]['type_icon'] = $this->type->getImage($incidents[$i]['type']);
            }
            $data['incidents'] = $incidents;
//            dd($data['incidents']);
        }
        return view('public.view_map', $data);
    }

    public function getIncidents()
    {
        $incidents = $this->incident->where('status', 'approved')->get();
        if(count($incidents) > 0)
        {
            return $incidents->toArray();
        }
        else
        {
            return null;
        }
    }
}
