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
    public function nouveauContactAction(Request $request)
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
     *     */
    public function EditContactAction(Request $request, Contact $contact)
    {
        // $user = $request->query->get()
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if (($form->isSubmitted()) && ($form->isValid())) {
            $contact = $form->getData();
            $em = $this->getDoctrine()->getManager();
          //  $contact->setUsers($users); SET USER IN  DATABASE
            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', 'adresse a été bien modifié !');
            return $this->redirectToRoute('liste_contact');
        } else {
            return $this->render('admin/edit_contact.html.twig', ['contactForm' => $form->createView()]);

        }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/adresse/{id}/edit",name="admin_adresse_edit")
     *     
     */
    public function EditAdresseAction(Request $request, Adresse $adresse)
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
