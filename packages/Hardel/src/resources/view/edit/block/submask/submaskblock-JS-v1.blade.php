@push('script')

<script>
    var SubmaskBlockManager = function() {

        var spinner = function(Obj) {
            Obj.html('<div class="smo016_spinner margined"></div>');
        }

        var findMainDiv = function (obj) {
            var mainId = $(obj).closest('.SubmaskBlock').attr("id");
            return mainId;
        }

        var refreshBlock = function() {

            // Per ogni blocco dello stesso tipo presente in dom
            $(".SubmaskBlock").each(function() {

                var blockDomId = $(this).attr("id");
                var blockObj = $("#" + blockDomId);
                var blockId = $(blockObj).attr("data-blockid");
                var objId = $(blockObj).attr("data-objId");
                var urlList = $("#" + blockDomId).attr("data-urlList");

                spinner($("#" + blockDomId + " .portlet-body"));

                $.ajax({
                    method: "GET",
                    url: urlList,
                    data: { blockId: blockId, objId: objId }
                })
                    .done(function( resp ) {
                        $("#" + blockDomId + " .portlet-body").html(resp);
                    });
            });
        }

        var handleInsertButton = function() {

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

                    if (response.errors == 1) {
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
                        $('#' + mainId + ' .SubmaskBlockModalContainer').modal('hide');
                        $('#' + mainId + ' .SubmaskBlockModalContainer input[type="text"]').val('');
                        refreshBlock();
                    }
                });

            });
        }

        return{
            init: function()
            {
                refreshBlock();
                handleInsertButton();
            },

            refresh: function()
            {
                refreshBlock();
            }
        }

    }();

    $(function() {
        SubmaskBlockManager.init();
    });
</script>

@endpush
