
$(document).ready(function () {

    $(".tokenStar").popover();

    $("#fail-banner").html("OOPS! Looks like we haven't had a review" +
        " for this place yet. How about you go and be the first to spread the word about how awesome this place is? :)");

    $(this).on("click", ".tokenStar", function (e) {
        e.preventDefault();

        let starContainer = $(this);
        let star = starContainer.find("i");
        let vote = (star.hasClass("far") ? "up" : "down");
        star.toggleClass("far fas");
        starContainer.attr("data-content", star.hasClass("far") ? "Helpful" : "Not helpful");

        let tokenContainer = starContainer.prev();
        let tokenCnt = parseInt(tokenContainer.text());
        tokenCnt += (vote === 'up' ? 1 : -1);
        tokenContainer.html(tokenCnt + "&nbsp;");
        $.post("http://localhost:8080/ListOfReviews/updateTokens", { // zahtev serveru da u bazu upise promenu oko toga sta je lajkovano
            'idRev' : starContainer.attr("data-id_rev"),
            'idOwr' : starContainer.attr("data-id_owr"),
            'vote' : vote
        });
    });
});

function sortBy() {

    let type = $('input[name="type"]:checked').val();
    let direction = $('input[name="direction"]:checked').val();

    let tBody = $("#review-table tbody");
    tBody.find("tr").sort(function (a, b) {
        if (type == 'tokens') {
            return (parseInt($(a).children('td').eq(0).find(".token-cnt").html()) -
                parseInt($(b).children('td').eq(0).find(".token-cnt").html())) * ((direction == 'ASC') ? 1 : -1);
        }
        let aTmp = $(a).children('td').eq(0).find(".date").text().split(".");
        let bTmp = $(b).children('td').eq(0).find(".date").text().split(".");
        let aDate = aTmp[2] + "-" + aTmp[1] + "-" + aTmp[0];
        let bDate = bTmp[2] + "-" + bTmp[1] + "-" + bTmp[0];
        return aDate.localeCompare(bDate) * ((direction == 'ASC') ? 1 : -1);
    }).appendTo(tBody);
}

// function sortBy(idPlc, usrSet) {
//     $.get("http://localhost:8080/ListOfReviews/refresh", {
//         'type' : $('input[name="type"]:checked').val(),
//         'direction' : $('input[name="direction"]:checked').val(),
//         'place' : idPlc,
//         'usrSet': usrSet
//     }, function(data) {
//         let table = $("#review-table");
//         table.empty();
//         let reviews = JSON.parse(data);
//
//         let reviewGuest = "http://localhost:8080/ListOfReviews/reviewGuest/";
//         let reviewUser = "http://localhost:8080/ListOfReviews/reviewUser/";
//
//         for (let i = 0; i < reviews.length; i++) {
//             // AVATAR PATH IDIIIOTEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
//
//             let avatarPath = "http://localhost:8080/assets/images/avatar.png";
//             let oldDate = reviews[i].date.split("-");
//             let newDate = oldDate[2] + "." + oldDate[1] + "." + oldDate[0] + ".";
//             let tokens = $("<div></div>").addClass("tokens");
//
//             if (usrSet == false && reviews[i].idOwr != 1) {              // VRATI 4
//                 tokens.append($("<span></span>").html(reviews[i].tokens + "&nbsp;").addClass("token-cnt"));
//                 let tokenStar = $("<i></i>").addClass("tokenStar");
//
//                 tokenStar.addClass(reviews[i].foundUseful == 0 ? "far fa-star" : "fas fa-star");
//
//                 tokenStar.attr("data-id_rev", reviews[i].idRev);
//                 tokenStar.attr("data-id_owr", reviews[i].idOwr);
//
//                 let star = $("<div></div>").addClass("star");
//                 star.attr("data-content", reviews[i].foundUseful == 0 ? "Helpful": "Not helpful");
//                 star.attr("data-placement", "bottom");
//                 star.attr("data-trigger", "hover");
//
//                 tokens.append(star.append(tokenStar));
//             }
//             else {
//                 tokens.html(reviews[i].tokens +"&nbsp;&nbsp;<i class='fas fa-star'></i>");
//             }
//
//             let row = $("<tr></tr>").append(
//                 $("<td></td>").append(
//                     $("<a></a>").addClass("review")
//                     .attr("href", ((usrSet === true) ? reviewUser : reviewGuest) + reviews[i].idRev).append(
//                         $("<div></div>").addClass("col-1").append(
//                             $("<img>").addClass("avatar").attr("src", avatarPath)
//                         )).append(
//                         $("<div></div>").addClass("col-3").append(
//                             $("<span></span>").addClass("username").text(reviews[i].username)
//                         )).append(
//                         $("<div></div>").addClass("col-4").append(
//                             $("<span></span>").addClass("title").text(reviews[i].title)
//                         )).append(
//                         $("<div></div>").addClass("col-2").append(tokens)
//                         ).append(
//                         $("<div></div>").addClass("col-2").append(
//                             $("<span></span>").addClass("date").text(newDate)
//                         ))));
//             table.append(row);
//         }
//         $(".star").popover();
//     });
// }


