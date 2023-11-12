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
            border-radius: 21px !important;
            background-color: rgb(223 215 215 / 50%) !important;
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
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="card-body hidediv mb-5 main_row" id="Div1">
                        <div class="parent-div d-flex justify-content-between align-items-center pb-5">
                            <div class="header-title">
                                <h4 class="card-title">ADD INSURANCE</h4>
                            </div>
                        </div>
                        <div class="container ">
                            <form id="insurance-form" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="organizationName">Organization Name <span
                                                    class="text-danger ml-2">*</span>:</label>
                                            <input type="text" class="form-control" name="organization_name"
                                                id="organizationName" placeholder="Enter Organization Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contactNo">Organization Contact No <span
                                                    class="text-danger ml-2">*</span>:</label>
                                            <input type="tel" class="form-control" name="contact_no" id="contactNo"
                                                placeholder="Enter Contact No" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Organization Email <span
                                                    class="text-danger ml-2">*</span>:</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Enter Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="limit">Limit:</label>
                                            <input type="number" class="form-control" name="limit" id="limit"
                                                placeholder="Enter Limit">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fromDate">Effective From Date <span
                                                    class="text-danger ml-2">*</span>:</label>
                                            <input type="date" class="form-control" name="from_date" id="fromDate"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="toDate">Effective To Date <span
                                                    class="text-danger ml-2">*</span>:</label>
                                            <input type="date" class="form-control" name="to_date" id="toDate"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contactPersonName">Contact Person Name:</label>
                                            <input type="text" class="form-control" name="contact_person_name"
                                                id="contactPersonName" placeholder="Enter Contact Person Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contactPersonPhone">Contact Person Phone:</label>
                                            <input type="tel" class="form-control" name="contact_person_phone"
                                                id="contactPersonPhone" placeholder="Enter Contact Person Phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position">Organization Position <span
                                                    class="text-danger ml-2">*</span>:</label>
                                            <input type="text" class="form-control" name="position" id="position"
                                                placeholder="Enter Position" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address">Address:</label>
                                            <textarea class="form-control" name="address" id="address" placeholder="Enter Address"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary insurance-insert-btn">Submit</button>
                                    <button type="button" id="btnclose" class="btn btn-danger me-2">Close</button>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body hidediv main_row" id="Div2">
                <div class="parent-div d-flex justify-content-between align-items-center pb-3">
                    <div class="header-title">
                        <h4 class="card-title">Insurance Management List</h4>
                        <hr class="beautiful-line">
                    </div>
                    <button type="button" id="btnaddnew" class="btn btn-primary me-2">Add
                        New</button>
                </div>
                <div class="responseMessage alert" style="display: none; width:20%; font-weight:bold;"></div>
                {{-- for displaying success message --}}
                <div class="row">
                    {{-- for displaying success message --}}
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="insurance-table" class="table table-striped" style="width: 100% !important;">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Organization Name</th>
                                        <th>Contact No</th>
                                        <th>Email</th>
                                        <th>Limit</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Contact Person Name</th>
                                        <th>Contact Person Phone</th>
                                        <th>Position</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot class="table-dark">
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Organization Name</th>
                                        <th>Contact No</th>
                                        <th>Email</th>
                                        <th>Limit</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Contact Person Name</th>
                                        <th>Contact Person Phone</th>
                                        <th>Position</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            <div class="card-body hidediv" id="viewDiv">
                <div class="container">
                    <div class="card shadow">
                        <div class="card-header dual-horizontal text-white"
                            style="padding: 10px !important; z-index: 666 !important;">
                            <h4 class="card-title text-white details" style="font-size: 17px">INSURANCE DETAILS</h4>
                        </div>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-6 ps-5">
                                    <h6 class="label-heading">Organization Name:</h6>
                                    <p id="vieworganizationName"></p>

                                    <h6 class="label-heading">Organization Contact No:</h6>
                                    <p id="viewcontactNo"></p>

                                    <h6 class="label-heading">Organization Email:</h6>
                                    <p id="viewemail"></p>

                                    <h6 class="label-heading">Limit:</h6>
                                    <p id="viewlimit"></p>

                                    <h6 class="label-heading">Effective From Date:</h6>
                                    <p id="viewfromDate"></p>
                                </div>

                                <div class="col-md-6 ">
                                    <h6 class="label-heading">Effective To Date:</h6>
                                    <p id="viewtoDate"></p>

                                    <h6 class="label-heading">Contact Person Name:</h6>
                                    <p id="viewcontactPersonName"></p>

                                    <h6 class="label-heading">Contact Person Phone:</h6>
                                    <p id="viewcontactPersonPhone"></p>

                                    <h6 class="label-heading">Organization Position:</h6>
                                    <p id="viewposition"></p>

                                    <h6 class="label-heading">Address:</h6>
                                    <p id="viewaddress"></p>
                                </div>
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
                            <h4 class="card-title text-white details" style="font-size: 17px">UPDATE INSURANCE </h4>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="container main_row">
                                    <form id="update-insurance-form" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="id"
                                                        id="updateOrganizationId">
                                                    <label for="updateOrganizationName">Organization Name <span
                                                            class="text-danger ml-2">*</span>:</label>
                                                    <input type="text" class="form-control" name="organization_name"
                                                        id="updateOrganizationName" placeholder="Enter Organization Name"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="updateContactNo">Organization Contact No <span
                                                            class="text-danger ml-2">*</span>:</label>
                                                    <input type="tel" class="form-control" name="contact_no"
                                                        id="updateContactNo" placeholder="Enter Contact No" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="updateEmail">Organization Email <span
                                                            class="text-danger ml-2">*</span>:</label>
                                                    <input type="email" class="form-control" name="email"
                                                        id="updateEmail" placeholder="Enter Email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="updateLimit">Limit:</label>
                                                    <input type="number" class="form-control" name="limit"
                                                        id="updateLimit" placeholder="Enter Limit">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="updateFromDate">Effective From Date <span
                                                            class="text-danger ml-2">*</span>:</label>
                                                    <input type="date" class="form-control" name="from_date"
                                                        id="updateFromDate" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="updateToDate">Effective To Date <span
                                                            class="text-danger ml-2">*</span>:</label>
                                                    <input type="date" class="form-control" name="to_date"
                                                        id="updateToDate" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="updateContactPersonName">Contact Person Name:</label>
                                                    <input type="text" class="form-control" name="contact_person_name"
                                                        id="updateContactPersonName"
                                                        placeholder="Enter Contact Person Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="updateContactPersonPhone">Contact Person Phone:</label>
                                                    <input type="tel" class="form-control"
                                                        name="contact_person_phone" id="updateContactPersonPhone"
                                                        placeholder="Enter Contact Person Phone">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="updatePosition">Organization Position <span
                                                            class="text-danger ml-2">*</span>:</label>
                                                    <input type="text" class="form-control" name="position"
                                                        id="updatePosition" placeholder="Enter Position" required>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="updateAddress">Address:</label>
                                                    <textarea class="form-control" name="address" id="updateAddress" placeholder="Enter Address"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" name="submit" id="updatebutton"
                                                class="btn btn-primary insurance-update-btn">Update</button>
                                            <button type="button" id="updateCloseButton"
                                                class="btn btn-danger me-2">Close</button>
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
                            <input type="hidden" id="deleteinsuranceid">
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
            $('#btnaddnew').click(function() {
                $('.hidediv').hide();
                $('#Div1').show();
            });

            // Attach click event handler to the "Close" button to show Div2 and hide Div1
            $('#btnclose').click(function() {
                $('.hidediv').hide();
                $('#Div2').show();
            });

            // Form submission for department insertion
            $('#insurance-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                $('.insurance-insert-btn').prop("disabled", true);
                $('.insurance-insert-btn').text('Loading...');

                $.ajax({
                    url: "{{ route('insurance.store') }}",
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('.insurance-insert-btn').prop("disabled", false);
                        $('.insurance-insert-btn').text('Submit');
                        form[0].reset;
                        table.ajax.reload();
                        $('.hidediv').hide();
                        $('#Div2').show();
                        showAlert(response.success, 'alert-success');
                        hideLoader();

                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        $('.insurance-insert-btn').prop("disabled", false);
                        $('.insurance-insert-btn').text('Submit');
                        // Show error message in Bootstrap alert
                        showAlert(xhr.responseJSON.error, 'alert-danger');
                        hideLoader();
                    }
                });
            });


            // for datatable
            var table = $('#insurance-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('insurance.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    }, {
                        data: 'organization_name',
                        name: 'organization_name'
                    },
                    {
                        data: 'contact_no',
                        name: 'contact_no'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'limit',
                        name: 'limit'
                    },
                    {
                        data: 'from_date',
                        name: 'from_date'
                    },
                    {
                        data: 'to_date',
                        name: 'to_date'
                    },
                    {
                        data: 'contact_person_name',
                        name: 'contact_person_name'
                    },
                    {
                        data: 'contact_person_phone',
                        name: 'contact_person_phone'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'address',
                        name: 'address',
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
                $('#deleteinsuranceid').val(id); // Set the value of the hidden input with the position ID
                $('#deleteModal').modal('show'); // Show the delete modal
            });

            // To delete the data
            $(document).on("click", "#deleteButton", function() {
                var id = $('#deleteinsuranceid').val(); // Get the insurance ID from the hidden input

                // Send an AJAX request to the server to delete the insurance record
                $.ajax({
                    url: '/insurance/' + id + '/delete',
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
                        hideLoader();
                    }
                });

                return false;
            });


            // for view
            $(document).on("click", ".viewButton", function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '/insurance/' + id + '/show',
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {

                        // Update view elements with insurance data
                        $("#vieworganizationName").text(response.organization_name);
                        $("#viewcontactNo").text(response.contact_no);
                        $("#viewemail").text(response.email);
                        $("#viewlimit").text(response.limit);
                        $("#viewfromDate").text(response.from_date);
                        $("#viewtoDate").text(response.to_date);
                        $("#viewcontactPersonName").text(response.contact_person_name);
                        $("#viewcontactPersonPhone").text(response.contact_person_phone);
                        $("#viewposition").text(response.position);
                        $("#viewaddress").text(response.address);
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
                    url: '/insurance/' + id + '/show',
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {

                        // Update editDiv elements with insurance data
                        $("#updateOrganizationId").val(response.id);
                        $("#updateOrganizationName").val(response.organization_name);
                        $("#updateContactNo").val(response.contact_no);
                        $("#updateEmail").val(response.email);
                        $("#updateLimit").val(response.limit);
                        $("#updateFromDate").val(response.from_date);
                        $("#updateToDate").val(response.to_date);
                        $("#updateContactPersonName").val(response.contact_person_name);
                        $("#updateContactPersonPhone").val(response.contact_person_phone);
                        $("#updatePosition").val(response.position);
                        $("#updateAddress").val(response.address);
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
            $('#update-insurance-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var form = $(this);
                var updateBtn = $('.insurance-update-btn');

                updateBtn.prop("disabled", true);
                updateBtn.text('Loading...');

                $.ajax({
                    url: "{{ route('insurance.update') }}", // Update the URL to the appropriate endpoint for updating insurance
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
