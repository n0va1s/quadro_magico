<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;

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
               array('val_tipo_quadro' => 'C','des_tipo_quadro' => 'Comportamento'),
               array('val_tipo_quadro' => 'F','des_tipo_quadro' => 'Férias'),
               array('val_tipo_quadro' => 'M','des_tipo_quadro' => 'Mesada')
           );
        $qb->getQuery();
        return true;
    }

    public function listTipoQuadro()
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('t')->from('tipo_quadro', 't')->orderBy('t.des_tipo_quadro', 'ASC');
        return $qb->getQuery()->getArrayResult();
    }

    public function findDescricaoByTipoQuadro(string $tipo)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('t.des_tipo_quadro')
           ->from('tipo_quadro', 't')
           ->where('t.val_tipo_quadro = ?1')
           ->setParameter(1, $tipo);
        return $qb->getQuery()->getArrayResult();
    }
}
