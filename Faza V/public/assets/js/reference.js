function sendIt(id,url){
    $.ajax({
        url: url,
        type: "GET",
        data: {
            'id': id
        }
    }).done(function(data) {
        if(data === "Already in to-go list!"){
            $("#head").text("Sorry..")
            $("#telo").text(data);
        } else {
            $("#head").text("Congratulation!")
            $("#telo").text("Successfully added " + data + " to To-Go list!");
        }
        $("#myModal").modal();
        });

}