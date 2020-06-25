<?php
// src/Controller/DemandeController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class DemandeController
{

  public function sessionStart() 
  {
    session_start();

    if (isset($_SESSION['isAdmin']) == false)
    {
      $_SESSION['isAdmin'] = false;
    }
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
}