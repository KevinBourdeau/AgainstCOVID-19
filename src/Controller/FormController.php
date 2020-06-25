<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;
use App\Form\FormType;
use App\Entity\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{

    /*public function requestForm(Request $request)
    {
        // Instantiate a new Form
        $demande = new Form();

        //Instantiate the form
        $form = $this->createForm(FormType::class, $demande);

        $form->handleRequest($request);
        

        //Test if the form is correctly submited
        if ($form->isSubmitted() && $form->isValid()) {
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
                
            ]
        );
        }
        
        // Create the view and the form
        return $this->render('Body/formPage.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }*/
   
}
