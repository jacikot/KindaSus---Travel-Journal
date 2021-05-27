<?php namespace App\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\Visited;
use App\Models\Place;
use App\Models\Country;

class ReviewOverview extends BaseController
{

    public function getRev(){

        $id=$this->session->get('id_rev');

        $tmp_review=new Review();

        $review=$tmp_review->find($id);

        $tmp_cnt=new Country();
        $tmp_place=new Place();
        $tmp_visit=new Visited();
        $tmp_user=new User();




        //iz visit citamo koje je mesto u pitanju, iz mesta citamo njegov naziv i id zemlje i onda dohvatamo ime zemlje

        $visit=$tmp_visit->find($review->id_vis);

        $place=$tmp_place->find($visit->id_plc);
        $country=$tmp_cnt->find($place->id_cnt);

        $user=$tmp_user->find($visit->id_usr);

        $type_of_user='guest';
        $found_type=false;



        if(($this->session->has('userId'))==false){ $type_of_user='guest'; $found_type=true;}
            if ($found_type==false && $this->session->get('userId') == $user->id_usr ) {$type_of_user = 'owner'; $found_type=true;}
            if ( $found_type==false && $this->session->get('isAdmin') == 1) {$type_of_user = 'admin'; $found_type=true;}

            if ( $found_type==false && $this->session->get('userId') != $user->id_usr) $type_of_user = 'regUser';




        $result=array ('title'=>'90', 'text'=>'100',
            'date'=>'25', 'token_count'=>'1', 'privacy'=>0, 'place'=>'7','country'=>'9');

        $result['title']=$review->title;
        $result['date']=$review->date_posted;
        $result['text']=$review->text;
        $result['privacy']=$review->privacy;
        $result['token_count']=$review->token_count;
        $result['place']=$place->name;
        $result['country']=$country->name;
        $result['username']=$user->username;
        $result['type_of_user']=$type_of_user;

        echo json_encode($result);

    }

    public function changeToPrivate(){
        $id=$this->session->get('id_rev');
        $tmp_review=new Review();
        $review=$tmp_review->find($id);

        $tmp_review->save([
            'id_rev'=>$review->id_rev,
            'title'=>$review->title,
            'text'=>$review->text,
            'privacy'=>0,
            'token_count'=>$review->token_count,
            'id_vis'=>$review->id_vis,
            'date_posted'=>$review->date_posted
        ]);
    }

    public function changeToPublic(){
        $num=1;
        $id=$this->session->get('id_rev');
        $tmp_review=new Review();
        $review=$tmp_review->find($id);

        $tmp_review->save([
            'id_rev'=>$review->id_rev,
            'title'=>$review->title,
            'text'=>$review->text,
            'privacy'=>$num,
            'token_count'=>$review->token_count,
            'id_vis'=>$review->id_vis,
            'date_posted'=>$review->date_posted
        ]);


    }

    public function giveTokens(){

        $id=$this->session->get('id_rev');
        $tmp_review=new Review();
        $review=$tmp_review->find($id);
        $num=$review->token_count;
        $num++;

        $tmp_visit=new Visited();
        $tmp_user=new User();
        $visit=$tmp_visit->find($review->id_vis);
        $user=$tmp_user->find($visit->id_usr);
        $user_tokens=$user->token_count+1;

        $tmp_review->save([
            'id_rev'=>$review->id_rev,
            'title'=>$review->title,
            'text'=>$review->text,
            'privacy'=>$review->privacy,
            'token_count'=>$num,
            'id_vis'=>$review->id_vis,
            'date_posted'=>$review->date_posted
        ]);
/*
        $tmp_user->save([
            'id_usr'=>$user->id_usr,
            'name'=>$user->name,
            'surname'=>$user->surname,
            'username'=>$user->username,
            'token_count'=>$user_tokens,
            'e-mail'=>$user->email,
            'password'=>$user->password,
            'security_answer_1'=>$user->security_answer_1,
            'security_answer_2'=>$user->security_answer_2,
            'security_answer_3'=>$user->security_answer_3,
            'avatar_path'=>$user->avatar_path,
            'acc_creation_date'=>$user->acc_creation_date,
            'id_plc'=>$user->id_plc
        ]);
*/
        echo $num;
    }

}