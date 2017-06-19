<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile as File;
use n0va1s\QuadroMagico\Service\AtividadeService;

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
     * @ORM\ManyToOne(targetEntity="QuadroEntity")
     * @ORM\JoinColumn(name="seq_quadro", referencedColumnName="seq_quadro")
     */
    private $quadro;

    /**
     * @ORM\Column(type="string", length=100, name="des_atividade")
     */
    private $atividade;

    /**
     * @ORM\Column(type="string", length=255, name="val_atividade")
     */
    private $valor;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="dat_cadastro")
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

    public function getAtividade()
    {
        return $this->atividade;
    }

    private function _setAtividade($atividade)
    {
        $this->atividade = $atividade;

        return $this;
    }

    public function getValor()
    {
        return $this->valor;
    }

    private function _setValor($valor)
    {
        $this->valor = $valor;

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
