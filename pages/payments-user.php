<?php include_once 'header.php';
$status = isset($_GET['status']) ? $_GET['status'] : '';?>

<style>
    /* Custom CSS for Datepicker size */
    .datepicker {
        width: 250px; /* Adjust the width as per your requirement */
    }
    .dropzone {
        border: 2px dashed #007bff;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        width: 100%;
        height: 400px;
    }
    .dropzone:hover {
        background-color: #f8f9fa;
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
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="submit_payment.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="month_of">Month from:</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="month_of" name="month_of" placeholder="Select month and year">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="month_of">To:</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="month_to" name="month_to" placeholder="Select month and year">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="amount">Amount:</label>
                                    <input type="number" id="amount" name="amount" class="form-control" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center mb-2 mt-4">
                                <h5>Upload Receipt</h5>
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="dropzone" for="image" id="dropzone">
                                        <p>Drag & drop your files here or click to select files</p>
                                        <input type="file" id="image" name="image" class="form-control-file" accept="image/*" hidden>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center mb-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-md" style="width:100%">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        
        // Drag and drop functionality
        var dropzone = document.getElementById('dropzone');
        var inputfile = document.getElementById("image");

        dropzone.ondrop = function(e) {
            e.preventDefault();
            $('#image')[0].files = e.dataTransfer.files;
            displayFileName();
        };

        dropzone.ondragover = function() {
            dropzone.style.borderColor = '#17a2b8';
            return false;
        };

        dropzone.ondragleave = function() {
            dropzone.style.borderColor = '#007bff';
            return false;
        };

        $('#image').change(function() {
            //var fileName = $(this).val().split('\\').pop();
            //displayFileName(fileName);
            displayFileName();
        });

        function displayFileName() {
            // Get the file input element
            let inputfile = document.getElementById('image');
            
            if (inputfile.files && inputfile.files[0]) {
                // Create object URL for the selected image
                let imglink = URL.createObjectURL(inputfile.files[0]);
                
                // Create a new image element
                let img = new Image();
                img.onload = function() {
                    // Calculate height to maintain aspect ratio
                    let aspectRatio = img.width / img.height;
                    let height = dropzone.offsetWidth / aspectRatio;

                    // Set dropzone height based on calculated height
                    dropzone.style.height = height + "px";
                    
                    // Set dropzone background image and adjust styles
                    dropzone.style.backgroundImage = `url(${imglink})`;
                    $('#dropzone p').text("");
                    dropzone.style.border = "none";
                    dropzone.style.backgroundRepeat = "no-repeat";
                    dropzone.style.backgroundSize = "cover"; // Adjust background size as needed
                };
                img.src = imglink;
            }
        }
    });
</script>
<script>
    <?php
        if ($status === 'success') {
            echo 'swal({
                title: "Success",
                text: "Payment submitted!",
                icon: "success",
                button: false,
              });
              ';
        } elseif ($status === 'stmtfailed') {
            echo 'swal({
                title: "Error",
                text: "No payment have been submitted!",
                icon: "error",
                button: false,
              });
              ';
        }
    ?>
</script>
<?php include_once 'footer.php' ?>
