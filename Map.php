<?php
require_once('Dao.php');
session_start();
$dao = new Dao();
if(!isset($_SESSION['user'])){
   header("Location:LoginPage.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Map</title>
    <link rel="icon" href="twoDragon.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="mainPageStyle.css">
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.4/css/ol.css" type="text/css">
    <script src="https://openlayers.org/en/v4.6.4/build/ol-debug.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  </head>
  <body>
    <div id="logoutButtonHolder">
  		<button id="logoutButton" class="tablinks" type="submit" onclick="location.href='logout.php'">LOG OUT</button>
  	</div>
    <br>
    <div id="iconHolder">
    <img src="yinyangdragon.png" alt="First Dragon" style="width:100px;height:100px;float:left">
    <img src="yinyangdragon.png" alt="Second Dragon" style="width:100px;height:100px;float:right">

    <h1 id="banner">
      MYTHICAL ORIGINS
    </h1>
</div>
  <div id="tabHolder">
    <div class="tab">
      <button class="tablinks" onclick="location.href='HomePage.php'">HOME</button>
      <button class="tablinks" onclick="location.href='CreatureList.php'">CREATURES</button>
      <button class="active" onclick="location.href='Map.php'">MAP</button>
      <button class="tablinks" onclick="location.href='LoginPage.php'">LOG IN</button>
    </div>
  </div>

  <div id="Home" class="tabcontent">
    <h3>HOME</h3>
    <p>Access Home</p>
  </div>

  <div id="Creatures" class="tabcontent">
    <h3>CREATURES</h3>
    <p>Access Creatures</p>
  </div>

  <div id="Map" class="tabcontent">
    <h3>MAP</h3>
    <p>Access Map</p>
  </div>

  <div id="Login" class="tabcontent">
    <h3>LOG IN</h3>
    <p>Gonna log in</p>
  </div>

  <br>
    <div id="map" class="map"></div>
    <br>
    <div id="point-info"></div>

    <script>

    var deviceSource = new ol.source.Vector();
    var cache = {};

    function pointStyle(feature, scale) {
      var url = feature.get('url');
      var key = scale + url;
      if(!cache[key]){
        cache[key] = new ol.style.Style({
          image: new ol.style.Icon({
          scale: scale,
          src: url
          })
        });
      }
        return cache[key];
      }


      function pointFStyle(feature){
        return [pointStyle(feature, 0.04)];
      }
      function selectedStyle(feature){
        return [pointStyle(feature, 0.06)];
      }

      var vector = new ol.layer.Vector({
        source: deviceSource,
        style: pointFStyle
      });

      var layer = new ol.layer.Tile({
        source: new ol.source.OSM()
      });

      var center = ol.proj.transform([0,25], 'EPSG:4326', 'EPSG:3857');

      var map = new ol.Map({
        controls: ol.control.defaults().extend([
          new ol.control.FullScreen()
        ]),
        interactions: ol.interaction.defaults({mouseWheelZoom:false}),
        renderer: 'canvas',
        layers: [layer, vector],
        target: 'map',
        view: new ol.View({
          center: center,
          zoom: 2.2
        })
      });

      function pointContent(feature) {
        var content = $('#point').html();
        var keys = ['creaturename', 'description', 'latitude', 'longitude', 'countryName', 'source']; //data to be used
        for(var i = 0; i<keys.length; i++){
          var key = keys[i];
          var value = feature.get(key);
          content = content.replace('{'+key+'}', value);
        }
        return content;
      }

      var select = new ol.interaction.Select({
        layers : [vector],
        style : selectedStyle
      });

      map.addInteraction(select);

      var selectedFeatures = select.getFeatures();

      selectedFeatures.on('add', function(event){
        var feature = event.target.item(0);
        var content = pointContent(feature);
        $('#point-info').html(content);
      });

      selectedFeatures.on('remove', function(event) {
        $('#point-info').empty();
      });

      function successHandler(data){
        var transform = ol.proj.getTransform('EPSG:4326', 'EPSG:3857');
        for(var i =0;i < data.length;i++){
            var item = data[i];
            var feature = new ol.Feature(item);
            feature.set('url', item.icon);
            var coordinate = transform([parseFloat(item.longitude), parseFloat(item.latitude)]);
            var geometry = new ol.geom.Point(coordinate);
            feature.setGeometry(geometry);
            deviceSource.addFeature(feature);
          }
      }

      $.ajax({
        type: "POST",
        url: 'CreatureSelection.php',
        dataType: 'json',
        success: successHandler,
      });

    </script>
    <script>
    $(document).on('click', "#logoutButton", function(){
      alert("You have succesfully logged out!");

    });
    </script>
    <script type = "text/html" id = "point">
      <b>Creatures: </b> </br>
          <ul>
          <b>Creature Name: </b> {creaturename} </br>
          <b>Description: </b> {description} </br>
          <b>Country Name: </b> {countryName} </br>
          <b>Source: </b> {source}</br>
    </script>
    <footer>
    <p>Property of Mythical Origins</p>
  </footer>
  </body>
</html>
