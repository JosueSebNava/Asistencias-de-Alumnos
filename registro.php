<?php
include 'conexion.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nombre=$_POST['nombre'];
    $correo=$_POST['correo'];
    $grupo=$_POST['grupo'];
    $licenciatura=$_POST['licenciatura'];
    $num_cuenta=$_POST['num_cuenta'];
    $usuario=$_POST['usuario'];
    $contraseña=password_hash($_POST['contraseña'],PASSWORD_DEFAULT);

    $sql="INSERT INTO usuarios (nombre, correo, grupo, licenciatura, num_cuenta, usuario, contraseña)
          VALUES (?,?,?,?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sssssss",$nombre,$correo,$grupo,$licenciatura,$num_cuenta,$usuario,$contraseña);
    if($stmt->execute()){
        echo "<script>alert('Registro exitoso');window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: Usuario ya existe');window.history.back();</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro de Alumno</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<style>
body{font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#4e8d7c,#a58f5c);margin:0;min-height:100vh;display:flex;flex-direction:column;}
header,footer{text-align:center;color:#fdf6e3;padding:10px;font-weight:600;text-shadow:1px 1px 2px rgba(0,0,0,0.3);}
.container{background:rgba(255,255,255,0.92);padding:40px 35px;border-radius:18px;box-shadow:0 8px 25px rgba(0,0,0,0.15);width:100%;max-width:420px;margin:30px auto;text-align:center;}
.logo{width:90px;margin-bottom:15px;}
h2{color:#145a32;margin-bottom:20px;font-weight:600;}
input,select{width:90%;padding:12px;margin:10px 0;border:1px solid #cfd8dc;border-radius:10px;outline:none;font-size:15px;background-color:#f7f9f9;transition:all 0.3s ease;}
input:focus,select:focus{border-color:#b7950b;box-shadow:0 0 8px rgba(183,149,11,0.3);background-color:#ffffff;}
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
  <h2><i class="fa-solid fa-user-plus"></i> Registro de Alumno</h2>
  <form method="POST">
    <input type="text" name="nombre" placeholder="Nombre del alumno" required><br>
    <input type="email" name="correo" placeholder="Correo electrónico" required><br>
    <input type="text" name="grupo" placeholder="Grupo" required><br>
    <select name="licenciatura" required>
      <option value="">Selecciona tu licenciatura</option>
      <option value="Administración">Administración</option>
      <option value="Contaduría">Contaduría</option>
      <option value="Derecho">Derecho</option>
      <option value="Psicología">Psicología</option>
      <option value="Informática Administrativa">Informática Administrativa</option>
      <option value="Ingeniería en Computación">Ingeniería en Computación</option>
    </select><br>
    <input type="number" name="num_cuenta" placeholder="Número de cuenta" required><br>
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="contraseña" placeholder="Contraseña" required><br>
    <button type="submit"><i class="fa-solid fa-floppy-disk"></i> Registrar</button>
  </form>
  <p>¿Ya tienes una cuenta? <a href="login.php"><i class="fa-solid fa-key"></i> Inicia sesión</a></p>
</div>
<footer>Universidad Autónoma del Estado de México 2025-2029</footer>
</body>
</html>
