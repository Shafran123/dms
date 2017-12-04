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
use App\Province;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class IncidentController
{
    protected $incident, $user, $types, $picture, $provinces;

    function __construct(Incident $incident, User $user, Type $type, Picture $picture, Province $provinces)
    {
        $this->incident = $incident;
        $this->user = $user;
        $this->types = $type;
        $this->picture = $picture;
        $this->provinces = $provinces;
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
        $data['types'] = $this->types->getTypes();
        $data['provinces'] = $this->provinces->getProvinces();
        return view('add_post', $data);
    }//show add post form

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
            $incident->province = $request['province'];
            $incident->status = session('type') == 'admin' ? 'approved' : 'pending';
            $incident->user()->associate($user);
            $files = $request->file('images');
            $incident->save();

            $incidentID = $incident->id;

            $file_count = count($files);
            if($file_count > 0)
            {
                foreach ($files as $file)
                {
                    $destinationPath = 'images';
                    $original_filename = $file->hashName();
                    $uploadFlag = $file->move($destinationPath, $original_filename);
                    $extension = $file->getClientOriginalExtension();
                    $upload = new Picture();
                    $upload->incident()->associate($incident);
                    $upload->filename = $file->getFileName() . '.' . $extension;
                    $upload->mime = $file->getClientMimeType();
                    $upload->original_filename = $original_filename;
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
    }//add post



    public function edit($id)
    {
        $data = [];
        $data['types'] = $this->types->getTypes();
        $data['provinces'] = $this->provinces->getProvinces();
        $data['title'] = 'Edit Post';
//        $data['username'] = Auth::user()->username;
//        $data['type'] = Auth::user()->type;
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
        }//switch statement
        $data['post'] = $this->incident->find($id);
        if($data['post'] != null)
        {
            $data['post'] = $data['post']->toArray();
            if($data['post']['status'] == 'pending')
                return view('admin.edit_post', $data);
            dd('error: post already approved'); //post already approved
        }
        dd('error: no post like that');

    }//show edit form

    public function editPost($id, Request $request)
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
            $incident = $this->incident->find($id);
            $user_instance = new User();
            $incident->title = $request['title'];
            $incident->date = $request['date'];
            $incident->type = $request['type'];
            $incident->description = $request['description'];
            $incident->latitude = $request['lat'];
            $incident->longitude = $request['lng'];
            $incident->city = $request['pac-input'];
            $incident->province = $request['province'];
            if(session('type') == 'admin')
                $incident->status = 'approved';
            else
                $incident->status = 'pending';
            $incident->save();

            $images = $request->file('images');

            if(count($images) > 0)
            {
                foreach ($images as $image)
                {

                    $destinationPath = 'images';
                    $fileName = $image->getClientOriginalName();
                    $original_filename = $image->hashName();
                    $uploadFlag = $image->move($destinationPath, $original_filename);

                    $extension = $image->getClientOriginalExtension();
                    $upload = new Picture();
                    $upload->incident()->associate($incident);
                    $upload->filename = $image->getFileName() . '.' . $extension;
                    $upload->mime = $image->getClientMimeType();
                    $upload->original_filename = $original_filename;
                    $upload->save();

                }
            }
            if (session('type') == 'user')
                return redirect()->route('my_posts');
            return redirect()->route('pending_posts');



        }
    }//edit post



    public function viewPost($id)
    {
        $data['title'] = 'Post Title';
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
        }//switch statement

        $post = $this->incident->find($id);
        if(count($post) >= 1)
        {
            $data['post'] = $post->toArray();
            $data['poster'] = $this->user->find($post['user_id'])->username;
            $data['pictures'] = $this->getPictures($id);

            if(count($data['pictures']) == 0)
                $data['pictures'] = null; //no pictures
            else
                $data['firstPic'] = 0;
        } else
        {
            dd('no post');
        }

        return view('post', $data);
    }//show post

    public function getPictures($id)
    {
//        dd($this->picture->where('incident_id', $id)->get()->toArray());
        $post = $this->incident->find($id);
        $pictures = $post->picture()->where('incident_id', $id)->get();
        if(count($pictures) > 0)
        {
            return ($pictures->toArray());
        }
        else
        {
            return [];
        }
    }

    public function viewMyPosts()
    {
        $data = [];
        $data['title'] = 'My Posts';
        $data['myPosts'] = 1;

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
        }//switch statement
//        dd(session('id'));
        $user = $this->user->find(session('id'));

        $incidents = $user->incident()->where('user_id', session('id'))->get();

        $incidents = $incidents->toArray();

        $data['postCount'] = count($incidents);

        if(count($incidents) > 0)
        {
            $data['posts'] = $incidents;
        }

        return view('my_posts', $data);
    } //view user/admin posts


    public function deletePost($id)
    {
        $incident = $this->incident;
        $incident->find($id)->delete();
        return redirect()->route('my_posts');
    }



    public function approvePost($id)
    {
        $incident = $this->incident->find($id);
        $incident->status = 'approved';
        $incident->save();
        return redirect()->route('pending_posts');
    }//approve post

}