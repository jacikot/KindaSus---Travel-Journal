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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>



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

       let cell1=$("<td style='border: none'></td>").append("Traveller").css({
           "text-align":"right"
       });
       let cell2=$("<td style='border: none'></td>").append(username);

       row1.append(cell1);
       row1.append(cell2);



       let cell3=$("<td style='border: none'></td>").append("Change privacy status").css({
           "text-align":"right"
       });
       let cell4=$("<td style='border: none'></td>").append(
           $("<input type='checkbox' onchange='markAsPrivate()'>")
       ).append("Private");

       row2.append(cell3);
       row2.append(cell4);

       let cell5=$("<td style='border: none'></td>").append(token_count).css({
           "text-align":"right"
       });
       let cell6=$("<td style='border: none'></td>").append($("<i>").addClass('fas fa-star').append("</i>"));

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

       let cell1=$("<td style='border: none'></td>").append("Traveller").css({
           "text-align":"right"
       });
       let cell2=$("<td style='border: none'></td>").append(username);

       row1.append(cell1);
       row1.append(cell2);



       let cell3=$("<td style='border: none'></td>").append("Change privacy status").css({
           "text-align":"right"
       });
       let cell4;

       if(privacy==0) {
           cell4 = $("<td style='border: none'></td>").append(
               $("<input type='radio' id='privacyGroup' name='privacyGroup' checked onclick='markAsPrivate()'>")
           ).append("Private").append(
               $("<input type='radio' id='privacyGroup' name='privacyGroup'  onclick='markAsPublic()'>")
           ).append("Public");
       }
       else{
           cell4 = $("<td style='border: none'></td>").append(
               $("<input type='radio' id='privacyGroup' name='privacyGroup' onclick='markAsPrivate()'>")
           ).append("Private").append(
               $("<input type='radio' id='privacyGroup' name='privacyGroup' checked  onclick='markAsPublic()'>")
           ).append("Public");
       }

       row2.append(cell3);
       row2.append(cell4);

       let cell5=$("<td style='border: none'></td>").append(token_count).css({
           "text-align":"right"
       });
       let cell6=$("<td style='border: none'></td>").append($("<i>").addClass('fas fa-star').append("</i>"));

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

       let cell1=$("<td style='border: none'></td>").append("Traveller").css({
           "text-align":"right"
       });
       let cell2=$("<td style='border: none'></td>").append(username);

       row1.append(cell1);
       row1.append(cell2);



       let cell5=$("<td style='border: none' id='tokenNum'></td>").append(token_count).css({
           "text-align":"right"
       });
       let cell6=$("<td style='border: none'></td>").append($("<button class='btn btn-outline-light' onclick='giveToken()'><i class='fas fa-star'></i></button>")).css({

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

       let cell1=$("<td style='border: none'></td>").append("Traveller").css({
           "text-align":"right"
       });
       let cell2=$("<td style='border: none'></td>").append(username);

       row1.append(cell1);
       row1.append(cell2);



       let cell5=$("<td style='border: none' id='tokenNum'></td>").append(token_count).css({
           "text-align":"right"
       });
       let cell6=$("<td style='border: none'></td>").append($("<i>").addClass('fas fa-star').append("</i>"));

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
              
               let username=data.username;

               let place_cnt_date=""+place+", "+country+"  "+date;

               document.getElementById('titleRev').innerHTML=title;
               document.getElementById('place_cnt_date').innerHTML=place_cnt_date;
               document.getElementById('revText').innerHTML=text;

               let picsExist=data.hasPic;
               let numberOfPictures=data.numOfPics;
               let numInGallery=0;
               if(picsExist=='1'){
                   $("#revText").append("<br>");
                   $("#revText").append("<br>");
                   //carousel slide
                   let galleryOutline=$("<div id='gallery1' class='carousel slide' data-ride='' style='text-align: center'></div>");
                   let galleryList=$("<ul id='galleryList' class='carousel-indicators'></ul>");
                   let innerGallery=$(" <div id='innerGallery' class='carousel-inner'></div>");
                   let prev=$(" <a class='carousel-control-prev' href='#gallery1' data-slide='prev'></a>").append($("<span class='carousel-control-prev-icon'></span>"));
                   let next=$(" <a class='carousel-control-next' href='#gallery1' data-slide='next'></a>").append($("<span class='carousel-control-next-icon'></span>"));




                   while(numberOfPictures>0){
                            let galleryListItem=$("<li datatarget='#gallery1'></li>");
                       let innerGalleryItem=$("<div class='carousel-item '></div>");
                            if(numInGallery==0) {
                                galleryListItem.addClass("active");
                                innerGalleryItem.addClass("active");
                            }
                            numInGallery++;
                            let numOfPic=""+numInGallery;

                            galleryListItem.attr("data-slide-to", numOfPic);

                            galleryList.append(galleryListItem);



                       let picName="pic"+numberOfPictures;
                       numberOfPictures--;
                       let path=data[picName];
                       let base_url = $("#BaseUrl").val();

                       let picture=$("<img style='height: 300px; width: 300px'>").attr("src",base_url+path);

                       innerGalleryItem.append(picture);
                      innerGallery.append(innerGalleryItem);

                   }
                 //  galleryOutline.append(galleryList);
                   galleryOutline.append(innerGallery);
                   galleryOutline.append(prev);
                   galleryOutline.append(next);
                   $("#revText").append(galleryOutline);




               }
               else{
                   $("#revText").css({
                      'display':'flex',
                      ' align-content': 'center',
                   'align-items': 'center'

                   });
               }



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

<script>
    function goHome(){
        javascript:history.go(-1);
    }
</script>

</head>
<body onload="getReview()">
<div class=" container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 mt-2" id="header">
            <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
            <button class="btn btn-outline-light" onclick="goHome()">
                Back To Home
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12" style="text-align: center">
            <h2 name="rev_title" id="titleRev">My Favourite memory</h2>
            <h3 name="place_cnt_date" id="place_cnt_date">Amsterdam, Netherlands &nbsp;&nbsp;2020-05-05</h3>
            <br>
        </div>
    </div>
    <input type="hidden" id="BaseUrl" value="<?php echo base_url();?>">
    <div class="row">
 <div class="col-3"></div>
        <!-- col-10 pg -->
     <div class="col-sm-6 " >


    <p style="font-size: 25px; color: black ;height: 50vh; overflow: auto; " class="reviewParagraph"   name="revText" id="revText">

    </p>


     </div>
       <div class="col-3"></div>
    </div>
    <div class="row">
        <div class="col-5"></div>
        <div class="col-2" style="text-align: center">

            <table class="table" id="revInfo" >

            </table>
        </div>
        <div class="col-5"></div>
    </div>


</div>
   </body>
   
   </html>