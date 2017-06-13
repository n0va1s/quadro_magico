<?php

namespace n0va1s\QuadroMagico\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile as File;
use n0va1s\QuadroMagico\Service\AtividadeService;

/**
 * @ORM\Entity
 * @ORM\hasLifeCycleCallbacks
 * @ORM\Table(name="Cliente")
 */
class AtividadeEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="seq_cliente")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\Column(type="string", name="nom_cliente", length=100)
     */
    private $nome;
    /**
     * @ORM\Column(type="string", name="eml_cliente", length=100)
     */
    private $email;
    /**
     * @ORM\Column(type="string", name="url_foto", length=255)
     */
    private $foto;
    /**
     * @ORM\Column(type="datetime", name="dat_cadastro", nullable=true)
     */
    private $dataCriacao;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        if (!isset($nome)) {
            throw new \InvalidArgumentException();
        }
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $emailValido = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$emailValido) {
            throw new \InvalidArgumentException();
        }
        $this->email = $email;
    }

    public function getFoto()
    {
        return $this->foto;
    }
    
    public function setFoto($foto)
    {
        if (!($foto instanceof Symfony\Component\HttpFoundation\File\UploadedFile)) {
            throw new \InvalidArgumentException();
        }
        $this->foto = ArquivoService::carregarImagem($foto);
    }

    /** @ORM\PrePersist */
    public function setDataCriacao()
    {
        $this->dataCriacao = new \DateTime();
    }

    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }
}
