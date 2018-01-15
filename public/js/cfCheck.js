/**
 * Created by hadeluca on 12/01/18.
 */

var cfCheckManager = function() {

    var urlCf = 'http://webservices.dotnethell.it//codicefiscale.asmx/ControllaCodiceFiscale';
    var cfBool = false;
    var privacyBool = false;

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
                       //btn.prop("disabled", true);
                           cfBool = false;
                       }
                       else {
                           grp.addClass('has-error');
                           //btn.prop("disabled", true);
                           cfBool = false;
                       }

                   } else {
                       if(grp.hasClass('has-error')) {
                           grp.removeClass('has-error');
                           grp.addClass('has-success');
                           //btn.prop("disabled", false);
                           cfBool = true;
                       }
                       else {
                           grp.addClass('has-success');
                           //btn.prop("disabled", false);
                           cfBool = true;
                       }

                       if(cfBool == true && privacyBool == true) {
                           btn.prop("disabled", false);
                       }
                   }

               });
           }
        });
    }

    var handlePrivacy = function(){
        $('#privacy').click(function(){
            var btn = $('#regist');
            if($(this).is(':checked')) {
                privacyBool = true;
                if(cfBool == true && privacyBool == true) {
                    btn.prop("disabled", false);
                }
            } else {
                privacyBool = false;
                btn.prop("disabled", true);
            }
        })
    }
    return {
        init: function() {
            handleCf();
            handlePrivacy();
        }
    }
}();

$(function() {
    cfCheckManager.init();
});