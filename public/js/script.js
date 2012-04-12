$(init);

var historias = [];
var carrera = [];

function init()
{
    cargarHistorias();
    setUpCarrera();
    $('.prueba').click(function(){
        var idprueba = $(this).attr('id');
        cargarPrueba($(this).attr('id'));
        $('#fancybox-close').click(function(){
            $('.historias').remove();
            actualizarEstadisticas();
        });
        $('#respuesta #enviar').click(function(){
            //validarRespuesta(idprueba, $(this).attr('id')); 
            validarRespuesta(idprueba, $('#answer').val()); 
        });
    });
    $('.prueba').fancybox();
}

function addHistoria(titulo, logo, logo_max, patrocinador, patrocinador_logo, enunciado, puntos, respuesta){
    var tmp = [];
    tmp.titulo = titulo; 
    tmp.logo = logo; 
    tmp.logo_max = logo_max;
    tmp.patrocinador = patrocinador;
    tmp.patrocinador_logo = patrocinador_logo;
    tmp.enunciado = enunciado;
    tmp.respuestas = [];
    tmp.cartas = [];
    tmp.puntos = puntos;
    tmp.respuesta = respuesta;
    historias.push(tmp);
}

function addHistoria2(titulo, logo, logo_max, patrocinador, patrocinador_logo, enunciado, puntos, correcta){
    var tmp = [];
    tmp.titulo = titulo; 
    tmp.logo = logo; 
    tmp.logo_max = logo_max;
    tmp.patrocinador = patrocinador;
    tmp.patrocinador_logo = patrocinador_logo;
    tmp.enunciado = enunciado;
    tmp.respuestas = [];
    tmp.cartas = [];
    tmp.puntos = puntos;
    tmp.correcta = correcta;
    historias.push(tmp);
}

function addRespuestas(idhistoria, respuestas){
    historias[idhistoria].respuestas = respuestas;
}

function addCartas(idhistoria, cartas){
    historias[idhistoria].cartas = cartas;
}

function cargarPrueba(idprueba){
    $('#container').after(pruebasFactory(idprueba));
}

function setUpCarrera(){
    carrera.puntos_acumulados = parseInt(0);
    carrera.respondidas = [];
    carrera.correctas = [];
    carrera.incorrectas = [];
}

