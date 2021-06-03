<div id="search" class="text-center">
    <span id="search-title">Have you got a destination in mind?</span>
    <div id="search-form">
        <div id="search-box">
            <input id="search-txt" type="text" placeholder="Type to search for places">
            <div id="ac-list" class="overflow-auto"></div>
        </div>
        <button id="search-btn">
            <i class="fas fa-search" style="font-size: 17px;"></i>
        </button>
    </div>
</div>

<figure class="trending">
    <div class="tr-gallery">
        <figure class="tr-gallery-frame tr-gallery-item-1">
            <a href="list_of_reviews_guest.html">
                <img class="tr-gallery-img" src="<?= base_url("assets/images/exit.jpg") ?>" alt="exit">
            </a>
            <figcaption>EXIT</figcaption>
        </figure>
        <figure class="tr-gallery-frame tr-gallery-item-2">
            <a href="list_of_reviews_guest.html">
                <img class="tr-gallery-img" src="<?= base_url("assets/images/sunset.jpg") ?>" alt="sunset">
            </a>
            <figcaption>Sunset</figcaption>
        </figure>
        <figure class="tr-gallery-frame tr-gallery-item-3">
            <a href="list_of_reviews_guest.html">
                <img class="tr-gallery-img" src="<?= base_url("assets/images/manastir.jpg") ?>" alt="manastir">
            </a>
            <figcaption>Manastir</figcaption>
        </figure>
        <figure class="tr-gallery-frame tr-gallery-item-4">
            <a href="list_of_reviews_guest.html">
                <img class="tr-gallery-img" src="<?= base_url("assets/images/klasje.jpg") ?>" alt="klasje">
            </a>
            <figcaption>Livada</figcaption>
        </figure>
        <figure class="tr-gallery-frame tr-gallery-item-5">
            <a href="list_of_reviews_guest.html">
                <img class="tr-gallery-img" src="<?= base_url("assets/images/water.jpg") ?>" alt="water">
            </a>
            <figcaption>Trebinje</figcaption>
        </figure>
        <figure class="tr-gallery-frame tr-gallery-item-6">
            <a href="list_of_reviews_guest.html">
                <img class="tr-gallery-img" src="<?= base_url("assets/images/kucica.jpg") ?>" alt="kucica">
            </a>
            <figcaption>Idila</figcaption>
        </figure>
    </div>
    <figcaption class="tr-title">&emsp; &emsp; &emsp; Trending places
    </figcaption>
</figure>

<div class="modal fade" id="bad-input-modal" tabindex="-1" role="dialog" style="margin-top: -100px">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">Try again, buddy ...</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="modal-message">You have entered a place that doesn't exist.. Such a dreamer!</span>
            </div>
            <div class="modal-footer">
                <button type="button" id="modal-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>