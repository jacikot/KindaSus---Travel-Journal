
var minLengthUser = 6;
var maxLengthUser = 20;

var minLengthPass = 6;
var maxLengthPass = 20;

function init(){
    //$("#errorPassword").text("");
   // $("#errorUsername").text("");
}

function changeIt() {
    let username = document.getElementById("userId").value;
    if (username.length < minLengthUser || username.length > maxLengthUser) {
        $('#userId').attr("title", "Change input");
        $('#userId').attr("data-content", "Sorry the username is too short");
        $('#userId').popover('show');
        setTimeout(reset,800);
        return;
    }

    setTimeout(reset,800);
}

function reset(){
    $('#userId').popover('hide');
}

function setReturnValues(t,c,id){
    $(id).attr('data-toggle',"popover");
    //$(id).attr("title", t);
    $(id).attr("data-content", c);
    if($(window).width() < 991){
        // dodaj modal ovde
    } else{
        $(id).attr("data-placement", "right");
    }
    $(id).popover();
    $(id).popover('enable');
    $(id).popover('show');
    setTimeout(remove,2000);
}
function remove(){
    $('#userId').popover('disable');
    $('#passId').popover('disable');
    $('#userId').popover('hide');
    $('#passId').popover('hide');
}

function login(){
    let username = document.getElementById("userId").value;
    let pass = document.getElementById("passId").value;

    let error = false;
    if(username === ""){
        setReturnValues("Sorry..","Username field is required",'#userId');
        error = true;
    }
    if(pass === ""){
        setReturnValues("Sorry..","Password field is required",'#passId')
        error = true;
    }

    if(error === true) return;

    if(username.length < minLengthUser || username.length > maxLengthUser){
        setReturnValues("Sorry..","Username field needs to have between "
            +minLengthUser+" and "+maxLengthUser+ "characters " ,'#userId');
        error = true;
    }

    if(pass.length < minLengthPass || pass.length > maxLengthPass){
        setReturnValues("Sorry..","Password field needs to have between "
            +minLengthPass+" and "+maxLengthPass+ "characters" ,'#passId');
        error = true;
    }

    if(error === true) return;

    if(/^\w/.test(username) ===  false || /^\d/.test(username) ===  true){
        setReturnValues("Sorry..","Username field needs to start with a letter or _ ",'#userId');
        return;
    }

    if(/^\w+$/.test(username) === false){
        setReturnValues("Sorry..","Username field can contain only letters, numbers or _",'#userId');
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
    $("button").filter(".mybtn").attr("onclick",func)
}



