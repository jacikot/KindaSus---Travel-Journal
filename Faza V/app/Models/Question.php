<?php namespace App\Models;

use CodeIgniter\Model;

class Question extends Model
{
    protected $table      = 'question';
    protected $primaryKey = 'id_qst';
    protected $returnType = 'object';
    protected $allowedFields = ['text', 'type_quiz', 'type_review','form'];

/*
 * function getQuestionByForm fetches all of the questions with given form
 * function returns Question object array
 * */
    public function getQuestionByForm($form){
        return $this->where('form', $form)->findAll();
    }
/*
 * function getMaxId gets the id of the last question for quiz (the one with the biggest id)
 * function returns integer value
 * */
 
    public function getMaxId(){
        $max = 0;
        $questions = $this->where('type_quiz',1)->findAll();
        foreach($questions as $question){
            if($question->id_qst > $max){
                $max = $question->id_qst;
            }
        }

        return $max;
    }
}
