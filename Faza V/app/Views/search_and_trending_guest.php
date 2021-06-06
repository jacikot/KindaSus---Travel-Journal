<!-- author: Jovan Djordjevic -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/7d57026c7c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="<?= base_url("assets/js/search_and_trending.js") ?>"></script>
    <link rel="stylesheet" href="<?= base_url("assets/css/search_and_trending_guest.css")?>">
    <link rel="icon" href="<?= base_url("assets/images/logo_icon.png") ?>">
    <title>Travel Journal</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 mt-3" id="header">
            <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
            <div>
                <button id="back" class="btn btn-outline-light">
                    Home
                </button>
                <button id="login" class="btn btn-outline-light" style="margin: 0 10px">
                    Continue With Your Travels
                </button>
                <button id="register" class="btn btn-outline-light">
                    Become A traveller
                </button>
            </div>
        </div>
    </div>
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