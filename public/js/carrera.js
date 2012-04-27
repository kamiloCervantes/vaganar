$(init);

var carrera = [];

function init(){
    setUpCarrera();
    cargarHistorias();
    actualizarPruebas();
    $('.prueba').click(function(){
        var idprueba = $(this).attr('id');
        cargarPrueba($(this).attr('id'));
        $('#fancybox-close').click(function(){
            $('.historias').remove();
            actualizarEstadisticas();
            actualizarPruebas();         
        });
        $('#respuesta #enviar').click(function(){
            //validarRespuesta(idprueba, $(this).attr('id')); 
            validarRespuesta(idprueba, $('#answer').val()); 
        });
    });
    $('.prueba').fancybox();
}

function getLength(Object){
    var count = 0;
    for(var i in Object){
        count++;
    }    
    return parseInt(count);
}

function actualizarPruebas(){
    for(var i=0;i<carrera.respondidas.length;i++){
        if(carrera.correctas.indexOf(carrera.respondidas[i])!= -1){
            pruebaCorrecta(carrera.respondidas[i]);
        }
        else{
            pruebaIncorrecta(carrera.respondidas[i]);
        }
    }
}

function pruebaCorrecta(idprueba){
    $('a#'+idprueba).replaceWith('<h4 class="superada">Prueba superada</h4>');
}

function pruebaIncorrecta(idprueba){
    
}

function addHistoria(posicion, idprueba, titulo, logo, logo_max, patrocinador, patrocinador_logo, enunciado, puntos, respuesta){
    var tmp = {};
    tmp.titulo = titulo; 
    tmp.logo = logo; 
    tmp.logo_max = logo_max;
    tmp.patrocinador = patrocinador;
    tmp.patrocinador_logo = patrocinador_logo;
    tmp.enunciado = enunciado;
    tmp.cartas = [];
    tmp.puntos = puntos;
    tmp.respuesta = respuesta;
    tmp.idprueba = idprueba;
    carrera.historias[posicion] = tmp;
}

function addRespuestas(idhistoria, respuestas){
    carrera.historias[idhistoria].respuestas = respuestas;
}

function addCartas(idhistoria, cartas){
    carrera.historias[idhistoria].cartas = cartas;
}

function cargarPrueba(idprueba){
    $('#container').after(pruebasFactory(idprueba));
}

function setUpCarrera(){
    carrera.puntos_acumulados = parseInt(0);
    carrera.respondidas = [];
    carrera.correctas = [];
    carrera.incorrectas = [];
    carrera.historias = {};
}

function validarRespuesta(idprueba, respuesta){
    if(carrera.respondidas.indexOf(idprueba) == -1){
        carrera.respondidas.push(idprueba);
        if(carrera.historias[idprueba].respuesta == respuesta){
            carrera.correctas.push(idprueba);
            respuestaCorrecta();
            carrera.puntos_acumulados = parseInt(carrera.puntos_acumulados) + parseInt(carrera.historias[idprueba].puntos); 
        }
        else{
            carrera.incorrectas.push(idprueba);
            respuestaEquivocada();
        }
    }       
    else{
        respuestaActual(idprueba);
    }
}

function actualizarEstadisticas(){
    $('#puntos a').text(carrera.puntos_acumulados);
    $('#pruebas a').text(carrera.respondidas.length);
    var progreso = (carrera.respondidas.length/getLength(carrera.historias))*100;
    $('#progreso a').text(progreso+'%');
}

function respuestaActual(idprueba){
    $('.alert').remove();
    if(carrera.respondidas.indexOf(idprueba) != -1){
        if(carrera.incorrectas.indexOf(idprueba) != -1){
            //$('#respuesta').append('<div class="alert error"><p>Pregunta Bloqueada</p></div>');
            alert("Pregunta Bloqueada");
            $('#respuesta input').css('background','red');
        } 
        else{
            if(carrera.correctas.indexOf(idprueba) != -1){
                //$('#respuesta').append('<div class="alert error"><p>Pregunta Respondida</p></div>');
                alert("Pregunta Respondida");
                $('#respuesta input').css('background','green');
            }
        }
    }  
}

function respuestaEquivocada(){
    $('.alert').remove();
    $('#respuesta input').css('background','red');
    alert("Respuesta Incorrecta");
    //$('#respuesta').append('<div class="alert error"><p>Respuesta Incorrecta</p></div>');
}

function respuestaCorrecta(){
    $('.alert').remove();
    //$('#respuesta input[id!='+historias[idprueba].correcta+']').css('background','red');
    $('#respuesta input').css('background','#007D48');
    //$('#respuesta').append('<div class="alert success"><p>Respuesta Correcta!</p></div>');
    alert("Respuesta Correcta!");
}

