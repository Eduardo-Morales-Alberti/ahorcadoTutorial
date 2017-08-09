<?php
	include("ahorcadoClase.php");
	$palabras = array("gato","perro","aguila","mofeta");
	$pistas = array("gato"=>"animal con 7 vidas", 
		"perro" => "Mejor amigo del hombre", "aguila" => "Ave de la bandera americana",
		"mofeta" => "Animal que huele muy mal");

	

	/*print_r($_GET);*/

	session_start();


	if(!isset($_SESSION["ahorcado"])){
		$ahorcadocl = new Ahorcado($palabras, $pistas);
		$_SESSION["ahorcado"] = $ahorcadocl;
		$_SESSION["ahorcado"]->reset();
	}
	if(isset($_GET["nv"])){
		$_SESSION["ahorcado"]->reset();
	}
	
	if(isset($_GET["letra"]) && strlen($_GET["letra"])==1){
		$_SESSION["ahorcado"]->jugar($_GET["letra"]);
	}

	if(isset($_GET["reset"])){
		session_destroy();
	}

	
	



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Ahorcado</h1>
	<p>Palabra elegida: <?php echo $_SESSION["ahorcado"]->palabraElegida; ?></p>
	<p>Pista: <?php echo $_SESSION["ahorcado"]->getPista(); ?></p>
	<p>Intentos fallidos: <?php echo $_SESSION["ahorcado"]->getIntentos(); ?></p>
	<p>Letras Usadas: <?php  echo implode(", ",$_SESSION["ahorcado"]->getLetrasUsadas()); ?></p>
	<p>Palabra Pista: <?php echo implode(" ",$_SESSION["ahorcado"]->getPalabraPista()); ?></p>
	<p>Estado: <?php echo $_SESSION["ahorcado"]->getEstado(); ?></p>

	<form action="" method="get">
		<input type="text" name="letra">
		<input type="submit" value="Jugar">
		<input type="submit" name="reset" value="Limpiar sesion">
		<input type="submit" value="Nuevo Juego" name="nv">
	</form>
</body>
</html>