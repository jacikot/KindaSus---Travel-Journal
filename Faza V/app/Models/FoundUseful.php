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
        // if a user gave / didn't give a token on a review, that information is stored in the found_useful
        // table, so that whenever reviews are displayed for the user, the information on which
        // reviews the user has given / not given a token will be remembered

        if ($vote == 'up')
            $this->insert(['id_usr' => $idUsr, 'id_rev' => $idRev]);
        else
            $this->where(['id_usr' => $idUsr, 'id_rev' => $idRev])->delete();
    }
}