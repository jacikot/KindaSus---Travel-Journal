<?php namespace App\Models;

use CodeIgniter\Model;

class Image extends Model
{
    protected $table      = 'image';
    protected $primaryKey = 'id_img';
    protected $returnType = 'object';
    protected $allowedFields = ['image_path', 'id_rev'];

    /*
     * function getPicsForReview fetches all of the images that are attached to given review
     * function returns an Image array
     * */

public function getPicsForReview($id_rev){
    return $this->where('id_rev', $id_rev)->findAll();
}
    public function insertImage($image_path,$id_rev=null){

        $this->save([
            'image_path' => $image_path,
            'id_rev' => $id_rev
        ]);

        return $this->getInsertID();
    }

}