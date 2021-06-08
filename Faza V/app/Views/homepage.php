<!-- author: Dimitrije Panic-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/stylehome.css')?>"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/js/homepage.js')?>"></script>
    <title>Travel Journal</title>
    <script>
        function showModal(){
            $("#myModal").modal({
                backdrop:'static',
                keyboard:false
            });
        }
        function changePic(){
            let fd = new FormData();
                let files = $('#file-upload')[0].files;
                if (files.length > 0) {
                    fd.append('file', files[0]);

                } else {
                    alert("You need to choose a picture first!");
                    return;
                }
            $.ajax({
                url: "<?=base_url('ChangePic/changePic')?>",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
            }).done(function(data) {
                let val = data.split(",");
                if(val.length > 1){
                    //val[1] je tag za sliku
                    alert("Successfully changed your profile picture!")
                } else {
                    alert("data");
                }
            })
        }
    </script>
</head>
<!-- dodaj ako treba i alternative za vh i wv -->
<body class="back">
    <div class="container-fluid">
        <div class="row">
            <div id="1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-lg-3 mt-md-3 mt-sm-0 mt-xs-0" >
                <img src="<?php echo base_url('/assets/images/pic.png') ?>" class="pic">
            </div>
        </div>
        <div class="row">
            <div id="2" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-lg-1 mt-md-1 mt-sm-0 mt-xs-0 quote">
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
            <div id="3" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-lg-3 mt-md-3 mt-sm-0 mt-xs-0 link">
                <a href="<?php echo base_url('/SearchAndTrending/index') ?>" > Be My Guest </a>
            </div>
        </div>
        <div class="row">
            <div id="4" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-lg-3 mt-md-3 mt-sm-0 mt-xs-0 link">
                <a href="<?php echo base_url('/GuestRegister/showRegister') ?>">
                    Become a Traveller
                </a>
            </div>
        </div>
        <div class="row">
            <div id="5" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-lg-3 mt-md-3 mt-sm-0 mt-xs-0 link">
                <a href="<?php echo base_url('/GuestLogin/showLogin') ?>" >
                    Continue With Your Travels
                </a>
            </div>
        </div>
    </div>

</body>
</html>