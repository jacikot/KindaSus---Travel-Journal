<!-- autor: Jana Toljaga -->

<html>
  <head>
    <link rel="stylesheet" href="<?php echo base_url("/assets/css/map.css")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/map_tooltip.css")?>">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src=<?php echo base_url("assets/js/map.js")?>></script>

      <script src="https://kit.fontawesome.com/7d57026c7c.js" crossorigin="anonymous"></script>
      <script>
              var logoutURL="<?php echo base_url("Logout")?>";
              var defaultAvatar="<?php echo  base_url("/assets/images/avatar.png")?>"
              var baseURL="<?= base_url('Map/getMap')?>";
              var base="<?= base_url()?>";
              function ajaxCall() {
                  $.ajax(
                      {
                          url:baseURL,
                          type:"GET",
                          processData: false,
                          contentType:false
                      }
                  ).done(function (data){
                      let ret=JSON.parse(data);
                      drawMap(ret);
                  });
              }
              var baseURL2="<?= base_url('Map/getUserInfo')?>";
              function initialize(){
                  $.ajax({
                      url:baseURL2,
                      type:"GET",
                      processData: false,
                      contentType:false
                  }).done(function (data){
                      let ret=JSON.parse(data);
                      loadMenu(ret);
                  });
              }
              function picAjax(fd){
                  $.ajax({
                      url: "<?=base_url('ChangePic/changePic')?>",
                      type: "POST",
                      data: fd,
                      processData: false,
                      contentType: false,
                  }).done(function(data) {
                      let val = data.split(",");
                      if(val.length > 1){
                          $("#avatar").attr("src",base+val[1]+"?"+new Date().getTime()).load(" #avatar");
                          alert("Successfully changed your profile picture!")
                      } else {
                          alert("data");
                      }
                  })
              }
      </script>

      <script>

      </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>

  </head>
  <body onload="initialize()">
      <div class="jumbotron jumbotron-fluid header">
          <div class="container">
              <h1>
                  Travel Journal
              </h1>

          </div>
          <div id="menu_bar" class="menu_list">
              <div class="dropdown">
                  <button type="button" class="btn btn-outline-light dropdown-toggle passport" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                      PASSPORT
                  </button>
                  <div class="dropdown-menu menu_list_content" aria-labelledby="dropdownMenuButton" id="menu">
                      <table class="table table-borderless text-center">
                          <tr>
                              <td rowspan="2" id="avatarp"><img id="avatar" class="rounded rounded-circle" width="50px" height="50px"/></td>
                              <td>
                                  <p id="username" >
                                      <b id="username1"></b>
                                  </p>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  <div id="stars">
                                      <i class="fas fa-star"></i>
                                      <p id="tokens" style="display:inline; color:#36428a; font-size:15pt"></p>
                                  </div>
                              </td>

                          </tr>
                          <tr class="links border-top">
                              <td colspan="2">
                                  <img src="<?php echo base_url("/assets/images/lockP.svg")?>">
                                  &nbsp;<a href="<?php echo base_url("Password/listPassQuestions")?>">change password</a><br/>
                              </td>
                          </tr>
                          <tr class="links">

                              <td colspan="2">
                                  <img src="<?php echo base_url("/assets/images/image.svg")?>">
                                  &nbsp;<a id="image" href="#">change image</a>
                              </td>
                          </tr>
                          <tr class="links">

                              <td colspan="2">
                                  <img src="<?php echo base_url("/assets/images/exit.svg")?>">
                                  &nbsp;<a href="#" id="logout">logout</a>
                              </td>
                          </tr>

                      </table>
                  </div>
              </div>
          </div>
      </div>

      <div class="container-fluid px-5">
          <div class="row">
              <div class="col-lg-2 col-12 order-lg-1 order-2 text-center">
                  <div class="ttip b-search" tt-title="Search & Trending" tt-text="Explore places through other's eyes!">
                      <a href="<?php echo base_url("SearchAndTrending")?>" ><img src="<?php echo base_url("assets/images/search_trending1.png")?>"/></a>
                  </div>
                  <div class="ttip b-journal" tt-title="Journal" tt-text="Revive your travel adventures!">
                      <a href="<?= base_url('Journal/countryJournal')?>" ><img src="<?php echo base_url("assets/images/journal1.png")?>"/></a>
                  </div>
                  <div class="ttip b-quiz" tt-title="Quiz" tt-text="Ask for a travel advice!">
                      <a href="<?= base_url('Quiz/startQuiz')?>"><img src="<?php echo base_url("assets/images/quiz1.png")?>"/></a>
                  </div>

              </div>
              <div class="col-lg-8 order-lg-2 col-12 order-1 my-auto py-4 chart">
                  <div id="regions_div" class='centerChart'></div>
              </div>
              <div class="col-lg-2 col-12 order-3 text-center ">
                  <div class="x">
                      <div class="ttip b-create" tt-title="Create an impression" tt-text="Collect moments from all over the" tt-text2="world in one place">
                          <a href="<?php echo base_url("CreateReview")?>"><img src="<?php echo base_url("assets/images/add1.png")?>"/></a>
                      </div>
                  </div>
                  <div class="x">
                      <div class="ttip b-to-go" tt-title="TO-GO list" tt-text="Don't call it a dream, call it a plan!">
                          <a href="<?php echo base_url("ToGoList")?>"><img src="<?php echo base_url("assets/images/sticky1.png")?>"/></a>
                      </div>
                  </div>

                  <div class="ttip b-badge" tt-title="Badge collection" tt-text="Look what you've accomplished so far!">
                      <a href="<?php echo base_url("Badges")?>"><img src="<?php echo base_url("assets/images/badge1.png")?>" /></a>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header" id="head">
                      <h5 class="modal-title" id="exampleModalLabel">Change your profile picture</h5>
                  </div>
                  <div class="modal-body" id="telo">
                      <img  id="slikaprofila" class="rounded-circle" src="<?php echo base_url('assets/images/default-avatar-2.jpg') ?>" > <br>

                      <label id="inputslike" for="file-upload" class="custom-file-upload">
                          <div class="mt-2 my-auto">
                              Upload an image
                          </div>

                      </label>
                      <input id="file-upload"  type="file" onchange="document.getElementById('slikaprofila').src = window.URL.createObjectURL(this.files[0])" hidden/>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-dark" onclick="changePic()">Change</button>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                  </div>
                  <div class="modal-body">
                      Are you sure you want to log out?
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-dark" data-dismiss="modal" id="ok">Ok</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                  </div>
              </div>
          </div>
      </div>
  </body>
</html>
