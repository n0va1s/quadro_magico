<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="quadro")
 */
class QuadroEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="seq_quadro")
     * @ORM\GeneratedValue
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="ResponsavelEntity")
     * @ORM\JoinColumn(name="seq_usuario", referencedColumnName="seq_usuario")
     */
    private $responsavel;

    /**
     * @ORM\Column(type="string", length=1, name="tip_quadro")
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=1, name="tip_genero")
     */
    private $genero;

    /**
     * @ORM\Column(type="integer", name="num_idade")
     */
    private $idade;

    /**
     * @ORM\Column(type="string", length=100, name="nom_crianca")
     */
    private $crianca;

    /**
     * @ORM\Column(type="string", length=255, name="des_recompensa")
     */
    private $recompensa;
    /**
     * @ORM\Column(type="datetime", name="dat_cadastro")
     */
    private $cadastro;

    public function __construct()
    {
        $this->cadastro = new \Datetime();
    }

    public function getId()
    {
        return $this->id;
    }

    private function _setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    private function _setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    private function _setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    private function _setIdade($idade)
    {
        $this->idade = $idade;

        return $this;
    }

    public function getCrianca()
    {
        return $this->crianca;
    }

    private function _setCrianca($crianca)
    {
        $this->crianca = $crianca;

        return $this;
    }

    public function getRecompensa()
    {
        return $this->recompensa;
    }

    private function _setRecompensa($recompensa)
    {
        $this->recompensa = $recompensa;

        return $this;
    }

    public function getCadastro()
    {
        return $this->cadastro;
    }

    private function _setCadastro($cadastro)
    {
        $this->cadastro = $cadastro;

        return $this;
    }
}
