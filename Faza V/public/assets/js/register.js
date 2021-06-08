
var minLengthUser = 6;
var maxLengthUser = 20;

var minLengthPass = 6;
var maxLengthPass = 20;

var maxNameLength = 40;
var maxSurnameLength = 40;

$(document).ready(function(){
        $("#tab").hide();
        $("#header").hide();
        $("#tab").fadeIn(800);
        $("#header").fadeIn(1500);

});

function setReturnValues(t,c,id,pos){
    $(id).attr('data-toggle',"popover");
    //$(id).attr("title", t);
    $(id).attr("data-content", c);
    if($(window).width() < 991){
        // dodaj modal ovde
    } else{
        $(id).attr("data-placement", pos);
    }
    $(id).popover();
    $(id).popover('enable');
    $(id).popover('show');
    setTimeout(remove,2000);
}
function remove(){
    $('#pass').popover('disable');
    $('#passconf').popover('disable');
    $('#username').popover('disable');
    $('#city').popover('disable');
    $('#country').popover('disable');
    $('#surname').popover('disable');
    $('#name').popover('disable');
    $('#email').popover('disable');

    $('#passconf').popover('hide');
    $('#pass').popover('hide');
    $('#username').popover('hide');
    $('#city').popover('hide');
    $('#country').popover('hide');
    $('#surname').popover('hide');
    $('#name').popover('hide');
    $('#email').popover('hide');
}

function register(){

    let username = document.getElementById("username").value;
    let name = document.getElementById("name").value;
    let surname = document.getElementById("surname").value;
    let pass = document.getElementById("pass").value;
    let passconf = document.getElementById("passconf").value;
    let email = document.getElementById("email").value;
    let country = document.getElementById("country").value;
    let city = document.getElementById("city").value;

    let fd = new FormData();
    if(document.getElementById('file-upload').files.length !== 0) {
        let files = $('#file-upload')[0].files;
        if (files.length > 0) {
            fd.append('file', files[0]);
        }
    }
    //passconf=="" ||  email=="" || country == "" || name=="" || city=="" )

    let req = false;
    if(pass === "" ){
        req = true;
        setReturnValues("Sorry..","Field is required","#pass","right")
    }

    if(passconf === "" ) {
        req = true;
        setReturnValues("Sorry..", "Field is required", "#passconf","right")
    }

    if(name === ""){
        req = true;
        setReturnValues("Sorry..", "Field is required", "#name","left")
    }

    if(surname === ""){
        req = true;
        setReturnValues("Sorry..", "Field is required", "#surname","left")
    }

    if(email === ""){
        req = true;
        setReturnValues("Sorry..", "Field is required", "#email","left");
    }

    if(city === ""){
        req = true;
        setReturnValues("Sorry..", "Field is required", "#city","right");
    }

    if(country === ""){
        req = true;
        setReturnValues("Sorry..", "Field is required", "#country","right");
    }

    if(username === ""){
        req = true;
        setReturnValues("Sorry..", "Field is required", "#username","left");
    }

    if(req === true){
        return;
    }


    if(username.length < minLengthUser || username.length > maxLengthUser){
        req = true;
        setReturnValues("Sorry..", "Needs to be between "+minLengthUser + " and "+ maxLengthUser +" characters", "#username","left");

    }

    if(pass.length < minLengthPass || pass.length > maxLengthPass){
        req = true;
        setReturnValues("Sorry..", "Needs to be between "+minLengthPass + " and "+ maxLengthPass + " characters", "#pass","right");
    }

    if(name.length > maxNameLength){
        req = true;
        setReturnValues("Sorry..", "Needs to have less than "+maxNameLength+ " characters", "#name","left");
    }

    if(surname.length > maxSurnameLength){
        req = true;
        setReturnValues("Sorry..", "Needs to have less than "+maxSurnameLength+ " characters", "#surname","left");
    }

    if(req === true){
        return;
    }

    // za sad za email proveri samo da li ima @
    if(/\w+@\w+/.test(email) === false){
        req = true;
        setReturnValues("Sorry..", "Inadequate email format", "#email","left");
    }

    error = "";
    if(/^\w/.test(username) ===  false || /^\d/.test(username) ===  true){
        error +="Needs to start with a letter or _. ";
    }

    if(/^\w+$/.test(username) === false){
        error += "Needs to have _, A or a";
    }

    if(error !== ""){
        req = true;
        setReturnValues("Sorry..", error, "#username","left");
    }

    if(/[a-z]/.test(pass) === false || /[A-Z]/.test(pass) === false || /\d/.test(pass)=== false){
        req = true;
        setReturnValues("Sorry..", "Needs to contain lower case, upper case and number", "#pass","right");
    }

    if(pass != passconf) {
        req = true;
        setReturnValues("Sorry..", "Passwords need to match", "#passconf","right");
    }


    if(req === true){
        return;
    }

    fd.append('username',username);
    fd.append('surname',surname);
    fd.append('name',name);
    fd.append('pass',pass);
    fd.append('email',email);
    fd.append('country',country);
    fd.append('city',city);

    sendData(fd);

}

function setValues(title,button,func){
    $(".modal-title").text(title);
    $("button").filter(".mybtn").text(button);
    $("button").filter(".mybtn").attr("onclick",func);
}