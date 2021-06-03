<!-- autor: Jana Toljaga -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal</title>
    <link rel="stylesheet" href="<?php echo base_url("/assets/css/style_journal.css")?>">
    <!-- Autor: Adriana Vidic -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script src="https://kit.fontawesome.com/7d57026c7c.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url("/assets/js/country_journal.js")?>"></script>

    <script>
        var reviewUrl="<?= base_url('Journal/review')?>";
        var baseURL="<?= base_url('Journal/reviewsByCountries')?>";
        var envelopeURL="<?php echo base_url("/assets/images/koverta.jpg")?>";
        var plcURL="<?php echo base_url("/assets/images/geo-alt.svg")?>";
        var calURL="<?php echo base_url("/assets/images/calendar.svg")?>";
        function initialize() {
            $.ajax(
                {
                    url:baseURL,
                    type:"GET",
                    processData: false,
                    contentType:false
                }
            ).done(function (data){
               let ret=JSON.parse(data);
               insertData(ret);

            });
        }
        var baseURL2="<?= base_url('Journal/deleteReview')?>";
        function deleteReview(idrev){
            alert(idrev);
            alert("jana");
            $.ajax(
                {
                    url:baseURL2,
                    type:"POST",
                    data:{
                        "id_rev":idrev
                    },


                }
            ).done(function (data){
                alert(data);
            });
        }

        function ajaxCall(place=null){
            $.ajax(
                {
                    url:baseURL,
                    type:"POST",
                    data:{"place":place},
                    cache:false
                }
            ).done(function (data){
                let ret=JSON.parse(data);
                insertData(ret);

            });
        }
    </script>
</head>
<body onload="initialize();" style="display: none">
<!--    <div id='header'>-->
<!--        -->
<!--            height="10%" width="10%"-->
<!--        -->
<!--        <img src="--><?php //echo base_url("assets/images/logo2.png")?><!--" width="108" height="71"/>-->
<!--   -->
<!--        <a href="--><?php //echo base_url('Map')?><!--"> <button class=" back-to-home" type="button">Passport</button></a>-->
<!--        -->
<!--    </div >-->
    <div class="container container-fluid">
        <div class="row">
            <div class="col-12 offset k2 text-center ">
                <h1 style="letter-spacing: 5pt;"> </h1>
            </div>
        </div>
        <div id='page' class="row">
            <div class="col-9 offset-1 k">
                <div class="scroller">
                    <ul id="JournalList" ></ul>
                </div>
            </div>
            <div class="col-2">
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                        All visited cities
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="menu">
                        <a class="dropdown-item" id="all">All visited cities</a>
                    </div>
                </div>
            </div>
        </div>


    </div>


   </body>
   
   </html>