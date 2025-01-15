<div class="side-modal-container hide-side-modal" id="contact-modal">
    <div class="side-modal-wrapper">
        <form id="add-contact-form">
            <div class="card main-modal-card">
                <div class="card-body main-modal-card-body">
                    <h5 class="card-title main-modal-card-title">
                        <span>
                            <em id="modal-heading"><i class="fa-regular fa-address-book"></i> Add New Contact</em>
                            <small>Create your own contact in just a seconds.</small>
                        </span>
                        <div class="card-btn-grp">
                            <button type="button" onclick="closeContactModal()" class='btn btn-cls'><i class="fa-solid fa-x"></i></button>
                        </div>
                    </h5>
                    <div class="card-text main-modal-card-text">
                        <h5 class="form-group-title">Contact Details</h5>
                        <div class="full-row">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Contact Name" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="" required />
                            </div>
                        </div>
                        <div class="full-row">
                            <div class="form-group">
                                <label for="company">Company</label>
                                <input type="text" class="form-control" id="company" name="company" placeholder="Company" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value=""/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-modal-footer">
                    <div class="tbl-btn-grp">
                        <input type="hidden" name="sel_contact_id" id="sel_contact_id" value="0">
                        <button class="btn-warning" type="button" onclick="addNewContact(this, 'add-contact-form')"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>