<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Asistencia Salas de Cómputo</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<style>
body{font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#4e8d7c,#a58f5c);margin:0;min-height:100vh;display:flex;flex-direction:column;}
header{padding:18px;text-align:center;color:#fdf6e3;font-weight:600;text-shadow:1px 1px 2px rgba(0,0,0,0.3);}
.logo{width:80px;display:block;margin:8px auto 6px;}
.container{max-width:900px;margin:30px auto;background:rgba(255,255,255,0.92);border-radius:16px;padding:28px;box-shadow:0 10px 30px rgba(0,0,0,0.15);text-align:center}
.buttons{display:flex;gap:14px;justify-content:center;flex-wrap:wrap;margin-top:16px}
.btn{padding:12px 22px;border-radius:12px;text-decoration:none;color:white;font-weight:600;box-shadow:0 6px 18px rgba(0,0,0,0.12);transition:transform .18s,box-shadow .18s; display:flex; align-items:center; gap:8px;}
.btn:active{transform:scale(.98)}
.primary{background:linear-gradient(90deg,#1e8449,#27ae60)}
.secondary{background:linear-gradient(90deg,#b7950b,#9a7d0a)}
footer{text-align:center;color:#fdf6e3;padding:12px;margin-top:auto;font-weight:600;text-shadow:1px 1px 2px rgba(0,0,0,0.25)}
</style>
</head>
<body>
<header>
  <img src="img/logo.png" alt="Logo" class="logo">
  <div>Sistema de Asistencia</div>
</header>

<main class="container">
  <h1>Asistencia Salas de Cómputo</h1>
  <p>Gestiona la asistencia de alumnos en las salas de cómputo de manera rápida y eficiente.</p>

  <div class="buttons">
    <a class="btn primary" href="registro.php"><i class="fa-solid fa-user-plus"></i> Registrarse</a>
    <a class="btn secondary" href="login.php"><i class="fa-solid fa-key"></i> Iniciar Sesión</a>
  </div>
</main>

<footer>Universidad Autónoma del Estado de México 2025-2029</footer>
</body>
</html>
