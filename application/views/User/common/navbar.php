<?php
    $CI =& get_instance();
    $CI->load->model('Auth_model');
    $data = $CI->Auth_model->get_current_user();
    $profile_details['data'] = $data; 
?>

<div class="top-navbar-container">
    <div class="top-menu-right-wrapper">
        <ul class="navtop-menu-items">
            <li class="navtop-item">
                <button class="navtop-link" id="dropdownButton">
                    <span class="active-icon"></span>
                    <div class="navtop-user-img"><i class="fa fa-user"></i></div>
                </button>
                <div class="dropdown-menu profile-dropdown" id="dropdownMenu">
                    <div class="top-profile-info">
                        <div class="navtop-user-img"><i class="fa fa-user"></i></div>
                        <span><?=$data['first_name']?> <small>User</small></span>
                    </div>
                    <button onclick="showProfileSettingsModal()" type="button"><i class="fa-solid fa-cog nav-icons"></i> Profile Settings</button>
                    <button onclick="logout()" type="button"><i class="fa-solid fa-power-off nav-icons"></i> Signout</button>
                </div>
            </li>
        </ul>
    </div>
</div>

<?php $this->load->view('User/components/profile_settings', $profile_details); ?>