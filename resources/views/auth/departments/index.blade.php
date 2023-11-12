@extends('layouts.auth')
@section('title', 'OPD | Admin Dashboard')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* page loader  */
    </style>
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div id="additionalDiv" style="display: none;">
                <!-- Additional content goes here -->
                <div class="form-container bg-light rounded p-4">
                    <div class="header-title">
                        <h4 class="card-title">Bootstrap Datatables</h4>
                    </div>
                </div>
            </div>

            <div class="card-body" id="Div1">
                <div class="parent-div d-flex justify-content-between align-items-center pb-5">
                    <div class="header-title">
                        <h4 class="card-title">ADD DEPARTMENT</h4>
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
                                            <label for="departmentName">Department Name:</label>
                                            <input type="text" class="form-control" name="name" id="departmentName"
                                                placeholder="Enter department name">
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
                                            <label for="isOpenForAdmission">Is Open for Admission?</label>
                                            <select class="form-control" id="isOpenForAdmission"
                                                name="is_open_for_admission">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
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
                        <h4 class="card-title">Department Record List</h4>
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
                    {{-- for display success message  --}}
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Department Name</th>
                                        <th>Order BY</th>
                                        <th>Is Active</th>
                                        <th>Is Open for Operation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot class="table-dark">
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Department Name</th>
                                        <th>Order BY</th>
                                        <th>Is Active</th>
                                        <th>Is Open for Operation</th>
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

                    Are you sure you want to delete this Department?
                    <input type="hidden" id="deleteDeptId">
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
                    <h5 class="modal-title" id="editModalLabel">Edit Department</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container main_row">
                        <form id="deptEditform" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="departmentName">Department Name:</label>

                                        <input type="hidden" name="dept_id" id="dept_id">
                                        <input type="text" class="form-control" name="dep_name" id="depName"
                                            placeholder="Enter department name">
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
                                        <label for="editisOpenForAdmission">Is Open for Admission?</label>
                                        <select class="form-control" id="editisOpenForAdmission"
                                            name="edit_open_admission">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
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


@endsection

