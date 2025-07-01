$('.alphaSpc').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 8 || keycode == 32 || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets and space allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphaSpc').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets and space allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphaSpcDot').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 46 || keycode == 8 || keycode == 32 || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, space and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphaSpcDot').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z.\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, space and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z.\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphaSpcDotDash').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 45 || keycode == 46 || keycode == 8 || keycode == 32 || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, dash(-), space and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphaSpcDotDash').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z.\-\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, dash(-), space and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z.\-\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphaSpcCommaDotDash').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 45 || keycode == 44 || keycode == 46 || keycode == 8 || keycode == 32 || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, space, comma, dash(-), and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphaSpcCommaDotDash').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z.\-,\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, space, comma, dash(-), and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z.\-,\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphaSpcCommaDot').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 44 || keycode == 46 || keycode == 8 || keycode == 32 || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, space, comma and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphaSpcCommaDot').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z.,\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, space, comma and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z.,\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphNumDasSpcDotSLACE').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var fieldmaxlen = $(this).attr('maxlength');

    if (!((keycode == 95 || keycode == 45 || keycode == 46 || keycode == 47 || keycode == 32 || (keycode >= 48 && keycode <= 57) || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric, forward slash (/), dash(-), space and dot(.) allowed.</span>');
        e.preventDefault();
    } else if (fielval.length >= fieldmaxlen) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Maximum '+fieldmaxlen+' characters allowd. ');
    } else {
        $('span.err-' + fieldid).remove();
    }

    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphNumDasSpcDotSLACE').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z0-9.\_\/\-\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric, forward slash (/), dash(-), space and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z0-9.\_\/\-\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphNumDasSpcDot').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 45 || keycode == 46 || keycode == 32 || (keycode >= 48 && keycode <= 57) || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric, dash(-), space and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphNumDasSpcDot').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z0-9.\-\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric, dash(-), space and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z0-9.\-\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphNumDasSpcDotCommaBcsc').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 63 || keycode == 46 || keycode == 8 || keycode == 32 || (keycode >= 44 && keycode <= 57) || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric, dash(-), back slash(/), question mark(?) comma(,),  space and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphNumDasSpcDotCommaBcsc').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z0-9.\?\/,\-\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric, dash(-), back slash(/), question mark(?) comma(,),  space and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z0-9.\?\/,\-\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphNumOthers').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 45 || (keycode >= 47 && keycode <= 57) || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric, dash(-) and forward slash(/) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphNumOthers').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z0-9\/\-\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric, dash(-) and forward slash(/) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z0-9\/\-\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.telephoneNumeric').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 45 || keycode >= 48 && keycode <= 57))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only numeric and dash allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.telephoneNumeric').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[0-9\-]+$/;
    //var regEx = '/[0-9\-]/g';
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only numeric and dash allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $(this).val($(this).val().replace(/[^0-9\-\s]/g, ''));
});

$('.onlyNumeric').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(((keycode >= 48 && keycode <= 57)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only numeric digits allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.onlyNumeric').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    
    var regEx = /^[0-9]+$/;
    //var regEx = '/[0-9]/g';
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only numeric digits allowed.</span>');
       // e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
});

$('.perNumeric').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(((keycode == 46 || keycode >= 48 && keycode <= 57)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only numeric and dot(.) digits allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.perNumeric').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    
    var regEx = /^[0-9.]+$/;
    //var regEx = '/[0-9]/g';
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only numeric and dot(.) digits allowed.</span>');
       // e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $(this).val($(this).val().replace(/[^0-9.]/g, ''));
});

$('.oneZero').change(function(e) {
    var fieldid = $(this).attr('id');
    var fielval = $(this).val();
    var minlen = $(this).attr('data-minlength');
    if (fielval[0] == 0) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">0 not allowed from the start.</span>');
        e.preventDefault();
    } else {
        if (fielval.length < minlen) {
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter ' + minlen + ' digits.</span>');
            e.preventDefault();
        } else {
            $('span.err-' + fieldid).remove();
        }
    }
});

$('.twoZero').change(function(e) {
    var fieldid = $(this).attr('id');
    var fielval = $(this).val();
    var minlen = $(this).attr('data-minlength');
    if ((fielval[0] == 0) && (fielval[1] == 0)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">00 not allowed from the start.</span>');
        e.preventDefault();
    } else {
        if (fielval.length < minlen) {
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter minimum ' + minlen + ' digits.</span>');
            e.preventDefault();
        } else {
            $('span.err-' + fieldid).remove();
        }
    }
});

