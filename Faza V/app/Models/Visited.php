<?php namespace App\Models;

use CodeIgniter\Model;

class Visited extends Model
{
    protected $table      = 'visited';
    protected $primaryKey = 'id_vis';
    protected $returnType = 'object';
    protected $allowedFields = ['id_plc', 'id_usr'];

    public function getVisitById($id){
        return $this->where('id_vis', $id)->find();
    }


}