function pruebasFactory(idhistoria){
    var prueba_html = '<div style="display:none" class="historias"><div id="historia-prueba">'
                      +      '<div class="row">'
                      +         '<h2>'+carrera.historias[idhistoria].titulo+' ('+carrera.historias[idhistoria].puntos+' puntos)</h2>'
                      +      '<hr>'
                      +     ' <div class="span6">'
                      +         ' <div class="center">'
                      +             '<img src="'+carrera.historias[idhistoria].logo_max+'" style="width: 200px;">'
                      +         '</div>'
                      +      '</div>'
                      +      '<div class="span6" style="float:right;">'
                      +          '<div class="sponsor">'
                      +              '<p class="sponsor">Patrocinador:</p>'
                      +              '<img src="'+carrera.historias[idhistoria].patrocinador_logo+'">'
                      +              '<p>'+carrera.historias[idhistoria].patrocinador+'</p>'
                      +          '</div>'
                      +          '<div class="pregunta">'
                      +              '<p>'+carrera.historias[idhistoria].enunciado+'</p>'
                      +              '<ul class="respuestas" id="respuesta">'
                      +                 '<li><input type="text" name="answer" id="answer"></li>'  
                      +                 '<li><input type="button" name="enviar" id="enviar" class="btn" value="Enviar respuesta"></li>'
                      prueba_html += '</ul>'
                      +              '<ul class="controles">'
                      +                  '<li>'
                      +                      '<select>'
                      +                          '<option>Seleccione una carta...</option>'
                                      for(i=0;i<carrera.historias[idhistoria].cartas.length;i++)
                                          {
                                             prueba_html += '<option>'+carrera.historias[idhistoria].cartas[i]+'</option>'
                                          }
                     
                      prueba_html += '</select>'
                      +                      '<input type="button" value="Usar"/>'
                      +                  '</li>'
                      +              '</ul>'
                      +          '</div>'
                      +      '</div>'
                      +   '</div>'
                      +   '</div></div>';
      return prueba_html;

}

function historiasFactory(idhistoria){
    var history_html = '<div class="table-cell"><div class="historys" id="historia'+(2*idhistoria)+'">' 
                            + '<header><h4>'+carrera.historias[2*idhistoria].titulo+'</h4></header>'
                            +    '<div class="tabla">'
                            +        '<div class="padding-no">'
                            +            '<img src="'+carrera.historias[2*idhistoria].logo+'" style="width: 72px; height: 94px;">'
                            +            '<a class="prueba" id="'+(2*idhistoria)+'" href="#historia-prueba"><h4>Ir a la Prueba</h4></a>'
                            +        '</div>'
                            +        '<div class="cell2">'
                            +            '<div>'
                            +                '<ul>'
                      //      +                    '<li><h4>'+historias[2*idhistoria].titulo+'</h4></li>'
                            +                    '<li><img src="'+carrera.historias[2*idhistoria].patrocinador_logo+'"><p class="Patrocinador">'+carrera.historias[2*idhistoria].patrocinador+'</p></li>'
                            +                '</ul>'
                            +            '</div>'
                            +               '<div>'
                            +                '<article>'+carrera.historias[2*idhistoria].enunciado 
                            +                '</article>'
                            +               '</div>'
                            +           '</div>'
                            +       '</div>'
                            +       '</div>'
                            + '<div class="historys id="historia'+((2*idhistoria)+1)+'">' 
                            + '<header><h4>'+carrera.historias[(2*idhistoria)+1].titulo+'</h4></header>'
                            +    '<div class="tabla">'
                            +        '<div class="padding-no">'
                            +            '<img src="'+carrera.historias[(2*idhistoria)+1].logo+'"  style="width: 72px; height: 94px;">'
                            +            '<a class="prueba" id="'+((2*idhistoria)+1)+'" href="#historia-prueba"><h4>Ir a la Prueba</h4></a>'
                            +        '</div>'
                            +        '<div class="cell2">'
                            +            '<div>'
                            +                '<ul>'
                            +                    '<li><img src="'+carrera.historias[(2*idhistoria)+1].patrocinador_logo+'"><p class="Patrocinador">'+carrera.historias[(2*idhistoria)+1].patrocinador+'</p></li>'
                            +                '</ul>'
                            +            '</div>'
                            +               '<div>'
                            +                '<article>'+carrera.historias[(2*idhistoria)+1].enunciado 
                            +                '</article>'
                            +               '</div>'
                            +           '</div>'
                            +       '</div>'
                            +    '</div>'
                            +    '</div>';

     return history_html;
}


function cargarHistorias(){
    
    //historia 1
    addHistoria(
                0,23,
                'Prueba 1',
                'imgs/chica-aguila.jpg',
                'imgs/chica-aguila-max.jpg',
                'Bavaria',
                'imgs/babaria-logo.png',
                '¿Cual es el producto más vendido de Bavaria?',
                '100',
                'Aguila'
            );
    
    //historia 2
    addHistoria(
                1,33,
                'Prueba Chevrolet',
                'imgs/camaro.jpg',
                'imgs/camaro.jpg',
                'Chevrolet',
                'imgs/chevrolet-logo.png',
                '¿En que película salió este automóvil? (Chevrolet Camaro SS)',
                '100',
                'Transformers'
            );                           
    
    //historia 3
    addHistoria(
                2,89,
                'Prueba 3',
                'imgs/chica-aguila.jpg',
                'imgs/chica-aguila-max.jpg',
                'Bavaria',
                'imgs/babaria-logo.png',
                '¿Cual es el producto más vendido de Bavaria?',
                '100',
                'Aguila'
            );
                           
     //historia 4
    addHistoria(
                3,87,
                'Prueba 4',
                'imgs/chica-aguila.jpg',
                'imgs/chica-aguila-max.jpg',
                'Bavaria',
                'imgs/babaria-logo.png',
                '¿Cual es el producto más vendido de Bavaria?',
                '100',
                'Aguila'
            );
    //console.log(carrera.historias.length);
    $('#historias').append(historiasFactory(0));
    $('#historias').append(historiasFactory(1));
}
