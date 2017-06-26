<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use n0va1s\QuadroMagico\Entity\AtividadeEntity;

class AtividadeService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(array $dados)
    {
        if (empty($dados['id'])) {
            $atividade = new AtividadeEntity();
            $atividade->setAtividade($dados['atividade']);
            $atividade->setValor($dados['valor']);
            $atividade->setProposito($dados['proposito']);
            $this->em->persist($atividade);
            $quadro->add($atividade);
        } else {
            //Nao consulta. Cria apenas uma referencia ao objeto que sera persistido
            $atividade = $this->em->getReference('\n0va1s\QuadroMagico\Entity\AtividadeEntity', $dados['id']);
            $atividade->setAtividade($dados['atividade']);
            $atividade->setValor($dados['valor']);
            $atividade->setProposito($dados['proposito']);
        }
        $this->em->flush();
        return $this->toArray($atividade);
    }

    public function delete(int $id)
    {
        $atividade = $this->em->getReference('\n0va1s\QuadroMagico\Entity\AtividadeEntity', $id);
        $this->em->remove($atividade);
        $this->em->flush();
        return true;
    }

    public function fetchAll()
    {
        //Não usei o findAll porque ele retorna um objetivo Entity. Quero um array para transformar em JSON
        $atividades = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\AtividadeEntity c')
                           ->getArrayResult();
        if (!isset($atividades)) {
            throw new Exception("Não encontrei quadros");
        }
        return $atividades;
    }

    public function fetchLimit(int $qtd)
    {
        $atividades = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\AtividadeEntity c')
                   ->setMaxResults($qtd)
                   ->getArrayResult();
        return $atividades;
    }

    public function findById(int $id)
    {
        $atividade = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\AtividadeEntity c where c.id = :id')
                          ->setParameter('id', $id)
                          ->getArrayResult();
        if (!isset($atividade)) {
            throw new Exception("Não encontrei ese quadro");
        }
        return $atividade;
    }

    public function toArray(AtividadeEntity $atividade)
    {
        return  array(
            'id' => $atividade->getId(),
            'atividade' => $atividade->getAtividade(),
            'valor' => $atividade->getValor(),
            'proposito' => $atividade->getProposito()
        );
    }
}
