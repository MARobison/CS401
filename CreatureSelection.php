<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
set_time_limit(0);
$link = mysqli_connect("127.0.0.1", "root", "", "cs401");

if(mysqli_connect_errno()){
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

mysqli_select_db($link, 'cs401');
  $result = mysqli_query($link, "SELECT creaturename, description, countryName, source, latitude, longitude FROM creatures;");
  $r = array();
  while($row = mysqli_fetch_assoc($result)){
    $r[] = $row;
  }


//Use this to modify what icon will be used
//Will be modified later

for($i = 0; $i < sizeof($r); $i++){
    $r[$i]['icon'] = "pinpoint.png";
}

echo json_encode($r);


mysqli_close($link);
?>
