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
    <div class="container-fluid">
        <!-- vidi da na resize uklonis ovaj red-->
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
        <div class="row">
            <div class="col-lg-12 col-md-12 mt-2" id="header">
                <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
                <button class="btn btn-outline-light">
                    Back To Home
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
        <div class="col-lg-4 col-md-4">
            &nbsp;&nbsp;
        </div>
        <div class="col-lg-4 col-md-4 my-auto pozadina rounded" id="tab">
            <table class="table mt-3 mb-3" >
                <tr>
                    <td colspan="2" class="naslov">
                        Become a Traveller
                    </td>
                </tr>
               <tr>
                    <td colspan="2" id="profil">

                        <img  id="slikaprofila" class="rounded-circle" src="<?php echo base_url('assets/images/default-avatar-2.jpg') ?>" > <br>

                        <label id="inputslike" for="file-upload" class="custom-file-upload">
                            <div class="mt-2 my-auto">
                                Upload an image
                               <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16">
                                    <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
                                </svg>-->
                            </div>

                        </label>
                        <input id="file-upload"  type="file" onchange="document.getElementById('slikaprofila').src = window.URL.createObjectURL(this.files[0])" hidden/>
                    </td>
                </tr>
                <tr>

                    <td>
                        <label>
                            <input type="text" id="name" placeholder="Firstname">
                        </label>
                    </td>
                    <td>
                        <label>
                            <input type="text" id="city" placeholder="City">

                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input type="text" id="surname" placeholder="Lastname">
                        </label>
                    </td>
                    <td>
                        <label>
                            <input type="text" id="country" placeholder="Country">

                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input type="text" id="username" placeholder="Username">
                        </label>
                    </td>
                    <td>
                        <label>
                            <input type="password" id="pass" placeholder="Password">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input type="text" id="email" placeholder="E-mail">
                        </label>
                    </td>
                    <td>
                        <label>
                            <input type="password" id="passconf" placeholder="Confirm Password" >
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="naslov">
                       <button class="btn btn-outline-light" onclick="register()" >
                           Start Making Memories
                       </button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-4 col-md-4">
            &nbsp;
        </div>
    </div>
    </div>
   <!-- <div id="header"><img src="<?php echo base_url('assets/images/pic.png') ?>" height=10% width=10%/>
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
    dodaj ovde pop up ako zelis
    <input id="submitbutton" type="button" value="Start making memories" onclick="register()">-->
</body>
</html>