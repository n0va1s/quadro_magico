<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;
use n0va1s\QuadroMagico\Entity\TipoQuadroEntity;

class DominioService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    /*
    * CREATE TABLE tipo_quadro  (seq_tipo_quadro INT AUTO_INCREMENT NOT NULL, 
    * val_tipo_quadro VARCHAR(1), des_tipo_quadro VARCHAR(50),
    * PRIMARY KEY(seq_tipo_quadro)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
    */
    public function insertTipoQuadro()
    {
        $qb = $this->em->createQueryBuilder();
        $qb->insert('tipo_quadro')
           ->values(
               array('val_tipo_quadro' => 'T','des_tipo_quadro' => 'Tarefa'),
               array('val_tipo_quadro' => 'F','des_tipo_quadro' => 'Férias'),
               array('val_tipo_quadro' => 'M','des_tipo_quadro' => 'Mesada')
           );
        $qb->getQuery();
        return true;
    }

    public function fetchAll()
    {
        $tipos = $this->em->createQuery('select t from \n0va1s\QuadroMagico\Entity\TipoQuadroEntity t')->getArrayResult();
        return $tipos;
    }

    public function findById(string $tipo)
    {
        $tipo = $this->em->createQuery('select t from \n0va1s\QuadroMagico\Entity\TipoQuadroEntity t where t.id = :id')->setParameter('id', $tipo)->getSingleResult();
        return $this->toArray($tipo);
    }

    public function toArray(TipoQuadroEntity $tipo)
    {
        return  array(
            'id' => $tipo->getId(),
            'codigo' => $tipo->getCodigo(),
            'descricao' => $tipo->getDescricao()
        );
    }
}
