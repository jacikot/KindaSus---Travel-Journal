<!-- author: Jovan Djordjevic -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/7d57026c7c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/admin.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url("assets/css/admin.css") ?>">
    <link rel="icon" href="<?= base_url("assets/images/logo_icon.png") ?>">
    <title>Travel Journal</title>
</head>
<body>
<?php if (count($reviews) > 0) {
    echo $this->include('templates/sort_by');
} ?>

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-12 col-md-12 mt-3" id="header">
            <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
            <button id="log-out" data-toggle="modal" data-target="#admin-modal" class="btn btn-outline-light">
                Log Out
            </button>
        </div>
    </div>
    <h1 id="welcome">Welcome back, boss!</h1>
    <div class="row">
        <div class="offset-2 col-8 mt-4">
            <div id="fail-banner-all"></div>
        </div>
        <div class="col-8">
            <table id="outer-table-1">
                <caption>User reviews</caption>
                <tbody>
                <tr>
                    <td>
                        <div class="overflow-auto" style="height: 470px;">
                            <table id="review-table" class="table">
                                <?php
                                if (count($reviews) == 0 && count($users) > 0) {  ?>
                                    <div id="fail-banner-rev"></div>
                                <?php }
                                foreach ($reviews as $review) { ?>
                                    <tr>
                                        <td>
                                            <a class="review" href="<?php
                                            $_SESSION['id_rev'] = $review->idRev;
                                            echo site_url("ReviewOverview");
                                            ?>">
                                                <div class="col-1"><img class="avatar-rev" src="<?= base_url("assets/images/avatar.png") ?>"></div>
<!--                                                <div class="col-1"><img class="avatar-rev" src="<?//=x base_url($review->avatarPath) ?>"></div>-->
                                                <div class="col-2"><span class="username-rev"><?= $review->username ?></span></div>
                                                <div class="col-3 ml-3"><span class="title"><?= $review->title ?></span></div>
                                                <div class="col-2 ml-3"><span class="place"><?= $review->place.', '.$review->country ?></span></div>
                                                <div class="col-1 ml-2" style="padding-right: 0;">
                                                    <div class="tokens"><?= $review->tokens ?>&nbsp;<i class="fas fa-star"></i></div>
                                                </div>
                                                <div class="col-2 pl-0"><span class="date"><?php
                                                        $dateParts = explode('-', $review->date);
                                                        echo "$dateParts[2].$dateParts[1].$dateParts[0].";
                                                        ?></span></div>
                                                <div class="col-1" style="margin-left: -35px;">
                                                    <div class="dropdown">
                                                        <div class="btn dropdown-toggle options-btn" data-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </div>
                                                        <div class="dropdown-menu options-menu">
                                                            <?php if ($review->privacy == 0) { ?>
                                                                <span class="dropdown-item mark-private" data-id_rev="<?= $review->idRev ?>"
                                                                      data-toggle="modal" data-target="#admin-modal">Mark as private
                                                                </span>
                                                            <?php } ?>
                                                            <span class="dropdown-item delete-user" data-id_usr="<?= $review->idOwr ?>"
                                                                  data-username="<?= $review->username ?>" data-toggle="modal"
                                                                  data-target="#admin-modal">Delete user
                                                            </span>
                                                        </div>
                                                    </div>
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
        <div class="col-4">
            <table id="outer-table-2">
                <caption>Users</caption>
                <tbody>
                <tr>
                    <td>
                        <div class="overflow-auto" style="height: 470px;">
                            <table id="user-table" class="table">
                                <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="col-3"><img class="avatar-usr" src="<?= base_url("assets/images/avatar.png") ?>"></div>
<!--                                                <div class="col-3"><img class="avatar-usr" src="<?//= base_url($review->avatarPath) ?>"></div>-->
                                                <div class="col-6"><span class="username-usr"><?= $user->username ?></span></div>
                                                <div class="col-3">
                                                    <button class="btn delete-user shadow-none"
                                                            data-content="Delete user"
                                                            data-placement="bottom" data-trigger="hover"
                                                            data-id_usr="<?= $user->idUsr ?>"
                                                            data-username="<?= $user->username ?>" data-toggle="modal"
                                                            data-target="#admin-modal"><i class="far fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
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

<div class="modal fade" id="admin-modal" tabindex="-1" role="dialog" style="margin-top: -100px">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="modal-message"></span>
            </div>
            <div class="modal-footer">
                <button type="button" id="modal-close" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="modal-confirm" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>