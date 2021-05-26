<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Place extends Model
{
    protected $table      = 'place';
    protected $primaryKey = 'id_plc';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $allowedFields = ['name', 'categorized', 'category_1', 'category_2',
                                'category_3', 'category_4', 'category_5', 'id_img', 'id_cnt'];

    public function getPlaceAndCountryNames($idPlc)
    {
        return $this->select("place.name as place, country.name as country", false)
                    ->where('place.id_plc', $idPlc)
                    ->join('country', 'place.id_cnt = country.id_cnt')
                    ->find();
    }

}