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
    <link rel="stylesheet" href="<?= base_url("assets/css/badges.css")?>">
    <link rel="icon" href="<?= base_url("assets/images/logo_icon.png") ?>">
    <title>Travel Journal</title>
    <script>
        $(document).ready(function () {
            $("#badges-table img").popover();

            $(this).on("click", "#go-to-map", function (e) {
                window.location.href = "http://localhost:8080/Map";
            });
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 mt-3" id="header">
            <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
            <div>
                <button id="go-to-map" class="btn btn-outline-light">
                    Go to Map
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="offset-1 col-7">
            <table id="badges-table">
                <caption>My badges</caption>
                <?php for ($i = 0; $i < 3; $i++) {
                    ?>
                    <tr class="col-md-4 col-lg-12"> <?php
                    for ($j = 0; $j < 5; $j++) {
                        $badge = $badges[5 * $i + $j];
                        ?>
                            <td>
                                <div>
                                    <img src="<?php
                                    if (isset($badge->user))
                                        echo base_url("assets/images/gold_star_1.png");
                                    else
                                        echo base_url("assets/images/gold_star_2.png"); ?>"
                                         data-original-title="<?= $badge->title ?>"
                                         data-content="<?= $badge->description ?>"
                                         data-placement="top" data-trigger="hover">
                                </div>
                            </td>
                    <?php } ?>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="col-4 my-auto">
            <h1 id="quote">“The journey<br> is the reward.”</h1>
        </div>
    </div>
</div>
</body>
</html>