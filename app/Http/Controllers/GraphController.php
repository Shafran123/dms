<?php

namespace App\Http\Controllers;

use App\Incident;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{
    protected $type, $incident;
    function __construct(Type $type, Incident $incident)
    {
        $this->type = $type;
        $this->incident = $incident;
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

        if($request->radioButton == 'overall')
        {
            $incidents_array = $this->incident->select(DB::raw('district, status, count(*) as number_of_incidents'))
                                                ->where('status','approved')
                                                ->groupBy('district')
//                                                ->having('status', 'approved')
                                                ->get();
            if(count($incidents_array) > 0)
            {
                $incidents = [];
                $i = 0;
                foreach ($incidents_array as $incident)
                {
                    $incidents[$i]['district'] = ucfirst($incident['district']);
                    $incidents[$i]['number_of_incidents'] = $incident['number_of_incidents'];
                    $i++;
                }
                $data['incidents'] = $incidents;
//                dd($incidents);
                return view('public.view_graph', $data);
            }
        }
        else
        {

        }

        return view('public.view_graph', $data);
    }

    public function sortByDistrict($district)
    {
        $district_incidents = $this->incident->select(DB::raw('type, status, count(*) as number_of_incidents'))
            ->where('district',$district)
            ->where('status','approved')
            ->groupBy('type')
            ->get();
        dd($district_incidents->toArray());
    }
}
