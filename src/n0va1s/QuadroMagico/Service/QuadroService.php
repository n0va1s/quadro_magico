<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use n0va1s\QuadroMagico\Entity\QuadroEntity;
use n0va1s\QuadroMagico\Entity\UserEntity;

class QuadroService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(array $dados)
    {
        $responsavel = new UserEntity();
        $responsavel->id = 1; //TODO: recuperar da sessao

        if (empty($dados['id'])) {
            $quadro = new QuadroEntity();
            $quadro->setTipo($dados['tipo']);
            $quadro->setGenero($dados['genero']);
            $quadro->setIdade($dados['idade']);
            $quadro->setCrianca($dados['crianca']);
            $quadro->setRecompensa($dados['recompensa']);
            $this->em->persist($quadro);
            $responsavel->add($quadro);
        } else {
            //Nao consulta. Cria apenas uma referencia ao objeto que sera persistido
            $quadro = $this->em->getReference('\n0va1s\QuadroMagico\Entity\QuadroEntity', $dados['id']);
            $quadro->setResponsavel($responsavel);
            $quadro->setTipo($dados['tipo']);
            $quadro->setGenero($dados['genero']);
            $quadro->setIdade($dados['idade']);
            $quadro->setCrianca($dados['crianca']);
            $quadro->setRecompensa($dados['recompensa']);
        }
        $this->em->flush();
        return $this->toArray($quadro);
    }

    public function delete(int $id)
    {
        $quadro = $this->em->getReference('\n0va1s\QuadroMagico\Entity\QuadroEntity', $id);
        $this->em->remove($quadro);
        $this->em->flush();
        return true;
    }

    public function fetchall()
    {
        //Não usei o findAll porque ele retorna um objetivo Entity. Quero um array para transformar em JSON
        $quadros = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\QuadroEntity c')
                           ->getArrayResult();
        if (!isset($quadros)) {
            throw new Exception("Não encontrei quadros");
        }
        return $quadros;
    }

    public function fetchLimit(int $qtd)
    {
        $quadros = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\QuadroEntity c')
                           ->setMaxResults($qtd)
                           ->getArrayResult();
        if (!isset($quadros)) {
            throw new Exception("RNão encontrei quadros");
        }
        return $quadros;
    }

    public function findById(int $id)
    {
        $quadro = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\QuadroEntity c where c.id = :id')
                          ->setParameter('id', $id)
                          ->getArrayResult();
        if (!isset($quadro)) {
            throw new Exception("Não encontrei ese quadro");
        }
        return $quadro;
    }

    public function toArray(QuadroEntity $quadro)
    {
        $responsavel = $quadro->getResponsavel();
        return  array(
            'responsavel' => $responsavel->getUsername(),
            'tipo' => $quadro->getTipo(),
            'genero' => $quadro->getGenero(),
            'idade' => $quadro->getIdade(),
            'crianca' => $quadro->getCrianca(),
            'recompensa' => $quadro->getRecompensa()
        );
    }
}
