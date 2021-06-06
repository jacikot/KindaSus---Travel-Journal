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
                        document.getElementById("message").innerText = data;
                        $("#myModal").modal();
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
            $(document).ready(function(){
                $("#back").on("click",function (){
                    window.location.href=
                    <?php if(!isset($_SESSION['forgot'])) { ?>  window.location.href=
                        "<?php echo base_url('Map')?>";
                    <?php } else { ?> window.location.href=
                        "<?php echo base_url('GuestLogin')?>";
                    <?php }?>
                });
            });



    </script>
</head>
<body onload="getUser();">
<!--<img src="--><?php //echo base_url("assets/images/logo2.png")?><!--" width="13%" height="17%"/>-->
<!--<a href="--><?php //echo base_url('Map')?><!--" id="back"> <button class="back-to-home" type="button" id="backbutton">Passport</button></a>-->
    <div class="container-fluid" style="display: none">
        <div class="row">
            <div class="col-lg-12 col-md-12 mt-2" id="header">
                <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
                <button class="btn btn-outline-light moj" id="back">
                    <?php if(!isset($_SESSION['forgot'])) { ?> Go To Map
                    <?php } else { ?> Back To Home
                    <?php }?>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center mt-5">
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
                </table>



            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                </div>
                <div class="modal-body" id="message">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>