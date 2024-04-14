<?php 
include_once 'header.php';
include_once 'survey_complain_function.php' ?>
<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        .btn-group .dropdown-toggle::after {
            content: none;
        }

        .dropdown-item{
            width: 95%;
            margin-left: 4px;
        }
        .surveyTable .wrap-text {
            white-space: normal !important;
            word-wrap: break-word;
        }
    </style>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Surveys / Complains</h3>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Surveys</h3>
                    </div>
                    <div class="grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <colgroup>
                                            <col style="width: auto;"> 
                                            <col style="width: auto;"> 
                                            <col style="width: 20px;"> 
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php getAllSeurveys(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Complains</h3>
                    </div>
                    <div class="grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <colgroup>
                                            <col style="width: auto;"> 
                                            <col style="width: auto;"> 
                                            <col style="width: 20px;"> 
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php getAllComplains(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

    <div class="modal fade" id="modalSurvey" tabindex="-1" role="dialog" aria-labelledby="modalSurveyLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="editAccount.php"  method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h4 id="tenants_name_survey"></h4>
                        <div class="grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table surveyTable">
                                            <colgroup>
                                                <col style="width: auto;"> 
                                                <col style="width: auto;"> 
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th>Questions</th>
                                                    <th>Reponse</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="wrap-text">How satisfied are you with the overall cleanliness and condition of your dorm room and common areas?</td>
                                                    <td id="question1"></td>
                                                </tr>
                                                <tr>
                                                    <td class="wrap-text">To what extent do you feel your current roommate situation contributes to a positive and productive living environment?</td>
                                                    <td id="question2"></td>
                                                </tr>
                                                <tr>
                                                    <td class="wrap-text">How often are you disturbed by noise levels in your dorm (from roommates, hallway activity, etc.) that make it difficult to study, sleep, or relax?</td>
                                                    <td id="question3"></td>
                                                </tr>
                                                <tr>
                                                    <td class="wrap-text">Besides your dorm room, are there adequate study spaces available in the dormitory or nearby buildings that you find conducive to focused work?</td>
                                                    <td id="question4"></td>
                                                </tr>
                                                <tr>
                                                    <td class="wrap-text">How confident do you feel in the overall security measures in place for the dormitory (building access control, security personnel, etc.)?</td>
                                                    <td id="question5"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close-btn" class="btn btn-secondary btn-md" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalComplain" tabindex="-1" role="dialog" aria-labelledby="modalComplainLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="editAccount.php"  method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                    <h4 id="tenants_name_complain"></h4>
                        <div class="grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Complain</label>
                                        <textarea class="form-control" id="complain_box" rows="7" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close-btn" class="btn btn-secondary btn-md" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
     
      <script>
      feather.replace();
    </script>
    <script>
    $(document).ready(function () {
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>
<div id="modal-container"></div>
<script>
    // jQuery script to handle modal display
    $(document).ready(function(){
        $(document).on("click", "#view-survey", function (e) {
        e.preventDefault();
        var survey_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "server_function.php?view_survery_id=" + survey_id,
            success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                alert(res.message);
            } else if (res.status == 200) {
                $('#tenants_name_survey').text(res.data.name);
                $('#question1').text(res.data.question1);
                $('#question2').text(res.data.question2);
                $('#question3').text(res.data.question3);
                $('#question4').text(res.data.question4);
                $('#question5').text(res.data.question5);
                $('#modalSurvey').modal('show');
            }
            },
        });
        });

        $(document).on("click", "#view-complain", function (e) {
        e.preventDefault();
        var complain_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "server_function.php?view_complain_id=" + complain_id,
            success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                alert(res.message);
            } else if (res.status == 200) {
                $('#tenants_name_complain').text(res.data.name);
                $('#complain_box').val(res.data.complain);
                $('#modalComplain').modal('show');
            }
            },
        });
        });
    });
</script>
    <!-- page-body-wrapper ends -->
    <?php include_once 'footer.php' ?>

