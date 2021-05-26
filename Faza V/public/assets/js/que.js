$(document).ready(function(){

    function validateQuestions(){
        let inputs =document.getElementsByTagName("input");
        for (let i=0;i<inputs.length;i++){
            document.getElementById("err"+i).style.display="none";
        }
        let correct=true;
        let questions=[];
        for (let i=0;i<inputs.length;i++){
            if(inputs[i].value==""){
                document.getElementById("err"+i).style.display="block";
                correct=false;
            }
            else {
                questions.push(inputs[i].value);
            }
        }

        if(!correct)return;
        ajaxCall(questions);

    }

    $("#check").on("click",validateQuestions);
});

