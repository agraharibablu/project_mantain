<html>

<head>
  <title></title>
  <link rel="stylesheet" href="<?= base_url('assets') ?>/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    body {
      height: 100%;
      width: 100%;
      position: absolute;
    }

    .bg-vue {
      background-color: #42b983;
    }

    .login {
      margin: 1% 5% 1% 55%;
      padding: 50px;
    }

    .textHeading {
      text-align: center;
      font-weight: bolder;
      margin-top: 28vh;
      padding: 20px;
    }
  </style>
</head>
<?php //echo uri($this,1);?>
<body>
  <nav class="navbar navbar-expand-sm navbar-light bg-white ">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center" id="navbarNav">
      <ul class="navbar-nav ml-auto mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url('/') ?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/note') ?>">Note</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">

        <li class="nav-item">

        </li>

      </ul>
    </div>
    <span class="nav-link text-defalut font-weight-bold"><?php print_r(session('user')['name']) ?></span></li>|
    <a class="nav-link text-danger" href="<?= base_url('logout') ?>">Logout <i class="fas fa-sign-out-alt"></i></a>
  </nav>


  <?= $this->renderSection('content') ?>


  <nav class="navbar navbar-light bg-secondary">
    <span class="navbar-text">
      Navbar text with an inline element
    </span>
  </nav>

  <script src="<?= base_url('assets') ?>/bootstrap/js/bootstrap.js"></script>
  <script src="<?= base_url('assets') ?>/bootstrap/js/bootstrap.bundle.js"></script>
  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>


</body>

</html>