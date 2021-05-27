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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js" integrity="sha512-g2PN+aYR0KupTVwea5Ppqw4bxWLLypWdd+h7E0ydT8zF+/Y2Qpk8Y1SnzVw6ZCVJPrgB/91s3VfhVhP7Y4+ucw==" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/js/que.js')?>"></script>
    <script>
        var baseURL="<?= base_url('Password/validateQuestions')?>";


        function ajaxCall(questions){
            let username="";
            let shift=0;
            if(questions.length==4){
                username=questions[0];
                shift=1;
            }
            $.post(baseURL,
                {'q0':questions[0+shift], 'q1':questions[1+shift], 'q2':questions[2+shift],'username':username},
                function (data){
                    if("Your already answered! Press the button to continue!"==data){
                        window.location.href="<?= base_url('Password/chPassword')?>"
                        return;
                    }
                    alert(data);
                    if(data=="Your answers are correct! Press the button to continue!"){
                        $("#check").empty().append("Continue");
                    }

                }
            )

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
    <img src="<?php echo base_url("assets/images/logo2.png")?>" width="13%" height="17%"/>
    <a href="<?php echo base_url('Map')?>" id="back"> <button class="back-to-home" id="backbutton" type="button">Passport</button></a>

    <div class="container">
        <div class="row">
            <div class="col-9">
<!--                <img src="--><?php //echo base_url("assets/images/env.png")?><!--" class="env">-->
                    <table id="table" class="table table-borderless">
                        <tr>
                            <td><p class="text" id="p3">Favourite country?</p></td>
                            <td >
                                <input type="text" id="t2" class="username"/>
                                <br>
                                <div id="err0" class="err" >Polje nije uneseno!</div>
                            </td>

                        </tr>
                        <tr >
                            <td><p class="text" id="p3">Something you always travel with? &nbsp</p></td>
                            <td>
                                <input type="text" id="t3" class="username"/>
                                <br>
                                <div id="err1" class="err">Polje nije uneseno!</div>
                            </td>
                        </tr>
                        <tr >
                            <td><p class="text" id="p3">Someone you always travel with?</p></td>
                            <td>
                                <input type="text" id="t4" class="username"/>
                                <br>
                                <div id="err2" class="err">Polje nije uneseno!</div>
                            </td>
                        </tr>
                    </table>
            </div>
            <div class="col-3 my-auto">
                <p id="p1">Tell us about yourself!</p>
            </div>
        </div>

    </div>
    <button class="back continue" type="button" id="check">Check & Continue</button>


<!--    <div >-->
<!--        <table id="table">-->
<!--            <tr>-->
<!--                <td><p class="text" id="p3">Favourite country?</p></td>-->
<!--                <td >-->
<!--                    <input type="text" id="t2" class="username"/>-->
<!--                    <br>-->
<!--                    <div id="err0" class="err" >Polje nije uneseno!</div>-->
<!--                </td>-->
<!---->
<!--            </tr>-->
<!--            <tr >-->
<!--                <td><p class="text" id="p3">Something you always travel with? &nbsp</p></td>-->
<!--                <td>-->
<!--                    <input type="text" id="t3" class="username"/>-->
<!--                    <br>-->
<!--                    <div id="err1" class="err">Polje nije uneseno!</div>-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr >-->
<!--                <td><p class="text" id="p3">Someone you always travel with?</p></td>-->
<!--                <td>-->
<!--                    <input type="text" id="t4" class="username"/>-->
<!--                    <br>-->
<!--                    <div id="err2" class="err">Polje nije uneseno!</div>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </table>-->

        
    </div>

</body>
</html>