@extends('layouts.auth')
@section('title', 'OPD | Admin Dashboard')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .container {
            padding: 15px;
        }

        .avatar-wrapper {
            position: relative;
            width: 200px;
            height: 200px;
            margin: auto;

        }


        .avatar-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .avatar-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0.1;
            transition: opacity 0.3s;
            cursor: pointer;
            border-radius: 15px;
        }

        .avatar-overlay:hover {
            opacity: 0.6;
            border-radius: 15px;
        }

        .avatar-overlay i {
            color: white;
            font-size: 24px;
        }

        /* @media (max-width: 575px) {
            .col-lg-12 {
                flex-basis: 100%;
                max-width: 100%;
            }
        }

        @media (max-width: 767px) {
            .avatar-wrapper {
                height: 100px;
                width: 100px;
            }

            .avatar-overlay i {
                font-size: 20px;
            }
        } */



        .beautiful-line {
            border: none;
            height: 2px;
            margin-top: 0px;
            background: linear-gradient(to right, #ccc, #6d6c6c, #ccc);
        }

        .shadow {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            border-radius: 20px
                /* Adjust the values to achieve the desired shadow effect */
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .button-container button {
            padding: 8px 13px;
            font-size: 15px;
        }

        .rounded-image {
            height: 225px;
            width: 225px;
            object-fit: cover;
            border-radius: 50%
        }


        .dataTables_filter,
        .dataTables_length {
            display: none;
        }

        .error {
            color: red !important;
        }

        .card-body {
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
          .table-style {
            border-radius: 10px !important;
            background-color: #fff;

        }
        .main_row {
            padding: 29px !important;
            margin-top: 20px !important;
            border-radius: 10px !important;
            background-color: rgb(223 215 215 / 50%) !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div id="insertFormDiv" class="table-style  mt-1 p-4 mb-5" style="display: none; margin-bottom:100px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid main_row">
                        <div class="parent-div d-flex justify-content-between align-items-center">
                            <div class="header-title">
                                <h4 class="card-title">STAFF REGISTERATION</h4>
                                <hr class="beautiful-line">
                            </div>
                        </div>
                        <form id="employeeForm"  method="post" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="Name"
                                            placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="fatherName" class="form-label">Father Name</label>
                                        <input type="text" name="father_name" class="form-control" id="fatherName"
                                            placeholder="Enter father name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" id="dob">
                                    </div>
                                    <div class="form-group">
                                        <label for="cnic" class="form-label">CNIC</label>
                                        <input type="text" name="cnic" class="form-control" id="cnic"
                                            placeholder="Enter CNIC number">
                                    </div>
                                    <div class="form-group">
                                        <label for="department" class="form-label">Department</label>
                                        <select name="department_id" id="department"
                                            class="form-control departmentsSelect">
                                            <option value="">Select Department</option>
                                            <!-- Options will be populated dynamically -->
                                        </select>
                                    </div>
                                </div>
                                <!-- Middle Column -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="qualification" class="form-label">Qualification</label>
                                        <input type="text" name="qualification" class="form-control"
                                            id="qualification" placeholder="Enter qualification">
                                    </div>
                                    <div class="form-group">
                                        <label for="probationPeriod" class="form-label">Contract Duration</label>
                                        <select name="probation_period" class="form-control" id="probationPeriod"
                                            aria-label="Contract Duration">
                                            <option selected disabled>Probation Period</option>
                                            <option value="3months">3 months</option>
                                            <option value="6months">6 months</option>
                                            <option value="1year">1 year</option>
                                            <option value="2years">2 years</option>
                                            <option value="3years">3 years</option>
                                            <option value="6years">6 years</option>
                                            <option value="permanent">Permanent</option>
                                        </select>
                                    </div>

                                        <div class="form-group">
                                            <label for="contactNo" class="form-label">Contact No</label>
                                            <input type="tel" name="contact_no" class="form-control" id="contactNo"
                                                placeholder="Enter contact no">
                                        </div>
                                        <div class="form-group">
                                            <label for="position" class="form-label">Position</label>
                                            <select name="position_id" class="form-control positionsSelect" id="position">
                                              <!-- Options will be dynamically populated by the fetchAllPositions() function -->
                                            </select>
                                          </div>


                                    <div class="form-group">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter address"></textarea>
                                    </div>
                                </div>
                                <!-- Right Column -->
                                <div class="col-md-4">
                                    <div class="avatar-wrapper mt-5">
                                        <img class="avatar-image"
                                            src="{{ asset('assets/auth/images/avatars/avatar1.avif') }}"
                                            alt="Avatar">
                                        <div class="avatar-overlay">
                                            <label for="image" class="btn btn-light">
                                                <i class="bi bi-camera-fill"></i> Select Image
                                            </label>
                                        </div>
                                    </div>
                                    <input type="file" name="image" class="form-control visually-hidden"
                                        id="image" accept="image/*">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Enter password">
                                    </div>
                                </div>
                            </div>
                            <!-- Submit and Close Buttons -->
                            <div class="text-center">
                                <div class="button-container">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" id="insertCloseButton" class="btn btn-dark">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="table-style  mt-1 p-4 mb-5 main_row" id="dataTable" style="margin-bottom:100px;">
            <div class="parent-div d-flex justify-content-between align-items-center pb-3 ">
                <div class="header-title">
                    <h4 class="card-title">STAFF RECORD LIST</h4>
                    <hr class="beautiful-line">
                </div>
                <button class=" btn btn-primary" id="addButton">Add New</button>
            </div>
            <div id="responseMessage" class="alert w-25" role="alert" style="display: none;"></div>
            <div class="search-container mb-3" style="padding-bottom: 0px !important;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" id="fullName" class="form-control form-control-sm mb-2"
                                placeholder="Full Name">
                            <input type="text" id="cnic1" class="form-control form-control-sm"
                                placeholder="CNIC">
                        </div>
                        <div class="col-md-3 offset-6">
                            <input type="text" id="fname" class="form-control form-control-sm mb-2"
                                placeholder="F/Name">
                            <input type="text" id="contact" class="form-control form-control-sm"
                                placeholder="Contact no">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="margin-top: 0%;">
                <table id="employee-table" class="table table-striped table-bordered table-hover dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>F/Name</th>
                            <th>CNIC</th>
                            <th>Contact No</th>
                            <th>Position</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>


        <div id="editDiv" class="table-style  mt-1 p-4 mb-5" style="display: none; margin-bottom:100px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid main_row">
                        <div class="parent-div d-flex justify-content-between align-items-center">
                            <div class="header-title">
                                <h4 class="card-title">UPDATE STAFF</h4>
                                <hr class="beautiful-line">
                            </div>
                        </div>
                        <form id="editForm" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateName" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="updateName"
                                            placeholder="Enter name">
                                        <input type="hidden" name="user_id" class="form-control" id="updatId"
                                            placeholder="Enter employee ID">
                                    </div>
                                    <div class="form-group">
                                        <label for="updatefatherName" class="form-label">Father Name</label>
                                        <input type="text" name="father_name" class="form-control"
                                            id="updatefatherName" placeholder="Enter father name">
                                    </div>
                                    <div class="form-group">
                                        <label for="updateemail" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="updateemail"
                                            placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="updatedob" class="form-label">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" id="updatedob">
                                    </div>
                                    <div class="form-group">
                                        <label for="updatecnic" class="form-label">CNIC</label>
                                        <input type="text" name="cnic" class="form-control" id="updatecnic"
                                            placeholder="Enter CNIC number">
                                    </div>
                                    <div class="form-group">
                                        <label for="updateDepartment" class="form-label">Department</label>
                                        <select name="department_id" id="updateDepartment"
                                            class="form-control departmentsSelect" required>
                                            <option value="">Select Department</option>
                                            <!-- Options will be populated dynamically -->
                                        </select>
                                    </div>
                                </div>
                                <!-- Middle Column -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updatequalification" class="form-label">Qualification</label>
                                        <input type="text" name="qualification" class="form-control"
                                            id="updatequalification" placeholder="Enter qualification">
                                    </div>
                                    <div class="form-group">
                                        <label for="updateprobationPeriod" class="form-label">Contract Duration</label>
                                        <select name="probation_period" class="form-control" id="updateprobationPeriod"
                                            aria-label="Contract Duration">
                                            <option selected disabled>Probation Period</option>
                                            <option value="3months">3 months</option>
                                            <option value="6months">6 months</option>
                                            <option value="1year">1 year</option>
                                            <option value="2years">2 years</option>
                                            <option value="3years">3 years</option>
                                            <option value="6years">6 years</option>
                                            <option value="permanent">Permanent</option>
                                        </select>
                                    </div>
                                        <div class="form-group">
                                            <label for="updatecontactNo" class="form-label">Contact No</label>
                                            <input type="tel" name="contact_no" class="form-control"
                                                id="updatecontactNo" placeholder="Enter contact no">
                                        </div>
                                        <div class="form-group">
                                            <label for="updateposition" class="form-label">Position</label>
                                            <select name="position_id" class="form-control positionsSelect" id="updateposition">
                                              <!-- Options will be dynamically populated by the fetchAllPositions() function -->
                                            </select>
                                          </div>

                                    <div class="form-group">
                                        <label for="updateaddress" class="form-label">Address</label>
                                        <textarea class="form-control" name="address" id="updateaddress" rows="3" placeholder="Enter address"></textarea>
                                    </div>
                                </div>
                                <!-- Right Column -->
                                <div class="col-md-4">
                                    <div class="avatar-wrapper mt-5">
                                        <img class="avatar-image" src="">
                                        <div class="avatar-overlay">
                                            <label for="image" class="btn btn-light">
                                                <i class="bi bi-camera-fill"></i> Select Image
                                            </label>
                                        </div>
                                    </div>
                                    <input type="file" name="updateImage" class="form-control visually-hidden"
                                        id="image" accept="image/*">
                                </div>
                            </div>
                            <!-- Submit and Close Buttons -->
                            <div class="text-center">
                                <div class="button-container">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" id="editCloseButton" class="btn btn-dark">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="viewDiv" style="display: none; margin-bottom:100px;">
            <!-- Content of viewDiv -->
            <div class="container">
                <div class="card shadow">
                    <div class="card-header dual-horizontal text-white"
                        style=" padding: 10px !important; z-index: 666 !important;">
                        <h4 class="card-title text-white details" style="font-size: 17px">EMPLOYEE DETAILS</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Employee Image</h5>
                                        <div class="avatar">
                                            <div id="viewimage"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Patient Information</h5>
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>Name:</th>
                                                    <td id="viewname"></td>
                                                </tr>
                                                <tr>
                                                    <th>F/Name:</th>
                                                    <td id="viewfname"></td>
                                                </tr>

                                                <tr>
                                                    <th>Email:</th>
                                                    <td id="viewemail"></td>
                                                </tr>

                                                <tr>
                                                    <th>Date of Birth:</th>
                                                    <td id="viewdob"></td>
                                                </tr>
                                                <tr>
                                                    <th>Cnic:</th>
                                                    <td id="viewcnic"></td>
                                                </tr>
                                                <tr>
                                                    <th>Department:</th>
                                                    <td id="viewdepartment"></td>
                                                </tr>
                                                <tr>
                                                    <th>Contact No:</th>
                                                    <td id="viewcontactno"></td>
                                                </tr>
                                                <tr>
                                                    <th>Position:</th>
                                                    <td id="viewposition"></td>
                                                </tr>
                                                <tr>
                                                    <th>Qualification:</th>
                                                    <td id="viewqualification"></td>
                                                </tr>
                                                <tr>
                                                    <th>Probebation Period:</th>
                                                    <td id="viewprobation"></td>
                                                </tr>
                                                <tr>
                                                    <th>Address:</th>
                                                    <td id="viewaddress"></td>
                                                </tr>
                                                <tr>
                                                    <th>Status:</th>
                                                    <td id="viewstatus"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button id="viewCloseButton" class="btn btn-secondary btn-sm">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Delete Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form id="deleteForm" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this record?</p>
                            <input type="hidden" id="deleteinput" name="id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection


@section('page-vendor')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{ asset('assets/auth/js/users/user-validation.js') }}"></script>
    <script src="{{ asset('assets/auth/js/users/updateUser-validation.js') }}"></script>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {

            let ids = location.hash;
             ids = ids.substring(1);
			 sids = ids.split('#90');
             bed_id = sids[0].slice(2);
             bedgroup_id = sids[1];
			// $('.patMainId').val(patid);

			// alert(bedgroup_id);
			// alert(bed_id);
			//alert(bedgroup_id);
            var table = $('#employee-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'father_name',
                        name: 'father_name'
                    },
                    {
                        data: 'cnic',
                        name: 'cnic'
                    },
                    {
                        data: 'contact_no',
                        name: 'contact_no'
                    },
                    {
                        data: 'position.name',
                        name: 'position.name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            if (data == 0) {
                                return '<span class="badge bg-danger p-2 ">Inactive</span>';
                            } else if (data == 1) {
                                return '<span class="badge bg-success p-2 ">Active</span>';
                            } else {
                                return '';
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

            fetchAllDepartments();
            fetchAllPositions();

            // Add event listeners to search inputs
            $('#fullName, #cnic1, #fname, #contact').on('keyup', function() {
                var fullName = $('#fullName').val();
                var cnic = $('#cnic1').val();
                var fname = $('#fname').val();
                var contact = $('#contact').val();

                var dataTable = $('#employee-table').DataTable();
                dataTable
                    .search('')
                    .columns()
                    .search('')
                    .column(1)
                    .search(fullName)
                    .column(3)
                    .search(cnic)
                    .column(4)
                    .search(contact)
                    .column(2)
                    .search(fname)
                    .draw();

                console.log('Searched for Full Name: ' + fullName);
                console.log('Searched for CNIC: ' + cnic);
                console.log('Searched for F/Name: ' + fname);
                console.log('Searched for Contact no: ' + contact);
            });

            // Show datatable by default
            $("#dataTable").show();

            // Show insert form div on button click
            $("#addButton").click(function() {
                // Hide other divs
                $("#dataTable, #editDiv, #viewDiv, #addButton").hide();
                $("#insertFormDiv").show();
            });

            // Close insert form div on close button click
            $("#insertCloseButton").click(function() {
                $("#insertFormDiv").hide();
                $("#dataTable").show();
                $("#addButton").show();
            });

            // Show edit div on edit button click
            $(document).on("click", ".editButton", function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/user/' + id + '/edit',
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        hideLoader();
                        $("#dataTable, #insertFormDiv, #viewDiv").hide();
                        $("#editDiv").show();
                        $("#updatId").val(response.id);
                        $("#updateName").val(response.name);
                        $("#updatefatherName").val(response.father_name);
                        $("#updateemail").val(response.email);
                        $("#updatedob").val(response.dob);
                        $("#updatecnic").val(response.cnic);
                        $("#updatecontactNo").val(response.contact_no);
                        $("#updateposition").val(response.position_id);
                        $("#updateDepartment").val(response.department_id);
                        $("#updatequalification").val(response.qualification);
                        $("#updateprobationPeriod").val(response.probation_period);
                        $("#updateaddress").val(response.address);
                        $("#updatepassword").val(response.password);

                        // Set patient image
                        if (response.image !== '') {
                            // Update the avatar image source
                            $('.avatar-image').attr('src', response.image);

                            // Update the avatar overlay label
                            $('.avatar-overlay label').html(
                                '<i class="bi bi-camera-fill"></i> Change Image');
                        }
                    },
                    error: function(error) {
                        hideLoader();
                        console.log(error);
                    }
                });
            });

            // Close edit div on close button click
            $("#editCloseButton").click(function() {
                $("#editDiv").hide();
                $("#dataTable").show();
                $('.avatar-image').attr('src', "{{ asset('assets/auth/images/avatars/avatar1.avif') }}");
            });

            $(document).on("click", ".viewButton", function() {
                var id = $(this).data('id');
                $("#dataTable, #insertFormDiv, #editDiv").hide();
                $("#viewDiv").show();
                $.ajax({
                    url: '/user/' + id + '/show',
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        hideLoader();
                        // Hide other divs
                        // Update view elements with employee data
                        $("#viewname").text(response.name);
                        $("#viewfname").text(response.father_name);
                        $("#viewemail").text(response.email);
                        $("#viewdob").text(response.dob);
                        $("#viewcnic").text(response.cnic);
                        $("#viewdepartment").text(response.department_id);
                        $("#viewcontactno").text(response.contact_no);
                        $("#viewposition").text(response.position);
                        $("#viewqualification").text(response.qualification);
                        $("#viewprobation").text(response.probation_period);
                        $("#viewaddress").text(response.address);
                        if (response.status == 1) {
                            $("#viewstatus").text("Active");
                        } else if (response.status == 0) {
                            $("#viewstatus").text("Inactive");
                        }

                        // Update image source
                        $("#viewimage").html("<img src='" + response.image +
                            "' alt='Patient Image' class='rounded-image'>");
                    },
                    error: function(error) {
                        hideLoader();
                        console.log(error);
                    }
                });
            });

            // Close view div on close button click
            $("#viewCloseButton").click(function() {
                $("#viewDiv").hide();
                $("#dataTable").show();
            });

            /* Employee insertion code */
            // Form submission
            $('#employeeForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);

                // Add the "submitting" class to the loader overlay
                $(".loader-overlay").addClass("submitting");

                $.ajax({
                    url: "{{ route('user.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        hideLoader();
                        // Assuming you have a DataTable called "table" for refreshing data
                        table.ajax.reload();

                        $(".error").text('');
                        $("#insertFormDiv").hide();
                        $("#dataTable").show();
                        $("#addButton").show();

                        // Reset form and set default avatar image
                        form[0].reset();
                        $('.avatar-image').attr('src',
                            "{{ asset('assets/auth/images/avatars/avatar1.avif') }}");

                        // Show success message in Bootstrap alert
                        $("#responseMessage")
                            .removeClass("alert-danger")
                            .addClass("alert-success")
                            .text(response.message)
                            .fadeIn()
                            .delay(3000) // Delay the alert for 3 seconds
                            .fadeOut(); // Fade out the alert
                    },
                    error: function(xhr, status, error) {
                        hideLoader();
                        // Show error message in Bootstrap alert
                        $("#responseMessage")
                            .removeClass("alert-success")
                            .addClass("alert-danger")
                            .text("An error occurred: " + error)
                            .fadeIn()
                            .delay(3000) // Delay the alert for 3 seconds
                            .fadeOut(); // Fade out the alert
                    }
                });
            });

            $('#image').on('change', function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.avatar-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            });

            // Submit edit form using AJAX
            $("#editForm").submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                // Get the image file input
                var imageFile = $('#image')[0].files[0];

                // Check if an image file was selected
                if (imageFile) {
                    // Append the image file to the FormData object
                    formData.append('updateImage', imageFile);
                }

                $.ajax({
                    type: 'POST',
                    url: '/user/update',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        hideLoader();
                        // Assuming you have a DataTable called "table" for refreshing data
                        table.ajax.reload();

                        // Reset avatar image
                        $('.avatar-image').attr('src',
                            "{{ asset('assets/auth/images/avatars/avatar1.avif') }}");

                        // Show success message in Bootstrap alert
                        $("#responseMessage")
                            .removeClass("alert-danger")
                            .addClass("alert-success")
                            .text(response.message)
                            .fadeIn()
                            .delay(3000) // Delay the alert for 3 seconds
                            .fadeOut(); // Fade out the alert

                        // Hide edit div and show the DataTable
                        $("#editDiv").hide();
                        $("#dataTable").show();
                    },
                    error: function(xhr, status, error) {
                        hideLoader();
                        // Show error message in Bootstrap alert
                        $("#responseMessage")
                            .removeClass("alert-success")
                            .addClass("alert-danger")
                            .text("An error occurred: " + error)
                            .fadeIn()
                            .delay(3000) // Delay the alert for 3 seconds
                            .fadeOut(); // Fade out the alert

                        console.log(error);
                    }
                });
            });

            $("#dataTable").on("click", ".delete", function() {
                $('#exampleModal').modal('show');
                var id = $(this).data('id');
                $('#deleteinput').val(id);
            });

            $("#deleteForm").on("submit", function(event) {
                event.preventDefault(); // Prevent the default form submission

                var id = $('#deleteinput').val();
                $.ajax({
                    url: '/user/' + id + '/delete',
                    method: 'POST', // Assuming you want to use the POST method for deletion
                    data: $(this).serialize(), // Serialize the form data
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        hideLoader();
                        // Clear the table and reinitialize it
                        table.ajax.reload(); // Fetch and load the updated data
                        $('#exampleModal').modal(
                            'hide'); // Hide the modal after successful deletion
                    },
                    error: function(error) {
                        hideLoader();
                        console.log(error);
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


        function fetchAllDepartments() {
            $.ajax({
                type: "get",
                url: "/fetchemployeedepartments", // Corrected the URL path
                dataType: "json",
                success: function(response) {
                    $(".departmentsSelect").html('');
                    $.each(response, function(index, department) {
                        var option = $("<option>").val(department.id).text(department.name);
                        $(".departmentsSelect").append(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error); // Handle error if necessary
                }
            });
        }
        function fetchAllPositions() {
  $.ajax({
    type: "get",
    url: "/fetchuserpositions", // Update the URL path to fetch positions
    dataType: "json",
    success: function(response) {
      $(".positionsSelect").html('');
      $.each(response, function(index, position) {
        var option = $("<option>").val(position.id).text(position.name);
        $(".positionsSelect").append(option);
      });
    },
    error: function(xhr, status, error) {
      console.log(error); // Handle error if necessary
    }
  });
}

    </script>
@endsection
