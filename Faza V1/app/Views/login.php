<!-- author: Dimitrije Panic-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/stylelogin.css') ?>" >
    <script src="<?php echo base_url('/assets/js/login.js')?>">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <title>Continue with your travels</title>
    <script>
        function sendData(userN,pass){
            $.post("<?=base_url('GuestLogin/login')?>",
                {
                    'username': userN,
                    'password': pass
                },
                function(vr){
                  if(vr === "admin") {
                      setValues("Welcome back admin!","Continue..","goToAdmin()");
                  }
                  else if(vr === "user"){
                      // vidi da dodas ovde da ti bdue username ispisano
                      setValues("Welcome back! We missed you","Continue","goToMap()");
                  }
                  else{
                      $(".modal-title").text("Try again..");
                  }

                  // malo konfuzan ovaj ispis
                  $(".modal-body").text(vr);
                  $("#myModal").modal();
                });
        }
    </script>
</head>
<body onload="init()">
    <div id="header"> <img src="<?php  echo base_url('assets/images/pic.png')?>" height=10% width=10%/>
            <button class="btn" > Back To Home </button>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn mybtn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="quote"> Continue with your travels</div>
    <div class="second">
        <table>
           <tr>
               <td align="right"> <div id="username"> Username:  </div> </td>
               <td align="center"> <div> <input id="userId" class="textbox" type="text" align="center" name="username" size="30"> </div> </td>

            </tr>
        </table>
    </div>
    <div class="second" > 
        <table>
            <tr>
            <td align="right"> <div id="username1"> Password:  </div> </td>  
            <td align="center"> <input id="passId" class="textbox" type="password" align="center" name="password" size="30">  </td>
            </tr>
        </table>
    </div>
    <div class="newLast">
        <button class="btn newButton1">
            Forgot My Password?
        </button>

        <button class="btn newButton2" onclick="login()">
            Go on
        </button>

    </div>

</body>
</html>