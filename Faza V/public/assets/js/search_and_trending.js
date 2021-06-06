
//var arr = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vanu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

$(document).ready(function () {

    initApi();

    let autocomplete, service;

    function initApi() {
      let script = document.createElement('script');
      script.src = 'https://maps.googleapis.com/maps/api/js?' +
          'key=AIzaSyCUy2DENYeQ9G2zDbrSw0Dr06ESnDUHWNk&libraries=places&callback=initAutocompleteAndTrending';
      script.async = true;

      window.initAutocompleteAndTrending = function() {

          initAutocomplete(autocomplete);
          initTrendingService(service);
      };

    window.addEventListener("load", event => {
        setTimeout(function () {
            for (let i = 0; i < 6; i++) {
                let image = document.querySelector("#tr-gallery-item-" + i + " .tr-gallery-img");
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
        image.src = 'https://flagcdn.com/w2560/' + countryCode.toLowerCase() + '.png';
        image.style.height = 'auto';
    }

    let isLoaded = image.complete && image.naturalHeight !== 0;
    if (isLoaded) {
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

        if (!countryFound || !placeFound) {
            $("#bad-input-modal").modal('show');
            $("#search-txt").val("");
            return;
        }

        let placeName = place.long_name;
        let countryName = country.long_name;
        let countryCode = country.short_name;
        // alert("place = " + placeName + ", country = " + countryName + ", country code = " + countryCode);
        window.location.href = "http://localhost:8080/ListOfReviews/?" + "&idPlc=" + "" +
            "&placeName=" + placeName + "&countryName=" + countryName + "&countryCode=" + countryCode;
    });
}

function initTrendingService(service) {
    service = new google.maps.places.PlacesService(document.createElement('div'));

    $.post("http://localhost:8080/SearchAndTrending/getTrendingPlaces", function (data) {

        let trending, a = 0;
        if (a == 0) {
            trending = JSON.parse(data);
            // alert(JSON.stringify(trending));
        }
        else {
            trending = [{
                'placeName' : "Rock",
                'countryName' : 'United States of America',
                'countryCode' : "US"
            }, {
                'placeName' : "Zaovine",
                'countryName' : 'Serbia',
                'countryCode' : "RS"
            }, {
                'placeName' : "Monte Carlo",
                'countryName' : 'Monaco',
                'countryCode' : "MC"
            }, {
                'placeName' : "Lima",
                'countryName' : 'Peru',
                'countryCode' : "PE"
            }, {
                'placeName' : "Dakar",
                'countryName' : 'Senegal',
                'countryCode' : "SN"
            }, {
                'placeName' : "Zanzibar",
                'countryName' : 'Tanzania',
                'countryCode' : "TZ"
            }];
        }
        initTrending(service, trending);
    });
}

function initTrending(service, trending) {
    let trendingObj = $("#trending");
    let gallery = $("<div></div>").attr("id", "tr-gallery");
    for (let i = 0; i < trending.length; i++) {
        let idPlc = trending[i].idPlc;
        let placeName = trending[i].placeName;
        let countryName = trending[i].countryName;
        let countryCode = trending[i].countryCode;

        let figure = $("<figure></figure>").attr("id", "tr-gallery-item-" + i).addClass("tr-gallery-frame");
        let image = $("<img>").addClass("tr-gallery-img").attr("alt", "Loading...");

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

        let span = $("<span></span>").text(placeName + ", " + countryName);
        let caption = $("<figcaption></figcaption>").append(span);

        image.on("click", function() {
            let img = $(this);
            window.location.href = "http://localhost:8080/ListOfReviews/?" +
                "&idPlc=" + idPlc + "&placeName=" + placeName +
                "&countryName=" + countryName + "&countryCode=" + countryCode;
        });

        gallery.append(figure.append(image).append(caption));
    }
    trendingObj.append(gallery);
}