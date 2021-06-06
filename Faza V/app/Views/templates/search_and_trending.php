
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <figure id="trending">
                <figcaption id="tr-title">&emsp; &emsp; &emsp; Trending places
                </figcaption>
            </figure>
        </div>
        <div class="offset-6 col-4">
            <div id="search" class="text-center">
                <span id="search-title">Have you got a destination in mind?</span>
                <div id="search-box">
                    <input id="search-txt" type="text" placeholder="Type to search for places">
                </div>
            </div>
        </div>
    </div>
</div>



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