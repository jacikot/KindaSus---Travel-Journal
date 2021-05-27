<!-- author: Dimitrije Panic-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo base_url('/assets/js/reference.js')?>"></script>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/stylereference.css') ?>" type="text/css">
    <title>Reference</title>
    <script>
        function addIt(data){
            let url = "<?php echo  base_url('Quiz/addRecommendationToToGo/') ?>";
            sendIt(data,url);
        }
    </script>

</head>
<body>
    <div id="header"> <img src="<?php echo base_url('assets/images/pic.png') ?>" height=10% width=10%/>  <a href="map.html"><input class="button" type="button" value="Passport"> </a></div>
    <div id="title"> We recommend: </div>
    <div id="place"><?php
        if(isset($data)) {
            echo $data['place']->name.", ".$data['country']->name;
        } else{
            echo "Sorry we couldnt find you a recommendation..";
        }

        ?>
    <!--<a href="quiz1.html" id="link">  London,The United Kingdom </a>--> </div>
    <div class="pic">
        <img src="<?php if(isset($data)){
            echo 'https://www.countryflags.io/'.$data['country']->code.'/shiny/64.png';
        } else {
            // dodaj ovde neku podrazumevano sliku
            //OBAVEZNO DODAJ ALT!!!
        }  ?> " alt="" height="120px" width="120px"/>
    </div>
    <div>
        <table id="tabela">
            <tr> <td>
            <?php
            if(isset($data)) {
                echo $data['quote'];
            } else{
                echo "The journey of a \<br\> thousand miles begins  \<br\> with a single step.";
            }

            ?>  </td> </tr>

        </table>
    </div>
    <input id="add" type="button" value="Add it to To-Go list" onclick="
    <?php
    if(isset($data)){
        echo 'addIt('.$data['id'].')';
    }
    ?>

">
    <a href="list_of_reviews_user.html"><input id="check" type="button" value="Check it out"> </a>
    <div id="mess"> Destination has been added</div>

</body>
</html>