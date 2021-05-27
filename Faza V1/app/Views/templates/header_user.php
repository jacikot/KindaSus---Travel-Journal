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
    <?php
        if (isset($jsFile)) { ?>
            <script src="<?= base_url("assets/js/{$jsFile}.js") ?>"></script>
        <?php } ?>
    <link rel="stylesheet" href="<?= base_url("assets/css/{$cssFile}.css")?>">
    <link rel="icon" href="<?= base_url("assets/images/logo_icon.png") ?>">
    <title>Travel Journal</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between;">
        <img class="logo" src="<?= base_url("assets/images/logo.png") ?>">
        <td><a id="back-to-home" href="<?= site_url("ListOfReviews/passport") ?>">Passport</a></td>
    </div>
