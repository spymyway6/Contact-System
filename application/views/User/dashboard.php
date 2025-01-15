<!DOCTYPE html>
<html>
    <?php $this->load->view('User/common/header'); ?>

    <body>
        <main class="main-content">
            <?php $this->load->view('User/common/navbar'); ?>

            <div class="dashboard-container">
                <?php $this->load->view('User/common/breadcrumbs'); ?>

                <div class="wrapper">
                    <div class="dashboard-content">
                        <div class="table-container">
                            <div class="table-filter-wrapper">
                                <div class="dashboard-content">
                                    <div class="table-fitler-group">
                                        <div class="filter-actions-grp">
                                            <div class="selection-dropdown-white-wrapper text-field-btn multiple-keywords">
                                                <input type="search" name="search_contact" id="search_contact" placeholder='Search Contact...' class="form-control"  oninput="fetchAllContacts()" />
                                                <i class="fa-solid fa-search"></i>
                                            </div>
                                        </div>
                                        <div class="filter-results-grp">
                                            <button class="selection-btn active-btn primary-btn" onclick="showContactModal()"> Add New Contact</button>
                                            <div class="selection-dropdown-wrapper">
                                                <label htmlFor="number_of_items">Items per page</label>
                                                <select name="number_of_items" id="number_of_items" class="form-control" onchange="fetchAllContacts()">
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
                                        <!-- Dynamically load all contacts -->
                                        <tbody id="contact-table-body"></tbody>
                                    </table>

                                    <div class="table-pagination-wrapper">
                                        <p id="total-results-wrapper"></p>
                                        <!-- Pagination links -->
                                        <div class="pagination-wrapper" id="pagination-wrapper"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->load->view('User/components/add_contact_modal'); ?>
        </main>

        <!-- jQuery  -->
        <?php $this->load->view('User/common/footer'); ?>

        <script>
            $(document).ready(function() {
                fetchAllContacts();
            });
        </script>
	
	</body>
</html>