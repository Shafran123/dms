<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/2/2017
 * Time: 12:13 AM
 */



namespace App\Http\Controllers;
use App\Incident;
use App\Picture;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController
{

    protected $incident, $user, $type, $picture;

    function __construct(Incident $incident, User $user, Type $type, Picture $picture)
    {
        $this->incident = $incident;
        $this->user = $user;
        $this->type = $type;
        $this->picture = $picture;
    }

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
        $i=0;
        $data['title'] = 'Pending Posts';
        $data['pendingPosts'] = 1;
        $data['username'] = Auth::user()->username;
        $data['type'] = Auth::user()->type;
        $pending_incidents = $this->incident->get()->where('status', 'pending');
        $data['postCount'] = count($pending_incidents);
        $posts = $pending_incidents->toArray();

        foreach ($posts as $post)
        {
            $user_id = $post['user_id'];
            $username = $this->user->find($user_id)->username;
            $post['username'] = $username;
            $data['posts'][$i] = $post;
            $i++;
        }

//        print_r($data['postCount']);
        return view('admin.pending_posts', $data);
    }

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
        } else
        {
            $data['no_post'] = 1;
        }
        $data['pictures'] = $this->getPictures($id);

        if(count($data['pictures']) == 0)
            $data['pictures'] = null; //no pictures
        else
            $data['firstPic'] = 0;
        return view('post', $data);
    }

    public function edit($id)
    {
        $data = [];
        $data['types'] = $this->type->getTypes();
        $data['title'] = 'Edit Post';
        $data['username'] = Auth::user()->username;
        $data['type'] = Auth::user()->type;
        $data['post'] = $this->incident->find($id);
        if($data['post'] != null)
        {
            $data['post'] = $data['post']->toArray();
            if($data['post']['status'] == 'pending')
                return view('admin.edit_post', $data);
            dd('error: post already approved'); //post already approved
        }
        dd('error: no post like that');

    }

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
            $incident->status = 'approved';
            $incident->save();
            return redirect()->route('pending_posts');
//            dd($incident->toArray());
        }
    }

    public function approvePost($id)
    {
        $incident = $this->incident->find($id);
        $incident->status = 'approved';
        $incident->save();
        return redirect()->route('pending_posts');
    }

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

}