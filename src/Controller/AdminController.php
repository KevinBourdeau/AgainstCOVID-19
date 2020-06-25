<?php
// src/Controller/AdminController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AdminController
{

  public function sessionStart() 
  {
    session_start();

    if (isset($_SESSION['isAdmin']) == false)
    {
      $_SESSION['isAdmin'] = false;
    }
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