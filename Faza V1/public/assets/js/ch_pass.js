function showMes(){
    document.getElementById('note').style.display="block";
}

function changePass(){
    document.getElementById("note").innerText="";
    let pas1=document.getElementById("pas1").value;
    let pas2=document.getElementById("pas2").value;

    if(pas1===""||pas2===""){
        document.getElementById("note").innerText="Password is not entered";
        document.getElementById("note").style.color="darkred";
        return;
    }

    if(!/[a-z]/.test(pas1)||!/[A-Z]/.test(pas1)||!/\d/.test(pas1)){
        document.getElementById("note").innerText="Password must include at least one lower and uppercase letter and one digit";
        document.getElementById("note").style.color="darkred";
        return;
    }
    if(!/.{6,20}/.test(pas1)){
        document.getElementById("note").innerText="Password must be at least 6 characters long and not longer than 20 characters";
        document.getElementById("note").style.color="darkred";
        return;
    }

    if(pas1!=pas2){
        document.getElementById("note").innerText="Password does not match";
        document.getElementById("note").style.color="darkred";
        return;
    }
    ajaxCall(pas1,pas2);


}

function guestMode(){
    let link=document.getElementById("back");
    link.setAttribute("href",backGuest);
    let button=document.getElementById("backbutton");
    button.innerText="Back";
}


