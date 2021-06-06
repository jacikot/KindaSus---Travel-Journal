<?php namespace App\Models;

use CodeIgniter\Model;

class Question extends Model
{
    protected $table      = 'question';
    protected $primaryKey = 'id_qst';
    protected $returnType = 'object';
    protected $allowedFields = ['text', 'type_quiz', 'type_review','form'];


    public function getQuestionByForm($form){
        return $this->where('form', $form)->findAll();
    }

    public function getMaxId(){
        $max = 0;
        $questions = $this->findAll();
        foreach($questions as $question){
            if($question->id_qst > $max){
                $max = $question->id_qst;
            }
        }

        return $max;
    }



}