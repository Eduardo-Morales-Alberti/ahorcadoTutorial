<?php 

Class Ahorcado{
	private $palabras = array();
	private $pistasPalabras = array();
	private $intentos = 0;
	private $letrasUsadas = array();
	public $palabraElegida;
	private $palabraPista = array();

	/* estado 1(letra acertada), estado 2 (fallo), estado 3 (win), estado 4 (game over), estado 5 (nuevo juego)*/
	private $estado;

	function __construct($palabras, $pistas){
		$this->palabras = $palabras;
		$this->pistasPalabras = $pistas;
		$this->estado = 5;		

	}

	function getIntentos(){
		return $this->intentos;
	}
	function getLetrasUsadas(){
		return $this->letrasUsadas;

	}

	function getPalabraPista(){
		return $this->palabraPista;
	}

	function getEstado(){
		return $this->estado;
	}	

	function getPista(){
		return $this->pistasPalabras[$this->palabraElegida];
	}

	function jugar($letra){
		/* Si es un caracter válido*/
		if(strlen($letra) == 1 && preg_match('/\b[a-zA-Z0-9]{1}\b/', $letra)){

			/* Si el estado es 3 (ganar), 4 (perder), 5 (nuevo juego)*/
			if($this->estado >= 3){
				$this->reset();

			}

			/* Si la letra no está en letras usadas entonces añadirla*/
			if(in_array($letra, $this->letrasUsadas) === false){
				array_push($this->letrasUsadas, $letra);


				/* Si no está la letra $letra en la palabra elegida entonces*/
				if(strpos($this->palabraElegida,$letra) === false){
					/*echo "No esta la letra ".$letra;*/
					/* intentos se incrementa y estado pasa a 2 (fallo letra)*/
					$this->intentos++;
					$this->estado = 2;

					if($this->intentos == 8){
						$this->estado = 4;
					}
				}else{

					/* letra acertada estado 1*/
					$this->estado = 1;

					for ($i=0; $i < strlen($this->palabraElegida); $i++) { 
						if(substr($this->palabraElegida, $i,1) == $letra){
							$this->palabraPista[$i] = $letra;
						}					
					}

					if($this->palabraElegida == implode("", $this->palabraPista)){
						$this->estado = 3;
					}


				}

			}



		}
	}

	function reset(){
		$this->intentos = 0;
		$this->palabraPista = array();
		$this->letrasUsadas = array();
		$this->estado = 5;	
		$longitud = count($this->palabras);
		$this->palabraElegida = $this->palabras[mt_rand(0,$longitud-1)];
		
		for ($i=0; $i < strlen($this->palabraElegida); $i++) { 
			$this->palabraPista[$i] = "_";
		}
	}

}

?>

