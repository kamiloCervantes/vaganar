/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(init);

var options, a;

function init(){
    options = { serviceUrl:'/admin/Patrocinador/autocompletar',
                onSelect: function(value, data){ $('#patrocinador_id').val(data); }
              };
    a = $('#patrocinador').autocomplete(options);
}
