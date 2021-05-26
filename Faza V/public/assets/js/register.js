
var minLengthUser = 6;
var maxLengthUser = 20;

var minLengthPass = 6;
var maxLengthPass = 20;


function register(){

    let username = document.getElementById("username").value;
    let name = document.getElementById("name").value;
    let pass = document.getElementById("pass").value;
    let passconf = document.getElementById("passconf").value;
    let email = document.getElementById("email").value;
    let country = document.getElementById("country").value;
    let city = document.getElementById("city").value;

    let fd = new FormData();
    let files = $('#file')[0].files;

    if(files.length > 0 ) {
        fd.append('file', files[0]);
    }

    if(pass=="" || passconf=="" ||  email=="" || country == "" || name=="" || city=="" ){
        alert("All are required! except avatar image");
        return;
    }

    error = "";
    if(username < minLengthUser || username > maxLengthUser){
        error += "Username size not adequate \n"
    }

    if(pass < maxLengthPass || pass < maxLengthPass){
        error += "Password size not adequate"
    }

    //moras da dodas za surname i name da su kraci
    // i da proveris formu e-maila

    if (error !== ""){
        alert(error);
        return;
    }

    if(/^\w/.test(username) ===  false || /^\d/.test(username) ===  true){
        alert("Needs to start with a letter or _");
        return;
    }

    if(/^\w+$/.test(username) === false){
        alert("Needs to have _, A or a");
        return;
    }

    if(/[a-z]/.test(pass) === false || /[A-Z]/.test(pass) === false || /\d/.test(pass)=== false){
        alert("Inadequate password form!");
    }

    if(pass != passconf) {
        alert("ne poklapaju se!");
        return;
    }

    fd.append('username',username);
    fd.append('surname',username);
    fd.append('name',name);
    fd.append('pass',pass);
    fd.append('email',email);
    fd.append('country',country);
    fd.append('city',city);

    sendData(fd);

}



function goToMap(){
    alert("Mapa");
}

function setValues(title,button,func){
    $(".modal-title").text(title);
    $("button").filter(".mybtn").text(button);
    $("button").filter(".mybtn").attr("onclick",func);
}