<div class="container-fluid">
    <div class="row">
      <div class="offset-1 col-1">
         <?php if (isset($reviews) && count($reviews) > 0) {
            echo $this->include('templates/sort_by');
          } ?>
      </div>

      <div class="col-8 text-center">
        <table id="outer-table" style="width: 100%">
          <caption>
            <h1>
              <i class="fas fa-star"></i>
              &nbsp;User reviews - <?= $placeAndCountry ?>&nbsp;
                <img src="<?= "https://flagcdn.com/40x30/".strtolower($countryCode).".png" ?>" style="width:40px;height:30px;">&nbsp;
              <i class="fas fa-star"></i>
            </h1>
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
                                  <a class="review" href="<?php
                                  $_SESSION['id_rev'] = $review->idRev;
                                  echo site_url("Review");
                                  ?>">
                                      <div class="col-1"><img class="avatar" src="<?= base_url("assets/images/avatar.png") ?>"></div>
<!--                                      <div class="col-1"><img class="avatar" src="<?//= base_url($review->avatarPath) ?>"></div>-->
                                      <div class="col-3"><span class="username"><?= $review->username ?></span></div>
                                      <div class="col-4"><span class="title"><?= $review->title ?></span></div>
                                      <div class="col-2">
                                          <div class="tokens">
                                              <span class="token-cnt"><?= $review->tokens; ?>&nbsp;</span>
                                              <?php if ($idUsr != null && $review->idOwr != 1) {          // USER / GUEST 2
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