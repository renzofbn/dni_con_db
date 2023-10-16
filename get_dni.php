<?php



$dni=$_POST['dni'];

if(!strlen($dni)== 8){
  echo 1;
}
else{
// PHP Data Objects(PDO) Sample Code:
  try {
    $conn = new PDO("sqlsrv:server = tcp:bdsenati23.database.windows.net,1433; Database = bdsenati2023", "adminsenati", "Virtual23");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
  }

  // SQL Server Extension Sample Code:
  $connectionInfo = array("UID" => "adminsenati", "pwd" => "Virtual23", "Database" => "bdsenati2023", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
  $serverName = "tcp:bdsenati23.database.windows.net,1433";
  $conn = sqlsrv_connect($serverName, $connectionInfo);

  $sql="SELECT * FROM usuarios WHERE dni='$dni'";
  
  $query=sqlsrv_query($conn,$sql);

  if($row = sqlsrv_fetch_array($query)){
    $data = array(
      'nombres' => $row['nombres'],
      'apellido_paterno' => $row['apellido_paterno'],
      'apellido_materno' => $row['apellido_materno'],
      'dni' => $row['dni'],
      'fecha_nacimiento' => $row['fecha_nacimiento'],
      'telefono' => $row['telefono'],
      'direccion' => $row['direccion'],
      'distrito' => $row['distrito'],
      'estado_civil' => $row['estado_civil'],
      'sexo' => $row['sexo'],
    );
    echo json_encode($data);
  }
  else{
    echo 1;
  }

  sqlsrv_close($conn);
}
?>