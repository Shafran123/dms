<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/2/2017
 * Time: 3:00 AM
 */

namespace App\Http\Controllers;
use App\Incident;
use App\Picture;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class IncidentController
{
    protected $types = [];

    public function __construct(Type $type)
    {
        $this->types = $type->getTypes();
    }

    public function index()
    {
        $data = [];
        switch (session('type'))
        {
            case 'admin':
                $data['username'] = Auth::user()->username;
                $data['type'] = Auth::user()->type;
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
        $data['title'] = 'Add Post';
        $data['types'] = $this->types;
        return view('add_post', $data);
    }

    public function addPost(Request $request)
    {
        if($request->isMethod('post'))
        {
            $request->validate(
                [
                    'title' => 'required|min:5',
                    'date' => 'required|before:today',
                    'description' => 'required|min:100|max:3500',
                    'pac-input' => 'required',
                ]
            );
            $incident = new Incident();
            $user_instance = new User();
            $user = $user_instance->find(session('id'));
            $incident->title = $request['title'];
            $incident->date = $request['date'];
            $incident->type = $request['type'];
            $incident->description = $request['description'];
            $incident->latitude = $request['lat'];
            $incident->longitude = $request['lng'];
            $incident->city = $request['pac-input'];
            $incident->status = session('type') == 'admin' ? 'approved' : 'pending';
            $incident->user()->associate($user);
            $incident->save();

            $incidentID = $incident->id;

            $files = Input::file('images');
            $file_count = count($files);
            if($file_count > 0)
            {
                foreach ($files as $file)
                {
                    $destinationPath = 'images';
                    $fileName = $file->getClientOriginalName();
                    $uploadFlag = $file->move($destinationPath, $fileName);

                    $extension = $file->getClientOriginalExtension();
                    $upload = new Picture();
                    $upload->incident()->associate($incident);
                    $upload->filename = $file->getFileName() . '.' . $extension;
                    $upload->mime = $file->getClientMimeType();
                    $upload->original_filename = $fileName;
                    $upload->save();
                }
            }
            switch (session('type'))
            {
                case 'admin':
                    $request->session()->put('status', 'Posted!');
                    break;
                case 'user':
                    $request->session()->put('status', 'Your post will be reviewed by an admin');
                    break;
                default:
                    $request->session()->put('status', 'Your post will be reviewed by an admin');
                    break;
            }
            return redirect('/');
        }


//        dd($user->id);
//        $incident->insert(
//            [
//                'type' => 'Accident',
//                'date' => '2017-11-27',
//                'description' => 'It was an Accident',
//                'latitude' => 6.870039,
//                'longitude' => 79.879729,
//                'city' => 'Kohuwala'
//            ]
//        );
    }
}