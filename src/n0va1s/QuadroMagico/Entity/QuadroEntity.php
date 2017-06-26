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
     * @ORM\Column(type="string", length=100, name="eml_responsavel")
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
     * @ORM\Column(type="decimal", precision=10, scale=2, name="val_mesada", nullable=true)
    */
    private $mesada;
    
    /**
     * @ORM\Column(type="datetime", name="dat_cadastro")
     */
    private $cadastro;

    /**
     * @ORM\OneToMany(targetEntity="AtividadeEntity", mappedBy="atividade")
     */
    private $atividades;

    public function __construct()
    {
        $this->cadastro = new \Datetime();
        $this->atividades = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
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

    public function getIdade()
    {
        return $this->idade;
    }

    public function setIdade($idade)
    {
        $this->idade = $idade;
        return $this;
    }

    public function getCrianca()
    {
        return $this->crianca;
    }

    public function setCrianca($crianca)
    {
        $this->crianca = $crianca;
        return $this;
    }

    public function getRecompensa()
    {
        return $this->recompensa;
    }

    public function setRecompensa($recompensa)
    {
        $this->recompensa = $recompensa;
        return $this;
    }

    public function getMesada()
    {
        return $this->mesada;
    }

    public function setMesada($mesada)
    {
        $this->mesada = $mesada;
        return $this;
    }

    public function getResponsavel()
    {
        return $this->responsavel;
    }

    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
        return $this;
    }
}
