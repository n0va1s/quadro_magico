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

    public function save(array $dados)
    {
        $tipo = is_object($dados['tipo']) ?  $dados['tipo']->getId() : $dados['tipo'];
        //Tipo e um objeto, nao somente um atributo de quadro
        $tipo = $this->em->getReference('\n0va1s\QuadroMagico\Entity\TipoQuadroEntity', $tipo);
        if (empty($dados['id'])) {
            //Nao consulta. Cria apenas uma referencia ao objeto que sera persistido
            $quadro = new QuadroEntity();
            $quadro->setResponsavel($dados['email']);
            $quadro->setGenero($dados['genero']);
            $quadro->setIdade($dados['idade']);
            $quadro->setCrianca($dados['crianca']);
            $quadro->setRecompensa($dados['recompensa']);
            $this->em->persist($quadro);
            $quadro->setTipo($tipo);
        } else {
            $quadro = $this->em->getReference('\n0va1s\QuadroMagico\Entity\QuadroEntity', $dados['id']);
            $quadro->setResponsavel($dados['email']);
            $quadro->setGenero($dados['genero']);
            $quadro->setIdade($dados['idade']);
            $quadro->setCrianca($dados['crianca']);
            $quadro->setRecompensa($dados['recompensa']);
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
        $quadros = $this->em->createQuery('select q.id, q.responsavel, q.genero, q.idade, q.crianca, q.recompensa, q.codigo, t.descricao as tipo from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.tipo t where q.responsavel = :email')
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
