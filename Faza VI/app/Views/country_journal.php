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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/7d57026c7c.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url("/assets/js/country_journal.js")?>"></script>

    <script>
        var reviewUrl="<?= base_url('Journal/review')?>";
        var baseURL="<?= base_url('Journal/reviewsByCountries')?>";
        var envelopeURL="<?php echo base_url("/assets/images/koverta.jpg")?>";
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
            setListener();
        }
        var baseURL2="<?= base_url('Journal/deleteReview')?>";
        function deleteReview(idrev){
            alert(idrev);
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
<body onload="initialize();">
    <div id='header'>
        <!--
            height="10%" width="10%"
        -->
        <img src="<?php echo base_url("assets/images/logo2.png")?>" width="108" height="71"/>
   
        <a href="<?php echo base_url('Map')?>"> <button class=" back-to-home" type="button">Passport</button></a>
        
    </div >
    <div id='page'>
        <br>
        <h1 style="letter-spacing: 5pt;"> </h1>
        <div id='page_main'>
            <div id='list_div'>
                <ul id="JournalList"></ul>
            </div>
        </div>
   </div>
   <div class="custom_select">
    <select id="dropdown_list">
        <option class="content" value="All visited cities">All visited cities</option>
    </select>
</div> 

   </body>
   
   </html>