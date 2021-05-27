<?php namespace App\Models;

use CodeIgniter\Model;

class Image extends Model
{
    protected $table      = 'image';
    protected $primaryKey = 'id_img';
    protected $returnType = 'object';
    protected $allowedFields = ['image_path', 'id_rev'];

    public function insertImage($image_path,$id_rev=null){

        $this->save([
            'image_path' => $image_path,
            'id_rev' => $id_rev
        ]);

         return $this->getInsertID();
    }




}