
// Salary Controller
var salaryController = (function () {

	var data = {
	  inicial: 0,
	  limite: 0,
	  excedente: 0,
	  porcentaje: 0,
	  marginal: 0,
	  cuota: 0,
	  isr: 0,
	  imss: 0,
	  subsidio: 0,
	  final: 0,
	  temporal: 0,
	  diario: 0,
	  uma: 103.74,
	  factor: 1.0493,
	  dias: 0,
	  sbc: 0,
	  sdi: 0
	};
  
	var opciones = {
	  tipo: "Neto",
	  periodo: "Mensual",
	  subsidio: true,
	  imss: true,
	};
  
	// Tabla ISR mensual limite inferior
	var tablaMensual = [0.01, 746.05, 6332.06, 11128.02, 12935.83, 15487.72, 31236.50, 49233.01, 93993.91, 125325.21, 375975.62]
  
	// Tabla ISR mensual Cuota fija
	var cuotaMensual = [ 0.00, 14.32, 371.83, 893.63, 1182.88, 1640.18, 5004.12, 9236.89, 22665.17, 32691.18, 117912.32]
  
	// Tabla ISR mensual excedente
	var porcMensual = [ 1.92, 6.40, 10.88, 16.00, 17.92, 21.36, 23.52, 30.00, 32.00, 34.00, 35.00]
  
	// Tabla subsidio mensual hasta ingresos de
	var ingSubMensual = [ 1768.96, 2653.38, 3472.84, 3537.87, 4446.15, 4717.18, 5335.42, 6224.67, 7113.90, 7382.33]
	
	// Tabla de subsidio ISR mensual - Cantidad de subsidio para el empleo
	var canSubMensual = [ 407.02, 406.83, 406.62, 392.77, 382.46, 354.23, 324.87, 294.63, 253.54, 217.61, 0.00]
  
	var getTable = function(value) {

		return tablaMensual;
	  };
  
	var getCuota= function(value) {
  
		return cuotaMensual;
	};
  
	var getPorcentaje = function(value) {
  
		return porcMensual;
	};
  
	var getIngSub = function(value) {

		return ingSubMensual;
	};
  
	var getCanSub = function(value) {
		return canSubMensual;
	};
  
	var calcSBC = function(value) {
		data.dias = 30,
		data.sdi = data.inicial/data.dias;
		sbc = data.sdi * data.factor;

	  if (sbc > 2112.25) {
		sbc = 2112.25;
	  }
	  return sbc;
	};
  
	var calcIMSS = function(value){
	  if (value > (3 * data.uma)) {
		excedente = (value - (3 * data.uma)) * .004 * data.dias;
	  }
	  else {
		excedente = 0;
	  }
	  prestaciones = value * .0025 * data.dias;
	  pensionados = value * .00375 * data.dias;
	  invalidez = value * .00625 * data.dias;
	  cesantia = value * 0.01125 * data.dias;
	  imss = excedente + prestaciones + pensionados + invalidez + cesantia;
	  return imss;
	}
  
	var calculateSalary = function() {
	  var tabla, cuota, porcentaje, position, subsidioIng, subsidioCan, i;
	  tabla = getTable(opciones.periodo);
	  cuota = getCuota(opciones.periodo);
	  porcentaje = getPorcentaje(opciones.periodo);
	  subsidioIng = getIngSub(opciones.periodo);
	  subsidioCan = getCanSub(opciones.periodo);


	  for (i=0; i < tabla.length; i++) {
		if (data.inicial >= tabla[i] && data.inicial < tabla [i+1]) {
		  position = i;
		}
		else if (data.inicial >= tabla[tabla.length - 1]) {
		  position = tabla.length - 1;
		}
	  }
	  data.limite = tabla[position];
	  data.excedente = data.inicial - data.limite;
	  data.porcentaje = porcentaje[position];
	  data.cuota = cuota[position];
	  data.marginal = data.excedente * (data.porcentaje/100);
	  data.isr = data.cuota + data.marginal;
	  if (opciones.imss === true) {
		data.sbc = calcSBC(opciones.periodo);
		data.imss = calcIMSS(data.sbc);
	  }
	  if (opciones.subsidio === true) {
		for (i=0; i < subsidioIng.length; i++) {
		  if (data.inicial < subsidioIng[i]) {
			position = i;
			break;
		  }
		  else if (data.inicial >= subsidioIng[subsidioIng.length - 1]) {
			position = subsidioIng.length;
		  }
		}
		data.subsidio = subsidioCan[position];
		data.final = data.inicial - data.imss - data.isr + data.subsidio;
	  }
	  else if (opciones.subsidio === false) {
		data.final = data.inicial - data.imss - data.isr;
	  }
	};
  
	return {
  
	  updTipo: function (value) {
		opciones.tipo = value;
	  },
  
	  updPeriodo: function (value) {
		opciones.periodo = value;
	  },
  
	  updSubsidio: function (value) {
		opciones.subsidio = value;
	  },
  
	  updIMSS: function (value) {
		opciones.imss = value;
	  },
  
	  updInitial: function (value) {
		data.inicial = value;
	  },
  
	  getOptions : function(){
		return opciones;
	  },
  
	  resetValues: function () {
		data.inicial = 0;
		data.limite = 0;
		data.excedente = 0;
		data.porcentaje = 0;
		data.marginal = 0;
		data.cuota = 0;
		data.isr = 0;
		data.imss = 0;
		data.subsidio = 0;
		data.final = 0;
		data.temporal = 0;
		data.diario = 0;
		data.dias = 0;
		data.sbc = 0;
		data.sdi = 0;
	  },
  
	  getSalary: function() {
		return {
		  limite: data.limite,
		  excedente: data.excedente,
		  porcentaje: data.porcentaje,
		  marginal: data.marginal,
		  cuota: data.cuota,
		  isr: data.isr,
		  imss: data.imss,
		  subsidio: data.subsidio,
		  final: data.final
		}
	  },
  


/// CONDICION PARA TOMAR EL NETO Y PASARLO A BRUTO !!! ////////////////
	  updateSalary: function () {
		if (opciones.tipo === "Bruto") {
		  data.temporal = data.inicial;
		  while (data.final < data.temporal) {
			calculateSalary();
			data.inicial = data.inicial + .01 ;
		  }
		  data.final = data.inicial;
		}
		else {
		  calculateSalary();
		}
	  }
  
	};
  
  })();

