<?php include_once 'header.php';
include_once 'display_function.inc.php';

$announcments = getAnnouncements();

?>
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
            
            <?php
              foreach ($announcments as $key => $announcments) {
                $title  = $announcments['title'];
                $description = $announcments['description'];
                $date = $announcments['date'];
                $time = $announcments['time'];
                $id = $announcments['id'];
                $dateObj = new DateTime($announcments['date']);
                $formattedDate = $dateObj->format('l, F j Y');
                
                // Convert time to the desired format (e.g., 10:48 pm)
                $timeObj = new DateTime($announcments['time']);
                $formattedTime = $timeObj->format('h:i A');
                ?>
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                      <div class="mb-xl-0">
                        <div class="ann_header d-flex align-items-center justify-content-between">
                        <h5 class="font-weight-bold"><?php echo $title?></h3>
                        <button type="button" value="<?php echo $id?>" class="btn" id="ann_edit"><i class="fi fi-rr-edit"></i></button>
                        </div>
                        <p class="text-muted" style="font-size: 12px"><?php echo $formattedDate?> <?php echo $formattedTime?></p>
                        <p style="width:100%"><?php echo $description?></p>
                      </div>
                    </div>
                </div>
            </div>
            <?php
                }
                ?>
        </div>
      </div>
      
      <div class="modal fade" id="announcement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">New Announcement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="addAnnouncement">
                  <div class="form-group">
                  <label>Announcement Title</label>
                  <input type="text" class="form-control mb-3" name="title" id="title" required>
                  </div>
                  <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" rows="7" required></textarea>
                  </div>
                  <div class="form-group">
                  <label>Date</label>
                  <input type="date" class="form-control mb-3" name="date" id="date" required>
                  </div>
                  <div class="form-group">
                  <label>Time</label>
                  <input type="time" class="form-control mb-3" name="time" id="time" required>
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

      <div class="modal fade" id="announcement_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">New Announcement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="addAnnouncement_edit">
                  <input type="hidden" class="form-control mb-3" name="ann_id" id="ann_id">
                  <div class="form-group">
                  <label>Announcement Title</label>
                  <input type="text" class="form-control mb-3" name="title_edit" id="title_edit" required>
                  </div>
                  <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description_edit" id="description_edit" rows="7" required></textarea>
                  </div>
                  <div class="form-group">
                  <label>Date</label>
                  <input type="date" class="form-control mb-3" name="date_edit" id="date_edit" required>
                  </div>
                  <div class="form-group">
                  <label>Time</label>
                  <input type="time" class="form-control mb-3" name="time_edit" id="time_edit" required>
                  </div>
                  <button type="button" class="btn btn-danger" id="ann_delete">Delete</button>
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

