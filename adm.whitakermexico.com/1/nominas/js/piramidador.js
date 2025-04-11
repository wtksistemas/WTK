//cambiar de fija a proyectada
document.addEventListener('DOMContentLoaded', function() {
    // Seleccionamos el checkbox por su ID real (switch-label)
    const switchCheckbox = document.getElementById('switch-label');
    // Seleccionamos el input por su ID (mecanica)
    const mecanicaInput = document.getElementById('mecanica');

    actualizarTooltip();

    switchCheckbox.addEventListener('change', function() {
        // Actualizamos el valor y placeholder simultáneamente
        mecanicaInput.value = this.checked ? 'PROYECTADA' : 'FIJA';
        mecanicaInput.placeholder = this.checked ? 'PROYECTADA' : 'FIJA';

        actualizarTooltip();
    });
});



// Funcion para validar el metodo de piramidacion...
function valida_metodo() {
    // leemos todos los valores del formulario enviado..
    const periodi = document.getElementById("periodicidad").value;
    const s_ingresado = document.getElementById("salario").value;
    const pr_ingresado = document.getElementById("priesgo").value;
    const metodo = document.getElementById("piramida").value;
    const subsidio_anual = document.getElementById("id_vsubanual").value;

    var isr_determinado = document.getElementById("v_isr");
    var sub_determindado = document.getElementById("v_sub");
    var isrr_determinado = document.getElementById("v_isrr");
    var imss_empleado = document.getElementById("v_imss");
    var neto_calculado = document.getElementById("v_neto");


    // Variables para el calculo de isr..

    var nuevo_salario = document.getElementById("v_sala");
    var limitesuperior = document.getElementById("v_ls");
    var limiteinferior = document.getElementById("v_lf");
    var cuotafija = document.getElementById("v_cufij");
    var porcentaje = document.getElementById("v_porc");
    
    // Variables para el calculo de imss empleado..

    var exempleado = document.getElementById("ex_emple");
    var presemple= document.getElementById("pres_emple");
    var gastemple= document.getElementById("gast_emple");
    var invaemple= document.getElementById("inva_emple");
    var cesemple= document.getElementById("cen_emple");


    // variables para el calculo de imss patron..

    var expatron = document.getElementById("ex_patr");
    var prespatron = document.getElementById("pres_patr");
    var gastpatron = document.getElementById("gast_patr");
    var rtpatron = document.getElementById("rt_patr");
    var invapatron = document.getElementById("inv_patr");
    var guarpatron = document.getElementById("guar_patr");
    var retpatron = document.getElementById("ret_patr");
    var infonapatron = document.getElementById("infona_patr");
    var cenpatron = document.getElementById("cen_patr");


    var imss_patron = document.getElementById("v_imssp");
    var infoavit_patron = document.getElementById("v_infonavit");
    var isn_patron = document.getElementById("v_isn");
    var neto_patron = document.getElementById("v_netop");


    // Evaluamos los valores mimimos que el usuario debe ingresar.. 

    if (isNaN(s_ingresado) || s_ingresado < 419.88 || isNaN(pr_ingresado) || pr_ingresado < 0.5) {
        alert("Por favor, ingresa un salario mayor al minimo vigente y una prima de riesgo mayor a 0.5");
        window.location.reload();//recarga la pagina
        return false;//evita el envio del formulario
    }
    else { }

    //Realizamos los calculos dependiendo la seleccion del usuario.. 
    switch (metodo) {
        case "nada":
            alert("Por favor, selecciona un método válido");
            window.location.reload();//recarga la pagina
            //return false; evita el envio del formulario
            break;
        case "Bruto a Neto":
            const n = [neto, bruto, riesgo, cuota_aplicada, imss, valor_subsidio, imssp, prop_i_in, isnp, costo, tisr, limite_superior, limite_inferior, salario, cuota_fija, porcentaje_sobreex] = bruto_neto(s_ingresado, pr_ingresado, periodi, subsidio_anual);
            isr_determinado.value = Number(cuota_aplicada.toFixed(2));
            sub_determindado.value = Number(valor_subsidio.toFixed(2));
            isrr_determinado.value = Number(tisr.toFixed(2));
            imss_empleado.value = Number(imss.toFixed(2));
            neto_calculado.value = Number(neto.toFixed(2));


        // valores de isr
            nuevo_salario.value = Number(salario);
            limitesuperior.value = Number(limite_superior.toFixed(2));
            limiteinferior.value = Number(limite_inferior);
            cuotafija.value = Number(cuota_fija.toFixed(2));
            porcentaje.value = Number(porcentaje_sobreex.toFixed(2));

        // valores de imss empleado
            exempleado.value = Number(proe_i_ex.toFixed(2));
            presemple.value = Number(proe_i_pd.toFixed(2));
            gastemple.value = Number(proe_i_gm.toFixed(2));
            invaemple.value = Number(proe_i_iv.toFixed(2));
            cesemple.value = Number(proe_i_cv.toFixed(2));


        // valores de imss patron
            expatron.value = Number(prop_i_ex.toFixed(2));
            prespatron.value = Number(prop_i_pd.toFixed(2));
            gastpatron.value = Number(prop_i_gm.toFixed(2));
            rtpatron.value = Number(prop_i_rt.toFixed(2));
            invapatron.value = Number(prop_i_iv.toFixed(2));
            guarpatron.value = Number(prop_i_gg.toFixed(2));
            retpatron.value = Number(prop_i_re.toFixed(2));
            infonapatron.value = Number(prop_i_in.toFixed(2));
            cenpatron.value = Number(prop_i_cv.toFixed(2));
    
            imss_patron.value = Number(imssp.toFixed(2));
            infoavit_patron.value = Number(prop_i_in.toFixed(2));
            isn_patron.value = Number(isnp.toFixed(2));
            neto_patron.value = Number(costo.toFixed(2));
            break;
        case "Neto a Bruto":
            var bruto_piramida = piramida(s_ingresado, pr_ingresado, periodi,subsidio_anual);
            neto_calculado.value = bruto_piramida;
            alert("El bruto estimado a considerar: " + bruto_piramida);
            break;



        default:
            alert("Favor de llenar todo el formulario");
            window.location.reload();//recarga la pagina
        //return false; evita el envio del formulario
    }

    return true;//permite envio exitoso
}


