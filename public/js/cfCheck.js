/**
 * Created by hadeluca on 12/01/18.
 */

var cfCheckManager = function() {

    var urlCf = 'http://webservices.dotnethell.it//codicefiscale.asmx/ControllaCodiceFiscale';
    var handleCf = function() {
        $('#cod_fisc').unbind('keyup').keyup(function(){
           var cod = $(this).val();
           if(cod.length >= 16) {
               $.ajax({
                   url: urlCf,
                   method: 'GET',
                   data: {CodiceFiscale: cod}
               }).done(function(response){
                   console.log(response);
                   var prova = response.activeElement.childNodes;
                   var text = prova[0].nodeValue;
                   var grp = $('#codF');
                   var btn = $('#regist');
                   if(text == 'Il codice non è valido!') {

                       if(grp.hasClass('has-success')) {
                           grp.removeClass('has-success');
                           grp.addClass('has-error');
                       btn.prop("disabled", true);
                       }
                       else {
                           grp.addClass('has-error');
                           btn.prop("disabled", true);
                       }

                   } else {
                       if(grp.hasClass('has-error')) {
                           grp.removeClass('has-error');
                           grp.addClass('has-success');
                           btn.prop("disabled", false);
                       }
                       else {
                           grp.addClass('has-success');
                           btn.prop("disabled", false);
                       }
                   }

               });
           }
        });
    }
    return {
        init: function() {
            handleCf();
        }
    }
}();

$(function() {
    cfCheckManager.init();
});