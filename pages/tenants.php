<?php include_once 'header.php' ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Tenants</h3>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button type="button" class="btn btn-primary btn-icon-text btn-sm" data-toggle="modal" data-target="#addAccountModal">
                                        <i class="icon-plus btn-icon-prepend"></i>
                                        New Tenant
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
          <div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="addAccountModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="addAccountModalLabel">New Tenant</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <!-- Your form elements go here -->
                          <form>
                              <div class="row">
                                  <!-- Other Fields in Two Columns -->
                                  <div class="col-md-6 text-center justify-content-center mb-3 d-flex align-items-center"> <!-- Added d-flex and align-items-center -->
                                    <div>
                                        <img src="../images/profile.webp" id="profilePicturePreview" alt="Profile Picture Preview" class="img-fluid rounded-circle" style="max-width: 150px; max-height: 150px; min-width: 150px; min-height: 150px; cursor: pointer;">
                                        <label>Select user</label>
                                        <select class="js-example-basic-single w-100"> <!-- Change w-500 to w-100 -->
                                            <option value="AL">Norberto Bruzon Jr.</option>
                                            <option value="WY">Wyoming Wyoming</option>
                                            <option value="AM">America America</option>
                                            <option value="CA">Canada Canada</option>
                                            <option value="RU">Russia Russia</option>
                                        </select>
                                    </div>
                                </div>

                                  <!-- Room # -->
                                  <div class="col-md-12 mb-4">
                                      <label for="gender">Room</label>
                                      <select class="form-control" id="room">
                                          <option value="101">101</option>
                                          <option value="102">102</option>
                                          <option value="103">103</option>
                                      </select>
                                  </div>
                              </div>
                          </form>
                      </div>

                      <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary btn-md" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary btn-md">Save changes</button>
                      </div>
                  </div>
              </div>
          </div>
            <div class="search-box mb-3">
                <input type="text" class="form-control" placeholder="Search...">
            </div>
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Room</th>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>101</td>
                                        <td></td>
                                        <td>Jacob</td>
                                        <td>Male</td>
                                        <td>53275531</td>
                                        <td><span class="badge badge-success">Active</span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>101</td>
                                        <td></td>
                                        <td>Jacob</td>
                                        <td>Male</td>
                                        <td>53275531</td>
                                        <td><span class="badge badge-warning">Inactive</span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>101</td>
                                        <td></td>
                                        <td>Jacob</td>
                                        <td>Male</td>
                                        <td>53275531</td>
                                        <td><span class="badge badge-warning">Inactive</span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>101</td>
                                        <td></td>
                                        <td>Jacob</td>
                                        <td>Male</td>
                                        <td>53275531</td>
                                        <td><span class="badge badge-success">Active</span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>101</td>
                                        <td></td>
                                        <td>Jacob</td>
                                        <td>Male</td>
                                        <td>53275531</td>
                                        <td><span class="badge badge-success">Active</span></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once 'footer.php' ?>