// Aqui termina el calulo para burto a neto // 



  // UI Controller
  var UIController = (function() {
  
	var DOMstrings = {
	  txt1: '#texto_1',
	  txt2: '#texto_2',
	  txt3: '#texto_3',
	  txt4: '#texto_4',
	  txt5: '#texto_5',
	  txt6: '#texto_6',
	  txt7: '#texto_7',
	  txt6Res: '#texto_6',
	  txt7Res: '#texto_7',
	  netBtn: '#neto',
	  bruBtn: '#bruto',
	  semBtn: '#semanal',
	  quiBtn: '#quincenal',
	  menBtn: '#mensual',
	  semBtnRes: '#semanal',
	  quiBtnRes: '#quincenal',
	  menBtnRes: '#mensual',
	  calcBtn: '#calcular',
	  calcBtnRes: '#calcular-responsive',
	  iniValue: "#amount",
	  subChck: '#subsidio',
	  subShow: '#subsidio-hid',
	  imssChck: '#imss',
	  imssShow: '#imss-hid',
	  limLabel: '#lim-inferior',
	  excLabel: '#excedente',
	  porLabel: '#porc-excendete',
	  marLabel: '#imp-marginal',
	  cuoLabel: '#cuota-fija',
	  isrLabel: '#isr-determinado',
	  imssLabel: '#imss-empleo',
	  subLabel: '#subsidio-empleo',
	  finalLabel: '#sueldo-final',
	  finalLabelRes: '#sueldo-final',
	  periodDropwdown: '#s-period'
	};
  
	var formatNumber = function(num) {
	  var numSplit, int, dec;
	  num = Math.abs(num);
	  num = num.toFixed(2);
	  numSplit = num.split('.');
	  int = numSplit[0];
	  if (int.length > 3) {
		  int = int.substr(0, int.length - 3) + ',' + int.substr(int.length - 3, int.length);
	  }
	  dec = numSplit[1];
	  return int + '.' + dec;
	};
  
	return {
  
	  getInput: function() {
		return {
		  value: parseFloat(document.querySelector(DOMstrings.iniValue).value),
		};
	  },
  
	  checkMinValue: function (value) {
		console.log('checkMinValue', value)
	  },
  
	  changeNet: function() {
		var name, currentClass;
		name = document.querySelector(DOMstrings.netBtn);
		currentClass = name.className;
		if (currentClass = 'calculation_select') {
		  name.className="calculation_selected";
		  name = document.querySelector(DOMstrings.bruBtn);
		  name.className="calculation_select";
		  document.querySelector(DOMstrings.txt1).textContent = "Calculadora de sueldo bruto <> neto";
		  document.querySelector(DOMstrings.txt2).textContent = "Ingresa el sueldo bruto";
		  document.querySelector(DOMstrings.txt3).textContent = "Sueldo bruto ";
		  document.querySelector(DOMstrings.txt5).textContent = "Detalle de sueldo neto";
		  document.querySelector(DOMstrings.txt6).textContent = "Sueldo neto ";
		  document.querySelector(DOMstrings.txt6Res).textContent = "Sueldo neto ";
		}
	  },
  
	  changeBru: function() {
		var name, currentClass;
		name = document.querySelector(DOMstrings.bruBtn);
		currentClass = name.className;
		if (currentClass = 'calculation_select') {
		  name.className="calculation_selected";
		  name = document.querySelector(DOMstrings.netBtn);
		  name.className="calculation_select";
		  document.querySelector(DOMstrings.txt1).textContent = "Calculadora de sueldo bruto <> neto";
		  document.querySelector(DOMstrings.txt2).textContent = "Ingresa el sueldo neto";
		  document.querySelector(DOMstrings.txt3).textContent = "Sueldo neto ";
		  document.querySelector(DOMstrings.txt5).textContent = "Detalle de sueldo bruto";
		  document.querySelector(DOMstrings.txt6).textContent = "Sueldo bruto ";
		  document.querySelector(DOMstrings.txt6Res).textContent = "Sueldo bruto ";
		}
	  },
  
	  changeSem: function() {
		var name, currentClass;
		name = document.querySelector(DOMstrings.semBtn);
		currentClass = name.className;
		if (currentClass = 'boton_periodo texto_periodo') {
		  name.className="boton_periodo_selec texto_periodo_selec";
		  name = document.querySelector(DOMstrings.quiBtn);
		  name.className="boton_periodo texto_periodo";
		  name = document.querySelector(DOMstrings.menBtn);
		  name.className="boton_periodo texto_periodo";
		  document.querySelector(DOMstrings.txt4).textContent = "semanal";
		  document.querySelector(DOMstrings.txt7).textContent = "semanal";
		  document.querySelector(DOMstrings.txt7Res).textContent = "semanal";
		}
		name = document.querySelector(DOMstrings.semBtnRes);
		currentClass = name.className;
		if (currentClass = 'boton_periodo texto_periodo selec_btns') {
		  name.className="boton_periodo_selec texto_periodo_selec selec_btns";
		  name = document.querySelector(DOMstrings.quiBtnRes);
		  name.className="boton_periodo texto_periodo selec_btns";
		  name = document.querySelector(DOMstrings.menBtnRes);
		  name.className="boton_periodo texto_periodo selec_btns";
		  document.querySelector(DOMstrings.txt4).textContent = "semanal";
		  document.querySelector(DOMstrings.txt7).textContent = "semanal";
		  document.querySelector(DOMstrings.txt7Res).textContent = "semanal";
		}
	  },
  
	  changeQui: function() {
		var name, currentClass;
		name = document.querySelector(DOMstrings.quiBtn);
		currentClass = name.className;
		if (currentClass = 'boton_periodo texto_periodo') {
		  name.className="boton_periodo_selec texto_periodo_selec";
		  name = document.querySelector(DOMstrings.semBtn);
		  name.className="boton_periodo texto_periodo";
		  name = document.querySelector(DOMstrings.menBtn);
		  name.className="boton_periodo texto_periodo";
		  document.querySelector(DOMstrings.txt4).textContent = "quincenal";
		  document.querySelector(DOMstrings.txt7).textContent = "quincenal";
		  document.querySelector(DOMstrings.txt7Res).textContent = "quincenal";
		}
		name = document.querySelector(DOMstrings.quiBtnRes);
		currentClass = name.className;
		if (currentClass = 'boton_periodo texto_periodo selec_btns') {
		  name.className="boton_periodo_selec texto_periodo_selec selec_btns";
		  name = document.querySelector(DOMstrings.semBtnRes);
		  name.className="boton_periodo texto_periodo selec_btns";
		  name = document.querySelector(DOMstrings.menBtnRes);
		  name.className="boton_periodo texto_periodo selec_btns";
		  document.querySelector(DOMstrings.txt4).textContent = "quincenal";
		  document.querySelector(DOMstrings.txt7).textContent = "quincenal";
		  document.querySelector(DOMstrings.txt7Res).textContent = "quincenal";
		}
	  },
  
	  changeMen: function() {
		var name, currentClass;
		name = document.querySelector(DOMstrings.menBtn);
		currentClass = name.className;
		if (currentClass = 'boton_periodo texto_periodo') {
		  name.className="boton_periodo_selec texto_periodo_selec";
		  name = document.querySelector(DOMstrings.semBtn);
		  name.className="boton_periodo texto_periodo";
		  name = document.querySelector(DOMstrings.quiBtn);
		  name.className="boton_periodo texto_periodo";
		  document.querySelector(DOMstrings.txt4).textContent = "mensual";
		  document.querySelector(DOMstrings.txt7).textContent = "mensual";
		  document.querySelector(DOMstrings.txt7Res).textContent = "mensual";
		}
		name = document.querySelector(DOMstrings.menBtnRes);
		currentClass = name.className;
		if (currentClass = 'boton_periodo texto_periodo selec_btns') {
		  name.className="boton_periodo_selec texto_periodo_selec selec_btns";
		  name = document.querySelector(DOMstrings.semBtnRes);
		  name.className="boton_periodo texto_periodo selec_btns";
		  name = document.querySelector(DOMstrings.quiBtnRes);
		  name.className="boton_periodo texto_periodo selec_btns";
		  document.querySelector(DOMstrings.txt4).textContent = "mensual";
		  document.querySelector(DOMstrings.txt7).textContent = "mensual";
		  document.querySelector(DOMstrings.txt7Res).textContent = "mensual";
		}
	  },
  
	  displaySubsidio: function (state) {
		var currentClass = document.querySelector(DOMstrings.subShow);
		// if (state === true) {
		//   currentClass.style.visibility = "visible";
		//   currentClass.style.display = "";
		// }
		// else if (state === false) {
		//   currentClass.style.visibility = "hidden";
		//   currentClass.style.display = "none";
		// }
	  },
  
	  displayIMSS: function (state) {
		var currentClass = document.querySelector(DOMstrings.imssShow);
		// if (state === true) {
		//   currentClass.style.visibility = "visible";
		//   currentClass.style.display = "";
		// }
		// else if (state === false) {
		//   currentClass.style.visibility = "hidden";
		//   currentClass.style.display = "none";
		// }
	  },
  
	  displaySalary: function(obj) {
		document.querySelector(DOMstrings.limLabel).textContent = "$ " + formatNumber(obj.limite);
		document.querySelector(DOMstrings.excLabel).textContent = "$ " + formatNumber(obj.excedente);
		document.querySelector(DOMstrings.porLabel).textContent = obj.porcentaje + ' %';
		document.querySelector(DOMstrings.marLabel).textContent = "$ " + formatNumber(obj.marginal);
		document.querySelector(DOMstrings.cuoLabel).textContent = "$ " + formatNumber(obj.cuota);
		document.querySelector(DOMstrings.isrLabel).textContent = "$ " + formatNumber(obj.isr);
		document.querySelector(DOMstrings.imssLabel).textContent = "$ " + formatNumber(obj.imss);
		document.querySelector(DOMstrings.subLabel).textContent = "$ " + formatNumber(obj.subsidio);
		document.querySelector(DOMstrings.finalLabel).textContent = "$ " + formatNumber(obj.final) + " MXN";
		document.querySelector(DOMstrings.finalLabelRes).textContent = "$ " + formatNumber(obj.final) + " MXN";
	  },
  
	  getDOMstrings: function() {
		return DOMstrings;
	  }
  
	};
  
  })();
  
  // Global App Controller
  var controller = (function(salaryCtrl, UICtrl) {
  
	var checkboxes = [false, false]
	var someChecked = function (collection) {
	  return collection.some(function (node) {
		return node === true
	  })
	}
  
	var setupEventListeners = function() {
  
	  var DOM = UIController.getDOMstrings();
  
	  document.querySelector(DOM.calcBtn).addEventListener('click', ctrlNewSalary);
	  document.querySelector(DOM.calcBtnRes).addEventListener('click', ctrlNewSalary);
	  document.addEventListener('keypress', function(event) {
		if (event.keyCode === 13 || event.which === 13) {
			ctrlNewSalary();
		}
	  });
	  document.querySelector(DOM.netBtn).addEventListener('click', function() { ctrlTipo("Neto") });
	  document.querySelector(DOM.bruBtn).addEventListener('click', function() { ctrlTipo("Bruto") });
  
	  // botones seleccion periodo
	  document.querySelector(DOM.semBtn).addEventListener('click', function() { ctrlPeriodo("Semanal") });
	  document.querySelector(DOM.quiBtn).addEventListener('click', function() { ctrlPeriodo("Quincenal") });
	  document.querySelector(DOM.menBtn).addEventListener('click', function() { ctrlPeriodo("Mensual") });
  
	  // use selector on mobile
  
	  document.querySelector(DOM.periodDropwdown).addEventListener('change', function (event) {
		ctrlPeriodo(event.target.value);
	  }, false);
  
	  document.querySelector(DOM.semBtnRes).addEventListener('click', function() { ctrlPeriodo("Semanal") });
	  document.querySelector(DOM.quiBtnRes).addEventListener('click', function() { ctrlPeriodo("Quincenal") });
	  document.querySelector(DOM.menBtnRes).addEventListener('click', function() { ctrlPeriodo("Mensual") });
	  document.querySelector(DOM.subChck).addEventListener('change', function() {
		checkboxes[1] = !checkboxes[1]
		if(this.checked) {
		  ctrlSubsidio(true);
		} else {
		  ctrlSubsidio(false);
		}
	  });
	  document.querySelector(DOM.imssChck).addEventListener('change', function() {
		checkboxes[0] = !checkboxes[0]
		if(this.checked) {
		  ctrlIMSS(true);
		} else {
		  ctrlIMSS(false);
		}
	  });
  
	};
  
	var updateSalary = function() {
	  var salary;
	  salaryCtrl.updateSalary();
	  salary = salaryCtrl.getSalary();
	  UICtrl.displaySalary(salary);
	};
  
	var ctrlNewSalary = function () {
	  console.log("calcular...");
	  var input;
	  salaryCtrl.resetValues();
	  input = UICtrl.getInput();
  
  
	  var opts = salaryCtrl.getOptions()
	  var minValuesByPeriod = { 'SEMANAL': 1555.80, 'QUINCENAL': 3111.60, 'MENSUAL': 6223.20 }
	  var period = opts.periodo.toUpperCase()
	  var minValue = minValuesByPeriod[period]
  
	  if(opts.subsidio || opts.imss){
		// Fix for safari and ios browsers
		console.log("input.value" + input.value + "input--amount-for-safari" + $("#input--amount-for-safari").val());
		input.value = parseFloat($("#input--amount-for-safari").val());
		// end -- Fix for safari and ios browsers
  
		if(parseFloat(input.value || 0) < minValue) {
		  //console.log('error your value', input.value, 'minValue>', minValue, 'perido', period )
		  document.getElementById('alert-calculate').innerHTML = 'El sueldo bruto no puede ser inferior a $' + minValue;
		  return;
		}else {
		  document.getElementById('alert-calculate').innerHTML = '';
		}
	  }
  
	  // Fix for safari and ios browsers
	  console.log("input.value" + input.value + "input--amount-for-safari" + $("#input--amount-for-safari").val());
	  input.value = parseFloat($("#input--amount-for-safari").val());
	  // end -- Fix for safari and ios browsers
	  
	  if (input.value > 0) {
		salaryCtrl.updInitial(input.value);
		updateSalary();
	  }
	};
  
	var ctrlTipo = function (value){
	  if (value === "Neto") {
		UICtrl.changeNet();
		salaryCtrl.updTipo(value);
		UICtrl.displaySalary({
		  limite: 0,
		  excedente: 0,
		  porcentaje: 0,
		  marginal: 0,
		  cuota: 0,
		  isr: 0,
		  imss: 0,
		  subsidio: 0,
		  final: 0,
		  diario: 0,
		  dias: 0,
		  sbc: 0,
		  sdi: 0
		});
	  }
	  else if (value === "Bruto") {
		UICtrl.changeBru();
		salaryCtrl.updTipo(value);
		UICtrl.displaySalary({
		  limite: 0,
		  excedente: 0,
		  porcentaje: 0,
		  marginal: 0,
		  cuota: 0,
		  imss: 0,
		  isr: 0,
		  subsidio: 0,
		  final: 0,
		  diario: 0,
		  dias: 0,
		  sbc: 0,
		  sdi: 0
		});
	  }
	}
  
	var ctrlPeriodo = function (value){
	  if (value === "Semanal") {
		UICtrl.changeSem();
		salaryCtrl.updPeriodo(value);
		salaryCtrl.resetValues();
		ctrlNewSalary();
	  }
	  else if (value === "Quincenal") {
		UICtrl.changeQui();
		salaryCtrl.updPeriodo(value);
		salaryCtrl.resetValues();
		ctrlNewSalary();
	  }
	  else if (value === "Mensual") {
		UICtrl.changeMen();
		salaryCtrl.updPeriodo(value);
		salaryCtrl.resetValues();
		ctrlNewSalary();
	  }
	};
  
	var ctrlSubsidio = function (value){
	  UICtrl.displaySubsidio(value);
	  salaryCtrl.updSubsidio(value);
	  salaryCtrl.resetValues();
	  ctrlNewSalary();
	};
  
	var ctrlIMSS = function (value){
	  UICtrl.displayIMSS(value);
	  salaryCtrl.updIMSS(value);
	  salaryCtrl.resetValues();
	  ctrlNewSalary();
	};
  
	// var enablePopover = function () {
	//   $(function () {
	//     $('[data-toggle="popover"]').popover({
  
	//     })
	//     console.log('lkjkl')
	//   });
	// }
  
	return {
	  init: function() {
  
		UICtrl.displaySalary({
		  limite: 0,
		  excedente: 0,
		  porcentaje: 0,
		  marginal: 0,
		  cuota: 0,
		  isr: 0,
		  imss: 0,
		  subsidio: 0,
		  final: 0,
		  diario: 0,
		  sbc: 0,
		  sdi: 0
		});
  
		setupEventListeners();
  
		//enablePopover()
  
	  }
  };
  
  })(salaryController, UIController);
  
  controller.init();
  
  
  /*
  // Fix for safari and ios browsers
  function isSafari(){
	var isSafariBrowser = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);
	var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
	if (isSafariBrowser && iOS) {
		console.log("Safari on iOS!");
		return true;
	} else if(isSafariBrowser) {
		console.log("Safari.");
		return true;
	}else{
		console.log("is not Safari");
		return false;
	}
  }
  // end -- Fix for safari and ios browsers
  */
