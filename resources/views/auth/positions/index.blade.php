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
    </style>
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div id="additionalDiv" style="display: none; width:100% !important;">

            </div>

            <div class="card-body" id="Div1">
                <div class="parent-div d-flex justify-content-between align-items-center pb-5">
                    <div class="header-title">
                        <h4 class="card-title">ADD Role</h4>
                    </div>
                </div>
                {{-- for display success message  --}}

                {{-- <div id="success-message" class="alert alert-success d-none col-md-4" role="alert">
                    <strong>Success message:</strong> <span id="success-text"></span>
                </div>
                <div id="error-message" class="alert alert-danger d-none col-md-4" role="alert">
                    <strong>Error message:</strong> <span id="error-text"></span>
                </div> --}}

                <div class="row ">
                    <div class="col-md-12">
                        <div class="container main_row">
                            <form id="dept-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Position">Role:</label>
                                            <input type="text" class="form-control" name="name" id="Position"
                                                placeholder="Enter Role">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="orderBy">Order By:</label>
                                            <input type="text" class="form-control" name="order_by" id="orderBy"
                                                placeholder="Enter order by">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="isActive">Is Active:</label>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" value="1"
                                                    name="is_active" id="isActive">
                                                <label class="form-check-label" for="isActive">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" id="btnclose" class="btn btn-danger me-2">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body" id="Div2">
                <div class="parent-div d-flex justify-content-between align-items-center pb-5">
                    <div class="header-title">
                        <h4 class="card-title">Role Record List</h4>
                    </div>
                </div>
                <div class="parent-div d-flex justify-content-between align-items-center pb-5">
                    {{-- display success message here  --}}
                    <div id="success-message" class="alert alert-success d-none col-md-4" role="alert">
                        <strong>Success message:</strong> <span id="success-text"></span>
                    </div>
                    <div id="error-message" class="alert alert-danger d-none col-md-4" role="alert">
                        <strong>Error message:</strong> <span id="error-text"></span>
                    </div>
                    <div class="fordisplymessage"> </div>
                    <button type="button" id="btnaddnew" class="btn btn-primary me-2">Add New</button>
                </div>
                <div class="row">
                    {{-- for displaying success message --}}
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="position-table" class="table table-striped" style="width: 100% !important;">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Role</th>
                                        <th>Order BY</th>
                                        <th>Is Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                                <tfoot class="table-dark">
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Role</th>
                                        <th>Order BY</th>
                                        <th>Is Active</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    {{-- delete modal  --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    Are you sure you want to delete this Position?
                    <input type="hidden" id="deletepositionId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="deleteButton" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit modal  --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Position</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container main_row">
                        <form id="positionEditform" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="departmentName">Position:</label>

                                        <input type="hidden" name="position_id" id="position_id">
                                        <input type="text" class="form-control" name="position" id="editposition"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="orderBy">Order By:</label>
                                        <input type="text" class="form-control" name="order_by" id="editorderBy"
                                            placeholder="Enter order by">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="isActive">Is Active:</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" value="1"
                                                name="edit_is_active" id="editIsActive">
                                            <label class="form-check-label" for="edit_is_active">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="editbutton" type="submit" class="btn btn-primary">Save Changes</button>
                </div>

                </form>
            </div>
        </div>
    </div>
    {{-- Is Active modal  --}}
    <div class="modal fade" id="isactiveModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    Are you sure you want to Change Status?
                    <input type="hidden" id="isactiveId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="isactive" type="button" class="btn btn-primary">Change</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('page-vendor')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    {{-- <script src="{{ asset('assets/auth/js/departments/department-validation.js') }}"></script> --}}
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            // Show the department list initially
            $('#Div2').show();

            // Attach click event handler to the "Add New" button to show Div1 and hide Div2
            $('#btnaddnew').click(function() {
                $('#Div1').show();
                $('#Div2').hide();
            });

            // Attach click event handler to the "Close" button to show Div2 and hide Div1
            $('#btnclose').click(function() {
                $('#Div2').show();
                $('#Div1').hide();
            });

            // Form submission for department insertion
            $(document).on('submit', '#dept-form', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                $.ajax({
                    url: "{{ route('position.store') }}",
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        hideLoader();
                        if (response.success) {
                            table.ajax.reload();
                            $('#Div1').hide();
                            $('#Div2').show();

                            // Show success message in a specific div
                            $('#success-message').text('Data inserted successfully.');
                            $('#success-message').removeClass('d-none');

                            // Hide the success message after 1 second
                            setTimeout(function() {
                                $('#success-message').addClass('d-none');
                            }, 1000);

                            // Clear the input fields
                            $('#dept-form')[0].reset();
                        } else {
                            // Show error message in the error box
                            $('#error-message').text(
                                'Error occurred while submitting the form.');
                            $('#error-message').removeClass('d-none');

                            // Hide the error message after 1 second
                            setTimeout(function() {
                                $('#error-message').addClass('d-none');
                            }, 1000);
                        }
                    },
                    error: function(xhr, status, error) {
                        hideLoader();
                        console.log(xhr.responseText); // Log the response from the server
                        $('#error-message').text(
                            'An error occurred while submitting the form. Please try again.'
                            );
                        $('#error-message').removeClass('d-none');

                        // Hide the error message after 1 second
                        setTimeout(function() {
                            $('#error-message').addClass('d-none');
                        }, 2000);
                    }
                });
            });

            // Delete department
            $(document).on('click', '#deleteButton', function(e) {
                var id = $('#deleteDeptId').val();

                $.ajax({
                    url: "{{ route('deleteDepartment') }}",
                    method: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        hideLoader();
                        $('#deleteModal').modal('hide');

                        // Show success message in a specific div
                        $('#success-message').text('Data deleted successfully.');
                        $('#success-message').removeClass('d-none');

                        // Hide the success message after 2 seconds
                        setTimeout(function() {
                            $('#success-message').addClass('d-none');
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        hideLoader();
                        console.error(error);
                    }
                });
            });

            var table = $('#position-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('position.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'order_by',
                        name: 'order_by'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        render: function(data) {
                            var badgeClass = data === 1 ? 'badge bg-success' : 'badge bg-danger';
                            return '<span class="' + badgeClass + '">' + (data === 1 ? 'Yes' :
                                'No') + '</span>';
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

            // Get data for edit
            $(document).on("click", ".edit", function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '/position/' + id + '/edit',
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        hideLoader();
                        // Display the modal
                        table.ajax.reload();
                        $('#editModal').modal('show');

                        // Set position data
                        $("#position_id").val(response.id);
                        $("#editposition").val(response.name);
                        $("#editorderBy").val(response.order_by);

                        // Set the is_active checkbox
                        if (response.is_active === 1) {
                            $("#editIsActive").prop('checked', true);
                        } else {
                            $("#editIsActive").prop('checked', false);
                        }
                    },
                    error: function(error) {
                        hideLoader();
                        console.log(error);
                    }
                });
            });

            // Update data
            $("#positionEditform").submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var formData = $(this).serialize();

                $.ajax({
                    url: '/position/update',
                    method: 'POST',
                    dataType: 'json',
                    data: formData,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        hideLoader();
                        $('#editbutton').prop('disabled', false);
                        $('#editModal').modal('hide');

                        if (response.success === true) {
                            // Show success message in a specific div
                            table.ajax.reload();
                            $('#success-message').text('Data updated successfully.');
                            $('#success-message').removeClass('d-none');

                            // Hide the success message after 2 seconds
                            setTimeout(function() {
                                $('#success-message').addClass('d-none');
                            }, 2000);

                            // Reset the form
                            $("#positionEditform")[0].reset();
                        } else {
                            // Show error message in a specific div
                            $('#error-message').text(
                                'An error occurred while updating the data. Please try again.'
                                );
                            $('#error-message').removeClass('d-none');

                            // Hide the error message after 2 seconds
                            setTimeout(function() {
                                $('#error-message').addClass('d-none');
                            }, 2000);
                        }
                    },
                    error: function(error) {
                        hideLoader();
                        console.log(error);
                    }
                });

                return false;
            });

            // Delete data
            $(document).on("click", ".delete", function() {
                var id = $(this).data('id');
                $('#deletepositionId').val(id); // Set the value of the hidden input with the position ID
                $('#deleteModal').modal('show'); // Show the delete modal
            });

            // Add a click event listener for the delete button inside the delete modal
            $(document).on("click", "#deleteButton", function() {
                var positionId = $('#deletepositionId').val(); // Get the position ID from the hidden input

                // Send an AJAX request to the server to delete the position
                $.ajax({
                    url: '/position/delete',
                    method: 'POST',
                    data: {
                        id: positionId
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        hideLoader();
                        // Check if the deletion was successful
                        if (response.success === true) {
                            // Show success message in a specific div
                            $('#success-message').text('Record deleted successfully.');
                            $('#success-message').removeClass('d-none');

                            // Hide the success message after 2 seconds
                            setTimeout(function() {
                                $('#success-message').addClass('d-none');
                            }, 2000);

                            // Perform any necessary actions, such as reloading the data table or updating the UI
                            table.ajax.reload();

                            // Reset the form
                            $("#positionEditform")[0].reset();
                        } else {
                            // Show error message in a specific div
                            $('#error-message').text(
                                'Error deleting the record. Please try again.');
                            $('#error-message').removeClass('d-none');

                            // Hide the error message after 2 seconds
                            setTimeout(function() {
                                $('#error-message').addClass('d-none');
                            }, 2000);
                        }

                        // Hide the delete modal
                        $('#deleteModal').modal('hide');
                    },
                    error: function(error) {
                        hideLoader();
                        console.log(error);
                    }
                });

                return false;
            });

            // Set position active/inactive
            $(document).on("click", ".setActive", function() {
                var id = $(this).data('id');
                $('#isactiveId').val(id); // Set the value of the hidden input with the position ID
                $('#isactiveModal').modal('show'); // Show the delete modal
            });

            $(document).on("click", "#isactive", function() {
                var id = $('#isactiveId').val();
                var url = "{{ route('position.update.active', ['id' => ':id']) }}";
                url = url.replace(':id', id);

                // Make the AJAX request
                $.ajax({
                    url: url,
                    type: 'PUT',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        hideLoader();
                        $('#isactiveModal').modal('hide');
                        // Update the DataTable
                        table.ajax.reload(null, false);
                        // Show success message if needed
                        console.log(response.message);
                    },
                    error: function(xhr) {
                        hideLoader();
                        // Show error message if needed
                        console.log(xhr.responseText);
                    }
                });
            });

            function showLoader() {
                $(".loader-overlay").fadeIn("slow");
            }

            function hideLoader() {
                $(".loader-overlay").fadeOut("slow");
            }
        });
    </script>
@endsection
