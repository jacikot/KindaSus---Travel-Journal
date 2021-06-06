<!-- autor: Jana Toljaga -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm identity</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/que_style.css')?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
    <script src="<?php echo base_url('assets/js/que.js')?>"></script>
    <script>
        var baseURL="<?= base_url('Password/validateQuestions')?>";
        var addURL="<?= base_url('GuestRegister/addQuestions')?>"

        function ajaxCall(questions){
            let username="";
            let shift=0;
            if(questions.length==4){
                username=questions[0];
                shift=1;
            }
            let flag=0;
            <?php

            if(!isset($_SESSION["flag"])||$_SESSION["flag"]!=1){

            ?>


            $.post(baseURL,
                {'q0':questions[0+shift], 'q1':questions[1+shift], 'q2':questions[2+shift],'username':username},
                function (data){
                    if("You have already answered! Press the button to continue!"==data){
                        window.location.href="<?= base_url('Password')?>";
                        return;
                    }
                    $(".modal-body").html(data);
                    $("#myModal").modal('show');
                    if(data=="Your answers are correct! Press the button to continue!"){
                        $("#check").empty().append("Continue");
                    }

                }
            )
            <?php }
            else {?>
            $.post(addURL,
                {'q0':questions[0+shift], 'q1':questions[1+shift], 'q2':questions[2+shift]},
                function (data){
                    if("You have already answered! Press the button to continue!"==data){
                        window.location.href="<?= base_url('Map')?>"
                        return;
                    }
                    alert(data);
                    if(data=="Thank you for answering all questions!"){
                        $("#check").empty().append("Continue");
                    }
                }
            )
            <?php }?>

        }

        var backGuest="<?php echo base_url('GuestLogin/showLogin')?>";
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
<body onload="getUser()">
    <div class="container-fluid" style="display: none">
        <div class="row">
            <div class="col-lg-12 col-md-12 mt-2" id="header">
                <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
                <button class="btn btn-outline-light moj" id="back">
                    <?php if(isset($_SESSION['userId']) &&isset($_SESSION['flag'])) { ?> Skip
                    <?php } else if(isset($_SESSION['userId'])){ ?> Go To Map
                    <?php } else{?> Back <?php }?>
                </button>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-10 offset-1 k border2" id="c1">
<!--                <img src="--><?php //echo base_url("assets/images/env.png")?><!--" class="env">-->
                <div class=" klasa k border-bottom" id="c2">
                    <p id="p1">
                        Tell us about yourself!
                    </p>

                </div>
                    <table id="table" class="table table-borderless  my-auto">
                        <tr>
                            <td>

                                <p class="text" id="p3">
                                    <img src="<?php echo base_url("assets/images/patch-question.svg")?>">
                                    Favourite country?
                                </p>
                            </td>
                            <td class="align-middle">
                                <input type="text" id="t2" class="username border-bottom"/>
                            </td>
                        </tr>
                        <tr >
                            <td>
                                <p class="text" id="p3">
                                    <img src="<?php echo base_url("assets/images/patch-question.svg")?>">
                                    Something you always travel with? &nbsp
                                </p>
                            </td>
                            <td class="align-middle">
                                <input type="text" id="t3" class="username border-bottom"/>
                            </td>
                        </tr>
                        <tr>
                            <td>

                                <p class="text" id="p3">
                                    <img src="<?php echo base_url("assets/images/patch-question.svg")?>">
                                    Someone you always travel with?
                                </p>
                            </td>
                            <td class="align-middle">
                                <input type="text" id="t4" class="username border-bottom"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <?php if(!isset($_SESSION['flag'])||$_SESSION['flag']!=1){?>
                                <button class="btn btn-outline-light text-center rounded" type="button" id="check">Check & Continue</button>
                                <?php } else{ ?>
                                <button class="btn btn-outline-light text-center rounded" type="button" id="check">Save answers</button>
                                <?php } ?>
                            </td>

                        </tr>
                    </table>
            </div>

        </div>
        <br><br>
<!--        <div class="row">-->
<!--            <div class="col-xl-4 offset-xl-9 col-lg-6 offset-lg-4 col-md-7 offset-md-3 col-8 offset-2 ">-->
<!--                <button class="back continue text-center" type="button" id="check">Check & Continue</button>-->
<!--            </div>-->
<!--        </div>-->

    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>