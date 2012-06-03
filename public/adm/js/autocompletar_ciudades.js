/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(init);

var options, a, options_inst, a_inst;
var ciudades = [];
var instituciones = [];

function init(){
    options = { 
                serviceUrl:'/admin/Ciudades/autocompletar',
                onSelect: function(value, data)
                { 
                    agregarCiudad(value,data);
                }
              };
    a = $('#ciudad').autocomplete(options);
    options_inst = { 
                        serviceUrl:'/admin/Instituciones/autocompletar',
                        onSelect: function(value, data)
                        { 
                            agregarInstitucion(value,data);
                        },
                        params:
                            {
                                ciudades: ciudades.join(',')
                            }
                    };
    a_inst = $('#institucion').autocomplete(options_inst);
    
}

function agregarCiudad(value,data){
    $('#ciudad').val('');
    if(ciudades.indexOf(value)==-1)
        //ciudades.push(value);
        ciudades[data] = value;
    actualizarCiudades();
}

function quitarCiudad(event){
    event.preventDefault();
    var ciudad = $(this).attr('id');
    ciudades.splice(ciudad,1);
    actualizarCiudades();
}

function actualizarCiudades(){
    $('.ciudades').remove();
    var ciudades_id = '';
    for(ciudad in ciudades){
        $('#ciudad').after('<p class="ciudades label label-info"><a class="quitarciudad" id="'+ciudad+'" href="#"><i class="icon-remove icon-white"></i></a> '+ciudades[ciudad]+'</p>');
        ciudades_id += ciudad+';';
    }
    $('#ciudades_id').val(ciudades_id);
    $('.quitarciudad').on('click', quitarCiudad);
    a_inst.setOptions({ 
                        serviceUrl:'/admin/Instituciones/autocompletar',
                        onSelect: function(value, data)
                        { 
                            
                            agregarInstitucion(value,data);
                        },
                        params:
                            {
                                ciudades: ciudades.join(',')
                            }
                    }); 
}

function agregarInstitucion(value,data){
    $('#institucion').val('');
    if(instituciones.indexOf(value)==-1)
        //instituciones.push(value);
        instituciones[data] = value;
    actualizarInstituciones();
}

function actualizarInstituciones(){
    $('.instituciones').remove();
    var instituciones_id = '';
    for(institucion in instituciones){
        $('#institucion').after('<p class="instituciones label label-info"><a class="quitarinstitucion" id="'+institucion+'" href="#"><i class="icon-remove icon-white"></i></a> '+instituciones[institucion]+'</p>');
        instituciones_id += institucion+';';
    }
    $('#instituciones_id').val(instituciones_id);
    $('.quitarinstitucion').on('click', quitarInstitucion);
}

function quitarInstitucion(event){
    event.preventDefault();
    var institucion = $(this).attr('id');
    instituciones.splice(institucion,1);
    actualizarInstituciones();
}
