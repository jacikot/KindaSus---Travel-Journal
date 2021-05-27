$(document).ready(function () {
    $(".options-u").click(function () {
        $("#user-to-delete").text($(this).attr("userName")).attr("userId", $(this).attr("userId"));
    });
    $("#confirmDelete").click(function () {
       window.location.href = "http://localhost:8080/Admin/deleteUser/" +  $("#user-to-delete").attr("userId");
    });
});