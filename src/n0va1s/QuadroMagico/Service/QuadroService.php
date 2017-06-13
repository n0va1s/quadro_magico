<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;
use n0va1s\QuadroMagico\Entity\QuadroEntity;
use Doctrine\ORM\Tools\Pagination\Paginator;

class QuadroService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(array $dados)
    {
        if (!isset($dados['seqCategoria'])) {
            $categoria = new CategoriaEntity();
            $categoria->setDescricao($dados['nomCategoria']);
            $this->em->persist($categoria);
        } else {
            //Nao consulta. Cria apenas uma referencia ao objeto que sera persistido
            $categoria = $this->em->getReference('\n0va1s\QuadroMagico\Entity\CategoriaEntity', $dados['seqCategoria']);
            $categoria->setDescricao($dados['nomCategoria']);
        }
        $this->em->flush();
        return $this->toArray($categoria);
    }

    public function delete(int $id)
    {
        $categoria = $this->em->getReference('\n0va1s\QuadroMagico\Entity\CategoriaEntity', $id);
        $this->em->remove($categoria);
        $this->em->flush();
        return true;
    }

    public function fetchall()
    {
        //Não usei o findAll porque ele retorna um objetivo Entity. Quero um array para transformar em JSON
        $categorias = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\CategoriaEntity c')
                           ->getArrayResult();
        if (!isset($categorias)) {
            throw new Exception("Registro não encontrado");
        }
        return $categorias;
    }

    public function fetchLimit(int $qtd)
    {
        $categorias = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\CategoriaEntity c')
                           ->setMaxResults($qtd)
                           ->getArrayResult();
        if (!isset($categorias)) {
            throw new Exception("Registro não encontrado");
        }
        return $categorias;
    }

    public function findById(int $id)
    {
        $categoria = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\CategoriaEntity c where c.id = :id')
                          ->setParameter('id', $id)
                          ->getArrayResult();
        if (!isset($categoria)) {
            throw new Exception("Registro não encontrado");
        }
        return $categoria;
    }

    public function toArray(CategoriaEntity $categoria)
    {
        return  array(
            'id' => $categoria->getId(),
            'descricao' => $categoria->getDescricao() ,
            );
    }
}
