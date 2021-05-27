<!-- author: Jovan Djordjevic -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url("assets/css/admin.css") ?>">
    <link rel="icon" href="<?= base_url("assets/images/logo_icon.png") ?>">
    <script src="https://kit.fontawesome.com/7d57026c7c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/admin.js') ?>"></script>
    <title>Travel Journal</title>
</head>
<body>
<div class="title">Welcome back, boss!</div>
<img class="logo" src="<?= base_url("assets/images/logo.png") ?>">
<a class="log-out" href="homepage.html">Log Out</a>
<?= $this->include('templates/sort_by'); ?>

<div class="review-title">User reviews</div>
<div class="user-title">Users</div>
<div class="review-grid">
    <?php foreach ($reviews as $review) { ?>
        <a class="review" href="<?= site_url("Admin/reviewAdmin/$review->id") ?>">
            <img class="avatar" src="<?= base_url("assets/images/avatar.png") ?>">
            <div class="username"><?= $review->username ?></div>
            <div class="overall"><?= $review->title ?></div>
            <div class="place"><?= $review->place.', '.$review->country ?></div>
            <div class="tokens"><?= $review->tokens ?> &nbsp;<i class="fas fa-star"></i></div>
            <div class="date"><?php
                $dateParts = explode('-', $review->date);
                echo "$dateParts[2].$dateParts[1].$dateParts[0].";
                ?></div>
            <div class="options-r">
                <i class="fas fa-ellipsis-v"></i>
                <div class="sub-menu-or">
                    <div>Mark review as private</div>
                    <div>Delete this user's account</div>
                </div>
            </div>
        </a>
    <?php } ?>
</div>
<div class="user-grid">
    <?php foreach ($users as $user) { ?>
        <div class="user">
            <img class="avatar" src="<?= base_url("assets/images/avatar.png") ?>">
            <div class="username"><?= $user->username ?></div>
            <a class="btn options-u" userName="<?= $user->username ?>" userId="<?= $user->id ?>"
               data-toggle="modal" data-target="#myModal"><i class="far fa-trash-alt"></i></a>
        </div>
    <?php } ?>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" style="margin-top: -100px">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">So long, partner..</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to send <span id="user-to-delete"></span> to history?
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <button type="button" id="confirmDelete" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>