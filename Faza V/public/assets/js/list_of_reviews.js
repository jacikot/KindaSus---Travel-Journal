
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
        $.post("http://localhost:8080/ListOfReviews/updateTokens", {
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
