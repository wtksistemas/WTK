<?php

class Coche // la clase engloba las propiedades y metodos de los objetos
{

    // las propiedades que el objeto tendra por default 
    public $color;
    public $marca;
    public $potencia='300';
    public $descripcion_motor;


    public function GetColor() // El metodo es el "paso" con el cual podemos obtener o definir alguna propiedad con un valor
    {
        return $this->color; //Retornamos el valor de la propiedad color del objeto

    }
    public function getPotencia()
    {
        return $this->potencia;
    }
    public function getMarca()
    {
        return $this->marca;
    }


    public function elCocheElegidoEsMasRapido($cocheElegido)
    {
        return $cocheElegido->potencia > $this->potencia;
    }

    public function setPotencia($potencia)
    {
        if(!is_numeric($potencia)) // Verificamos que el campo ingresado sea un numero.
        {
            throw new \Exception('Potencia no válida: '. $potencia);
        }
        // Si $potencia no es un número, devolverá un error
        
        $this->potencia = $potencia;
    }



}

class coches_economicos extends Coche
{


}

class coches_lujo extends Coche
{
 public $motor_v12=true;

}





/* creacion de objeto tipo coche */
$coche_abraham=new Coche(); // para crear un objeto de un tipo debemos instanciar la clase: para este ejemplo creamos un objeto de tipo " coche ". 


/* Definimos los valores de las propiedades del objeto */
$coche_abraham->color='verde';
$coche_abraham->marca='audi';

/* Para imprimir alguna propiedad que ya hayamos definido */

echo "<br>Marca del coche: ".$coche_abraham->marca;

/// Hasta ahora hemos definido las propiedades de un objeto, pero podemos modificar el valor de alguna propiedad mediante metodos linea 11

// De la misma forma que la linea 32, podemos hacer uso de nuestros metodos para obtener o asignar un valor a una propiedad.

echo "<br>Color del coche: ".$coche_abraham->GetColor();

/* las propiedades de los objetos pueden tener valores previamente asignados linea 8, lo que hara al crear cualquier objeto de la clase
es asignarle el valor definido en la clase de forma automatica */




/* fuera de la clase, podemos crear funciones que nos ayuden a agrupar ciertos pasos que deseamos realizar.
Para este ejemplo se crea la funcion "printCaracteristicas" que ejecutara los metodos y obtendra todas las propiedades del obejto */
function printCaracteristicas($cocheConcreto)
    {   
        echo "<br> -----Impresion de la funcion ----";
        echo "<br>";
        echo 'Color: '. $cocheConcreto->getColor();
        echo "<br>";
        echo 'Potencia: '. $cocheConcreto->getPotencia();
        echo "<br>";
        echo 'Marca: '. $cocheConcreto->getMarca();
        echo '<br>';
    }

    $otroCoche = new Coche();
    $otroCoche->color = 'azul';
    $otroCoche->potencia = 100;
    $otroCoche->marca = 'bmw';


    printCaracteristicas($coche_abraham);
    echo "<br>";
    printCaracteristicas($otroCoche);



/* interaccion entre objetos 

vamos a generar un metodo que me permita saber que coche es mas potente  linea 25*/

if ($coche_abraham->elCocheElegidoEsMasRapido($otroCoche)) {
    echo '<br> El ' . $otroCoche->marca . ' es más rápido';
} else {
    echo '<br> El ' . $coche_abraham->marca . ' es más rápido';
}

/* podemos generar metodos que nos permitan alterar el valor de una propiedad  linea 31*/
$coche_abraham->setPotencia(600);

echo "Nueva potencia :" .$coche_abraham->getPotencia();





$coche_checo= new coches_economicos();

echo " La potencia del coche de checo es: ".$coche_checo->getPotencia();

?>