
function valida_metodo()
{
const s_ingresado=document.getElementById("salario").value;
const pr_ingresado=document.getElementById("priesgo").value;
const metodo=document.getElementById("piramida").value;


var isr_determinado=document.getElementById("v_isr");
var sub_determindado=document.getElementById("v_sub");
var isrr_determinado=document.getElementById("v_isrr");
var imss_empleado=document.getElementById("v_imss");
var neto_calculado=document.getElementById("v_neto");

var imss_patron=document.getElementById("v_imssp");
var infoavit_patron=document.getElementById("v_infonavit");
var isn_patron=document.getElementById("v_isn");
var neto_patron=document.getElementById("v_netop");



if (metodo === "nada") {
    alert("Por favor, selecciona un método válido");
    window.location.reload();//recarga la pagina
    return false;//evita el envio del formulario
}
else{
    if(isNaN(s_ingresado)|| s_ingresado <= 0){
        alert("Por favor, ingresa un valor númerico mayor a cero");
        window.location.reload();//recarga la pagina
        return false;//evita el envio del formulario
    }else{
        if(isNaN(pr_ingresado)|| pr_ingresado < 0.5){
            alert("Por favor, ingresa un valor númerico mayor a 0.5");
            window.location.reload();//recarga la pagina
            return false;//evita el envio del formulario
        }
    }
}

if(metodo=="Neto a Bruto")
{

var bruto_piramida=piramida(s_ingresado,pr_ingresado);

neto_calculado.value=bruto_piramida;

alert("El bruto estimado a considerar: "+bruto_piramida);

}
else
{
if(metodo=="Bruto a Neto")
    {
        const n=[neto,bruto,riesgo,cuota_aplicada,imss,valor_subsidio,imssp,prop_i_in,isnp,costo,tisr]=bruto_neto(s_ingresado,pr_ingresado);

        isr_determinado.value=Number(cuota_aplicada.toFixed(2));
        sub_determindado.value=Number(valor_subsidio.toFixed(2));
        isrr_determinado.value=Number(tisr.toFixed(2));
        imss_empleado.value=Number(imss.toFixed(2));
        neto_calculado.value=Number(neto.toFixed(2));
        
        imss_patron.value=Number(imssp.toFixed(2));
        infoavit_patron.value=Number(prop_i_in.toFixed(2));
        isn_patron.value=Number(isnp.toFixed(2));
        neto_patron.value=Number(costo.toFixed(2));

    }
}



}
 
function piramida(neto,riesgo)
{ 
    //Pasamos el neto objetivo y lo metemos en la funcion bruto_neto como un " Bruto "
    //La funcion bruto_neto me retornara un nuevo neto y el bruto(neto objetivo)
    var y=[nuevo_neto,nuevo_bruto,riesgo,cuota_aplicada,imss,valor_subsidio,imssp,prop_i_in,isnp,costo,tisr]=bruto_neto(neto,riesgo);
    var centavo=0.50;
    parseFloat(neto);
   do {
    var x=[nuevo_neto,nuevo_bruto,riesgo,cuota_aplicada,imss,valor_subsidio,imssp,prop_i_in,isnp,costo,tisr]=bruto_neto(nuevo_bruto,riesgo);
    nuevo_bruto=parseFloat(nuevo_bruto)+parseFloat(centavo);
    Number(nuevo_bruto.toFixed(2));
    parseFloat(nuevo_neto);
    Number(nuevo_neto.toFixed(2));    
   } while (nuevo_neto<=neto);
    return nuevo_bruto;
}

