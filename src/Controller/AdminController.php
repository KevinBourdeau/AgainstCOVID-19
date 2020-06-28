<?php
// src/Controller/AdminController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;
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

    $client = HttpClient::create();
    $demandes = $client->request('GET', 'http://localhost:8080/api/demandes');
    $demandes = json_decode($demandes->getContent());
    

    $content =
      $twig->render('Header/header.html.twig', ['page' => 'Demande']) . 
      $twig->render('Navbar/navbar.html.twig', ['isActive1' => null, 'isActive2' => null, 'isActive3' => null, 'isActive4' => 'active', 'isAdmin' => $_SESSION['isAdmin']]) .
      $twig->render('Body/tableTop.html.twig');

    
    foreach($demandes as $row)
    {
      $content .= $twig->render('Body/tableRow.html.twig', ['id' => $row->{'id'}, 'nom' => $row->{'nom'}, 'prenom' => $row->{'prenom'}, 'nom_etablissement' => $row->{'nom_etablissement'}, 'tel' => $row->{'tel'}, 'email' => $row->{'email'}, 'quantite' => $row->{'quantite'}, 'date' => $row->{'date'}, 'status' => $row->{'statut'}]); 
    }
    
      
    $content .=
      $twig->render('Body/tableBottom.html.twig') .
      $twig->render('Footer/footerAdmin.html.twig', ['isAdmin' => $_SESSION['isAdmin']]) . 
      $twig->render('End/end.html.twig');

    if ($_SESSION['isAdmin'])
    {
      return new Response($content);
    }
    else
    {
      return new Response('Access denied ! : error 403');
    }

  }

}