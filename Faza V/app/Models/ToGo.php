<?php namespace App\Models;

use CodeIgniter\Model;

class ToGo extends Model
{
    protected $table      = 'to-go';
    protected $primaryKey = 'id_usr';
    protected $returnType = 'object';
    protected $allowedFields = ['id_plc', 'crossed_off'];




}