$('.perDig').change(function(e) {
    var fieldid = $(this).attr('id');
    var fielval = $(this).val();
    if (fielval[0] == 0) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">0 not allowed from the start.</span>');
        e.preventDefault();
    } else {
        if ((fielval.length > 3) || (fielval > 100)) {
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid entry.</span>');
            e.preventDefault();
        } else {
            $('span.err-' + fieldid).remove();
        }
    }
});

$('.validDateTime').change(function(e) {
    var fieldid = $(this).attr('id');
    var fielval = $(this).val();
    var regEx = /^\d{2}-\d{2}-\d{4} \d{2}:\d{2}$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only valid datetime format allowed. Exp. dd-mm-yyyy H:i</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
}); 

$('.validDate').change(function(e) {
    var fieldid = $(this).attr('id');
    var fielval = $(this).val();
    var regEx = /^\d{2}-\d{2}-\d{4}$/;
    if (fielval != '') {
        if (!fielval.match(regEx)) {
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only valid date format allowed. Exp. dd-mm-yyyy</span>');
            e.preventDefault();
        } else {
            $('span.err-' + fieldid).remove();
        }
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validEmail').change(function(e) {
    var fieldid = $(this).attr('id');
    var fielval = $(this).val();
    var regEx = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var count = 0;
    var splt = fielval.split('@');
    for (var i = 0; i < splt[1].length; i++) {
        if (splt[1][i] == '.') {
            count++;
        }
    }
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid email id.</span>');
        e.preventDefault();
    } else if (count > 2) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid email id.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    } 
});

$('.upldImgBannerFile').change(function(e) {
    var fieldid = $(this).attr('id');
    var filename = $('#' + fieldid).val();
    var actualname = filename.replace(/.*(\/|\\)/, '');
    if (/^[a-zA-Z0-9.\-\s]*$/.test(actualname) == false) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Special character not allowed except space, dash(-) and dot(.).</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    var filenameArr = actualname.split('.');
    var fileext = filenameArr.pop().toLowerCase();
    var extArr = ['jpg', 'jpeg', 'png'];
    if ($.inArray(fileext, extArr) == -1) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only JPG, JPEG and PNG file allowed.</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    if (this.files[0].size > 10000000) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Sorry! We will not accept file more than 10MB.</span>');
        $('#' + fieldid).val('');
        return false;
    }
});

$('.upldImgFile').change(function(e) {
    var fieldid = $(this).attr('id');
    var filename = $('#' + fieldid).val();
    var actualname = filename.replace(/.*(\/|\\)/, '');
    if (/^[a-zA-Z0-9.\-\s]*$/.test(actualname) == false) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Special character not allowed except space, dash(-) and dot(.).</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    var filenameArr = actualname.split('.');
    var fileext = filenameArr.pop().toLowerCase();
    var extArr = ['jpg', 'jpeg', 'png'];
    if ($.inArray(fileext, extArr) == -1) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only JPG, JPEG and PNG file allowed.</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    if (this.files[0].size > 200000) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Sorry! We will not accept file more than 200kb.</span>');
        $('#' + fieldid).val('');
        return false;
    }
});

$('.upldImgWithPdfFile').change(function(e) {
    var fieldid = $(this).attr('id');
    var filename = $('#' + fieldid).val();
    var actualname = filename.replace(/.*(\/|\\)/, '');
    if (/^[a-zA-Z0-9.\-\s]*$/.test(actualname) == false) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Special character not allowed except space, dash(-) and dot(.).</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    var filenameArr = actualname.split('.');
    var fileext = filenameArr.pop().toLowerCase();
    var extArr = ['jpg', 'jpeg', 'png', 'pdf'];
    if ($.inArray(fileext, extArr) == -1) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only PDF, JPG, JPEG and PNG file allowed.</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    if (this.files[0].size > 200000) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Sorry! We will not accept file more than 200kb.</span>');
        $('#' + fieldid).val('');
        return false;
    }
});

$('.upldPdfFile').change(function(e) {
    var fieldid = $(this).attr('id');
    var filename = $('#' + fieldid).val();
    var actualname = filename.replace(/.*(\/|\\)/, '');
    if (/^[a-zA-Z0-9.\-\s]*$/.test(actualname) == false) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Special character not allowed except space, dash(-) and dot(.).</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    var filenameArr = actualname.split('.');
    var fileext = filenameArr.pop().toLowerCase();
    var extArr = ['pdf'];
    if ($.inArray(fileext, extArr) == -1) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only PDF file allowed.</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    // if (this.files[0].size > 10000000) {
    if (this.files[0].size > 2000000) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Sorry! We will not accept file more than 20mb.</span>');
        $('#' + fieldid).val('');
        return false;
    }
});

