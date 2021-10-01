google.charts.load('current', {
    'packages':['geochart'],
    // Note: you will need to get a mapsApiKey for your project.
    // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
    'mapsApiKey': 'enter API KEY'
});
  google.charts.setOnLoadCallback(drawRegionsMap);
  function drawMap(countries){
      let array=[];
      array.push(['Country', 'Status', {'type': 'string', 'role': 'tooltip', 'p': {'html': true}}]);
      for(let cnt in countries) {
          let text;
          if(countries[cnt]["type"]==1)text=" visited";
          else if(countries[cnt]["type"]==2)text=" to go";
          else text=" my country";
          array.push([countries[cnt]["name"], countries[cnt]["type"], createTooltipContent(countries[cnt]["code"], text)]);
          if(countries[cnt]["name"]=="Serbia"){
              array.push([{v:'xK', f:'Serbia'},countries[cnt]["type"],createTooltipContent('rs',text)]);
          }
      }
      var data = google.visualization.arrayToDataTable(array);
      var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
      google.visualization.events.addListener(chart, 'select', function(){
          var selection=chart.getSelection();
          var selectedItem = selection[0];
          if (selectedItem) {
              var type = data.getValue(selectedItem.row, 1);
              var name=data.getValue(selectedItem.row, 0);
              if(type==1||type==3)location.pathname="Journal/countryJournal/"+name;
          }
      });

      chart.draw(data, options);
      $("body").fadeTo("slow",1);
      function f(){
          chart.draw(data, options);

      }

      window.addEventListener("resize",f());
  }
function createTooltipContent(country,text){
    return '<div>'+
        '<img src="https://flagcdn.com/24x18/' + country.toLowerCase() +'.png" style="width:24px;height:18px;">'+
        '<p style="text-align:center">status:'+text+'</p></div>';

}

const fonts=
    {
        name:'myFont',
        locals: ['Sunday Snow'],
        source:'traveljournal.ttf'
    };


var options = {
    title:'Naslov',
    backgroundColor: '#eeeeee',
    datalessRegionColor: '#fbe3aa',
    colorAxis: {colors: ['#FA5B3B','#4754A2','#CA2B0B'], values:[1,2,3]},
    legend :'none',
    focusTarget: 'category',
    tooltip: {isHtml:true, textStyle:{color:'#273482',fontName:'Sunday Snow', fontSize:16, bold:false},borderColor:'red'},
    width:'58%',
    outerHeight:'48%'
};
  function drawRegionsMap() {

      let d=ajaxCall();
  }

  function loadMenu(data){

      let avatar=document.getElementById("avatar");
      avatar.setAttribute("src",base+data["avatar"]);
      // alert(base+data["avatar"]);
      let username=document.getElementById("username1");
      username.innerHTML=data["username"];
      username.style.textTransform="uppercase";
      let tokens=document.getElementById("tokens");
      tokens.innerText=data["tokens"];
  }

  $(document).ready(function(){
      $("#image").on("click",function(){
          $("#myModal").modal('show');
      });

      $('#logout').on("click",function (){
          $("#myModal2").modal('show');
      });

      $("#ok").on("click",function (){
          window.location.href=logoutURL;
      });
  });

function showModal(){
    $("#myModal").modal({
        backdrop:'static',
        keyboard:false
    });
}

function changePic(){
    let fd = new FormData();
    let files = $('#file-upload')[0].files;
    if (files.length > 0) {
        fd.append('file', files[0]);

    } else {
        alert("You need to choose a picture first!");
        return;
    }
    picAjax(fd);

}




