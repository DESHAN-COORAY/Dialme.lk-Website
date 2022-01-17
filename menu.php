<?php 

include('config/constants.php'); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="shortcut icon" type="images/png" href="images/favicon.png"/>
  <title>Dialme - Online Phone Store </title>
</head>

<body>
  <!-- START HERE -->
  <header class="header">
        <nav class="navbar">
            <a href="http://localhost/DialmeProject/" class="nav-logo">
              <img src="images/logo.png" width="250">
            </a>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>categories.php" class="nav-link">CATEGORIES</a>
                </li>
                <li class="nav-item">
                    <a href="phones.php" class="nav-link">PHONES</a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link">CONTACT</a>

                </li>

                <li class="nav-item">
                <a href="http://localhost/DialmeProject/admin/login.php" class="nav-link btn_secondary text-center my-3">Admin Login</a>
                    <h6>Hotline: 0112 569 256</h6>
                    <h6>Inquires: info@dialme.lk</h6>
                    
                </li>
                
            </ul>

        </nav>
</header>

<!-- Navigation end -->