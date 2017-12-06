<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $type = [
        'Thunderstorm' => 'https://image.ibb.co/bEmuQG/thunderstorm.png',
        'Flood' => 'https://image.ibb.co/hW5okG/water.png',
        'Landslide' => 'https://image.ibb.co/k05ceb/falling_rocks.png',
        'Fire' => 'https://image.ibb.co/hoxqzb/firedept.png',
        'Other' => 'https://image.ibb.co/cKeQXw/icon33.png',
    ];

    public function getTypes()
    {
        return $this->type;
    }

    public function getImage($type)
    {
        $types = $this->type;
        foreach ($types as $key => $value)
        {
            if($key == $type)
                return $value;
        }
        return null;
    }
}
