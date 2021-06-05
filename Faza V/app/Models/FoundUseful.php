<?php

namespace App\Models;

use CodeIgniter\Model;

class FoundUseful extends Model
{
    protected $table = 'found_useful';
    protected $primaryKey = 'if_fnd';
    protected $returnType = 'object';
    protected $allowedFields = ['id_usr', 'id_rev'];

    public function giveVote($idUsr, $idRev, $vote)
    {
        if ($vote == 'up')
            $this->insert(['id_usr' => $idUsr, 'id_rev' => $idRev]);                // upvote, tc++
        else
            $this->where(['id_usr' => $idUsr, 'id_rev' => $idRev])->delete();           // downvote, tc--
    }
}