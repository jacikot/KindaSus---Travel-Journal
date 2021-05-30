<!-- autor: Jana Toljaga -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url("assets/js/ch_pass.js")?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/ch_pass_style.css")?>">
    <script>
            var backGuest="<?php echo base_url('GuestLogin/showLogin')?>";
            var baseURL="<?= base_url('Password/setPassword')?>";
            function ajaxCall(password,pc) {
                $.post(baseURL,
                    {'pass': password, 'passC': pc},
                    function (data) {
                        //alert(data);
                        document.getElementById("note").innerText = data;
                        if ("Password successfully changed" != data) {
                            document.getElementById("note").style.color = "darkred";
                        }
                    }
                );
            }
            function getUser(){
                var baseURL2="<?= base_url('Password/getUser')?>";
                $.ajax(
                    {
                        url:baseURL2,
                        type:"GET",
                        processData: false,
                        contentType:false
                    }
                ).done(function (data){
                    if(data==""){
                        guestMode();
                    }
                });
            }



    </script>
</head>
<body onload="getUser();">
<img src="<?php echo base_url("assets/images/logo2.png")?>" width="13%" height="17%"/>
<a href="<?php echo base_url('Map')?>" id="back"> <button class="back-to-home" type="button" id="backbutton">Passport</button></a>
    <div class="container" style="display: none">

        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <table class="table table-borderless k">
                    <tr>
                        <td>
                            <p id="p1">Secure your travel memories!</p>
                            <div id="hr"><span class="rounded-circle"></span></div>
                        </td>
                    </tr>

                    <tr>
                        <td>

                            <img src="<?php echo base_url("assets/images/lock.svg")?>">
                            <input type="password" id="pas1" class="pas border-bottom" placeholder="New password"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo base_url("assets/images/lock.svg")?>">
                            <input type="password" id="pas2" class="pas border-bottom" placeholder="Confirm password"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="btn btn-outline-light ok" type="button" id="change2" onclick="changePass()">Change password</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="note" ><p class="note" id="note"></p></div>
                        </td>
                    </tr>
                </table>



            </div>
        </div>
    </div>
</body>
</html>