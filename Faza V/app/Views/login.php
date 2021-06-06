<!-- author: Dimitrije Panic-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/stylelogin.css') ?>" >
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('/assets/js/login.js')?>"> </script>
    <title>Continue with your travels</title>
    <script>
        function goHome(){
            window.location.href =  "<?=base_url('GuestLogin/index')?>";
        }

        function goToMap(){
            window.location.href =  "<?=base_url('Map/index')?>";
        }

        function goToAdmin(){
            window.location.href =  "<?=base_url('Admin/index')?>";
        }

        function forgotPass(){
            // vidi da l treba na ovo da se ide
            window.location.href =  "<?=base_url('Password/listPassQuestions')?>";
        }

        function sendData(userN,pass){
            $.post("<?=base_url('GuestLogin/login')?>",
                {
                    'username': userN,
                    'password': pass
                },
                function(vr1){
                let val = vr1.split(",");
                if(val.length > 1){
                  if(val[0] === "admin") {
                      setValues("Welcome back "+val[1]+"!","Continue..","goToAdmin()");
                      $(".modal-body").text("Press Continue to go to the Admin page");
                  }
                  else if(val[0] === "user"){
                      setValues("Welcome back "+val[1]+". We missed you!","Continue","goToMap()");
                      $(".modal-body").text("Press Continue to view your Diary homepage");
                  }
                }
                  else{
                      $(".modal-title").text("Try again..");
                      $(".modal-body").text(vr1);
                  }
                  $("#myModal").modal({
                      backdrop:'static',
                      keyboard: false
                  });
                });
        }
    </script>
</head>

<body onload="init()">
    <div class="container-fluid">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mybtn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2" id="header">
                <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
                <button class="btn btn-outline-light" id="dugme" onclick="goHome()">
                    Back To Home
                </button>
            </div>
        </div>
        <div class="row" id="red">
            <div class="col-lg-4 col-md-4">
                &nbsp;
            </div>
            <div class="col-lg-4 col-md-4 forma rounded my-auto">
                <table class="table mt-5 mb-5">
                    <tr>
                        <td colspan="2" class="header">
                            Continue with your travels!
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                </svg>
                                <input id="userId" type="text" placeholder="Username">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-lock" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                            </svg>
                          <label>
                              <input id="passId" type="password" placeholder="Password">
                          </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="btn btn-light" onclick="forgotPass()">
                                Forgot My Password?
                            </button>
                            <button class="btn btn-light" onclick="login()">
                                Go on
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

</body>
</html>