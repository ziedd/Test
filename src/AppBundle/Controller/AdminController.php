<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Adresse;
use AppBundle\Entity\Contact;
use AppBundle\Form\AdresseType;
use AppBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/create")
 */
class AdminController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     * @Route("/contact ",name="admin_contact_create")
     */
    public function newContactAction(Request $request)
    {

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if (($form->isSubmitted()) && ($form->isValid())) {
            $contact = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', 'contact est creé!');
            return $this->redirectToRoute('liste_contact');

        }
        return $this->render('admin/new_contact.html.twig', ['contactForm' => $form->createView()]);


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/contact/{id}/edit",name="admin_contact_edit")
     *
     */
    public function editContactAction(Request $request, Contact $contact)
    {
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if (($form->isSubmitted()) && ($form->isValid())) {
            $contact = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', 'adresse a été bien modifié !');
            return $this->redirectToRoute('liste_contact');
        } else {
            $em = $this->getDoctrine()->getManager();
            $contacte = $this->getDoctrine()->getManager()->getRepository("AppBundle:Contact")->findOneBy(array(), null, ['DESC', 1]);
            $adresses = $em->getRepository("AppBundle:Adresse")->findAllByContactAdresse($contacte);
           
            return $this->render('admin/edit_contact.html.twig', ['contactForm' => $form->createView(), "adresses" => $adresses]);
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/adresse ",name="admin_adresse_create")
     */
    public function newAdresseAction(Request $request)
    {

        $form = $this->createForm(AdresseType::class);

        $form->handleRequest($request);

        if (($form->isSubmitted()) && ($form->isValid())) {
            $adresse = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($adresse);
            $em->flush();
            $this->addFlash('success', 'adresse a éte bien crée !');
            return $this->redirectToRoute('liste_contact');
        }
       
        return $this->render('admin/new_adresse.html.twig', ['adresseForm' => $form->createView()]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/adresse/{id}/edit",name="admin_adresse_edit")
     *
     */
    public function editAdresseAction(Request $request, Adresse $adresse)
    {
        $form = $this->createForm(AdresseType::class, $adresse);

        $form->handleRequest($request);
        if (($form->isSubmitted()) && ($form->isValid())) {
            $contact = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', 'adresse a été bien modifié !');
            return $this->redirectToRoute('liste_contact');
        } else {
            
            return $this->render('admin/edit_adresse.html.twig', ['adresseForm' => $form->createView()]);
        }
    }

}
