$(init);

var zonaretos = [];
var notificaciones = [];

function init(){
    setUpZonaRetos();
    cargarJugadores();
    //los retadores se cargan al hacer click en la carta
    cargarRetadores();
    cargarNotificaciones();
    $('#carta-reto-box #jugador').on('keyup click', function(){
       buscarRetador($(this).val()); 
    });
    $('#retar').fancybox();
}

function setUpZonaRetos(){
    zonaretos.retos = {};
    zonaretos.notificaciones = [];
    zonaretos.jugadores = [];
    zonaretos.cartas = [];
    zonaretos.retadores = [];
}

function addNotificacion(contenido){
    var tmp = [];
    tmp.contenido = contenido;
    notificaciones.push(tmp);
}


function addJugador(nombre,rank,puntos,online,idjugador){
    var tmp = [];
    tmp.nombre = nombre;
    tmp.rank = rank;
    tmp.cartas = [];
    tmp.puntos = puntos;
    tmp.online = online;
    tmp.idjugador = idjugador;
    zonaretos.jugadores.push(tmp);
}

function addRetador(nombre, idjugador){
    var tmp = [];
    tmp.nombre = nombre;
    tmp.idjugador = idjugador;
    zonaretos.retadores.push(tmp);
}

function factoryJugadores(){
    var jugadores_html = '';
    for(var i=0;i<zonaretos.jugadores.length;i++){
        jugadores_html += '<tr><td>'+zonaretos.jugadores[i].nombre+'</td><td class="alinear">'+zonaretos.jugadores[i].rank+'</td><td class="alinear"><a href="#">Ver Cartas</a></td><td class="alinear">'+zonaretos.jugadores[i].puntos+'</td><td class="centrar"><img src="imgs/check.png"></td></tr>';
    }
    return jugadores_html;
}

function factoryNotificaciones(){
    var notificaciones_html = [];
    for(var i=0;i<notificaciones.length;i++){
        notificaciones_html.push('<li><a href="#">'+notificaciones[i].contenido+'</a></li>');
    }
    return notificaciones_html.join('');
}

function factoryRetadores(retadores){
    var retadores_html = [];
    for(var i=0;i<retadores.length;i++){
        if(i==0)
            retadores_html.push('<tr>');
        else
            if(i>0 && i%4==0)
                retadores_html.push('</tr><tr>');
        retadores_html.push('<td><input type="radio" name="retado">'+retadores[i].nombre+'</td>');
        if(i==(retadores.length - 1))
             retadores_html.push('</tr>');
    }
    return retadores_html.join('');
}

function cargarNotificaciones(){
    addNotificacion('Fabio14 te ha retado');
    addNotificacion('Fabio14 te ha retado');
    addNotificacion('Fabio14 te ha retado');
    addNotificacion('Fabio14 te ha retado');
    addNotificacion('Fabio14 te ha retado');
    addNotificacion('Fabio14 te ha retado');
    addNotificacion('Fabio14 te ha retado');
    addNotificacion('Fabio14 te ha retado');
    addNotificacion('Fabio14 te ha retado');
    addNotificacion('Fabio14 te ha retado');
    addNotificacion('Fabio14 te ha retado');
    
    $('#ul-main-arena').append(factoryNotificaciones());
}

function cargarJugadores(){
    addJugador('Kamilo Cervantes',1,8299,1,88);
    addJugador('Kamilo Cervantes',2,8199,1,86);
    addJugador('Kamilo Cervantes',3,6899,1,82);
    addJugador('Kamilo Cervantes',4,6699,1,51);
    addJugador('Kamilo Cervantes',5,8299,1,68);
    addJugador('Kamilo Cervantes',6,8199,1,36);

    $('#ranking table').append(factoryJugadores());
}

function cargarRetadores(){
    addRetador('Kamilo Cervantes',23);
    addRetador('Juan Perez',23);
    addRetador('adsadasdsadsw',23);
    addRetador('23sddas33',23);
    addRetador('sdfds55',23);
    addRetador('dfdsfdsfvvvrtertres',23);
    addRetador('Jose Lopex',23);
    addRetador('Ana Milena Castaño',23);
    $('#jugadores table').append(factoryRetadores(zonaretos.retadores));
}

function buscarRetador(parametro){
    var tmp = [];
    for(var i=0;i<zonaretos.retadores.length;i++){
        if(zonaretos.retadores[i].nombre.toLowerCase().indexOf(parametro.toLowerCase()) >= 0){
            tmp.push(zonaretos.retadores[i]);
            console.log(zonaretos.retadores[i].nombre.toLowerCase()+' - '+zonaretos.retadores[i].nombre.toLowerCase().indexOf(parametro.toLowerCase()));
        }
    }
    //console.log(tmp.join('-'));
    $('#jugadores table tr').remove();
    $('#jugadores table').append(factoryRetadores(tmp));
    console.log(factoryRetadores(tmp));
}
