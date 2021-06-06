
// There are three types of actions that involve a modal
// 0 - Mark review as private
// 1 - Delete user's account
// 2 - Log out of the application

$(document).ready(function () {

    // used for when there aren't any users in the database whatsoever :(

    let failBannerAll = $("#fail-banner-all");
    failBannerAll.html("OOPS! Looks like there are no users here, and therefore no reviews.. Let's start" +
        " sharing this masterpiece of an app!");

    // used for when there aren't any reviews in the database whatsoever :(

    $("#fail-banner-rev").html("OOPS! Looks like we haven't had reviews so far.. Let's just wait for these guys" +
        " to start travelling!");

    if ($("#user-table tbody tr").length === 0) {
        failBannerAll.show();
        $("#outer-table-1").hide();
        $("#outer-table-2").hide();
    }
    else {
        failBannerAll.hide();
    }

    $(document).on("click", ".mark-private", function (e) {

        // displaying a modal for confirmation

        e.preventDefault();
        $("#modal-confirm").show();
        $("#modal-close").html("Cancel");

        let clicked = $(this);
        let idRev = clicked.attr("data-id_rev");

        let title = $(".modal-title");
        title.text("Privacy alert!");

        let message = $("#modal-message");
        message.text("Are you sure you want to mark this review as private?");
        message.attr("data-type", 0).attr("data-id_rev", idRev);
    });

    $(document).on("click", ".delete-user", function (e) {

        // displaying a modal for confirmation

        e.preventDefault();
        $("#modal-confirm").show();
        $("#modal-close").html("Cancel");

        let clicked = $(this);
        let idUsr = clicked.attr("data-id_usr");
        let username = clicked.attr("data-username");

        let title = $(".modal-title");
        title.text("So long, partner!");

        let message = $("#modal-message");
        message.text("Are you sure you want to send " + username + " to history?");
        message.attr("data-type", 1).attr("data-id_usr", idUsr).attr("data-username", username);
    });

    $(document).on("click", "#log-out", function (e) {

        // displaying a modal for confirmation
        e.preventDefault();
        $("#modal-confirm").show();
        $("#modal-close").html("Cancel");

        let title = $(".modal-title");
        title.text("Come back soon, chief!");

        let message = $("#modal-message");
        message.text("Are you sure you want to leave the office?");
        message.attr("data-type", 2);
    });

    $(document).on("click", "#modal-confirm", function (e) {
        let message = $("#modal-message");
        $("#modal-confirm").hide();
        $("#modal-close").html("Close");

        let type = message.attr("data-type");

        // depending on the value of the type variable, a different kind
        // of action should be performed when the user clicks "Confirm"

        if (type == 0) {                                                // mark review as private
            let idRev = message.attr("data-id_rev");
            $.post("http://localhost:8080/Admin/markReviewAsPrivate", {   // an AJAX request to the controller
                'idRev' : idRev
            }, function () {
                $(".mark-private[data-id_rev='" + idRev + "']").remove();

                $(".modal-title").text("Success!");
                message.text("Review successfully marked as private!");
            });
        }
        else if (type == 1) {                                           // delete user's account
            let idUsr = message.attr("data-id_usr");
            let username = message.attr("data-username");
            $.post("http://localhost:8080/Admin/deleteUser", {          // an AJAX request to the controller
                'idUsr': idUsr
            }, function () {

                // delete the user and his reviews from the page

                $("#review-table tr:has(.delete-user[data-id_usr='" + idUsr + "'])").remove();
                $("#user-table tr:has(.delete-user[data-id_usr='" + idUsr + "'])").remove();

                if ($("#user-table tbody tr").length === 0) {
                    $("#fail-banner-all").show();
                    $("#outer-table-1").hide();
                    $("#outer-table-2").hide();
                    $("#sort-by").hide();
                }

                $(".modal-title").text("Success!");
                message.text("User " + username + " successfully removed!");

                // $("#admin-modal").modal({                  // ????
                //     backdrop: 'static',
                //     keyboard: false
                // });
                // setTimeout(function () {                                     // variant 2 - refreshing
                //     window.location.href = "http://localhost:8080/Admin";
                // }, 80500);
            });
        }
        else if (type == 2) {                                              // log out of the application
            $("#admin-modal").modal('hide');
            window.location.href = "http://localhost:8080/Logout";
        }
    });

    $(document).on("mouseleave", ".review", function (e) {
        $(this).find(".options-btn").dropdown("hide");
    });

    $(document).on("mouseleave", ".options-menu", function (e) {
        $(this).prev().dropdown("toggle");
    });

    $(".user .delete-user").popover();
});

function sortBy() {                                     // sorting the reviews using a certain criteria

    let type = $('input[name="type"]:checked').val();
    let direction = $('input[name="direction"]:checked').val();

    let tBody = $("#review-table tbody");
    tBody.find("tr").sort(function (a, b) {
        if (type == 'tokens') {
            return (parseInt($(a).children('td').eq(0).find(".tokens").html()) -
                parseInt($(b).children('td').eq(0).find(".tokens").html())) * ((direction == 'ASC') ? 1 : -1);
        }
        let aTmp = $(a).children('td').eq(0).find(".date").text().split(".");
        let bTmp = $(b).children('td').eq(0).find(".date").text().split(".");
        let aDate = aTmp[2] + "-" + aTmp[1] + "-" + aTmp[0];
        let bDate = bTmp[2] + "-" + bTmp[1] + "-" + bTmp[0];
        return aDate.localeCompare(bDate) * ((direction == 'ASC') ? 1 : -1);
    }).appendTo(tBody);
}