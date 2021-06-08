<!-- author: Dimitrije Panic-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('/assets/js/reference.js')?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/stylereference.css') ?>" type="text/css">
    <title>Reference</title>
    <script>
        function addIt(data){
            let url = "<?php echo  base_url('Quiz/addRecommendationToToGo/') ?>";
            sendIt(data,url);
        }
        function goHome(){
            $("#mojModal").modal({
                backdrop:'static',
                keyboard: false
            });

        }
        function checkItOut(){
            window.location.href = "<?php
                if(isset($data)){
                   echo ''.base_url('ListOfReviews/index?'.'idPlc='.$data['id'].'&placeName='.
                   $data['place']->name.'&countryName='.$data['country']->name.'&countryCode='.$data['country']->code);
                }
            ?>";
        }

        function goToMap(){
            window.location.href =  "<?=base_url('Map/index')?>";
        }
    </script>

</head>
<body >
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 mt-2" id="header">
                <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
                <button class="btn btn-outline-light moj" onclick="goHome()">
                    Go To Map
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" id="naslov">
                We recommend
            </div>
        </div>
        <div class="modal fade" id="mojModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="head">
                        <h5 class="modal-title" id="exampleModalLabel"> Are you sure?</h5>
                    </div>
                    <div class="modal-body" id="telo">
                        If you leave now your recommendation will be lost..
                    </div>
                    <div class="modal-footer" id="foot">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-dark" onclick="goToMap()">Go To Map</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="head">
                        <h5 class="modal-title" id="exampleModalLabel"> Congratulation!</h5>
                    </div>
                    <div class="modal-body" id="telo">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 my-auto" align="center">
                <button class="btn btn-outline-light dugme" onclick="<?php
                    if(isset($data)){
                        echo 'addIt('.$data['id'].')';
                    }
                ?>">
                    Add It To To-Go List
                </button>
            </div>
            <div class="col-lg-6  rounded mt-2" id="pozadina">
                <?php
                if(isset($data)) {
                    echo $data['place']->name.", ".$data['country']->name;
                } else{
                    echo "Sorry we couldnt find you a recommendation..";
                }

                ?>
                <br>
                <div class="pic">
                    <img src="<?php if(isset($data)){
                    echo 'https://www.countryflags.io/'.$data['country']->code.'/shiny/64.png';
                    } else {
            // dodaj ovde neku podrazumevano sliku
            //OBAVEZNO DODAJ ALT!!!
                     }  ?> " alt="" height="120px" width="120px"/>
                </div>
                <div id="quote">
                        <?php
                    if(isset($data)) {
                        echo "\"".$data['quote']."\"";
                    } else{
                        echo "The journey of a  thousand miles begins  with a single step.";
                    }

                ?>
                </div>

            </div>
            <div class="col-lg-3 my-auto" align="center">
                <?php
                if(isset($data))
                    echo  "<button class='btn btn-outline-light dugme' onclick='checkItOut()'>
                    Check It Out
                </button>" ?>
            </div>-
        </div>
    </div>

</body>
</html>