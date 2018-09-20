<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends BaseController
{
    /**
     * @Route("/", name="liste_contact")
     */
    public function contactPageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $contactes = $em->getRepository("AppBundle:Contact")->findAll();
        $contacte = $this->getDoctrine()->getManager()->getRepository("AppBundle:Contact")->findOneBy(array(), null, ['DESC', 1]);

        if (!$contacte) {
            throw $this->createNotFoundException('Contact n\'exit pas' );
        }
        
        $adresses = $em->getRepository("AppBundle:Adresse")->findAllByContactAdresse($contacte);
        return $this->render('contactes/list.html.twig', ["contactes" => $contactes,
            "adresses" => $adresses]);
    }

    /**
     * @Route("/adresse/list", name="liste_adresse")
     */
    public function adressePageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $contacte = $this->getDoctrine()->getManager()->getRepository("AppBundle:Contact")->findOneBy(array(), null, ['DESC', 1]);

        if (!$contacte) {
            throw $this->createNotFoundException('Contact n\'exit pas' );
        }

        $adresses = $em->getRepository("AppBundle:Adresse")->findAllByContactAdresse($contacte);
        return $this->render('adresses/list_adresses.html.twig', [
            "adresses" => $adresses]);
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
    public function EmailValidationAction(Contacte $contacte){

        $service = $this->get('email_validation');
        $email = $contacte->getEmail();

        if (empty($email)) {
            throw new \Exception(" email n'existe pas ");
        }
        $validation = $service->getEmailValidation($email);
        
        return  new JsonResponse(['validation' => $validation]);
    }


}
