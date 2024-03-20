<?php include_once 'header.php' ?>
<style>
        /* Custom CSS for Datepicker size */
        .datepicker {
            width: 250px; /* Adjust the width as per your requirement */
        }
    </style>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Payments</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-margin stretch-card" style="height: 500px">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="datepicker">Date:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="datepicker" placeholder="Select month and year" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                           </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount:</label>
                                    <input type="number" id="amount" class="form-control" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image">Upload Image:</label>
                                    <input type="file" id="image" class="form-control-file">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      </div><script>
    $(document).ready(function(){
        $('#datepicker').datepicker({
            format: 'MM yyyy',
            viewmode: 'months',
            minViewMode: "months"
        });
    });
</script>

    <!-- page-body-wrapper ends -->
    <?php include_once 'footer.php' ?>

