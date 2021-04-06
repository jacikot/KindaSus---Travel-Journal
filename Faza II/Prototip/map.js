google.charts.load('current', {
    'packages':['geochart'],
    // Note: you will need to get a mapsApiKey for your project.
    // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
    'mapsApiKey': 'AIzaSyBAlUQcB6uOW4sOTPobY-3nB-IA00kFrsA'
});
  google.charts.setOnLoadCallback(drawRegionsMap);

  function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable([
      ['Country', 'Status', {'type': 'string', 'role': 'tooltip', 'p': {'html': true}}],
      ['Germany', 1,createTooltipContent('de',' visited')],
      ['United States', 1,createTooltipContent('us',' visited')],
      ['Brazil', 2,createTooltipContent('br',' to go')],
      ['Tanzania', 2,createTooltipContent('tz',' to go')],
      ['China', 2,createTooltipContent('cn',' to go')],
      ['Serbia',3,createTooltipContent('rs',' my country')],
      [{v:'xK', f:'Serbia'},3,createTooltipContent('rs',' my country')],
      ['Russia',2,createTooltipContent('ru',' to go')]
    ]);
    function createTooltipContent(country,text){
        return '<div>'+
            '<img src="https://flagcdn.com/24x18/' + country +'.png" style="width:24px;height:18px;">'+
            '<p style="text-align:center">status:'+text+'</p></div>';

    }

    function clickHandler(){
        var selection=chart.getSelection();
        var selectedItem = selection[0];
        if (selectedItem) {
            var type = data.getValue(selectedItem.row, 1);
            if(type==1||type==3)window.open("russia_journal.html");
        }
        
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
        colorAxis: {colors: ['#FA5B3B','#4754A2','#CA2B0B']},
        legend :'none',
        focusTarget: 'category',
        tooltip: {isHtml:true, textStyle:{color:'#273482',fontName:'Sunday Snow', fontSize:16, bold:false},borderColor:'red'},
        width:'58%',
        outerHeight:'48%'
    };
    
    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
    google.visualization.events.addListener(chart, 'select', clickHandler);
    chart.draw(data, options);
    function f(){
        chart.draw(data, options);
    }
   window.addEventListener("resize",f());
  }