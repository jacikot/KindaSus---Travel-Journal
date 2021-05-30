$(document).ready(function(){

    function validateQuestions(){
        let inputs =document.getElementsByTagName("input");
        let add=0;
        if(inputs.length==3)add=1;
        for (let i=0;i<inputs.length;i++){
            document.getElementById("err"+(i+add)).style.display="none";
        }
        let correct=true;
        let questions=[];
        for (let i=0;i<inputs.length;i++){
            if(inputs[i].value==""){
                document.getElementById("err"+(i+add)).style.display="block";
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

function addUsername(){
    let table=document.getElementById("table");
    let newRow=document.createElement("tr");
    let newCol1=document.createElement("td");
    let question=document.createElement("p");
    let newCol2=document.createElement("td");
    newCol2.classList.add("align-middle");
    question.classList.add("text");
    question.id="p3";
    question.innerText="Username:"
    newCol1.appendChild(question);
    newRow.appendChild(newCol1);
    newCol2.innerHTML=" <input type=\"text\" id=\"t1\" class=\"username border-bottom\"/>\n" +
        "                    <br>\n" +
        "                    <div id=\"err0\" class=\"err\" >Polje nije uneseno!</div>"
    newRow.appendChild(newCol2);
    table.insertBefore(newRow,table.firstChild);
}


function guestMode(){
    let link=document.getElementById("back");
    link.setAttribute("href",backGuest);
    let button=document.getElementById("backbutton");
    button.innerText="Back";
    addUsername();
    document.getElementsByClassName("row")[0].style.marginTop="0px";
    // let env=document.getElementsByClassName("env");
    // env[0].style.height="68%";
}

