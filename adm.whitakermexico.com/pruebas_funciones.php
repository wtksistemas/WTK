<?php
 
 function bruto_neto($bruto)
 {



 echo "++++ INICIO ++++";

 // tablas de isr 

 // Tabla ISR mensual limite inferior
 $tablaMensual = [0.01, 746.05, 6332.06, 11128.02, 12935.83, 15487.72, 31236.50, 49233.01, 93993.91, 125325.21, 375975.62];

 // Tabla ISR mensual limite superior

$tablaMensualsup=[746.04,6332.05,11128.00,12935.8,15487.7,31236.5,49233.00,93993.9,125325,375976,10000000000];
  
 // Tabla ISR mensual Cuota fija
 $cuotaMensual = [ 0.00, 14.32, 371.83, 893.63, 1182.88, 1640.18, 5004.12, 9236.89, 22665.17, 32691.18, 117912.32];

 // Tabla ISR mensual excedente
 $porcMensual = [ 1.92, 6.40, 10.88, 16.00, 17.92, 21.36, 23.52, 30.00, 32.00, 34.00, 35.00];

 // Tabla subsidio mensual hasta ingresos de
 $ingSubMensual = [ 1768.96, 2653.38, 3472.84, 3537.87, 4446.15, 4717.18, 5335.42, 6224.67, 7113.90, 7382.33];
 
 // Tabla de subsidio ISR mensual - Cantidad de subsidio para el empleo
 $canSubMensual = [ 407.02, 406.83, 406.62, 392.77, 382.46, 354.23, 324.87, 294.63, 253.54, 217.61, 0.00];

 

// Tablas subsidio

$tablaSubsidioMensualinf = [0.01,1768.97,2653.39,3472.85,3537.88,44446.46,9081.01];
$tablaSubsidioMensualsup = [1768.96,2653.38,3472.84,3537.87,4446.15,9081,100000000000];
$subsidio=[407.02,406.83,406.62,392.77,382.46,390,0];



 /* Variables de usuario para calculo */
 
 
 setlocale(LC_MONETARY, 'en_US'); /* establecer formato de pesos */
 
 $salario=$bruto; //$_POST['salario'];
 $riesgo=0.500;  //$_POST['priesgo'];
 
 /*
 if(is_numeric($salario))
 { 
     if(is_numeric($riesgo))
     {
 
     }
     else
     {
 
     header("Location: ../nomina.php?v=23");
 
     }	
 }
 else
 {
 
     header("Location: ../nomina.php?v=23");
 
 }
 
 
 /* Variables Globales estaticas  */
 
 $fintegracion=1.0493; /* Factor de integracion para 2024 */
 $uma=108.57; /* Valor de UMA 2024 */
 $sbc=$salario*$fintegracion; /* Calculo de Salario base de Cotizacion mensual */
 $dias=30; /* Dias trabajados para calculo */
 $sdi=$sbc/$dias; /* Calculo de Salario diario integrado */
 $isn=3.00/100; /* Porcentaje de ISN CDMX */ 
 $tope_umas_imss=$uma*25;
 
 if($sdi>$tope_umas_imss)
 {
 $sdi=$tope_umas_imss;
 }
 else
 {
 
 
 }
 
 
 
 echo "Salario capturado: ".$salario."<br>";
 echo "Factor de integracion capturado: ".$fintegracion."<br>";
 echo "Prima de riesgo capturada: ".$riesgo."<br> <br> <br>";
 
 
 
 echo "SDI a considerar: ".$sdi."<br> <br> <br>";
 echo "el SBC a considerar".$sbc."<br> <br> <br>";
 
 
 
 /*porcentajes a aplicar cuotas imss*/
 
 $pocentaje_cuotafija=20.4/100;  /* cuota fija */ 
 
 $porcentajep_i_ex=1.10/100; /* excedente cuota fija patron */
 $porcentajee_i_ex=0.40/100; /* excedente cuota fija empleado */
 
 $porcentajep_i_pd=0.70/100; /* prestaciones en dinero patron*/
 $porcentajee_i_pd=0.25/100; /* prestaciones en dinero empleado*/
 
 $porcentajep_i_gm=1.05/100; /* gastos medicos para pensionados patron */
 $porcentajee_i_gm=0.375/100; /* gastos medicos para pensionados empleados */
 
 $porcentajep_i_rt=$riesgo/100; /* riesgo de trabajo */
 
 $porcentajep_i_iv=1.75/100; /* invalidez y vida patron */
 $porcentajee_i_iv=0.625/100; /* invalidez y vida empleado */
 
 $porcentajep_i_gg=1.00/100; /* guarderia */
 
 $porcentajep_i_re=2.00/100; /* retiro */
 
 $porcentajep_i_in=5.00/100; /* infonavit */ 
 
 
 $porccentajee_i_cv=1.125/100; /* cesentia y vejez */
 $porccentajep_i_cv=0;
 
 
 /* Calculo de ISR */
 
 // buscamos el salario ingresado en las tablas de isr dentro de los rangos de lim inf y lim sup
$i=0;
$limite_inferior=0;
$limite_superior=0;
$cuota_fija=0;
$porcentaje_sobreex=0;




 for($i=0;$i<=10;$i++)
 {

    if($salario>=$tablaMensual[$i] && $salario<= $tablaMensualsup[$i])
    {
        $limite_inferior=$tablaMensual[$i];
        $limite_superior=$tablaMensualsup[$i];
        $cuota_fija=$cuotaMensual[$i];
        $porcentaje_sobreex=$porcMensual[$i];
        break;


    }

 }

echo "Salario:".$salario."<br>";
echo "Limite inferior: ".$limite_inferior."<br>";
echo "Limite superior: ".$limite_superior."<br>";
echo "Cuota fija: ".$cuota_fija."<br>";
echo "Porcentaje: ".$porcentaje_sobreex."<br>";

// Buscamos el salario en la tabla de subsidio para determinar si es acreedor

$limite_inf_subsidio=0;
$limite_sup_subsidio=0;
$valor_subsidio=0;
$j=0;
for($j=0;$j<=6;$j++)
{

   if($salario<= $tablaSubsidioMensualsup[$j])
   {
       $limite_inf_subsidio=$tablaSubsidioMensualinf[$j];
       $limite_sup_subsidio=$tablaSubsidioMensualsup[$j];
       $valor_subsidio=$subsidio[$j];
       break;
   }

}

echo "Limite inferior de subsidio: ".$limite_inf_subsidio."<br>";
echo "Limite superior de subsidio: ".$limite_sup_subsidio."<br>";
echo "Valor de subsidio: ".$valor_subsidio."<br>";
 


//Se calcula el excedente, restanto el salario menos el limite inferior

$excedente=$salario-$limite_inferior;

echo "Excedente: ".$excedente."<br>";

//Se calcula el porentaje de excedente multiplicando el excedente anteriormente claculado por el % obtenido de la tabla de isr /100

$porcentaje_excedente=($excedente*$porcentaje_sobreex)/100;

echo "Porcentaje de excedente: ".$porcentaje_excedente."<br>";

// Se calcula la cuota fija sumando el porcentaje de excedente mas la cuota obtenida en la tabla de isr
$cuota_aplicada=$porcentaje_excedente+$cuota_fija;

echo "ISR a aplicar: ".$cuota_aplicada."<br>";
echo "Subsidio calculado: ".$valor_subsidio."<br>"; 

// finalmente se resta la cuota fija al salario

$isr=($salario-$cuota_aplicada)+$valor_subsidio;

echo "Salario neto: ".$isr."<br>";
  

  
     
/////* calculo de cuota imss */////
 
 
 
 /* Primer Bloque: Cuota Fija */
 
 $pro_i_cf=($dias*$uma)*$pocentaje_cuotafija; /* provision cuota fija */
 
 echo " /// DETERMINACION CUOTAS IMSS /// <br> <br>
     
     Salario Base Mensual: ".$salario." <br> 
 
     Cuota fija determinada: ". $pro_i_cf. "<br> ";
 
 
 
 
 /* Segundo bloque: Excedente de cuota fija */ 
 
 $prop_i_ex=0; /* provision excedente patron */
 $proe_i_ex=0; /* provision excedente empleado */
 
 $z=$uma*3;
 echo "SDI: ".$sdi." condicion 3 veces la uma: ".$z."<br> <br> <br>";
 
 
 if($sdi>=($uma*3)) /* si el sbc supera 3 veces la uma */
     {
     
     echo "El SDI supera 3 veces la UMA <br><br>";
     
     
     /* calculo de excedente patron */
     
     $prop_i_ex=$sdi-($uma*3);
     $prop_i_ex=$prop_i_ex*$dias;
     $prop_i_ex=$prop_i_ex*$porcentajep_i_ex;
     
     
     /* Calculo de excedente empleado */
     
     $proe_i_ex=$sdi-($uma*3);
     $proe_i_ex=$proe_i_ex*$dias;
     $proe_i_ex=$proe_i_ex*$porcentajee_i_ex;
     
     
     echo "Excedente empleado: ".$proe_i_ex."<br>";
     echo "Excedente patron: ".$prop_i_ex."<br> <br> <br>"; 
     
     
     }
 else
     {
     }
     
     
     
 /* Tercer bloque: Prestaciones en dinero */
 
 
 /* calculo de parte patronal */
 $prop_i_pd=($sdi*$dias)*$porcentajep_i_pd;
 
 /* calculo de parte empleado */ 
 $proe_i_pd=($sdi*$dias)*$porcentajee_i_pd;
 
 
 
 echo "Prestaciones en dinero empleado: ".$proe_i_pd."<br>";
 echo "Prestaciones en dinero patron: ".$prop_i_pd."<br> <br> <br>"; 
 
 
 
 
 /* Cuarto bloque: Gastos medicos para pensionados */
 
 $prop_i_gm=($sdi*$dias)*$porcentajep_i_gm;
 $proe_i_gm=($sdi*$dias)*$porcentajee_i_gm;
 
 echo "Gastos medicos para pensionados empleado: ".$proe_i_gm."<br>";
 echo "Gastos medicos para pensionados patron: ".$prop_i_gm."<br> <br> <br>"; 
 
 
 /* Quinto bloque: Riesgo de trabajo*/
 
 $prop_i_rt=($sdi*$dias)*$porcentajep_i_rt;
 
 echo "Riesgo de trabajo patron: ".$prop_i_rt."<br> <br> <br>"; 
 
 
 
 /* Sexto Bloque: Invalidez y vida */ 
 
 
 $prop_i_iv=($sdi*$dias)*$porcentajep_i_iv;
 $proe_i_iv=($sdi*$dias)*$porcentajee_i_iv;
 
 echo "Invalidez y vida empleado: ".$proe_i_iv."<br>";
 echo "Invalidez y vida patron: ".$prop_i_iv."<br> <br> <br>"; 
 
 /* Septimo Bloque: Guarderia */
 
 $prop_i_gg=($sdi*$dias)*$porcentajep_i_gg;
 
 echo "Guarderia patron: ".$prop_i_gg."<br> <br> <br>"; 
 
 /* Octavo bloque: Retiro */
 
 $prop_i_re=($sdi*$dias)*$porcentajep_i_re;
 
 echo "Retiro patron: ".$prop_i_re."<br> <br> <br>"; 
 
 /* Noveno bloque: infonavit */
 
 $prop_i_in=($sdi*$dias)*$porcentajep_i_in;
 
 echo "infonavit patron: ".$prop_i_in."<br> <br> <br>"; 
 
 
 
 
 
 /* Onceavo bloque: Cesentia y vejez */
 
 // Tablas de cesentia 

 $limite_inf_cesentia=0;
 $limite_sup_cesentia=0;
 $ccv=0;

$tablaMensualCV_inf=[248.93,248.94,248.95,248.96,271.44,325.72,380.01,434.29];
$tablaMensualCV_sup=[248.93,248.94,248.95,271.43,325.71,380,434.28,2714.25];
$tablaMensualCV_CV=[3.15,3.413,4.00,4.353,4.588,4.756,4.882,5.331];

$k=0;
for($k=0;$k<=6;$k++)
{

   if($sdi<= $tablaMensualCV_sup[$k])
   {
       $limite_inf_cesentia=$tablaSubsidioMensualinf[$k];
       $limite_sup_cesentia=$tablaSubsidioMensualsup[$k];
       $ccv=$tablaMensualCV_CV[$k];
   }
}
 
 /* Cesentia y vejez patronal */
  
 $proe_i_cv=($sdi*$dias)*$porccentajee_i_cv;
 $prop_i_cv=($sdi*$dias)*$ccv/100;
 
 echo "Porcentaje a aplicar: ".$ccv;
 echo "Cesentia y vejez patronal : ".$prop_i_cv."<br><br><br>";
 echo "Cesentia y vejez empleado : ".$proe_i_cv."<br><br><br>";
     
  
 /* Calculo de ISN 3% CDMX */
 
 $isnp=$salario*$isn;
 
 
 
 $imss=$proe_i_ex+$proe_i_pd+$proe_i_gm+$proe_i_iv+$proe_i_cv;
 
 
 $tisr=$cuota_aplicada-$valor_subsidio; /* Total de isr menos el subsidio al emlpeo*/
 $neto=($salario-$tisr)-$imss;
 
 $imssp=$pro_i_cf+$prop_i_ex+$prop_i_pd+$prop_i_gm+$prop_i_rt+$prop_i_iv+$prop_i_gg+$prop_i_cv+$prop_i_re+$prop_i_in;
 
 echo"Suma de imss patron:".$imssp;
 
 
 $costo=$imssp;
 
 echo $neto. "<br>";
 echo number_format($neto,2);
 
 
     
     if($valor_subsidio>=$cuota_fija)
     {
         $tisr=0;
         
     }
return [$neto,$bruto];
}


     function piramida($neto)
     {

        
list($nuevo_neto,$nuevo_bruto)=bruto_neto($neto);
        


while( $nuevo_neto<=$neto)
{
           list($nuevo_neto,$nuevo_bruto)=bruto_neto($nuevo_bruto);
            $nuevo_bruto=$nuevo_bruto+.50;
        }

return "*********************VALOR ****************".$nuevo_bruto;

     }



echo $resultado=piramida(16000);
 /* retorno a pagina de calculo con paso de variables en url */
 
 //header("Location: ../nomina.php?&visr=".number_format($cuota_fija,2)."&sbase=".number_format($salario,2)."&vimss=".number_format($imss,2)."&vsub=".number_format($valor_subsidio,2)."&vneto=".number_format($neto,2)."&vimssp=".number_format($imssp,2)."&vinfo=".number_format($prop_i_in,2)."&visn=".number_format($isnp,2)."&vcosto=".number_format($costo,2)."&visrr=".number_format($tisr,2)."&vprima=".$riesgo.""); 
 
  
  
  
  
  
  ?>