<?php

/*
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
       <div id="regions_div" style="width: 900px; height: 500px;"></div>


<script>

      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
          ['FL', 200],
          ['United States', 300],
          ['Brazil', 400],
          ['Canada', 500],
          ['France', 600],
          ['941', 700]
        ]);

        var options = {
            displayMode:'regions',
            region:'US-FL',
            resolution:'metros'


        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
</script>
*/
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport"/>
<title>AustinZipCodes - Google Fusion Tables</title>
<style type="text/css">


googft-mapCanvas {
    height: 100%;
    text-transform: capitalize;
}


/* Optional: Makes the sample page fill the window. */

html,
body {
    height: 100%;
    margin: 0;
    padding: 0;
}
</style>


<!--<iframe width="500" height="300" scrolling="no" frameborder="no" src="https://fusiontables.google.com/embedviz?q=select+col2+from+1qtZ1dQkP5qL80DONxbz1gZos6Mruz5_Tp6GonyHO&amp;viz=MAP&amp;h=false&amp;lat=30.34423006612287&amp;lng=-97.66323710613074&amp;t=1&amp;z=12&amp;l=col2&amp;y=2&amp;tmplt=2&amp;hml=KML"></iframe>
links to online version of the map
-->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?v=3"></script>

<script type="text/javascript">
  function initialize() {
    var isMobile = (navigator.userAgent.toLowerCase().indexOf('android') > -1) ||
      (navigator.userAgent.match(/(iPod|iPhone|iPad|BlackBerry|Windows Phone|iemobile)/));
    if (isMobile) {
      var viewport = document.querySelector("meta[name=viewport]");
      viewport.setAttribute('content', 'initial-scale=1.0, user-scalable=no');
    }
    var mapDiv = document.getElementById('googft-mapCanvas');
    mapDiv.style.width = '100%';
    mapDiv.style.height = '100%';
    var map = new google.maps.Map(mapDiv, {
      center: new google.maps.LatLng(30.34423006612287, -97.66323710613074),
      zoom: 12,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(document.getElementById('googft-legend-open'));
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(document.getElementById('googft-legend'));

    layer = new google.maps.FusionTablesLayer({
      map: map,
      heatmap: { enabled: false },
      query: {
        select: "col2",
        from: "1qtZ1dQkP5qL80DONxbz1gZos6Mruz5_Tp6GonyHO",
        where: ""
      },
      options: {
        styleId: 2,
        templateId: 2
      }
    });

    if (isMobile) {
      var legend = document.getElementById('googft-legend');
      var legendOpenButton = document.getElementById('googft-legend-open');
      var legendCloseButton = document.getElementById('googft-legend-close');
      legend.style.display = 'none';
      legendOpenButton.style.display = 'block';
      legendCloseButton.style.display = 'block';
      legendOpenButton.onclick = function() {
        legend.style.display = 'block';
        legendOpenButton.style.display = 'none';
      }
      legendCloseButton.onclick = function() {
        legend.style.display = 'none';
        legendOpenButton.style.display = 'block';
      }
    }
  }

  google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
  <div id="googft-mapCanvas"></div>
</body>
</html>
