<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>iHungry</title>

  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/stylish-portfolio.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <a class="menu-toggle rounded" href="#">
    <i class="fas fa-bars"></i>
  </a>

  <nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
  
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="website.php">Home</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#page-top">Top</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#about">Convert Amounts</a>
      </li>
  
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#contact">Contact</a>
      </li>
    </ul>
  </nav>

  <!-- Header -->
  <header class="inventory d-flex">

    <div class="container text-center my-auto">
      <h1 class="mb-1">Fridge</h1>
      <h3 class="mb-5">
        <em>Inventory</em>
      </h3>
      <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
    </div>
    <div class="overlay"></div>
  </header>

  <!-- About -->
  <div class="container" id="about" >

    <form action="../../DMZ/ApiRequest/API_request.php" method="post">
    <br>

    <h2 class="text-info">What is your name?<br>
    <input type="text" name="name" placeholder="Search" required ><br><br>

    <h2 class="text-info"> Store 4 ingredients in your database <br>

    <input type="text" name="inventory1" placeholder="Search" required ><br><br>

    <input type="text" name="inventory2" placeholder="Search" required ><br><br>

    <input type="text" name="inventory3" placeholder="Search" required ><br><br>

    <input type="text" name="inventory4" placeholder="Search" required ><br><br>

      <!--
    <h4>Please enter the ingredient name<h4><br>
    <input type="text" name="ingredient_convert" placeholder="Search" required ><br><br>

     <h4>Please enter the unit from which you want to convert : "cups" , "serving" , " piece" <h4><br>
    <input type="text" name="source_unit" placeholder="Optional" ><br><br>

    <h4>Please enter the amount from which you want to convert<h4><br>
    <input type="text" name="source_amount" placeholder="Optional"><br><br>

    <br>
    <h2 class="text-info">Target<h2><br>
    <h4>Please enter the unit you want to convert : " grams", "piece"<h4><br>
    <input type="text" name="target_unit" placeholder="Search" required><br><br>-->

   <input type="submit" class="btn btn-info" value="submit" name="submit_inventory">
  </form>
  </div>


  <!-- Callout -->
  <section class="callout">
    <div class="container text-center">
      <h2 class="mx-auto mb-5">Eat Good<br>
        <em>and</em>
        Feel Good</h2>
    </div>
  </section>


  <!-- Footer -->
  <footer id ="contact" class="footer text-center">
    <div class="container">
      <ul class="list-inline mb-5">
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white mr-3" href="#">
            <i class="icon-social-facebook"></i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white mr-3" href="#">
            <i class="icon-social-twitter"></i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white" href="#">
            <i class="icon-social-github"></i>
          </a>
        </li>
      </ul>
      <p class="text-muted small mb-0">Copyright &copy; iHungry 2019</p>
    </div>
  </footer>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/stylish-portfolio.min.js"></script>

</body>

</html>
