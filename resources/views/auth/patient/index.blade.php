@extends('layouts.auth')
@section('title', 'OPD | Admin Dashboard')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .form-group {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url("arrow.png") no-repeat right center;
            background-size: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Custom radio button styles */
        input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .radio-label {
            display: inline-block;
            position: relative;
            padding-left: 35px;
            /* Increased padding to create space */
            margin-right: 20px;
            /* Increased margin for spacing */
            cursor: pointer;
        }

        .radio-label:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 20px;
            height: 20px;
            border: 2px solid #ccc;
            border-radius: 50%;
        }

        .form-container {

            padding: 20px;
            margin-bottom: 20px;
        }

        .avatar-div {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 200px;
            height: 200px;
            background-color: #f1f1f1;
            border-radius: 50%;
            margin-bottom: 10px;
            background-size: cover;
            background-position: center;

            margin: auto !important;
        }

        .avatar-div img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-group label.btn-info input[type="radio"]:checked {
            background-color: #343a40;
            color: #fff;
        }
        .dataTables_filter,
        .dataTables_length {
            display: none;
        }

        .error {
            color: red;
        }

        .beautiful-line {
            border: none;
            height: 2px;
            margin-top: 0px;
            background: linear-gradient(to right, #ccc, #6d6c6c, #ccc);
        }

        .pb-5 {
            padding-bottom: 5px !important;
        }

        .rounded-image {
            height: 250px;
            border-radius: 30px;
            object-fit: cover;
        }
        .table-style {
            border-radius: 10px !important;
            background-color: #fff;

        }
        .actiondropdown {
            position: unset !important;
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
        .main_row {
            padding: 29px !important;
            margin-top: 20px !important;
            border-radius: 10px !important;
            background-color: rgb(223 215 215 / 50%) !important;
        }
    </style>
@endsection

@section('content')
<div class="row" >
    <div id="showForm" class="table-style  mt-1 p-4 mb-5 " style="display: none;">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid main_row">
                    <div class="parent-div d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="card-title">Add Patient</h4>
                            <hr class="beautiful-line">
                        </div>
                    </div>
                    <form id="patientForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="patientName">Patient Full Name</label>
                                    <input type="text" name="name" id="patientName" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="patientType">Patient Type</label>
                                    <select name="type" id="patientType" class="form-control" required>
                                        <option value="OPD">OPD</option>
                                        <option value="Emergency">Emergency</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="age">Age</label>
                                            <input type="number" name="age" id="age" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="dob">D/M/Y</label>
                                            <select id="dob" name="dob" class="form-control">
                                                <option value="year">Year</option>
                                                <option value="month">Month</option>
                                                <option value="day">Day</option>
                                                <!-- Add date options here -->
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group space border">
                                    <label class="btn btn-info btn-sm"
                                        style="color: #FFFFFF; background-color: #000000;">Gender</label>
                                    <div class="form-group btn-group" data-toggle="buttons" style="margin-top: 14px">
                                        <label for="Male" class="btn btn-info btn-sm"
                                            style="margin-left: 20px; margin-right: 10px;">
                                            <input id="Male" type="radio" name="pat_gender" value="Male" required><i
                                                class="fas fa-male"></i> Male
                                        </label>
                                        <label class="btn btn-info btn-sm" style="margin-right: 20px;">
                                            <input type="radio" name="pat_gender" value="Female" required><i
                                                class="fas fa-female"></i> Female
                                        </label>
                                    </div>
                                    <span id="gender-error" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="cnic">CNIC No.</label>
                                    <input type="text" name="cnic" id="cnic" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="contactNo">Contact No.</label>
                                    <input type="text" name="contact_no" id="contactNo" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="doctor">Doctor</label>
                                    <select id="doctor" name="user_id" class="form-control doctorsSelect" required>
                                        <option value="">Select a Doctor</option>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select name="department_id" id="department" class="form-control departmentsSelect"
                                        required>
                                        <option value="">Select Departmant</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="dob" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="guardianName">Guardian Name</label>
                                    <input type="text" name="guardian_name" id="guardianName" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="guardianContact">Guardian Contact No.</label>
                                    <input type="text" name="guardian_contact" id="guardianContact" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="insurance">Insurance</label>
                                    <select name="insurance_id" class="form-control insuranceSelect" required>
                                        <option value="">Select an Insurance</option>
                                        <!-- Options for insurance will be dynamically populated using JavaScript -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="reference">Reference.</label>
                                    <input type="text" name="reference" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="symptomname">Symptom :</label><br>
                                    <select class="form-control  chosenSelect symptomSelect_i" name="symptom[]" multiple
                                        required onchange="SymptomDescription_i()">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" name="address" class="form-control" required></textarea>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="bg-info rounded-circle avatar-div mt-5">
                                        <img class="avatar-preview"
                                            src="{{ asset('assets/auth/images/avatars/avatar1.avif') }}" alt="">
                                    </div>
                                    <label for="avatar">Image</label>
                                    <input type="file" name="image" class="avatar-input form-control">
                                </div>
                            </div>

                        </div>
                        <div class="text-center">
                            <div class="button-container">
                                <button type="submit" name="submit" id="submitId" class="btn btn-primary">Submit</button>
                                <button id="closeForm" class="btn btn-secondary" type="button">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body table-style  mt-1 p-3 mb-5 main_row" id="showTable" >
        <div class="parent-div d-flex justify-content-between align-items-center pb-3">
            <div class="header-title">
                <h4 class="card-title">Bed Type Record List</h4>
                <hr class="beautiful-line">
            </div>
            <button class=" btn btn-primary" id="addNewForm">Add New</button>
        </div>
        <div id="success-message" class="alert alert-success d-none col-md-4" role="alert">
            <strong>Success message:</strong> <span id="success-text"></span>
        </div>
        <div id="error-message" class="alert alert-danger d-none col-md-4" role="alert">
            <strong>Error message:</strong> <span id="error-text"></span>
        </div>
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
                        <input type="text" id="address" class="form-control form-control-sm mb-2"
                            placeholder="Address">
                        <input type="text" id="contact" class="form-control form-control-sm"
                            placeholder="Contact no">
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="patient-table" class="table table-striped table-bordered table-hover dt-responsive"
                style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Age</th>
                        <th>CNIC</th>
                        <th>Contact No</th>
                        <th>Address</th>
                        <th>Doctor</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">

                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div id="showUpdate" class="table-style  mt-1 p-3 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid main_row">
                    <div class="parent-div d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="card-title">Update Patient</h4>
                            <hr class="beautiful-line">
                        </div>
                    </div>
                    <form id="updateForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updateName">Patient Full Name</label>
                                    <input type="text" name="name" id="updateName" class="form-control" required>
                                    <input type="hidden" name="id" id="updatepatientId" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="patientType">Patient Type</label>
                                    <select name="type" id="updatetype" class="form-control" required>
                                        <option value="OPD">OPD</option>
                                        <option value="Emergency">Emergency</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="age">Age</label>
                                            <input type="number" name="age" id="updateAge" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="dob">D/M/Y</label>
                                            <select id="updateDob" name="dob" class="form-control">
                                                <option value="year">Year</option>
                                                <option value="month">Month</option>
                                                <option value="day">Day</option>
                                                <!-- Add date options here -->
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group space border">
                                    <label class="btn btn-info btn-sm"
                                        style="color: #FFFFFF; background-color: #000000;">Gender</label>
                                    <div class="form-group btn-group" data-toggle="buttons" style="margin-top: 14px">
                                        <label for="updateGenderMale" class="btn btn-info btn-sm"
                                            style="margin-left: 20px; margin-right: 10px;">
                                            <input id="updateGenderMale" type="radio" name="pat_gender" value="Male"
                                                required>
                                            <i class="fas fa-male"></i> Male
                                        </label>
                                        <label for="updateGenderFemale" class="btn btn-info btn-sm"
                                            style="margin-right: 20px;">
                                            <input type="radio" name="pat_gender" value="Female" id="updateGenderFemale"
                                                required>
                                            <i class="fas fa-female"></i> Female
                                        </label>
                                    </div>
                                    <span id="gender-error" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="cnic">CNIC No.</label>
                                    <input type="text" name="cnic" id="updateCnic" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="contactNo">Contact No.</label>
                                    <input type="text" name="contact_no" id="updatecontactNo" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="doctor">Doctor</label>
                                    <select id="updateUser" name="user_id" class="form-control doctorsSelect"
                                        required></select>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select name="department_id" id="updateDepartment" class="form-control departmentsSelect"
                                        required>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="updateBirth" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="updateCity" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="guardianName">Guardian Name</label>
                                    <input type="text" name="guardian_name" id="updateguardianName" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="guardianContact">Guardian Contact No.</label>
                                    <input type="text" name="guardian_contact" id="updateguardianContact"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="insurance">Insurance.</label>
                                    <select name="insurance_id"  class="form-control insuranceSelect" id="updateinsurance" required>
                                        <option value="">Select an Insurance</option>
                                        <!-- Options for insurance will be dynamically populated using JavaScript -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="reference">Reference.</label>
                                    <input type="text" name="reference" class="form-control" id="updatereference" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="updateAddress" name="address" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="bg-info rounded-circle avatar-div mt-5 edit-avatar">
                                        <!-- Updated image will be appended here -->
                                    </div>
                                    <label for="updateAvatar">Image</label>
                                    <input type="file" name="updateImage" class="update-avatar-input form-control">
                                </div>
                            </div>

                        </div>
                        <div class="text-center">
                            <div class="button-container">
                                <button type="submit" id="updateId" name="submit" class="btn btn-primary">Update</button>
                                <button id="closeUpdate" class="btn btn-secondary">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="viewDiv" class="table-style  mt-1 p-4 mb-5">
        <!-- Content of viewDiv -->
        <div class="container">
            <div class="card shadow">
                <div class="card-header dual-horizontal text-white"
                    style=" padding: 10px !important; z-index: 666 !important;">
                    <h4 class="card-title text-white details" style="font-size: 17px">PATIENT DETAILS</h4>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Patient Image</h5>
                                    <div class="avatar-div">
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
                                                <th>Patient Type:</th>
                                                <td id="viewtype"></td>
                                            </tr>

                                            <tr>
                                                <th>Age and Gender:</th>
                                                <td id="viewagegender"></td>
                                            </tr>

                                            <tr>
                                                <th>CNIC No:</th>
                                                <td id="viewcnic"></td>
                                            </tr>
                                            <tr>
                                                <th>Contact No:</th>
                                                <td id="viewcontactno"></td>
                                            </tr>
                                            <tr>
                                                <th>Doctor:</th>
                                                <td id="viewdoctor"></td>
                                            </tr>
                                            <tr>
                                                <th>Department:</th>
                                                <td id="viewdepartment"></td>
                                            </tr>
                                            <tr>
                                                <th>Date of Birth:</th>
                                                <td id="viewbirth"></td>
                                            </tr>
                                            <tr>
                                                <th>City:</th>
                                                <td id="viewcity"></td>
                                            </tr>
                                            <tr>
                                                <th>Guardian Name:</th>
                                                <td id="viewguardinname"></td>
                                            </tr>
                                            <tr>
                                                <th>Guardian Contact No:</th>
                                                <td id="viewguardiancontact"></td>
                                            </tr>
                                            <tr>
                                                <th>Insurance:</th>
                                                <td id="viewinsurance"></td>
                                            </tr>
                                             <tr>
                                                <th>Reference:</th>
                                                <td id="viewreference"></td>
                                            </tr>
                                            <tr>
                                                <th>Address:</th>
                                                <td id="viewaddress"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="closeView" class="btn btn-secondary btn-sm">Close</button>
                </div>
            </div>
        </div>
    </div>





</div>

@endsection
@section('extra-content')
    <!--Delete Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteForm" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
@endsection

@section('page-vendor')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="{{ asset('assets/auth/js/opd/patient-registreation-v.js') }}"></script>
@endsection
@section('page-script')
<script>
    $(document).ready(function() {
        var table = $('#patient-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('patient.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'age',
                    name: 'age'
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
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
        fetchalldoctors();
        fetchalldepartments();
        fetchallinsurances();
        fetchAllSymptoms_i();
        // Add event listeners to search inputs
        $('#fullName, #cnic1, #address, #contact').on('keyup', function() {
            var fullName = $('#fullName').val();
            var cnic = $('#cnic1').val();
            var address = $('#address').val();
            var contact = $('#contact').val();

            var dataTable = $('#patient-table').DataTable();
            dataTable
                .search('')
                .columns()
                .search('')
                .column(1)
                .search(fullName)
                .column(4)
                .search(cnic)
                .column(5)
                .search(contact)
                .column(6)
                .search(address)
                .draw();

            console.log('Searched for Full Name: ' + fullName);
            console.log('Searched for CNIC: ' + cnic);
            console.log('Searched for Address: ' + address);
            console.log('Searched for Contact no: ' + contact);
        });

        // Initial setup
        $("#showTable").show();
        $("#showForm").hide();
        $("#showUpdate").hide();
        $("#viewDiv").hide();

        // Add New Form button click event
        $("#showTable").on("click", "#addNewForm", function() {
            $("#showTable").hide();
            $("#showForm").show();
            fetchallinsurances();
        });

        // Close button click event in showForm
        $("#showForm").on("click", "#closeForm", function() {
            $(".error").text('');
            $("#showForm").hide();
            $("#showTable").show();
        });

        // Edit button click event
        $("#showTable").on("click", ".edit", function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/patient/' + id + '/edit',
                method: 'GET',
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    hideLoader();
                    $("#showTable").hide();
                    $("#showForm").hide();
                    $("#showUpdate").show();
                    $("#updatepatientId").val(response.id);
                    $("#updateName").val(response.name);
                    $("#updatetype").val(response.type);
                    $("#updateAge").val(response.age);
                    $("#updateDob").val(response.dob);
                    $("#updateCnic").val(response.cnic);
                    $("#updatecontactNo").val(response.contact_no);
                    $("#updateUser").val(response.user_id);
                    $("#updateDepartment").val(response.department_id);
                    $("#updateBirth").val(response.date_of_birth);
                    $("#updateCity").val(response.city);
                    $("#updateguardianName").val(response.guardian_name);
                    $("#updateguardianContact").val(response.guardian_contact);
                    $("#updateinsurance").val(response.insurance_id);
                    $("#updatereference").val(response.reference);
                    $("#updateAddress").val(response.address);

                    // Set patient image
                    if (response.image != '') {
                        // Append the response image to the "avatar" element
                        var updatedAvatarImage = '<img src="' + response.image +
                            '" alt="Avatar">';
                        $('.edit-avatar').html(updatedAvatarImage);
                    }
                    // var patientGender = val(response.pat_gender);
                    $("input[name='pat_gender'][value='" + response.pat_gender + "']").prop(
                        'checked',
                        true).trigger('click');
                },
                error: function(error) {
                    hideLoader();
                    console.log(error);
                }
            });
        });

        $("#showUpdate").on("click", "#closeUpdate", function(e) {
            e.preventDefault(); // Prevent the default form submission behavior
            $("#showUpdate").hide();
            $("#showForm").hide();
            $("#showTable").show();
        });

        // View button click event
        $("#showTable").on("click", ".view", function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/patient/' + id + '/show',
                method: 'GET',
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    hideLoader();
                    $("#showTable").hide();
                    $("#viewDiv").show();
                    $("#viewname").html(response.name);
                    $("#viewtype").html(response.type);
                    $("#viewcnic").html(response.cnic);
                    $("#viewcontactno").html(response.contact_no);
                    $("#viewdoctor").html(response.user_id);
                    $("#viewdepartment").html(response.department_id);
                    $("#viewbirth").html(response.date_of_birth);
                    $("#viewcity").html(response.city);
                    $("#viewguardinname").html(response.guardian_name);
                    $("#viewguardiancontact").html(response.guardian_contact);
                    $("#viewinsurance").html(response.insurance_id);
                    $("#viewreference").html(response.reference);
                    $("#viewaddress").html(response.address);
                    $("#viewimage").html("<img src='" + response.image +
                        "' alt='Patient Image' class='rounded-image'>");
                    var age = response.age;
                    var dob = response.dob;
                    var gender = response.pat_gender;
                    var text = age + "  " + dob + "  " + gender;
                    $('#viewagegender').html(text);
                },
                error: function(error) {
                    hideLoader();
                    console.log(error);
                }
            });
        });

        // Close button click event in viewDiv
        $("#viewDiv").on("click", "#closeView", function() {
            $("#viewDiv").hide();
            $("#showTable").show();
        });

        // Image preview function for the initial image
        $('.avatar-input').on('change', function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.avatar-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        // Ajax function to update the image
        $('.update-avatar-input').on('change', function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var updatedAvatarImage = '<img src="' + e.target.result + '" alt="Avatar">';
                $('.edit-avatar').html(updatedAvatarImage);
            }
            reader.readAsDataURL(file);
        });
        $('input[name="pat_gender"]').on('click', function() {
            // Reset the color of all buttons
            $('label.btn-info').removeClass('active');

            // Get the selected button
            var selectedButton = $(this).parent();

            // Add active class to change button color
            selectedButton.addClass('active');

            // Make AJAX request or perform any other action
            // ...
        });

        function fetchalldoctors() {
            $.ajax({
                type: "get",
                url: "fetchalldoctors",
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    hideLoader();
                    $(".doctorsSelect").html('');
                    $.each(response, function(index, doctor) {
                        var option = $("<option>").val(doctor.id).text(doctor.name);
                        $(".doctorsSelect").append(option);
                    });
                },
                error: function(error) {
                    hideLoader();
                    console.log(error);
                }
            });
        }

        function fetchalldepartments() {
            $.ajax({
                type: "get",
                url: "fetchalldepartments",
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    hideLoader();
                    $(".departmentsSelect").html('');
                    $.each(response, function(index, department) {
                        var option = $("<option>").val(department.id).text(department.name);
                        $(".departmentsSelect").append(option);
                    });
                },
                error: function(error) {
                    hideLoader();
                    console.log(error);
                }
            });
        }

        $('#patientForm').on('submit', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#submitId').prop("disabled", true);

            // Fetch the dropdown options using AJAX
            $.ajax({
                url: "{{ route('patient.store') }}",
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    hideLoader();
                    table.ajax.reload();
                    $(".error").text('');
                    $('#submitId').prop("disabled", false);
                    $('#showForm').hide();
                    $('#showTable').show();

                    $('#success-message').text('Data inserted successfully.');
                    $('#success-message').removeClass('d-none');

                    $('.avatar-preview').attr('src',
                        "{{ asset('assets/auth/images/avatars/avatar1.avif') }}");
                    // Hide the success message after 1 second
                    setTimeout(function() {
                        $('#success-message').addClass('d-none');
                    }, 4000);

                    $('#patientForm')[0].reset();
                },
                error: function(error) {
                    hideLoader();
                    $('#submitId').prop("disabled", false);
                    console.log(error)
                }
            });
        });

        // Update form submission
        $('#updateForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission
            var form = $(this);
            var formData = new FormData(form[0]);
            // Get the image file input
            var imageFile = $('#updateForm input[name="updateImage"]')[0].files[0];
            // Check if an image file was selected
            if (imageFile) {
                // Append the image file to the FormData object
                formData.append('updateImage', imageFile);
            }
            $.ajax({
                type: 'POST',
                url: '/patient/update',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    hideLoader();
                    table.ajax.reload();
                    $("#showUpdate").hide();
                    $("#showTable").show();

                    $('#success-message').text('Data updated successfully.');
                    $('#success-message').removeClass('d-none');
                    setTimeout(function() {
                        $('#success-message').addClass('d-none');
                    }, 4000);
                    form[0].reset();
                },
                error: function(error) {
                    hideLoader();
                    console.log(error);
                }
            });
        });

        $("#showTable").on("click", ".delete", function() {
            $('#exampleModal').modal('show');
            var id = $(this).data('id');
            $('#deleteinput').val(id);
        });

        $("#deleteForm").on("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission

            var id = $('#deleteinput').val();
            $.ajax({
                url: '/patient/' + id + '/delete',
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
        function fetchallinsurances() {
    $.ajax({
        type: "get",
        url: "fetchallinsurances", // Replace with the actual endpoint for insurance data
        dataType: "json",
        beforeSend: function() {
            showLoader();
        },
        success: function(response) {
            var insuranceSelect = $(".insuranceSelect");
            insuranceSelect.html('');

            // Add the first option as "Select an Insurance" and make it disabled
            var firstOption = $("<option>").text("Select an Insurance").attr("disabled", true).attr("selected", true);
            insuranceSelect.append(firstOption);

            if (response.length === 0) {
                var option = $("<option>").text("No insurance found");
                insuranceSelect.append(option);
            } else {
                $.each(response, function(index, insurance) {
                    var option = $("<option>").val(insurance.id).text(insurance.organization_name);
                    insuranceSelect.append(option);
                });
            }

            hideLoader();
        },
        error: function(error) {
            hideLoader();
            console.log(error);
        }
    });
}
function fetchAllSymptoms_i() {
            $.ajax({
                type: "GET",
                url: "{{ route('fetchAllSymptoms') }}",
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    $(".symptomSelect_i").html('');

                    if (response.length === 0) {
                        var noSymptomOption = $("<option>").text("No Symptom Found").attr("disabled",
                            "disabled");
                        $(".symptomSelect_i").append(noSymptomOption);
                    } else {
                        $.each(response, function(index, symptom) {
                            var option = $("<option>").val(symptom.name).text(symptom.name);
                            $(".symptomSelect_i").append(option);
                        });
                    }

                    $(".symptomSelect_i").trigger("chosen:updated");
                    hideLoader();
                    // Initialize Chosen.js plugin

                },
                error: function(error) {
                    hideLoader();
                    console.log(error);
                }
            });
        }
        function SymptomDescription_i() {
            // Get the selected symptom IDs from the dropdown
            var selectedSymptomIds = $(".symptomSelect_i").val();

            // If no symptoms are selected, clear the description textarea
            if (selectedSymptomIds === null || selectedSymptomIds.length === 0) {
                return $(".symptom_description_i").val('');

            }

            // Fetch the descriptions of the selected symptoms via AJAX
            $.ajax({
                type: "GET",
                url: "{{ route('fetchSymptomDescription') }}",
                data: {
                    id: selectedSymptomIds
                },
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {

                    // Combine the descriptions into a single string, separated by ', '
                    var descriptions = response.map(function(item) {
                        return item.description;
                    }).join(', ');

                    // Update the description textarea with the combined descriptions
                    $(".symptom_description_i").val(descriptions);
                    hideLoader();
                },
                error: function(error) {
                    hideLoader();
                    console.log(error);
                }
            });
        }
    });


</script>
@endsection
