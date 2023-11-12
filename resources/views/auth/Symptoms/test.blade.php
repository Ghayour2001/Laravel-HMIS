@extends('layouts.auth')
@section('title', 'OPD | Admin Dashboard')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> --}}

    <style>
        /* styles.css */
        .card-body {
            display: none;
            /* Add other necessary CSS styles */
        }

        .error {
            color: red;
        }

        .main_row {
            padding: 29px !important;
            margin-top: 20px !important;
            border-radius: 10px !important;
            background-color: rgb(223 215 215 / 50%) !important;
        }

        .beautiful-line {
            border: none;
            height: 2px;
            margin-top: 0px;
            background: linear-gradient(to right, #929292, #4e4d4d, #919090);
        }

        .actiondropdown {
            position: unset !important;
        }

        .label-cell {
            font-weight: bold;
        }
    </style>
@endsection
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

@section('content')
    <div class="row">
        <div class="col-sm-12">


            <div class="card-body hidediv" id="Div1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container main_row">
                            <div class="parent-div d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">Add Symptom</h4>
                                    <hr class="beautiful-line">
                                </div>
                            </div>
                            <form id="symptoms-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Symptom Name:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Symptom Name">
                                </div>

                                <div class="form-group">
                                    <!-- Add this div for the textarea -->
                                    <label for="description">Symptom Description:</label>
                                    <textarea class="form-control" name="description" rows="5" placeholder="Symptom Description"></textarea>
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary insert-submit-btn">Submit</button>
                                    <button type="button" class="btn btn-danger me-2 insertion-close-btn">Close</button>
                                </div>
                            </form>




                        </div>
                    </div>
                </div>
            </div>



            <div class="card-body hidediv main_row" id="Div2">

                <div class="parent-div d-flex justify-content-between align-items-center pb-3">
                    <div class="header-title">
                        <h4 class="card-title">Symptom Record List</h4>
                        <hr class="beautiful-line">
                    </div>
                    <button class="insertion-btn btn btn-primary">Add New</button>
                </div>
                <div class="responseMessage alert" style="display: none; width:20%; font-weight:bold;"></div>
                {{-- for displaying success message --}}

                <div class="table-responsive">
                    <table id="symptom-table" class="table table-striped" style="width: 100% !important;">
                        <thead class="table-dark">
                            <tr>
                                <th>S.NO</th>
                                <th>Symptom Name</th>
                                <th>Symptom Description</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                                <th>S.NO</th>
                                <th>Symptom Name</th>
                                <th>Symptom Description</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                </ </div>

            </div>

            <!-- viewDiv for displaying symptom details -->
            <div class="card-body hidediv" id="viewDiv">
                <div class="container">
                    <div class="card shadow">
                        <div class="card-header dual-horizontal text-white"
                            style="padding: 10px !important; z-index: 666 !important;">
                            <h4 class="card-title text-white details" style="font-size: 17px">SYMPTOM DETAILS</h4>
                        </div>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="label-heading">Symptom Name:</h6>
                                    <p id="viewSymptomName"></p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="label-heading">Symptom Description:</h6>
                                    <p id="viewSymptomDescription"></p>
                                </div>

                                <!-- Add other fields here if needed -->

                            </div>
                            <div class="text-end">
                                <button type="button" id="viewCloseButton" class="btn btn-danger me-2">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body hidediv" id="editDiv">
                <div class="container">
                    <div class="card shadow">
                        <div class="card-header dual-horizontal text-white"
                            style="padding: 10px !important; z-index: 666 !important;">
                            <h4 class="card-title text-white details" style="font-size: 17px">UPDATE SYMPTOMS </h4>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="container main_row">

                                    <form id="update-symptoms-form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="id" id="updatesymptomId">
                                            <label for="updatesymptomname">Symptom Name:</label>
                                            <input type="text" class="form-control" name="name" id="updatesymptomname"
                                                >
                                        </div>

                                        <div class="form-group">
                                            <!-- Add this div for the textarea -->
                                            <label for="updatesymptomdescription">Symptom Description:</label>
                                            <textarea class="form-control" name="description" id="updatesymptomdescription" rows="5"
                                            ></textarea>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" name="submit"
                                                class="btn btn-primary update-btn">Update</button>
                                            <button type="button"
                                                class="btn btn-danger me-2 insertion-close-btn">Close</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            {{-- delete modal  --}}
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                aria-labelledby="confirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this Insurance Details?
                            <input type="hidden" id="deletesymptomid">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button id="deleteButton" type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>


@endsection


@section('page-vendor')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/auth/js/departments/department-validation.js') }}"></script>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            // Show the department list initially
            $('.hidediv').hide();
            $('#Div2').show();

            // Attach click event handler to the "Add New" button to show Div1 and hide Div2
            $('.insertion-btn').click(function() {
                $('.hidediv').hide();
                $('#Div1').show();
            });

            // Attach click event handler to the "Close" button to show Div2 and hide Div1
            $('.insertion-close-btn').click(function() {
                $('.hidediv').hide();
                $('#Div2').show();
            });

            // Form submission for department insertion
            $('#symptoms-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                $('.insert-submit-btn').prop("disabled", true);
                $('.insert-submit-btn').text('Loading...');

                $.ajax({
                    url: "{{ route('symptom.store') }}",
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('.insert-submit-btn').prop("disabled", false);
                        $('.insert-submit-btn').text('Submit');
                        form[0].reset;
                        table.ajax.reload();
                        $('.hidediv').hide();
                        $('#Div2').show();
                        showAlert(response.success, 'alert-success');
                        hideLoader();

                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        $('.insert-submit-btn').prop("disabled", false);
                        $('.insert-submit-btn').text('Submit');
                        // Show error message in Bootstrap alert
                        showAlert(xhr.responseJSON.error, 'alert-danger');
                        hideLoader();
                    }
                });
            });


            // for datatable
            var table = $('#symptom-table').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('symptom.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    }, {
                        data: 'name',
                        name: 'name'
                    },


                    {
                        data: 'description',
                        name: 'description',
                        render: function(data, type, row) {
                            if (type === 'display' && data.length > 15) {
                                return data.substring(0, 15) + '...';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Delete confirmation message
            $(document).on("click", ".delete", function() {
                var id = $(this).data('id');
                $('#deletesymptomid').val(id); // Set the value of the hidden input with the position ID
                $('#deleteModal').modal('show'); // Show the delete modal
            });

            // To delete the data
            $(document).on("click", "#deleteButton", function() {
                var id = $('#deletesymptomid').val(); // Get the insurance ID from the hidden input

                // Send an AJAX request to the server to delete the insurance record
                $.ajax({
                    url: '/symptom/' + id + '/delete',
                    method: 'POST',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        table.ajax.reload();
                        showAlert(response.success, 'alert-success');
                        $('#deleteModal').modal('hide');
                        $('#Div2').show();
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        // Show error message in Bootstrap alert
                        showAlert(xhr.responseJSON.error, 'alert-danger');
                        $('#deleteModal').modal('hide');
                        $('#Div2').show();
                        hideLoader();
                    }
                });

                return false;
            });


            // for view
            $(document).on("click", ".viewButton", function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '/symptom/' + id +
                        '/show', // Replace 'symptoms' with your actual route for fetching symptom data
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        // Update view elements with symptom data
                        $("#viewSymptomName").text(response.name);
                        $("#viewSymptomDescription").text(response.description);

                        // If you have other symptom properties, update them here as well

                        $(".hidediv").hide();
                        $("#viewDiv").show();
                        hideLoader();
                    },
                    error: function(error) {
                        hideLoader();
                        console.log(error);
                    }
                });
            });

            // Close view div on close button click
            $("#viewCloseButton").click(function() {
                $(".hidediv").hide();
                $("#Div2").show();
            });

            // for edit
            $(document).on("click", ".editButton", function() {
                var id = $(this).data('id');


                $.ajax({
                    url: '/symptom/' + id +
                    '/show', // Replace 'symptoms' with your actual route for fetching symptom data
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        // Update editDiv elements with symptom data
                        $("#updatesymptomId").val(response.id);
                        $("#updatesymptomname").val(response.name);
                        $("#updatesymptomdescription").val(response.description);

                        // If you have other symptom properties, update them here as well
                        $(".hidediv").hide();
                        $("#editDiv").show();
                        hideLoader();
                    },
                    error: function(error) {
                        hideLoader();
                        console.log(error);
                    }
                });
            });



            // Close edit div on close button click
            $("#updateCloseButton").click(function() {
                $(".hidediv").hide();
                $("#Div2").show();
            });

            // ,,,,,,,, for Update the Insurance,,,,,,,,,,,,,,,,,,,,,,,,
            $('#update-symptoms-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var form = $(this);
                var updateBtn = $('.update-btn');

                updateBtn.prop("disabled", true);
                updateBtn.text('Loading...');

                $.ajax({
                    url: "{{ route('symptom.update') }}", // Update the URL to the appropriate endpoint for updating insurance
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        updateBtn.text('Submit');
                        updateBtn.prop("disabled", false);
                        form[0].reset();
                        table.ajax.reload();
                        $('.hidediv').hide();
                        $('#Div2').show();
                        showAlert(response.success, 'alert-success');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        updateBtn.prop("disabled", false);
                        updateBtn.text('Submit');
                        $('.hidediv').hide();
                        $('#Div2').show();
                        // Show error message in Bootstrap alert
                        showAlert(xhr.responseJSON.error, 'alert-danger');
                        hideLoader();
                    }
                });
            });

        });

        // for loader spiner
        function showLoader() {
            $(".loader-overlay").fadeIn("slow");
        }

        function hideLoader() {
            $(".loader-overlay").fadeOut("slow");
        }
        // for alertmeaasage
        function showAlert(message, alertClass) {
            var alertDiv = $('.responseMessage');
            alertDiv.removeClass('alert-success alert-danger ');
            alertDiv.addClass(alertClass);
            alertDiv.text(message)
                .fadeIn()
                .delay(3000) // Delay the alert for 3 seconds
                .fadeOut(); // Fade out the alert
        }
    </script>
@endsection
