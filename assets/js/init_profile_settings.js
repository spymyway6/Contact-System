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

const closeProfileSettingsModal = () => {
    $('#profile-settings-modal').addClass('hide-side-modal');
    $('#profile-settings-modal').removeClass('show-side-modal');
    $(`#profile-settings-form`)[0].reset();
}

const showProfileSettingsModal = () => {
    $('#profile-settings-modal').addClass('show-side-modal');
    $('#profile-settings-modal').removeClass('hide-side-modal');
    $(`#profile-settings-form`)[0].reset();
}

const saveProfileSettings = (e, formID) => {
    $(`#${formID}`).parsley().validate();
    if ($(`#${formID}`).parsley().isValid()) {
        $(e).html('<i class="fa-solid fa-spin fa-spinner"></i> Saving...');
        var form = document.getElementById(formID);
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: base_url+'update-profile-settings',
            data: formData,
            contentType: false,
            processData: false,
            success: (resp) => {
                var res = JSON.parse(resp);
                if(res.status == true){
                    closeProfileSettingsModal();
                    swal('Profile Saved!', res.message, 'success');
                    setTimeout(()=>{
                        location.reload();
                    }, 1000);
                }else{
                    swal("Oops!", res.message, "error");
                }
                $(e).html('<i class="fa-solid fa-floppy-disk"></i> Save Changes');
            },
            error: (res) => {
                swal("Error occured!", 'Please try again.', "error");
                $(e).html('<i class="fa-solid fa-floppy-disk"></i> Save Changes');
            },
        });
    }
}