<?php
include_once 'header.php';
include_once 'display_function.inc.php';
?>
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-6 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Rooms</h3>
                        </div>
                        <div class="col-6 col-xl-4">
                        <div class="justify-content-end d-flex">    
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                            <?php 
                                if ($_SESSION["username"] == 'admin') {
                                ?>
                                <button type="button" class="btn btn-primary btn-icon-text btn-sm" data-toggle="modal" data-target="#addRoom">
                                    <i class="icon-plus btn-icon-prepend"></i>
                                    Add Room
                                </button>
                                <?php 
                                }
                                  ?>
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php
                          // Define the available floors and their corresponding values
                          $floors = [
                              1 => 'Floor 1',
                              2 => 'Floor 2',
                              3 => 'Floor 3',
                          ];

                          // Check if the floor is set in the URL, otherwise default to the first floor
                          $selectedFloor = isset($_GET['floor']) ? $_GET['floor'] : 1;
                          $room = getRoom1($selectedFloor);

                          // Output the HTML for the dropdown menu
                          echo '<div class="form-group d-flex align-items-center">
                                  <select class="form-control col-1" name="floorSelect" onchange="location = this.value;">';
                          foreach ($floors as $floorValue => $floorLabel) {
                              $selected = ($selectedFloor == $floorValue) ? 'selected' : '';
                              echo '<option value="?floor=' . $floorValue . '" ' . $selected . '>' . $floorLabel . '</option>';
                          }
                          echo '</select>
                              </div>';
                          ?>

                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-1">

                    <?php
                      foreach ($room as $key => $room) {
                        $room_id  = $room['room_id'];
                        $room_no = $room['room_no'];
                        $occupy_num = $room['occupy_num'];
                        $floor = $room['floor'];
                        $status = $room['status'];
                        $display_img = $room['display_img'];
                        $available_occupation = $room['available_occupation'];
                        ?>

                      <div class="col">
                        <div class="card">
                          <img src="assets/<?php echo $display_img?>" class="card-img-top" style="height: 20vh; object-fit: cover;" alt="Room 1">
                          <div class="card-body">
                            <div class="room-desc">
                              <span class="room-title"><?php echo $room_no?></span>
                              <?php
                                if($status == "Available"){
                                  ?>
                                  <span class="badge badge-pill badge-success"><?php echo $status?></span>
                                  <?php
                                }else if ($status == "Lacking"){
                                  ?>
                                  <span class="badge badge-pill badge-warning"><?php echo $status . ' ' . $available_occupation?></span>
                                  <?php
                                }else if ($status == "Occupied"){
                                  ?>
                                  <span class="badge badge-pill badge-danger"><?php echo $status?></span>
                                  <?php
                                }
                                ?>
                            </div>
                          </div>
                          <?php 
                            if ($_SESSION["username"] == 'admin') {
                          ?>
                          <div class="card-footer">
                            <button type="button" value="<?php echo $room_id?>" id="view_button" class="btn btn-circle " data-toggle="modal" data-target="#exampleModal">View</button>
                          </div>
                          <?php
                            }
                          ?>
                        </div>
                      </div>
                      <?php
                      }
                      ?>
                    </div>

                    <div class="modal fade" id="exampleModal" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="room_no"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img id="display_img" src="" class="card-img-top" alt="">
                            <div class="d-flex flex-column bd-highlight">
                              <div class="bd-highlight">Floor: <span id="floor"></span></div>
                              <div class="bd-highlight">Available Occupancy: <span id="occupy_num"></span></div>
                              <div class="bd-highlight">Status: <span id="status"></span></div>
                              <div class="bd-highlight" id="tenants"></div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <?php 
                              if ($_SESSION["username"] == 'admin') {
                              ?>
                            <button type="button" id="edit_button" class="btn btn-primary">Edit Details</button>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="addRoom" role="dialog" tabindex="-1" aria-labelledby="addRoomLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><h3>Add Room</h3></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="add_room">
                              <div class="form-group">
                              <label>Floor</label>
                                <select class="form-control mb-3" name="floor" id="floor" required>
                                  <option disabled selected value="">Choose</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>
                                <label>Room No.</label>
                                <input type="text" class="form-control mb-3" name="room_no" id="auto_room_no" required>
                                <label>Max Occupancy</label>
                                <input type="number" class="form-control mb-3" name="occupy_num" required>
                                <label>Status</label>
                                <select class="form-control mb-3" name="status" required>
                                  <option selected value="Available">Available</option>
                                  <option value="Lacking">Lacking</option>
                                  <option value="Occupied">Occupied</option>
                                  <option value="Unavailable">Unavailable</option>
                                </select>
                                <label>Room Image</label>
                                <input type="file" class="form-control-file" name="staffformFile" required>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="editRoom" tabindex="-1" role="dialog" aria-labelledby="addRoomLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><h3>Edit Room</h3></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="edit_room">
                              <input type="hidden" name="new_room_id" id="new_room_id">
                              <img id="new_display_img" src="" class="card-img-top" alt="">
                              <input type="hidden" name="imageSrc" id="imageSrc">
                              <button type="button" class="btn btn-primary  mx-auto d-block mb-3" id="openFileBtn">Change Display Picture</button>
                              <input type="file" id="fileInput" name="fileInput" style="display: none;">
                              <div class="form-group row">
                                <div class="col-6">
                                <label>Room Name</label>
                                <input type="text" class="form-control mb-3" name="new_room_no" id="new_room_no" required>
                                </div>
                                <div class="col-6">
                                <label>Occupy Number</label>
                                <input type="number" class="form-control mb-3" name="new_occupy_num" id="new_occupy_num" required>
                                </div>
                                <div class="col-6">
                                <label>Floor</label>
                                <select class="form-control mb-3" name="new_floor" id="new_floor" required>
                                  <option disabled selected value="">Choose</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>
                                </div>
                                <div class="col-6">
                                <label>Status</label>
                                <select class="form-control mb-3" name="new_status" id="new_status" required>
                                  <option selected value="Available">Available</option>
                                  <option value="Lacking">Lacking</option>
                                  <option value="Occupied">Occupied</option>
                                  <option value="Unavailable">Unavailable</option>
                                </select>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="submit">Save</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                </div>
            </div>
        </div>
      </div>
    <!-- page-body-wrapper ends -->
  <script src="functions.js"></script>
  <?php include_once 'footer.php' ?>