function bruto_neto(bruto,riesgo)
    {
        // tablas deISR 

        // Tabla ISR mensual limite inferior
        tablaMensual = [0.01, 746.05, 6332.06, 11128.02, 12935.83, 15487.72, 31236.50, 49233.01, 93993.91, 125325.21, 375975.62];
        // Tabla ISR mensual limite superior
        tablaMensualsup=[746.04,6332.05,11128.00,12935.8,15487.7,31236.5,49233.00,93993.9,125325,375976,10000000000];
        // Tabla ISR mensual Cuota fija
        cuotaMensual = [ 0.00, 14.32, 371.83, 893.63, 1182.88, 1640.18, 5004.12, 9236.89, 22665.17, 32691.18, 117912.32];
        // Tabla ISR mensual excedente
        porcMensual = [ 1.92, 6.40, 10.88, 16.00, 17.92, 21.36, 23.52, 30.00, 32.00, 34.00, 35.00];
        // Tabla subsidio mensual hasta ingresos de
        ingSubMensual = [ 1768.96, 2653.38, 3472.84, 3537.87, 4446.15, 4717.18, 5335.42, 6224.67, 7113.90, 7382.33];
        // Tabla de subsidio ISR mensual - Cantidad de subsidio para el empleo
        canSubMensual = [ 407.02, 406.83, 406.62, 392.77, 382.46, 354.23, 324.87, 294.63, 253.54, 217.61, 0.00];

        // Tablas subsidio

        tablaSubsidioMensualinf = [0.01,1768.97,2653.39,3472.85,3537.88,44446.46,9081.01];
        tablaSubsidioMensualsup = [1768.96,2653.38,3472.84,3537.87,4446.15,9081,100000000000];
        subsidio=[407.02,406.83,406.62,392.77,382.46,390,0];
    
        /* Variables de usuario para calculo */
         
         salario=bruto; //_POST['salario'];
         riesgo=riesgo;  //_POST['priesgo'];
         parseInt(salario);
         parseFloat(riesgo);
        
        if(isNaN(salario))
        { 
            alert("El salario base no es correcto, ingresa numeros unicamente porfavor: "+salario);
            window.location.reload();
                }
        else 
        {
            if(isNaN(riesgo))
            {
            alert("La prima de riesgo no es correcta,ingresa unicamente numeros porfavor");
            window.location.reload();
            }
        }
  
        /* Variables Globales estaticas  */
 
        fintegracion=1.0493; /* Factor de integracion para 2024 */
        uma=108.57; /* Valor de UMA 2024 */
        sbc=salario*fintegracion; /* Calculo de Salario Base de Cotizacion mensual */
        dias=30; /* Dias trabajados para calculo */
        sdi=sbc/dias; /* Calculo de Salario diario integrado */
        isn=3.00/100; /* Porcentaje de ISN CDMX */ 
        tope_umas_imss=uma*25;
        
        if(sdi>tope_umas_imss)
        {
            sdi=tope_umas_imss;
        }
        else
        {
        }
        /*porcentajes a aplicar cuotas imss*/
        
        pocentaje_cuotafija=20.4/100;  /* cuota fija */ 
        porcentajep_i_ex=1.10/100; /* excedente cuota fija patron */
        porcentajee_i_ex=0.40/100; /* excedente cuota fija empleado */
        porcentajep_i_pd=0.70/100; /* prestaciones en dinero patron*/
        porcentajee_i_pd=0.25/100; /* prestaciones en dinero empleado*/
        porcentajep_i_gm=1.05/100; /* gastos medicos para pensionados patron */
        porcentajee_i_gm=0.375/100; /* gastos medicos para pensionados empleados */
        porcentajep_i_rt=riesgo/100; /* riesgo de trabajo */
        porcentajep_i_iv=1.75/100; /* invalidez y vida patron */
        porcentajee_i_iv=0.625/100; /* invalidez y vida empleado */
        porcentajep_i_gg=1.00/100; /* guarderia */
        porcentajep_i_re=2.00/100; /* retiro */
        porcentajep_i_in=5.00/100; /* infonavit */         
        porccentajee_i_cv=1.125/100; /* cesentia y vejez */
        porccentajep_i_cv=0;
         
        /* Calculo de ISR */
        
        // buscamos el salario ingresado en las tablas de isr dentro de los rangos de lim inf y lim sup
        i=0;
        limite_inferior=0;
        limite_superior=0;
        cuota_fija=0;
        porcentaje_sobreex=0;
        for(i=0;i<=10;i++)
        {
            if(salario>=tablaMensual[i] && salario<= tablaMensualsup[i])
            {
                limite_inferior=tablaMensual[i];
                limite_superior=tablaMensualsup[i];
                cuota_fija=cuotaMensual[i];
                porcentaje_sobreex=porcMensual[i];
                break;
            }

        }
        // Buscamos el salario en la tabla de subsidio para determinar si es acreedor

        limite_inf_subsidio=0;
        limite_sup_subsidio=0;
        valor_subsidio=0;
        j=0;
        for(j=0;j<=6;j++)
        {
            if(salario<= tablaSubsidioMensualsup[j])
            {
                limite_inf_subsidio=tablaSubsidioMensualinf[j];
                limite_sup_subsidio=tablaSubsidioMensualsup[j];
                valor_subsidio=subsidio[j];
                break;
            }

        }
        //Se calcula el excedente, restanto el salario menos el limite inferior
        excedente=salario-limite_inferior;
        //Se calcula el porentaje de excedente multiplicando el excedente anteriormente claculado por el % obtenido de la tabla de isr /100
        porcentaje_excedente=(excedente*porcentaje_sobreex)/100;
        // Se calcula la cuota fija sumando el porcentaje de excedente mas la cuota obtenida en la tabla de isr
        cuota_aplicada=porcentaje_excedente+cuota_fija;
        // finalmente se resta la cuota fija al salario
        isr=(salario-cuota_aplicada)+valor_subsidio;

        // calculo de cuota imss        
        
        // Primer Bloque: Cuota Fija
        pro_i_cf=(dias*uma)*pocentaje_cuotafija;       
        // Segundo bloque: Excedente de cuota fija 
        prop_i_ex=0; /* provision excedente patron */
        proe_i_ex=0; /* provision excedente empleado */
        z=uma*3;
        if(sdi>=(uma*3)) /* si el sbc supera 3 veces la uma */
        {
            /* calculo de excedente patron */
            prop_i_ex=sdi-(uma*3);
            prop_i_ex=prop_i_ex*dias;
            prop_i_ex=prop_i_ex*porcentajep_i_ex;
            /* Calculo de excedente empleado */
            proe_i_ex=sdi-(uma*3);
            proe_i_ex=proe_i_ex*dias;
            proe_i_ex=proe_i_ex*porcentajee_i_ex;    
        }
        else
        {
        }
        //Tercer bloque: Prestaciones en dinero
        //Calculo de parte patronal
        prop_i_pd=(sdi*dias)*porcentajep_i_pd;
        // Calculo de parte empleado
        proe_i_pd=(sdi*dias)*porcentajee_i_pd;
        //Cuarto bloque: Gastos medicos para pensionados
        prop_i_gm=(sdi*dias)*porcentajep_i_gm;
        proe_i_gm=(sdi*dias)*porcentajee_i_gm;
        // Quinto bloque: Riesgo de trabajo
        prop_i_rt=(sdi*dias)*porcentajep_i_rt;   
        // Sexto Bloque: Invalidez y vida 
        prop_i_iv=(sdi*dias)*porcentajep_i_iv;
        proe_i_iv=(sdi*dias)*porcentajee_i_iv;
        // Septimo Bloque: Guarderia
        prop_i_gg=(sdi*dias)*porcentajep_i_gg;
        //Octavo bloque: Retiro
        prop_i_re=(sdi*dias)*porcentajep_i_re;      
        //Noveno bloque: infonavit
        prop_i_in=(sdi*dias)*porcentajep_i_in;
        //Onceavo bloque: Cesentia y vejez

        // Tablas de cesentia
        limite_inf_cesentia=0;
        limite_sup_cesentia=0;
        ccv=0;
        tablaMensualCV_inf=[248.93,248.94,248.95,248.96,271.44,325.72,380.01,434.29];
        tablaMensualCV_sup=[248.93,248.94,248.95,271.43,325.71,380,434.28,2714.25];
        tablaMensualCV_CV=[3.15,3.413,4.00,4.353,4.588,4.756,4.882,5.331];
        k=0;
        for(k=0;k<=6;k++)
        {
            if(sdi<= tablaMensualCV_sup[k])
            {
                limite_inf_cesentia=tablaSubsidioMensualinf[k];
                limite_sup_cesentia=tablaSubsidioMensualsup[k];
                ccv=tablaMensualCV_CV[k];
            }
        }
        //Cesentia y vejez patronal
        proe_i_cv=(sdi*dias)*porccentajee_i_cv;
        prop_i_cv=(sdi*dias)*ccv/100;

        //Calculo de ISN 3% CDMX
        isnp=salario*isn;
        
        //Calculo de IMSS empleado        
        imss=proe_i_ex+proe_i_pd+proe_i_gm+proe_i_iv+proe_i_cv;
        // Total de ISR menos el subsidio al emlpeo
        tisr=cuota_aplicada-valor_subsidio; 
        //Neto a pagar para empleado 
        neto=(salario-tisr)-imss;
        // Calculo IMSS para patron
        imssp=pro_i_cf+prop_i_ex+prop_i_pd+prop_i_gm+prop_i_rt+prop_i_iv+prop_i_gg+prop_i_cv+prop_i_re+prop_i_in;
        costo=imssp;    
        if(valor_subsidio>=cuota_aplicada)
        {
            tisr=0;    
        }

        console.log( "++++ INICIO de proceso Bruto a Neto ++++");
        console.log( "Salario capturado: "+salario+"");
        console.log( "Factor de integracion capturado: "+fintegracion+"");
        console.log( "Prima de riesgo capturada: "+riesgo+"  ");
        console.log( "SDI a considerar: "+sdi+"  ");
        console.log( "el SBC a considerar"+sbc+"  ");
        console.log( "Salario:"+salario+"");
        console.log( "Limite inferior: "+limite_inferior+"");
        console.log( "Limite superior: "+limite_superior+"");
        console.log( "Cuota fija: "+cuota_fija+"");
        console.log( "Porcentaje: "+porcentaje_sobreex+"");
        console.log( "Limite inferior de subsidio: "+limite_inf_subsidio+"");
        console.log( "Limite superior de subsidio: "+limite_sup_subsidio+"");
        console.log( "Valor de subsidio: "+valor_subsidio+"");
        console.log( "Excedente: "+excedente+"");
        console.log( "Porcentaje de excedente: "+porcentaje_excedente+"");
        console.log( "ISR a aplicar: "+cuota_aplicada+"");
        console.log( "Subsidio calculado: "+valor_subsidio+""); 
        console.log( "Salario menos ISR: "+isr+"");
        console.log( " /// DETERMINACION CUOTAS IMSS /// " );
            
        console.log("Salario Base Mensual: "+salario+"");
        
        console.log("Cuota fija determinada: "+ pro_i_cf+ " ");
        console.log( "SDI: "+sdi+" condicion 3 veces la uma: "+z+"  ");
        console.log( "Excedente empleado: "+proe_i_ex+"");
        console.log( "Excedente patron: "+prop_i_ex+"  "); 
        console.log( "Prestaciones en dinero empleado: "+proe_i_pd+"");
        console.log( "Prestaciones en dinero patron: "+prop_i_pd+"  "); 
        console.log( "Gastos medicos para pensionados empleado: "+proe_i_gm+"");
        console.log( "Gastos medicos para pensionados patron: "+prop_i_gm+"  "); 
        console.log( "Riesgo de trabajo patron: "+prop_i_rt+"  "); 
        console.log( "Invalidez y vida empleado: "+proe_i_iv+"");
        console.log( "Invalidez y vida patron: "+prop_i_iv+"  "); 
        console.log( "Guarderia patron: "+prop_i_gg+"  "); 
        console.log( "Retiro patron: "+prop_i_re+"  "); 
        console.log( "infonavit patron: "+prop_i_in+"  "); 
        console.log( "Porcentaje a aplicar: "+ccv);
        console.log( "Cesentia y vejez patronal : "+prop_i_cv+"");
        console.log( "Cesentia y vejez empleado : "+proe_i_cv+"");
        console.log("Suma de imss patron:"+imssp);
        console.log( Number(neto.toFixed(2))+ "");
        console.log(Number(neto.toFixed(2)));
   // return [neto,bruto,riesgo,cuota_aplicada,imss,valor_subsidio,imssp,prop_i_in,isnp,costo,tisr];
   return [neto,bruto,riesgo,cuota_aplicada,imss,valor_subsidio,imssp,prop_i_in,isnp,costo,tisr];
}

