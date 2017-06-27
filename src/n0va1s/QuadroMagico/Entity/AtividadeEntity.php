<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\hasLifeCycleCallbacks
 * @ORM\Table(name="atividade")
 */
class AtividadeEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="seq_atividade")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, name="des_atividade")
     */
    private $atividade;

    /**
     * @ORM\Column(type="string", length=255, name="val_atividade")
     */
    private $valor;

    /**
     * @ORM\Column(type="string", length=1, name="ind_proposito")
     */
    private $proposito;

    /**
     * @ORM\Column(type="datetime", name="dat_cadastro")
     */
    private $cadastro;

    /**
     * @ORM\ManyToOne(targetEntity="QuadroEntity", inversedBy="atividades")
     * @ORM\JoinColumn(name="seq_quadro", referencedColumnName="seq_quadro", onDelete="CASCADE")
     */
    private $quadro;

    public function __construct()
    {
        $this->cadastro = new \Datetime();
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setProposito($proposito)
    {
        $this->proposito = $proposito;
        return $this;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    public function setAtividade($atividade)
    {
        $this->atividade = $atividade;
        return $this;
    }

    public function setQuadro($quadro)
    {
        $this->quadro = $quadro;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getProposito()
    {
        return $this->proposito;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getAtividade()
    {
        return $this->atividade;
    }

    public function getQuadro()
    {
        return $this->quadro;
    }

    public function getCadastro()
    {
        return $this->cadastro;
    }
}
