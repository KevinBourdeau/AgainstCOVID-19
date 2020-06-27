<?php
// src/Controller/DemandeController.php

/**
 * The DemandeController
 * @author kevinBoudeau
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;
use App\Form\FormType;
use App\Entity\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemandeController extends AbstractController
{

  public function sessionStart()
  {
    if (isset($_SESSION['isAdmin']) == false) {
      $_SESSION['isAdmin'] = false;
    }
  }

  /**
   * demandePage function
   * Créer un formulaire, insére les données de ce dernier dans la Bdd et envoi un email
   * @param $mail, $twig, $request
   */

  public function demandePage(Environment $twig, Request $request, \Swift_Mailer $mail)
  {

    $this->sessionStart();

    // On instancie un nouveau formulaire
    $demande = new Form();

    //On crée le formulaire
    $form = $this->createForm(FormType::class, $demande);

    $form->handleRequest($request);
    //On verifie si le formulaire est bien soumis et valide
    if ($form->isSubmitted() && $form->isValid()) {
      //On récupère les données pour les envoyer sous forme d'émail
      $data = $form->getData();
      // On prépare l'émail
      $message = (new \Swift_Message('Récapitulatif de la demande'))

        //On attrbiut l'expéditeur
        ->setFrom(['kevin.bourdeau2015@gmail.com' => 'AgainstCOVID19'])

        //On attribue le destinataire
        ->setTo(['kevin.bourdeau2015@gmail.com', $data->getEmail()])

        //On set le type de contenu
        ->setContentType("text/html")

        //On crée le message avec la vue twig
        ->setBody(
          $this->renderView('Mail/mail.html.twig', compact('data'))
        );
      $mail->send($message);
 

      // On crée une requête HTTP de type POST afin de stocker le formulaire dans la bdd
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
      //On redirige vers la page d'accueil
      return $this->redirectToRoute('homePage');
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
