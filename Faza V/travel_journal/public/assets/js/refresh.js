$(document).ready(function () {

    function fjaa(reviews) {
        let fd = new FormData();
        let type = $('input[name="type"]:checked').val();
        let direction = $('input[name="direction"]:checked').val();
        fd.append('type' , type);
        fd.append('direction' , direction);
        fd.append('reviews' , reviews);


        $.ajax({
            url: "Guest/refresh",
            type: "GET",
            data: fd,
            processData: false,
            contentType: false,
        }).done(function(data) {
            alert(data);
        });
    }

});
function fja(reviews) {
    let fd = new FormData();
    let type = $('input[name="type"]:checked').val();
    let direction = $('input[name="direction"]:checked').val();
    fd.append('type' , type);
    fd.append('direction' , direction);
    fd.append('reviews' , JSON.stringify(reviews));

    $.ajax({
        url: "Guest/refresh",
        type: "GET",
        data: fd,
        processData: false,
        contentType: false,
    }).done(function(data) {
        alert(data)
        $("#review-table").load("app/Views/templates/review-table.php?reviews=" + data + " #review-table");
    });
}
