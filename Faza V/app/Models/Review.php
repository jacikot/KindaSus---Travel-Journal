<?php namespace App\Models;

use CodeIgniter\Model;

class Review extends Model
{
    protected $table      = 'review';
    protected $primaryKey = 'id_rev';
    protected $returnType = 'object';
    protected $allowedFields = ['title', 'text', 'privacy', 'token_count','id_vis', 'date_posted'];


    public function getRevById($id){
        return $this->where('id_rev', $id)->find();
    }


}

/*
 field:
id_rev
title
text_path
privacy
token_count
id_vis
date_posted
 */