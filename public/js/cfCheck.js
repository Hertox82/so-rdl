/**
 * Created by hadeluca on 12/01/18.
 */

var cfCheckManager = function() {

	var regExp = "/^(?:[B-DF-HJ-NP-TV-Z](?:[AEIOU]{2}|[AEIOU]X)|[AEIOU]{2}X|[B-DF-HJ-NP-TV-Z]{2}[A-Z]){2}[\dLMNP-V]{2}(?:[A-EHLMPR-T](?:[04LQ][1-9MNP-V]|[1256LMRS][\dLMNP-V])|[DHPS][37PT][0L]|[ACELMRT][37PT][01LM])(?:[A-MZ][1-9MNP-V][\dLMNP-V]{2}|[A-M][0L](?:[\dLMNP-V][1-9MNP-V]|[1-9MNP-V][0L]))[A-Z]$/i";

    // var urlCf = 'http://webservices.dotnethell.it/codicefiscale.asmx/ControllaCodiceFiscale';
    var cfBool = false;
    var privacyBool = false;

    var handleFocus = function() {
        $('#cod_fisc').focusin(function(){
            checkCF($(this).val());
        });
        $('#cod_fisc').focusout(function(){
            checkCF($(this).val());
        });
    }

    var checkCF = function (cod) {
		/* 2018.01.27 - Valerio */

		if (cod.length != 16 || preg_match(regExp, cod)) {
			// CF formalmente errato
            grp.removeClass("has-success has-error").addClass("has-error");
            cfBool = false;
		}
		else {
			// CF formalmente corretto
            grp.removeClass("has-success has-error").addClass("has-success");
            cfBool = true;
        }

        if (cfBool == true && privacyBool == true) {
            btn.prop("disabled", false);
        }
    }

    var handleCf = function() {
        $('#cod_fisc').unbind('keyup').keyup(function(){
           var cod = $(this).val();
           checkCF(cod);
        });
    }

    var checkBoth = function() {
        var code = $('#cod_fisc').val();
        checkCF(code);
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
            handleFocus();
            $(document).ready(function(){
                checkBoth();
            })
        }
    }
}();

$(function() {
    cfCheckManager.init();
});