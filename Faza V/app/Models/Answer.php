<?php namespace App\Models;

use CodeIgniter\Model;

class Answer extends Model
{
    protected $table      = 'answer';
    protected $primaryKey = 'id_ans';
    protected $returnType = 'object';
    protected $allowedFields =['text','heritage','relax','sightseeing',
        'weather','populated','id_qst'];





}
