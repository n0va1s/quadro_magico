<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use n0va1s\QuadroMagico\Entity\AtividadeEntity;
use n0va1s\QuadroMagico\Entity\MarcacaoEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile as File;

class AtividadeService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(array $dados, File $imagem = null)
    {
        $quadro = $this->em->getReference('\n0va1s\QuadroMagico\Entity\QuadroEntity', $dados['quadro']);
        if (empty($dados['id'])) {
            $atividade = new AtividadeEntity();
            $atividade->setAtividade($dados['atividade']);
            $atividade->setValor($dados['valor']);
            $atividade->setProposito($dados['proposito']);
            if (!empty($imagem)) {
                $atividade->setImagem($imagem);
            }
            $this->em->persist($atividade);
            //Uma atividade pertence a um quadro
            $atividade->setQuadro($quadro);
        } else {
            //Nao consulta. Cria apenas uma referencia ao objeto que sera persistido
            $atividade = $this->em->getReference('\n0va1s\QuadroMagico\Entity\AtividadeEntity', $dados['id']);
            $atividade->setAtividade($dados['atividade']);
            $atividade->setValor($dados['valor']);
            $atividade->setProposito($dados['proposito']);
            if (!empty($imagem)) {
                $atividade->setImagem($imagem);
            }
        }
        $this->em->flush();
        return $this->toArray($atividade);
    }

    public function mark(array $dados)
    {
        //Verifica se ja existe uma marcacao para a atividade e retorna o ID
        $id = $this->findByMarcacao($dados['atividade']);
        if (is_null($id)) { //nao possui marcacao
            $atividade = $this->em->getReference('\n0va1s\QuadroMagico\Entity\AtividadeEntity', $dados['atividade']);
            $marcacao = new MarcacaoEntity();
            switch ($dados['dia']) {
                case 'seg':
                    $marcacao->setSegunda($dados['valor']);
                    break;
                case 'ter':
                    $marcacao->setTerca($dados['valor']);
                    break;
                case 'qua':
                    $marcacao->setQuarta($dados['valor']);
                    break;
                case 'qui':
                    $marcacao->setQuinta($dados['valor']);
                    break;
                case 'sex':
                    $marcacao->setSexta($dados['valor']);
                    break;
                case 'sab':
                    $marcacao->setSabado($dados['valor']);
                    break;
                case 'dom':
                    $marcacao->setDomingo($dados['valor']);
                    break;
            }
            $this->em->persist($marcacao);
            //Uma marcacao pertence a uma atividade
            $marcacao->setAtividade($atividade);
        } else { // possui marcacao
            $marcacao = $this->em->getReference('\n0va1s\QuadroMagico\Entity\MarcacaoEntity', $id);
            switch ($dados['dia']) {
                case 'seg':
                    $marcacao->setSegunda($dados['valor']);
                    break;
                case 'ter':
                    $marcacao->setTerca($dados['valor']);
                    break;
                case 'qua':
                    $marcacao->setQuarta($dados['valor']);
                    break;
                case 'qui':
                    $marcacao->setQuinta($dados['valor']);
                    break;
                case 'sex':
                    $marcacao->setSexta($dados['valor']);
                    break;
                case 'sab':
                    $marcacao->setSabado($dados['valor']);
                    break;
                case 'dom':
                    $marcacao->setDomingo($dados['valor']);
                    break;
            }
        }
        $this->em->flush();
        return true;
    }

    public function delete(int $id)
    {
        $atividade = $this->em->getReference('\n0va1s\QuadroMagico\Entity\AtividadeEntity', $id);
        $this->em->remove($atividade);
        $this->em->flush();
        return true;
    }

    public function findByQuadro(int $id)
    {
        $atividades = $this->em->createQuery('select a, m from \n0va1s\QuadroMagico\Entity\AtividadeEntity a left join a.marcacoes m where a.quadro = :id')
                           ->setParameter('id', $id)
                           ->getArrayResult();
        return $atividades;
    }

    public function findByMarcacao(int $atividade)
    {
        $marcacao = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\MarcacaoEntity c where c.atividade = :id')
                           ->setParameter('id', $atividade)
                           ->getOneOrNullResult();
        if ($marcacao) {
            return $marcacao->getId();
        } else {
            return $marcacao;
        }
    }

    public function loadExamples(int $quadro)
    {
        $dados[] = array('atividade'=>'Acordar sozinho','valor'=>1,'proposito'=>'A');
        $dados[] = array('atividade'=>'Arrumar a cama','valor'=>1,'proposito'=>'A');
        $dados[] = array('atividade'=>'Escovar os dentes','valor'=>1,'proposito'=>'H');
        $dados[] = array('atividade'=>'Preparar seu café da manhã','valor'=>1,'proposito'=>'A');
        $dados[] = array('atividade'=>'Estudar ou fazer a tarefa','valor'=>1,'proposito'=>'E');
        $dados[] = array('atividade'=>'Ler um livro ou gibi','valor'=>1,'proposito'=>'E');
        $dados[] = array('atividade'=>'Comer ao menos 4 tipos de alimentos','valor'=>1,'proposito'=>'R');
        $dados[] = array('atividade'=>'Fazer a oração antes das refeições ou antes de dormir','valor'=>1,'proposito'=>'I');
        $dados[] = array('atividade'=>'Fazer uma tarefa doméstica','valor'=>1,'proposito'=>'D');
        $dados[] = array('atividade'=>'Não brigar, responder ou falar palavrão','valor'=>1,'proposito'=>'C');
        $dados[] = array('atividade'=>'Não deixar suas coisas espalhadas pela casa','valor'=>1,'proposito'=>'A');
        foreach ($dados as $atividade) {
            $atividade['quadro'] = $quadro;
            $this->save($atividade);
        }
        return true;
    }

    public function loadActivities(int $quadroOLD, int $quadroNEW)
    {
        $atividades = $this->findByQuadro($quadroOLD);
        foreach ($atividades as $atividade) {
            //Adicionar o id do novo quadro para ser relacionado a atividade copiada do quadro anterior
            $atividade['quadro'] = $quadroNEW;
            //Remover o id para que entre na inclusao e nao na alteracao
            unset($atividade['id']);
            //Remover informacoes desnecessaria a duplicacao
            unset($atividade['cadastro']);
            unset($atividade['marcacoes']);
            $this->save($atividade);
        }
        return true;
    }

    public function loadSpecialGift(int $quadro)
    {
        $specialGift['segunda'] = false;
        $specialGift['terca'] = false;
        $specialGift['quarta'] = false;
        $specialGift['quinta'] = false;
        $specialGift['sexta'] = false;
        $specialGift['sabado'] = false;
        $specialGift['domingo'] = false;
        try {
            $mark = $this->em->createQuery('select distinct m.segunda from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['segunda'] = true;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

        try {
            $mark = $this->em->createQuery('select distinct m.terca from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['terca'] = true;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

        try {
            $mark = $this->em->createQuery('select distinct m.quarta from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['quarta'] = true;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

        try {
            $mark = $this->em->createQuery('select distinct m.quinta from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['quinta'] = true;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

        try {
            $mark = $this->em->createQuery('select distinct m.sexta from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['sexta'] = true;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

        try {
            $mark = $this->em->createQuery('select distinct m.sabado from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['sabado'] = true;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

        try {
            $mark = $this->em->createQuery('select distinct m.domingo from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['domingo'] = true;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
        return $specialGift;
    }

    public function sumValueDay(int $quadro)
    {
        $arr =  $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.segunda = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $result['segunda'] = $arr['valor'];
        $arr = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.terca = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $result['terca'] = $arr['valor'];
        $arr = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.quarta = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $result['quarta'] = $arr['valor'];
        $arr = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.quinta = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $result['quinta'] = $arr['valor'];
        $arr = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.sexta = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $result['sexta'] = $arr['valor'];
        $arr = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.sabado = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $result['sabado'] = $arr['valor'];
        $arr = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.domingo = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $result['domingo'] = $arr['valor'];
        return $result;
    }

    public function sumPoints(int $quadro)
    {
        $prev =  $this->em->createQuery('select sum(a.valor) as val, count(a.id) as qtd from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
            ->setParameter(':id', $quadro)
            ->getOneOrNullResult();
        $day =  $this->sumValueDay($quadro);
        $real = $day['segunda']+$day['terca']+$day['quarta']+$day['quinta']+$day['sexta']+$day['sabado']+$day['domingo'];
        //70% do Total de pontos das atividades vezes a quantidade de atividade vezes 7 dias
        $total = round((($prev['qtd']*7)*.7));
        return array('real'=>$real, 'prev'=>$total);
    }

    public function sumPocketMoney(int $quadro)
    {
        $day =  $this->sumValueDay($quadro);
        $real = $day['segunda']+$day['terca']+$day['quarta']+$day['quinta']+$day['sexta']+$day['sabado']+$day['domingo'];
        return $real;
    }

    public function toArray(AtividadeEntity $atividade)
    {
        return  array(
            'id' => $atividade->getId(),
            'atividade' => $atividade->getAtividade(),
            'valor' => $atividade->getValor(),
            'proposito' => $atividade->getProposito(),
            'imagem' => $atividade->getImagem()
        );
    }
}
