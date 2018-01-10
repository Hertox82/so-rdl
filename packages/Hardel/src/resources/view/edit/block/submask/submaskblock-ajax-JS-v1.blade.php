@push('script')

<script>
    /**
     * Impostazioni e configurazione
     *
     * - La tabella dei dati deve essere inserita in un <div> che abbia come classe table_SubMaskAjaxTable
     * - Il messaggio di avviso che la tabella è vuota deve essere inderito in un <div> che abbia come classe table_SubMaskAjaxTableEmpty
     */
    var SubmaskBlockAjaxManager = function() {

        var modalHtml = new Array();

        /**
         * La funzione restituisce l'id del blocco su sui è stata richiesta la ricerca
         */
        var findMainDiv = function (obj) {
            var mainId = $(obj).closest('.SubmaskBlock').attr("id");
            return mainId;
        }

        /**
         * La funzione salva l'html di base in modo da utilizzarlo per il reset della modale
         */
        var saveModalHtml = function() {
            $('.SubmaskBlock').each(function() {
                var mainId = findMainDiv($(this));
                var blockId = $(this).attr("data-blockid");

                modalHtml[blockId] = $("#" + mainId + " .SubmaskBlockModalContainer").html();
            });
        }

        /**
         * Handle per il bottone di aggiungi
         */
        var handleInsertButton = function() {

            /**
             * Azione sul bottone di aggiungi
             */
            $(".insertButton").click(function() {
                var modalId = $(this).attr("data-modalid");
                var modal = $("#" + modalId);
                var mainId = findMainDiv($(this));
                var blockId = $("#" + mainId).attr("data-blockid");

                // Imposta l'informazione sul fatto che è un inserimento sulla modale
                modal.attr("data-row",-1);

                // Resetta i campi della modale
                modal.html(modalHtml[blockId]);
                handleSaveButton();

                // Apre la modale
                modal.modal('show');
            });
        }

        /**
         * Handle bottone di salvataggio della modale
         */
        var handleSaveButton = function() {

            $('.SubmaskBlock .saveChange').click(function () {
                var mainId = findMainDiv($(this));
                var urlModalSubmit = $("#" + mainId).attr("data-urlModalSubmit");
                var values = {};
                $.each($('#' + mainId + ' :input'), function (i, field) {
                    values[field.name] = field.value;
                });

                $('#' + mainId + ' .SubmaskBlockModalContainer .has-error').removeClass('has-error');

                $.ajax({
                    method: "GET",
                    url: urlModalSubmit,
                    data: values
                }).done(function (response) {
                    if(response.errors == 1) {
                        var Obj = response.data;
                        var keys = Object.keys(Obj);
                        var html = "";
                        for (var i = 0; i < keys.length; i++) {
                            $('#' + keys[i] + '_content').addClass('has-error');
                            html += "<li>" + Obj[keys[i]] + "</li> \n";
                        }
                        $('#' + mainId + ' .errors_ul').html(html);
                        $('#' + mainId + ' .errors').show();
                    }
                    else {
                        var Obj = response.data;
                        var countRows = parseInt($('#' + mainId).attr("data-rowCount"));
                        var newCount = countRows + 1;
                        var row = $('#' + mainId + ' .baseRow').html();
                        var keys = Object.keys(Obj);
                        var tipoInserimento = $('#' + mainId + ' .SubmaskBlockModalContainer').attr("data-row");

                        // Chiusura della modale
                        $('#' + mainId + ' .SubmaskBlockModalContainer').modal('hide');

                        // Cambio dei valori
                        for (var i = 0; i < keys.length; i++) {
                            var re = new RegExp("#" + keys[i] + "#", 'g');
                            row = row.replace(re, Obj[keys[i]]);
                        }
                        var re = new RegExp("#count#", 'g');
                        row = row.replace(re, newCount);
                        $('#' + mainId).attr("data-rowCount", newCount);

                        // Se è un inserimento
                        if(tipoInserimento == -1) {
                            // Aggiunta della riga
                            $('#' + mainId + ' .baseRow').closest('table tr.baseRow').before('<tr id="SubMaskRow-' + newCount + '">' + row + '</tr>');
                        }
                        // Se è una modifica
                        else {
                            rowInteressata = parseInt(tipoInserimento);
                            rowList = $("#" + mainId + " .table_SubMaskAjaxTable table tr");

                            rowList.each(function() {
                                idRow = $(this).attr("id");
                                if(idRow == 'SubMaskRow-' + rowInteressata) {
                                    $(this).replaceWith('<tr id="SubMaskRow-' + newCount + '">' + row + '</tr>');
                                }
                            });
                        }

                        // Rende visibile il blocco
                        checkViewOfTable(mainId);
                        handleUpdateButton();
                        handleDeleteButton();
                    }
                });

            });
        }

        /**
         * Handle sul bottone di delete
         */
        var handleDeleteButton = function() {

            $(".SubMaskDeleteButton").unbind('click');

            $(".SubMaskDeleteButton").click(function() {
                var mainId = findMainDiv($(this));
                var idRow = $(this).attr('data-count');
                var row = $("#" + mainId).find("#SubMaskRow-" + idRow);

                if(!row.hasClass('removeRow')) {
                    row.find(".SubMaskDelete").val(1);
                    row.addClass("removeRow");
                }
                else {
                    row.find(".SubMaskDelete").val(0);
                    row.removeClass("removeRow");
                }
            });
        }

        /**
         * Handle di modifica
         */
        var handleUpdateButton = function() {
            $(".updateButton").unbind('click').click(function() {
                var mainDiv = findMainDiv($(this));
                var blockId = $("#" + mainDiv).attr("data-blockid");
                var row = $(this).closest("tr");
                var modal = $("#SubmaskBlockModal-" + blockId);
                var rowId = row.attr("id");
                var rowIdSplit = rowId.split("-");
                rowNumber = rowIdSplit[1];

                row.find("input").each(function() {
                    var key = $(this).attr("name");
                    var value = $(this).val();

                    var splitKey = key.split("_");
                    key = splitKey[2];

                    modal.find("[name='"+key+"']").val(value);
                });

                modal.find(".errors").hide();
                modal.attr("data-row",rowNumber);
                modal.modal('show');
            });
        }

        /**
         * La funzione verifica lo stato della tabella dati ed eventualmente lancia il messaggio di avviso
         */
        var checkViewOfTable = function() {

            $('.SubmaskBlock').each(function() {
                var mainId = $(this).attr("id");
                var tableOfDataRow = $("#" + mainId + " .table_SubMaskAjaxTable tr").length;

                // Se ci sono meno di 2 righe la tabella è vuota
                if(tableOfDataRow <= 2) {
                    $("#" + mainId + " .table_SubMaskAjaxTableEmpty").css('display','block');
                    $("#" + mainId + " .table_SubMaskAjaxTable").css('display','none');
                }
                // Se ci sono più di 2 righe la tabella non è vuota
                else {
                    $("#" + mainId + " .table_SubMaskAjaxTable").css('display','block');
                    $("#" + mainId + " .table_SubMaskAjaxTableEmpty").css('display','none');
                }

                // Inserisce nel blocco l'informazione sul numero di righe inserite nella tabella dati
                if($("#" + mainId).attr("data-rowCount") == 0)
                    $("#" + mainId).attr("data-rowCount",tableOfDataRow-2);
            });

        }

        return{
            init: function()
            {
                checkViewOfTable();
                saveModalHtml();
                handleSaveButton();
                handleInsertButton();
                handleDeleteButton();
                handleUpdateButton();
            },
        }

    }();

    $(function() {
        SubmaskBlockAjaxManager.init();
    });
</script>

@endpush