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
    <script src="<?= base_url("assets/js/list_of_reviews.js") ?>"></script>
    <link rel="stylesheet" href="<?= base_url("assets/css/list_of_reviews.css")?>">
    <link rel="icon" href="<?= base_url("assets/images/logo_icon.png") ?>">
    <title>Travel Journal</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 mt-3" id="header">
            <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
            <div>
                <button id="search-and-trending" class="btn btn-outline-light" style="margin: 0 10px">
                    Search & Trending
                </button>
                <button id="go-to-map" class="btn btn-outline-light">
                    Go to Map
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="offset-1 col-1">
            <?php if (isset($reviews) && count($reviews) > 0) {
                echo $this->include('templates/sort_by');
            } ?>
        </div>

        <div class="col-8 text-center">
            <table id="outer-table" style="width: 100%">
                <caption>
                    <i class="fas fa-star"></i>
                    &nbsp;User reviews - <?= $placeAndCountry ?>&nbsp;
                    <img src="<?= "https://flagcdn.com/40x30/".strtolower($countryCode).".png" ?>" style="width:40px;height:30px;">&nbsp;
                    <i class="fas fa-star"></i>
                </caption>
                <tbody>
                <tr>
                    <td>
                        <div class="overflow-auto"  style="height: 470px;">
                            <table id="review-table" class="table">
                                <?php
                                if (!isset($reviews) || count($reviews) == 0) {  ?>
                                    <div id="fail-banner"></div>
                                <?php }
                                else foreach ($reviews as $review) { ?>
                                    <tr>
                                        <td>

                                            <a class="review" href="ReviewOverview?idRev=<?= $review->idRev ?>">
                                                        <div class="col-1"><img class="avatar" src="<?= base_url($review->avatarPath) ?>"></div>
                                                <div class="col-3"><span class="username"><?= $review->username ?></span></div>
                                                <div class="col-4"><span class="title"><?= $review->title ?></span></div>
                                                <div class="col-2">
                                                    <div class="tokens">
                                                        <span class="token-cnt"><?= $review->tokens; ?>&nbsp;</span>
                                                        <?php if ($review->idOwr != $_SESSION['userId']) {
                                                            ?><div class="tokenStar"
                                                                   data-content="<?= $review->foundUseful == 0 ? "Helpful": "Not helpful" ?>"
                                                                   data-placement="bottom" data-trigger="hover"
                                                                   data-id_rev="<?= $review->idRev ?>"
                                                                   data-id_owr="<?= $review->idOwr ?>">
                                                            <i class="<?php
                                                            echo ($review->foundUseful == 0 ? "far fa-star" : "fas fa-star");
                                                            ?>"></i>
                                                            </div>
                                                        <?php  } else { ?>
                                                            <div class="star">
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                          <span class="date"><?php
                                              $dateParts = explode('-', $review->date);
                                              echo "$dateParts[2].$dateParts[1].$dateParts[0]."; ?></span>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
