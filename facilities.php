<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <?php require('inc/links.php'); ?>
  <title>HOTEL - FACILITIES</title>
  <style>
    .h-line {
      width: 150px;
      height: 1.7px;
      margin: 0 auto;
    }

    .pop:hover {
      border-top-color: #2ec1ac !important;
      transform: scale(1.03);
      transition: all 0.3s;
    }
  </style>
</head>

<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <div class="my-5 p-4">
    <h2 class="h-font fw-bold text-center">OUR FACILITIES</h2>
    <div class="h-line bg-dark"></div>
    <p class="mt-3 text-center">
      Lorem ipsum dolor sit, amet consectetur adipisicing elit.
      Nemo facere perspiciatis dicta quisquam <br> expedita veniam!
      Dolores, accusantium. Laborum, qui nisi.
    </p>
  </div>

  <div class="container">
    <div class="row">
      <?php 
        $res = selectAll('facilities');
        $path = FACILITIES_IMG_PATH;

        while($row = mysqli_fetch_assoc($res)){
          echo <<<data
                  <div class="col-lg-4 col-md-6 mb-5 px-4">
                    <div class="bg-white shadow p-4 rounded border-top border-4 border-dark pop">
                      <div class="d-flex align-items-center">
                        <img src="$path$row[icon]" width="50px">
                        <h5 class="m-0 ms-3">$row[name]</h5>
                      </div>

                      <p>$row[description]</p>
                    </div>
                  </div>
          data;
        }
      ?>
    </div>
  </div>

  <?php require('inc/footer.php') ?>

</body>

</html>