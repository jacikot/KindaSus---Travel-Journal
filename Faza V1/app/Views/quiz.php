<!-- author: Dimitrije Panic-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/stylequiz.css')?>" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('/assets/js/quiz.js')?>"></script>
    <title>Travel Quiz</title>
</head>
<body onload="nextQuestion('<?=base_url('Quiz')?>')">
    <div id="header"> <img src="<?php echo base_url('/assets/images/pic.png')?>" height=10% width=10%/>
        <a href=""><input class="button" type="button" value="Passport"> </a></div>
    <div id="title"> Find Your Dream Destination </div>
    <div id="question"> </div>
    <!--<div class="progress">
        <div class="progress-bar" style="width:70%">
            70%
        </div>
    </div>-->
    <table id="tabela">
        <tr> <td> </td></tr>
        <tr> <td align="left"><input id="1" type="radio" name="next"> <label id="11" for="1"> </label> </td> </tr>
        <tr> <td align="left"><input id="2" type="radio" name="next">
            <label id="22" for="2"></label></td> </tr>
        <tr> <td align="left"><input id="3" type="radio" name="next">
            <label id="33" for="3" </label> </td></tr>
        <tr> <td align="left"><input id="4" type="radio" name="next">
                <label id="44" for="4" </label> </td></tr>
     </table>
    <button class="btn newButton" id="dugme" onclick="nextQuestion('<?=base_url('Quiz')?>')">
        Next
    </button>
 
 
</body>
</html>