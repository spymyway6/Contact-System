<!DOCTYPE html>
<html>
    <?php $this->load->view('User/common/header'); ?>

    <body>
    <main class="main-content">
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
                                    <span>MJ Pino <small>User</small></span>
                                </div>
                                <button onclick="logout()" type="button"><i class="fa-solid fa-power-off nav-icons"></i> Signout</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="dashboard-container">
                <div class="page-sub-heading">
                    <h1>My Contacts</h1>
                    <ul class="breadcrumbs">
                        <li>
                            <Link to="/dashboard"><RxDashboard /> Dashboard</Link>
                        </li>
                        <li>My Contacts</li>
                    </ul>
                </div>
                <div class="wrapper">
                    <div class="dashboard-content">
                        <div class="table-container">
                            <div class="table-filter-wrapper">
                                <div class="dashboard-content">
                                    <div class="table-fitler-group">
                                        <div class="filter-actions-grp">
                                            <div class="selection-dropdown-white-wrapper text-field-btn multiple-keywords">
                                                <input type="search" name="search_contact" id="search_contact" placeholder='Search Contact...' class="form-control" />
                                                <FiSearch/>
                                            </div>
                                        </div>
                                        <div class="filter-results-grp">
                                            <button class="selection-btn active-btn primary-btn" onclick="showContactModal()"> Add New Contact</button>
                                            <div class="selection-dropdown-wrapper">
                                                <label htmlFor="number_of_items">Items per page</label>
                                                <select name="number_of_items" id="number_of_items" class="form-control" onChange="">
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="table-wrapper">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <div class="thead">
                                                        <span>Name</span>
                                                    </div>
                                                </th>
                                                <th scope="col">
                                                    <div class="thead">
                                                        <span>Phone</span>
                                                    </div>
                                                </th>
                                                <th scope="col">
                                                    <div class="thead">
                                                        <span>Company</span>
                                                    </div>
                                                </th>
                                                <th scope="col">
                                                    <div class="thead">
                                                        <span>Email</span>
                                                    </div>
                                                </th>
                                                <th scope="col">
                                                    <div class="thead">
                                                        <span>Date Added</span>
                                                    </div>
                                                </th>
                                                <th scope="col" class='text-center action-row'>
                                                    <span>Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="contact-table-body">
                                            <?php if($contacts){ ?>
                                                <?php foreach($contacts as $contact){ ?>
                                                    <tr>
                                                        <td>
                                                            <div class="tbl-content-wrapper">
                                                                <h6><?=$contact['name']; ?></h6>
                                                            </div>
                                                        </td>
                                                        <td><?=$contact['phone']; ?></td>
                                                        <td><?=$contact['company']; ?></td>
                                                        <td><?=$contact['email']; ?></td>
                                                        <td><?=date('M d, Y h:i A', strtotime($contact['date_created']))?></td>
                                                        <td class='action-row'>
                                                            <div class="tbl-act-grp">
                                                                <button class="tbl-act-btn" title="Edit Details" onclick="editContact(<?=$contact['id']?>)"><i class="fa-solid fa-pen-to-square tbl-btn-icon"></i></i></button>
                                                                <button class="tbl-act-btn" title="Delete" onclick="deleteContact(<?=$contact['id']?>)"><i class="fa-solid fa-trash tbl-btn-icon"></i></button>
                                                            </div>
                                                        </td>   
                                                    </tr>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <tr class='loader-full'>
                                                    <td colspan="6">
                                                        <div class="loading-table">
                                                            <i class="fa-regular fa-folder-open"></i>
                                                            <span>No contacts found.</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <div class="table-pagination-wrapper">
                                        <p>Total of 1 results (out of 1)</p>
                                        <div class="pagination-wrapper">
                                            <ul>
                                                <li>
                                                    <button class="pagination-btn page-arrows" onclick="handlePreviousPage"><i class="fa-solid fa-angles-left"></i></button>
                                                </li>
                                                <li>
                                                    <button class="pagination-btn page-arrows" onclick="handleNextPage"><i class="fa-solid fa-angles-right"></i></button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
        </main>

        <!-- jQuery  -->
        <?php $this->load->view('User/common/footer'); ?>
	
	</body>
</html>