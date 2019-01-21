/*
This file is used for formatting pages layout
*/

$(document).ready(function () {
    // Members pages:
    // set maximum length for national id TextBox
    $('#national_id').keydown(function () {
        if (this.value.length > 14) {
            alert("الرقم القومي يجب أن يتكون من 14 رقم!");
            this.value = this.value.slice(0, 14);
        }
    }).change(function () {
        if (this.value.length < 14) {
            alert("الرقم القومي يجب أن يتكون من 14 رقم!");
            this.focus();
        }
    });

    // set maximum length for telephone
    $('#telephone').keydown(function () {
        if (this.value.length > 11) {
            alert("رقم الهاتف يجب ألا يزيد عن 11 رقم!");
            this.value = this.value.slice(0, 11);
        }
    });

    // Projects Pages
    // Format flat count
    $('#flat_count').change(function () {
        if ($(this).val().trim().length === 0) {
            $(this).val("0");
        }
    }).trigger('change');

    // Deposits Pages
    // Return member full name by member id
    $('#member_id').change(function () {
        if ($(this).val() === '' || $(this).val() === '0') {
            $('#full_name').val('برجاء اختيار رقم العضوية لتحديد اسم العضو !');
        }
        else {
            var id = $(this).val();
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {id: id},
                success: function (data) {
                    $('#full_name').val(data);
                }
            })
        }
    }).trigger('change');

    // set Maximum length for bank deposit no TextBox
    $('#bank_no').keydown(function () {
        if (this.value.length > 25) {
            alert("رقم إيصال البنك يجب ألا يزيد عن 25 رقم!");
            this.value = this.value.slice(0, 25);
        }
    });

    // set Maximum length for amounts TextBoxes
    $('.amount').keydown(function () {
        if (this.value.length > 10) {
            alert("المبلغ المحدد يجب ألا يزيد عن 10 أرقام!");
            this.value = this.value.slice(0, 7);
        }
    }).change(function () {
        // Calculate total amount
        if ($(this).val().trim().length === 0) {
            $(this).val("0");
        }
        $('#total').val(parseFloat($('#pre').val()) + parseFloat($('#monthly').val()) + parseFloat($('#quarterly').val()) + parseFloat($('#semi_annual').val()) + parseFloat($('#annual').val()) + parseFloat($('#contract').val()) + parseFloat($('#allocation').val()) + parseFloat($('#receipt').val()));
    }).trigger('change');
});