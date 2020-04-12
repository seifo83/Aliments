<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @UniqueEntity(fields = {"username"},message ="Votre Login existe déja")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=10, minMessage="Il faut Plus de 5 carcac",maxMessage="Il faut moins de 10 carac")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=10, minMessage="Il faut Plus de 5 carcac",maxMessage="Il faut moins de 10 carac")
     */
    private $password;

    /**
     * @Assert\Length(min=5,max=10, minMessage="Il faut Plus de 5 carcac",maxMessage="Il faut moins de 10 carac")
     * @Assert\EqualTo(propertyPath="password", message="Merci de verifier votre MDP")
     */
    private $verificationPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }



    public function getverificationPassword(): ?string
    {
        return $this->verificationPassword;
    }

    public function setverificationPassword(string $verificationPassword): self
    {
        $this->verificationPassword = $verificationPassword;

        return $this;
    }


    public function getSalt()
    {

    }

    public function getRoles()
    {
        return [$this->roles];
    }

    public function eraseCredentials()
    {
    }

    public function setRoles(?string $roles): self
    {
        if ($roles === null) {
            $this->roles = "ROLE_USER";
        }else {
            $this->roles = $roles;
        }
        

        return $this;
    }






}


