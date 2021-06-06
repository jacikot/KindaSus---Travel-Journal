<!-- Autor: Adriana Vidic -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Go list</title>

    <script src="https://kit.fontawesome.com/7d57026c7c.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- pre uvozenja js-a treba da uvezemo i jquery i popper-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js">
    </script>
    <!-- dovlacenje javascript-a za bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>



    <link rel="stylesheet" href="<?php echo base_url('assets/css/style_togo.css') ?>">

    <script>

        function myToGo(){
            $.post("<?php echo base_url('ToGoList/getMyToGo') ?>",{

                }
                ,
                function (dataJSON){

                    let data=JSON.parse(dataJSON);

                    for(let i=0;i<data.length;i++){
                        let current_item=data[i].split(";");
                        let destination=current_item[0]+", "+current_item[1]+"  ";

                        let item;
                        if(current_item[2]=='1') item=$("<li style='text-decoration: line-through;;'></li>").append(destination);
                        else item=$("<li></li>").append(destination);
                        let binButton=$("<button value='Dugme' class='bottomButton' ></button>").append($("<i>").addClass('fas fa-trash-alt').append("</i>"));
                        binButton.click(function (){
                            deleteFromToGo(current_item[0],current_item[1]);



                        });
                        let crossButton=$("<button value='DugmeB' class='bottomButton' ></button>").append($("<i>").addClass('far fa-check-square').append("</i>"));;;
                        crossButton.click(function (){
                            crossFromToGo(current_item[0],current_item[1]);

                            item.addClass("crossed");
                            item.reload();

                        });
                       $(item).append(binButton);
                        $(item).append(crossButton);
                        $("#togo_list").append(item);
                    }


                }
            );


        }



        function addToList(){
            let country=document.getElementById('countryToVisit').value;
            let place=document.getElementById('placeToVisit').value;;

            $.post("<?php echo base_url('ToGoList/addToToGoList') ?>",{
                    'countryToVisit':country,
                    'placeToVisit':place
                }
                ,
                function (status){



                    if(status=='okay'){
                        alert(status);
                        let destination=""+place+", "+country;
                        let item=$("<li></li>").append(destination);
                        let binButton=$("<button value='Dugme' class='bottomButton' ></button>").append($("<i>").addClass('fas fa-trash-alt').append("</i>"));
                        binButton.click(function (){
                            deleteFromToGo(place,country);


                        });
                        let crossButton=$("<button value='DugmeB' class='bottomButton' ></button>").append($("<i>").addClass('far fa-check-square').append("</i>"));;
                        crossButton.click(function (){
                            crossFromToGo(place,country);
                            item.addClass("crossed");
                            item.reload();

                        });
                        $(item).append(binButton);
                        $(item).append(crossButton);
                        $('#togo_list').append(item);
                    }
                    else{
                        alert(status);
                    }

                }
            );
        }

        function crossFromToGo(place, country){


            $.post("<?php echo base_url('ToGoList/crossFromList') ?>",{
                    'countryToCross':country,
                    'placeToCross':place
                }
                ,
                function (status){

                    if(status=='okay') {
                    }
                    else{
                        alert(status);
                    }

                }
            );
        }

        function deleteFromToGo(place, country){


            $.post("<?php echo base_url('ToGoList/deleteFromList') ?>",{
                    'countryToCross':country,
                    'placeToCross':place
                }
                ,
                function (status){

                    if(status=='okay'){
                        $("#togo_list").empty();
                        myToGo();
                        //fiksirati velicinu!
                    }
                    else{
                        alert(status);
                    }

                }
            );
        }

        function openListModal(){
            $("#addToGo").modal();
        }

    </script>

</head>
<body onload="myToGo()">
<container-fluid>

<br>
    <div class="row" style="display: flex; flex-direction: row">
        <div class="col-12"><h2 style="text-align: center">To-Go List &nbsp;&nbsp;&nbsp;
            <button class="bottomButton" onclick="openListModal()"><i class="fas fa-edit"></i></button>
            </h2>
           </div>
    </div>
    <br>
    <div class="row">
    <div class="col-4">
        &nbsp;&nbsp;&nbsp;
    </div>
    <div class="col-4 togoListDiv" style="height: 80vh; text-align: center" >


            <ol id="togo_list">

            </ol>
    </div>
    <div class="col-4"></div>
    &nbsp;&nbsp;&nbsp;
</div>






<div class="modal fade" id="addToGo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black; text-align: center">Add new travelling goal!</h5>
            </div>
            <div class="modal-body" style="color: black">
                <input type="text"  class='textField' name="placeToVisit" id="placeToVisit" placeholder="Place">
                <input type="text"  class='textField' name="countryToVisit" id="countryToVisit" placeholder="Country">
            </div>

            <div class="modal-footer" style="color: black">
                <button type="button" class="btn modalButton" data-dismiss="modal" style="text-align: left">Close</button>
                <input type="button"  class='modalButton' value='Set new travelling goal' onclick="addToList()">
            </div>
        </div>
    </div>
</div>
</container-fluid>
</body>

</html>