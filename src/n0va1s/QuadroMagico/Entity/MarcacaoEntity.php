<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\hasLifeCycleCallbacks
 * @ORM\Table(name="marcacao")
 */
class MarcacaoEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="seq_marcacao")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="ind_segunda", nullable=true, columnDefinition="CHAR(1)")
     */
    private $segunda;

    /**
     * @ORM\Column(type="string", name="ind_terca", nullable=true, columnDefinition="CHAR(1)")
     */
    private $terca;

    /**
     * @ORM\Column(type="string", name="ind_quarta", nullable=true, columnDefinition="CHAR(1)")
     */
    private $quarta;

    /**
     * @ORM\Column(type="string", name="ind_quinta", nullable=true, columnDefinition="CHAR(1)")
     */
    private $quinta;

    /**
     * @ORM\Column(type="string", name="ind_sexta", nullable=true, columnDefinition="CHAR(1)")
     */
    private $sexta;

    /**
     * @ORM\Column(type="string", name="ind_sabado", nullable=true, columnDefinition="CHAR(1)")
     */
    private $sabado;

    /**
     * @ORM\Column(type="string", name="ind_domingo", nullable=true, columnDefinition="CHAR(1)")
     */
    private $domingo;

    /**
     * @ORM\ManyToOne(targetEntity="AtividadeEntity", inversedBy="marcacoes")
     * @ORM\JoinColumn(name="seq_atividade", referencedColumnName="seq_atividade", onDelete="CASCADE")
     */
    private $atividade;

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

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getSegunda()
    {
        return $this->segunda;
    }

    public function setSegunda($segunda)
    {
        $this->segunda = $segunda;
        return $this;
    }

    public function getTerca()
    {
        return $this->terca;
    }

    public function setTerca($terca)
    {
        $this->terca = $terca;
        return $this;
    }

    public function getQuarta()
    {
        return $this->quarta;
    }

    public function setQuarta($quarta)
    {
        $this->quarta = $quarta;
        return $this;
    }

    public function getQuinta()
    {
        return $this->quinta;
    }

    public function setQuinta($quinta)
    {
        $this->quinta = $quinta;
        return $this;
    }

    public function getSexta()
    {
        return $this->sexta;
    }

    public function setSexta($sexta)
    {
        $this->sexta = $sexta;
        return $this;
    }

    public function getSabado()
    {
        return $this->sabado;
    }

    public function setSabado($sabado)
    {
        $this->sabado = $sabado;
        return $this;
    }

    public function getDomingo()
    {
        return $this->domingo;
    }

    public function setDomingo($domingo)
    {
        $this->domingo = $domingo;
        return $this;
    }

    public function getAtividade()
    {
        return $this->atividade;
    }

    public function setAtividade($atividade)
    {
        $this->atividade = $atividade;
        return $this;
    }

    public function getCadastro()
    {
        return $this->cadastro;
    }

    public function setCadastro($cadastro)
    {
        $this->cadastro = $cadastro;
        return $this;
    }
}
