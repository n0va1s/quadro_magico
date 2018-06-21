<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;

class BotService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function boasVindas()
    {
        $msg = array ('messages' => 
            array (
              0 => array ('text' => 'Oi! Eu sou Fifu',),
              1 => array ('text' => 'Tudo bem?',),
            ),
        );
        return $msg;
    }

    public function sugerirAtividade()
    {
        $atividades = $this->em->createQuery(
            'select t 
            from \n0va1s\QuadroMagico\Entity\TipoAtividadeEntity t'
        )->getArrayResult();
        
        $msg = array ('messages' => 
            array (
              0 => array ('text' => 'Essas são algumas dicas de 
              atividade para o seu quadro',),
            ),
        );
        foreach ($atividades as $id => $descricao) {
            $msg[] = array ('messages' => 
                array (
                $id => array ('text' => $descricao,),
                ),
            );   
        }
        return $msg;
    }
}
