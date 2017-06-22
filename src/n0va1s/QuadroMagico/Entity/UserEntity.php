<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Role\Role;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class UserEntity implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="seq_usuario")
     * @ORM\GeneratedValue
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=100, name="eml_usuario")
     */
    public $username;

    /**
     * @ORM\Column(type="string", length=100, name="val_senha")
     */
    public $password;

    /**
     * @ORM\Column(type="string", length=100, name="des_senha")
     */
    public $plainPassword;

    /**
     * @ORM\Column(type="string", length=100, name="tip_perfil")
     */
    public $roles = array('ROLE_USER');

    /**
     * @ORM\Column(type="datetime", name="dat_cadastro")
     */
    public $createdAt;

    public function __construct()
    {
        $this->createdAt = new \Datetime();
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $emailValido = filter_var($username, FILTER_VALIDATE_EMAIL);
        if (!$emailValido) {
            throw new \InvalidArgumentException();
        }
        $this->username = $username;
    }

    public function setPassword($password)
    {
        if (empty($password)) {
            throw new \InvalidArgumentException();
        }
        $this->password = $password;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function __toString()
    {
        return $this->getUsername();
    }

    public function toArray()
    {
        return array(
            'id' => $this->id,
            'username' => $this->getUsername(),
            'salt' => $this->getSalt(),
            'roles' => $this->getRoles(),
            'password'=>$this->getPassword()
        );
    }
}
