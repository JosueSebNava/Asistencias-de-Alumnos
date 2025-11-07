<?php
session_start();
include 'conexion.php';

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit;
}
$usuario_id = $_SESSION['usuario_id'];

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $tipo=$_POST['tipo'];
    $sala=$_POST['sala'];
    $fecha=date('Y-m-d');
    $hora=date('H:i:s');

    if($tipo=='entrada'){
        $sql="INSERT INTO registros (usuario_id,sala,tipo,fechaEntrada,horaEntrada) VALUES (?,?,?,?,?)";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("issss",$usuario_id,$sala,$tipo,$fecha,$hora);
        $stmt->execute();
    } elseif($tipo=='salida'){
        $sql="SELECT * FROM registros WHERE usuario_id=? AND sala=? AND tipo='entrada' AND horaSalida IS NULL ORDER BY id DESC LIMIT 1";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("is",$usuario_id,$sala);
        $stmt->execute();
        $res=$stmt->get_result();
        if($res->num_rows>0){
            $fila=$res->fetch_assoc();
            $id_reg=$fila['id'];
            $sql2="UPDATE registros SET tipo='entrada/salida',fechaSalida=?,horaSalida=? WHERE id=?";
            $stmt2=$conn->prepare($sql2);
            $stmt2->bind_param("ssi",$fecha,$hora,$id_reg);
            $stmt2->execute();
        } else {
            echo "<script>alert('No hay entrada registrada');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro de Entrada y Salida</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<style>
body{font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#4e8d7c,#a58f5c);margin:0;display:flex;flex-direction:column;min-height:100vh;}
header,footer{text-align:center;color:#fdf6e3;padding:10px;font-weight:600;text-shadow:1px 1px 2px rgba(0,0,0,0.3);}
.container{background:rgba(255,255,255,0.92);padding:40px 35px;border-radius:18px;box-shadow:0 8px 25px rgba(0,0,0,0.15);width:100%;max-width:500px;margin:30px auto;text-align:center;}
.logo{width:90px;margin-bottom:15px;}
h2{color:#145a32;margin-bottom:20px;font-weight:600;}
select{width:90%;padding:12px;border:1px solid #cfd8dc;border-radius:10px;font-size:15px;outline:none;background-color:#f7f9f9;transition:all 0.3s ease;}
select:focus{border-color:#b7950b;box-shadow:0 0 8px rgba(183,149,11,0.3);background-color:#ffffff;}
.buttons{margin-top:20px;display:flex;flex-direction:column;gap:15px;align-items:center;}
button{width:90%;padding:12px;border:none;border-radius:10px;font-size:16px;font-weight:600;color:white;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all 0.3s ease;}
.entrada{background:linear-gradient(90deg,#1e8449,#27ae60);}
.salida{background:linear-gradient(90deg,#b7950b,#9a7d0a);}
.logout{background:linear-gradient(90deg,#2e8b57,#b7950b);}
.registro{margin-top:25px;text-align:left;background-color:#f8f9f9;border-radius:12px;padding:15px;max-height:300px;overflow-y:auto;box-shadow:inset 0 2px 6px rgba(0,0,0,0.1);}
.registro h3{margin:0 0 10px;text-align:center;color:#145a32;}
.item{background:white;border-radius:8px;margin-bottom:10px;padding:10px;border-left:5px solid #b7950b;font-size:14px;color:#2d3436;box-shadow:0 2px 5px rgba(0,0,0,0.1);}
</style>
</head>
<body>
<header>
  <img src="img/logo.png" class="logo" alt="Logo"><br>
  <span>Sistema de Asistencia</span>
</header>

<div class="container">
  <h2><i class="fa-solid fa-clock"></i> Registro de Entrada y Salida</h2>
  <form method="POST">
    <select name="sala" required>
      <option value="">Selecciona una sala</option>
      <option value="Sala de Cómputo">Sala de Cómputo</option>
      <option value="Sala de Redes">Sala de Redes</option>
      <option value="Sala de Hombre-Máquina">Sala de Hombre-Máquina</option>
    </select><br>
    <div class="buttons">
      <button name="tipo" value="entrada" class="entrada"><i class="fa-solid fa-sign-in"></i> Registrar Entrada</button>
      <button name="tipo" value="salida" class="salida"><i class="fa-solid fa-sign-out"></i> Registrar Salida</button>
      <a href="logout.php" class="logout" style="text-decoration:none;padding:12px;width:90%;display:flex;justify-content:center;gap:8px;border-radius:10px;color:white;"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
    </div>
  </form>

  <div class="registro">
    <h3>Movimientos Registrados</h3>
    <?php
    $sql="SELECT * FROM registros WHERE usuario_id=? ORDER BY id DESC";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("i",$usuario_id);
    $stmt->execute();
    $res=$stmt->get_result();
    while($fila=$res->fetch_assoc()){
        echo "<div class='item'>
        <strong>{$fila['tipo']}</strong><br>
        Sala: {$fila['sala']}<br>
        Entrada: {$fila['fechaEntrada']} {$fila['horaEntrada']}<br>".
        ($fila['horaSalida'] ? "Salida: {$fila['fechaSalida']} {$fila['horaSalida']}" : "").
        "</div>";
    }
    ?>
  </div>
</div>

<footer>Universidad Autónoma del Estado de México 2025-2029</footer>
</body>
</html>
