<?php

function interpolacion($valor)
{

    $neto_obtenido=$valor;

$bruto1=7467.90; //y1
$neto1=7176.38; //x1

/* tope de salarios para el imss 
$bruto2=81427.50; //y2                                    
$neto2=60311.73; //x2
*/

$bruto2=81427.50; //y2                                    
$neto2=60311.73; //x2


$brutoa=$bruto2-$bruto1;
$netoa=$neto2-$neto1;
$netoc=$neto_obtenido-$neto1;

$bruto_objetivo1=$brutoa/$netoa;
$bruto_objetivo2=$netoc*$bruto_objetivo1;



$bruto_objetivo=$bruto1+$bruto_objetivo2;



return $bruto_objetivo;
}


echo "el bruto es: ".interpolacion(20000);




function interpolacion2($netoreal)
{


/* archivo para obtener credenciales de mysql */
require_once("dbconnect.php");



/* Variables de usuario para calculo */


setlocale(LC_MONETARY, 'en_US'); /* establecer formato de pesos */

$salario=7467.90;
$riesgo=0.500;

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


/// aqui me quede 
while($neto!=$netoreal)
{

$salario=$salario+0.10;

/* Calculo de ISR */

$query= "SELECT * FROM tb_isr_men_2024 WHERE climite_inf <='".$salario."' and climite_sup >='".$salario."';"; 


$result = mysqli_query($conn,$query);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$id=$row["ID"];
$liminf=$row["climite_inf"];
$limsup=$row["climite_sup"];
$cuot=$row["ccuota_fija"];
$porcen=$row["cporcentaje"];



$exc_lim_inf=$salario-$liminf;

echo " /// DETERMINACION ISR /// <br> <br>
	
	Salario Base Mensual: ".$salario." <br> 

      Limite inferior: ".$liminf." <br>
      Excedente de limite inferior: ".$exc_lim_inf." <br>";

$porcen_lim_inf=($exc_lim_inf*$porcen)/100;

echo "Porcentaje a aplicar por excedente de limite inferior: ".$porcen."<br>
      Cantidad aplicada por excedente: ".$porcen_lim_inf."<br>";

$cuota_fija=$porcen_lim_inf+$cuot;

echo "Cuota fija aplicada: ".$cuot."<br>
      ISR a aplicar: ".$cuota_fija." <br> <br> <br>";
      
      
    
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



/* Decimo bloque: subsidio al empleo */ 



$query_sub= "SELECT * FROM tb_sub_men_2024 WHERE climite_inf <='".$salario."' and climite_sup >='".$salario."';";


$result1 = mysqli_query($conn,$query_sub);

$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

$id1=$row1["ID"];
$liminf1=$row1["climite_inf"];
$limsup1=$row1["climite_sup"];
$subsidio1=$row1["csubsidio"];



if($subsidio1==NULL)
{
	
	$subsidio1="0.0";
}


echo "subsidio al empleo: ".$subsidio1."<br><br><br>";
	


/* Onceavo bloque: Cesentia y vejez */



/* Cesentia y vejez patronal */

$query_cv= "SELECT * FROM tb_cv_men_2024 WHERE climite_inf <='".$sdi."' and climite_sup >='".$sdi."';";


$result2 = mysqli_query($conn,$query_cv);

$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

if(mysqli_num_rows($result2)==0)
{
	$id2=0;
	$liminf2=0;
	$limsup2=0;
	$porccentajep_i_cv=0;
}
else
{
	$id2=$row2["ID"];
	$liminf2=$row2["climite_inf"];
	$limsup2=$row2["climite_sup"];
	$porccentajep_i_cv=$row2["ccv"]/100;

}



if($porccentajep_i_cv==NULL)
{
	
	$porccentajep_i_cv="0.0";
}

$proe_i_cv=($sdi*$dias)*$porccentajee_i_cv;
$prop_i_cv=($sdi*$dias)*$porccentajep_i_cv;

echo "Porcentaje a aplicar: ".$porccentajep_i_cv;
echo "Cesentia y vejez patronal : ".$prop_i_cv."<br><br><br>";
echo "Cesentia y vejez empleado : ".$proe_i_cv."<br><br><br>";
	

mysqli_close($conn);


/* Calculo de ISN 3% CDMX */

$isnp=$salario*$isn;



$imss=$proe_i_ex+$proe_i_pd+$proe_i_gm+$proe_i_iv+$proe_i_cv;


$tisr=$cuota_fija-$subsidio1; /* Total de isr menos el subsidio al emlpeo*/
$neto=($salario-$tisr)-$imss;

$imssp=$pro_i_cf+$prop_i_ex+$prop_i_pd+$prop_i_gm+$prop_i_rt+$prop_i_iv+$prop_i_gg+$prop_i_cv+$prop_i_re+$prop_i_in;

echo"Suma de imss patron:".$imssp;


$costo=$imssp;

echo $neto. "<br>";
echo number_format($neto,2);


	
	if($subsidio1>=$cuota_fija)
	{
		$tisr=0;
		
	}
 
/* retorno a pagina de calculo con paso de variables en url */

//header("Location: ../nomina.php?&visr=".number_format($cuota_fija,2)."&sbase=".number_format($salario,2)."&vimss=".number_format($imss,2)."&vsub=".number_format($subsidio1,2)."&vneto=".number_format($neto,2)."&vimssp=".number_format($imssp,2)."&vinfo=".number_format($prop_i_in,2)."&visn=".number_format($isnp,2)."&vcosto=".number_format($costo,2)."&visrr=".number_format($tisr,2)."&vprima=".$riesgo.""); 

}




}


?>