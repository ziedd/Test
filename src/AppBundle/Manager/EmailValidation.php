<?php
namespace AppBundle\Manager;
use Symfony\Component\BrowserKit\Response;

/**
 * Class EmailValidation
 */
class EmailValidation
{
    /**
     * @var bool
     */
    protected $validation = false;

    /**
     * @param $email
     * @return bool
     */
    public function getEmailValidation($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email format");
        }
        $expected = strstr($email, '@');
        // par exemple on accepte que l'extension gmail.com
        if ($expected != '@gmail.com') {
            throw new \InvalidArgumentException('Email n\'est pas  sous  la forme @gmail.com');
        }
        $validation = true;

        return  $validation;
    }


}