@section('page-vendor')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{ asset('assets/auth/js/departments/department-validation.js') }}"></script>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            fetchdepartment();

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
        }); // Added closing parenthesis here

        // this ajax is for insertion of data
        $(document).on('submit', '#dept-form', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            //var abc = $('#abc').val();
            // Perform Ajax request
            $.ajax({
                url: "{{ route('department.store') }}", // Replace with the appropriate URL for storing department data
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    hideLoader();
                    // Assuming the response is a JSON object with a "success" property
                    if (response.success) {
                        fetchdepartment();
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
                        $('#error-message').text('Error occurred while submitting the form.');
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
                        'An error occurred while submitting the form. Please try again.');
                    $('#error-message').removeClass('d-none');

                    // Hide the error message after 1 second
                    setTimeout(function() {
                        $('#error-message').addClass('d-none');
                    }, 2000);
                }
            });
        });


        // get data in edit modal
        function departmentEdit(pid) {
            $('#editModal').modal('show');
            $('#deptEditform')[0].reset();
            // $('#departmentId').val(pid); // Set the ID value in the departmentId field

            $.ajax({
                url: "{{ route('getDepartments') }}",
                method: 'POST',
                data: {
                    pid: pid
                },
                dataType: 'json',
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    hideLoader();
                    $('#dept_id').val(response.id);
                    $('#depName').val(response.name);
                    $('#editorderBy').val(response.order_by);
                    $('#editisOpenForAdmission').val(response.is_open_for_admission);
                    $('input[name="edit_is_active"][value="' + response.is_active + '"]').prop(
                        'checked', true);
                }
            });
        }
        // Update data in edit modal
        $("#deptEditform").submit(function(e) {
            //alert('updateFOrm');
            e.preventDefault();
            e.stopImmediatePropagation();
            // submit loading button
            //run_waitMe($('#alegationform'), 1, current_effect);
            //$(".updCommonItems").button('loading');
            //  $('#editbutton').prop('disabled', true);
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('updateDepartment') }}",
                method: "POST",
                dataType: "json",
                data: formData,
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    hideLoader();
                    //$("#addAssessmentSub").button('reset');
                    $('#editbutton').prop('disabled', false);
                    $('#editModal').modal('hide');
                    if (response.success === true) {
                        fetchdepartment();
                        // Show success message in a specific div
                        $('#success-message').text('Data Update successfully.');
                        $('#success-message').removeClass('d-none');

                        // Hide the success message after 2 second
                        setTimeout(function() {
                            $('#success-message').addClass('d-none');
                        }, 2000);
                        // /.alert
                        //$("#assessmentCommonItems")[0].reset();
                        //$('.updCommonItems').hide();
                        //$('.editCommonItems').show();
                        //getChargeTemplates();
                        //$(".chosen-select").trigger("chosen:updated");
                    } else {
                        // error messages
                        $('#error-message').text(
                            'An error occurred while submitting the form. Please try again.');
                        $('#error-message').removeClass('d-none');

                        // Hide the error message after 1 second
                        setTimeout(function() {
                            $('#error-message').addClass('d-none');
                        }, 2000);
                    } // /else

                    //$('#alegationform').waitMe("hide");
                }

            });
            return false;
        });


        function deleteDepartment(id) {
            $('#deleteModal').modal('show');
            $('#deleteDeptId').val(id);
        }

        $(document).on('click', '#deleteButton', function(e) {
            var id = $('#deleteDeptId').val();

            $.ajax({
                url: "{{ route('deleteDepartment') }}", // Use the route name defined above
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
                    // Handle the success response here
                    // console.log(response);
                    $('#deleteModal').modal('hide');
                    fetchdepartment();
                    // Show success message in a specific div
                    $('#success-message').text('Data deleted successfully.');
                    $('#success-message').removeClass('d-none');

                    // Hide the success message after 2 seconds
                    setTimeout(function() {
                        $('#success-message').addClass('d-none');
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    // Handle the error response here
                    console.error(error);
                }
            });
        });






        // get data from database to datatable
        // get data from database to datatable
        function fetchdepartment() {
            $.ajax({
                type: "GET",
                url: "fetchdepartment",
                dataType: "json",
                success: function(response) {
                    var departments = response.departments;
                    var i = 1;
                    $('tbody').html("");

                    if (departments.length === 0) {
                        var emptyRow = $('<tr>').append(
                            $('<td colspan="6">').text('Data not found in the table.')
                        );
                        $('tbody').append(emptyRow);
                    } else {
                        $.each(departments, function(index, department) {
                            var row = $('<tr>');
                            row.append($('<td>').text(i++));
                            row.append($('<td>').text(department.name));
                            row.append($('<td>').text(department.order_by));

                            var isActiveSpan = $('<span>').addClass(department.is_active == '1' ?
                                'badge bg-success' : 'badge bg-danger').text(
                                department.is_active == '1' ? 'Yes' : 'No');
                            row.append($('<td>').append(isActiveSpan));

                            var isOpenSpan = $('<span>').addClass(department.is_open_for_admission ==
                                '1' ? 'badge bg-success' : 'badge bg-danger').text(department
                                .is_open_for_admission == '1' ? 'Yes' : 'No');
                            row.append($('<td>').append(isOpenSpan));

                            var actionsDropdown = $('<div>').addClass(
                                'dropdown actiondropdown d-inline-block');
                            var actionsButton = $('<button>').addClass(
                                    'btn btn-primary dropdown-toggle btn-sm').attr('type', 'button')
                                .attr('id', 'dropdownMenuButton').attr('data-bs-toggle', 'dropdown')
                                .attr('aria-haspopup', 'true').attr('aria-expanded', 'false').text(
                                    'Actions');
                            actionsDropdown.append(actionsButton);

                            var dropdownMenu = $('<div>').addClass('dropdown-menu').attr(
                                'aria-labelledby', 'dropdownMenuButton');
                            var editItem = $('<a>').addClass('dropdown-item').attr('href', '#').attr(
                                'onclick', 'departmentEdit(' + department.id + ')').text('Edit');
                            dropdownMenu.append(editItem);

                            var actionItem = $('<a>').addClass('dropdown-item').attr('href', '#').attr(
                                'onclick', 'toggleDepartmentStatus(' + department.id + ', ' +
                                department.is_active + ')');

                            if (department.is_active == '1') {
                                actionItem.text('InActive');
                            } else {
                                actionItem.text('Active');
                            }

                            dropdownMenu.append(actionItem);

                            var deleteButton = $('<button>').addClass('dropdown-item delete-button')
                                .attr('value', department.id).attr('onclick', 'deleteDepartment(' +
                                    department.id + ')').text('Delete');
                            dropdownMenu.append(deleteButton);

                            actionsDropdown.append(dropdownMenu);
                            row.append($('<td>').addClass('text-right').append(actionsDropdown));

                            $('tbody').append(row);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log the error response from the server
                }
            });
        }

        function toggleDepartmentStatus(departmentId, currentStatus) {
            var newStatus = currentStatus === '1' ? '0' : '1';

            $.ajax({
                type: 'PUT',
                url: '/department/update-status/' + departmentId,
                data: {
                    departmentId: departmentId,
                    newStatus: newStatus
                },
                dataType: 'json',
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    hideLoader();
                    // Handle the success response
                    // Refresh the datatable or perform any necessary updates
                    fetchdepartment();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log the error response from the server
                }
            });
        }

        function showLoader() {
                $(".loader-overlay").fadeIn("slow");
            }

            function hideLoader() {
                $(".loader-overlay").fadeOut("slow");
            }
    </script>
@endsection
