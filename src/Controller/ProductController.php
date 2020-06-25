<?php
// src/Controller/ProductController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ProductController
{

  public function sessionStart() 
  {
    session_start();

    if (isset($_SESSION['isAdmin']) == false)
    {
      $_SESSION['isAdmin'] = false;
    }
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
}