<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
class ContactController extends AbstractController
{

    public function sessionStart()
  {
    session_start();

    if (isset($_SESSION['isAdmin']) == false) {
      $_SESSION['isAdmin'] = false;
    }
  }

 public function contactPage(Environment $twig) {

    $this->sessionStart();

    $content =
      $twig->render('Header/header.html.twig', ['page' => 'Produit']) . 
      $twig->render('Navbar/navbar.html.twig', ['isActive1' => null, 'isActive2' => null, 'isActive3' => null, 'isActive4' => null, 'isAdmin' => $_SESSION['isAdmin']]) . 
      $twig->render('Body/contactPage.html.twig') . 
      $twig->render('Footer/footer.html.twig', ['isAdmin' => $_SESSION['isAdmin']]) . 
      $twig->render('End/end.html.twig');

    return new Response($content);
  }
}
