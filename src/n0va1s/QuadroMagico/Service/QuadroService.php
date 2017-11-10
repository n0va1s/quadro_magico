<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use n0va1s\QuadroMagico\Entity\QuadroEntity;
use n0va1s\QuadroMagico\Entity\TipoQuadroEntity;

class QuadroService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save($dados)
    {
        //Dados vindo da tela em formato de array para criacao de um novo quadro
        //Quadro original a ser duplicado e um objeto
        $id = is_array($dados) ? $dados['id'] : $dados->getId();
        $tipo = is_array($dados) ? $dados['tipo'] : $dados->getTipo()->getId();
        $responsavel = is_array($dados) ? $dados['email'] : $dados->getResponsavel();
        $genero = is_array($dados) ? $dados['genero'] : $dados->getGenero();
        $idade = is_array($dados) ? $dados['idade'] : $dados->getIdade();
        $crianca = is_array($dados) ? $dados['crianca'] : $dados->getCrianca();
        $recompensa = is_array($dados) ? $dados['recompensa'] : $dados->getRecompensa();
        //Tipo e um objeto, nao somente um atributo de quadro
        $tipo = $this->em->getReference('\n0va1s\QuadroMagico\Entity\TipoQuadroEntity', $tipo);
        if (empty($id)) {
            $quadro = new QuadroEntity();
            $quadro->setResponsavel($responsavel);
            $quadro->setGenero($genero);
            $quadro->setIdade($idade);
            $quadro->setCrianca($crianca);
            $quadro->setRecompensa($recompensa);
            $this->em->persist($quadro);
            $quadro->setTipo($tipo);
        } else {
            $quadro = $this->em->getReference('\n0va1s\QuadroMagico\Entity\QuadroEntity', $id);
            $quadro->setResponsavel($responsavel);
            $quadro->setGenero($genero);
            $quadro->setIdade($idade);
            $quadro->setCrianca($crianca);
            $quadro->setRecompensa($recompensa);
            $quadro->setTipo($tipo);
        }
        $this->em->flush();
        //return $this->toArray($quadro);
        return $quadro;
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
        $quadros = $this->em->createQuery('select q from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.tipo t')
                           ->getArrayResult();
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
        $quadro = $this->em->createQuery('select q from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.tipo t where q.id = :id')
            ->setParameter('id', $id)
            ->getSingleResult();
        return $quadro;
    }

    public function findByCodigo($codigo)
    {
        $quadro = $this->em->createQuery('select q from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.tipo t where q.codigo = :codigo')
            ->setParameter('codigo', $codigo)
            ->getSingleResult();
        return $quadro;
    }

    public function findByEmail($email)
    {
        $quadros = $this->em->createQuery('select q.id, q.responsavel, q.genero, q.idade, q.crianca, q.recompensa, q.codigo, t.descricao as tipo from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.tipo t where q.responsavel = :email order by t.codigo, q.crianca, q.cadastro')
            ->setParameter('email', $email)
            ->getArrayResult();
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
