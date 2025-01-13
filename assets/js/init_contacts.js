const base_url = $('#base_url').val();

$(document).ready(function() {
    $('#dropdownButton').on('click', function(event) {
        $('#dropdownMenu').toggleClass('show');
        event.stopPropagation(); // Prevent click from propagating to document
    });

    $(document).on('click', function() {
        if ($('#dropdownMenu').hasClass('show')) {
            $('#dropdownMenu').removeClass('show');
        }
    });
});

const logout = () => {
    swal({
        title: "Logout?",
        text: "Do you want to logout?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Logout!",
        closeOnConfirm: false,
        confirmButtonColor: "#f05050",
        showLoaderOnConfirm: true
    },
    ()=>{
        window.location.href = base_url+ "logout";
    });
}

const closeContactModal = () => {
    $('#contact-modal').addClass('hide-side-modal');
    $('#contact-modal').removeClass('show-side-modal');
}

const showContactModal = () => {
    $('#contact-modal').addClass('show-side-modal');
    $('#contact-modal').removeClass('hide-side-modal');
}

const showDropdown = () => {
    $('#contact-modal').addClass('show-side-modal');
    $('#contact-modal').removeClass('hide-side-modal');
}

const addNewContact = (e, formID) => {
    $('#error-msg').html(``);
    $(`#${formID}`).parsley().validate();
    if ($(`#${formID}`).parsley().isValid()) {
        $(e).html('<i class="fa-solid fa-spin fa-spinner"></i> Saving...');
        var form = document.getElementById(formID);
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: base_url+'add-new-contact',
            data: formData,
            contentType: false,
            processData: false,
            success: (resp) => {
                var res = JSON.parse(resp);
                if(res.status == true){
                    closeContactModal();
                    swal('Contact Added!', res.message, 'success');
                    $(`#${formID}`)[0].reset();
                    $(e).html('<i class="fa-solid fa-floppy-disk"></i> Save');
                }else{
                    swal("Duplicate Contact!", res.message, "error");
                }
            },
            error: (res) => {
                $('#error-msg').html(`<div class="error-msg">${res.message}</div>`);
            },
        });
    }
}