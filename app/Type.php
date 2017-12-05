<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $type = [
        'Thunderstorm' => 'http://maps.google.com/mapfiles/kml/shapes/thunderstorm.png',
        'Flood' => 'http://maps.google.com/mapfiles/kml/pal3/icon45.png',
        'Landslide' => 'http://maps.google.com/mapfiles/kml/pal3/icon45.png',
        'Fire' => 'http://maps.google.com/mapfiles/kml/shapes/firedept.png',
        'Other' => 'http://maps.google.com/mapfiles/kml/pal3/icon45.png',
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
