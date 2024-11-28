/// LECTOR DE CONSTANCIA FISCAL PARA OBTENER DATOS DE CLIENTE ///


// AGREGAMOS LIBRERIA PARA MANIUPULAR PDF //
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';

// obetenemos el archivo cargado del html
const l=document.getElementById('pdf');
// declarando variables ( contadores )
var a=0;
var j=0;
var y=0;
var z=0;

// agregamos evento listener para correr la funcion en cuanto se cargue el archivo (evento= change)
l.addEventListener('change', function(ev)
{
    // obtenemos los txtbox del formulario para alterrarlos mas adelante.. 
    var nombre_cliente= document.getElementById('nncliente');
    var rfc=document.getElementById('nrfc');
    var calle_cliente=document.getElementById('ncalle');
    var nexterior=document.getElementById('nexterior');
    var ninterior=document.getElementById('ninterior');
    var cp=document.getElementById('ncp');
    var regimen=document.getElementById('nrf');
    
    //obtenemos el archivo y guardamos en la variable file
    var file = ev.target.files[0];
    // instanciamos un objeto tipo filereader para recorrer el pdf
    var reader = new FileReader();
    
    // leemos el archivo
    reader.onload = function(ev)
    {
        // creamos arreglo para poder recorrer todo el texto del pdf
        var typedarray = new Uint8Array(ev.target.result);

        //convertimos todo el texto del pdf en un arreglo para poder examinar el texto que lo contiene
        pdfjsLib.getDocument(typedarray).promise.then(function(pdf)
        {
            // creamos la variable text para guardar el texto del pdf y la variable numpages para guardar el numero de paginas del pdf
            var text = "";
            var numPages = pdf.numPages;

            //obtenemos la pagina 1 del pdf
            pdf.getPage(1).then(function(page)
            {
                //obtenemos el texto de la pagina y guardamos su contenido en content
                page.getTextContent().then(function(content)
                {
                    // iteramos content.items y guardamos el resultado en item
                    content.items.forEach(function(item)
                    {
                        // evaluamos cada item del arreglo item para buscar palabras clave y obtener el dato deseado de la consulta   
                        switch (item.str)
                        {
                            case 'RFC:':
                            z=j+2;
                            dato=content.items[z];
                            rfc.value=dato.str;
                            break;

                            case 'Denominación/Razón Social:':
                            z=j+2;
                            dato=content.items[z];
                            nombre_cliente.value=dato.str;
                            break;

                            case 'Nombre de Vialidad:':
                            z=j+2;
                            dato=content.items[z];
                            calle_cliente.value=dato.str;
                            break;

                            case 'Código Postal:':
                            z=j+1;
                            dato=content.items[z];
                            cp.value=dato.str;
                            break;

                            case 'Número Exterior:':
                            z=j+2;
                            dato=content.items[z];
                            nexterior.value=dato.str;
                            break;

                            case 'Número Interior:':
                            z=j+1;
                            dato=content.items[z];
                            ninterior.value=dato.str;
                            break;
                                  
                        }

                        /* guardamos el texto de cada ubicacion de la iteracion para imprimirlo y revisar 
                        text += "<p>" + item.str + "</p>";
                        console.log("contador: "+j+"  "+item.str);
                        */
                        j=j+1;
                    });
                });
            });
            
            //obtenemos la pgina 2 y repetimos el proceso para obtener el regimen fiscal
            pdf.getPage(2).then(function(page)
            {
                page.getTextContent().then(function(content)
                {
                    content.items.forEach(function(item)
                    {           
                        switch (item.str)
                        {
                            case 'Régimen':
                            a=y+6;
                            dato=content.items[a];
                            regimen.value=dato.str;
                            break;          
                        }              
                        /*text += "<p>" + item.str + "</p>";
                        console.log("contador pagina 2: "+y+"  "+item.str);*/
                        y=y+1;
                    });
                });
            });    
        });
    };
    reader.readAsArrayBuffer(file);
});
// funcion para recargar pagina y limpiar formulario
function limpia_form()
{
location.reload();
}