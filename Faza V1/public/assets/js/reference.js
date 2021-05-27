function sendIt(id,url){
    $.ajax({
        url: url,
        type: "GET",
        data: {
            'id': id
        }
    }).done(function(data) {
        alert(data);
        });

}