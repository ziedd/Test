<?php

namespace AppBundle\Controller;

use AppBundle\Legacy\ErreurMsg;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class UserController
 * @package AppBundle\Controller
 */
class UserController extends BaseController
{
    /**
     * @Route("/register", name="user_register")
     * @Method("GET")
     */
    public function registerAction()
    {
        if ($this->isUserLoggedIn()) {
            return $this->redirect($this->generateUrl('contactes'));
        }

        return $this->render('user/register.twig', array('user' => new User()));
    }

    /**
     * @Route("/register", name="user_register_handle")
     * @Method("POST")
     */
    public function registerHandleAction(Request $request)
    {
        $errors = array();

        if (!$email = $request->request->get('email')) {
            $errors[] = '"email" is required';
        }
        if (!$plainPassword = $request->request->get('plainPassword')) {
            $errors[] = '"password" is required';
        }
        if (!$username = $request->request->get('username')) {
            $errors[] = '"username" is required';
        }

        $userRepository = $this->getUserRepository();

        // verifier l'existance d'utilisateur 
        if ($existingUser = $userRepository->findUserByEmail($email)) {
            $errors[] = ErreurMsg::EMAIL_INVALID;
        }
 
        if ($existingUser = $userRepository->findUserByUsername($username)) {
            $errors[] = ErreurMsg::NON_IVALID;
        }

        $user = new User();
        $user->setEmail($email);
        $user->setUsername($username);
        $encodedPassword = $this->container->get('security.password_encoder')
            ->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        // lister les erreurs !
        if (count($errors) > 0) {
            return $this->render('user\register.twig', array('errors' => $errors, 'user' => $user));
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $this->loginUser($user);

        return $this->redirect($this->generateUrl('liste_contact'));
    }

    /**
     * @Route("/login", name="security_login_form")
     */
    public function loginAction(Request $request)
    {
        if ($this->isUserLoggedIn()) {
            return $this->redirect($this->generateUrl('liste_contact'));
        }

        return $this->render('user/login.twig', array(
            'error'         => $this->container->get('security.authentication_utils')->getLastAuthenticationError(),
            'last_username' => $this->container->get('security.authentication_utils')->getLastUserName()
        ));
    }

    /**
     * @Route("/login_check", name="security_login_check")
     */
    public function loginCheckAction()
    {
        throw new \Exception('Ne devrait pas arriver ici,voir le système de sécurité!');
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {
        throw new \Exception('Ne devrait pas arriver ici,voir le système de sécurité!');
    }
    
    /**
     * @return UserRepository
     */
    protected function getUserRepository()
    {
        return $this->getDoctrine()
            ->getRepository('AppBundle:User');
    }
}
