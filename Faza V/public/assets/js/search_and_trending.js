
//var arr = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vanu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

$(document).ready(function () {

    let currentFocus, currentId, currentCode;

    // MOZDA OGRANICENJE KOLIKO SLOVA NA POCETKU TREBA DA UNESE ZBOG VELIKOG BROJA MESTA

    $("#search-txt").on("input", function () {
      var searchTxt = $(this);

      clearTimeout(searchTxt.data('timeout'));

      searchTxt.data('timeout', setTimeout(function() {
        let val = searchTxt.val();
        let list = $("#ac-list");
        currentFocus = -1;
        currentId = -1;
        currentCode = -1;

        if (val === "") return;

        if (list.children().length > 0) {
          let listItems = list.find("div");
          for (let i = 0; i < listItems.length; i++) {
            let curr = listItems.eq(i);
            let matchingPlace = curr.attr("data-place").substr(0, val.length);
            let matchingCountry = curr.attr("data-country").substr(0, val.length);
            if (matchingPlace.toLowerCase() === val.toLowerCase()) {
              curr.empty();
              curr.append("<strong>" + matchingPlace + "</strong>");
              curr.append(curr.attr("data-place").substr(val.length));
              curr.append(", ");
              curr.append(curr.attr("data-country"));
            }
            else if (matchingCountry.toLowerCase() === val.toLowerCase()) {
              curr.empty();
              curr.append(curr.attr("data-place"));
              curr.append(", ");
              curr.append("<strong>" + matchingCountry + "</strong>");
              curr.append(curr.attr("data-country").substr(val.length));
            }
            else curr.remove();
          }
          makeRound(list.children().length === 0);
          return;
        }

        $.get("http://localhost:8080/SearchAndTrending/search", {
          'inputVal' : val
        }, function(data) {
          let results = JSON.parse(data);

          for (let i = 0; i < results.length; i++) {
            let listItem = $("<div></div>").addClass("ac-list-item");
            let matchingPlace = results[i].place.substr(0, val.length);
            let matchingCountry = results[i].country.substr(0, val.length);

            if (matchingPlace.toLowerCase() === val.toLowerCase()) {
              listItem.append("<strong>" + matchingPlace + "</strong>");
              listItem.append(results[i].place.substr(val.length));
              listItem.append(", ");
              listItem.append(results[i].country);
            }
            else {
              listItem.append(results[i].place);
              listItem.append(", ");
              listItem.append("<strong>" + matchingCountry + "</strong>");
              listItem.append(results[i].country.substr(val.length));
            }
            listItem.attr("data-id-plc", results[i].id);
            listItem.attr("data-place", results[i].place);
            listItem.attr("data-country", results[i].country);
            listItem.attr("data-code", results[i].code);
            list.append(listItem);
          }
          makeRound(list.children().length === 0);
        });

        // for (let i = 0; i < arr.length; i++) {
        //   let matchingPart = arr[i].substr(0, val.length);
        //   if (matchingPart.toLowerCase() === val.toLowerCase()) {
        //     let listItem = $("<div></div>").addClass("ac-list-item");
        //     listItem.append("<strong>" + matchingPart + "</strong>");
        //     listItem.append(arr[i].substr(val.length));
        //     listItem.attr("data-value", arr[i]);
        //     list.append(listItem);
        //   }
        // }
        // makeRound(list.children().length === 0);
      }, 250));
    });

    $("#search-txt").on("keydown", function(e) {
      let list = $("#ac-list div");
  
      if (e.keyCode === 40) {                            // DOWN
        if (currentFocus !== -1) {
          list.eq(currentFocus).removeClass("ac-active");
        }
        currentFocus = (currentFocus + 1) % list.length;
        list.eq(currentFocus).addClass("ac-active");
      }
      else if (e.keyCode === 38) {                       // UP
        if (currentFocus !== -1) {
          list.eq(currentFocus).removeClass("ac-active");
          currentFocus = (currentFocus + list.length - 1) % list.length;

        }
        else currentFocus = list.length - 1;
        list.eq(currentFocus).addClass("ac-active");
      }
      else if (e.keyCode === 13) {                       // ENTER
        e.preventDefault();
        if (currentFocus !== -1) {
          let selected = $(".ac-active");
          $(this).val(selected.attr("data-place") + ", " + selected.attr("data-country"));
          currentId = selected.attr("data-id-plc");
          currentCode = selected.attr("data-code");
          currentFocus = -1;
          makeRound(true);
          $("#ac-list").empty();
        }
        //window.location.href = "http://www.etf.rs";
      }
      else if (e.keyCode === 9) {                        // TAB
        e.preventDefault();
        if ($('#ac-list').children().length > 0) {
          let first = $(".ac-list-item").first();
          $(this).val(first.attr("data-place") + ", " + first.attr("data-country"));
          currentId = first.attr("data-id-plc");
          currentCode = first.attr("data-code");
          makeRound(true);
          $("#ac-list").empty();
        }
      }
      else if (e.keyCode === 8) {                        // BACKSPACE
        makeRound(true);
        $("#ac-list").empty();
      }
    });

    $("#search-txt").on("focus", function () {
      let list = $("#ac-list");
      makeRound(list.children().length === 0);
      list.show();
    });

    $("#search-txt").on("blur", function () {
      makeRound(true);
      $("#ac-list").hide();
    });

    $("#ac-list").on("mousedown", ".ac-list-item", function() {
      let clicked = $(this);
      $("#search-txt").val(clicked.attr("data-place") + ", " + clicked.attr("data-country"));
      currentId = clicked.attr("data-id-plc");
      currentCode = clicked.attr("data-code");
      makeRound(true);
      $("#ac-list").empty();
      //window.location.href = "http://www.etf.rs";
    });

    $("#search-btn").on("click",function () {
      let idPlc = currentId;
      let countryCode = currentCode;

      if (idPlc === -1 || countryCode === -1) {
        $("#bad-input-modal").modal('show');
        $("#search-txt").val("");
        makeRound(true);
        $("#ac-list").empty();
        return;
      }

      let placeAndCountry = $("#search-txt").val();

      window.location.href = "http://localhost:8080/ListOfReviews/index?idPlc=" + idPlc +
          "&placeAndCountry=" + placeAndCountry + "&countryCode=" + countryCode;
      // $.get("http://localhost:8080/ListOfReviews/index", {
      //   'idPlc' : idPlc,
      //   'placeAndCountry' : placeAndCountry,
      //   'countryCode' : countryCode
      // });
    });
});

function makeRound(bool) {
  $("#search-txt").css({
    "border-bottom-left-radius" : (bool ? "15px" : "0"),
    "border-bottom-right-radius" : (bool ? "15px" : "0")
  });
}