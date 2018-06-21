<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use n0va1s\QuadroMagico\Entity\AtividadeEntity;
use n0va1s\QuadroMagico\Entity\TipoQuadroEntity;

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
     * @ORM\ManyToOne(targetEntity="TipoQuadroEntity")
     * @ORM\JoinColumn(name="tip_quadro", referencedColumnName="seq_tipo_quadro")
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", name="tip_genero", columnDefinition="CHAR(1) NOT NULL")
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
     * @ORM\Column(type="string", length=255, name="des_recompensa", nullable=true)
     */
    private $recompensa;

    /**
     * @ORM\Column(type="datetime", name="dat_cadastro")
     */
    private $cadastro;

    /**
     * @ORM\Column(type="string", length=40, name="cod_quadro")
     */
    private $codigo;

    /** @ORM\Column(type="string", name="ind_inativo", columnDefinition="CHAR(1) NOT NULL", options={"default":"N"}) */
    private $inativo;

    /**
     * @ORM\OneToMany(targetEntity="AtividadeEntity", mappedBy="quadro")
     */
    private $atividades;

    public function __construct()
    {
        $this->cadastro = new \Datetime();
        $this->atividades = new ArrayCollection();
        $this->codigo = hash('crc32b', rand()); //gera um codigo unico com 8 caracteres
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
        if (empty($tipo)) {
            throw new \InvalidArgumentException('Tipo de quadro não informado', 2);
        }
        $this->tipo = $tipo;
        return $this;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        if (empty($genero)) {
            throw new \InvalidArgumentException('Genero da crianca não informado', 3);
        }
        $this->genero = $genero;
        return $this;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function setIdade($idade)
    {
        if (empty($idade)) {
            throw new \InvalidArgumentException('Idade da crianca não informada', 4);
        }
        $this->idade = $idade;
        return $this;
    }

    public function getCrianca()
    {
        return $this->crianca;
    }

    public function setCrianca($crianca)
    {
        if (empty($crianca)) {
            throw new \InvalidArgumentException('Nome da crianca não informado', 5);
        }
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
        if (empty($responsavel)) {
            throw new \InvalidArgumentException('Email do responsavel não informado', 6);
        }

        $emailValido = filter_var($responsavel, FILTER_VALIDATE_EMAIL);
        if (!$emailValido) {
            throw new \InvalidArgumentException('Email do responsavel é inválido', 7);
        }
        $this->responsavel = $responsavel;
        return $this;
    }
    
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getAtividades()
    {
        return $this->atividades;
    }

    public function getInativo()
    {
        return $this->inativo;
    }

    public function setInativo()
    {
        $this->mesada = 'S';
        return $this;
    }
}