// Funcion para realizar piramidacion.. ( neto a bruto )
function piramida(neto, riesgo, periodicidad,sub) {
    //Pasamos el neto objetivo y lo metemos en la funcion bruto_neto como un " Bruto "
    //La funcion bruto_neto me retornara un nuevo neto y el bruto(neto objetivo)
    var y = [nuevo_neto, nuevo_bruto, riesgo, cuota_aplicada, imss, valor_subsidio, imssp, prop_i_in, isnp, costo, tisr] = bruto_neto(neto, riesgo, periodicidad, sub);
    var centavo = 0.50;


    parseFloat(nuevo_neto);
    do {
        var x = [nuevo_neto, nuevo_bruto, riesgo, cuota_aplicada, imss, valor_subsidio, imssp, prop_i_in, isnp, costo, tisr] = bruto_neto(nuevo_bruto, riesgo, periodicidad, sub);
        nuevo_bruto = parseFloat(nuevo_bruto) + parseFloat(centavo);
        Number(nuevo_bruto.toFixed(2));
        parseFloat(nuevo_neto);
        Number(nuevo_neto.toFixed(2));
    } while (nuevo_neto <= neto);
    return nuevo_bruto;
}

// Funcion para el calulo de salario bruto a salario neto pasando el valor de salario bruto, la prima de riesgo, periodicidad y subsidio calculado anual si aplica...
function bruto_neto(bruto, riesgo, tbimpuestos, sub) {
    const mecanica = document.getElementById("mecanica").value;
    var salarioingre = bruto;
    var bruto1;
    var dias;
    var tablaMensual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var tablaMensualsup = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var cuotaMensual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var porcMensual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var ingSubMensual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var canSubMensual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    // Evaluamos la periodicidad para llenar los vectores que se usaran para determinar isr..
    if(mecanica === "PROYECTADA"){
        switch (tbimpuestos) {
            case "vsemanal":
                dias = 7;
                bruto1 = (bruto / 7) * 30;
                periodicidad = "vmensual";
                break;
            case "vquincenal":
                dias = 15;
                bruto1 = bruto * 2;
                periodicidad = "vmensual";
                break;
            case "vmensual":
                dias = 30;
                bruto1 = bruto;
                break;
            case "vanual":
                break;
        }
                        //tabla mensual
                        tablaMensual = [0.01, 746.05, 6332.06, 11128.02, 12935.83, 15487.72, 31236.50, 49233.01, 93993.91, 125325.21, 375975.62];
                        tablaMensualsup = [746.04, 6332.05, 11128.00, 12935.8, 15487.7, 31236.5, 49233.00, 93993.9, 125325, 375976, 10000000000];
                        cuotaMensual = [0.00, 14.32, 371.83, 893.63, 1182.88, 1640.18, 5004.12, 9236.89, 22665.17, 32691.18, 117912.32];
                        porcMensual = [1.92, 6.40, 10.88, 16.00, 17.92, 21.36, 23.52, 30.00, 32.00, 34.00, 35.00];
                        ingSubMensual = [1768.96, 2653.38, 3472.84, 3537.87, 4446.15, 4717.18, 5335.42, 6224.67, 7113.90, 7382.33];
                        canSubMensual = [407.02, 406.83, 406.62, 392.77, 382.46, 354.23, 324.87, 294.63, 253.54, 217.61, 0.00]; 


}if (mecanica === "FIJA"){
    switch (tbimpuestos) {
        case "vsemanal":
            bruto1=bruto;
            dias = 7;
            tablaMensual = [0.01, 171.79, 1458.04, 2562.36, 2978.65, 3566.23, 7192.65, 11336.58, 21643.31, 28857.79, 86573.35];
            //Tabla ISR semanal limite inferior
            tablaMensualsup = [171.78, 1458.03, 2562.35, 2978.64, 3566.22, 7192.64, 11336.57, 21643.30, 28857.78, 86573.34, 10000000000];
            // Tabla ISR Semanal Cuota fija
            cuotaMensual = [0.00, 3.29, 85.61, 205.80, 272.37, 377.65, 1152.27, 2126.95, 5218.92, 7527.59, 27150.83];
            // Tabla ISR Semanal excedente
            porcMensual = [1.92, 6.40, 10.88, 16.00, 17.92, 21.36, 23.52, 30.00, 32.00, 34.00, 35.00];
            // Tabla subsidio Semanal hasta ingresos de
            ingSubMensual = [407.33, 610.96, 799.68, 814.66, 1023.75, 1228.57, 1433.32, 1638.07, 1699.88];
            // Tabla de subsidio ISR Semanal - Cantidad de subsidio para el empleo
            canSubMensual = [93.73, 93.66, 93.66, 90.44, 88.06, 81.55, 74.83, 67.83, 58.38, 50.12, 0.00];
            break;
        case "vquincenal":
            bruto1=bruto;
            dias = 15;
            //Tabla ISR Quinsenal limite inferior
            tablaMensual = [0.01, 368.11, 3124.36, 5490.76, 6382.81, 7641.91, 15412.81, 24292.66, 46378.51, 61838.11, 185514.31];
            // Tabla ISR Quincenal limite superior
            tablaMensualsup = [368.10, 3124.35, 5490.75, 6382.80, 7641.90, 15412.80, 24292.65, 46378.50, 61838.10, 185514.30, 10000000000];
            // Tabla ISR Quincenal Cuota fija
            cuotaMensual = [0.00, 7.05, 183.45, 441.00, 583.65, 809.25, 2469.15, 4557.75, 11183.40, 16130.55, 58180.35];
            // Tabla ISR Quincenal excedente
            porcMensual = [1.92, 6.40, 10.88, 16.00, 17.92, 21.36, 23.52, 30.00, 32.00, 34.00, 35.00];
            // Tabla subsidio Quincenal hasta ingresos de
            ingSubMensual = [872.85, 1309.20, 1713.60, 1745.70, 2193.75, 2327.55, 2632.65, 3071.40, 3510.15, 3642.60];
            // Tabla de subsidio ISR Quincenal - Cantidad de subsidio para el empleo
            canSubMensual = [200.85, 200.70, 200.70, 193.80, 188.70, 174.75, 160.35, 145.35, 125.10, 107.40, 0.00];
            break;
        case "vmensual":
            bruto1=bruto;
            dias = 30;
            tablaMensual = [0.01, 746.05, 6332.06, 11128.02, 12935.83, 15487.72, 31236.50, 49233.01, 93993.91, 125325.21, 375975.62];
            // Tabla ISR mensual limite superior
            tablaMensualsup = [746.04, 6332.05, 11128.00, 12935.8, 15487.7, 31236.5, 49233.00, 93993.9, 125325, 375976, 10000000000];
            // Tabla ISR mensual Cuota fija
            cuotaMensual = [0.00, 14.32, 371.83, 893.63, 1182.88, 1640.18, 5004.12, 9236.89, 22665.17, 32691.18, 117912.32];
            // Tabla ISR mensual excedente
            porcMensual = [1.92, 6.40, 10.88, 16.00, 17.92, 21.36, 23.52, 30.00, 32.00, 34.00, 35.00];
            // Tabla subsidio mensual hasta ingresos de
            ingSubMensual = [1768.96, 2653.38, 3472.84, 3537.87, 4446.15, 4717.18, 5335.42, 6224.67, 7113.90, 7382.33];
            // Tabla de subsidio ISR mensual - Cantidad de subsidio para el empleo
            canSubMensual = [407.02, 406.83, 406.62, 392.77, 382.46, 354.23, 324.87, 294.63, 253.54, 217.61, 0.00];
            break;
        case "vanual":
            bruto1=bruto;
            tablaMensual = [0.01, 8952.50, 75984.56, 133536.08, 155229.81, 185852.58, 374837.89, 590796.00, 1127926.85, 1503902.47, 4511707.38];
            // Tabla ISR anual limite superior
            tablaMensualsup = [2238.12, 75984.55, 133536.07, 155229.80, 185852.57, 374837.88, 590795.99, 1127926.84, 1503902.46, 4511707.37, 10000000000];
            // Tabla ISR anual Cuota fija
            cuotaMensual = [0.00, 171.88, 4461.94, 10723.55, 14194.54, 19682.13, 60049.40, 110842.74, 271981.99, 392294.17, 1414947.85];
            // Tabla ISR anual excedente                    
            porcMensual = [1.92, 6.40, 10.88, 16.00, 17.92, 21.3, 23.52, 30.00, 32.00, 34.00, 35.00];
            break
        default:
            break;
    }}

    // Tablas subsidio
    tablaSubsidioMensualinf = [0.01, 10171.01];
    tablaSubsidioMensualsup = [10171.00, 100000000000];
    subsidio = [475.00, 0.0];

    // Variables de usuario para calculo

    salario = bruto1
    riesgo = riesgo;
    parseInt(salario);
    parseFloat(riesgo);

    /* Variables Globales estaticas  */

    fintegracion = 1.0493; /* Factor de integracion para 2025 */
    uma = 113.14; /*    Valor de UMA 2025 */ 
    var sbc 
    if (mecanica === "PROYECTADA"){
        sbc = salarioingre * fintegracion; /* Calculo de Salario Base de Cotizacion mensual */
    }if (mecanica === "FIJA"){
        sbc = salario * fintegracion; /* Calculo de Salario Base de Cotizacion mensual */
    }
       /*dias=30;  Dias trabajados para calculo */
    sdi = sbc / dias; /* Calculo de Salario diario integrado */
    isn = 4.00 / 100; /* Porcentaje de ISN CDMX 2025 */
    tope_umas_imss = uma * 25;

    if (sdi > tope_umas_imss) {
        sdi = tope_umas_imss;
    }
    else {
    }
    /*porcentajes a aplicar cuotas imss*/

    pocentaje_cuotafija = 20.4 / 100;  /* cuota fija */
    porcentajep_i_ex = 1.10 / 100; /* excedente cuota fija patron */
    porcentajee_i_ex = 0.40 / 100; /* excedente cuota fija empleado */
    porcentajep_i_pd = 0.70 / 100; /* prestaciones en dinero patron*/
    porcentajee_i_pd = 0.25 / 100; /* prestaciones en dinero empleado*/
    porcentajep_i_gm = 1.05 / 100; /* gastos medicos para pensionados patron */
    porcentajee_i_gm = 0.375 / 100; /* gastos medicos para pensionados empleados */
    porcentajep_i_rt = riesgo / 100; /* riesgo de trabajo */
    porcentajep_i_iv = 1.75 / 100; /* invalidez y vida patron */
    porcentajee_i_iv = 0.625 / 100; /* invalidez y vida empleado */
    porcentajep_i_gg = 1.00 / 100; /* guarderia */
    porcentajep_i_re = 2.00 / 100; /* retiro */
    porcentajep_i_in = 5.00 / 100; /* infonavit */
    porccentajee_i_cv = 1.125 / 100; /* cesentia y vejez */
    porccentajep_i_cv = 0;

    /* Calculo de ISR */

    // buscamos el salario ingresado en las tablas de isr dentro de los rangos de lim inf y lim sup
    i = 0;
    limite_inferior = 0;
    limite_superior = 0;
    cuota_fija = 0;
    porcentaje_sobreex = 0;
    pro_i_cf = 0;
    z = 0;
    for (i = 0; i <= 10; i++) {
        if (salario >= tablaMensual[i] && salario <= tablaMensualsup[i]) {
            limite_inferior = tablaMensual[i];
            limite_superior = tablaMensualsup[i];
            cuota_fija = cuotaMensual[i];
            porcentaje_sobreex = porcMensual[i];
            break;
        }

    }
    // Buscamos el salario en la tabla de subsidio para determinar si es acreedor
    // inicializamos variables en 0 para el caso de un calculo anual de impuesto, el usuario no desea mostrar otro valor mas que el isr y el subsidio
    limite_inf_subsidio = 0;
    limite_sup_subsidio = 0;
    j = 0;
    valor_subsidio = parseFloat(sub);
    excedente = 0;
    porcentaje_excedente = 0;
    cuota_aplicada = 0;
    isr = 0;
    proe_i_ex = 0;
    prop_i_ex = 0;
    proe_i_pd = 0;
    prop_i_pd = 0;
    proe_i_gm = 0;
    prop_i_gm = 0;
    prop_i_rt = 0;
    proe_i_iv = 0;
    prop_i_iv = 0;
    prop_i_gg = 0;
    prop_i_re = 0;
    prop_i_in = 0;
    ccv = 0;
    prop_i_cv = 0;
    proe_i_cv = 0;
    imssp = 0;
    neto = 0;
    imss = 0;
    isnp = 0;
    costo = 0;
    tisr = 0;




    //Se calcula el excedente, restanto el salario menos el limite inferior
    excedente = salario - limite_inferior;
    //Se calcula el porentaje de excedente multiplicando el excedente anteriormente claculado por el % obtenido de la tabla de isr /100
    porcentaje_excedente = (excedente * porcentaje_sobreex) / 100;
    // Se calcula la cuota fija sumando el porcentaje de excedente mas la cuota obtenida en la tabla de isr
    cuota_aplicada = porcentaje_excedente + cuota_fija;
    // Se calcula el isr restando el salario menos la cuota fija obtenida en la tabla de isr
    isr = (salario - cuota_aplicada) + valor_subsidio;


    // Se calcula el subsidio al empleo restando el salario menos la cuota fija obtenida en la tabla de isr
    if (valor_subsidio <= 0) {
        for (j = 0; j <= 6; j++) {
            if (salario <= tablaSubsidioMensualsup[j]) {
                limite_inf_subsidio = tablaSubsidioMensualinf[j];
                limite_sup_subsidio = tablaSubsidioMensualsup[j];
                valor_subsidio = subsidio[j];
                break;
            }

        }

    //  PROYECTADO 

        //ISR PROYECTADO
    // EL salario debe ser mensualizado 
    // Buscar el limite inferior en la tabla mensual con salario mensualizado
    // resta de salario mensualizado menos limite inferior
        isr1 = salario - limite_inferior;
    // multiplicar por porcentaje de tablas
     isr2 = isr1 * (porcentaje_sobreex / 100);
    // despues sumar mas cuota fija de tablas
        isr3 = cuota_fija + isr2;
    // de la suma entre 30* dias
        isr4 = (isr3 / 30) * dias;


        // SUBSIDIO PROYECTADO
    
    Sub=(valor_subsidio/30)*dias;

    
if (mecanica === "PROYECTADA"){
    cuota_aplicada = isr4;
    valor_subsidio = Sub;
}if (mecanica === "FIJA"){
    cuota_aplicada = cuota_aplicada;
    valor_subsidio = valor_subsidio;
}

        // calculo de cuota imss        

        // Primer Bloque: Cuota Fija
        pro_i_cf = (dias * uma) * pocentaje_cuotafija;
        // Segundo bloque: Excedente de cuota fija 
        prop_i_ex = 0; /* provision excedente patron */
        proe_i_ex = 0; /* provision excedente empleado */
        z = uma * 3;
        if (sdi >= (uma * 3)) /* si el sbc supera 3 veces la uma */ {
            /* calculo de excedente patron */
            prop_i_ex = sdi - (uma * 3);
            prop_i_ex = prop_i_ex * dias;
            prop_i_ex = prop_i_ex * porcentajep_i_ex;
            /* Calculo de excedente empleado */
            proe_i_ex = sdi - (uma * 3);
            proe_i_ex = proe_i_ex * dias;
            proe_i_ex = proe_i_ex * porcentajee_i_ex;
        }
        else {
        }
        //Tercer bloque: Prestaciones en dinero
        //Calculo de parte patronal
        prop_i_pd = (sdi * dias) * porcentajep_i_pd;
        // Calculo de parte empleado
        proe_i_pd = (sdi * dias) * porcentajee_i_pd;
        //Cuarto bloque: Gastos medicos para pensionados
        prop_i_gm = (sdi * dias) * porcentajep_i_gm;
        proe_i_gm = (sdi * dias) * porcentajee_i_gm;
        // Quinto bloque: Riesgo de trabajo
        prop_i_rt = (sdi * dias) * porcentajep_i_rt;
        // Sexto Bloque: Invalidez y vida 
        prop_i_iv = (sdi * dias) * porcentajep_i_iv;
        proe_i_iv = (sdi * dias) * porcentajee_i_iv;
        // Septimo Bloque: Guarderia
        prop_i_gg = (sdi * dias) * porcentajep_i_gg;
        //Octavo bloque: Retiro
        prop_i_re = (sdi * dias) * porcentajep_i_re;
        //Noveno bloque: infonavit
        prop_i_in = (sdi * dias) * porcentajep_i_in;
        //Onceavo bloque: Cesentia y vejez

        // Tablas de cesentia
        limite_inf_cesentia = 0;
        limite_sup_cesentia = 0;
        ccv = 0;                        
        tablaMensualCV_inf = [248.93, 251.41, 283.98, 340.55, 397.12, 453.69];
        tablaMensualCV_sup = [248.93, 282.85, 339.42, 395.99, 452.56, 10000000000];
        tablaMensualCV_CV = [3.15, 4.954, 5.307, 5.559, 5.747, 6.422];
        k = 0;
        for (k = 0; k <= 6; k++) {
            if (sdi <= tablaMensualCV_sup[k]) {
                limite_inf_cesentia = tablaSubsidioMensualinf[k];
                limite_sup_cesentia = tablaSubsidioMensualsup[k];
                ccv = tablaMensualCV_CV[k];
            }
        }
        //Cesentia y vejez patronal
        proe_i_cv = (sdi * dias) * porccentajee_i_cv;
        prop_i_cv = (sdi * dias) * ccv / 100;

        //Calculo de ISN 4% CDMX 2025
        isnp = salarioingre * isn;

        //Calculo de IMSS empleado        
        imss = proe_i_ex + proe_i_pd + proe_i_gm + proe_i_iv + proe_i_cv;

        // Calculo IMSS para patron
        imssp = pro_i_cf + prop_i_ex + prop_i_pd + prop_i_gm + prop_i_rt + prop_i_iv + prop_i_gg + prop_i_cv + prop_i_re + prop_i_in;
        costo = imssp+isnp+prop_i_in;
        if (valor_subsidio >= cuota_aplicada) {
            tisr = 0;
        }


    }
    else { }


    


    // Total de ISR menos el subsidio al emlpeo
    tisr = cuota_aplicada - valor_subsidio;
    //Neto a pagar para empleado 
    var neto;
    if (mecanica === "PROYECTADA"){
        neto = salarioingre- (tisr+imss);
    } if (mecanica === "FIJA"){
      neto = (salario - tisr) - imss;
    }   
    
        // Impresion de valores en consola para validar en caso de requerir una revision detallada .. 
    console.log("++++ INICIO de proceso Bruto a Neto ++++");
    console.log("Salario capturado: " + salario + "");
    console.log("Salario original: " + salarioingre + "");
    console.log("Factor de integracion capturado: " + fintegracion + "");
    console.log("Prima de riesgo capturada: " + riesgo + "  ");
    console.log("SDI a considerar: " + sdi + "  ");
    console.log("el SBC a considerar" + sbc + "  ");
    console.log("Salario:" + salario + "");
    console.log("TABLA QUE CONSIDERA: " + tablaMensual + "");
    console.log("ISR PROYECTADOS: " + isr4 + "" );
    console.log("Limite inferior: " + limite_inferior + "");     
    console.log("Limite superior: " + limite_superior + "");
    console.log("Cuota fija: " + cuota_fija + "");
    console.log("Porcentaje: " + porcentaje_sobreex + "");
    console.log("Limite inferior de subsidio: " + limite_inf_subsidio + "");
    console.log("Limite superior de subsidio: " + limite_sup_subsidio + "");
    console.log("Valor de subsidio: " + valor_subsidio + "");
    console.log("Excedente: " + excedente + "");
    console.log("Porcentaje de excedente: " + porcentaje_excedente + "");
    console.log("ISR a aplicar: " + cuota_aplicada + "");
    console.log("Subsidio calculado: " + valor_subsidio + "");
    console.log("Salario menos ISR: " + isr + "");
    console.log(" /// DETERMINACION CUOTAS IMSS /// ");                      
    console.log("Salario Base Mensual: " + salario + "");
    console.log("Cuota fija determinada: " + pro_i_cf + " ");
    console.log("SDI: " + sdi + " condicion 3 veces la uma: " + z + "  ");
    console.log("Excedente empleado: " + proe_i_ex + "");
    console.log("Excedente patron: " + prop_i_ex + "  ");
    console.log("Prestaciones en dinero empleado: " + proe_i_pd + "");
    console.log("Prestaciones en dinero patron: " + prop_i_pd + "  ");
    console.log("Gastos medicos para pensionados empleado: " + proe_i_gm + "");
    console.log("Gastos medicos para pensionados patron: " + prop_i_gm + "  ");
    console.log("Riesgo de trabajo patron: " + prop_i_rt + "  ");
    console.log("Invalidez y vida empleado: " + proe_i_iv + "");
    console.log("Invalidez y vida patron: " + prop_i_iv + "  ");
    console.log("Guarderia patron: " + prop_i_gg + "  ");
    console.log("Retiro patron: " + prop_i_re + "  ");
    console.log("infonavit patron: " + prop_i_in + "  ");
    console.log("Porcentaje a aplicar: " + ccv);
    console.log("Cesentia y vejez patronal : " + prop_i_cv + "");
    console.log("Cesentia y vejez empleado : " + proe_i_cv + "");
    console.log("Suma de imss patron:" + imssp);
    console.log("Suma de imss empleado:" + imss);
    console.log("NETO!! :"+neto+ "");
    //console.log(Number(neto.toFixed(2)));

    return [neto, bruto, riesgo, cuota_aplicada, imss, valor_subsidio, imssp, prop_i_in, isnp, costo, tisr, limite_superior, limite_inferior, salario, cuota_fija, porcentaje_sobreex, proe_i_ex, proe_i_pd, proe_i_gm, proe_i_iv, proe_i_cv, proe_i_ex, prop_i_pd, prop_i_gm, prop_i_rt, prop_i_iv, prop_i_gg, prop_i_gg, prop_i_re, prop_i_in, prop_i_cv];
}

