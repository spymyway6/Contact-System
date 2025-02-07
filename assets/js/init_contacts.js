const base_url = $('#base_url').val();

const closeContactModal = () => {
    $('#contact-modal').addClass('hide-side-modal');
    $('#contact-modal').removeClass('show-side-modal');
}

const showContactModal = () => {
    $('#contact-modal').addClass('show-side-modal');
    $('#contact-modal').removeClass('hide-side-modal');
    $(`#add-contact-form`)[0].reset();
    $('#sel_contact_id').val(0);
}

const addNewContact = (e, formID) => {
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
                    fetchAllContacts();
                }else{
                    swal("Oops!", res.message, "error");
                }
                $(e).html('<i class="fa-solid fa-floppy-disk"></i> Save');
            },
            error: (res) => {
                swal("Error occured!", 'Please try again.', "error");
                $(e).html('<i class="fa-solid fa-floppy-disk"></i> Save');
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
                    fetchAllContacts();
                }else{
                    swal("Error deleting!", res.message, "error");
                }
            },
            error: () => {
                swal("Error deleting!", 'A problem occured.', "error");
            },
        });
    });
}

const fetchAllContacts = (page=0) => {
    let query = $('#search_contact').val();
    $('#contact-table-body').html(`
        <tr class='loader-full'>
            <td colspan="6">
                <div class="loading-table">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    <span>Loading contacts. Please wait...</span>
                </div>
            </td>
        </tr>
    `);
    $.ajax({
        type: "POST",
        url: base_url + 'search-fetch-contacts', 
        data: { 
            keyword: query,
            page: page,
            limit: $('#number_of_items').val(),
        },
        success: (resp) => {
            var res = JSON.parse(resp);
            if(res.data.contacts){
                $('#contact-table-body').html(res.data.contacts);
            }else{
                $('#contact-table-body').html(`
                    <tr class="loader-full">
                        <td colspan="6">
                            <div class="loading-table">
                                <i class="fa-regular fa-folder-open"></i>
                                <span>No contacts to display.</span>
                            </div>
                        </td>
                    </tr>
                `);
            }
            $('#pagination-wrapper').html(res.data.pagination);
            $('#total-results-wrapper').html(res.data.total_results);
        },
        error: (xhr, status, error) => {
            swal("Error fetching contact!", 'A problem occurred: ' + error, "error");
        }
    });
};