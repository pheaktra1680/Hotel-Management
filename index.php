<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <?php require('inc/links.php'); ?>
  <title>HOTEL - HOME</title>
  <style>
    .availability-form {
      margin-top: -50px;
      z-index: 2;
      position: relative;
    }

    @media screen and (max-width: 575px) {
      .availability-form {
        margin-top: 25px;
        padding: 0 35px;
      }
    }
  </style>
</head>

<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- carousel -->
  <div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <?php
        $res = selectAll('carousel');
        while ($row = mysqli_fetch_assoc($res)) {
          $path = CAROUSEL_IMG_PATH;
          echo <<<data
                      <div class="swiper-slide">
                        <img src="$path$row[image]" class="d-block w-100" />
                      </div>
              data;
        }
        ?>
      </div>
    </div>
  </div>

  <div class="container availability-form">
    <div class="row">
      <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="mb-4">Check Booking Availability</h5>
        <form action="">
          <div class="row align-items-end">
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight: 500">Check-in</label>
              <input type="date" class="form-control shadow-none" />
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight: 500">Check-out</label>
              <input type="date" class="form-control shadow-none" />
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight: 500">Adult</label>
              <select class="form-select shadow-none">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="col-lg-2 mb-3">
              <label class="form-label" style="font-weight: 500">Children</label>
              <select class="form-select shadow-none">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="col-lg-1 mb-lg-3 mt-2">
              <button
                type="submit"
                class="btn text-white shadow-none custom-bg">
                Submit
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Our rooms -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>

  <div class="container">
    <div class="row">
      <?php
        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3", [1, 0], 'ii');

        while ($room_data = mysqli_fetch_assoc($room_res)) { // Correctly fetch room data here
          // get features from room
          $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
          INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
          WHERE rfea.room_id = '{$room_data['id']}'"); // Use $room_data['id']

          $features_data = "";
          while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                            {$fea_row['name']}
                          </span>";
          }

          // get facilities from room
          $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
          INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
          WHERE rfac.room_id = '{$room_data['id']}'"); // Use $room_data['id']

          $facilities_data = "";
          while ($fac_row = mysqli_fetch_assoc($fac_q)) {
            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                            {$fac_row['name']}
                          </span>";
          }

          // get thumbnail
          $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
          $thumb_q = mysqli_query($con, "SELECT * FROM `room_images`
       WHERE `room_id`='{$room_data['id']}' 
       AND `thumb`='1'"); // Use $room_data['id']

          if (mysqli_num_rows($thumb_q) > 0) {
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
          }

          // print room card
          echo <<<data
          <div class="col-lg-4 col-md-6 my-3">
          <div
            class="card border-0 shadow"
            style="max-width: 350px; margin: auto">
            <img src="$room_thumb" class="card-img-top" />
            <div class="card-body">
              <h5>$room_data[name]</h5>
              <h6 class="mb-4">$100 per night</h6>
              <div class="features mb-4">
                <h6 class="mb-1">Features</h6>
                $features_data
              </div>
              <div class="facilities mb-4">
                <h6 class="mb-1">Facilities</h6>
                $facilities_data
              </div>
              <div class="guest mb-4">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  {$room_data['adult']} Adults
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  {$room_data['children']} Children
                </span>
              </div>
              <div class="rating mb-4">
                <h6 class="mb-1">Rating</h6>
                <span class="badge rounded-pill bg-light">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                </span>
              </div>
              <div class="d-flex justify-content-evenly mb-2">
                <a href="#" class="btn btn-sm shadow-none custom-bg text-white">Book Now</a>
                <a href="room_details.php?id=$room_data[id]" class="btn btn-sm shadow-none btn-outline-dark">More Details</a>
              </div>
            </div>
          </div>
        </div>

        
  data;
        }
      ?>
      <div class="col-lg-12 text-center mt-5">
        <a
          href="rooms.php"
          class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
      </div>
    </div>
  </div>

  <!-- Our facilities -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
      <?php
      $res = mysqli_query($con, "SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5");
      $path = FACILITIES_IMG_PATH;

      while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                    <img src="$path$row[icon]" width="60px" />
                    <h5 class="mt-3">$row[name]</h5>
                </div>
          data;
      }
      ?>
     
      <div class="col-lg-12 mt-5 text-center">
        <a
          href="facilities.php"
          class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities >>></a>
      </div>
    </div>
  </div>

  <!-- Our testimonials -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR TESTIMONIALS</h2>
  <div class="container mt-5">
    <div class="swiper swiper-testimonails">
      <div class="swiper-wrapper mb-5">
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center p-4">
            <img src="images/facilities/IMG_27079.svg" width="30px" />
            <h6 class="m-0 ms-2">Random user1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut
            consequuntur reiciendis laborum quo consectetur neque, nobis
            deserunt cupiditate praesentium laboriosam.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center p-4">
            <img src="images/facilities/IMG_27079.svg" width="30px" />
            <h6 class="m-0 ms-2">Random user1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut
            consequuntur reiciendis laborum quo consectetur neque, nobis
            deserunt cupiditate praesentium laboriosam.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center p-4">
            <img src="images/facilities/IMG_27079.svg" width="30px" />
            <h6 class="m-0 ms-2">Random user1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut
            consequuntur reiciendis laborum quo consectetur neque, nobis
            deserunt cupiditate praesentium laboriosam.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <div class="col-lg-12 mt-5 text-center">
      <a
        href="about.php"
        class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Khow Mores >>></a>
    </div>
  </div>

  <!-- Reach US -->



  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
        <iframe
          height="320px"
          class="w-100 rounded"
          src="<?php echo $contact_r['iframe'] ?>"
          loading="lazy"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white p-4 rounded mb-4">
          <h5>Call us</h5>
          <a href="tel:+<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-black" style="color: black;">
            <i class="bi bi-telephone-fill"></i> + <?php echo $contact_r['pn1'] ?>
          </a>
          <br>

          <?php
          if ($contact_r['pn2'] != '') {
            echo <<<data
                  <a href="tel:+$contact_r[pn2] " class="d-inline-block text-decoration-none text-black" style="color: black;">
                    <i class="bi bi-telephone-fill"></i> + $contact_r[pn2]
                  </a>
                data;
          }
          ?>


        </div>

        <div class="bg-white p-4 rounded mb-4">
          <h5>Follow us</h5>
          <?php
          if ($contact_r['tw'] != '') {
            echo <<<data
                    <a href="$contact_r[tw]" class="d-inline-block mb-3">
                      <span class="badge bg-light fs-6 p-2 text-dark">
                        <i class="bi bi-twitter-x me-1"></i> X
                      </span>
                    </a>
                data;
          }
          ?>

          <br>
          <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
            <span class="badge bg-light fs-6 p-2 text-dark">
              <i class="bi bi-facebook me-1"></i> Facebook
            </span>
          </a>
          <br>
          <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block mb-3">
            <span class="badge bg-light fs-6 p-2 text-dark">
              <i class="bi bi-instagram me-1"></i> Instagram
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <?php require('inc/footer.php') ?>


  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
    });

    var swiper = new Swiper(".swiper-testimonails", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3",
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });
  </script>
</body>

</html>