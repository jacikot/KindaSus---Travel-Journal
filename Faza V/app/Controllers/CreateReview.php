<?php namespace App\Controllers;

use App\Models\Review;
use App\Models\Visited;
use App\Models\Place;
use App\Models\Country;

class CreateReview extends BaseController{




    public function validateRev($data){

        //check if all the fields were filled correctly
        //proveriti duzinu polja, da li postoji ta zemlja, da li su svi parametri uneti

        //OVO URADITI!!! + dodati da se napravi poruka koja ce se onda ispisivati na ekranu
        return true;
    }

    protected function getPlace($plc, $country){
        //proveriti da li mesto postoji u bazi
        //ako postoji vratiti njegov id
        //ako ne postoji ubaciti i onda vratiti njegov id

        return 1;
    }


    public function addVisit($plc, $country){



        //dodaj dodavanje
        $id_plc=1;


        //dodaj dodavanje drzave
        $id_cnt=1;

        $tmp_visit=new Visited();
        $tmp_visit->save([
            'id_plc'=>$id_plc,
            'id_usr'=>intval(session()->get("userId"))
        ]);
        return $tmp_visit->getInsertID();
    }


    public function addRev() {

        $id_vis=$this->addVisit($this->request->getVar('place'), $this->request->getVar('country'));
        $num=0;

       echo $this->request->getVar('text');
        //create new review
        $review=new Review();
        $review->save([

            'title'=>$this->request->getVar('title'),
            'text'=>$this->request->getVar('text'),
            'privacy'=>$this->request->getVar('privacy'),
            'token_count'=>$num,
            'id_vis'=>$id_vis,
            'date_posted'=>$this->request->getVar('date')
        ]);

        echo "adri";
    }
}