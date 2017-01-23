// Set the token for all ajax requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.main-tabs-control div').click(function () {
    var tab = $('#' + $(this).data('id'));

    if (tab.is(':hidden')) {
        $('.main-tabs-control div').removeClass('active');
        $(this).addClass('active');
        $('.main-tab').hide();
        tab.fadeIn(200);
    }
});

// Handler for edit row event
$('body').on('click', '.action-item.edit', function () {
    // Check if is available to change current row
    if (!$(this).parents('tr').hasClass('disabled')) {
        var row =  $(this).parents('tr');
        var editBtn = $(this);

        editBtn.toggleClass('active');
        row.toggleClass('active');

        if (editBtn.hasClass('active')) {
            editBtn.find('span').text('Save');
            editBtn.find('i').removeClass('fa-pencil').addClass('fa-check');
            row.find('input, select, span.value').toggle();
            $('.items-list tbody tr:not(.active)').addClass('disabled');
        } else {
            var action = $(this).data('action');
            var id = row.data('id') ? row.data('id') : false;
            var obj = {};

            row.find('input, select').each(function () {
                obj[$(this).attr('name')] = $(this).val();
            });

            // Request to controller
             $.post(action, {
                 'data': JSON.stringify(obj)
             }, function (data) {
             if (data.error === undefined) {
                 // If data is correct
                 if (!row.hasClass('new')) {
                     editBtn.find('span').text('Edit');
                     editBtn.find('i').removeClass('fa-check').addClass('fa-pencil');
                 }

                 row.find('input, select').hide();
                 $('.items-list tbody tr:not(.active)').removeClass('disabled');

                 var table = row.parents('.items-list');

                 if (id) {
                     var index = row.index();

                     table.find('tbody tr:eq(' + index +' )').remove();

                     if (index == 0) {
                         table.find('tbody').prepend(data);
                     } else {
                         table.find('tbody tr:eq(' + (index - 1) + ')').after(data);
                     }
                 } else {
                     table.find('tbody tr.new').before(data);
                     row.hide();
                 }

                 if (action == '/company/add') {
                     $('select[name="company_id"]').append($('<option>', {
                         val: $(data).data('id'),
                         text: $(data).find('input[name="name"]').val()
                     }));
                 }
             } else {
                 // If validator has fails
                 editBtn.toggleClass('active');
                 row.toggleClass('active');
                 alert(data.content);
             }
             })
             .fail(function() {
                 // If request status is different of 200
                 editBtn.toggleClass('active');
                 row.toggleClass('active');
                 alert('Error :(');
             });
        }
    }
});

// Handler for delete row event
$('body').on('click', '.action-item.del', function () {
    // Show confirm dialog
    if (confirm('Are you sure?')) {
        var row =  $(this).parents('tr');
        var action = $(this).data('action');

        // Request to controller
        $.post(action, {
        }, function (data) {
            if (data != '0') {
                // If data is correct
                row.remove();
                $('.items-list tbody tr:not(.active)').removeClass('disabled');
            } else {
                // If validator has fails
                alert(data);
            }
        }).fail(function() {
            // If request status is different of 200
            alert('Error :(');
        });
    }
});

// Handler for add row event
$('.action-item.add').click(function () {
    var row = $(this).parent().find('tr.new');
    row.find('input, select').val('').show();
    row.find('.action-item.edit').addClass('active');
    row.toggle();
});

// Handler for generating transfers
$('body').on('click', '.action-item.generate', function () {
    // Request to controller
    $.get('/generate', {
    }, function (data) {
        alert(data);
    }).fail(function() {
        // If request status is different of 200
        alert('Error :(');
    });
});

// Handler for report
$('body').on('click', '.action-item.report', function () {
    var offset = $(this).parent().find('select[name="month"]').val();

    // Request to controller
    $.get('/report/' + offset, {
    }, function (data) {
        $('.report-content tbody').html(data);
        $('.report-content').show();
    }).fail(function() {
        // If request status is different of 200
        alert('Error :(');
    });
});