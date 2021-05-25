<!-- author: Jovan Djordjevic -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url("assets/css/{$fileName}.css")?>">
    <link rel="icon" href="slike/logo_icon.png">
    <script src="https://kit.fontawesome.com/7d57026c7c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/refresh.js') ?>"></script>
    <title>Travel Journal</title>
    <script>

        $("#refresh-btn").click(function () {
            sortBy($('#tokens').val('checked'),$('#desc').val('checked'));
        });

        function sortBy(typeBool, directionBool) {
            alert('a');
            let type, direction;
            if (typeBool == true)
                type = 'tokens';
            else type = 'date';
            if (directionBool == true)
                direction = 'DESC';
            else direction = 'ASC';
            $.ajax({
                type: "GET",
                url: "app/Controllers/Guest/refresh?type=" + type + "&direction=" + direction
            }).done(function (reviews) {
                $reviews = reviews;
                $("#tokens").attr("checked", type == null || type === 'tokens');
                $("#date").attr("checked", type === 'date');
                $("#asc").attr("checked", direction === 'ASC');
                $("#desc").attr("checked", direction == null || direction === 'DESC');
            });
        }
    </script>

</head>
<body>
<img class="logo" src="<?= base_url("assets/images/slike/logo.png") ?>">

<table id="buttons-table" class="text-center">
    <tr>
        <td><a id="login" href="<?= site_url("Guest/login") ?>">Continue With Your Travels</a></td>
        <td><a id="back-to-home" href="<?= site_url("Guest/homepage") ?>">Back to Home</a></td>
    </tr>
    <tr>
        <td></td>
        <td><a id="register" href="<?= site_url("Guest/register") ?>">Become a Traveller</a></td>
    </tr>
</table>
