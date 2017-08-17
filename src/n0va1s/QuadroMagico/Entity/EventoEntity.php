<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\hasLifeCycleCallbacks
 * @ORM\Table(name="evento")
 */
class EventoEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="seq_evento")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", name="dat_avaliacao")
     */
    private $data;

    /**
     * @ORM\Column(type="string", length=1, name="tip_marcacao")
     */
    private $marcacao;

    /**
     * @ORM\Column(type="text", name="txt_positivo", nullable=true)
     */
    private $positivo;

    /**
     * @ORM\Column(type="text", name="txt_negativo", nullable=true)
     */
    private $negativo;

    /**
     * @ORM\ManyToOne(targetEntity="AtividadeEntity", inversedBy="eventos")
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

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
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
}
