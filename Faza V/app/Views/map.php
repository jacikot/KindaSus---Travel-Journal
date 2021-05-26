<!-- autor: Jana Toljaga -->

<html>
  <head>
    <link rel="stylesheet" href="<?php echo base_url("/assets/css/map.css")?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/map_tooltip.css")?>">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src=<?php echo base_url("assets/js/map.js")?>></script>
    <script src="https://kit.fontawesome.com/7d57026c7c.js" crossorigin="anonymous"></script>
      <script>
              var defaultAvatar="<?php echo  base_url("/assets/images/avatar.png")?>"
              var baseURL="<?= base_url('Map/getMap')?>";
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
      </script>

      <script>

      </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>

  </head>
  <body onload="initialize()">
    <div class="header">
        <img src="<?php echo base_url("/assets/images/logo2.png")?>" width=auto height="17%"/>
        <div id="menu_bar" class="menu_list">
            <div class="menu_list_link">
                <p id="passport">PASSPORT</p>
                <div class="menu_list_content">
                    <img id="avatar" width="30px" height="30px"/>
                    <p id="username" ><b></b></p>
                    <br/>
                    <i class="fas fa-star"></i>
                    <p id="tokens" style="display:inline; color:white; font-size:15pt">123</p>
                    <hr>
                    <a href="<?php echo base_url("Password/listPassQuestions")?>">change password</a><br/>
                    <a href="<?php echo base_url("Logout/logout")?>">logout</a>
                </div>
            </div>
        </div>
    </div>
    <br/>

    <div class="ttip b-search" tt-title="Search & Trending" tt-text="Explore places through other's eyes!">
      <a href="search_and_trending_user.html" class="search"><img src="<?php echo base_url("assets/images/search_trending.png")?>" class="search"/></a>
    </div>
    <div class="ttip b-quiz" tt-title="Quiz" tt-text="Ask for a travel advice!">
      <a href="quiz1.html" class="search"><img src="<?php echo base_url("assets/images/quizJ.png")?>" class="search quiz"/></a>
    </div>
    <div class="ttip b-create" tt-title="Create an impression" tt-text="Collect moments from all over the" tt-text2="world in one place">
      <a href="create_review.html"><img src="<?php echo base_url("assets/images/add.png")?>" class="add"/></a>
    </div>
    <div class="ttip b-to-go" tt-title="TO-GO list" tt-text="Don't call it a dream, call it a plan!">
      <a href="to-go_list.html" class="add sticky"><img src="<?php echo base_url("assets/images/sticky.png")?>" class="add sticky"/></a>
    </div>
    <div class="ttip b-journal" tt-title="Journal" tt-text="Revive your travel adventures!">
      <a href="<?= base_url('Journal/countryJournal')?>" class="journal"><img src="<?php echo base_url("assets/images/journal.png")?>" class="journal"/></a>
    </div>
    <div class="ttip b-badge" tt-title="Badge collection" tt-text="Look what you've accomplished so far!">
      <a href="badges.html" class="ttip"><img src="<?php echo base_url("assets/images/badge.png")?>" class="badge"/></a>
    </div>
    <img src="<?php echo base_url("assets/images/kov2.jpg")?>" class="envelope">
    <div id="regions_div" class='centerChart'></div>
    
    
  </body>
</html>
