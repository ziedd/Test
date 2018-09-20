<?php
namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * 
     * @ORM\Column(type="string", unique=true)
     */
    private $username;
    
    /**
     * @Assert\NotBlank()
     * 
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * 
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="Contact", mappedBy="users")
     */
    private $contacts;

    /**
     * @return mixed
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param mixed $contacts
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function getSalt()
    {
        return;
    }

    public function eraseCredentials()
    {
    }
}