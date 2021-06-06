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
<body onload="nextQuestion('<?=base_url('Quiz')?>')" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 mt-2" id="header">
                <img src="<?php echo base_url('assets/images/pic.png') ?>" id="logo"/>
                <button class="btn btn-outline-light moj">
                    Back To Home
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" id="naslov">
                Find Your Dream Destination
            </div>
        </div>
        <div class="row">
           <div class="col-lg-3">

           </div>
            <div class="col-lg-6 rounded" id="pozadina">
               <div class="row ">
                   <div class="col-lg-9 pt-2" id="question">
                       What is ur favorite animal?
                   </div>
                   <div class="col-lg-3 my-auto">
                       <div class="progress">
                           <div class="progress-bar progress-bar-striped bgp" id="prog" style="width:0%">
                               0/5
                           </div>
                       </div>
                   </div>
               </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <table class="table">
                            <tr>
                                <td align="left">
                                    <input id="1" type="radio" name="next">
                                    <label id="11" for="1"> </label>
                                </td>
                            <!--</tr>-->
                            <!--<tr>-->
                                <td align="left">
                                    <input id="2" type="radio" name="next">
                                    <label id="22" for="2"></label>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <input id="3" type="radio" name="next">
                                    <label id="33" for="3">
                                    </label>
                                </td>
                                <!--</tr>-->
                                <!--<tr>-->
                                <td align="left">
                                    <input id="4" type="radio" name="next">
                                    <label id="44" for="4">
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2 pl-3 pr-3 rasporedi ">
                        <button class="btn btn-outline-light my-auto dugme  pt-1 pb-1" id="prev" onclick="prevQuestion('<?=base_url('Quiz')?>')" disabled>
                            Previous
                        </button>
                        <button class="btn btn-outline-light my-auto dugme pt-1 pb-1" id="dugme" onclick="nextQuestion('<?=base_url('Quiz')?>')">
                            Next
                        </button>
                    </div>

                </div>
            </div>
            <div class="col-lg-3">

            </div>
        </div>
    </div>

<!--<body onload="nextQuestion('<?=base_url('Quiz')?>')">
    <div id="header"> <img src="<?php echo base_url('/assets/images/pic.png')?>" height=10% width=10%/>
        <a href=""><input class="button" type="button" value="Passport"> </a></div>
    <div id="title"> Find Your Dream Destination </div>
    <div id="question"> </div>
    <div class="progress">
        <div class="progress-bar" style="width:70%">
            70%
        </div>
    </div>
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
 
 -->
</body>
</html>