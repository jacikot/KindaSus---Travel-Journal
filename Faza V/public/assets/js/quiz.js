
var currQuestion = 1;
var alreadyAnswered = [0,0,0,0,0];

function prevQuestion(url){
    currQuestion --;
    let url1 = url+'/prevQuestion';



}
function findSelected(){
    let selected = 0;
    selected = $('#1').is(":checked")? 1 : 0;
    if(selected !== 0) return selected;
    selected = $('#2').is(":checked")? 2:  0;
    if(selected !== 0) return selected;
    selected = $('#3').is(":checked")? 3 : 0;
    if(selected !== 0) return selected;
    selected = $('#4').is(":checked")? 4 : 0;
    return selected;
}

let end = 0;
// proveri ako korisnik refreshuje sta se desava
function nextQuestion(url){

    let url1 = url+'/nextQuestion';
    let selected = 0;
    selected = findSelected();
    if(currQuestion !== 1 && selected === 0){
        alert("U need to answer!");
        return;
    }
    if(currQuestion === 5) end = true;

    $.ajax({
        url: url1,
        type: "POST",
        data: {
            'currQuestion': currQuestion,
            'selected' : selected
        }
    }).done(function(data) {
        if(end === true){
            $("#dugme").text("");
            $("#dugme").text("Get your recommendation!");
            end = false;
        }
        let prog = currQuestion - 2;
        if(prog >= 1) {
            $("#prev").attr("disabled",false);
        }
        $("#prog").attr("style","width:"+prog*20+"%");
        $("#prog").text(prog+"/5");
        let vr = data.split(",");
        if(vr[0] === "gotovo"){

            window.location.href = url +"/getRecommendation/"+vr[1];
            return;
        }
        $("#question").text(vr[0]);
        for(let i = 1; i < 5;i++){
            $("#"+i).prop("checked",false);

            $("#"+i).hide();
            let j = i+""+i;
            $("#"+j).text("");
        }
        for(let i = 1;i<vr.length;i++){
            $("#"+i).show();
            let j = i+""+i;
            $("#"+j).text(vr[i]);
        }

    })

    currQuestion ++;

}