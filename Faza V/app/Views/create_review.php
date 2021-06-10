 <!-- Autor: Adriana Vidic -->

 <?php
 use App\Controllers\CreateReview;
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>

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

    <script>

        function addPics(){
         //  document.getElementById('imgAdded').innerHTML=true;
        }

        function openPicsModal(){
            $("#modalReview").modal();
        }


        function createRev(){


            let title1=document.getElementById('title').value;
            let place1=document.getElementById('place').value;
            let country1=document.getElementById('country').value;



            let date1=document.getElementById('date').value;
            let text1=document.getElementById('text').value;

            let img_cnt=0;

            let fd = new FormData();
            let picName="file";
            if(document.getElementById('file-upload1').files.length !== 0) {
                let files = $('#file-upload1')[0].files;
                if (files.length > 0) {
                    img_cnt++;
                    let tmpName=picName+img_cnt;
                    fd.append(tmpName, files[0]);
                }
            }
            if(document.getElementById('file-upload2').files.length !== 0) {
                let files = $('#file-upload2')[0].files;
                if (files.length > 0) {
                    img_cnt++;
                    let tmpName=picName+img_cnt;
                    fd.append(tmpName, files[0]);
                }
            }
            if(document.getElementById('file-upload3').files.length !== 0) {
                let files = $('#file-upload3')[0].files;
                if (files.length > 0) {
                    img_cnt++;
                    let tmpName=picName+img_cnt;
                    fd.append(tmpName, files[0]);
                }
            }
            if(document.getElementById('file-upload4').files.length !== 0) {
                let files = $('#file-upload4')[0].files;
                if (files.length > 0) {
                    img_cnt++;
                    let tmpName=picName+img_cnt;
                    fd.append(tmpName, files[0]);
                }
            }
            if(document.getElementById('file-upload5').files.length !== 0) {
                let files = $('#file-upload5')[0].files;
                if (files.length > 0) {
                    img_cnt++;
                    let tmpName=picName+img_cnt;
                    fd.append(tmpName, files[0]);
                }
            }

            let prom=document.getElementById('private').checked;
           if(prom){prom=1;}
           else{
               prom=0;
           }
            fd.append('title',title1);
            fd.append('text',text1);
            fd.append('date',date1);
            fd.append('country',country1);
            fd.append('place',place1);
            fd.append('privacy', prom);
            fd.append('num_of_pics',img_cnt);


            //potencijalno provera da li je dobra zemlja
            let message="";
            if(!title1) {message+="Please enter the title for your memory! "; setReturnValues("Please enter the title for your memory! ",'#title','right');}
            if(!place1) {message+="Please enter the place you visited! "; setReturnValues("Please enter the place you visited! ",'#place','left');}
            if(!country1){ message+="Please enter the country you visited! "; setReturnValues("Please enter the country you visited!",'#country','right');}
            if(!date1){ message+="Please choose the date of your travel! "; setReturnValues("Please choose the date of your travel!",'#date','left');}
            if(!text1){ message+="Please write your memory! "; setReturnValues("Please write your memory! ",'#text','right');}

            if(message!=""){
                return;
            }



            $.ajax({
                url: "<?=base_url( 'CreateReview/addRev')?>",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
            }).done(function (vr){
                if(vr=='Congrats! You added another adventure to your journal!'){

                    $(".modal-title").text("Would you like to answer a few questions?");
                    $("#createdReview").modal();
                    $('#file-upload1').val('');
                    $('#file-upload2').val('');
                    $('#file-upload3').val('');
                    $('#file-upload4').val('');
                    $('#file-upload5').val('');
                }
                else{
                    $("#problemModal").empty();
                    $("#problemModal").append(vr);
                    $("#problemWithReview").modal();

                    return;
                }
            });


        }



        function modalSurvey(){

            $.post("<?php echo base_url('CreateReview/getSurveyQuestions') ?>",
                {

                }
                ,
                function (dataJSON){
                   let questions=JSON.parse(dataJSON);


                   let question1=questions['heritage'];
                   let question2=questions['relax'];
                   let question3=questions['sightseeing'];
                    let question4=questions['weather'];
                    let question5=questions['populated'];

                    $("#cell1").empty();
                    $("#cell3").empty();
                    $("#cell5").empty();
                    $("#cell7").empty();
                    $("#cell9").empty();
                    $("#cell1").append(question1);
                    $("#cell3").append(question2);
                    $("#cell5").append(question3);
                    $("#cell7").append(question4);
                    $("#cell9").append(question5);

                }
            );

            $("#surveyModal").modal();
        }

        function completeSurvey() {
            let points1 = document.getElementById('range1').value;
            let points2 = document.getElementById('range2').value;
            let points3 = document.getElementById('range3').value;
            let points4 = document.getElementById('range4').value;
            let points5 = document.getElementById('range5').value;

            points1 *= 3;
            points2 *= 3;
            points3 *= 3;
            points4 *= 3;
            points5 *= 3;

            points1=""+points1;
            points2=""+points2;
            points3=""+points3;
            points4=""+points4;
            points5=""+points5;

            let country=document.getElementById('country').value;
            let place=document.getElementById('place').value;



            $.post("<?php echo base_url('CreateReview/completeSurveyInfo') ?>",
                {
                    'place': place,
                    'country': country,
                    'points_heritage': points1,
                    'points_relax': points2,
                   'points_weather': points3,
                    'points_sightseeing': points4,
                    'points_populated': points5
                }
                ,
                function (){

                }
            );


        }

        function pinPlaceOnTheMap(){

            let place1=document.getElementById('place').value;
            let country1=document.getElementById('country').value;
            let fd = new FormData();

            fd.append('country',country1);
            fd.append('place',place1);


            //potencijalno provera da li je dobra zemlja
            let message="";
            if(!place1) {message+="Please enter the place you visited! "; setReturnValues("Please enter the place you visited! ",'#place','left');}
            if(!country1){ message+="Please enter the country you visited! ";setReturnValues("Please enter the country you visited! ",'#country','right');}

            if(message!=""){
                return;
            }


            $.ajax({
                url: "<?=base_url( 'CreateReview/pinOnTheMap')?>",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
            }).done(function (vr){
                if(vr=='Congrats! You pinned a place on the map!'){

                    $(".modal-title").text("Would you like to answer a few questions?");
                    $("#createdReview").modal();
                }
                else{
                    $("#problemModal").empty();
                    $("#problemModal").append(vr);
                    $("#problemWithReview").modal();

                    return;
                }
            });

        }

        function setReturnValues(text,id,position){
            $(id).attr('data-toggle',"popover");

            $(id).attr("data-content", text);

                $(id).attr("data-placement", position);

            $(id).popover();
            $(id).popover('enable');
            $(id).popover('show');
            setTimeout(remove,2000);
        }
        function remove(){
            $('#text').popover('disable');
            $('#title').popover('disable');
            $('#place').popover('disable');
            $('#country').popover('disable');
            $('#date').popover('disable');


            $('#text').popover('hide');
            $('#title').popover('hide');
            $('#place').popover('hide');
            $('#country').popover('hide');
            $('#date').popover('hide');
        }

    </script>




    <link rel="stylesheet" href="<?php echo base_url('assets/css/style_create_review.css') ?>">

    <script>
        function goHome(){
            window.location.href="<?= base_url('Map/index') ?>"
        }
    </script>
    
