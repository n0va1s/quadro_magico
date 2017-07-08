<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use n0va1s\QuadroMagico\Entity\QuadroEntity;

//use n0va1s\QuadroMagico\Entity\UserEntity;

class QuadroService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(array $dados)
    {
        if (empty($dados['id'])) {
            $quadro = new QuadroEntity();
            $quadro->setResponsavel($dados['email']);
            $quadro->setTipo($dados['tipo']);
            $quadro->setGenero($dados['genero']);
            $quadro->setIdade($dados['idade']);
            $quadro->setCrianca($dados['crianca']);
            $quadro->setRecompensa($dados['recompensa']);
            $this->em->persist($quadro);
        } else {
            //Nao consulta. Cria apenas uma referencia ao objeto que sera persistido
            $quadro = $this->em->getReference('\n0va1s\QuadroMagico\Entity\QuadroEntity', $dados['id']);
            $quadro->setResponsavel($dados['email']);
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

    public function fetchAll()
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
        return $quadros;
    }

    public function findById(int $id)
    {
        $quadro = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\QuadroEntity c where c.id = :id')
                          ->setParameter('id', $id)
                          ->getSingleResult();
        if (count($quadro) == 0) {
            $quadro = ['mensagem'=>'Nenhum quadro cadastrado com este identificador'];
        }
        return $this->toArray($quadro);
    }

    public function findByCodigo($codigo)
    {
        $quadro = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\QuadroEntity c where c.codigo = :codigo')
                          ->setParameter('codigo', $codigo)
                          ->getSingleResult();
        if (count($quadro) == 0) {
            $quadro = ['mensagem'=>'Nenhum quadro cadastrado com este identificador'];
        }
        return $this->toArray($quadro);
    }

    public function findByEmail($email)
    {
        $quadros = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\QuadroEntity c where c.responsavel = :email')
                          ->setParameter('email', $email)
                          ->getArrayResult();
        if (count($quadros) == 0) {
            $quadros = ['mensagem'=>'Nenhum quadro cadastrado com este email'];
        }
        return $quadros;
    }

    public function toArray(QuadroEntity $quadro)
    {
        return  array(
            'id' => $quadro->getId(),
            'email' => $quadro->getResponsavel(),
            'tipo' => $quadro->getTipo(),
            'genero' => $quadro->getGenero(),
            'idade' => $quadro->getIdade(),
            'crianca' => $quadro->getCrianca(),
            'recompensa' => $quadro->getRecompensa(),
            'codigo' => $quadro->getCodigo()
        );
    }
}
