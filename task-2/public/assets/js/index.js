$(document).ready(function () {
    $("#frm-submit-data").submit(function (event) {
        event.preventDefault();
        $("tr").each(function() {
            $(this).children().remove();
        });
        var ts = Math.round((new Date()).getTime() / 1000);
        $.post("backend.php", { 
            value: $('#valueInput').val(), 
            tax: $('#taxInput').val(), 
            time: Math.round((new Date()).getTime() / 1000),
            instalments: $('#instalmentInput').val() },
            function (result) {
                $('#headTable').append('<th></th>').append('<th>Policy</th>');
                $('#rowValue').append('<th>Value</th>').append('<th>' + result.value + '</th>');
                $('#rowBase').append('<th>Base Premium (' + result.basePriceChoice + '%)</th>').append('<th>' + result.basePrice + '</th>');
                $('#rowCommision').append('<th>Commission (17%) </th>').append('<th>' + result.commission + '</th>');
                $('#rowTax').append('<th>Tax (' + result.taxInput + '%) </th>').append('<th>' + result.tax + '</th>');
                $('#rowTotal').append('<th><b>Value</b></th>').append('<th>' + result.total + '</th>');
                $.each(result.payments, function(key, value) {
                    let instKey = key + 1;
                    $('#headTable').append('<th>' + instKey.toString() + ' instalment</th>')
                    $('#rowValue').append('<th></th>');
                    $('#rowBase').append('<th>' + value.basePrice + '</th>');
                    $('#rowCommision').append('<th>' + value.commission + '</th>');
                    $('#rowTax').append('<th>' + value.tax + '</th>');
                    $('#rowTotal').append('<th>' + value.total + '</th>');
            });
        });
    });
});