</head>

<body>
 <div class=" container-fluid">
     <div class="row">
         <div class="col-lg-12 col-md-12 mt-2" id="header">
             <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
             <button class="btn btn-outline-light" onclick="goHome()">
                 Go to Map
             </button>
         </div>
     </div>


     <div class="row" id="red">
         <div class="col-lg-3 col-md-1 col-sm-1 col-xs-1">
             &nbsp;&nbsp;
         </div>
         <div class="col-lg-6 col-md-12 col-sm-12 col-xs-10 my-auto pozadina rounded" id="tab">
             <table class="table mt-2 mb-2" style="z-index: -1;!important;">
                 <tr>
                     <td colspan="2" class="naslov" style="text-align: center">
                         Keep your dream alive
                     </td>
                 </tr>
           <tr>
           <td>
               <input type="text" name="place" id="place"  placeholder="Place">
           </td>
            <td>
                <input type="text" name="country" id="country"  placeholder="Country">
            </td>
           </tr>
           <tr>
               <td>
                   <input type="date" name="date" id="date"  placeholder="Date of your travel"></td>
               </td>
               <td>
                   <input type="text" name="title" id="title" placeholder="Title of your memory!">
               </td>
           </tr>
           <tr>
               <td colspan="2"  >
                   <textarea  class="rounded"  placeholder="Share your memories!" name="text" id="text" style="outline: none; text-align: justify"></textarea>
               </td>
           </tr>
           <tr>

               <td>Set privacy status: &nbsp;<input type="radio"  name='privacy' id="private" checked >Private
                   <input type="radio" name='privacy' id="public">Public</td>
               <td onclick="openPicsModal()" class="picUpload">
                   Add some pictures!

               </td>
           </tr>
                 <tr>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                 </tr>

                 <tr>
                     <td style="text-align: left">
                         <button class='btn btn-outline-light' onclick="pinPlaceOnTheMap()">Only mark the place on the map</button>
                     </td>
                     <td style="text-align: right">
                         <button  class='btn btn-outline-light' onclick="createRev()">Write in your Journal</button>
                     </td>
                 </tr>
             </table>
         </div>
         <div class="col-lg-3  col-md-1 col-sm-1 col-xs-1">
             &nbsp;&nbsp;
         </div>

     </div>

     <!--
     ------------------------------------
     -->


 <div class="modal fade" id="surveyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel123" style="color: black; text-align: justify;">Your impressions</h5>
             </div>
             <div class="modal-body " style="color: black; text-align: justify;">
                 Hey! So, there are five questions and a scale from 0 to 10. Choose how much you agree with each question
                 <br>
                 (eg.
                 Is this place the best place you have ever visited?
                 <br>0-Nope, not even close
                 <br>10-Yup, there is no better place in the whole world!)
                 <br>
                    <hr>
                 <table class="tableModal" id="surveyTable" style="color: black">
                    <tr>
                        <td id="cell1"  style="color: black"></td>
                        <td id="cell2">
                            <input type="range" id='range1' max="10" min="0">
                        </td>
                    </tr>

                     <tr>
                         <td id="cell3"  style="color: black"></td>
                         <td id="cell4">
                             <input type="range" id='range2' max="10" min="0">
                         </td>
                     </tr>

                     <tr>
                         <td id="cell5"  style="color: black"></td>
                         <td id="cell6">
                             <input type="range" id='range3' max="10" min="0">
                         </td>
                     </tr>


                     <tr>
                         <td id="cell7"  style="color: black"></td>
                         <td id="cell8">
                             <input type="range" id='range4' max="10" min="0">
                         </td>
                     </tr>

                     <tr>
                         <td id="cell9"  style="color: black"></td>
                         <td id="cell10">
                             <input type="range" id='range5' max="10" min="0">
                         </td>
                     </tr>



                 </table>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-dark" onclick="completeSurvey()" data-dismiss="modal">Done with survey</button>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="createdReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel" style="color: black; text-align: center">Would you like to answer a few questions?</h5>
             </div>
             <!--
             <div class="modal-body" style="color: black">
                 Some text
             </div>
             -->
             <div class="modal-footer" style="color: black">
                 <button type="button" class="btn btn-dark" data-dismiss="modal" style="text-align: left">Close</button>
                 <button type="button" class="btn btn-dark" data-dismiss="modal"  onclick="modalSurvey()">You bet</button>
             </div>
         </div>
     </div>
 </div>


 <div class="modal fade" id="modalReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel" style="color: black; text-align: center">Add your pictures here!</h5>
             </div>

             <div class="modal-body" style="color: black">
                 Hey there! You can add up to five of your favourite pics in the fields below to keep your dream alive!
                 <br>
                 <hr>
                 <label id="inputslike1" for="file-upload1" class="custom-file-upload">

                     <div class="mt-2 my-auto">
                         Add 1st pic!

                     </div>

                 </label>
                 <input id="file-upload1" onchange="document.getElementById('inputslike1').innerHTML=this.files[0].name"  type="file" hidden/>
                 <hr>
                 <label id="inputslike2" for="file-upload2" class="custom-file-upload">
                     <div class="mt-2 my-auto">
                         Add 2nd pic!

                     </div>

                 </label>
                 <input id="file-upload2" onchange="document.getElementById('inputslike2').innerHTML=this.files[0].name" type="file" hidden/>
                 <hr>
                 <label id="inputslike3" for="file-upload3"  class="custom-file-upload">

                     <div class="mt-2 my-auto">
                         Add 3rd pic!

                     </div>

                 </label>
                 <input id="file-upload3" onchange="document.getElementById('inputslike3').innerHTML=this.files[0].name" type="file" hidden/>
                 <hr>
                 <label id="inputslike4" for="file-upload4" class="custom-file-upload">
                     <div class="mt-2 my-auto">
                         Add 4th pic!

                     </div>

                 </label>
                 <input id="file-upload4" onchange="document.getElementById('inputslike4').innerHTML=this.files[0].name" type="file" hidden/>
                 <hr>

                 <label id="inputslike5" for="file-upload5"  class="custom-file-upload">
                     <div class="mt-2 my-auto">
                         Add 5th pic!

                     </div>

                 </label>
                 <input id="file-upload5" onchange="document.getElementById('inputslike5').innerHTML=this.files[0].name" type="file" hidden/>



             </div>

             <div class="modal-footer" style="color: black">
                 <button type="button" class="btn btn-dark" data-dismiss="modal" style="text-align: left">Close</button>
                <!--
                 <button type="button" class="btn btn-dark" data-dismiss="modal"  onclick="addPics()">Done with pics!</button>
                 -->
             </div>
         </div>
     </div>
 </div>
     <!-- modal for problems -->
     <div class="modal fade" id="problemWithReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">

                 <
                 <div class="modal-body" style="color: black" id="problemModal">

                 </div>

                 <div class="modal-footer" style="color: black">
                     <button type="button" class="btn btn-dark" data-dismiss="modal" style="text-align: left">Close</button>

                 </div>
             </div>
         </div>
     </div>

 </div>
</body>

</html>