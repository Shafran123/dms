<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    protected $picture;

    function __construct(Picture $picture)
    {
        $this->picture = $picture;
    }

    public function deletePicture($id)
    {
        $picture = $this->picture;
        $picture->where('id', $id)->delete();
        return redirect()->back();
    }
}
