<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/parcial.css">
	<title>Tabla de amortización</title>
</head>
<body class="resultados">

<div class="container"><br>
<?php
if(isset($_POST['enviar'])):
	//Captura de datos
	$fecha = $_POST['fecha'];
	$sistema = $_POST['sistema'];
	$prestamo = is_numeric($_POST['prestamo']) ? $_POST['prestamo'] : null;
	$interes = is_numeric($_POST['interes']) ? $_POST['interes'] : null;
	$periodo = $_POST['periodo']; 
	$plazo = is_numeric($_POST['plazo']) ? $_POST['plazo'] : null;

	//Validaciones
	if($prestamo == "" || $interes == ""|| $plazo == "" || !is_numeric($prestamo) || !is_numeric($interes) || !is_numeric($plazo)):
		echo "<div class=\"alert alert-warning\" role=\"alert\">";
		echo "No ingreso valores numéricos en los campos necesarios<br>";
		echo "<p><a href=\"Prestamos.php\" >Volver a intentarlo</a>";
		echo "</div>";
	else:	

	if($sistema == "simple"){
		echo "<div class=\"col-sm-6 container\">";
		echo "<div class=\"card\" style =\"width: 45rem;\">\n";
		echo "\t<div class=\"card-body\">\n";
		echo "\t\t<h5 class=\"card-title\">Resumen</h5>\n";
		echo "\t\t\t<div class=\"row\">\n";
		echo "\t\t\t\t<div class=\"col\">\n";
		echo "Fecha del prestamo: ",$fecha;
		echo "<br> Sistema: ",$sistema;
		echo "<br>Monto: ",$prestamo;
		echo "<br>Interés: ", $interes;
		echo "<br>Periodo: ",$periodo;
		echo "<br>Plazo: ",$plazo;
		echo "\t\t\t\t</div>";
		echo "\t\t\t</div>\n";
		echo "\t</div>";
		echo "</div>";
		echo "</div>";
		echo "<br>";

		$Vf = $prestamo * (1 + ($interes/100 * $plazo));
		$cuota = $Vf / $plazo;
		$capital = $cuota - ($prestamo * ($interes/100));
		$interess = $prestamo * ($interes/100);
		$cont = 0;
		$va = $prestamo;
		$saldo = $prestamo - $capital;

		//Tabla de resultados
		if($periodo == "diario"){

			echo "<table class=\"table table-bordered table-responsive\">\n";
			echo "\t<tr class=\"table-dark\">\n\t\t<th style=\"text-align: center;\">\n\t\t\tFecha\n\t\t</th>\n\t\n\t\t<th style=\"text-align: center;\">\n\t\t\tCuota\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tCapital\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tInteres\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tSaldo\n\t\t</th>\n\t</tr>\n";
			for($i = 1; $i <= $plazo; $i++){				
				echo "\t<tr>\n\t\t<td style=\"text-align: right;\">\n\t\t\t",date("Y/m/d", strtotime($fecha . " + " . $i . " days")),"\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($cuota, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($capital, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($interess, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($saldo, 2, "." , ",")."\n\t\t</td>\n\t\t\t</tr>\n";
				$saldo = $saldo - $capital;
				
			}
			echo "</table>\n</div>\n";
			echo "<div class=\"row\">\n";
			echo "\t<div class=\"col d-grid gap-2 col-6 mx-auto\">\n";
			echo "\t<a href=\"Prestamos.php\" role=\"button\" class=\"btn btn-primary\">Calcular otro préstamo</a>\n";
			echo "</div>";
		}
		if($periodo == "semanal"){
			echo "<table class=\"table table-bordered table-responsive\">\n";
			echo "\t<tr class=\"table-dark\">\n\t\t<th style=\"text-align: center;\">\n\t\t\tFecha\n\t\t</th>\n\t\n\t\t<th style=\"text-align: center;\">\n\t\t\tCuota\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tCapital\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tInteres\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tSaldo\n\t\t</th>\n\t</tr>\n";
			for($i = 1; $i <= $plazo; $i++){
				$tasa = $prestamo * ($interes/100);
				$saldo = $va + $tasa - $cuota;
				echo "\t<tr>\n\t\t<td style=\"text-align: right;\">\n\t\t\t",date("Y/m/d", strtotime($fecha . " + " . $i . " week")),"\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($cuota, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($capital, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($interess, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($saldo, 2, "." , ",")."\n\t\t</td>\n\t\t\t</tr>\n";
				$va = $saldo;
			}
			echo "</table>\n</div>\n";
			echo "<div class=\"row\">\n";
			echo "\t<div class=\"col d-grid gap-2 col-6 mx-auto\">\n";
			echo "\t<a href=\"Prestamos.php\" role=\"button\" class=\"btn btn-primary\">Calcular otro préstamo</a>\n";
			echo "</div>";
		}
		if($periodo == "quincenal"){
			echo "<table class=\"table table-bordered table-responsive\">\n";
			echo "\t<tr class=\"table-dark\">\n\t\t<th style=\"text-align: center;\">\n\t\t\tFecha\n\t\t</th>\n\t\n\t\t<th style=\"text-align: center;\">\n\t\t\tCuota\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tCapital\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tInteres\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tSaldo\n\t\t</th>\n\t</tr>\n";
			for($i = 1; $i <= $plazo; $i++){
				$tasa = $prestamo * ($interes/100);
				$saldo = $va + $tasa - $cuota;
				echo "\t<tr>\n\t\t<td style=\"text-align: right;\">\n\t\t\t",date("Y/m/d", strtotime($fecha . " + " . (15*$i) . " days")),"\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($cuota, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($capital, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($interess, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($saldo, 2, "." , ",")."\n\t\t</td>\n\t\t\t</tr>\n";
				$va = $saldo;
			}
			echo "</table>\n</div>\n";
			echo "<div class=\"row\">\n";
			echo "\t<div class=\"col d-grid gap-2 col-6 mx-auto\">\n";
			echo "\t<a href=\"Prestamos.php\" role=\"button\" class=\"btn btn-primary\">Calcular otro préstamo</a>\n";
			echo "</div>";
		}
		if($periodo == "mensual"){
			echo "<table class=\"table table-bordered table-responsive\">\n";
			echo "\t<tr class=\"table-dark\">\n\t\t<th style=\"text-align: center;\">\n\t\t\tFecha\n\t\t</th>\n\t\n\t\t<th style=\"text-align: center;\">\n\t\t\tCuota\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tCapital\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tInteres\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tSaldo\n\t\t</th>\n\t</tr>\n";
			for($i = 1; $i <= $plazo; $i++){
				$tasa = $prestamo * ($interes/100);
				$saldo = $va + $tasa - $cuota;
				echo "\t<tr>\n\t\t<td style=\"text-align: right;\">\n\t\t\t",date("Y/m/d", strtotime($fecha . " + " . $i . " month")),"\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($cuota, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($capital, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($tasa, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($saldo, 2, "." , ",")."\n\t\t</td>\n\t\t\t</tr>\n";
				$va = $saldo;
			}
			echo "</table>\n</div>\n";
			echo "<div class=\"row\">\n";
			echo "\t<div class=\"col d-grid gap-2 col-6 mx-auto\">\n";
			echo "\t<a href=\"Prestamos.php\" role=\"button\" class=\"btn btn-primary\">Calcular otro préstamo</a>\n";
			echo "</div>";
		}
		if($periodo == "anual"){
			echo "<table class=\"table table-bordered table-responsive\">\n";
			echo "\t<tr class=\"table-dark\">\n\t\t<th style=\"text-align: center;\">\n\t\t\tFecha\n\t\t</th>\n\t\n\t\t<th style=\"text-align: center;\">\n\t\t\tCuota\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tCapital\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tInteres\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tSaldo\n\t\t</th>\n\t</tr>\n";
			for($i = 1; $i <= $plazo; $i++){
				$tasa = $prestamo * ($interes/100);
				$saldo = $va + $tasa - $cuota;
				echo "\t<tr>\n\t\t<td style=\"text-align: right;\">\n\t\t\t",date("Y/m/d", strtotime($fecha . " + " . $i . " year")),"\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($cuota, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($capital, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($interess, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($saldo, 2, "." , ",")."\n\t\t</td>\n\t\t\t</tr>\n";
				$va = $saldo;
			}
			echo "</table>\n</div>\n";
			echo "<div class=\"row\">\n";
			echo "\t<div class=\"col d-grid gap-2 col-6 mx-auto\">\n";
			echo "\t<a href=\"Prestamos.php\" role=\"button\" class=\"btn btn-primary\">Calcular otro préstamo</a>\n";
			echo "</div>";
		}
	}
	if ($sistema == "compuesto"){
		echo "<div class=\"col-sm-6 container\">";
		echo "<div class=\"card\" style =\"width: 45rem;\">\n";
		echo "\t<div class=\"card-body\">\n";
		echo "\t\t<h5 class=\"card-title\">Resumen</h5>\n";
		echo "\t\t\t<div class=\"row\">\n";
		echo "\t\t\t\t<div class=\"col\">\n";
		echo "Fecha del prestamo: ",$fecha;
		echo "<br> Sistema: ",$sistema;
		echo "<br>Monto: ",$prestamo;
		echo "<br>Interés: ", $interes;
		echo "<br>Periodo: ",$periodo;
		echo "<br>Plazo: ",$plazo;
		echo "\t\t\t\t</div>";
		echo "\t\t\t</div>\n";
		echo "\t</div>";
		echo "</div>";
		echo "</div>";
		echo "<br>";
		

		$fy = ($interes/100) + 1;
		$fx = pow($fy, $plazo);
		$cuota = $prestamo * ((($interes/100) * $fx)/($fx - 1));
		$capital = $cuota - ($prestamo * ($interes/100));
		$interess = $prestamo * ($interes/100);
		$amortizacion = $cuota - $interess;
		$saldo = $prestamo - $amortizacion;

		//Tabla de resultados
		if($periodo == "diario"){
			echo "<table class=\"table table-bordered table-responsive resultados\">\n";
			echo "\t<tr class=\"table-dark\">\n\t\t<th style=\"text-align: center;\">\n\t\t\tFecha\n\t\t</th>\n\t\n\t\t<th style=\"text-align: center;\">\n\t\t\tCuota\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tCapital\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tInteres\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tSaldo\n\t\t</th>\n\t</tr>\n";
			for($i = 1; $i <= $plazo; $i++){
				echo "\t<tr>\n\t\t<td style=\"text-align: right;\">\n\t\t\t",date("Y/m/d", strtotime($fecha . " + " . $i . " days")),"\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($cuota, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($amortizacion, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($interess, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($saldo, 2, "." , ",")."\n\t\t</td>\n\t\t";
				$interess = $saldo * ($interes/100);	
				$amortizacion = $cuota - $interess;
				$saldo = $saldo - $amortizacion;				
				
			}
			echo "</table>\n</div>\n";
			echo "<div class=\"row\">\n";
			echo "\t<div class=\"col d-grid gap-2 col-6 mx-auto\">\n";
			echo "\t<a href=\"Prestamos.php\" role=\"button\" class=\"btn btn-primary\">Calcular otro préstamo</a>\n";
			echo "</div>";
		}
		if($periodo == "semanal"){
			echo "<table class=\"table table-bordered table-responsive\">\n";
			echo "\t<tr class=\"table-dark\">\n\t\t<th style=\"text-align: center;\">\n\t\t\tFecha\n\t\t</th>\n\t\n\t\t<th style=\"text-align: center;\">\n\t\t\tCuota\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tCapital\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tInteres\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tSaldo\n\t\t</th>\n\t</tr>\n";
			for($i = 1; $i <= $plazo; $i++){
				echo "\t<tr>\n\t\t<td style=\"text-align: right;\">\n\t\t\t",date("Y/m/d", strtotime($fecha . " + " . $i . " week")),"\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($cuota, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($capital, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($interess, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($saldo, 2, "." , ",")."\n\t\t</td>\n\t\t\t</tr>\n";
				$interess = $saldo * ($interes/100);	
				$amortizacion = $cuota - $interess;
				$saldo = $saldo - $amortizacion;
			}
			echo "</table>\n</div>\n";
			echo "<div class=\"row\">\n";
			echo "\t<div class=\"col d-grid gap-2 col-6 mx-auto\">\n";
			echo "\t<a href=\"Prestamos.php\" role=\"button\" class=\"btn btn-primary\">Calcular otro préstamo</a>\n";
			echo "</div>";
		}
		if($periodo == "quincenal"){
			echo "<table class=\"table table-bordered table-responsive\">\n";
			echo "\t<tr class=\"table-dark\">\n\t\t<th style=\"text-align: center;\">\n\t\t\tFecha\n\t\t</th>\n\t\n\t\t<th style=\"text-align: center;\">\n\t\t\tCuota\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tCapital\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tInteres\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tSaldo\n\t\t</th>\n\t</tr>\n";
			for($i = 1; $i <= $plazo; $i++){
				echo "\t<tr>\n\t\t<td style=\"text-align: right;\">\n\t\t\t",date("Y/m/d", strtotime($fecha . " + " . (2*$i) . " week")),"\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($cuota, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($capital, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($interess, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($saldo, 2, "." , ",")."\n\t\t</td>\n\t\t\t</tr>\n";
				$interess = $saldo * ($interes/100);	
				$amortizacion = $cuota - $interess;
				$saldo = $saldo - $amortizacion;
			}
			echo "</table>\n</div>\n";
			echo "<div class=\"row\">\n";
			echo "\t<div class=\"col d-grid gap-2 col-6 mx-auto\">\n";
			echo "\t<a href=\"Prestamos.php\" role=\"button\" class=\"btn btn-primary\">Calcular otro préstamo</a>\n";
			echo "</div>";
		}
		if($periodo == "mensual"){
			echo "<table class=\"table table-bordered table-responsive\">\n";
			echo "\t<tr class=\"table-dark\">\n\t\t<th style=\"text-align: center;\">\n\t\t\tFecha\n\t\t</th>\n\t\n\t\t<th style=\"text-align: center;\">\n\t\t\tCuota\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tCapital\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tInteres\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tSaldo\n\t\t</th>\n\t</tr>\n";
			for($i = 1; $i <= $plazo; $i++){
				echo "\t<tr>\n\t\t<td style=\"text-align: right;\">\n\t\t\t",date("Y/m/d", strtotime($fecha . " + " . $i . " month")),"\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($cuota, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($capital, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($tasa, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($saldo, 2, "." , ",")."\n\t\t</td>\n\t\t\t</tr>\n";
				$interess = $saldo * ($interes/100);	
				$amortizacion = $cuota - $interess;
				$saldo = $saldo - $amortizacion;
			}
			echo "</table>\n</div>\n";
			echo "<div class=\"row\">\n";
			echo "\t<div class=\"col d-grid gap-2 col-6 mx-auto\">\n";
			echo "\t<a href=\"Prestamos.php\" role=\"button\" class=\"btn btn-primary\">Calcular otro préstamo</a>\n";
			echo "</div>";
		}
		if($periodo == "anual"){
			echo "<table class=\"table table-bordered table-responsive\">\n";
			echo "\t<tr class=\"table-dark\">\n\t\t<th style=\"text-align: center;\">\n\t\t\tFecha\n\t\t</th>\n\t\n\t\t<th style=\"text-align: center;\">\n\t\t\tCuota\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tCapital\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tInteres\n\t\t</th>\n\t\t<th style=\"text-align: center;\">\n\t\t\tSaldo\n\t\t</th>\n\t</tr>\n";
			for($i = 1; $i <= $plazo; $i++){
				echo "\t<tr>\n\t\t<td style=\"text-align: right;\">\n\t\t\t",date("Y/m/d", strtotime($fecha . " + " . $i . " year")),"\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($cuota, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($capital, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($interess, 2, "." , ",")."\n\t\t</td>\n\t\t<td style=\"text-align: right;\">\n\t\t\t".number_format($saldo, 2, "." , ",")."\n\t\t</td>\n\t\t\t</tr>\n";
				$interess = $saldo * ($interes/100);	
				$amortizacion = $cuota - $interess;
				$saldo = $saldo - $amortizacion;
			}
			echo "</table>\n</div>\n";
			echo "<div class=\"row resultados\">\n";
			echo "\t<div class=\"col d-grid gap-2 col-6 mx-auto\">\n";
			echo "\t<a href=\"Prestamos.php\" role=\"button\" class=\"btn btn-primary\">Calcular otro préstamo</a>\n";
			echo "</div>";
		}
	}
	endif;	
endif;
?>
</div>
<br><br>
<footer style="background-color: #22317D; color: white; font-family: Verdana;"><br><br>
	<div class="jumbotron text-center">
		<img src="img/Universidad_don_bosco.jpg" alt="logo_udb" style="width: 50px;">
		<h6>Universidad Don Bosco - 2021</h6>
		<h6>Steven Alfonso Margueis Ramos - MR161348</h6><br><br>
	</div>
</footer>
</body>
</html>