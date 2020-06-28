<?php
// src/Controller/MainController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class MainController
{

  public function sessionStart() 
  {
    session_start();

    if (isset($_SESSION['isAdmin']) == false)
    {
      $_SESSION['isAdmin'] = false;
    }
  }

  public function homePage(Environment $twig)
  {

    $this->sessionStart();

    $file    = fopen( "../templates/Content/HomePage/section1.txt", "r" );
    $s1 = "";
    while(!feof($file)) {
      $s1 .= fgets($file, 4096);
    }
    fclose($file);

    $file    = fopen( "../templates/Content/HomePage/section2.txt", "r" );
    $s2 = "";
    while(!feof($file)) {
      $s2 .= fgets($file, 4096);
    }
    fclose($file);

    $file    = fopen( "../templates/Content/HomePage/section3.txt", "r" );
    $s3 = "";
    while(!feof($file)) {
      $s3 .= fgets($file, 4096);
    }
    fclose($file);

    $content = 
      $twig->render('Header/header.html.twig', ['page' => 'Accueil']) . 
      $twig->render('Navbar/navbar.html.twig', ['isActive1' => 'active', 'isActive2' => null, 'isActive3' => null, 'isActive4' => null, 'isAdmin' => $_SESSION['isAdmin']]) . 
      $twig->render('Body/homePage.html.twig', ['s1' => $s1, 's2' => $s2, 's3' => $s3]) . 
      $twig->render('Footer/footer.html.twig', ['isAdmin' => $_SESSION['isAdmin']]) . 
      $twig->render('End/end.html.twig');

    return new Response($content);
  }


  public function productPage(Environment $twig) {

    $this->sessionStart();

    $content =
      $twig->render('Header/header.html.twig', ['page' => 'Produit']) . 
      $twig->render('Navbar/navbar.html.twig', ['isActive1' => null, 'isActive2' => 'active', 'isActive3' => null, 'isActive4' => null, 'isAdmin' => $_SESSION['isAdmin']]) . 
      $twig->render('Body/productPage.html.twig') . 
      $twig->render('Footer/footer.html.twig') . 
      $twig->render('End/end.html.twig');

    return new Response($content);

  }


  public function demandePage(Environment $twig) {

    $this->sessionStart();

    $content =
      $twig->render('Header/header.html.twig', ['page' => 'Demande']) . 
      $twig->render('Navbar/navbar.html.twig', ['isActive1' => null, 'isActive2' => null, 'isActive3' => 'active', 'isActive4' => null, 'isAdmin' => $_SESSION['isAdmin']]) .
      $twig->render('Body/formPage.html.twig') .
      $twig->render('Footer/footer.html.twig') . 
      $twig->render('End/end.html.twig');

    return new Response($content);

  }

  public function connectAdminPage(Environment $twig) {

    $this->sessionStart();

    $content =
      $twig->render('Header/header.html.twig', ['page' => 'Demande']) . 
      $twig->render('Navbar/navbar.html.twig', ['isActive1' => null, 'isActive2' => null, 'isActive3' => null, 'isActive4' => null, 'isAdmin' => $_SESSION['isAdmin']]) .
      $twig->render('Body/connectAdmin.html.twig') . 
      $twig->render('Footer/footer.html.twig') . 
      $twig->render('End/end.html.twig');

    return new Response($content);

  }

  
  public function adminPage(Environment $twig) {

    $this->sessionStart();

    $content =
      $twig->render('Header/header.html.twig', ['page' => 'Demande']) . 
      $twig->render('Navbar/navbar.html.twig', ['isActive1' => null, 'isActive2' => null, 'isActive3' => null, 'isActive4' => 'active', 'isAdmin' => $_SESSION['isAdmin']]) .
      $twig->render('Footer/footer.html.twig') . 
      $twig->render('End/end.html.twig');

    return new Response($content);

  }

}