$('.upldTXTCSVFile').change(function(e) {
    var fieldid = $(this).attr('id');
    var filename = $('#' + fieldid).val();
    var actualname = filename.replace(/.*(\/|\\)/, '');
    if (/^[a-zA-Z0-9.\-\s]*$/.test(actualname) == false) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Special character not allowed except space, dash(-) and dot(.).</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    var filenameArr = actualname.split('.');
    var fileext = filenameArr.pop().toLowerCase();
    var extArr = ['txt', 'csv'];
    if ($.inArray(fileext, extArr) == -1) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only TXT and CSV file allowed.</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    if (this.files[0].size > 200000) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Sorry! We will not accept file more than 200kb.</span>');
        $('#' + fieldid).val('');
        return false;
    }
});

$('.upldExcelFile').change(function(e) {
    var fieldid = $(this).attr('id');
    var filename = $('#' + fieldid).val();
    var actualname = filename.replace(/.*(\/|\\)/, '');
    if (/^[a-zA-Z0-9.\-\s]*$/.test(actualname) == false) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Special character not allowed except space, dash(-) and dot(.).</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    var filenameArr = actualname.split('.');
    var fileext = filenameArr.pop().toLowerCase();
    var extArr = ['xls',];
    if ($.inArray(fileext, extArr) == -1) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only Excel file allowed.</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    if (this.files[0].size > 200000) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Sorry! We will not accept file more than 200kb.</span>');
        $('#' + fieldid).val('');
        return false;
    }
});

