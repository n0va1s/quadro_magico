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

    public function findByMarcacaoDia(int $atividade, $dia)
    {
        //Tem alguma marcacao para a atividade x dia
        switch ($dia) {
            case 'seg':
                $marcacao = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\MarcacaoEntity c where c.atividade = :atividade and (c.segunda = :sim or c.segunda = :nao)')
                ->setParameter(':atividade', $atividade)
                ->setParameter(':sim', 'S')
                ->setParameter(':nao', 'N')
                ->getOneOrNullResult();
                break;
            case 'ter':
                $marcacao = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\MarcacaoEntity c where c.atividade = :atividade and (c.terca = :sim or c.terca = :nao)')
                ->setParameter(':atividade', $atividade)
                ->setParameter(':sim', 'S')
                ->setParameter(':nao', 'N')
                ->getOneOrNullResult();
                break;
            case 'qua':
                $marcacao = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\MarcacaoEntity c where c.atividade = :atividade and (c.quarta = :sim or c.quarta = :nao)')
                ->setParameter(':atividade', $atividade)
                ->setParameter(':sim', 'S')
                ->setParameter(':nao', 'N')
                ->getOneOrNullResult();
                break;
            case 'qui':
                $marcacao = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\MarcacaoEntity c where c.atividade = :atividade and (c.quinta = :sim or c.quinta = :nao)')
                ->setParameter(':atividade', $atividade)
                ->setParameter(':sim', 'S')
                ->setParameter(':nao', 'N')
                ->getOneOrNullResult();
                break;
            case 'sex':
                $marcacao = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\MarcacaoEntity c where c.atividade = :atividade and (c.sexta = :sim or c.sexta = :nao)')
                ->setParameter(':atividade', $atividade)
                ->setParameter(':sim', 'S')
                ->setParameter(':nao', 'N')
                ->getOneOrNullResult();
                break;
            case 'sab':
                $marcacao = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\MarcacaoEntity c where c.atividade = :atividade and (c.sabado = :sim or c.sabado = :nao)')
                ->setParameter(':atividade', $atividade)
                ->setParameter(':sim', 'S')
                ->setParameter(':nao', 'N')
                ->getOneOrNullResult();
                break;
            case 'dom':
                $marcacao = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\MarcacaoEntity c where c.atividade = :atividade and (c.domingo = :sim or c.domingo = :nao)')
                ->setParameter(':atividade', $atividade)
                ->setParameter(':sim', 'S')
                ->setParameter(':nao', 'N')
                ->getOneOrNullResult();
                break;
        }
        if ($marcacao) {
            return $marcacao->getId();
        } else {
            return 0;
        }
    }

    public function loadExamples(int $quadro)
    {
        $dados[] = array('atividade'=>'Acordar sozinho e arrumar a cama','valor'=>1,'proposito'=>'A');
        $dados[] = array('atividade'=>'Escovar os dentes, usar fio dental e enxaguante bucal','valor'=>1,'proposito'=>'H');
        $dados[] = array('atividade'=>'Preparar seu café da manhã','valor'=>1,'proposito'=>'A');
        $dados[] = array('atividade'=>'Estudar ou fazer a tarefa','valor'=>1,'proposito'=>'E');
        $dados[] = array('atividade'=>'Ler um livro ou gibi','valor'=>1,'proposito'=>'E');
        $dados[] = array('atividade'=>'Comer ao menos 4 coisas diferentes','valor'=>1,'proposito'=>'R');
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
