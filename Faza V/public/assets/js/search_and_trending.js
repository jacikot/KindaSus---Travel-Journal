
//var arr = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vanu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

$(document).ready(function () {

    initApi();

    let autocomplete, service;

    // initialization of the Google Maps Javascript API used to implement the search of places,
    // and to get photos of places on demand

    function initApi() {
        let script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?' +
            'key=AIzaSyCUy2DENYeQ9G2zDbrSw0Dr06ESnDUHWNk&libraries=places&callback=initAutocompleteAndTrending';
        script.async = true;

        window.initAutocompleteAndTrending = function() {

            initAutocomplete(autocomplete);

            service = new google.maps.places.PlacesService(document.createElement('div'));

            // an AJAX request to the controller to get all the trending places information

            $.post("http://localhost:8080/SearchAndTrending/getTrendingPlaces", function (data) {

                let trending = JSON.parse(data);
                // alert(JSON.stringify(trending));
                initTrending(service, trending);
            });
        };

        window.addEventListener("load", event => {

            // if an image fails to load, reinitialization of each such
            // image is tried a few more times during the loading of the page

            setTimeout(function () {
                for (let i = 0; i < 6; i++) {
                    let image = document.querySelector("#trending-image-" + i);
                    let isLoaded = image.complete && image.naturalHeight !== 0;
                    if (!isLoaded) {
                        // alert("not loaded " + i);
                        let imageHandler = setInterval(function () {
                            loadImage(service, image, imageHandler, i);
                        }, 100);
                    }
                }
            }, 100);

        });
        document.head.appendChild(script);
    }

    $(this).on("click", "#go-to-map", function (e) {
        window.location.href = "http://localhost:8080/Map";
    });

    $(this).on("click", "#back", function (e) {
        window.location.href = "http://localhost:8080/GuestLogin";
    });

    $(this).on("click", "#login", function (e) {
        window.location.href = "http://localhost:8080/GuestLogin/showLogin";
    });

    $(this).on("click", "#register", function (e) {
        window.location.href = "http://localhost:8080/GuestRegister/showRegister";
    });
});

let cnt = [0, 0, 0, 0, 0, 0];

function loadImage(service, image, imageHandler, i) {
    let placeName = image.getAttribute("data-place_name");
    let countryName = image.getAttribute("data-country_name");
    let countryCode = image.getAttribute("data-country_code");

    if (cnt[i] < 5) {
        service.findPlaceFromQuery({
                fields : ['photos'],
                query : placeName + " " + countryName
            },
            function(results, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    //console.log(placeName);
                    let photos = results[0].photos;
                    image.setAttribute("src", photos[0].getUrl());
                }
                else {
                    console.log('error');
                }
            }
        );
    }
    else {

        // failed to load the image for the 6th time, so
        // a country flag is displayed instead

        image.src = 'https://flagcdn.com/w2560/' + countryCode.toLowerCase() + '.png';
    }

    let isLoaded = image.complete && image.naturalHeight !== 0;
    if (isLoaded) {

        // the image has been successfully loaded

        clearInterval(imageHandler);
        // alert("finally loaded " + placeName);
    }
    else {
        cnt[i]++;
    }
}

function initAutocomplete(autocomplete) {
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('search-txt'), {
            types: ['(cities)'],
            fields: ['name', 'address_components']
        });

    google.maps.event.addListener(autocomplete, 'place_changed', function () {

        // whenever a user types something into the search bar, this event is fired

        let result = autocomplete.getPlace();
        // alert(JSON.stringify(result));

        if (!result.address_components) {
            $("#bad-input-modal").modal('show');
            $("#search-txt").val("");
            return;
        }

        let place, country;
        let placeFound = false, countryFound = false;

        for (let i = 0; i < result.address_components.length; i++) {
            for (let j = 0; j < result.address_components[i].types.length; j++) {
                if (result.address_components[i].types[j] == 'country') {
                    countryFound = true;
                    country = result.address_components[i];
                }
                if (result.address_components[i].types[j] == 'locality') {
                    placeFound = true;
                    place = result.address_components[i];
                }
            }
        }

        if (!countryFound || !placeFound) {             // bad results given, abort
            $("#bad-input-modal").modal('show');
            $("#search-txt").val("");
            return;
        }

        let placeName = place.long_name;
        let countryName = country.long_name;
        let countryCode = country.short_name;
        // alert("place = " + placeName + ", country = " + countryName + ", country code = " + countryCode);
        window.location.href = "http://localhost:8080/ListOfReviews?" + "idPlc=" + "" +
            "&placeName=" + placeName + "&countryName=" + countryName + "&countryCode=" + countryCode;
    });
}

function initTrending(service, trending) {

    let widths = [60, 40, 15, 24, 22, 24, 15];

    let tableTop = $("#trending-top");
    let row = $("<tr></tr>");

    for (let i = 0; i < 2; i++) {
        row.append(makeCell(service, trending[i], widths[i], i));
    }
    tableTop.append(row);

    let tableBottom = $("#trending-bottom");
    row = $("<tr></tr>");

    for (let i = 2; i < trending.length; i++) {
        row.append(makeCell(service, trending[i], widths[i], i));
    }
    tableBottom.append(row);
}

function makeCell(service, trendingPlace, width, i) {
    let idPlc = trendingPlace.idPlc;
    let placeName = trendingPlace.placeName;
    let countryName = trendingPlace.countryName;
    let countryCode = trendingPlace.countryCode;

    let cell = $("<td></td>").css("width", width + "%");
    let frame = $("<div></div>").addClass("trending-frame");
    let image = $("<img>").attr("alt", "Loading...").attr("id", "trending-image-" + i);

    image.attr("data-place_name", placeName)
        .attr("data-country_name", countryName)
        .attr("data-country_code", countryCode);

    service.findPlaceFromQuery({
            fields : ['photos'],
            query : placeName + " " + countryName
        },
        function(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                //console.log(placeName);
                let photos = results[0].photos;
                image.attr("src", photos[0].getUrl());
            }
            else {
                console.log('error');
            }
        }
    );

    let caption = $("<div></div>").addClass("trending-caption").html(placeName + ", " + countryName);

    image.on("click", function() {
        window.location.href = "http://localhost:8080/ListOfReviews?" +
            "idPlc=" + idPlc + "&placeName=" + placeName +
            "&countryName=" + countryName + "&countryCode=" + countryCode;
    });

    cell.append(frame.append(image).append(caption));
    return cell;
}