function validarRespuesta(idprueba, respuesta){
    if(carrera.respondidas.indexOf(idprueba) == -1){
        carrera.respondidas.push(idprueba);
        console.log(historias[idprueba].respuesta+' == '+respuesta);
        if(historias[idprueba].respuesta == respuesta){
            carrera.correctas.push(idprueba);
            respuestaCorrecta();
            carrera.puntos_acumulados = parseInt(carrera.puntos_acumulados) + parseInt(historias[idprueba].puntos); 
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

function validarRespuesta2(idprueba, respuesta){
    if(carrera.respondidas.indexOf(idprueba) == -1){
        carrera.respondidas.push(idprueba);
        if(historias[idprueba].correcta == respuesta){
            carrera.correctas.push(idprueba);
            respuestaCorrecta();
            carrera.puntos_acumulados = parseInt(carrera.puntos_acumulados) + parseInt(historias[idprueba].puntos); 
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
    var progreso = (carrera.respondidas.length/historias.length)*100;
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
                      +         '<h2>'+historias[idhistoria].titulo+' ('+historias[idhistoria].puntos+' puntos)</h2>'
                      +      '<hr>'
                      +     ' <div class="span6">'
                      +         ' <div class="center">'
                      +             '<img src="'+historias[idhistoria].logo_max+'" style="width: 200px;">'
                      +         '</div>'
                      +      '</div>'
                      +      '<div class="span6" style="float:right;">'
                      +          '<div class="sponsor">'
                      +              '<p class="sponsor">Patrocinador:</p>'
                      +              '<img src="'+historias[idhistoria].patrocinador_logo+'">'
                      +              '<p>'+historias[idhistoria].patrocinador+'</p>'
                      +          '</div>'
                      +          '<div class="pregunta">'
                      +              '<p>'+historias[idhistoria].enunciado+'</p>'
                      +              '<ul class="respuestas" id="respuesta">'
                      +                 '<li><input type="text" name="answer" id="answer"></li>'  
                      +                 '<li><input type="button" name="enviar" id="enviar" class="btn" value="Enviar respuesta"></li>'
                      prueba_html += '</ul>'
                      +              '<ul class="controles">'
                      +                  '<li>'
                      +                      '<select>'
                      +                          '<option>Seleccione una carta...</option>'
                                      for(i=0;i<historias[idhistoria].cartas.length;i++)
                                          {
                                             prueba_html += '<option>'+historias[idhistoria].cartas[i]+'</option>'
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

function pruebasFactory2(idhistoria){
    var prueba_html = '<div style="display:none" class=".historias"><div id="historia-prueba">'
                      +      '<div class="row">'
                      +         '<h2>'+historias[idhistoria].titulo+' ('+historias[idhistoria].puntos+' puntos)</h2>'
                      +      '<hr>'
                      +     ' <div class="span6">'
                      +         ' <div class="center">'
                      +             '<img src="'+historias[idhistoria].logo_max+'" style="width: 200px;">'
                      +         '</div>'
                      +      '</div>'
                      +      '<div class="span6" style="float:right;">'
                      +          '<div class="sponsor">'
                      +              '<p class="sponsor">Patrocinador:</p>'
                      +              '<img src="'+historias[idhistoria].patrocinador_logo+'">'
                      +              '<p>'+historias[idhistoria].patrocinador+'</p>'
                      +          '</div>'
                      +          '<div class="pregunta">'
                      +              '<p>'+historias[idhistoria].enunciado+'</p>'
                      +              '<ul class="respuestas" id="respuesta">'
                                      for(i=0;i<historias[idhistoria].respuestas.length;i++)
                                          {
                                             prueba_html += '<li><input type="button" id="'+i+'" value="'+historias[idhistoria].respuestas[i]+'"></li>'
                                          }
                      prueba_html += '</ul>'
                      +              '<ul class="controles">'
                      +                  '<li>'
                      +                      '<select>'
                      +                          '<option>Seleccione una carta...</option>'
                                      for(i=0;i<historias[idhistoria].cartas.length;i++)
                                          {
                                             prueba_html += '<option>'+historias[idhistoria].cartas[i]+'</option>'
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
    var history_html = '<div class="table-cell"><div class="historys">' 
                            + '<header><h4>'+historias[2*idhistoria].titulo+'</h4></header>'
                            +    '<div class="tabla">'
                            +        '<div class="padding-no">'
                            +            '<img src="'+historias[2*idhistoria].logo+'" style="width: 72px; height: 94px;">'
                            +            '<a class="prueba" id="'+(2*idhistoria)+'" href="#historia-prueba"><h4>Ir a la Prueba</h4></a>'
                            +        '</div>'
                            +        '<div class="cell2">'
                            +            '<div>'
                            +                '<ul>'
                      //      +                    '<li><h4>'+historias[2*idhistoria].titulo+'</h4></li>'
                            +                    '<li><img src="'+historias[2*idhistoria].patrocinador_logo+'"><p class="Patrocinador">'+historias[2*idhistoria].patrocinador+'</p></li>'
                            +                '</ul>'
                            +            '</div>'
                            +               '<div>'
                            +                '<article>'+historias[2*idhistoria].enunciado 
                            +                '</article>'
                            +               '</div>'
                            +           '</div>'
                            +       '</div>'
                            +       '</div>'
                            + '<div class="historys">' 
                            + '<header><h4>'+historias[(2*idhistoria)+1].titulo+'</h4></header>'
                            +    '<div class="tabla">'
                            +        '<div class="padding-no">'
                            +            '<img src="'+historias[(2*idhistoria)+1].logo+'"  style="width: 72px; height: 94px;">'
                            +            '<a class="prueba" id="'+((2*idhistoria)+1)+'" href="#historia-prueba"><h4>Ir a la Prueba</h4></a>'
                            +        '</div>'
                            +        '<div class="cell2">'
                            +            '<div>'
                            +                '<ul>'
                            +                    '<li><img src="'+historias[(2*idhistoria)+1].patrocinador_logo+'"><p class="Patrocinador">'+historias[(2*idhistoria)+1].patrocinador+'</p></li>'
                            +                '</ul>'
                            +            '</div>'
                            +               '<div>'
                            +                '<article>'+historias[(2*idhistoria)+1].enunciado 
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
                'Prueba 1',
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
                'Prueba 4',
                'imgs/chica-aguila.jpg',
                'imgs/chica-aguila-max.jpg',
                'Bavaria',
                'imgs/babaria-logo.png',
                '¿Cual es el producto más vendido de Bavaria?',
                '100',
                'Aguila'
            );
    
    $('#historias').append(historiasFactory(0));
    $('#historias').append(historiasFactory(1));
}

