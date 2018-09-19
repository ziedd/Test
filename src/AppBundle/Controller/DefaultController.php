<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="liste_contact")
     */
    public function contactpageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $contactes = $em->getRepository("AppBundle:Contact")->findAll();
        
        return $this->render('contactes/list.html.twig', ["contactes" => $contactes]);
    }

    /**
     * @param Contact $contact
     * @return bool
     *
     * @throws \Exception
     *
     * @Route("/email/validation/{id}/contact",name = "email_validation")
     * @Method("GET")
     */
    public function contactEmailValidationAction(Contact $contact){

        $service = $this->get('email_validation');
        $email = $contact->getEmail();

        if (empty($email)) {
            throw new \Exception(" email n'existe pas ");
        }
        $validation = $service->getEmailValidation($email);
        
        return  new JsonResponse(['validation' => $validation]);
    }


}
