<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;
use n0va1s\QuadroMagico\Entity\QuadroEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="tipo_atividade")
 */
class TipoAtividadeEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="seq_tipo_atividade")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="tip_atividade", columnDefinition="CHAR(1) NOT NULL")
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", name="ind_proposito", columnDefinition="CHAR(1) NOT NULL")
     */
    private $proposito;

    /**
     * @ORM\Column(type="string", length=255, name="des_tipo_atividade")
     */
    private $descricao;

    public function getId()
    {
        return $this->id;
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

    public function getProposito()
    {
        return $this->proposito;
    }

    public function setProposito($proposito)
    {
        $this->proposito = $proposito;
        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }
}
