<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $provinces = [
                                'Northern Province', 'Eastern Province', 'Southern Province',
                                'Western Province', 'Central Province', 'North Central Province',
                                'North Western Province', 'Uva Province', 'Sabaragamuwa Province'
                           ];

    public function getProvinces()
    {
        return $this->provinces;
    }
}
