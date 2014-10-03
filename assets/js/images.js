$(function() {

    // Fancybox
    $('.fancybox').fancybox();

    var growlTemplate =
        '<div id="w0" class="alert col-xs-10 col-sm-10 col-md-3"><button type="button" class="close" data-growl="dismiss"><span aria-hidden="true">&times;</span></button>' +
        '<span data-growl="icon"></span>' +
        '<span data-growl="title"></span>' +
        '<span data-growl="message"></span>' +
        '<a href="#" data-growl="url"></a></div>';

    $(document).on('click', '#batch-delete', function (event) {
        event.preventDefault();

        //var ids = $('#gridview-container').yiiGridView('getSelectedRows');
        var ids = [];

        $('#gridview-container').find("input[name='selection[]']:checked").each(function () {
            ids.push($(this).parent().closest('tr').data('key'));
        });

        // @todo Remove first ajax request and translate in javascript (available in version 2.1)
        $.ajax({
            url: 'multiple-delete-confirm-message',
            type: 'POST',
            data: {
                'ids': ids.length
            },
            success: function (message) {

                bootbox.confirm(message, function (confirmed) {
                    if (confirmed) {

                        $.ajax({
                            url: 'multiple-delete',
                            type: 'POST',
                            data: {
                                'ids': ids
                            },
                            success: function (data) {

                                if (data.status == 1) {
                                    // Disable delete button
                                    $('#batch-delete').attr('disabled', true);

                                    // Success
                                    $.pjax.reload({container: '#grid-pjax'});

                                    // @todo Update code
                                    $.growl({
                                        message: ' ' + data.message,
                                        icon: 'glyphicon glyphicon-ok-sign'
                                    }, {
                                        type: 'success',
                                        class: 'alert col-xs-10 col-sm-10 col-md-3',
                                        template: growlTemplate

                                    });

                                } else {
                                    // @todo Do somehting

                                    // Fail
                                    console.log('fail');
                                }
                            }
                        });
                    }
                });
            }
        });
    });

    $(document).on('change', "#gridview-container .kv-row-select input, .select-on-check-all", function (event) {

        //var itemsChecked = $('#gridview-container').yiiGridView('getSelectedRows').length;
        var itemsChecked = $('#gridview-container .kv-row-select input:checked').length;

        var disabled = true;

        if (itemsChecked > 0) {
            disabled = false;
        }

        $('#batch-delete').attr('disabled', disabled);

    });

    $("#sortable").sortable({
        placeholder: "sortable-container col-xs-3 col-sm-2 ui-state-highlight",
        forcePlaceholderSize: true,
        delay: 150,
        distance: 5,
        //grid: [ 270, 270 ],
        //handle: ".handle",
        helper: "clone",
        items: '.handle',
        opacity: 0.5,
        sort: false,
        tolerance: "pointer",
        cursor: "move",
        containment: '#sortable',
        update: function (event, ui) {
            //var icon = '<img src="../../admin/images/icons/loading.gif" alt="Loading" title="Loading" />';
            //$('#icon').html(icon);

            var ids = $('#sortable').sortable('toArray');

            $.ajax({
                url: 'sort-pictures',
                type: 'POST',
                data: {ids: ids},
                dataType: 'json',
                success: function (data) {
                    if (data.status == 1) {

                        // @todo Update code
                        $.growl({
                            message: ' ' + data.message,
                            icon: 'glyphicon glyphicon-ok-sign'
                        }, {
                            type: 'success',
                            class: 'alert col-xs-10 col-sm-10 col-md-3',
                            template: growlTemplate

                        });

                        //var icon = '<img src="../../admin/images/icons/tick.png" alt="Saved" title="Saved" />';
                        //$('#icon').html(icon);
                    }
                }
            });
        }
    }).disableSelection();
});