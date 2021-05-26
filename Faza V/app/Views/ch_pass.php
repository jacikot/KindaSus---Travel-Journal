<!-- autor: Jana Toljaga -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo base_url("assets/js/ch_pass.js")?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/ch_pass_style.css")?>">
    <script>
            var baseURL="<?= base_url('Password/setPassword')?>";
            function ajaxCall(password,pc){
            $.post(baseURL,
                {'pass':password,'passC':pc},
                function (data){
                   //alert(data);
                    document.getElementById("note").innerText=data;
                   if("Password successfully changed"!=data){
                       document.getElementById("note").style.color="darkred";
                   }
                }
            )

        }
    </script>
</head>
<body>
    <div>
        <img src="<?php echo base_url("assets/images/logo2.png")?>" width="13%" height="17%"/>
        <a href="<?php echo base_url('Map')?>"> <button class="back-to-home" type="button">Passport</button></a>
        <table>
            <tr>
                <td colspan="2">
                    <p id="p1">Secure your travel memories!</p>
                </td>
            </tr>
            <tr>
                <td><p id="p2">New password:</p></td>
                <td><input type="password" id="pas1" class="pas"/></td>
            </tr>
            <tr>
                <td><p id="p3">Confirm password:</p></td>
                <td><input type="password" id="pas2" class="pas"/></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="ok" type="button" id="change2" onclick="changePass()">Change password</button>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="note" ><p class="note" id="note"></p></div>
                </td>
            </tr>
        </table>


        <br/>






    </div>
</body>
</html>