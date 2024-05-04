<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style="background-color: #F6F9FF;" >
    <!-- Header Block -->
  <header id="site-header" >
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top " style="background-color: #4154F1;">
      <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
        <img src="../assets/img/logo1.png" alt=""  >
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  mx-auto mb-2 mb-lg-0  ">
          <li class="nav-item ">
              <a class="nav-link text-light " style="float: right;" href="index.php">Home</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link text-light " style="float: right;" href="dashboard.php">Dashboard</a>
            </li>
            
           
          </ul>
         
        </div>
      </div>
    </nav>

    <!-- Offcanvas Block -->
    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
      <div class="container pt-5">
        
        <div class="offcanvas-body">
          <form class="position-relative" action="#" method="post">
            <input type="tel" class="form-control" id="exampleFormControlInput1" placeholder="Examples: posts, services,..">
            <button class="position-absolute top-0 end-0 border-0 bg-transparent py-2 pe-2 text-secondary" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
        </div>
      </div>
    </div>
  </header>

  <!-- Breadcrumb Block -->
  <section class="mt-5">
    <div class="bg-light py-5">
      <div class="container">
        <div class="d-flex justify-content-between">
          <h1 class="fw-bold">Contact us</h1>
          <nav class="pt-3" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
           
          </nav>
        </div>
      </div>
    </div>
  </section>

  <main>
    <div class="container py-5">
      <div class="row g-5">
        <!-- Contact Information Block -->
        <div class="col-xl-6">
          <div class="row row-cols-md-2 g-4">
            <div class="aos-item" data-aos="fade-up" data-aos-delay="200">
              <div class="aos-item__inner">
                <div class="bg-light hvr-shutter-out-horizontal d-block p-3">
                  <div class="d-flex justify-content-start">
                    <i class="fa-solid fa-envelope h3 pe-2"></i>
                    <span class="h5">Email</span>
                  </div>
                  <span>example@domain.com</span>
                </div>
              </div>
            </div>
            <div class="aos-item" data-aos="fade-up" data-aos-delay="400">
              <div class="aos-item__inner">
                <div class="bg-light hvr-shutter-out-horizontal d-block p-3">
                  <div class="d-flex justify-content-start">
                    <i class="fa-solid fa-phone h3 pe-2"></i>
                    <span class="h5">Phone</span>
                  </div>
                  <span>+0123456789, +9876543210</span>
                </div>
              </div>
            </div>
          </div>
          <div class="aos-item mt-4" data-aos="fade-up" data-aos-delay="600">
            <div class="aos-item__inner">
              <div class="bg-light hvr-shutter-out-horizontal d-block p-3">
                <div class="d-flex justify-content-start">
                  <i class="fa-solid fa-location-pin h3 pe-2"></i>
                  <span class="h5">Office location</span>
                </div>
                <span>#007, Street name, Bigtown BG23 4YZ, England</span>
              </div>
            </div>
          </div>
          <div class="aos-item" data-aos="fade-up" data-aos-delay="800">
            <div class="mt-4 w-100 aos-item__inner">
              <iframe class="hvr-shadow" width="100%" height="345" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+()&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">measure acres/hectares on map</a></iframe>
            </div>
          </div>
        </div>

        <!-- Contact Form Block -->
        <div class="col-xl-6">
          <h2 class="pb-4">Leave a message</h2>
         
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
          </div>
          
         
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <button type="button" class="btn btn-dark">Send Message</button>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer Block -->
  <footer id="site-footer">
    <div class="bg-dark bg-opacity-25 py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-xl-3 col-sm-12">
            <h5 class="pb-3 text-light"><i class="fa-solid fa-user-group pe-1"></i> About us</h5>
            <span class="text-light">This is a wider card with supporting text below as a natural lead-in to additional content.</span>
          </div>
          
          <div class="col-md-6 col-xl-3 col-sm-12">
            <h5 class="pb-3 text-light"><i class="fa-solid fa-location-dot pe-1"></i> Our location</h5>
            <span class="text-light">
              Milannagar bazar<br>
              Tamluk, East Medinipore, West Bengal<br>
              720001, India<br>
            </span>
          </div>
          
        </div>
      </div>
    </div>
    <div class="bg-dark py-3">
      <div class="container">
        <div class="row">
          
          <div class="col-md-6 col-sm-12"><span class="text-secondary pt-1 float-md-end float-sm-start">Copyright &copy; 2023</span></div>
        </div>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>