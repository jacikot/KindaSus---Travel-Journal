
var minLengthUser = 6;
var maxLengthUser = 20;

var minLengthPass = 6;
var maxLengthPass = 20;

function init(){
    //$("#errorPassword").text("");
   // $("#errorUsername").text("");
}

function login(){
    let username = document.getElementById("userId").value;
    let pass = document.getElementById("passId").value;

    let error = false;
    if(username === ""){
        //$("#errorPassword").text("This is a required field");
        error = true;
    }
    if(pass === ""){

        //$("#errorUsername").text("This is a required field");
        error = true;
    }

    if(error === true) return;

    if(username.length < minLengthUser || username.length > maxLengthUser){
        alert("Neadekvatna duzina username!");
        return;
    }

    if(pass.length < minLengthPass || pass.length > maxLengthPass){
        alert("Neadekvatna duzina pass!");
        return;
    }

    if(/^\w/.test(username) ===  false || /^\d/.test(username) ===  true){
        alert("Needs to start with a letter or _");
        return;
    }

    if(/^\w+$/.test(username) === false){
        alert("Ne moze");
        return;
    }

    sendData(username,pass);
}

function goToAdmin(){

    // joletova stranica
}

function goToMap(){
    //janina stranica
}

function setValues(title,button,func){
    $(".modal-title").text(title);
    $("button").filter(".mybtn").text(button);
    $("button").attr("onclick",func)

}



