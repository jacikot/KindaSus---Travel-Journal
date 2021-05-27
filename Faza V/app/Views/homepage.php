<!-- author: Dimitrije Panic-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/stylehome.css')?>"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="<?php echo base_url('assets/js/homepage.js')?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <title>Travel Journal</title>
</head>
<!-- dodaj ako treba i alternative za vh i wv -->
<body class="back">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-lg-3 mt-md-3">
                <img src="<?php echo base_url('/assets/images/pic.png') ?>"  class="pic" >
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-lg-1 mt-md-1 quote">
                <?php
                if(isset($data)){
                    echo "\"".$data['quote']."\"";
                } else {
                    echo "Still round the corner, there may wait, a new road or a secret gate";
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-lg-3 mt-md-3 link">
                <a href="" > Be My Guest </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-lg-3 mt-md-3 link">
                <a href="<?php echo base_url('/GuestRegister/showRegister') ?>">
                    Become a Traveller
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-lg-3 mt-md-3 link">
                <a href="<?php echo base_url('/GuestLogin/showLogin') ?>" >
                    Continue With Your Travels
                </a>
            </div>
        </div>
    </div>

</body>
</html>