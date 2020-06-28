<?php
// src/Controller/ConnectAdminController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConnectAdminController extends AbstractController
{

  public function sessionStart() 
  {
    session_start();

    if (isset($_SESSION['isAdmin']) == false)
    {
      $_SESSION['isAdmin'] = false;
    }
  }

  public function connectAdminPage(Environment $twig) {

    $this->sessionStart();

    $content = $twig->render('Body/connectAdmin.html.twig');

    return new Response($content);

  }

  public function connectAdminCheck(Environment $twig) 
  {

    $this->sessionStart();

    $file = fopen( "../templates/Content/security.txt", "r" );
    $password = "";
    while(!feof($file)) {
      $password .= fgets($file, 4096);
    }
    fclose($file);

    if ($_POST['password'] == $password)
    {
      $_SESSION['isAdmin'] = true;
      return $this->redirectToRoute('homePage');
    }
    else
    {
      return $this->redirectToRoute('connectAdminPage');
    }

  }

  public function deconnectAdmin()
  {
    $this->sessionStart();

    $_SESSION['isAdmin'] = false;

    return $this->redirectToRoute('homePage');

  }
  
}