<div class="side-modal-container hide-side-modal" id="profile-settings-modal">
    <div class="side-modal-wrapper">
        <form id="profile-settings-form">
            <div class="card main-modal-card">
                <div class="card-body main-modal-card-body">
                    <h5 class="card-title main-modal-card-title">
                        <span>
                            <em id="modal-heading"><i class="fa-solid fa-cog"></i> Profile Settings</em>
                            <small>Update your profile.</small>
                        </span>
                        <div class="card-btn-grp">
                            <button type="button" onclick="closeProfileSettingsModal()" class='btn btn-cls'><i class="fa-solid fa-x"></i></button>
                        </div>
                    </h5>
                    <div class="card-text main-modal-card-text">
                        <h5 class="form-group-title">Profile Details</h5>
                        <div class="dual-row">
                            <div class="form-group">
                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?=$data['first_name'];?>" required />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?=$data['last_name'];?>" required />
                            </div>
                        </div>
                        <div class="full-row">
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email Address" value="<?=$data['email'];?>" required />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" />
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="" data-parsley-equalto="#password" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-modal-footer">
                    <div class="tbl-btn-grp">
                        <button class="btn-warning" type="button" onclick="saveProfileSettings(this, 'profile-settings-form')"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>