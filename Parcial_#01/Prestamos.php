<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/parcial.css">
	<title>Calculadora de préstamos</title>
</head>
<body class="row justify-content-center" style="background-color: #1B3FFF;">
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #141E4F;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="img/Universidad_don_bosco.jpg" alt="logo_udb" style="width: 50px;"></a>
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
<header class="col-sm-8 container">
	<div class="jumbotron">
		<h1 class="display-4 text-center">Calculadora de préstamos</h1>
	</div>
</header></div>
<div><br></div>
<form method="POST" action="CalculoP.php">
	<div class="col-sm-6 container">
	<div class="card" style="width: 45rem;">
		<div class="card-body">
		<h5 class="card-title">Seleccionar sistema</h5>
		<div class="row">
		<div class="col">
			<div class="form">
			  <select class="form-select" id="sistema" name="sistema" aria-label="Floating label select example">
			    <option value="simple" selected>Sistema simple: Cuota, amortización e interés fijo</option>
			    <option value="compuesto">Sistema compuesto: Interés sobre interés</option>
			  </select>
			</div>
		</div>
		</div><br>
		<h5 class="card-title">Fecha del desembolso</h5>
		<div class="row">
		  <div class="col">
		    <input class="form-control" type="date" value="2021-02-18" id="fecha" name="fecha">
		  </div>
		</div><br>
		<h5 class="card-title">Importe del préstamo</h5>
		<div class="row">
		<div class="col">
			<div class="form-floating mb-3">
			  <input type="numberOnly" class="form-control" id="prestamo" name="prestamo">
			  <label for="floatingInput">Cantidad del prestamo</label>
			</div>
		</div>
		</div>
		<h5 class="card-title">Periodo</h5>
		<div class="row">
		<div class="col">
			<div class="form">
			  <select class="form-select" id="periodo" name="periodo" aria-label="Floating label select example">
			    <option value="diario" selected>Diario</option>
			    <option value="semanal">Semanal</option>
			    <option value="quincenal">Quincenal</option>
			    <option value="mensual">Mensual</option>
			    <option value="anual">Anual</option>
			  </select>
			</div>
		</div>
		</div><br>
		<h5 class="card-title">Interés</h5>
		<div class="row">
		<div class="col">
			<div class="form-floating mb-3">
			  <input type="numberOnly" class="form-control" id="interes" name="interes">
			  <label for="floatingInput">Valor del interés</label>
			</div>
		</div>
		</div>
		<h5 class="card-title">Plazo</h5>
		<div class="row">
		<div class="col">
			<div class="form-floating mb-3">
			  <input type="numberOnly" class="form-control" id="plazo" name="plazo">
			  <label for="floatingInput">Valor del plazo</label>
			</div>
		</div>
		</div><br>
		<div class="row">
		<div class="col d-grid gap-2 col-6 mx-auto">
			<button value="Enviar" name="enviar" id="enviar" class="btn btn-outline-primary">Calcular</button>
		</div>
		</div><br>
		</div>
	</div>
</div>
<br><br>
</form>

<footer style="background-color: #22317D; color: white; font-family: Verdana;"><br><br>
	<div class="jumbotron text-center">
		<img src="img/Universidad_don_bosco.jpg" alt="logo_udb" style="width: 50px;"><br>
		<h6>Universidad Don Bosco - 2021</h6>
		<h6>Steven Alfonso Margueis Ramos - MR161348</h6><br><br>
	</div>
</footer>
</body>
</html>