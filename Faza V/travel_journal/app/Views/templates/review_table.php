<div id="a">
<div class="container text-center" style="color: white;">
    <div class="row">
        <div class="col-11">
            <h2 id="place-title">
                <i class="fas fa-star"></i>
                &nbsp;User reviews - <?php
                foreach ($placeAndCountry as $plc) {
                    echo "$plc->place, $plc->country";
                } ?>
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
                                <a class="review" href="<?= site_url("Guest/review_guest/$review->id") ?>">
                                    <div class="col-1"><img class="avatar" src="<?= base_url("assets/images/slike/avatar.png") ?>"></div>
                                    <div class="col-3"><span class="username"><?= $review->username ?></span></div>
                                    <div class="col-4"><span class="review-title"><?= $review->title ?></span></div>
                                    <div class="col-2"><span class="tokens"><?= $review->tokens ?>&nbsp;&nbsp;<i class="fas fa-star"></i></span></div>
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