<?php
// src/Controller/DemandeController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;
use App\Form\FormType;
use App\Entity\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DemandeController extends AbstractController
{

  public function sessionStart()
  {
    session_start();

    if (isset($_SESSION['isAdmin']) == false) {
      $_SESSION['isAdmin'] = false;
    }
  }

  public function demandePage(Environment $twig, Request $request, \Swift_Mailer $mail)
  {

    $this->sessionStart();

    // Instantiate a new Form
    $demande = new Form();

    //Instantiate the form
    $form = $this->createForm(FormType::class, $demande);

    $form->handleRequest($request);
    //Test if the form is correctly submited
    if ($form->isSubmitted() && $form->isValid()) {
      $data = $form->getData();
      // Send the email
      $message = (new \Swift_Message('Récapitulatif de la demande'))

        //On attrbiut l'expéditeur
        ->setFrom('kevin.bourdeau2015@gmail.com')

        //On attribue le destinataire
        ->setTo('kevin.bourdeau2015@gmail.com')

        //On set le type de contenue
        ->setContentType("text/html")

        //On crée le message avec la vue twig
        ->setBody(
          $this->renderView('Mail/mail.html.twig', compact('data'))
        );
      $mail->send($message);


      // HTTP request to add a user
      $client = HttpClient::create();
      $client->request('POST', 'http://localhost:8080/api/demandes', [
        'body' => [
          'nom' => $demande->getNom(),
          'prenom' => $demande->getPrenom(),
          'nom_etablissement' => $demande->getNomEtablissement(),
          'tel' => $demande->getTel(),
          'email' => $demande->getEmail(),
          'quantite' => $demande->getQuantite(),
        ]
      ]);
    }


    $content =
      $twig->render('Header/header.html.twig', ['page' => 'Demande']) .
      $twig->render('Navbar/navbar.html.twig', ['isActive1' => null, 'isActive2' => null, 'isActive3' => 'active', 'isActive4' => null, 'isAdmin' => $_SESSION['isAdmin']]) .
      $twig->render('Body/formPage.html.twig', [
        'form' => $form->createView(),

      ]) .
      $twig->render('Footer/footer.html.twig') .
      $twig->render('End/end.html.twig');

    return new Response($content);
  }
}
