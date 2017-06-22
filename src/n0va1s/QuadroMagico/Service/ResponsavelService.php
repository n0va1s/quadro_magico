<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use n0va1s\QuadroMagico\Entity\UserEntity;
use n0va1s\QuadroMagico\Entity\ResponsavelEntity;

class ResponsavelService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(array $dados)
    {
        if (!isset($dados['id'])) {
            $usuario = new UserEntity();
            $usuario->setUsername($dados['email']);
            $usuario->setPassword($dados['senha']);
            $this->em->persist($usuario);
            $responsavel = new ResponsavelEntity();
            $responsavel->setNome($dados['nome']);
            $responsavel->setGenero($dados['genero']);
            $responsavel->setParentesco($dados['parentesco']);
            $responsavel->setUf($dados['uf']);
            $responsavel->setExpectativa($dados['expectativa']);
            $this->em->persist($responsavel);
            $responsavel->setUsuario($usuario);

        } else {
            //Nao consulta. Cria apenas uma referencia ao objeto que sera persistido
            $usuario = $this->em->getReference('\n0va1s\QuadroMagico\Entity\UserEntity', $dados['id']);
            $usuario->setUsername($dados['email']);
            $usuario->setPassword($dados['senha']);
            $responsavel = $this->em->getReference('\n0va1s\QuadroMagico\Entity\ResponsavelEntity', $dados['id']);
            $responsavel->setNome($dados['nome']);
            $responsavel->setGenero($dados['genero']);
            $responsavel->setParentesco($dados['parentesco']);
            $responsavel->setUf($dados['uf']);
            $responsavel->setExpectativa($dados['expectativa']);
        }
        $this->em->flush();
        return $this->toArray($usuario);
    }

    public function delete(int $id)
    {
        $usuario = $this->em->getReference('\n0va1s\QuadroMagico\Entity\UserEntity', $id);
        $this->em->remove($usuario);
        $this->em->flush();
        return true;
    }

    public function fetchall()
    {
        //Não usei o findAll porque ele retorna um objetivo Entity. Quero um array para transformar em JSON
        $clientes = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\ClienteEntity c')
                         ->getArrayResult();
        return $clientes;
    }

    public function fetchLimit(int $qtd)
    {
        $clientes = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\ClienteEntity c')
                   ->setMaxResults($qtd)
                   ->getArrayResult();
        return $clientes;
    }

    public function findById(int $id)
    {
        $cliente = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\ClienteEntity c where c.id = :id')
                   ->setParameter('id', $id)
                   ->getSingleResult(Query::HYDRATE_ARRAY);
        return $cliente;
    }

    public function toArray(ClienteEntity $cliente)
    {
        return  array(
            'id' => $cliente->getId(),
            'nome' => $cliente->getNome() ,
            'email' => $cliente->getEmail(),
            'foto' => $cliente->getFoto(),
            'dataCriacao' => $cliente->getDataCriacao(),
            );
    }
}
