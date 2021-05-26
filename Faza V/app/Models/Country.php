<?php namespace App\Models;

use CodeIgniter\Model;

class Country extends Model
{
    protected $table      = 'country';
    protected $primaryKey = 'id_cnt';
    protected $returnType = 'object';
    protected $allowedFields =['name','code','id_con'];





}

