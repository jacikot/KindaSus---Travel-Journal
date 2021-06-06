<?php namespace App\Models;

use CodeIgniter\Model;

class FoundUseful extends Model
{
    protected $table      = 'found_useful';
    protected $primaryKey = 'id_fnd';
    protected $returnType = 'object';
    protected $allowedFields = ['id_usr', 'id_rev'];

public function liked($id_usr,$id_rev){
    return $this->where('id_usr',$id_usr)->where('id_rev',$id_rev)->findAll();
}
    public function giveVote($idUsr, $idRev, $vote)
    {
        if ($vote == 'up')
            $this->insert(['id_usr' => $idUsr, 'id_rev' => $idRev]);                // upvote, tc++
        else
            $this->where(['id_usr' => $idUsr, 'id_rev' => $idRev])->delete();           // downvote, tc--
    }


}

