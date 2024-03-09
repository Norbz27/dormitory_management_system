<?php include_once 'header.php' ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Announcements</h3>
                        </div>
                        <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                              <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                  <button type="button" class="btn btn-primary btn-icon-text btn-sm" data-toggle="modal" data-target="#announcement">
                                      <i class="icon-file btn-icon-prepend"></i>
                                      New
                                  </button>
                              </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                      <div class="mb-xl-0">
                        <h5 class="font-weight-bold">Announcement Title</h3>
                        <p class="text-muted" style="font-size: 12px">Friday, March 1, 2024 5:00 pm</p>
                        <p style="width:100%">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Urna et pharetra pharetra massa massa ultricies mi quis. Eu lobortis elementum nibh tellus molestie nunc non. Maecenas accumsan lacus vel facilisis. Feugiat in fermentum posuere urna nec. Elit duis tristique sollicitudin nibh sit amet commodo. Nisi est sit amet facilisis. Magna sit amet purus gravida quis blandit turpis cursus in. Lacus vel facilisis volutpat est velit egestas dui. Risus ultricies tristique nulla aliquet enim tortor. Pharetra pharetra massa massa ultricies mi quis hendrerit dolor.</p>
                      </div>
                    </div>
                </div>
            </div>
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                      <div class="mb-xl-0">
                        <h5 class="font-weight-bold">Announcement Title</h3>
                        <p class="text-muted" style="font-size: 12px">Friday, March 1, 2024 5:00 pm</p>
                        <p style="width:100%">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Urna et pharetra pharetra massa massa ultricies mi quis. Eu lobortis elementum nibh tellus molestie nunc non. Maecenas accumsan lacus vel facilisis. Feugiat in fermentum posuere urna nec. Elit duis tristique sollicitudin nibh sit amet commodo. Nisi est sit amet facilisis. Magna sit amet purus gravida quis blandit turpis cursus in. Lacus vel facilisis volutpat est velit egestas dui. Risus ultricies tristique nulla aliquet enim tortor. Pharetra pharetra massa massa ultricies mi quis hendrerit dolor.</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      
      <div class="modal fade" id="announcement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="room_name"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="addAnnouncement">
                <div class="form-group">
                  <div class="col">
                  <label>Announcement Title</label>
                  <input type="text" class="form-control mb-3" name="title" id="title" required>
                  </div>
                  <div class="col">
                  <label>Description</label>
                  <input type="text" class="form-control mb-3" name="description" id="description" required>
                  </div>
                  <div class="col">
                  <label>Date</label>
                  <input type="date" class="form-control mb-3" name="date" id="date" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>
    <!-- page-body-wrapper ends -->
  <script src="functions.js"></script>
  <?php include_once 'footer.php' ?>

