<?php
session_start();
include 'conexion.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $usuario=$_POST['usuario'];
    $contraseña=$_POST['contraseña'];

    $sql="SELECT * FROM usuarios WHERE usuario=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$usuario);
    $stmt->execute();
    $res=$stmt->get_result();

    if($res->num_rows==1){
        $fila=$res->fetch_assoc();
        if(password_verify($contraseña,$fila['contraseña'])){
            $_SESSION['usuario_id']=$fila['id'];
            $_SESSION['nombre']=$fila['nombre'];
            header("Location: entrada_salida.php");
            exit;
        } else {
            echo "<script>alert('Contraseña incorrecta');window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado');window.history.back();</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inicio de Sesión</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<style>
body{font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#4e8d7c,#a58f5c);margin:0;min-height:100vh;display:flex;flex-direction:column;}
header,footer{text-align:center;color:#fdf6e3;padding:10px;font-weight:600;text-shadow:1px 1px 2px rgba(0,0,0,0.3);}
.container{background:rgba(255,255,255,0.92);padding:40px 35px;border-radius:18px;box-shadow:0 8px 25px rgba(0,0,0,0.15);width:100%;max-width:400px;margin:30px auto;text-align:center;}
.logo{width:90px;margin-bottom:15px;}
h2{color:#145a32;margin-bottom:20px;font-weight:600;}
input{width:90%;padding:12px;margin:10px 0;border:1px solid #cfd8dc;border-radius:10px;outline:none;font-size:15px;background-color:#f7f9f9;transition:all 0.3s ease;}
input:focus{border-color:#b7950b;box-shadow:0 0 8px rgba(183,149,11,0.3);background-color:#ffffff;}
button{width:95%;padding:12px;margin-top:15px;background:linear-gradient(90deg,#1e8449,#27ae60);color:white;font-size:16px;border:none;border-radius:10px;cursor:pointer;font-weight:600;display:flex;align-items:center;justify-content:center;gap:8px;transition:all 0.3s ease;}
button:hover{transform:scale(1.04);background:linear-gradient(90deg,#239b56,#2ecc71);}
p{margin-top:20px;font-size:14px;color:#555;}
a{color:#b7950b;text-decoration:none;font-weight:500;}
a:hover{text-decoration:underline;}
</style>
</head>
<body>
<header>
  <img src="img/logo.png" class="logo" alt="Logo"><br>
  <span>Sistema de Asistencia</span>
</header>

<div class="container">
  <h2><i class="fa-solid fa-key"></i> Inicio de Sesión</h2>
  <form method="POST">
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="contraseña" placeholder="Contraseña" required><br>
    <button type="submit"><i class="fa-solid fa-right-to-bracket"></i> Ingresar</button>
  </form>
  <p>¿No tienes cuenta? <a href="registro.php"><i class="fa-solid fa-user-plus"></i> Regístrate aquí</a></p>
</div>
<footer>Universidad Autónoma del Estado de México 2025-2029</footer>
</body>
</html>
