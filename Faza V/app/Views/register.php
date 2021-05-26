<!-- author: Dimitrije Panic-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Traveller</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styleregister.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo base_url('/assets/js/register.js')?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        function goToQuestions(){
            window.location.href =  "<?=base_url('GuestRegister/showQuestions')?>";
        }

        function sendData(fd){
            $.ajax({
                url: "<?=base_url('GuestRegister/register')?>",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
            }).done(function(data) {

                let help = data;
                array = help.split(" ");
                if(array[0] === "Success!"){
                    setValues(data,'Next','goToQuestions()');

                    $('.modal-body').text('If you want to be able to retrieve your data pls answer a couple of questions');
                } else{
                    $('#btn11').remove();
                    $(".modal-title").text("Sorry..");
                    $('.modal-body').text(data);
                }
                $('#myModal').modal();
            });
        }
    </script>
</head>
<body>
    <div id="header"><img src="<?php echo base_url('assets/images/pic.png') ?>" height=10% width=10%/>
        <a href="<?php echo base_url('GuestLogin/index.php') ?>"><input class="button" type="button" value="Back To Home"> </a></div>
    <div id="title"> Become a Traveller </div>
    <div id="menu">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn11" class="btn" data-dismiss="modal">Close</button>
                        <button type="button" class="btn mybtn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="menuleft">
            <table>
                <tr> 
                    <td align="right" class="move">Name:&nbsp;&nbsp;&nbsp; </td>
                    <td align="center"> <input id="name" type="text" name="name"></td>
                </tr>
                <tr>
                    <td align="right" class="move">Surname:</td>
                    <td align="center"><input id="surname" type="text" name="surname"></td>
                </tr>
                <tr>
                    <td align="right">Country:&nbsp;</td>
                    <td align="center"><input id="country" type="text" name="country"></td>
                </tr>
                <tr>
                    <td align="right">City:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td align="center"><input id="city" type="text" name="city"></td>

                </tr>
                <tr>
                    <td align="right" class="move">Username:&nbsp;&nbsp;&nbsp; </td>
                    <td align="center"> <input id="username" type="text" name="username"></td>
                </tr>
            </table>
        </div>
        <form id="menuright">
            <table>
                <tr> 
                    <td align="left">E-mail: </td>
                    <td align="left"> <input id="email" type="text" name="email"></td>
                </tr>
                    <td align="left">Password:</td>
                    <td align="left"> <input id="pass" type="password" name="pass"></td>
                    <td id="errorPass"> </td>

                <tr>
                    <td align="left"> Confirm Password:</td>
                    <td align="left"><input id="passconf" type="password"  name="passconf"></td>
                    <td id="errorConf"></td>
                </tr>
                <tr>
                    <td align="left">Avatar image:</td>
                    <td align="left"><input id="file" type="file" name="file"></td>
                </tr>
            </table>

        </div>
    </div>
     <!-- dodaj ovde pop up ako zelis-->
    <input id="submitbutton" type="button" value="Start making memories" onclick="register()">
</body>
</html>