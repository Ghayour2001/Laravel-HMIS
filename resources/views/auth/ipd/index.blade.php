@extends('layouts.auth')
@section('title', 'OPD | Admin Dashboard')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> --}}



    <style>
        .form-group {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            a width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
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

        @media (max-width: 575px) {
            .col-lg-8 {
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
        }


        .btn-group label.btn-info input[type="radio"]:checked {
            background-color: #222627 color: #fff;
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

        .main_row {
            padding: 29px !important;
            margin-top: 20px !important;
            border-radius: 10px !important;
            background-color: rgb(223 215 215 / 50%) !important;
        }

        .user-photo img {
            border-radius: 47%;
            max-width: 200px;
            height: auto;
            border: 3px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .label-heading {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            line-height: 1.9;
        }

        p {
            margin: 0;
            line-height: 1.6;
            /* Add the desired line height value here */
        }

        .text-end {
            text-align: right;
        }
    </style>
@endsection
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

@section('content')
    <div class="row">
        <div class="col-sm-12">


            <div class="card-body hidediv main_row" id="Div1">

                <div class="form-container">
                    <div class="header-title">
                        <h4 class="card-title">IPD REGISTETATON</h4>
                        <hr class="beautiful-line">
                    </div>
                    <div id="successMessage" class="alert alert-success" style="display: none;"></div>

                    <form id="insertion-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="patientName">Patient Full Name</label>
                                    <input type="text" name="name" id="patientName" class="form-control" required>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="age">Age</label>
                                            <input type="number" name="age" id="age" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="dobType">D/M/Y</label>
                                            <select id="dobType" name="dob" class="form-control">
                                                <option value="year">Year</option>
                                                <option value="month">Month</option>
                                                <option value="day">Day</option>
                                                <!-- Add date options here -->
                                            </select>
                                        </div>
                                    </div>
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
                                    <label for="doctorSelect">Select a Doctor:</label>
                                    <select name="user_id" class="form-control doctorsSelect" required>
                                        <!-- Options will be dynamically populated here -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="insurance">Insurance</label>
                                    <select name="insurance_id" class="form-control insuranceSelect" required>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="symptomname">Symptom :</label><br>
                                    <select class="form-control  chosenSelect symptomSelect_i" name="symptom[]" multiple
                                        required onchange="SymptomDescription_i()">
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="symptom_description">Symptom Description</label>
                                    <textarea id="symptom_description" name="symptom_description" class="form-control symptom_description_i" required></textarea>
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
                                    <input type="text" name="guardian_contact" id="guardianContact"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="bedgroup">Bed Group:</label>
                                    <select class="form-control bedGroupSelect" name="bedgroup_id"
                                        onchange="fetchBedNumbers(this.value)">
                                        <!-- Add class "bedGroupSelect" to the select element -->
                                        <!-- Options will be dynamically loaded using the fetchallbedgroups function -->
                                    </select>
                                </div>
                                <!-- Update the HTML structure with the new select element for bed numbers -->
                                <div class="form-group">
                                    <label for="bedNumber">Bed Number</label>
                                    <select name="bed_id" class="form-control bedSelect" required disabled>
                                        <!-- Options for Bed Number will be populated dynamically by the fetchbeds() function -->
                                        <option value="">Select Bed Number</option>
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" name="address" class="form-control" required></textarea>
                                </div>

                            </div>
                            <!-- Right Column -->
                            <div class="col-md-4">


                                <div class="form-group">
                                    <div class="avatar-wrapper mt-5">
                                        <img class="avatar-image"
                                            src="{{ asset('assets/auth/images/avatars/avatar1.avif') }}" alt="Avatar">
                                        <div class="avatar-overlay">
                                            <label for="image" class="btn btn-light">
                                                <i class="bi bi-camera-fill"></i> Select Image
                                            </label>
                                        </div>
                                        <input type="file" name="image" class="image form-control visually-hidden"
                                            id="image" accept="image/*">
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <label for="reference">Reference</label>
                                    <input type="text" name="reference" id="reference" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Enter password">
                                </div>
                                <div class="form-group">
                                    <label for="isActive">Food:</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" value="1" name="food"
                                            id="isActive">
                                        <label class="form-check-label" for="isActive">Yes/No</label>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label class="form-label-group">Chosen.js Multi-Select Example</label> <br>
                                    <select class="form-control chosenSelect" name="">

                                        <option value="option1">Option 1</option>
                                        <option value="option2">Option 2</option>
                                        <option value="option3">Option 3</option>
                                    </select>
                                </div> --}}

                                <div class="form-group space border">
                                    <label class="btn btn-info btn-sm"
                                        style="color: #FFFFFF; background-color: #000000;">Gender</label>
                                    <div class="form-group btn-group" data-toggle="buttons" style="margin-top: 14px">
                                        <label for="Male" class="btn btn-info btn-sm"
                                            style="margin-left: 20px; margin-right: 10px;">
                                            <input id="Male" type="radio" name="pat_gender" value="Male"
                                                required><i class="fas fa-male"></i> Male
                                        </label>
                                        <label class="btn btn-info btn-sm" style="margin-right: 20px;">
                                            <input type="radio" name="pat_gender" value="Female" required><i
                                                class="fas fa-female"></i> Female
                                        </label>
                                    </div>
                                    <span id="gender-error" class="text-danger"></span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3 offset-md-9 text-md-right">
                                <button class="btn btn-secondary insertion-close-btn" type="button">Close</button>
                                <button type="submit" name="submit"
                                    class="btn btn-primary insert-submit-btn">Submit</button>
                            </div>

                        </div>
                    </form>


                </div>
            </div>



            <div class="card-body hidediv main_row mb-5" id="Div2">

                <div class="parent-div d-flex justify-content-between align-items-center pb-3">
                    <div class="header-title">
                        <h4 class="card-title">IPD Record List</h4>
                        <hr class="beautiful-line">
                    </div>
                    <button class="insertion-btn btn btn-primary">Add New</button>
                </div>
                <div class="responseMessage alert" style="display: none; width:20%; font-weight:bold;"></div>
                {{-- for displaying success message --}}
                <div class="table-responsive">
                    <table id="ipd-table" class="table table-striped" style="width: 100% !important;">
                        <thead>
                            <tr>
                                <th>S.ID</th>
                                <th>Patient Name</th>
                                <th>Bed Bedgroup</th>
                                <th>Bed Number</th>
                                <th>Doctor</th>
                                <th>Age & Gender</th>
                                <th>Phone No</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>


            </div>

        </div>

        <!-- viewDiv for displaying symptom details -->
        <!-- View Section for displaying IPD Registration details -->
        <div class="card-body hidediv mb-5" id="viewDiv">
            <div class="container">
                <div class="card shadow">
                    <div class="card-header dual-horizontal text-white"
                        style="padding: 10px !important; z-index: 666 !important;">
                        <h4 class="card-title text-white details" style="font-size: 17px">IPD PATIENT VIEW</h4>
                    </div>

                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-4 ps-5">
                                <div id="view-image" class="user-photo m-b-30">
                                </div>
                            </div>
                            <div class="col-md-4 mt-5">
                                <h6 class="label-heading">Patient Full Name:</h6>
                                <p id="viewPatientName">[Display the patient's full name here]</p>

                                <h6 class="label-heading">Age:</h6>
                                <p id="viewAge">[Display the patient's age here]</p>

                                <h6 class="label-heading">Date of Birth:</h6>
                                <p id="viewDateOfBirth">[Display the patient's date of birth here]</p>

                                <h6 class="label-heading">CNIC No.:</h6>
                                <p id="viewCNIC">[Display the patient's CNIC number here]</p>

                                <h6 class="label-heading">Contact No.:</h6>
                                <p id="viewContactNo">[Display the patient's contact number here]</p>

                                <h6 class="label-heading">City:</h6>
                                <p id="viewCity">[Display the patient's city here]</p>

                                <h6 class="label-heading">Guardian Name:</h6>
                                <p id="viewGuardianName">[Display the guardian's name here]</p>

                                <h6 class="label-heading">Guardian Contact No.:</h6>
                                <p id="viewGuardianContact">[Display the guardian's contact number here]</p>

                                <h6 class="label-heading">Gender:</h6>
                                <p id="viewGender">[Display the patient's gender here]</p>
                            </div>

                            <div class="col-md-4 mt-5">
                                <h6 class="label-heading">Doctor:</h6>
                                <p id="viewDoctor"></p>

                                <h6 class="label-heading">Insurance:</h6>
                                <p id="viewInsurance">[Display the selected insurance information here]</p>

                                <h6 class="label-heading">Department:</h6>
                                <p id="viewDepartment">[Display the selected department here]</p>

                                <h6 class="label-heading">Bed Group:</h6>
                                <p id="viewBedGroup">[Display the selected bed group here]</p>

                                <h6 class="label-heading">Bed Number:</h6>
                                <p id="viewBedNumber">[Display the selected bed number here]</p>

                                <h6 class="label-heading">Symptom Name(s):</h6>
                                <p id="viewSymptomNames">[Display the selected symptom names here]</p>

                                <h6 class="label-heading">Symptom Description:</h6>
                                <p id="viewSymptomDescription">[Display the symptom description here]</p>

                                <h6 class="label-heading">Address:</h6>
                                <p id="viewAddress">[Display the patient's address here]</p>

                                <h6 class="label-heading">Reference:</h6>
                                <p id="viewReference">[Display the reference information here]</p>

                                <h6 class="label-heading">Food Active:</h6>
                                <p id="viewFoodActive">[Display whether food is active or not here]</p>
                            </div>
                        </div>
                        <!-- No changes in the Close button section -->
                        <div class="text-end">
                            <button type="button" id="viewCloseButton" class="btn btn-danger me-2">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body hidediv mb-5" id="editDiv">
            <div class="card-header dual-horizontal text-white"
                style="padding: 10px !important; z-index: 666 !important;">
                <h4 class="card-title text-white details" style="font-size: 17px">UPDATE REGISTETATON </h4>
            </div>
            <div class="form-container">
                <div class="header-title">
                    <h4 class="card-title">UPDATE IPD REGISTETATON</h4>
                    <hr class="beautiful-line">
                </div>
                <div id="successMessage" class="alert alert-success" style="display: none;"></div>

                <form id="update-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="updatePatientName">Patient Full Name</label>
                                <input type="hidden" id="updateipdId" name="id">
                                <input type="text" name="name" id="updatePatientName" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="updateAge">Age</label>
                                        <input type="number" name="age" id="updateAge" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="updateDobType">D/M/Y</label>
                                        <select id="updateDobType" name="dob" class="form-control">
                                            <option value="year">Year</option>
                                            <option value="month">Month</option>
                                            <option value="day">Day</option>
                                            <!-- Add date options here -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="updateCnic">CNIC No.</label>
                                <input type="text" name="cnic" id="updateCnic" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="updateContactNo">Contact No.</label>
                                <input type="text" name="contact_no" id="updateContactNo" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="updateDoctorSelect">Select a Doctor:</label>
                                <select name="user_id" class="form-control doctorsSelect" id="updatedoctorsSelect"
                                    required>
                                    <!-- Options will be dynamically populated here -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="updateInsurance">Insurance</label>
                                <select name="insurance_id" class="form-control insuranceSelect"
                                    id="updateinsuranceSelect" required>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="symptomname">Symptom Name:</label><br>
                                <select class="form-control  chosenSelect symptomSelect" id="updatesymptomname"
                                    name="symptom[]" multiple required onchange="SymptomDescription()">
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="symptom_description">Symptom Description</label>
                                <textarea id="updatesymptom_description" name="symptom_description" class="form-control symptom_description"
                                    required></textarea>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="updateDepartment">Department</label>
                                <select name="department_id" id="updateDepartment" class="form-control departmentsSelect"
                                    required>
                                    <option value="">Select Department</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="updateDob">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="updateDateOfBirth" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="updateCity">City</label>
                                <input type="text" name="city" id="updateCity" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="updateGuardianName">Guardian Name</label>
                                <input type="text" name="guardian_name" id="updateGuardianName" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="updateGuardianContact">Guardian Contact No.</label>
                                <input type="text" name="guardian_contact" id="updateGuardianContact"
                                    class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="updateBedGroup">Bed Group:</label>
                                <select class="form-control bedGroupSelect" name="bedgroup_id" id="updateBedgroup"
                                    onchange="fetchBedNumbers(this.value)">
                                    <!-- Add class "updateBedGroupSelect" to the select element -->
                                    <!-- Options will be dynamically loaded using the fetchallbedgroups function -->
                                </select>
                            </div>
                            <!-- Update the HTML structure with the new select element for bed numbers -->
                            <div class="form-group">
                                <label for="updateBedNumber">Bed Number</label>
                                <select name="bed_id" id="updateBedNumber" class="form-control bedSelect" required>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="updateAddress">Address</label>
                                <textarea id="updateAddress" name="address" class="form-control" required></textarea>
                            </div>

                        </div>
                        <!-- Right Column -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="avatar-wrapper mt-5">
                                    <img class="avatar-image" src="" id="edit-image" alt="Avatar">
                                    <div class="avatar-overlay">
                                        <label for="image" class="btn btn-light">
                                            <i class="bi bi-camera-fill"></i> Select Image
                                        </label>
                                    </div>
                                    <input type="file" name="image" class="image form-control visually-hidden"
                                        id="image" accept="image/*">
                                </div>
                            </div>

                            <div class="form-group mt-5">
                                <label for="updateReference">Reference</label>
                                <input type="text" name="reference" id="updateReference" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="updateIsActive">Food:</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="1" name="food"
                                        id="updateFoodActive">
                                    <label class="form-check-label" for="updateIsActive">Yes/No</label>
                                </div>
                            </div>

                            <div class="form-group space border">
                                <label class="btn btn-info btn-sm"
                                    style="color: #FFFFFF; background-color: #000000;">Gender</label>
                                <div class="form-group btn-group" data-toggle="buttons" style="margin-top: 14px">
                                    <label for="updateMale" class="btn btn-info btn-sm"
                                        style="margin-left: 20px; margin-right: 10px;">
                                        <input id="updateMale" type="radio" name="pat_gender" value="Male"
                                            required><i class="fas fa-male"></i> Male
                                    </label>
                                    <label class="btn btn-info btn-sm" style="margin-right: 20px;">
                                        <input type="radio" name="pat_gender" value="Female" required><i
                                            class="fas fa-female"></i> Female
                                    </label>
                                </div>
                                <span id="updateGender-error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 offset-md-9 text-md-right">
                            <button class="btn btn-secondary close-btn" type="button">Close</button>
                            <button type="submit" name="submit"
                                class="btn btn-primary update-submit-btn">Submit</button>
                        </div>
                    </div>
                </form>


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
                        Are you sure you want to delete this Insurance Details?
                        <input type="hidden" id="deleteipdid">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
@endsection
@section('page-script')
    <script>
        //      $(".chosenSelect").chosen({
        //        width: "100%",
        //        allow_single_deselect: true,
        //        no_results_text: "Oops, nothing selected!"
        //    });
        //    $(".symptomSelect").trigger("chosen:updated");
        $(document).ready(function() {
            fetchAlldoctor();
            fetchAllInsurances();
            fetchAllSymptoms();
            fetchAllSymptoms_i();
            fetchAlldepartment();
            fetchbedgroups();





            // Show the department list initially
            $('.hidediv').hide();
            $('#Div2').show();


            // Attach click event handler to the "Add New" button to show Div1 and hide Div2
            $('.insertion-btn').click(function() {
                $('.hidediv').hide();
                $('#Div1').show();
                $('#update-form')[0].reset();
                $(".symptomSelect").trigger("chosen:updated");

            });

            // Attach click event handler to the "Close" button to show Div2 and hide Div1
            $('.insertion-close-btn').click(function() {
                $('.hidediv').hide();
                $('#Div2').show();
                // Reset the form when the "Close" button is clicked
                $('#insertion-form')[0].reset();
                $(".symptomSelect_i").trigger("chosen:updated");


            });

            // when i click on gander button it change the color
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

            // when i select img from file it display in the avatar
            $('#image').on('change', function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.avatar-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);

            });
            // Attach click event handler to the "Close" button to show Div2 and hide Div1
            $('.close-btn').click(function() {
                $('.hidediv').hide();
                $('#Div2').show();

            });




            //
            // Form submission for department insertion
            $('#insertion-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                $('.insert-submit-btn').prop("disabled", true);
                $('.insert-submit-btn').text('Loading...');

                $.ajax({
                    url: "{{ route('ipd.store') }}",
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
                        hideLoader();
                        showAlert(response.success, 'alert-success');

                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        $('.insert-submit-btn').prop("disabled", false);
                        $('.insert-submit-btn').text('Submit');
                        // Show error message in Bootstrap alert
                        hideLoader();
                        showAlert(xhr.responseJSON.error, 'alert-danger');
                    }
                });
            });

            // for datatable
            var table = $('#ipd-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ipd.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'bedgroup.name',
                        name: 'bedgroup.name'
                    },

                    {
                        data: 'bed.name',
                        name: 'bed.name'
                    },

                    {
                        data: 'user.name',
                        name: 'user.name'
                    },


                    {
                        data: null,
                        name: 'Age & Gender',
                        render: function(data, type, row) {
                            return row.age + ' ' + row.dob + '   ' + row.pat_gender + '';
                        }
                    },
                    {
                        data: 'contact_no',
                        name: 'contact_no'
                    },

                    // {
                    //     data: 'symptom_description',
                    //     name: 'symptom_description',
                    //     render: function(data, type, row) {
                    //         if (type === 'display' && data.length > 15) {
                    //             return data.substring(0, 15) + '...';
                    //         } else {
                    //             return data;
                    //         }
                    //     }
                    // },
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
                $('#deleteipdid').val(id); // Set the value of the hidden input with the position ID
                $('#deleteModal').modal('show'); // Show the delete modal
            });
            // To delete the data
            $(document).on("click", "#deleteButton", function() {
                var id = $('#deleteipdid').val(); // Get the insurance ID from the hidden input

                // Send an AJAX request to the server to delete the insurance record
                $.ajax({
                    url: '/ipd/' + id + '/delete',
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

            $(document).on("click", ".viewButton", function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '/ipd/' + id +
                        '/show', // Replace 'insurance' with your actual route for IPD Registration
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        // Update view elements with IPD Registration data
                        $("#viewPatientName").text(response.name);
                        $("#viewAge").text(response.age);
                        $("#viewDateOfBirth").text(response.date_of_birth);
                        $("#viewCNIC").text(response.cnic);
                        $("#viewContactNo").text(response.contact_no);
                        $("#viewCity").text(response.city);
                        $("#viewGuardianName").text(response.guardian_name);
                        $("#viewGuardianContact").text(response.guardian_contact);
                        $("#viewGender").text(response.pat_gender);
                        $("#viewDoctor").text(response.user_id);
                        $("#viewInsurance").text(response.insurance_id);
                        $("#viewDepartment").text(response.department_id);
                        $("#viewBedGroup").text(response.bedgroup_id);
                        $("#viewBedNumber").text(response.bednumber_id);

                        // Handle the comma-separated symptom names
                        $("#viewSymptomNames").text(response.symptom_names.join(', '));

                        $("#viewSymptomDescription").text(response.symptom_description);
                        $("#viewAddress").text(response.address);
                        $("#viewReference").text(response.reference);
                        $("#viewFoodActive").text(response.food === 1 ? "Active" :
                            "Inactive");

                        // Handle image display (if you have an image)
                        $("#view-image").html("<img src='" + response.image + "'>");
                        // Assuming the image URL is returned in the 'image' property

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

            // Edit Button Click Event
            $(document).on("click", ".editButton", function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '/ipd/' + id + '/edit',
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {

                        // Update editDiv elements with IPD Registration data for editing
                        $("#updateipdId").val(response.id);
                        $("#updatePatientName").val(response.name);
                        $("#updateAge").val(response.age);
                        $("#updateDateOfBirth").val(response.date_of_birth);
                        $("#updateCnic").val(response.cnic);
                        $("#updateContactNo").val(response.contact_no);
                        $("#updateCity").val(response.city);
                        $("#updateGuardianName").val(response.guardian_name);
                        $("#updateGuardianContact").val(response.guardian_contact);
                        // $("#updateGender").val(response.pat_gender);
                        // var patientGender = val(response.pat_gender);
                        $("input[name='pat_gender'][value='" + response.pat_gender + "']").prop(
                            'checked',
                            true).trigger('click');
                        $("#updatedoctorsSelect").val(response.user_id);
                        $("#updateinsuranceSelect").val(response.insurance_id);
                        $("#updateDepartment").val(response.department_id);
                        $("#updateBedgroup").val(response.bedgroup_id);
                        // Fetch and set Bed Numbers for the selected Bed Group
                        fetchBedNumbers(response.bedgroup_id, response.bed_id);
                        //alert(response.bed_id);
                        // $("#updateBedNumber").val(response.bed_id);
                        $(".bedSelect").val(response.bed_id);





                        var symptomsArray = response.symptom.split(','); // Convert to an array
                        $(".symptomSelect").val(symptomsArray);
                        $(".symptomSelect").trigger("chosen:updated");

                        $("#updatesymptom_description").val(response.symptom_description);
                        $("#updateAddress").val(response.address);
                        $("#updateReference").val(response.reference);

                        if (response.food === 1) {
                            $("#updateFoodActive").prop('checked', true);
                        } else {
                            $("#updateFoodActive").prop('checked', false);
                        }

                        // Handle image display
                        var imageUrl = response.image ? response.image :
                            "{{ asset('assets/auth/images/avatars/avatar1.avif') }}";
                        $("#edit-image").attr("src", imageUrl);

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


            $('#update-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                var formData = new FormData(form[0]);
                // Get the image file input
                var imageFile = $('#image')[0].files[0];

                // Check if an image file was selected
                if (imageFile) {
                    // Append the image file to the FormData object
                    formData.append('image', imageFile);
                }
                // var form = $(this);
                var updateBtn = $('.update-submit-btn');

                updateBtn.prop("disabled", true);
                updateBtn.text('Loading...');

                $.ajax({

                    url: "{{ route('ipd.update') }}", // Update the URL to the appropriate endpoint for updating IPD data
                    method: 'POST', // Use PUT method for update
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        updateBtn.text('Submit');
                        updateBtn.prop("disabled", false);
                        table.ajax.reload();
                        form[0].reset();
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

            // ... Your other code ...




        });




        function fetchAlldoctor() {
            $.ajax({
                type: "GET",
                url: "{{ route('fetchAlldoctor') }}", // Replace with the actual endpoint for fetching all doctors
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {

                    $(".doctorsSelect").html('');

                    // Add a default "No Doctor Found" option when there are no doctors
                    if (response.length === 0) {
                        var noDoctorOption = $("<option>").text("No Doctor Found").attr("disabled", "disabled");
                        $(".doctorsSelect").append(noDoctorOption);
                    } else {
                        // Add a disabled option for the first time
                        var selectDoctorOption = $("<option>").text("Select a Doctor").attr("disabled",
                            "disabled").attr("selected", "selected");
                        $(".doctorsSelect").append(selectDoctorOption);

                        $.each(response, function(index, doctor) {
                            var option = $("<option>").val(doctor.id).text(doctor.name);
                            $(".doctorsSelect").append(option);
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

        function fetchAllInsurances() {
            $.ajax({
                type: "GET",
                url: "{{ route('fetchAllInsurances') }}", // Replace with the actual endpoint for fetching all insurances
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {

                    $(".insuranceSelect").html('');

                    // Add a default "No Insurance Found" option when there are no insurances
                    if (response.length === 0) {
                        var noInsuranceOption = $("<option>").text("No Insurance Found").attr("disabled",
                            "disabled");
                        $(".insuranceSelect").append(noInsuranceOption);
                    } else {
                        // Add a disabled option for the first time
                        var selectInsuranceOption = $("<option>").text("Select an Insurance").attr("disabled",
                            "disabled").attr("selected", "selected");
                        $(".insuranceSelect").append(selectInsuranceOption);

                        $.each(response, function(index, insurance) {
                            var option = $("<option>").val(insurance.id).text(insurance
                                .organization_name);
                            $(".insuranceSelect").append(option);
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

        function fetchAllSymptoms() {
            $.ajax({
                type: "GET",
                url: "{{ route('fetchAllSymptoms') }}",
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    $(".symptomSelect").html('');

                    if (response.length === 0) {
                        var noSymptomOption = $("<option>").text("No Symptom Found").attr("disabled",
                            "disabled");
                        $(".symptomSelect").append(noSymptomOption);
                    } else {
                        $.each(response, function(index, symptom) {
                            var option = $("<option>").val(symptom.name).text(symptom.name);
                            $(".symptomSelect").append(option);
                        });
                    }

                    $(".symptomSelect").trigger("chosen:updated");
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

        function SymptomDescription() {
            // Get the selected symptom IDs from the dropdown
            var selectedSymptomIds = $(".symptomSelect").val();

            // If no symptoms are selected, clear the description textarea
            if (selectedSymptomIds === null || selectedSymptomIds.length === 0) {
                return $(".symptom_description").val('');

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
                    $(".symptom_description").val(descriptions);
                    hideLoader();
                },
                error: function(error) {
                    hideLoader();
                    console.log(error);
                }
            });
        }

        function fetchAlldepartment() {
            $.ajax({
                type: "GET",
                url: "{{ route('fetchAlldepartment') }}", // Replace with the actual endpoint for fetching all doctors
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {

                    $(".departmentsSelect").html('');

                    // Add a default "No Doctor Found" option when there are no doctors
                    if (response.length === 0) {
                        var noDepartment = $("<option>").text("No Department Found").attr("disabled",
                            "disabled");
                        $(".departmentsSelect").append(noDepartment);
                    } else {
                        // Add a disabled option for the first time
                        var selectDepartment = $("<option>").text("Select a Department").attr("disabled",
                            "disabled").attr("selected", "selected");
                        $(".departmentsSelect").append(selectDepartment);

                        $.each(response, function(index, Department) {
                            var option = $("<option>").val(Department.id).text(Department.name);
                            $(".departmentsSelect").append(option);
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

        function fetchbedgroups() {
            $.ajax({
                type: "get",
                url: "fetchbedgroups",
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    var bedGroupSelect = $(".bedGroupSelect");
                    bedGroupSelect.html('');

                    // Add the first option as "Select bed group" and make it disabled
                    var firstOption = $("<option>").text("Select bed group").attr("disabled", true).attr(
                        "selected", true);
                    bedGroupSelect.append(firstOption);

                    if (response.length === 0) {
                        var option = $("<option>").text("No bed group found");
                        bedGroupSelect.append(option);
                    } else {
                        $.each(response, function(index, bedGroup) {
                            var option = $("<option>").val(bedGroup.id).text(bedGroup
                                .nameWithFloor); // Use the nameWithFloor property
                            bedGroupSelect.append(option);
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

        function fetchBedNumbers(group_id = null, selected_bed_id = null) {
            // If no bed group is selected, clear the bed number select and disable it
            if (!group_id) {
                $(".bedSelect").empty().append('<option value="">Select Bed Number</option>').prop("disabled", true);
                return;
            }

            // Fetch the bed numbers for the selected bed group via AJAX
            $.ajax({
                type: "GET",
                url: "{{ route('fetchbednumbers') }}",
                data: {
                    id: group_id
                },
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    // if (selected_bed_id) {
                    //     $(".bedSelect").val(selected_bed_id);
                    // }
                    // Update the bed number select with the fetched bed numbers and enable it
                    var bedOptions = '<option value="">Select Bed Number</option>';
                    response.forEach(function(bednumber) {
                        bedOptions += '<option value="' + bednumber.id + '">' + bednumber.name +
                            '</option>';
                    });
                    $(".bedSelect").html(bedOptions).prop("disabled", false);

                    // After populating the bed options, check if there's a selected bed and set it as selected
                    if (selected_bed_id) {
                        $(".bedSelect").val(selected_bed_id);
                    }
                    hideLoader();
                },
                error: function(error) {
                    hideLoader();
                    console.log(error);
                }
            });
        }
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