function validarform(){
    const seleccion = document.getElementById("piramida").value;
    const salario = document.querySelector("input[name='salario']").value;

    if(seleccion === "nada" || salario === ""){
        alert("Debe seleccionar una opción valida y llenar todos los campos requeridos.");
        window.location.reload();//recarga la pagina
        return false;//evita el envio del formulario
    }
    return true;//permite envio exitoso
}
 /* retorno a pagina de calculo con paso de variables en url */
 
//header("Location: ++/nomina+php?&visr="+number_format(cuota_fija,2)+"&sbase="+number_format(salario,2)+"&vimss="+number_format(imss,2)+"&vsub="+number_format(valor_subsidio,2)+"&vneto="+number_format(neto,2)+"&vimssp="+number_format(imssp,2)+"&vinfo="+number_format(prop_i_in,2)+"&visn="+number_format(isnp,2)+"&vcosto="+number_format(costo,2)+"&visrr="+number_format(tisr,2)+"&vprima="+riesgo+""); 

function netoaobjetivo() {
	const piramida = document.getElementById("piramida").value;
	const labelMensual = document.getElementById("vmensual");
	const labelNeto = document.getElementById("v_net");

	if (piramida === "Bruto a Neto") {
		labelMensual.innerText = "Bruto Mensual";
		labelNeto.innerText = "Neto a pagar";
	} else if (piramida === "Neto a Bruto") {
		labelMensual.innerText = "Neto Mensual";
		labelNeto.innerText = "Bruto estimado";
	} else {
		labelMensual.innerText = "Base Mensual";
		labelNeto.innerText = "Neto a pagar";
	}
}


