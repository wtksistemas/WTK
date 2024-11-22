<?php
require '../../../vendor/autoload.php'; // cargamos clases de la libreria PDFParser

use Smalot\PdfParser\Parser;
use Ssch\PDFParser\PDFParser;

$tamaño_maximo=2*1024*1024; // declaramos el tamaño maximo de los archivos a cargar para este caso 2mb como maximo

//Obtenemos los datos del archivo cargado.. 
$nombre=$_FILES["constancia"]["name"];
$tipo_archivo=$_FILES['constancia']['type'];
$tamaño_archivo=$_FILES['constancia']['size'];
$error=$_FILES['constancia']['error'];
$tmp=$_FILES['constancia']['tmp_name'];
$tipo_mime = mime_content_type($_FILES['constancia']['tmp_name']);
// Revisamos que el archivo este correctamente cargado y guardamos las caracteristicas del mismo 

if(isset($_FILES['constancia']) && $tamaño_archivo<=$tamaño_maximo && $tipo_mime=='application/pdf')
{
   $parser = new \Smalot\PdfParser\Parser(); // creamos un objeto tipo parser
 // leemos el archivo y guardamos en la variable pdf
   $pdf= $parser->parseFile($tmp);   
// obtenemos el texto de la primer hoja del pdf leido y guardamos ese texto
    $texto_1=$pdf->getText(0);
// Separamos en un arreglo cada palabra, se hace la indicacion de separador con un '\n' representando un salto de linea
   $words=preg_split('/\n/', $texto_1);
// declaramos las variables de las palabras clave a buscar

   $regimen="Regímenes:  ";
   $bloque_domicilio="Datos del domicilio registrado ";
   $datos_generales="Datos de Identificación del Contribuyente: ";


//Declaramos las variables donde guardaremos los datos del formulario 
   $nombre_cliente="";
   $rfc_cliente="";
   $regimen_cliente="";
   $calle_cliente="";
   $cp_cliente="";
   $tipo_vialidad_cliente="";
   $nombre_vialidad_cliente="";
   $numero_ext_cliente="";
   $numero_int_cliente="";
   $colonia_cliente="";
   $localidad_cliente="";
   $municipio_cliente="";
   $entidad_cliente="";

//Guardamos el largo del arreglo para obtener el tope de palabras que se recorreran
   $j=count($words);

///////////////// LECTURA DE PDF POR FILA PARA OBTENER LOS DATOS DESEADOS DE LA CONSTANCIA  /////////////////


// variables para manipular los datos obtenidos de cada arreglo en el bloque de datos de identificacion del contribuyente
$datos_tmp="";
$datos_dr="";
$regimen_tmp="";

// En un arreglo buscamos el titulo del cuadro donde se ubican los datos de identificacion del contribuyente
   $posicion=0;
   for($i=0;$i<$j;$i++)
   {
      if($datos_generales==$words[$i]) // Si la palabra buscada es igual a el titulo del cuadro de los datos de identificacion del contribuyente... 
      {
          
          $posicion=$i;

         /// obtencion del campo rfc //// 

         //obtenemos la fila donde se ubica el rfc 
         $datos_tmp=$words[$posicion+1];

         // separamos la oracion por el delimitador ' : ' para separar las columnas en izquierda y derecha 
         $datos_tmp=preg_split('/:/',$datos_tmp);

         //obtenemos la columna del lado derecho (dato rfc)
         $datos_dr=$datos_tmp[1];
         $rfc_cliente=$datos_dr;

         //// obtencion del campo Razon Social ////

         //obtenemos la fila donde se ubica la razon social 
         $datos_tmp=$words[$posicion+2];

         // separamos la oracion por el delimitador ' : ' para separar las columnas en izquierda y derecha 
         $datos_tmp=preg_split('/:/',$datos_tmp);

         //obtenemos la columna del lado derecho (dato razon social)
         $datos_dr=$datos_tmp[1];
         $nombre_cliente=$datos_dr;

         break;
      }

   }

// En un arreglo buscamos el Rregimen fiscal del cliente
   $posicion=0;
   for($i=0;$i<$j;$i++)
   {
      if($regimen==$words[$i]) // Si la palabra buscada es igual a el titulo del cuadro de regimenes ... 
      {
         $posicion=$i;
         //Recorremos el arreglo a la fila deseada
         $regimen_tmp=$words[$posicion+2];
         // Separamos la fila en 2 columnas con el delimitador '\t' tabulador
         $regimen_tmp=preg_split('/\t/',$regimen_tmp);
         $regimen_cliente=$regimen_tmp[0];
         break;
      } 
   }


   ///// BLOQUE DE DOMICILIO //////

/* En las CFS la direccion se divide en 2 columnas, primero obtendremos la fila deseada, posteriormente la dividiremos en 2 columnas para obtener el dato deseado */

   $posicion=0;
   $domicilio_tmp="";
   $domicilio_iz="";
   $domicilio_dr="";
   $oracion_tmp="";
   $r=0;
   for($i=0;$i<$j;$i++)
   {
      if($bloque_domicilio==$words[$i]) // condicion para encontrar el titulo del bloque del domicilio registrado
      {
         $posicion=$i;

         //obtenemos la fila deseada donde se ubica el codigo postal
         $domicilio_tmp=$words[$posicion+1];
         // separamos la oracion por el elimitador '\t' tabulador para separar las columnas en izquierda y derecha 
         $domicilio_tmp=preg_split('/\t/',$domicilio_tmp);

         //obtenemos la columna del codigo postal (columna izquierda)
         $domicilio_iz=$domicilio_tmp[0];
         //obtenemos la columna del tipo de vialidad (columna derecha)
         $domicilio_dr=$domicilio_tmp[1];
         // separamos ambas columnas con el delimitador ' : ' para obetener el dato deseado
         $oracion_tmp=preg_split('/:/',$domicilio_iz);
         //obtenemos el codigo postal
         $cp_cliente=$oracion_tmp[1];
         //repetimos proceso para obtener el dato del lado derecho
         $oracion_tmp=preg_split('/:/',$domicilio_dr);
         //obtenemos el tipo de vialidad
         $tipo_vialidad_cliente=$oracion_tmp[1];

         
   //// repetimos el proceso que realizamos anteriormente para seguir obteniendo los datos de la tabla de la direccion del cliente

         //obtenemos la oracion deseada donde se ubica el nombre de la vialidad y el numero exterior
         $domicilio_tmp=$words[$posicion+2];

         // separamos la oracion por el elimitador '\t' tabulador para separar las columnas en izquierda y derecha 
         $domicilio_tmp=preg_split('/\t/',$domicilio_tmp);

         //obtenemos la oracion del nombre de vialidad (columna izquierda)
         $domicilio_iz=$domicilio_tmp[0];
         //obtenemos la oracion del numero exterior (columna derecha)
         $domicilio_dr=$domicilio_tmp[1];

         // separamos ambas oraciones con el delimitador ' : ' para obetener el dato deseado
         $oracion_tmp=preg_split('/:/',$domicilio_iz);
         //obtenemos el nombre de la vialidad
         $nombre_vialidad_cliente= $oracion_tmp[1];

         //repetimos proceso para obtener el dato del lado derecho numero exterior
         $oracion_tmp=preg_split('/:/',$domicilio_dr);
         //obtenemos el numero exterior
         $numero_ext_cliente=$oracion_tmp[1];


   //// repetimos el proceso que realizamos anteriormente para seguir obteniendo los datos de la tabla de la direccion del cliente

         //obtenemos la oracion deseada donde se ubica el numero interior y el nombre de la colonia
         $domicilio_tmp=$words[$posicion+3];

         //separamos la oracion por el elimitador '\t' tabulador para separar las columnas en izquierda y derecha 
         $domicilio_tmp=preg_split('/\t/',$domicilio_tmp);

         //obtenemos la oracion del nombre de vialidad (columna izquierda)
         $domicilio_iz=$domicilio_tmp[0];
         //obtenemos la oracion del numero exterior (columna derecha)
         $domicilio_dr=$domicilio_tmp[1];

         // separamos ambas oraciones con el delimitador ' : ' para obetener el dato deseado
         $oracion_tmp=preg_split('/:/',$domicilio_iz);
         //obtenemos el numero interior
         $numero_int_cliente= $oracion_tmp[1];

         //repetimos proceso para obtener el dato del lado derecho nombre de colonia
         $oracion_tmp=preg_split('/:/',$domicilio_dr);
         //obtenemos el nombre de la colonia
         $colonia_cliente=$oracion_tmp[1];

    //// repetimos el proceso que realizamos anteriormente para seguir obteniendo los datos de la tabla de la direccion del cliente

         //obtenemos la oracion deseada donde se ubica el la localidad y el nombre del municipio
         $domicilio_tmp=$words[$posicion+4];

         //separamos la oracion por el elimitador '\t' tabulador para separar las columnas en izquierda y derecha 
         $domicilio_tmp=preg_split('/\t/',$domicilio_tmp);


         // revisamos que esta fila contenta mas de 1 separacion ya que a veces hay campos vacios.
         $r=count($domicilio_tmp);
         if($r>1)
         {

         //obtenemos la oracion del nombre de la localidad (columna izquierda)
         $domicilio_iz=$domicilio_tmp[0];
         //obtenemos la oracion del municipio (columna derecha)
         $domicilio_dr=$domicilio_tmp[1];
         // separamos ambas oraciones con el delimitador ' : ' para obetener el dato deseado
         $oracion_tmp=preg_split('/:/',$domicilio_iz);
         //obtenemos la localidad del cliente
         $localidad_cliente= $oracion_tmp[1];

         //repetimos proceso para obtener el dato del lado derecho nombre de colonia
         $oracion_tmp=preg_split('/:/',$domicilio_dr);
         //obtenemos el nombre del municipio del cliente
         $municipio_cliente=$oracion_tmp[1];
         }
         else
         {
            $localidad_cliente="Dato no encontrado en la constancia";


            $domicilio_tmp=$words[$posicion+5];
            $oracion_tmp=preg_split('/:/',$domicilio_tmp);
            $municipio_cliente=$oracion_tmp[1];

         }
         

//// repetimos el proceso que realizamos anteriormente para seguir obteniendo los datos de la tabla de la direccion del cliente

         //obtenemos la oracion deseada donde se ubica la entidad federativa
            
            $domicilio_tmp=$words[$posicion+5];


         //separamos la oracion por el elimitador '\t' tabulador para separar las columnas en izquierda y derecha 
         $domicilio_tmp=preg_split('/\t/',$domicilio_tmp);

         //obtenemos la fila del nombre de la entidad federativa (columna izquierda)
         $domicilio_iz=$domicilio_tmp[0];
         
         // separamos ambas oraciones con el delimitador ' : ' para obetener el dato deseado
         $oracion_tmp=preg_split('/:/',$domicilio_iz);
         //obtenemos el numero interior
         $entidad_cliente= $oracion_tmp[1];

      }
      
   }





/* impresion de todo el arreglo con indice para ubicar las palabras
for($i=0;$i<$j;$i++)
{


  echo $i."  ".$words[$i]."<br>";

}

*/ 
echo "DATOS GENERALES DEL CLIENTE <br>";
echo "El nombre del clinete es: ".$nombre_cliente."<br>";
echo "El rfc del cliente es: ".$rfc_cliente."<br>"; 
echo "El regimen fiscal del cliente es: ".$regimen_cliente."<br><br><br>";
echo "BLOQUE DE DIRECCION DEL CLIENTE<br><br><br>";
echo "El codigo postal del cliente es: ".$cp_cliente."<br>";
echo "El tipo de vialidad del cliente es: ".$tipo_vialidad_cliente."<br>";
echo "El nombre de la vialidad del cliente es: ".$nombre_vialidad_cliente."<br>";
echo "El numero exterior del cliente es: ".$numero_ext_cliente."<br>";
echo "El numero interior del clinete es: ".$numero_int_cliente."<br>";
echo "La colonia del cliente es: ".$colonia_cliente."<br>";
echo "El nombre de la localidad es: ".$localidad_cliente."<br>";
echo "El nombre de la delegacion / municipio es: ".$municipio_cliente."<br>";
echo "El nombre de la entidad federativa es: ".$entidad_cliente."<br>";
}
else
{

   echo "invalido";
}




header("Location: ../altaclientes.php?nom=".$nombre_cliente."&rfc=".$rfc_cliente."&regimen=".$regimen_cliente."&calle=".$nombre_vialidad_cliente."&nexterior=".$numero_ext_cliente."&ninterior=".$numero_int_cliente."&cp=".$cp_cliente."");


function analizar_espacios($texto) {
   $tabuladores = 0;
   $otros_espacios = 0;

   for ($i = 0; $i < strlen($texto); $i++) {
       if ($texto[$i] === "\t") {
           $tabuladores++;
       } elseif (ctype_space($texto[$i])) {
           $otros_espacios++;
       }
   }

   echo "Tabulaciones: $tabuladores\n";
   echo "Otros espacios: $otros_espacios\n";
}

?>