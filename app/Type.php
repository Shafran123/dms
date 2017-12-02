<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $type = [
        'Thunderstorm' => 'http://maps.google.com/mapfiles/kml/shapes/thunderstorm.png',
        'Flood' => 'http://maps.google.com/mapfiles/kml/shapes/water.png',
        'Landslide' => 'http://maps.google.com/mapfiles/kml/shapes/falling_rocks.png',
        'Other' => 'http://maps.google.com/mapfiles/kml/shapes/caution.png',
    ];

    public function getTypes()
    {
        return $this->type;
    }
}
