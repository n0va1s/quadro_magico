<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="perfil")
 */
class PerfilEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="seq_perfil")
     * @ORM\GeneratedValue
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=100, name="nom_responsavel")
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=1, name="ind_genero")
     */
    private $genero;

    /**
     * @ORM\Column(type="string", length=1, name="ind_parentesco")
     */
    private $parentesco;

    /**
     * @ORM\Column(type="string", length=2, name="sig_uf_responsavel")
     */
    private $uf;

    /**
     * @ORM\Column(type="string", length=255, name="des_expectativa")
     */
    private $expectativa;

    /**
     * @ORM\Column(type="datetime", name="dat_cadastro")
     */
    private $cadastro;

    public function __construct()
    {
        $this->cadastro = new \Datetime();
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

    public function setUf($uf)
    {
        $this->uf = $uf;
        return $this;
    }

    public function getExpectativa()
    {
        return $this->expectativa;
    }

    public function setExpectativa($expectativa)
    {
        $this->expectativa = $expectativa;
        return $this;
    }
}
