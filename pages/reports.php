<?php include_once 'header.php' ?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-6 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Income Report</h3>
                    </div>
                    <div class="col-6 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button type="button" class="btn btn-primary btn-sm pl-3 pr-3" data-toggle="modal" data-target="#dateRangeModal">
                                    Generate Report
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="dateRangeModal" tabindex="-1" role="dialog" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateRangeModalLabel">Select Date Range</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="fromDate">From:</label>
                    <input type="date" class="form-control" id="fromDate" placeholder="Select From Date">
                </div>
                <div class="form-group">
                    <label for="toDate">To:</label>
                    <input type="date" class="form-control" id="toDate" placeholder="Select To Date">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="generateReportBtn">Generate Report</button>
            </div>
        </div>
    </div>
</div>
<!-- page-body-wrapper ends -->
</div>
<?php include_once 'footer.php' ?>
