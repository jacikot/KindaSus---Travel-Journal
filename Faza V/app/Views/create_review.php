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

    <script>
        function createRev(){


            let title1=document.getElementById('title').value;
            let place1=document.getElementById('place').value;
            let country1=document.getElementById('country').value;


            let date1=document.getElementById('date').value;
            let text1=document.getElementById('text').value;
            alert(text1);
            //potencijalno provera da li je dobra zemlja
            let message="";
            if(!title1) message+="Please enter the title for your memory! "
            if(!place1) message+="Please enter the place you visited! "
            if(!country1) message+="Please enter the country you visited! "
            if(!date1) message+="Please choose the date of your travel! "
            if(!text1) message+="Please write your memory! "

            if(message!=""){
                alert(message);
                return;
            }
            let prom="0";

            $.post("<?php echo base_url('CreateReview/addRev') ?>",
                {
                    'title':title1,
                    'place':place1,
                    'country':country1,
                    'privacy':prom,
                    'text':text1,
                    'date':date1
                }
                ,
                function (vr){

                }
            );


        }
    </script>




    <link rel="stylesheet" href="<?php echo base_url('assets/css/style_create_review.css') ?>">
    
</head>

<body>
 <div id='header'>
    <img src="<?php echo base_url('assets/images/logo2.png')  ?>" >
        
     <a href='' class="back-to-home" >Passport</a>
     
 </div >

 <div id='page'>
     <br>
     <h1>Keep your dream alive</h1>
     <!--
     <form name="form_review" method="post" action="<?= site_url("CreateReview/addRev") ?>">
     -->
     <div id='page_main'>
     <div id='page_left'>

     <table>
<tr>
    <td required>Place</td>
    <td>
        <input type="text" name="place" id="place" class='textField'>
    </td>

</tr>
<tr>
    <td  required>Country</td>
    <td>
        <input type="text" name="country" id="country" class='textField'>
    </td>

</tr>
<td>Date of travelling &nbsp;&nbsp;&nbsp;</td>
<td><input type="date" name="date" id="date"  placeholder="" class='textField'></td>
</tr>
<tr>
    <td>Set privacy status: </td>
    <td>
        <input type="radio"  name='privacy'  checked >Private
        <input type="radio" name='privacy'>Public
    </td>
</tr>
<tr>
    <td  required>Title for your memory &nbsp;&nbsp;&nbsp;</td>
    <td>
        <input type="text" name="title" id="title" class='textField'>
    </td>

</tr>

     </table>

     </div>
     <div id='page_right'>

        <table>
            <tr>
                <td colspan="2" align="center">Share your memories</td>
            
            </tr>
            <tr>
                <td colspan="2"  align="center">
                <textarea rows='5' cols="75" name="text" id="text" style="outline: none;"></textarea>
            </td>
            <tr>
                <td>Path to the picture&nbsp;&nbsp;&nbsp;</td>
                <td><input type="text"  class='textField'></td>
            </tr>
            <tr>
                
                <td colspan="2" align="center" >
                  <!--  <label for="button1">Add Pictures</label>
                    -->
                    <input type="button" value='Add Pictures' class='bottomButton' id='button1' >
                </td>
                <td> </td>
            </tr>
        </table>
     </div>
 </div>
 <div id='page_bottom'>
    <input type="button" value= 'Only mark the place on the map' class='bottomButton'>
<input type="button" value= 'Write in your Journal' class='bottomButton' onclick="createRev()">


 </div>
     <!--
     </form>
     -->

</div>

</body>

</html>