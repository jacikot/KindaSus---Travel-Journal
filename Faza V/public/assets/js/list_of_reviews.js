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


function sortBy(typeBool, directionBool) {
    alert('a');
    let type, direction;
    if (typeBool == true)
        type = 'tokens';
    else type = 'date';
    if (directionBool == true)
        direction = 'DESC';
    else direction = 'ASC';
    $.ajax({
        type: "GET",
        url: "app/Controllers/Guest/refresh?type=" + type + "&direction=" + direction
    }).done(function (reviews) {
        $reviews = reviews;
        $("#tokens").attr("checked", type == null || type === 'tokens');
        $("#date").attr("checked", type === 'date');
        $("#asc").attr("checked", direction === 'ASC');
        $("#desc").attr("checked", direction == null || direction === 'DESC');
    });
}

$("#refresh-btn").click(function () {
    sortBy($("#tokens").val('checked'),$('#desc').val('checked'));
});
