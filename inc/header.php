<?php 
    require('admin/inc/db_config.php');
    require('admin/inc/essentials.php');
   
    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [0];
    $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
    
?>


<!-- Navbar -->
<nav id="nav-bar"
    class="navbar navbar-expand-lg navbar-light bg-white px-lg-e py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">Hotel</a>
        <button
            class="navbar-toggler shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link me-2" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="rooms.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities.php">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>
            <form class="d-flex">
                <button
                    type="button"
                    class="btn btn-outline-dark shadow-none me-lg-2 me-3"
                    data-bs-toggle="modal"
                    data-bs-target="#loginModal">
                    Login
                </button>
                <button
                    type="button"
                    class="btn btn-outline-dark shadow-none ms-2"
                    data-bs-toggle="modal"
                    data-bs-target="#registerModal">
                    Register
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div
    class="modal fade"
    id="loginModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action=""></form>

            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center">
                    <i class="bi bi-person-circle fs-3 me-2"></i> User Login
                </h5>
                <button
                    type="reset"
                    class="btn-close shadow-none"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control shadow-none" />
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control shadow-none" />
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <button type="submit" class="btn btn-dark shadow-none">
                        LOGIN
                    </button>
                    <a
                        href="javascript: void(0)"
                        class="text-secondary text-decoration-none">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div
    class="modal fade"
    id="registerModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="register-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i> User Register
                    </h5>
                    <button
                        type="reset"
                        class="btn-close shadow-none"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge bg-light text-dark mb-3 text-wrap lh-bash">
                        Note: Your details must match with your ID (Aadhaar card,
                        passport, driver license, etc.,) that will be required during
                        check-in.
                    </span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" class="form-control shadow-none" required/>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" class="form-control shadow-none"  required/>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input name="phonenum" type="number" class="form-control shadow-none"  required/>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Picture</label>
                                <input name="profile" type="file" accept=".jpg, .jepg, .png, .webp" class="form-control shadow-none"  required/>
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label for="form-label">Address</label>
                                <textarea name="address" class="form-control shadow-none" row="1" required></textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Pincode</label>
                                <input name="pincode" type="number" class="form-control shadow-none" required />
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input name="dob" type="date" class="form-control shadow-none" required />
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input name="pass" type="password" class="form-control shadow-none" required />
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input name="cpass" type="password" class="form-control shadow-none" required />
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark shadow-none" required>
                                REGISTER
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>