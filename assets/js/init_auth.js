const loginUser = (e, formID) => {
    const base_url = $('#base_url').val();
    $('#error-msg').html(``);
    $(`#${formID}`).parsley().validate();
    if ($(`#${formID}`).parsley().isValid()) {
        $(e).html('<i class="fa-solid fa-spin fa-spinner"></i> Logging in...');
        var form = document.getElementById(formID);
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: base_url+'login-user',
            data: formData,
            contentType: false,
            processData: false,
            success: (resp) => {
                var res = JSON.parse(resp);
                if(res.status == true){
                    window.location.href= base_url + "dashboard";
                }else{
                    $('#error-msg').html(`<div class="error-msg">${res.message}</div>`);
                    $(e).html('Login');
                }
            },
            error: (res) => {
                $('#error-msg').html(`<div class="error-msg">${res.message}</div>`);
            },
        });
    }
}

const registerUser = (e, formID) => {
    const base_url = $('#base_url').val();
    $('#error-msg').html(``);
    $(`#${formID}`).parsley().validate();
    if ($(`#${formID}`).parsley().isValid()) {
        $(e).html('<i class="fa-solid fa-spin fa-spinner"></i> Submitting...');
        var form = document.getElementById(formID);
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: base_url+'register-user',
            data: formData,
            contentType: false,
            processData: false,
            success: (resp) => {
                var res = JSON.parse(resp);
                if(res.status == true){
                    window.location.href= base_url + "dashboard";
                }else{
                    $('#error-msg').html(`<div class="error-msg">${res.message}</div>`);
                    $(e).html('Login');
                }
            },
            error: (res) => {
                $('#error-msg').html(`<div class="error-msg">${res.message}</div>`);
            },
        });
    }
}