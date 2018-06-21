<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;
use n0va1s\QuadroMagico\Entity\TipoAtividadeEntity;

class TipoAtividadeService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function insert()
    {
        $qb = $this->em->createQueryBuilder();
        $qb->insert('tipo_atividade')
            ->values(
                array('tip_atividade' => 'X',
                'des_tipo_atividade' => 'Descrição da atividade X'),
                array('tip_atividade' => 'Y',
                'des_tipo_atividade' => 'Descrição da atividade Y')
            );
        $qb->getQuery();
        return true;
    }

    public function fetchAll()
    {
        $tipos = $this->em->createQuery(
            'select t 
            from \n0va1s\QuadroMagico\Entity\TipoAtividadeEntity t'
        )->getArrayResult();
        return $tipos;
    }

    public function findById(string $tipo)
    {
        $tipo = $this->em->createQuery(
            'select t 
            from \n0va1s\QuadroMagico\Entity\TipoAtividadeEntity t 
            where t.id = :id'
        )->setParameter('id', $tipo)->getSingleResult();
        return $this->toArray($tipo);
    }

    public function toArray(TipoAtividadeEntity $tipo)
    {
        return  array(
            'id' => $tipo->getId(),
            'tipo' => $tipo->getTipo(),
            'descricao' => $tipo->getDescricao()
        );
    }
}
