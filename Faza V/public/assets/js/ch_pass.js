

function changePass(){
    let pas1=document.getElementById("pas1").value;
    let pas2=document.getElementById("pas2").value;

    if(pas1===""||pas2==""){
        if(pas1=="")setReturnValues("Message","Field is required!","#pas1","right");
        if(pas2=="")setReturnValues("Message","Field is required!","#pas2","right");
        return;
    }

    if(!/[a-z]/.test(pas1)||!/[A-Z]/.test(pas1)||!/\d/.test(pas1)){
        setReturnValues("Message","Password must include at least one lower and uppercase letter and one digit!","#pas1","right");

        return;
    }
    if(!/.{6,20}/.test(pas1)){
        setReturnValues("Message","Password must be at least 6 characters long and not longer than 20 characters!","#pas1","right");
        return;
    }

    if(pas1!=pas2){
        setReturnValues("Message","Password does not match!","#pas2","right");
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

$(document).ready(function(){
   $(".container-fluid").fadeTo("slow",1);
});


function setReturnValues(t,c,id,pos){
    $(id).attr('data-toggle',"popover");
    //$(id).attr("title", t);
    $(id).attr("data-content", c);
    $(id).attr("data-placement", pos);
    $(id).popover();
    $(id).popover('enable');
    $(id).popover('show');
    setTimeout(function(){
        remove(id);
    },2000);
}
function remove(id){
    $(id).popover('disable');
    $(id).popover('hide');
}
