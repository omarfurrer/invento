$(document).ready(function () {

    // LOG IN CREATE MODAL
    $('#modal-log-in-create').on('shown.bs.modal', function (e) {

        // hide expiry date input by default
        $('#modal-log-in-create #expiryDate_input').hide();

        // clear select element options
        $('#modal-log-in-create #item').empty();

        // clear all input values
        $('#modal-log-in-create').find('input,textarea,select').val('');

        // disable all inputs untill we get the list of items
        $('#modal-log-in-create').find('input,textarea,select').prop('disabled', true);

        // remove all validation errors and their css
        $('#modal-log-in-create div').removeClass('has-error');
        $('#modal-log-in-create p.text-danger').remove();

        // get items from server to populate 'items' select element
        $.ajax({
            type: 'GET',
            url: '/api/items',
            success: function (data) {
                var items = data.items;

                // insert default option
                $('#modal-log-in-create #item').append('<option value="">Select Item</option>');

                // populate items
                for (i = 0; i < items.length; i++) {
                    $('#modal-log-in-create #item').append('<option value="' + items[i].id + '">' + items[i].description + '</option>');
                }

                // enable all inputs since we successfuly received items
                $('#modal-log-in-create').find('input,textarea,select').prop('disabled', false);

                // handle expiry date input
                $("#modal-log-in-create #item").change(function () {
                    handleExpiryDateVisibility($(this).val());
                });

                // HELPERS
                function handleExpiryDateVisibility(id) {
                    var currentItem = getItem(id);
                    if (!currentItem) {
                        $('#modal-log-in-create #expiryDate_input').hide();
                    }
                    if (currentItem.expires) {
                        $('#modal-log-in-create #expiryDate_input').show();
                    } else {
                        $('#modal-log-in-create #expiryDate_input').hide();
                    }
                }

                function getItem(id) {
                    for (i = 0; i < items.length; i++) {
                        var arrayItemId = items[i].id;
                        if (id == arrayItemId) {
                            return items[i];
                        }
                    }
                    return false;
                }
            }
        });


    });
    // Handle form submission through ajax
    $("#modal-log-in-create form").submit(function (event) {

        // prevent form from submitting and refreshing page
        event.preventDefault();

        // disable submit button when submitting form to prevent double submissions
        $('#modal-log-in-create button[type="submit"]').prop('disabled', true);

        // wrap form in variable
        $form = $(this);

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function (data) {
                $('#modal-log-in-create').modal('toggle');
                var log = data.log;
                addLogToTable(log);
            },
            error: function (response) {
                var status = response.status;
                var content = response.responseJSON;
                // handle validation errors
                if (status === 422) {
                    // remove validation erros and css if to display new ones
                    $('#modal-log-in-create div').removeClass('has-error');
                    $('#modal-log-in-create p.text-danger').remove();

                    var errors = content.errors;
                    // loop on all returned errors and display them in the form
                    // using Object.keys() since we are looping on an object
                    Object.keys(errors).forEach(key => {
                        $('input[name="' + key + '"],select[name="' + key + '"]').parent().addClass('has-error');
                        $('input[name="' + key + '"],select[name="' + key + '"]').parent().append('<p class="text-danger">' + errors[key][0] + '</p>');
                    });

                }

            },
            complete: function () {
                // enable submit button after request has finished
                $('#modal-log-in-create button[type="submit"]').prop('disabled', false);
            }
        });

        // prevent normal form from submitting
        return false;
    });

    // LOG OUT CREATE MODAL
    $('#modal-log-out-create').on('shown.bs.modal', function (e) {

        // clear select element options
        $('#modal-log-out-create #item').empty();
        // clear all input values
        $('#modal-log-out-create').find('input,textarea,select').val('');
        // disable all inputs untill we get the list of items
        $('#modal-log-out-create').find('input,textarea,select').prop('disabled', true);
        // remove all validation errors and their css
        $('#modal-log-out-create div').removeClass('has-error');
        $('#modal-log-out-create p.text-danger').remove();

        // get items from server to populate 'items' select element

        $.ajax({
            type: 'GET',
            url: '/api/items',
            success: function (data) {
                var items = data.items;

                // insert default option
                $('#modal-log-out-create #item').append('<option value="">Select Item</option>');

                // populate items
                for (i = 0; i < items.length; i++) {
                    $('#modal-log-out-create #item').append('<option value="' + items[i].id + '">' + items[i].description + '</option>');
                }

                // enable all inputs since we successfuly received items
                $('#modal-log-out-create').find('input,textarea,select').prop('disabled', false);


                // Populate Item batches
                $("#modal-log-out-create #item").change(function () {

                    searchAndPopulateBatch($(this).val());

                });


                $('#batch').empty();
                $('#modal-log-out-create #batch').append('<option value="">Select Item to see batches</option>');


                // Helper Function

                function searchAndPopulateBatch(id) {

                    if (id != '') {

                        $.ajax({

                            type: 'GET',
                            url: '/api/items/' + id + '/batches',
                            success: function (data) {

                                var itemBatches = data.itemBatches;

                                $('#batch').empty();

                                for (i = 0; i < itemBatches.length; i++) {

                                    var currentDate = itemBatches[i].expiry_date;
                                    var formatedCurrentDate = moment(currentDate).format('DD/MM/YYYY');
                                    var currentQuanrity = itemBatches[i].current_quantity;


                                    $('#batch').append('<option value="' + itemBatches[i].id + '">' + currentQuanrity + ' Remaining - ' +
                                            ((currentDate == null) ? '(Does not expire' : 'Expires at: (' + formatedCurrentDate) +
                                            ')</option>');
                                }

                            }

                        });

                    } else {

                        $('#batch').empty();
                        $("#batch").append("<option value=''>Select Item to see batches</option>");

                    }


                }
            }
        });


    });

    $("#modal-log-out-create form").submit(function (event) {

        // prevent form from submitting and refreshing page
        event.preventDefault();

        // disable submit button when submitting form to prevent double submissions
        $('#modal-log-out-create button[type="submit"]').prop('disabled', true);

        // wrap form in variable
        $form = $(this);

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function (data) {
                $('#modal-log-out-create').modal('toggle');
                var log = data.log;
                addLogToTable(log);
            },
            error: function (response) {
                var status = response.status;
                var content = response.responseJSON;
                // handle validation errors
                if (status === 422) {
                    // remove validation erros and css if to display new ones
                    $('#modal-log-out-create div').removeClass('has-error');
                    $('#modal-log-out-create p.text-danger').remove();

                    var errors = content.errors;
                    // loop on all returned errors and display them in the form
                    // using Object.keys() since we are looping on an object
                    Object.keys(errors).forEach(key => {
                        $('input[name="' + key + '"],select[name="' + key + '"]').parent().addClass('has-error');
                        $('input[name="' + key + '"],select[name="' + key + '"]').parent().append('<p class="text-danger">' + errors[key][0] + '</p>');
                    });

                }

            },
            complete: function () {
                // enable submit button after request has finished
                $('#modal-log-out-create button[type="submit"]').prop('disabled', false);
            }
        });

        // prevent normal form from submitting
        return false;
    });

    function addLogToTable(log) {
        var createdDate = moment(log.created_at);

        var filterItemID = getParameterByName('item_id');
        var filterFromDate = getParameterByName('from_date') == null ? null : moment(getParameterByName('from_date'), "DD-MM-YYYY").startOf('day');
        var filterToDate = getParameterByName('to_date') == null ? null : moment(getParameterByName('to_date'), "DD-MM-YYYY").endOf('day');

        // handle updating log table if url is '/log'
        if (location.pathname.substr(1) === 'log'
                && (filterItemID == null || filterItemID == log.item.id)
                && (filterFromDate == null || filterFromDate <= createdDate)
                && (filterToDate == null || filterToDate >= createdDate)
                )
        {
            // clone first row
            var logRow = $('#new-row').clone().removeAttr('id').removeClass('hide');
            // change row cell values

            // In/Out
            if (log.in) {
                logRow.find('td').eq(0).html('<i class="fa fa-lg fa-sort-down text-success"></i>');
            } else {
                logRow.find('td').eq(0).html('<i class="fa fa-lg fa-sort-up text-danger"></i>');
            }
            // Item
            logRow.find('td').eq(1).html(log.item.description);
            // Quantity
            logRow.find('td').eq(2).html((log.in ? '+' : '-') + ' ' + log.quantity + ' ' + log.item.measurement_unit.name);
            // Remaining
            logRow.find('td').eq(3).html(log.item_current_quantity + ' ' + log.item.measurement_unit.name);
            // User
            logRow.find('td').eq(4).html(log.user.name);
            // Date
            logRow.find('td').eq(5).html(createdDate.format('DD-MM-YYYY'));

            logRow.find('td').eq(6).html(replaceAll(logRow.find('td').eq(6).html(), '{log_id}', log.id));

            // add cloned row to top of table
            $(logRow).prependTo("table > tbody");
        }
    }
});

function escapeRegExp(str) {
    return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}

function replaceAll(str, find, replace) {
    return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

function getParameterByName(name, url) {
    if (!url)
        url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
