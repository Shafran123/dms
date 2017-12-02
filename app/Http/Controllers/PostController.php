<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/2/2017
 * Time: 12:13 AM
 */



namespace App\Http\Controllers;
use App\Incident;

class PostController
{

    public function __construct(Incident $incident)
    {
        $this->incident = $incident;
    }

    public function userAddPost()
    {
        $data = [];
        $data['username'] = session('username');
        $data['title'] = 'Add Post';
        return view('user.add_post', $data);
    }

    public function addPost()
    {
        $incident = new Incident();
        $incident->insert(
            [
                'type' => 'Accident',
                'date' => '2017-11-27',
                'description' => 'It was an Accident',
                'latitude' => 6.870039,
                'longitude' => 79.879729,
                'city' => 'Kohuwala'
            ]
        );
    }

}