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
    $(`#add-contact-form`)[0].reset();
    $('#contact_id').val(0);
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
                    swal('Contact Saved!', res.message, 'success');
                    $(`#${formID}`)[0].reset();
                    $(e).html('<i class="fa-solid fa-floppy-disk"></i> Save');
                }else{
                    swal("Oops!", res.message, "error");
                }
            },
            error: (res) => {
                swal("Error occured!", 'Please try again.', "error");
            },
        });
    }
}


const editContact = (contactID) => {
    $.ajax({
        type: "GET",
        url: base_url+'edit-contact/'+contactID,
        contentType: false,
        processData: false,
        success: (resp) => {
            var res = JSON.parse(resp);
            if(res.status == true){
                showContactModal();
                $('#name').val(res.data.name);
                $('#phone').val(res.data.phone);
                $('#company').val(res.data.company);
                $('#email').val(res.data.email);
                $('#sel_contact_id').val(res.data.id);
            }else{
                swal("Error fetcing contact!", res.message, "error");
            }
        },
        error: (res) => {
            swal("Error fetcing contact!", res.message, "error");
        },
    });
}

const deleteContact = (contactID) => {
    swal({
        title: "Delete Contact?",
        text: "You can't recover this contact anymore, continue?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete!",
        closeOnConfirm: false,
        confirmButtonColor: "#f05050",
        showLoaderOnConfirm: true
    },
    ()=>{
        $.ajax({
            type: "DELETE",
            url: base_url+'delete-contact/'+contactID,
            data: {},
            contentType: false,
            processData: false,
            success: (resp) => {
                var res = JSON.parse(resp);
                if(res.status == true){
                    swal('Contact Deleted!', res.message, 'success');
                }else{
                    swal("Error deleting!", res.message, "error");
                }
            },
            error: (res) => {
                swal("Error deleting!", res.message, "error");
            },
        });
    });
}