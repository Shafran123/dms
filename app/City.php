<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $cities = [
        "Colombo","Dehiwela","Moratuwa","Negombo","Sri Jayawardenepura Kotte","Gampaha","Kalutara",
    ];

    public function getCities()
    {
        return $this->cities;
    }
}
