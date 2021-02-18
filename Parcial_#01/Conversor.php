<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/parcial.css">
	<title>Conversor de Divisas</title>
</head>
<body class="row justify-content-center" style="background-color: #1B3FFF;">
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #141E4F;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="img/Universidad_don_bosco.jpg" alt="logo_udb" style="width: 50px;"></a></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Conversor.php">Ejercicio_1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Prestamos.php">Ejercicio_2</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
	<div style="background-color: #22317D; color: white; font-family: Verdana;">
<header class="col-sm-6 container">
	<div class="jumbotron">
		<h1 class="display-4 text-center">Conversor de Divisas</h1>
	</div>
</header></div>
<div><br></div>
<form method="POST">
	<div class="col-sm-6 container">
	<div class="card" style="width: 45rem;">
		<div class="card-body">
		<h5 class="card-title">Seleccionar conversión</h5>
		<div class="row">
		<div class="col">
			<div class="form">
			  <select class="form-select" id="entrada" name="entrada" aria-label="Floating label select example">
			    <option selected>Seleccionar Moneda</option>
			    <option value="usde">USD/Dólar</option>
			    <option value="euroe">Euro</option>
			    <option value="yene">Yen Japonés</option>
			    <option value="librae">Libra Esterlina</option>
			  </select>
			</div>
		</div>
		<div class="col">
			<div class="form">
			  <select class="form-select" id="salida" name="salida" aria-label="Floating label select example">
			    <option selected>Seleccionar Moneda</option>
			    <option value="usds">USD/Dólar</option>
			    <option value="euros">Euro</option>
			    <option value="yens">Yen japonés</option>
			    <option value="libras">Libra Esterlina</option>
			  </select>
			</div>
		</div>
		</div><br>
		<h5 class="card-title">Ingresar dato</h5>
		<div class="row">
		<div class="col">
			<div class="form-floating mb-3">
			  <input type="numberOnly" class="form-control" id="cantidad" name="cantidad">
			  <label for="floatingInput">Cantidad</label>
			</div>
		</div>
		</div>
		<div class="row">
		<div class="col d-grid gap-2 col-6 mx-auto">
			<button value="Enviar" name="enviar" id="enviar" class="btn btn-outline-primary">Convertir</button>
		</div>
		</div><br>
			<?php
			if(isset($_POST['enviar'])){
				$entrada = $_POST['entrada'];
				$salida = $_POST['salida'];
				$cantidad = is_numeric($_POST['cantidad']) ? $_POST['cantidad'] : null;;
				if($entrada == "Seleccionar Moneda" || $salida == "Seleccionar Moneda"){
					echo "<div class=\"alert alert-warning\" role=\"alert\">";
					echo "No ingreso las monedas a convertir<br>";
					echo "</div>";
				}
				if($cantidad == "" || !is_numeric($_POST['cantidad'])){
					echo "<div class=\"alert alert-warning\" role=\"alert\">";
					echo "No ingreso la cantidad a convertir, el valor tiene que ser numérico<br>";
					echo "</div>";
				}
				if($entrada == $salida){
					echo "<div class=\"alert alert-warning\" role=\"alert\">";
					echo "Favor seleccionar monedas diferentes<br>";
					echo "</div>";
				}
				if($entrada == "usde" && $salida == "euros"){
					$conversor = 0.83 * $cantidad;
					echo "<h5 class=\"card-title text-center result\">$",$cantidad," = €",$conversor,"</h5>";
				}
				if($entrada == "usde" && $salida == "yens"){
					$conversor = 105.96 * $cantidad;
					echo "<h5 class=\"card-title text-center resultados\">$",$cantidad," = ¥",$conversor,"</h5>";
				}
				if($entrada == "usde" && $salida == "libras"){
					$conversor = 0.72 * $cantidad;
					echo "<h5 class=\"card-title text-center resultados\">$",$cantidad," = £",$conversor,"</h5>";
				}
				if($entrada == "euroe" && $salida == "usds"){
					$conversor = 1.21 * $cantidad;
					echo "<h5 class=\"card-title text-center resultados\">€",$cantidad," = $",$conversor,"</h5>";
				}
				if($entrada == "euroe" && $salida == "yens"){
					$conversor = 128.15 * $cantidad;
					echo "<h5 class=\"card-title text-center resultados\">€",$cantidad," = ¥",$conversor,"</h5>";
				}
				if($entrada == "euroe" && $salida == "libras"){
					$conversor = 0.87 * $cantidad;
					echo "<h5 class=\"card-title text-center resultados\">€",$cantidad," = £",$conversor,"</h5>";
				}
				if($entrada == "yene" && $salida == "usds"){
					$conversor = 0.0094 * $cantidad;
					echo "<h5 class=\"card-title text-center resultados\">¥",$cantidad," = $",$conversor,"</h5>";
				}
				if($entrada == "yene" && $salida == "euros"){
					$conversor = 0.0078 * $cantidad;
					echo "<h5 class=\"card-title text-center resultados\">¥",$cantidad," = €",$conversor,"</h5>";
				}
				if($entrada == "yene" && $salida == "libras"){
					$conversor = 0.0068 * $cantidad;
					echo "<h5 class=\"card-title text-center resultados\">¥",$cantidad," = £",$conversor,"</h5>";
				}
				if($entrada == "librae" && $salida == "usds"){
					$conversor = 1.39 * $cantidad;
					echo "<h5 class=\"card-title text-center resultados\">£",$cantidad," = $",$conversor,"</h5>";
				}
				if($entrada == "librae" && $salida == "euros"){
					$conversor = 1.15 * $cantidad;
					echo "<h5 class=\"card-title text-center resultados\">£",$cantidad," = €",$conversor,"</h5>";
				}
				if($entrada == "librae" && $salida == "yens"){
					$conversor = 147.09 * $cantidad;
					echo "<h5 class=\"card-title text-center resultados\">£",$cantidad," = ¥",$conversor,"</h5>";
				}
			}
			?>

		</div>
	</div>
</div>
<br><br><br><br>
</form>

<footer style="background-color: #22317D; color: white; font-family: Verdana;"><br><br>
	<div class="jumbotron text-center">
		<img src="img/Universidad_don_bosco.jpg" alt="logo_udb" style="width: 50px;">
		<h6>Universidad Don Bosco - 2021</h6>
		<h6>Steven Alfonso Margueis Ramos - MR161348</h6><br><br>
	</div>
</footer>

</body>
</html>