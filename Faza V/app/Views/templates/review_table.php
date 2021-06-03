    <div id="a">
    <div class="container text-center" style="color: white;">
        <div class="row">
            <div class="col-11">
                <h2 id="place-title">
                    <i class="fas fa-star"></i>&nbsp;&nbsp;
                    &nbsp;User reviews - <?= $placeAndCountry ?>&nbsp;
                    <img src="<?= "https://flagcdn.com/40x30/$countryCode.png" ?>" style="width:40px;height:30px;">&nbsp;&nbsp;&nbsp;
                    <i class="fas fa-star"></i>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <div class=" my-custom-scrollbar">
                    <table id="review-table" class="table" style="font-size: 20px;">
                        <?php
                        foreach ($reviews as $review) { ?>
                            <tr>
                                <td>
                                    <a class="review" href="
                                    <?php
                                            $_SESSION['id_rev'] = $review->id;
                                            echo site_url("Review/index/");
                                            ?>">
                                        <div class="col-1"><img class="avatar" src="<?= base_url("assets/images/avatar.png") ?>"></div>
                                        <div class="col-3"><span class="username"><?= $review->username ?></span></div>
                                        <div class="col-4"><span class="review-title"><?= $review->title ?></span></div>
                                        <div class="col-2"><span class="tokens">
                                                <span class="token-cnt"><?= $review->tokens ?></span>&nbsp;&nbsp;<i class="
                                        <?php
                                                if ($usrSet == true || $review->idOwr == 1) {                  // VRATI
                                                    echo "fas fa-star";
                                                }
                                                else {
                                                    if ($review->foundUseful == 0)
                                                        echo "far fa-star tokenStar";
                                                    else
                                                        echo "fas fa-star tokenStar";
                                                    echo "\" data-id_rev=\"$review->id\" data-id_owr=\"$review->idOwr";
                                                }
                                                 ?>"></i></span></div>
                                        <div class="col-2"><span class="date"><?php
                                                $dateParts = explode('-', $review->date);
                                                echo "$dateParts[2].$dateParts[1].$dateParts[0].";
                                                ?></span></div>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>