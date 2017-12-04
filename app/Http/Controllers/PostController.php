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
use App\Province;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PostController
{

    protected $incident, $user, $type, $picture, $provinces;

    function __construct(Incident $incident, User $user, Type $type, Picture $picture, Province $provinces)
    {
        $this->incident = $incident;
        $this->user = $user;
        $this->type = $type;
        $this->picture = $picture;
        $this->provinces = $provinces;
    }

    public function userIndex()
    {
        $data['title'] = 'My Posts';
        $data['myPosts'] = 1;
        $data['username'] = Auth::user()->username;
        $data['type'] = Auth::user()->type;
        return view('my_posts', $data);
    }//show my posts (user only)

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
    }//show pending posts (admin only)

//    public function viewPost($id)
//    {
//        $data['title'] = 'Post Title';
//        switch (session('type'))
//        {
//            case 'admin':
//                $data['username'] = Auth::user()->username;
//                $data['type'] = Auth::user()->type;
//                $data['template'] = 'templates.admin_template';
//                break;
//            case 'user':
//                $data['username'] = Auth::user()->username;
//                $data['type'] = Auth::user()->type;
//                $data['template'] = 'templates.user_template';
//                break;
//            default:
//                $data['template'] = 'templates.public_template';
//                break;
//        }//switch statement
//
//        $post = $this->incident->find($id);
//        if(count($post) >= 1)
//        {
//            $data['post'] = $post->toArray();
//            $data['poster'] = $this->user->find($post['user_id'])->username;
//            $data['pictures'] = $this->getPictures($id);
//
//            if(count($data['pictures']) == 0)
//                $data['pictures'] = null; //no pictures
//            else
//                $data['firstPic'] = 0;
//        } else
//        {
//            dd('no post');
//        }
//
//        return view('post', $data);
//    }//show post -
//
//    public function edit($id)
//    {
//        $data = [];
//        $data['types'] = $this->type->getTypes();
//        $data['provinces'] = $this->provinces->getProvinces();
//        $data['title'] = 'Edit Post';
//        $data['username'] = Auth::user()->username;
//        $data['type'] = Auth::user()->type;
//        $data['post'] = $this->incident->find($id);
//        if($data['post'] != null)
//        {
//            $data['post'] = $data['post']->toArray();
//            if($data['post']['status'] == 'pending')
//                return view('admin.edit_post', $data);
//            dd('error: post already approved'); //post already approved
//        }
//        dd('error: no post like that');
//
//    }//show edit form -
//
//    public function editPost($id, Request $request)
//    {
//        if($request->isMethod('post'))
//        {
//            $request->validate(
//                [
//                    'title' => 'required|min:5',
//                    'date' => 'required|before:today',
//                    'description' => 'required|min:100|max:3500',
//                    'pac-input' => 'required',
//                ]
//            );
//            $incident = $this->incident->find($id);
//            $user_instance = new User();
//            $incident->title = $request['title'];
//            $incident->date = $request['date'];
//            $incident->type = $request['type'];
//            $incident->description = $request['description'];
//            $incident->latitude = $request['lat'];
//            $incident->longitude = $request['lng'];
//            $incident->city = $request['pac-input'];
//            $incident->province = $request['province'];
//            $incident->status = 'approved';
//            $incident->save();
//
//            if(count($request['images']) > 0)
//            {
//                $images = Input::file('images');
//                foreach ($images as $image)
//                {
//
//                    $destinationPath = 'images';
//                    $fileName = $image->getClientOriginalName();
//
//                    $extension = $image->getClientOriginalExtension();
//                    $upload = new Picture();
//                    $upload->incident()->associate($incident);
//                    $upload->filename = $image->getFileName() . '.' . $extension;
//                    $upload->mime = $image->getClientMimeType();
//                    $upload->original_filename = $fileName;
//                    $upload->save();
//
//                }
//            }
//            return redirect()->route('pending_posts');
//
//
//
//        }
//    }//edit post -
//
//    public function approvePost($id)
//    {
//        $incident = $this->incident->find($id);
//        $incident->status = 'approved';
//        $incident->save();
//        return redirect()->route('pending_posts');
//    }//approve post
//
//    public function getPictures($id)
//    {
////        dd($this->picture->where('incident_id', $id)->get()->toArray());
//        $post = $this->incident->find($id);
//        $pictures = $post->picture()->where('incident_id', $id)->get();
//        if(count($pictures) > 0)
//        {
//            return ($pictures->toArray());
//        }
//        else
//        {
//            return [];
//        }
//    }

}