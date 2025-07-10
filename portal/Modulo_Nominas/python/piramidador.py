bruto= 15000
riesgo= 5.0
tbimpuestos= 'vmensual'
sub= 0.0
mecanica= 'PROYECTADA'

def bruto_neto(bruto, riesgo, tbimpuestos, sub, mecanica):
    
    salarioingre = bruto
    salario = bruto
    tablaMensual = [0] * 11
    tablaMensualsup = [0] * 11
    cuotaMensual = [0] * 11
    porcMensual = [0] * 11
    ingSubMensual = [0] * 11
    canSubMensual = [0] * 11

    if mecanica == "PROYECTADA":
        if tbimpuestos == "vsemanal":
            dias = 7
            bruto1 = (bruto / 7) * 30
        elif tbimpuestos == "vquincenal":
            dias = 15
            bruto1 = bruto * 2
        elif tbimpuestos == "vmensual":
            dias = 30
            bruto1 = bruto
        else:
            bruto1 = bruto
            dias = 30  # Default
        salario = bruto1

        tablaMensual = [0.01, 746.05, 6332.06, 11128.02, 12935.83, 15487.72, 31236.50, 49233.01, 93993.91, 125325.21, 375975.62]
        tablaMensualsup = [746.04, 6332.05, 11128.00, 12935.8, 15487.7, 31236.5, 49233.00, 93993.9, 125325, 375976, 10000000000]
        cuotaMensual = [0.00, 14.32, 371.83, 893.63, 1182.88, 1640.18, 5004.12, 9236.89, 22665.17, 32691.18, 117912.32]
        porcMensual = [1.92, 6.40, 10.88, 16.00, 17.92, 21.36, 23.52, 30.00, 32.00, 34.00, 35.00]


    limite_inferior = 0
    cuota_fija = 0
    porcentaje_sobreex = 0
    for i in range(len(tablaMensual)):
        if salario >= tablaMensual[i] and salario <= tablaMensualsup[i]:
            limite_inferior = tablaMensual[i]
            cuota_fija = cuotaMensual[i]
            porcentaje_sobreex = porcMensual[i]
            break

    # Aquí irían los cálculos de ISR, IMSS, neto, etc.
    excedente = salario - limite_inferior
    porcentaje_excedente = (excedente * porcentaje_sobreex) / 100
    cuota_aplicada = porcentaje_excedente + cuota_fija
    valor_subsidio = float(sub)
    tisr = cuota_aplicada - valor_subsidio
    neto = salario - (tisr) 

    return neto, salario, riesgo, cuota_aplicada, valor_subsidio, tisr

# Ejemplo de uso:
neto = bruto_neto(15000, 2.5, 'vmensual', 0, 'PROYECTADA')
print("NETO:", neto)