$('.validURL').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 38 || keycode == 58 || keycode == 61 || keycode == 63 || (keycode >= 45 && keycode <= 57) || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric, forward slash(/), colon(:), dot(.), dash(-), question mark(?), equalto(=) and ampersand(&) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validURL').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z0-9.\:\-\?\=\/\&\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric, forward slash(/), colon(:), dot(.), dash(-), question mark(?), equalto(=) and ampersand(&) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z0-9.\:\-\?\=\/\&\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphaPlsMns').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 8 || keycode == 32 || keycode == 43 || keycode == 45 || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, space, plus(+) and dash(-) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphaPlsMns').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z\+\-\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, space, plus(+) and dash(-) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z\+\-\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.ifscCode').keypress(function(e){ 
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(((keycode >= 48 && keycode <= 57) || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter a valid IFSC code.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.ifscCode').change(function (event){     
    var regExp = /^[A-Za-z]{4}[a-zA-Z0-9]{7}$/; 
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    if( fielval.match(regExp) ){ 
        //alert('PAN match found');
    }
    else {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter a valid IFSC code.</span>');
        $('#'+fieldid).val('');
        return false;
    } 
});

$('.validPanCard').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(((keycode >= 48 && keycode <= 57) || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid pan card number.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validPanCard').change(function (e) {  
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    
    var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
    var txtpan   = $(this).val();
    
    if (txtpan != '') {
        if (txtpan.length == 10 ) { 
            if( txtpan.match(regExp) ){ 
                $('#'+fieldid).val(txtpan.toUpperCase());
            }
            else {
                $('span.err-' + fieldid).remove();
                $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid pan card number.</span>');
                //$('#' + fieldid).val('');
                return false;
            } 
        } else { 
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid pan card number.</span>');
            //$('#' + fieldid).val('');
            return false;
        } 
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validAadharNo').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(((keycode >= 48 && keycode <= 57)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid aadhar number.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validAadharNo').change(function (e) {  
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regExp = /[0-9]{12}/; 
    var txtpan   = $(this).val();
    
    if (txtpan != '') {
        if (txtpan.length == 12 ) {
            if( txtpan.match(regExp) ){ 
            }
            else {
                $('span.err-' + fieldid).remove();
                $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid aadhar number.</span>');
                return false;
            } 
        } else {
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid aadhar number.</span>');
            return false;
        }
    } else {
        $('span.err-' + fieldid).remove();
    }
});

/* start - only for notified assets */
$('.validAadharNoNotified').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(((keycode >= 48 && keycode <= 57)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid aadhar number.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validAadharNoNotified').change(function (e) {  
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regExp = /[0-9]{12}/; 
    var txtpan   = $(this).val();
    
    if (txtpan != '') {
        if (txtpan.length == 12 ) {
            if( txtpan.match(regExp) ){ 
            }
            else {
                alert('Please enter valid aadhar number.');
                $('span.err-' + fieldid).remove();
                $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid aadhar number.</span>');
                return false;
            } 
        } else { 
            alert('Please enter valid aadhar number.');
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid aadhar number.</span>');
            return false;
        }
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validPanCardNotified').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(((keycode >= 48 && keycode <= 57) || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid pan card number.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validPanCardNotified').change(function (e) {  
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    
    var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
    var txtpan   = $(this).val();
    
    if (txtpan != '') {
        if (txtpan.length == 10 ) { 
            if( txtpan.match(regExp) ){ 
                $('#'+fieldid).val(txtpan.toUpperCase());
            }
            else {
                alert('Please enter valid pan card number.');
                $('span.err-' + fieldid).remove();
                $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid pan card number.</span>');
                $('#pan').val('');
                return false;
            } 
        } else {
            alert('Please enter valid pan card number.');
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid pan card number.</span>');
            $('#pan').val('');
            return false;
        } 
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validMobileNoNotified').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(((keycode >= 48 && keycode <= 57)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid mobile number.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validMobileNoNotified').change(function (e) {  
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regExp = /[0-9]{10}/;
    
    if (fielval != '') {
        if (fielval.length == 10 ) { 
            if( fielval.match(regExp) ){ 
            }
            else {
                alert('Please enter valid mobile number.');
                $('span.err-' + fieldid).remove();
                $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid mobile number.</span>');
                return false;
            } 
        } else {
            alert('Please enter valid mobile number.');
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid mobile number.</span>');
            return false;
        }
    } else {
        $('span.err-' + fieldid).remove();
    }
});
/* start - only for notified assets */

$('.userName').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 8 || (keycode >= 48 && keycode <= 57) || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric character allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.userName').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z0-9]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric character allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z0-9]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphaNumericSpc').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 8 || keycode == 32 || (keycode >= 65 && keycode <= 90) || (keycode >= 48 && keycode <= 57) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric and space allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphaNumericSpc').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z0-9\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphanumeric and space allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z0-9\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

/*16-07-2019*/
$('.numDasSpc').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 45 || keycode == 32 || (keycode >= 48 && keycode <= 57)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only numeric, dash(-) and space allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.numDasSpc').change(function(e) { 
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[0-9\-\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only numeric, dash(-) and space allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^0-9\-\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphaSpcDotSlashDash').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 45 || keycode == 46 || keycode == 47 || keycode == 8 || keycode == 32 || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, space, slash(/) and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphaSpcDotSlashDash').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z.\/\-\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, space, slash(/) and dot(.) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z.\/\-\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

/////////////////// Ratanveer (21-10-2019) //////////////////////////
$('.upldJpgJpegWithPdfFile').change(function(e) {
    var fieldid = $(this).attr('id');
    var filename = $('#' + fieldid).val();
    var actualname = filename.replace(/.*(\/|\\)/, '');
    if (/^[a-zA-Z0-9.\-\s]*$/.test(actualname) == false) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Special character not allowed except space, dash(-) and dot(.).</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    var filenameArr = actualname.split('.');
    var fileext = filenameArr.pop().toLowerCase();
    var extArr = ['jpg', 'jpeg', 'pdf'];
    if ($.inArray(fileext, extArr) == -1) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only PDF, JPG and JPEG file allowed.</span>');
        $('#' + fieldid).val('');
        return false;
    } else {
        $('span.err-' + fieldid).remove();
    }
    // if (this.files[0].size > 5000000) {
    if (this.files[0].size > 200000) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Sorry! We will not accept file more than 200kb.</span>');
        $('#' + fieldid).val('');
        return false;
    }
});

$('.alphaNumDashSlash').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(keycode == 45 || keycode == 47 || (keycode >= 48 && keycode <= 57) || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, numeric, slash(/) and dash(-) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphaNumDashSlash').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[A-Za-z0-9\-\/]+$/;
    if (fielval != '') {
        if (!fielval.match(regEx)) {
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, numeric, slash(/) and dash(-) allowed.</span>');
            e.preventDefault();
        } else {
            $('span.err-' + fieldid).remove();
        }
        /*$('#' + fieldid).val(fielval.replace(/[^A-Za-z0-9\-]/gi, ''));
        setTimeout(function() {
            $('span.err-' + fieldid).remove();
        }, 2000);*/
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validPinCode').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(keycode >= 48 && keycode <= 57)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid pin code.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validPinCode').change(function (e) {  
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
                                            
    var regExp = /[0-9]{6}/; 
    var txtpan   = $(this).val();
    
    if (txtpan != '') {
        if (txtpan.length == 6 ) { 
            if( txtpan.match(regExp) )
            {
                $('span.err-' + fieldid).remove();
            }
            else
            {
                $('span.err-' + fieldid).remove();
                $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid pin code.</span>');
                // $('#pan').val('');
                return false;
            } 
        } else { 
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Pin code should be 6 digits.</span>');
            // $('#pan').val('');
            return false;
        }
    } else {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Pin code is required.</span>');
        return false;
    }
});

$('.alphaNumDot').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var fieldmaxlen = $(this).attr('maxlength');

    if (!(keycode == 8 || keycode == 9 || keycode == 46 || (keycode >= 48 && keycode <= 57) || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, numeric and dot(.) allowed.</span>');
        e.preventDefault();
    } else if (fielval.length >= fieldmaxlen) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Maximum '+fieldmaxlen+' characters allowed. ');
    } else {
        $('span.err-' + fieldid).remove();
    }
    
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.alphaNumDot').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[A-Za-z0-9.]+$/;
    
    if (fielval != '') {
        if (!fielval.match(regEx)) {
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, numeric and dot(.) allowed.</span>');
            e.preventDefault();
        } else {
            $('span.err-' + fieldid).remove();
        }
    } else {
        $('span.err-' + fieldid).remove();
    }

    $('#' + fieldid).val(fielval.replace(/[^A-Za-z0-9.]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.validMobileNo').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(((keycode >= 48 && keycode <= 57)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid mobile number.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validMobileNo').change(function (e) {  
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regExp = /[0-9]{10}/;
    
    if (fielval != '') {
        if (fielval.length == 10 ) { 
            if( fielval.match(regExp) )
            {
                $('span.err-' + fieldid).remove(); 
            }
            else
            {
                $('span.err-' + fieldid).remove();
                $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid mobile number.</span>');
                return false;
            } 
        } else { 
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please enter valid mobile number.</span>');
            return false;
        }
    } else {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Mobile number is required.</span>');
        return false;
    }
});

$('.onlyNumericExceptZero').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(((keycode >= 49 && keycode <= 57)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only numeric digits allowed except zero.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.onlyNumericExceptZero').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    
    var regEx = /^[1-9]+$/;
    //var regEx = '/[0-9]/g';
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only numeric digits allowed except zero.</span>');
       // e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $(this).val($(this).val().replace(/[^1-9]/g, ''));
});

$('.validPincodeNoNotified').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!(((keycode >= 48 && keycode <= 57)))) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please Enter valid Pin Code Number.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.validPincodeNoNotified').change(function (e) {  
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regExp = /[0-9]{6}/;
    
    if (fielval != '') {
        if (fielval.length == 6 ) { 
            if( fielval.match(regExp) ){ 
            }
            else {
                alert('Please Enter valid Pin Code Number.');
                $('span.err-' + fieldid).remove();
                $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please Enter valid Pin Code Number.</span>');
                return false;
            } 
        } else {
            alert('Please Enter valid Pin Code Number.');
            $('span.err-' + fieldid).remove();
            $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Please Enter valid Pin Code Number.</span>');
            return false;
        }
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphanumaricSpcCommaDot').keypress(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    if (!((keycode == 44 || keycode == 45 || keycode == 8 || keycode == 32 || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122) || (keycode >= 48 && keycode <= 57)))) {
        //alert("Yes");
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, number, space, comma and dash(-) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.alphanumaricSpcCommaDot').change(function(e) {
    var keycode = e.which;
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var regEx = /^[a-zA-Z0-9-,\s]+$/;
    if (!fielval.match(regEx)) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Only alphabets, number, space, comma and dash(-) allowed.</span>');
        e.preventDefault();
    } else {
        $('span.err-' + fieldid).remove();
    }
    $('#' + fieldid).val(fielval.replace(/[^a-zA-Z.,\s]/gi, ''));
    setTimeout(function() {
        $('span.err-' + fieldid).remove();
    }, 5000);
});

$('.maxlength').keypress(function(e) {
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var fieldmaxlen = $(this).attr('maxlength');

    if (fielval.length > fieldmaxlen) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Maximum '+fieldmaxlen+' characters allowed.');
    } else {
        $('span.err-' + fieldid).remove();
    }
});

$('.maxlength').change(function(e) {
    var fieldid = $(this).attr('id');
    var fielval = $('#' + fieldid).val();
    var fieldmaxlen = $(this).attr('maxlength');

    if (fielval.length > fieldmaxlen) {
        $('span.err-' + fieldid).remove();
        $('.error-' + fieldid).append('<span class="err-' + fieldid + '" style="color:red;">Maximum '+fieldmaxlen+' characters allowed.');
    } else {
        $('span.err-' + fieldid).remove();
    }
});