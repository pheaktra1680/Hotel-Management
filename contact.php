<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <?php require('inc/links.php'); ?>
  <title>HOTEL - CONTACT</title>
  <style>
    .h-line {
      width: 150px;
      height: 1.7px;
      margin: 0 auto;
    }

    .custom-alert {
      position: fixed;
      top: 90px;
      right: 25px;
    }
  </style>
</head>

<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <div class="my-5 p-4">
    <h2 class="h-font fw-bold text-center">CONTACT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="mt-3 text-center">
      Lorem ipsum dolor sit, amet consectetur adipisicing elit.
      Nemo facere perspiciatis dicta quisquam <br> expedita veniam!
      Dolores, accusantium. Laborum, qui nisi.
    </p>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 mb-5 px-4">
        <div class="bg-white shadow p-4 rounded">

          <!-- google map  -->
          <iframe
            height="320px"
            class="w-100 rounded mb-4"
            src="<?php echo $contact_r['iframe'] ?>"
            loading="lazy">
          </iframe>

          <!-- Address  -->
          <h5>Addres</h5>
          <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
            <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address'] ?>
          </a>

          <!-- Phone number  -->
          <h5 class="mt-4">Call us</h5>
          <a href="tel:+<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1'] ?>
          </a>
          <br>
          <?php
          if ($contact_r['pn2'] != '') {
            echo <<<data
                  <a href="tel:+$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
                    <i class="bi bi-telephone-fill"></i> +$contact_r[pn2]
                  </a>
            data;
          }

          ?>


          <!-- mail  -->
          <h5 class="mt-4">Email</h5>
          <a href="mailto: <?php echo $contact_r['email'] ?>" class="d-inline-block text-decoration-none text-dark">
            <i class="bi bi-envelope-fill"></i> <?php echo $contact_r['email'] ?>
          </a>

          <!-- social media  -->
          <h5 class="mt-4">Follow us</h5>
          <?php
          if ($contact_r['tw'] != '') {
            echo <<<data
                <a href="$contact_r[tw]" class="d-inline-block text-dark fs-5 me-2">
                  <i class="bi bi-twitter-x"></i>
                </a>
              data;
          }
          ?>
          <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark fs-5 me-2">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark fs-5">
            <i class="bi bi-instagram"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 mb-5 px-4">
        <div class="bg-white shadow p-4 rounded">
          <form method="post">
            <h5>Send a Message</h5>
            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Name</label>
              <input name="name" required type="text" class="form-control shadow-none">
            </div>
            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Email</label>
              <input name="email" required type="email" class="form-control shadow-none">
            </div>
            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Subject</label>
              <input name="subject" required type="text" class="form-control shadow-none">
            </div>
            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Message</label>
              <textarea name="message" required class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
            </div>
            <button type="submit" name="send" class="btn text-white custom-bg mt-3">
              SEND
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php
  if (isset($_POST['send'])) {
    $frm_data = filteration($_POST);

    $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

    $res = insert($q, $values, 'ssss');
    if ($res == 1) {
      alert('success', 'Mail sent!');
    } else {
      alert('error', 'Server Down! Try again late!');
    }
  }
  ?>

  <?php require('inc/footer.php') ?>

</body>

</html>