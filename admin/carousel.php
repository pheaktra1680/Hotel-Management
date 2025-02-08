<?php
require('inc/essentials.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Settings</title>
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
    </style>

</head>

<body class="bg-light">
    <?php require('inc/header.php') ?>;

    <div class="container-fluid" id="main-content">
        <div class="row">
            <di class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">CAROUSEL</h3>

                <!-- Carousel Team section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5>Images</h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#carousel-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="row" id="carousel-data">
                            
                        </div>
                    </div>
                </div>

                <!-- Carousel model -->
                <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="carousel_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Image</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture</label>
                                        <input type="file" class="form-control shadow-none" name="carousel_picture" id="carousel_picture_inp" accept="[.jpg, .png, .webp, .jpeg]" required />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="carousel_picture.value='';" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
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
    <script src="scripts/carousel.js"></script>

</body>

</html>