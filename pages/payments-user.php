<?php include_once 'header.php' ?>

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
                        <div class="col-md-12 text-center mb-2 mt-4">
                            <h5>Upload Reciept</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="dropzone" for="image" id="dropzone">
                                    <p>Drag & drop your files here or click to select files</p>
                                    <input type="file" id="image" class="form-control-file" hidden>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#datepicker').datepicker({
            format: 'MM yyyy',
            viewMode: 'months',
            minViewMode: 'months'
        });
        
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
<?php include_once 'footer.php' ?>
