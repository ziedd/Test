<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 */
class Contact
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
     * @ORM\OneToMany(targetEntity="Adresse",mappedBy="contact")
     */
    private $adresses;

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    
    /**
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $lastname;
    
    /**
     * @return mixed
     */
    public function getAdresses()
    {
        return $this->adresses;
    }

    /**
     * @param mixed $adresses
     */
    public function setAdresses($adresses)
    {
        $this->adresses = $adresses;
    }

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="contacts")
     */
    private $users;

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
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

}