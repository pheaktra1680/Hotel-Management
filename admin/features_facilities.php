<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

if (isset($_GET['seen'])) {
    $frm_data = filteration($_GET);

    if ($frm_data['seen'] == 'all') {
        $q = "UPDATE `user_queries` SET `seen`=?";
        $values = [1];
        if (update($q, $values, 'i')) {
            alert('success', 'Marked all as read!');
        } else {
            alert('error', 'Operation Failed!');
        }
    } else {
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no` =?";
        $values = [1, $frm_data['seen']];
        if (update($q, $values, 'ii')) {
            alert('success', 'Marked as read!');
        } else {
            alert('error', 'Operation Failed!');
        }
    }
}
if (isset($_GET['del'])) {
    $frm_data = filteration($_GET);

    if ($frm_data['del'] == 'all') {
        $q = "DELETE FROM `user_queries`";
        if (mysqli_query($con, $q)) {
            alert('success', 'All data deleted!');
        } else {
            alert('error', 'Operation Failed!');
        }
    } else {
        $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
        $values = [$frm_data['del']];
        if (custom_delete($q, $values, 'i')) {
            alert('success', 'Data deleted!');
        } else {
            alert('error', 'Operation Failed!');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Features & Facilities Queries</title>
    <?php require('inc/links.php') ?>
    <style>
        #dashboard-menu {
            position: fixed;
            height: 100%;
        }

        @media screen and (max-width: 991px) {
            #dashboard-menu {
                height: auto;
                width: 100%;
            }

            #main-content {
                margin-top: 60px;
            }
        }

        .custom-alert {
            position: fixed;
            top: 90px;
            right: 25px;
        }
    </style>

</head>

<body class="bg-light">
    <?php require('inc/header.php') ?>;

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">FEATURES & FACILITIES</h3>

                <!-- Feature -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <!-- Features section -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <!-- Add feature -->
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h5>Features</h5>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#feature-s">
                                        <i class="bi bi-plus-square"></i> Add
                                    </button>
                                </div>
                                <!-- table -->
                                <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                                    <table class="table table-hover border">
                                        <thead>
                                            <tr class="bg-dark text-light">
                                                <th scope="col" width="20%">#</th>
                                                <th scope="col" width="60%">Name</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="features-data">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facilities -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <!-- Faciliity section -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <!-- Add facility -->
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h5>Facilities</h5>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#facility-s">
                                        <i class="bi bi-plus-square"></i> Add
                                    </button>
                                </div>
                                <!-- table -->
                                <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                                    <table class="table table-hover border">
                                        <thead>
                                            <tr class="bg-dark text-light">
                                                <th scope="col">#</th>
                                                <th scope="col">Icon</th>
                                                <th scope="col">Name</th>
                                                <th scope="col" width="40%">Description</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="facilities-data">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features modal -->
                <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="feature_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add FEATURES</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" class="form-control shadow-none" name="feature_name" required />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Facility modal -->
                <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="facility_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Facility</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" class="form-control shadow-none" name="facility_name" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Icon</label>
                                        <input type="file" class="form-control shadow-none" name="facility_icon" accept=".svg" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="form-label">Description</label>
                                        <textarea class="form-control shadow-none" name="facility_desc" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php require('inc/scripts.php') ?>

    <script src="scripts/features_facilities.js"></script>
</body>

</html>