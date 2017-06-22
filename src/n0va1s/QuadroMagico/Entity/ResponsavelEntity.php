<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Role\Role;

/**
 * @ORM\Entity
 * @ORM\Table(name="responsavel")
 */
class ResponsavelEntity
{
    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="UserEntity")
     * @ORM\JoinColumn(name="seq_usuario", referencedColumnName="seq_usuario")
     */
    public $usuario;

    /**
     * @ORM\Column(type="string", length=100, name="nom_responsavel")
     */
    public $nome;

    /**
     * @ORM\Column(type="string", length=1, name="ind_genero")
     */
    public $genero;

    /**
     * @ORM\Column(type="string", length=1, name="ind_parentesco")
     */
    public $parentesco;

    /**
     * @ORM\Column(type="string", length=2, name="sig__uf_responsavel")
     */
    private $uf;

    /**
     * @ORM\Column(type="string", length=255, name="des_expectativa")
     */
    private $expectativa;

    /**
     * @ORM\Column(type="datetime", name="dat_cadastro")
     */
    public $cadastro;

    public function __construct()
    {
        $this->cadastro = new \Datetime();
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
        return $this;
    }

    public function getParentesco()
    {
        return $this->parentesco;
    }

    public function setParentesco($parentesco)
    {
        $this->parentesco = $parentesco;
        return $this;
    }

    public function getUf()
    {
        return $this->uf;
    }

    private function setUf($uf)
    {
        $this->uf = $uf;
        return $this;
    }

    public function getExpectativa()
    {
        return $this->expectativa;
    }

    private function setExpectativa($expectativa)
    {
        $this->expectativa = $expectativa;
        return $this;
    }
}
