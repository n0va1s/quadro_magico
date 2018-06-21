<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;
use n0va1s\QuadroMagico\Entity\QuadroEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="tipo_quadro")
 */
class TipoQuadroEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="seq_tipo_quadro")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="val_tipo_quadro", columnDefinition="CHAR(1) NOT NULL")
     */
    private $codigo;

    /**
     * @ORM\Column(type="string", length=255, name="des_tipo_quadro")
     */
    private $descricao;

    public function getId()
    {
        return $this->id;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
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
