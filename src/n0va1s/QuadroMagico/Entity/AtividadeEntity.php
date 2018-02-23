<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use n0va1s\QuadroMagico\Service\ArquivoService;

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
     * @ORM\Column(type="decimal", scale=0, name="val_atividade", nullable=true)
     */
    private $valor;

    /**
     * @ORM\Column(type="string", length=1, name="ind_proposito")
     */
    private $proposito;

    /**
     * @ORM\Column(type="string", length=100, name="url_imagem", nullable=true)
     */
    private $imagem;

    /**
     * @ORM\Column(type="datetime", name="dat_cadastro")
     */
    private $cadastro;

    /**
     * @ORM\ManyToOne(targetEntity="QuadroEntity", inversedBy="atividades")
     * @ORM\JoinColumn(name="seq_quadro", referencedColumnName="seq_quadro", onDelete="CASCADE")
     */
    private $quadro;

    /**
     * @ORM\OneToMany(targetEntity="MarcacaoEntity", mappedBy="atividade")
     */
    private $marcacoes;

    public function __construct()
    {
        $this->cadastro = new \Datetime();
        $this->marcacoes = new ArrayCollection();
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

    public function getAtividade()
    {
        return $this->atividade;
    }

    public function setAtividade($atividade)
    {
        $this->atividade = $atividade;
        return $this;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
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

    public function getImagem()
    {
        return ArquivoService::recuperarImagem($this->imagem);
    }

    public function setImagem($imagem)
    {
        
        $this->imagem = ArquivoService::carregarImagem($imagem);
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

    public function getQuadro()
    {
        return $this->quadro;
    }

    public function setQuadro($quadro)
    {
        $this->quadro = $quadro;
        return $this;
    }
}