// Funcion para validar formulario de piramidador.. 
function formulario_piramidador() {
    const piramida = document.getElementById("piramida").value;
    const periodicidad = document.getElementById("periodicidad");
    const labelMensual = document.getElementById("vmensual");
    const labelNeto = document.getElementById("v_net");
    const opcionAnual = document.getElementById("idanual");
    const inputSubanual = document.getElementById("id_vsubanual");

    // Verificar si la opción seleccionada es "Bruto a Neto"
    if (piramida === "Bruto a Neto") {
        opcionAnual.style.display = "inline-block"; // Mostrar la opción Anual
        labelNeto.innerText = "Neto a pagar";
        switch (periodicidad.value) {
            case "vsemanal":
                labelMensual.innerText = "Base Semanal";
                inputSubanual.disabled = true;
                inputSubanual.value = "0.0";
                break;
            case "vquincenal":
                labelMensual.innerText = "Base Quincenal";
                inputSubanual.disabled = true;
                inputSubanual.value = "0.0";
                break;
            case "vmensual":
                labelMensual.innerText = "Base Mensual";
                inputSubanual.disabled = true;
                inputSubanual.value = "0.0";
                break;
            case "vanual":
                labelMensual.innerText = "Base Anual";
                inputSubanual.disabled = false; // Habilitar el input cuando se selecciona Anual
                break;
            default:
                labelMensual.innerText = "Bruto";
                inputSubanual.value = "0.0";
                inputSubanual.disabled = true;
                break;
        }
    } else if (piramida === "Neto a Bruto") {
        opcionAnual.style.display = "none"; // Ocultar la opción Anual
        inputSubanual.disabled = true; // Deshabilitar el input si no está seleccionado Anual
        inputSubanual.value = "0.0";
        labelMensual.innerText = "Neto";
        labelNeto.innerText = "Bruto estimado";
        switch (periodicidad.value) {
            case "vsemanal":
                labelMensual.innerText = "Neto Semanal";
                break;
            case "vquincenal":
                labelMensual.innerText = "Neto Quincenal";
                break;
            case "vmensual":
                labelMensual.innerText = "Neto Mensual";
                break;
            default:
                labelMensual.innerText = "Neto";
                break;
        }
        if (periodicidad.value === "vanual") {
            alert("¡Advertencia! No puedes seleccionar la opción 'Anual' cuando la pirámide es 'Neto a Bruto'.");
            location.reload();
        }
    } else {
        opcionAnual.style.display = "none"; // Ocultar la opción Anual
        inputSubanual.disabled = true; // Deshabilitar el input si no está seleccionado Anual
        labelMensual.innerText = "Bruto";
        labelNeto.innerText = "Neto a pagar";
    }
}


