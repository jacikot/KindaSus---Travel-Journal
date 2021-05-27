
$('document').ready(function(){
    for(let i=1;i<6;i++){
        $("#"+i).hide();
    }
    for(let i=1;i<3;i++){
        $("#"+i).fadeIn(1500);
    }
    for(let i=3;i<6;i++){
        $("#"+i).fadeIn(2000);
    }
    alert("pana");
})
