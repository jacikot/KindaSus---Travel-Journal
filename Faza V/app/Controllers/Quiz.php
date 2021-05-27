<?php

namespace App\Controllers;

use App\Models\Question;
use App\Models\Place;
use App\Models\ToGo;
use App\Models\Answer;
use App\Models\Country;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;
use Psr\Log\LoggerInterface;

class Quiz extends BaseController
{
    private $answeredQuestions =[];
    private $score = ['heritage'=> 0,'relax'=> 0,'sightseeing'=> 0,'weather'=> 0,'populated'=> 0];
    private $answersId = [];
    private $maxId;
    private $minId;
    // samo vidi za ove <br>
    public static $quotes = ["Jobs fill your pockets, adventures fill your soul.",
        'Remember that happiness is a way of travel, not a destination.',
        'Travel is the only thing you buy that makes you richer.',
        'In the end, we only regret the chances we didn’t take',
        'My goal is to run out of pages in my passport.',
        'Still round the corner, there may wait, a new road or a secret gate'
        ];


    //dodaj current question
    // dodaj current answersId

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->minId = 1;
        $q = new Question();
        $this->maxId = $q->getMaxId();

    }

    public function addRecommendationToToGo(){
        $toGoModel = new ToGo();
        $id = $this->request->getVar('id');
        $this->session->set('id_usr',1);
        $id_usr = $this->session->get('id_usr');

        $togos = $toGoModel->where('id_usr',$id_usr)->findAll();

        foreach($togos as $togo){
            if($togo->id_plc == $id){
                echo "Already in to-go list!";
                return;
            }
        }

        $toGoModel->save([
            'id_usr'=>$id_usr,
            'id_plc'=> $id,
            'crossed_off' => 0
        ]);

        echo "Success!";

    }

    public function startQuiz(){
        $this->answeredQuestions =[];
        $this->minId = 1;

        // jel ok da pretpostavim da je sve od 1 do maxa tu - msm da da
        $q = new Question();
        $this->maxId = $q->getMaxId();

        return view('quiz.php');
    }

    private function addValues($selected){
        $id = $this->answersId[$selected];
        $answersModel = new Answer();
        $answer = $answersModel->find($id);

        $this->score['heritage'] += $answer->heritage;
        $this->score['populated'] += $answer->populated;
        $this->score['weather'] += $answer->weather;
        $this->score['relax'] += $answer->relax;
        $this->score['sightseeing'] += $answer->sightseeing;
    }

    public  function getRecommendation($id){
        $placeModel = new Place();
        $place = $placeModel->find($id);

        $countryModel = new Country();
        $country = $countryModel->find($place->id_cnt);

        $rand = rand(0,count(self::$quotes)-1);
        $data['data'] = ['place' => $place,'country' =>$country,'quote'=>self::$quotes[$rand],'id' => $id];
        return view('reference.php',$data);
    }

    private function generateNextQuestion(){
        while(true) {
            $id = rand($this->minId, $this->maxId);

            if (!in_array($id, $this->answeredQuestions)) {
                array_push($this->answeredQuestions,$id);
                return $id;
            }
        }
    }

    private function getQuestion($id){
        $q = new Question();
        return $q->find($id);
    }

    private function getAnswers($question){
        $answerModel = new Answer();
        $answers = $answerModel->where('id_qst',$question->id_qst)->findAll();
        $retMess = "";
        $this->answersId = [];
        foreach($answers as $answer){
             array_push($this->answersId,$answer->id_ans);
             $retMess .= ",".$answer->text;
        }

        return $retMess;
    }

    private function resetAll(){
        $this->score = ['heritage'=> 0,'relax'=> 0,'sightseeing'=> 0,'weather'=> 0,'populated'=> 0];
        $this->answeredQuestions = [];
        $this->answersId = [];
    }

    private function findRecommendation(){
        $placeModel = new Place();
        $places = $placeModel->getAllCategorized();
        $bestScore = PHP_INT_MAX;
        $idBest = 0;

        // moras bazu da sredis prvo za ovo
        foreach($places as $place){
            $currScore = 0;
            $currScore += abs($place->heritage - $this->score['heritage'] );
            $currScore += abs($place->relax - $this->score['relax'] );
            $currScore += abs($place->sightseeing - $this->score['sightseeing']);
            $currScore += abs($place->weather - $this->score['weather']) ;
            $currScore += abs($place->populated - $this->score['populated'] );

            if($currScore < $bestScore){
                $bestScore = $currScore;
                $idBest = $place->id_plc;
            }

        }

        return $idBest;
    }

    public function nextQuestion(){
        $curr = $this->request->getVar("currQuestion");
        $selected = $this->request->getVar("selected");

        if($curr != 1){
            $this->answeredQuestions = $this->session->get('questions');
            $this->answersId = $this->session->get('answers');
            $this->score = $this->session->get('score');
        }

        if($curr == 1) $this->resetAll();

        $selected -= 1;
        if($curr != 1){
            $this->addValues($selected);
        }


        if($curr != 6) {
            $id = $this->generateNextQuestion();
            $question = $this->getQuestion($id);
            $answers = $this->getAnswers($question);
        }

        // povremeno pukne vidi sta ste desava sa tim
        // mroas da dodas da moze da ide back!!!
        // moras da ubacis i tip forme


        if($curr == 6){
            $id = $this->findRecommendation();
            $this->session->remove('questions');
            $this->session->remove('answers');
            $this->session->remove('score');
            echo "gotovo,".$id;
            return;
        }

        $this->session->set('questions',$this->answeredQuestions );
        $this->session->set('answers',$this->answersId );
        $this->session->set('score',$this->score);


        echo  $question->text."".$answers;

    }

}

