@extends('layouts.auth')
@section('title', 'OPD | Admin Dashboard')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hide-div {
            display: none;
        }

        .bed-navbar {
            background-color: #f1f1f1;
            overflow: hidden;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            border: 2px solid #333;
        }

        .bed-navbar button {
            float: left;
            border: none;
            outline: none;
            padding: 14px 16px;
            font-size: 16px;
            background-color: inherit;
            cursor: pointer;
            transition: background-color 0.3s;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .bed-navbar button:before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            background-color: #FFD700;
            transition: height 0.3s;
            z-index: -1;
        }

        .bed-navbar button:hover:before,
        .bed-navbar button.active:before {
            height: 100%;
        }

        .bed-navbar button:hover {
            background-color: #ddd;
            color: #000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .bed-navbar button:focus {
            background-color: #ddd;
            outline: none;
        }

        .bed-navbar::after {
            content: "";
            display: table;
            clear: both;
        }

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

        .table-style {
            border-radius: 10px !important;
            background-color: #fff;

        }

        .status-btn {
            width: 125px;
            /* Set your desired width */
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="bed-navbar">
            <button id="bed-status" class="active">Bed Status</button>
            <button id="bed">Bed</button>
            <button id="bed-type">Bed Type</button>
            <button id="bed-group">Bed Group</button>
            <button id="floor">Floor</button>
        </div>
        <!---------------------------starting bedstatus section---------------------------------->
        <div class="hide-div table-style mt-1 p-3 mb-3 " id="show-bed-status">
            <div class="hide-div main_row" id="bedstatus-table-div">
                <div id="bedtype-datatable">
                    <div class="parent-div d-flex justify-content-between align-items-center pb-3">
                        <div class="header-title">
                            <h4 class="card-title">Bed Status Record List</h4>
                            <hr class="beautiful-line">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="bedstatus-table" class="table table-striped table-bordered table-hover dt-responsive"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Bed Type</th>
                                    <th class="text-center">Bed Group</th>
                                    <th class="text-center">Floor</th>
                                    <th class="text-center">status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">

                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
        <!---------------------------starting bed section---------------------------------->
        <div class="hide-div table-style mt-1 p-3 mb-3 " id="show-bed">
            <div class="hide-div main_row" id="bed-table-div">
                <div id="bedtype-datatable">
                    <div class="parent-div d-flex justify-content-between align-items-center pb-3">
                        <div class="header-title">
                            <h4 class="card-title">Bed Type Record List</h4>
                            <hr class="beautiful-line">
                        </div>
                        <button class="bed-insertion-btn btn btn-primary">Add New</button>
                    </div>
                    <div class="responseMessage alert" style="display: none; font-weight:bold;"></div>
                    <div class="table-responsive">
                        <table id="bed-table" class="table table-striped table-bordered table-hover dt-responsive"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Bed Type</th>
                                    <th class="text-center">Bed Group</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">

                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <div class="hide-div" id="bed-insertion-div">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container main_row">
                            <div class="parent-div d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">Add Bed</h4>
                                    <hr class="beautiful-line">
                                </div>
                            </div>
                            <form id="add-bed-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                </div>

                                <div class="form-group">
                                    <label for="bedtype">Bed Type:</label>
                                    <select class="form-control bedTypeSelect" name="bedtype_id">
                                        <!-- Options will be dynamically loaded using the fetchallbedtypes function -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="bedgroup">Bed Group:</label>
                                    <select class="form-control bedGroupSelect" name="bedgroup_id">
                                        <!-- Add class "bedGroupSelect" to the select element -->
                                        <!-- Options will be dynamically loaded using the fetchallbedgroups function -->
                                    </select>
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary bedinsert-form-submit-btn">Submit</button>
                                    <button type="button"
                                        class="btn btn-danger me-2 bed-insertion-close-btn">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hide-div" id="bed-edit-div">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container main_row">
                            <div class="parent-div d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">Update Bed</h4>
                                    <hr class="beautiful-line">
                                </div>
                            </div>
                            <form id="update-bed-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="updatebedId">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" id="updatebedName"
                                        placeholder="Enter Name">
                                </div>

                                <div class="form-group">
                                    <label for="bedtype">Bed Type:</label>
                                    <select class="form-control bedTypeSelect" name="bedtype_id"
                                        id="updatebed_bedtypeId">
                                        <!-- Options will be dynamically loaded using the fetchallbedtypes function -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="bedgroup">Bed Group:</label>
                                    <select class="form-control bedGroupSelect" name="bedgroup_id"
                                        id="updatebed_bedgroupId">
                                        <!-- Add class "bedGroupSelect" to the select element -->
                                        <!-- Options will be dynamically loaded using the fetchallbedgroups function -->
                                    </select>
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary bed-updateform-submit-btn">Submit</button>
                                    <button type="button" class="btn btn-danger me-2 bed-edit-close-btn">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!---------------------------starting bed  type section---------------------------------->
        <div class="hide-div table-style mt-1 p-3 mb-3" id="show-bed-type">
            <!---bedtype datatables start--->
            <div class="hide-div main_row" id="bedtype-table-div">
                <div id="bedtype-datatable">
                    <div class="parent-div d-flex justify-content-between align-items-center pb-3">
                        <div class="header-title">
                            <h4 class="card-title">Bed Type Record List</h4>
                            <hr class="beautiful-line">
                        </div>
                        <button class="bedtype-insertion-btn btn btn-primary">Add New</button>
                    </div>
                    <div class="responseMessage alert" style="display: none; font-weight:bold;"></div>
                    <div class="table-responsive">
                        <table id="bedtype-table" class="table table-striped table-bordered table-hover dt-responsive"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">

                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!---bedtype datatables end--->

            <!---bedtype insertion start--->
            <div class="hide-div" id="bedtype-insertion-div">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container main_row">
                            <div class="parent-div d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">Add Bed Type</h4>
                                    <hr class="beautiful-line">
                                </div>
                            </div>
                            <form id="add-bedtype-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary bedtypeinsert-form-submit-btn">Submit</button>
                                    <button type="button"
                                        class="btn btn-danger me-2 bedtype-insertion-close-btn">Close</button>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
            <!---bedtype insertion end--->

            <!---bedtype edit start--->
            <div class="hide-div" id="bedtype-edit-div">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container main_row">
                            <div class="parent-div d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">Update Bed Type</h4>
                                    <hr class="beautiful-line">
                                </div>
                            </div>
                            <form id="update-bedtype-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Add a hidden input field to store the bed type ID -->
                                <input type="hidden" name="id" id="updatebedtypeId">

                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" id="updatebedtypeName"
                                        placeholder="Enter Name">
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary bedtype-updateform-submit-btn">Update</button>
                                    <button type="button"
                                        class="btn btn-danger me-2 bedtype-edit-close-btn">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!---bedtype edit start--->


        </div>
        <!---------------------------starting bed  group section---------------------------------->
        <div class="hide-div table-style mt-1 p-3 mb-3" id="show-bed-group">
            <!--bedgroup insertion start--->
            <div class="hide-div" id="bedgroup-insertion">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container main_row">
                            <div class="parent-div d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">Add Bed Group</h4>
                                    <hr class="beautiful-line">
                                </div>
                            </div>
                            <form id="add-bedgroup-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter Name">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="floor">Floor:</label>
                                        <select class="form-control floorSelect" name="floor_id"></select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" name="description" rows="4" placeholder="Enter Description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Is Active:</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" value="1" name="is_active">
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary bedgroup-form-submit-btn">Submit</button>
                                    <button type="button"
                                        class="btn btn-danger me-2 closebedgroup-insertion-btn">Close</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
            <!--bedgroup datatable start--->
            <div class="hide-div main_row" id="bedgroup-table-div">
                <div class="parent-div d-flex justify-content-between align-items-center pb-3">
                    <div class="header-title">
                        <h4 class="card-title">Bed Group Record List</h4>
                        <hr class="beautiful-line">
                    </div>
                    <button class="bedgroup-insertion-btn btn btn-primary">Add New</button>
                </div>
                <div class="responseMessage alert" style="display: none; font-weight:bold;"></div>
                <div class="table-responsive">
                    <table id="bedgroup-table" class="table table-striped table-bordered table-hover dt-responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Floor</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="hide-div" id="bedgroup-edit-div">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container main_row">
                            <div class="parent-div d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">Update Bed Group</h4>
                                    <hr class="beautiful-line">
                                </div>
                            </div>
                            <form id="update-bedgroup-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="name">Name:</label>
                                        <input type="hidden" class="form-control" name="id" id="updatebedgroupId">
                                        <input type="text" class="form-control" name="name"
                                            id="updatebedgroupName" placeholder="Enter Name">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="floor">Floor:</label>
                                        <select class="form-control floorSelect" name="floor_id"
                                            id="updatebedgroupFloor_id"></select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" name="description" id="updatebedgroupDescription" rows="4"
                                        placeholder="Enter Description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="updatebedgroupIs_active">Is Active:</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" value="1"
                                            name="edit-is-active" id="updatebedgroupIs_active">
                                        <label class="form-check-label" for="updatebedgroupIs_active">Active</label>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary bedgroup-updateform-submit-btn">Submit</button>
                                    <button type="button"
                                        class="btn btn-danger me-2 closebedgroup-update-btn">Close</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!---------------------------starting floor section---------------------------------->
        <div class="hide-div table-style mt-1 p-3 mb-3" id="show-floor">
            <div class="hide-div main_row" id="floor-datatable">
                <div class="parent-div d-flex justify-content-between align-items-center pb-3">
                    <div class="header-title">
                        <h4 class="card-title">Floor Record List</h4>
                        <hr class="beautiful-line">
                    </div>
                    <button class="floor-insert-btn btn btn-primary">Add New</button>
                </div>
                <div class="responseMessage alert" style="display: none; font-weight:bold;"></div>
                <div class="table-responsive">
                    <table id="floor-table" class="table table-striped table-bordered table-hover dt-responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">

                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
            <!--floor insertion form starting div--->
            <div class="hide-div card-body" id="floor-insertion-form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container main_row">
                            <div class="parent-div d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">ADD Floor</h4>
                                    <hr class="beautiful-line">
                                </div>
                            </div>
                            <form id="add-floor-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter Name">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" name="description" id="description" rows="4" placeholder="Enter Description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Is Active:</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" value="1" name="is_active"
                                            id="is_active">
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary floor-form-submit-btn">Submit</button>
                                    <button type="button"
                                        class="btn btn-danger me-2 floor-insertion-close">Close</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!--- floor insertion form end--->
            <div class="hide-div card-body" id="floor-edit-form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container main_row">
                            <div class="parent-div d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">Update Floor</h4>
                                    <hr class="beautiful-line">
                                </div>
                            </div>
                            <form id="update-floor-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="hidden" class="form-control" name="id" id="updatefloorId">
                                    <input type="text" class="form-control" name="name" id="updateName"
                                        placeholder="Enter Name">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" name="description" id="updateDescription" rows="4"
                                        placeholder="Enter Description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="updateIs_active">Is Active:</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" value="1"
                                            name="eidt-is_active" id="updateIs_active">
                                        <label class="form-check-label" for="updateIs_active">Active</label>
                                    </div>
                                </div>



                                <div class="text-end">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary update-floor-form-submit-btn">Submit</button>
                                    <button type="button" class="btn btn-danger me-2 floor-edit-close">Close</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---end floor section--->

    </div>
@endsection

@section('extra-content')
    <!-- floor Delete Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="floordeleteForm" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this record?</p>
                        <input type="hidden" id="floordeleteinput" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!--bedgroup Delete modal-->
    <div class="modal fade" id="bedgroupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="bedgroupdeleteForm" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this record?</p>
                        <input type="hidden" id="bedgroupdeleteinput" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!--bedtype Delete Modal -->
    <div class="modal fade" id="bedtype-delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="bedtypedeleteForm" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this record?</p>
                        <input type="hidden" id="bedtypedeleteinput" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!--- bed delete modal---->
    <div class="modal fade" id="bed-delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="beddeleteForm" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this record?</p>
                        <input type="hidden" id="beddeleteinput" name="id">
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
    <script src="{{ asset('assets/auth/js/floor/insertion-validation.js') }}"></script>
    <script src="{{ asset('assets/auth/js/floor/update-validation.js') }}"></script>
    <script src="{{ asset('assets/auth/js/bedgroup/insertion-validation.js') }}"></script>
    <script src="{{ asset('assets/auth/js/bedgroup/update-validation.js') }}"></script>
    <script src="{{ asset('assets/auth/js/bedtype/insertion-validation.js') }}"></script>
    <script src="{{ asset('assets/auth/js/bedtype/update-validation.js') }}"></script>
    <script src="{{ asset('assets/auth/js/bed/insertion-validation.js') }}"></script>
    <script src="{{ asset('assets/auth/js/bed/update-validation.js') }}"></script>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            fetchallfloors();
            fetchallbedtypes();
            fetchallbedgroups();
            // bed status
            $('.hide-div').hide();
            $('#show-bed-status,#bedstatus-table-div').show();
            $('#bed-status').on('click', function() {
                $('.hide-div').hide();
                $('#show-bed-status,#bedstatus-table-div').show();
            });
            //bedstatus datatable
            var bedstatusTable = $('#bedstatus-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('bedstatus.index') }}", // Replace this with the actual server-side endpoint URL
                    type: 'GET',
                    dataType: 'json',
                    error: function(xhr, textStatus, error) {
                        alert('Error: ' + error); // Show error message if something goes wrong
                    }
                },
                columns: [{
                        data: 'bed_name',
                        name: 'bed_name',
                        className: 'text-center'
                    },
                    {
                        data: 'bedtype_name',
                        name: 'bedtype_name',
                        className: 'text-center'
                    },
                    {
                        data: 'bedgroup_name',
                        name: 'bedgroup_name',
                        className: 'text-center'
                    },
                    {
                        data: 'floor_name',
                        name: 'floor_name',
                        className: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            // 'data' contains the value of the 'status' field for the current row
                            if (data === 0) {
                                return '<span class="btn btn-success btn-sm status-btn">Available</span>';
                            } else if (data === 1) {
                                return '<span class="btn btn-danger btn-sm status-btn">Not Available</span>';
                            } else if (data === 2) {
                                return '<span class="btn btn-warning btn-sm status-btn">Blocked</span>';
                            } else {
                                return '<span class="btn btn-secondary btn-sm status-btn">Unknown</span>'; // Add a default case if data doesn't match any of the specified values.
                            }

                        }
                    }
                ]
            });


            /*............... starting bed jquery code................. */
            $('#bed').on('click', function() {
                $('.hide-div').hide();
                $('#show-bed').show();
                $('#bed-table-div').show();
            });
            // bed datatable code start//
            var bedTable = $('#bed-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('bed.index') }}", // Replace this with your server-side endpoint for data retrieval
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'bedtype.name',
                        name: 'bedtype.name',
                    },
                    {
                        data: 'bedgroup.name',
                        render: function(data, type, full, meta) {
                            return full.bedgroup.name + ' - ' + full.bedgroup.floor
                                .name; // Display "Bed Group Name - Floor Name"
                        },
                        name: 'bedgroup.name',
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        render: function(data, type, row, meta) {
                            // 'data' contains the value of the 'status' field for the current row
                            if (data === 0) {
                                return '<span class="btn btn-success btn-sm status-btn">Available</span>';
                            } else if (data === 1) {
                                return '<span class="btn btn-danger btn-sm status-btn">Not Available</span>';
                            } else if (data === 2) {
                                return '<span class="btn btn-warning btn-sm status-btn">Blocked</span>';
                            } else {
                                return '<span class="btn btn-secondary btn-sm status-btn">Unknown</span>'; // Add a default case if data doesn't match any of the specified values.
                            }

                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
                columnDefs: [{
                    targets: '_all',
                    className: 'text-center',
                }],
                responsive: true // Enable responsive feature
            });


            // bed datatable code end//
            //bed insertion (add new ) btn code
            $('#bed-table-div').on('click', '.bed-insertion-btn', function() {
                fetchallbedtypes();
                fetchallbedgroups();
                $('.hide-div').hide();
                $('#bed-insertion-div, #show-bed').show();
            });
            //bed insertion form code start//
            $('#add-bed-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                $('.bedinsert-form-submit-btn').prop("disabled", true);
                $('.bedinsert-form-submit-btn').text('loading...');
                $.ajax({
                    url: "{{ route('bed.store') }}",
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('.bedinsert-form-submit-btn').text('Submit');
                        $('.bedinsert-form-submit-btn').prop("disabled", false);
                        form[0].reset();
                        bedTable.ajax.reload();
                        bedstatusTable.ajax.reload();
                        $('.hide-div').hide();
                        $('#bed-table-div,#show-bed').show();
                        showAlert(response.message, 'alert-success', 'show-bed');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        $('.bedinsert-form-submit-btn').text('Submit');
                        $('.bedinsert-form-submit-btn').prop("disabled", false);
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-bed');
                        hideLoader();
                    }
                });
            });
            //bed insertion form code start//
            $('#bed-insertion-div').on('click', '.bed-insertion-close-btn', function() {
                $('.hide-div').hide();
                $('#bed-table-div, #show-bed').show();
            });
            //bed edit form code start//
            $('#bed-table-div').on('click', '.bed-edit-btn', function() {
                fetchallbedtypes();
                fetchallbedgroups();
                $('.hide-div').hide();
                $('#bed-edit-div, #show-bed').show();
                var id = $(this).data('id');
                $.ajax({
                    url: '/bed/' + id + '/edit',
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $("#updatebedId").val(response.id);
                        $("#updatebedName").val(response.name);
                        $("#updatebed_bedtypeId").val(response.bedtype_id);
                        $("#updatebed_bedgroupId").val(response.bedgroup_id);
                        $('.hide-div').hide();
                        $('#bed-edit-div,#show-bed').show();
                        hideLoader();
                    },
                    error: function(error) {
                        console.log(error);
                        hideLoader();
                    }
                });
            });
            //bed edit form code end//

            //bed update form code start//
            $('#update-bed-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                $('.bed-updateform-submit-btn').prop("disabled", true);
                $('.bed-updateform-submit-btn').text('Loading...');

                $.ajax({
                    url: "{{ route('bed.update') }}",
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('.bed-updateform-submit-btn').text('Submit');
                        $('.bed-updateform-submit-btn').prop("disabled", false);
                        bedTable.ajax.reload();
                        bedstatusTable.ajax.reload();
                        form[0].reset();
                        $('.hide-div').hide();
                        $('#bed-table-div,#show-bed').show();
                        showAlert(response.message, 'alert-success', 'show-bed');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        $('.bed-updateform-submit-btn').text('Submit');
                        $('.bed-updateform-submit-btn').prop("disabled", false);
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-bed');
                        hideLoader();
                    }
                });
            });
            //bed update form code end//

            //bed edit form code end//
            $('#bed-edit-div').on('click', '.bed-edit-close-btn', function() {
                $('.hide-div').hide();
                $('#bed-table-div, #show-bed').show();
            });
            //bed delete code for gitting id in modal//
            $("#bed-table").on("click", ".bed-delete", function() {
                $('#bed-delete-modal').modal('show');
                var id = $(this).data('id');
                $('#beddeleteinput').val(id);
            });
            // bed delete form code//
            $("#beddeleteForm").on("submit", function(event) {
                event.preventDefault(); // Prevent the default form submission

                var id = $('#beddeleteinput').val();
                $.ajax({
                    url: '/bed/' + id + '/delete',
                    method: 'POST',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        bedTable.ajax.reload();
                        bedstatusTable.ajax.reload();
                        $('#bed-delete-modal').modal('hide');
                        showAlert(response.message, 'alert-success', 'show-bed');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        // console.log(xhr.responseText);
                        $('#bed-delete-modal').modal('hide');
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-bed');
                        hideLoader();
                    }
                });
            });;
            // bed is_active (status) code
            $("#bed-table").on("click", ".bed-status", function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/bed/' + id + '/status',
                    method: 'POST',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        bedTable.ajax.reload();
                        bedstatusTable.ajax.reload();
                        showAlert(response.message, 'alert-success', 'show-bed');
                        hideLoader();

                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that may occur during the AJAX request.
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-bed');
                        hideLoader();
                    }
                });
            });





            /*............... starting bed type jquery code................. */
            $('#bed-type').on('click', function() {
                $('.hide-div').hide();
                $('#show-bed-type').show();
                $('#bedtype-table-div').show();
            });
            // bedtype datatable start//
            var bedtypeTable = $('#bedtype-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('bedtype.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'text-center',
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'text-center',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    }
                ],
                responsive: true, // Enable responsive feature
            });

            // bedtype datatable end//

            //bedtype insertion add new button//
            $('#show-bed-type').on('click', '.bedtype-insertion-btn', function() {
                $('.hide-div').hide();
                $('#bedtype-insertion-div,#show-bed-type').show();
            });
            //bedtype insertion form code//
            $('#add-bedtype-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                $('.bedtypeinsert-form-submit-btn').prop("disabled", true);
                $('.bedtypeinsert-form-submit-btn').text('loading...');
                $.ajax({
                    url: "{{ route('bedtype.store') }}",
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('.bedtypeinsert-form-submit-btn').text('Submit');
                        $('.bedtypeinsert-form-submit-btn').prop("disabled", false);
                        bedtypeTable.ajax.reload();
                        form[0].reset();
                        $('.hide-div').hide();
                        $('#bedtype-table-div,#show-bed-type').show();
                        showAlert(response.message, 'alert-success', 'show-bed-type');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        $('.bedtypeinsert-form-submit-btn').text('Submit');
                        $('.bedtypeinsert-form-submit-btn').prop("disabled", false);
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-bed-type');
                        hideLoader();
                    }
                });
            });
            //bedtype insertion close btn//
            $('#bedtype-insertion-div').on('click', '.bedtype-insertion-close-btn', function() {
                $('.hide-div').hide();
                $('#bedtype-table-div,#show-bed-type').show();
            });
            //bettype edit code//
            $('#bedtype-table-div').on('click', '.bedtype-edit-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/bedtype/' + id + '/edit',
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $("#updatebedtypeId").val(response.id);
                        $("#updatebedtypeName").val(response.name);
                        $('.hide-div').hide();
                        $('#bedtype-edit-div,#show-bed-type').show();
                        hideLoader();
                    },
                    error: function(error) {
                        console.log(error);
                        hideLoader();
                    }
                });

            });
            //bedtype update code//
            $('#update-bedtype-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                $('.bedtype-updateform-submit-btn').prop("disabled", true);
                $('.bedtype-updateform-submit-btn').text('Loading...');

                $.ajax({
                    url: "{{ route('bedtype.update') }}",
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('.bedtype-updateform-submit-btn').text('Submit');
                        $('.bedtype-updateform-submit-btn').prop("disabled", false);
                        bedtypeTable.ajax.reload();
                        bedstatusTable.ajax.reload();
                        bedTable.ajax.reload();
                        form[0].reset();
                        $('.hide-div').hide();
                        $('#bedtype-table-div,#show-bed-type').show();
                        showAlert(response.message, 'alert-success', 'show-bed-type');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        $('.bedtype-updateform-submit-btn').text('Submit');
                        $('.bedtype-updateform-submit-btn').prop("disabled", false);
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-bed-type');
                        hideLoader();
                    }
                });
            });
            //bedtype edit close btn//
            $('#bedtype-edit-div').on('click', '.bedtype-edit-close-btn', function() {
                $('.hide-div').hide();
                $('#bedtype-table-div,#show-bed-type').show();
            });
            //bedtype delete code for gitting id in modal//
            $("#bedtype-table").on("click", ".bedtype-delete", function() {
                $('#bedtype-delete-modal').modal('show');
                var id = $(this).data('id');
                $('#bedtypedeleteinput').val(id);
            });
            // bedtype delete form code//
            $("#bedtypedeleteForm").on("submit", function(event) {
                event.preventDefault(); // Prevent the default form submission

                var id = $('#bedtypedeleteinput').val();
                $.ajax({
                    url: '/bedtype/' + id + '/delete',
                    method: 'POST',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        bedtypeTable.ajax.reload();
                        bedTable.ajax.reload();
                        bedstatusTable.ajax.reload();
                        $('#bedtype-delete-modal').modal('hide');
                        showAlert(response.message, 'alert-success', 'show-bed-type');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-bed-type');
                        $('#bedtype-delete-modal').modal('hide');
                        hideLoader();
                    }
                });
            });;








            /*............... starting bed group jquery code................. */
            $('#bed-group').on('click', function() {
                $('.hide-div').hide();
                $('#show-bed-group').show();
                $('#bedgroup-table-div').show();
            });
            //bed group datatable start
            var bedgroupTable = $('#bedgroup-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('bedgroup.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'floor.name',
                        name: 'floor.name',
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
                columnDefs: [{
                    targets: '_all',
                    className: 'text-center',
                }, ],
                responsive: true // Enable responsive feature
            });


            //bed group datatable end

            //bedgroup-insertion-btn(add new)
            $('#bedgroup-table-div').on('click', '.bedgroup-insertion-btn', function() {
                fetchallfloors();
                $('.hide-div').hide();
                $('#show-bed-group').show();
                $('#bedgroup-insertion').show();
            });
            //bedgroup insertion code start
            $('#add-bedgroup-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                $('.bedgroup-form-submit-btn').prop("disabled", true);
                $('.bedgroup-form-submit-btn').text('loading...');
                $.ajax({
                    url: "{{ route('bedgroup.store') }}",
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('.bedgroup-form-submit-btn').text('Submit');
                        $('.bedgroup-form-submit-btn').prop("disabled", false);
                        bedgroupTable.ajax.reload();
                        form[0].reset();
                        $('.hide-div').hide();
                        $('#bedgroup-table-div,#show-bed-group').show();
                        showAlert(response.message, 'alert-success', 'show-bed-group');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        $('.bedgroup-form-submit-btn').text('Submit');
                        $('.bedgroup-form-submit-btn').prop("disabled", false);
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-bed-group');
                        hideLoader();
                    }
                });
            });
            //bedgroup insertion code end

            //closebedgroup-insertion-btn code
            $('#bedgroup-insertion').on('click', '.closebedgroup-insertion-btn', function() {
                $('.hide-div').hide();
                $('#bedgroup-table-div,#show-bed-group').show();
            });
            // bedgroup-edit-btn and code
            $('#bedgroup-table-div').on('click', '.bedgroup-edit-btn', function() {
                fetchallfloors();
                var id = $(this).data('id');
                $.ajax({
                    url: '/bedgroup/' + id + '/edit',
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('.hide-div').hide();
                        $('#bedgroup-edit-div, #show-bed-group').show();
                        $("#updatebedgroupId").val(response.id);
                        $("#updatebedgroupName").val(response.name);
                        $("#updatebedgroupFloor_id").val(response.floor_id);
                        $("#updatebedgroupDescription").val(response.description);
                        if (response.is_active === 1) {
                            $("#updatebedgroupIs_active").prop('checked', true);
                        } else {
                            $("#updatebedgroupIs_active").prop('checked', false);
                        }

                        hideLoader();
                    },
                    error: function(error) {

                        console.log(error);
                        hideLoader();
                    }
                });
            });
            $('#update-bedgroup-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                $('.bedgroup-updateform-submit-btn').prop("disabled", true);
                $('.bedgroup-updateform-submit-btn').text('Loading...');

                $.ajax({
                    url: "{{ route('bedgroup.update') }}",
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('.bedgroup-updateform-submit-btn').text('Submit');
                        $('.bedgroup-updateform-submit-btn').prop("disabled", false);
                        bedgroupTable.ajax.reload();
                        bedstatusTable.ajax.reload();
                        bedTable.ajax.reload();
                        form[0].reset();
                        $('.hide-div').hide();
                        $('#bedgroup-table-div,#show-bed-group').show();
                        showAlert(response.message, 'alert-success', 'show-bed-group');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        $('.bedgroup-updateform-submit-btn').text('Submit');
                        $('.bedgroup-updateform-submit-btn').prop("disabled", false);
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-bed-group');
                        hideLoader();
                    }
                });
            });
            // closebedgroup-update-btn code
            $('#bedgroup-edit-div').on('click', '.closebedgroup-update-btn', function() {
                $('.hide-div').hide();
                $('#bedgroup-table-div,#show-bed-group').show();
            });
            // bedgroup delete code//
            $("#bedgroup-table-div").on("click", ".bedgroup-delete", function() {
                $('#bedgroupModal').modal('show');
                var id = $(this).data('id');
                $('#bedgroupdeleteinput').val(id);
            });
            $("#bedgroupdeleteForm").on("submit", function(event) {
                event.preventDefault(); // Prevent the default form submission

                var id = $('#bedgroupdeleteinput').val();
                $.ajax({
                    url: '/bedgroup/' + id + '/delete',
                    method: 'POST',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        bedgroupTable.ajax.reload();
                        bedTable.ajax.reload();
                        bedstatusTable.ajax.reload();
                        $('#bedgroupModal').modal('hide');
                        showAlert(response.message, 'alert-success', 'show-bed-group');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        // console.log(xhr.responseText);
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-bed-group');
                        $('#bedgroupModal').modal('hide');
                        hideLoader();
                    }
                });
            });


















            /*............... starting floor jquery code................. */
            $('#floor').on('click', function() {
                $('.hide-div').hide();
                $('#show-floor').show();
                $('#floor-datatable').show();
            });
            //floor datatable start//
            var floorTable = $('#floor-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('floor.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data) {
                            return '<div class="text-center">' + data + '</div>';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data) {
                            return '<div class="text-center">' + data + '</div>';
                        }
                    },
                    {
                        data: 'description',
                        name: 'description',
                        render: function(data) {
                            return '<div class="text-center">' + data + '</div>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return '<div class="text-center">' + data + '</div>';
                        }
                    }
                ],
                responsive: true // Enable responsive feature
            });

            //floor datatable end//
            /* floor insertion form opening btn code*/
            $('#floor-datatable').on('click', '.floor-insert-btn', function() {
                $('.hide-div').hide();
                $('#floor-insertion-form,#show-floor').show();
            });

            /* starting floor insertion ajax code*/

            $('#add-floor-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                var submitBtn = $('.floor-form-submit-btn');
                submitBtn.prop("disabled", true);
                submitBtn.text('loading...');

                $.ajax({
                    url: "{{ route('floor.store') }}",
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        submitBtn.text('Submit');
                        submitBtn.prop("disabled", false);
                        floorTable.ajax.reload();
                        form[0].reset();
                        $('.hide-div').hide();
                        $('#floor-datatable, #show-floor').show();
                        // Show success message in Bootstrap alert
                        showAlert(response.message, 'alert-success', 'show-floor');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        submitBtn.text('Submit');
                        submitBtn.prop("disabled", false);
                        // Show error message in Bootstrap alert
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-floor');
                        hideLoader();
                    }
                });
            });
            /* end floor insertion ajax code*/

            /* floor insertion form closing btn code*/
            $('#floor-insertion-form').on('click', '.floor-insertion-close', function() {
                $('.error').text('');
                $('.hide-div').hide();
                $('#floor-datatable,#show-floor').show();
            });
            /* floor edit code*/
            $('#floor-datatable').on('click', '.floor-edit-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/floor/' + id + '/edit',
                    method: 'GET',
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('.hide-div').hide();
                        $('#floor-edit-form,#show-floor').show();
                        $("#updatefloorId").val(response.id);
                        $("#updateName").val(response.name);
                        $("#updateDescription").val(response.description);
                        if (response.is_active === 1) {
                            $("#updateIs_active").prop('checked', true);
                        } else {
                            $("#updateIs_active").prop('checked', false);
                        }

                        hideLoader();
                    },
                    error: function(error) {

                        console.log(error);
                        hideLoader();
                    }
                });
            });
            //floor edit close code//
            $('#floor-edit-form').on('click', '.floor-edit-close', function() {
                $('.hide-div').hide();
                $('#floor-datatable,#show-floor').show();
            });
            // floor update code//
            $('#update-floor-form').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var form = $(this);
                $('.floor-form-submit-btn').prop("disabled", true);
                $('.floor-form-submit-btn').text('Loading...');

                $.ajax({
                    url: "{{ route('floor.update') }}",
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('.floor-form-submit-btn').text('Submit');
                        $('.floor-form-submit-btn').prop("disabled", false);
                        floorTable.ajax.reload();
                        bedgroupTable.ajax.reload();
                        bedTable.ajax.reload();
                        bedstatusTable.ajax.reload();
                        form[0].reset();
                        $('.hide-div').hide();
                        $('#floor-datatable, #show-floor').show();
                        showAlert(response.message, 'alert-success', 'show-floor');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        $('.floor-form-submit-btn').text('Submit');
                        $('.floor-form-submit-btn').prop("disabled", false);
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-floor');
                        hideLoader();
                    }
                });
            });

            //floor delete code
            $("#floor-table").on("click", ".delete", function() {
                $('#exampleModal').modal('show');
                var id = $(this).data('id');
                $('#floordeleteinput').val(id);
            });

            $("#floordeleteForm").on("submit", function(event) {
                event.preventDefault(); // Prevent the default form submission

                var id = $('#floordeleteinput').val();
                $.ajax({
                    url: '/floor/' + id + '/delete',
                    method: 'POST',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        floorTable.ajax.reload();
                        bedgroupTable.ajax.reload();
                        bedTable.ajax.reload();
                        bedstatusTable.ajax.reload();
                        $('#exampleModal').modal('hide');
                        showAlert(response.message, 'alert-success', 'show-floor');
                        hideLoader();
                    },
                    error: function(xhr, textStatus, error) {
                        // console.log(xhr.responseText);
                        showAlert(xhr.responseJSON.error, 'alert-danger', 'show-floor');
                        $('#exampleModal').modal('hide');
                        hideLoader();
                    }
                });
            });
        });
        //start loader functions
        function showLoader() {
            $(".loader-overlay").fadeIn("slow");
        }

        function hideLoader() {
            $(".loader-overlay").fadeOut("slow");
        }
        // end loader functions
        //fetch all floors function
        function fetchallfloors() {
            $.ajax({
                type: "get",
                url: "fetchallfloors",
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    var floorSelect = $(".floorSelect");
                    floorSelect.html('');

                    // Add the first option as "Select floor" and make it disabled
                    var firstOption = $("<option>").text("Select floor").attr("disabled", true).attr("selected",
                        true);
                    floorSelect.append(firstOption);

                    if (response.length === 0) {
                        var option = $("<option>").text("No floor found");
                        floorSelect.append(option);
                    } else {
                        $.each(response, function(index, floor) {
                            var option = $("<option>").val(floor.id).text(floor.name);
                            floorSelect.append(option);
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



        function showAlert(message, alertClass, tableId) {
            var alertDiv = $('#' + tableId).find('.responseMessage');
            alertDiv.removeClass('alert-success alert-danger ');
            alertDiv.addClass(alertClass);
            alertDiv.text(message)
                .fadeIn()
                .delay(3000)
                .fadeOut();
        }

        function fetchallbedtypes() {
            $.ajax({
                type: "get",
                url: "fetchallbedtypes", // Replace with the actual endpoint for bed types
                dataType: "json",
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    var bedTypeSelect = $(".bedTypeSelect");
                    bedTypeSelect.html('');

                    // Add the first option as "Select bed type" and make it disabled
                    var firstOption = $("<option>").text("Select bed type").attr("disabled", true).attr(
                        "selected", true);
                    bedTypeSelect.append(firstOption);

                    if (response.length === 0) {
                        var option = $("<option>").text("No bed type found");
                        bedTypeSelect.append(option);
                    } else {
                        $.each(response, function(index, bedType) {
                            var option = $("<option>").val(bedType.id).text(bedType.name);
                            bedTypeSelect.append(option);
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


        function fetchallbedgroups() {
            $.ajax({
                type: "get",
                url: "fetchallbedgroups",
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

    </script>

@endsection
