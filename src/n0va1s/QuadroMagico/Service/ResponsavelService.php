<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use n0va1s\QuadroMagico\Entity\UserEntity;
use n0va1s\QuadroMagico\Entity\PerfilEntity;

class ResponsavelService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(array $dados)
    {
        if (empty($dados['id'])) {
            $usuario = new UserEntity();
            $usuario->setUsername($dados['email']);
            $usuario->setPassword($dados['senha']);
            $this->em->persist($usuario);
            $perfil = new PerfilEntity();
            $perfil->setNome($dados['nome']);
            $perfil->setGenero($dados['genero']);
            $perfil->setParentesco($dados['parentesco']);
            $perfil->setUf($dados['uf']);
            $perfil->setExpectativa($dados['expectativa']);
            $this->em->persist($perfil);
            //Associa o perfil ao usuario
            $usuario->setProfile($perfil);
            
        } else {
            //Nao consulta. Cria apenas uma referencia ao objeto que sera persistido
            $usuario = $this->em->getReference('\n0va1s\QuadroMagico\Entity\UserEntity', $dados['id']);
            $usuario->setUsername($dados['email']);
            $usuario->setPassword($dados['senha']);
            $responsavel = $this->em->getReference('\n0va1s\QuadroMagico\Entity\PerfilEntity', $dados['id']);
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
        $perfil = $this->em->getReference('\n0va1s\QuadroMagico\Entity\PerfilEntity', $id);
        $this->em->remove($perfil);
        $usuario = $this->em->getReference('\n0va1s\QuadroMagico\Entity\UserEntity', $id);
        $this->em->remove($usuario);
        $this->em->flush();
        return true;
    }

    public function fetchall()
    {
        //Não usei o findAll porque ele retorna um objetivo Entity. Quero um array para transformar em JSON
        $usuarios = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\UserEntity c')
                         ->getArrayResult();
        return $usuarios;
    }

    public function fetchLimit(int $qtd)
    {
        $usuarios = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\UserEntity c')
                   ->setMaxResults($qtd)
                   ->getArrayResult();
        return $usuarios;
    }

    public function findById(int $id)
    {
        $usuario = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\UserEntity c where c.id = :id')
                   ->setParameter('id', $id)
                   ->getSingleResult(Query::HYDRATE_ARRAY);
        return $usuario;
    }

    public function toArray(UserEntity $usuario)
    {
        $perfil = $usuario->getProfile();
        return  array(
            'email' => $usuario->getUsername() ,
            'nome' => $perfil->getNome(),
            'genero' => $perfil->getGenero(),
            'parentesco' => $perfil->getParentesco(),
            'uf'  => $perfil->getUf(),
            'expectativa' => $perfil->getExpectativa(),
            'criacao' => $usuario->getCreateAt(),
            );
    }
}
