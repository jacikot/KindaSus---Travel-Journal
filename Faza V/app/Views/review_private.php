 <!-- Autor: Adriana Vidic -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Review</title>

    <script src="https://kit.fontawesome.com/7d57026c7c.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- pre uvozenja js-a treba da uvezemo i jquery i popper-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js">
    </script>
    <!-- dovlacenje javascript-a za bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js">
    </script>


    <link rel="stylesheet" href="<?php echo base_url('assets/css/style_review.css') ?>">
    <script src="<?php echo base_url('assets/js/review.js') ?>"></script>



<script>

   /* let urls=["<?php echo base_url('ReviewOverview/changeToPrivate') ?>",
        "<?php echo base_url('ReviewOverview/changeToPublic') ?>",
        "<?php echo base_url('ReviewOverview/giveTokens') ?>",
        "<?php echo base_url('ReviewOverview/getRev') ?>"
    ];
    */




   function markAsPrivate(){
       $.post("<?php echo base_url('ReviewOverview/changeToPrivate') ?>",{

           }
           ,function (){});
   };

   function markAsPublic(){
       $.post("<?php echo base_url('ReviewOverview/changeToPublic') ?>",{

           }
           ,function (){});
   }

   function giveToken(){

       $.post( "<?php echo base_url('ReviewOverview/giveTokens') ?>",{

           }
           ,function (tokens){

               document.getElementById('tokenNum').innerHTML=tokens;
               //   document.location.header();

           });
   }


   ;

   function adminTable(username, token_count,){


       //traveller,username change privacy status,checkbox, token_count, zvezda <i class='fas fa-star'></i>
       let row1=$("<tr></tr>");
       let row2=$("<tr></tr>");
       let row3=$("<tr></tr>");

       let cell1=$("<td></td>").append("Traveller").css({
           "text-align":"right"
       });
       let cell2=$("<td></td>").append(username);

       row1.append(cell1);
       row1.append(cell2);



       let cell3=$("<td></td>").append("Change privacy status").css({
           "text-align":"right"
       });
       let cell4=$("<td></td>").append(
           $("<input type='checkbox' onchange='markAsPrivate()'>")
       ).append("Private");

       row2.append(cell3);
       row2.append(cell4);

       let cell5=$("<td></td>").append(token_count).css({
           "text-align":"right"
       });
       let cell6=$("<td></td>").append($("<i>").addClass('fas fa-star').append("</i>"));

       row3.append(cell5);
       row3.append(cell6);


       $("#revInfo").append(row1);
       $("#revInfo").append(row2);
       $("#revInfo").append(row3);
   }






   function ownerTable(username, token_count, privacy){


       //traveller,username change privacy status,checkbox, token_count, zvezda <i class='fas fa-star'></i>
       let row1=$("<tr></tr>");
       let row2=$("<tr></tr>");
       let row3=$("<tr></tr>");

       let cell1=$("<td></td>").append("Traveller").css({
           "text-align":"right"
       });
       let cell2=$("<td></td>").append(username);

       row1.append(cell1);
       row1.append(cell2);



       let cell3=$("<td></td>").append("Change privacy status").css({
           "text-align":"right"
       });
       let cell4;

       if(privacy==0) {
           cell4 = $("<td></td>").append(
               $("<input type='radio' id='privacyGroup' name='privacyGroup' checked onclick='markAsPrivate()'>")
           ).append("Private").append(
               $("<input type='radio' id='privacyGroup' name='privacyGroup'  onclick='markAsPublic()'>")
           ).append("Public");
       }
       else{
           cell4 = $("<td></td>").append(
               $("<input type='radio' id='privacyGroup' name='privacyGroup' onclick='markAsPrivate()'>")
           ).append("Private").append(
               $("<input type='radio' id='privacyGroup' name='privacyGroup' checked  onclick='markAsPublic()'>")
           ).append("Public");
       }

       row2.append(cell3);
       row2.append(cell4);

       let cell5=$("<td></td>").append(token_count).css({
           "text-align":"right"
       });
       let cell6=$("<td></td>").append($("<i>").addClass('fas fa-star').append("</i>"));

       row3.append(cell5);
       row3.append(cell6);


       $("#revInfo").append(row1);
       $("#revInfo").append(row2);
       $("#revInfo").append(row3);
   }



   function userTable(username, token_count){

       let row1=$("<tr></tr>");
       let row2=$("<tr></tr>");
       let row3=$("<tr></tr>");

       let cell1=$("<td></td>").append("Traveller").css({
           "text-align":"right"
       });
       let cell2=$("<td></td>").append(username);

       row1.append(cell1);
       row1.append(cell2);



       let cell5=$("<td id='tokenNum'></td>").append(token_count).css({
           "text-align":"right"
       });
       let cell6=$("<td></td>").append($("<button class='bottomButton' onclick='giveToken()'><i class='fas fa-star'></i></button>")).css({
           "background-color":"transparent",
           "outline":"none"
       });

       row3.append(cell5);
       row3.append(cell6);


       $("#revInfo").append(row1);

       $("#revInfo").append(row3);
   }


   function guestTable(username, token_count){

       let row1=$("<tr></tr>");
       let row2=$("<tr></tr>");
       let row3=$("<tr></tr>");

       let cell1=$("<td></td>").append("Traveller").css({
           "text-align":"right"
       });
       let cell2=$("<td></td>").append(username);

       row1.append(cell1);
       row1.append(cell2);



       let cell5=$("<td id='tokenNum'></td>").append(token_count).css({
           "text-align":"right"
       });
       let cell6=$("<td></td>").append($("<i>").addClass('fas fa-star').append("</i>"));

       row3.append(cell5);
       row3.append(cell6);


       $("#revInfo").append(row1);

       $("#revInfo").append(row3);
   }




   function getReview(){
       $.post("<?php echo base_url('ReviewOverview/getRev') ?>",{

           }
           ,
           function (dataJSON){

               let data=JSON.parse(dataJSON);


               let text=data.text;
               let title=data.title;
               let date=data.date;
               let token_count=data.token_count;
               let privacy =data.privacy;
               let place=data.place;
               let country=data.country;
               let type_of_user=data.type_of_user;
               alert(type_of_user);
               let username=data.username;

               let place_cnt_date=""+place+", "+country+"  "+date;

               document.getElementById('titleRev').innerHTML=title;
               document.getElementById('place_cnt_date').innerHTML=place_cnt_date;
               document.getElementById('revText').innerHTML=text;


             //  type_of_user='regUser';

               if(type_of_user=='admin'){

                   adminTable(username, token_count);
               }

               if(type_of_user=='regUser'){
                   
                   userTable(username,token_count);
               }

               if(type_of_user=='guest'){
                   guestTable(username,token_count);
               }

               if(type_of_user=='owner'){
                   ownerTable(username,token_count, privacy);
               }


           }
       );


   }
















</script>



</head>
<body onload="getReview()">
<container-fluid>
    <div class="row">
    <div class="col-12" id='header'>

        <img src="<?php echo base_url('assets/images/logo2.png')  ?>" style=" width: 14%;
    height: 14%;">
        
        
        <a href='map.html' class="back-to-home">Passport</a>
    </div>
    </div>

    <div class="row">
        <div class="col-12" style="text-align: center">
            <h2 name="rev_title" id="titleRev">My Favourite memory</h2>
            <h3 name="place_cnt_date" id="place_cnt_date">Amsterdam, Netherlands &nbsp;&nbsp;2020-05-05</h3>
            <br>
        </div>
    </div>

    <div class="row">
    <div class="col-1"></div>
     <div class="col-10 pg">
         <!--
         <img src="<?php echo base_url('assets/images/Untitledjp2.png')  ?>" class="image-fluid"
         style="width: inherit; text-align: center"
         >
  <p style="font-size: 25px; color: black" class="carousel-caption" name="revText" id="revText">
         -->

    <p style="font-size: 25px; color: black"  name="revText" id="revText">

    </p>
         <table class="table" id="revInfo">

         </table>

     </div>
     <div class="col-1"></div>
    </div>



</container-fluid>
   </body>
   
   </html>