/***** Funciones para el proceso de calculos de baja y liquidacion  *******/


// funcion para adecuar el formulario dependiendo de que opcion se elija en el tipo de baja (finiquito/liquidacion)
function adecuacion_formulario() {


}
//funcion para procesar el calulo seleccionado por usuario
function procesa_calculo() {


}

//funcion para calcular finiquitos
function calculo_baja() {

    alert("Se considera para el salario diario integrado la prima vacacional que por ley es del 25% + días de aguinaldo");

    const baja = document.getElementById("idtbaja");
    const optionbaja = document.getElementById("idescenario1");
    var salariodiario = 419.88; // salario diario 2025    

    if (baja.value === "vliquidacion") {
        optionbaja.disabled = false;
    }

    // Días laborados histórico y del año 
    var fchinicio = new Date(document.getElementById("idfching").value);
    var fchsalida = new Date(document.getElementById("idfchbj").value);

    if (fchinicio <= fchsalida) {
        var diferen = fchsalida.getTime() - fchinicio.getTime(); // Diferencia en milisegundos
        var dilaborado = Math.round(diferen / (1000 * 60 * 60 * 24)); // Convertir a días

        // Calcular días desde el inicio del año para la fecha de salida
        var diaslabaño = Math.ceil((fchsalida - new Date(fchsalida.getFullYear(), 0, 1)) / (1000 * 60 * 60 * 24));

        // Calcular si el último año (año de fchsalida) es bisiesto
        var ultimoAño = fchsalida.getFullYear();
        var diasEnUltimoAño = (ultimoAño % 4 === 0 && (ultimoAño % 100 !== 0 || ultimoAño % 400 === 0)) ? 366 : 365;

        alert("Días laborados: " + dilaborado);
        alert("Días laborados en el año: " + diaslabaño);
        alert("El año " + ultimoAño + " tiene " + diasEnUltimoAño + " días.");
    } else if (fchsalida != null && fchsalida < fchinicio) {
        alert("La fecha de salida debe ser mayor o igual a la fecha inicial");
    }


    //tabla de vacaciones 2025
    var tbvacaciones = [0, 12, 14, 16, 18, 20, 22, 22, 22, 22, 22, 24, 24, 24, 24, 24, 26, 26, 26, 26, 26, 28, 28, 28, 28, 28, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30];

    var añolab = Math.floor(dilaborado / 365); // Redondea hacia abajo
    var divaca = tbvacaciones[añolab];

    alert("Años laborados: " + añolab);
    alert("Dias de vacaciones: " + divaca);

    //Dias a pendientes o a deber vacaciones
    const didisf = document.getElementById("id_vacdi").value;

    if (didisf <= divaca) {
        let vacrest = divaca - didisf;
        alert("Días por disfrutar = " + vacrest);
    } else if (didisf >= divaca) {
        let vacdebe = didisf - divaca;
        alert("Dias a descontar = " + vacdebe);
    }

    // Aguinaldo    
    var diasFaltas = parseInt(document.getElementById("idfaltas").value); // Obtiene las faltas como número
    var diaguipag = parseInt(document.getElementById("id_diaguipag").value);
    var saladi = parseFloat(document.getElementById("idsdi").value);
    var diaguipa;


    if (diaguipag <= 15) {
        diaguipa = 15;
        alert("Días pactados de aguinaldo a pagar debe ser minimo 15 dias")
    } else {
        diaguipa = diaguipag;
    }
    alert("Dias de aguinaldo a pagar: " + diaguipa);

    if (!isNaN(diasFaltas) && diasFaltas >= 0 && diasFaltas <= diasEnUltimoAño) {
        // Calcula los días de aguinaldo restando las faltas
        var diaPropoci = diaslabaño - diasFaltas;

        // Calcula la proporción de pago de aguinaldo
        var diaProporPaga = (diaPropoci * diaguipa) / diasEnUltimoAño;

        // Calcula el aguinaldo a pagar
        var agui = diaProporPaga * saladi;

        // Redondear a 2 decimales
        diaProporPaga = parseFloat(diaProporPaga.toFixed(2));
        agui = parseFloat(agui.toFixed(2));

        // Muestra los resultados
        alert("Días de aguinaldo a pagar con ausentismos: " + diaPropoci);
        alert("Proporción que le corresponde de pago de aguinaldo: " + diaProporPaga);
        alert("Salario diario: " + saladi);
        alert("Aguinaldo a pagar: " + agui);
    } else {
        alert("Por favor, ingresa un número válido de días de faltas.");
    }


    //Salario diario integrado

    var fint = (diaslabaño + (divaca * 0.25) + diaguipa) / diaslabaño;

    alert("Factor de integracion: " + fint);

    var sinte = fint * saladi;

    alert("Salario diario Integrado: " + sinte);

    //Antiguedad si ya cumplio 12 años 

    // si el salrio base excede al doble, si no lo exede se queda con ese pero si lo exede se queda con el minimo 
    if (salariodiario <= (salariodiario * 2)) {


    }

}

function calculo_liquidacion() // funcion para calcular liquidaciones 
{




}


// funcion de calculo ISR, iMSS PATRON Y EMPLEADO
function toggle(section) {
    const additionalFields = document.getElementById('additionalFields');
    const additionalFields2 = document.getElementById('additionalFields2');
    const additionalFields3 = document.getElementById('additionalFields3');
    
    if (section === 'fields1') {
        additionalFields.style.display = additionalFields.style.display === 'none' ? 'block' : 'none';
    }
    
    if (section === 'fields2') {
        additionalFields2.style.display = additionalFields2.style.display === 'none' ? 'block' : 'none';
    }

    if (section === 'fields3') {
        additionalFields3.style.display = additionalFields3.style.display === 'none' ? 'block' : 'none';
    }
}


function actualizarTooltip() {
    const mecanica = document.getElementById('mecanica').value;
    const tooltip = document.getElementById('v_sala_tooltip');
    tooltip.textContent = mecanica === 'FIJA' ? 'Salario fijo' : 'Salario Mensualizado';
}