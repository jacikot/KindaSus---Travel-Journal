<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'registered_user';
    protected $primaryKey = 'id_usr';
    protected $returnType = 'object';
    protected $allowedFields = ['username', 'id_plc', 'password', 'name', 'surname', 'e-mail', 'security_answer_1','security_answer_2',
        'security_answer_3', 'token_count', 'avatar_path', 'acc_creation_date'
    ];




}