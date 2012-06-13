/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(init);

var niveles = [];
var premios = [];

function init(){
    $('#niveles-agregar').fancybox();
    $('#niveles-quitar').on('click',quitarNivel);
    $('#addnivel').on('click',agregarNivel); 
    
    $('#premios-agregar').fancybox();
    $('#premios-quitar').on('click',quitarPremio);
    $('#addpremio').on('click',agregarPremio); 
}

function agregarPremio(){
    var tmp = [];
    tmp.posicion = $('#posicion_premio').val();
    tmp.premio = $('#valor_premio').val();
    premios.push(tmp);
    actualizarPremios();
    $('#fancybox-close').click();
    limpiarPremioForm();
}

function quitarPremio(event){
    event.preventDefault();
    if(premios.length > 0){
        premios.pop();
        actualizarPremios();
    }
}

function premiosToJson(){
    var json = '[{';
    for(premio in premios){
        json += '"'+premio+'":{';
        json += '"posicion": "'+premios[premio].posicion+'",';
        json += '"premio": "'+premios[premio].premio+'"';
        (premio < premios.length-1) ? json += '},' : json += '}';
    }
    json += '}]';
    return json;
}

function limpiarPremioForm(){
    $('#posicion_premio').val('');
    $('#valor_premio').val('');
}

function actualizarPremios(){
    $('.premio').remove();
    for(premio in premios){
        $('#premios').append('<tr class="premio"><td>'+premios[premio].posicion+'</td><td>'+premios[premio].premio+'</td>');
    }
    $('#premios_data').val(premiosToJson());
}

function agregarNivel(){
    //agregar validaciones
    var tmp = [];
    tmp.nombre = $('#nombre_nivel').val();
    tmp.min_puntos = $('#min_puntos_nivel').val();
    tmp.rango = $('#rango_nivel').val();
    niveles.push(tmp);
    actualizarNiveles();
    $('#fancybox-close').click();
    limpiarNivelForm();
}

function limpiarNivelForm(){
    $('#nombre_nivel').val('');
    $('#min_puntos_nivel').val('');
    $('#rango_nivel').val('');
}

function quitarNivel(event){
    event.preventDefault();
    if(niveles.length > 0){
        niveles.pop();
        actualizarNiveles();
    }
}

function nivelesToJson(){
    var json = '[{';
    for(nivel in niveles){
        json += '"'+nivel+'":{';
        json += '"nombre": "'+niveles[nivel].nombre+'",';
        json += '"min_puntos": "'+niveles[nivel].min_puntos+'",';
        json += '"rango": "'+niveles[nivel].rango+'"';
        (nivel < niveles.length-1) ? json += '},' : json += '}';
    }
    json += '}]';
    return json;
}

function actualizarNiveles(){
    $('.nivel').remove();
    for(nivel in niveles){
        $('#niveles').append('<tr class="nivel"><td>'+niveles[nivel].nombre+'</td><td>'+niveles[nivel].min_puntos+'</td><td>'+niveles[nivel].rango+'</td></tr>');
    }
    $('#niveles_data').val(nivelesToJson());
}

