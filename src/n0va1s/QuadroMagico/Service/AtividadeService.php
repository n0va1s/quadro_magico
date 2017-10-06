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
    private $semana;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->semana = ["segunda", "terca", "quarta", "quinta", "sexta", "sabado", "domingo"];
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
    /**
     * @param int atividade //seq_atividade
     * @param char(3) dia //seg, ter,qua,qui,sex,sab,dom
     * @param char(1) valor //S ou N ou nulo
     *
     * @return true
     */
    public function mark(array $dados)
    {
        //Verifica se ja existe uma marcacao para a atividade e retorna o ID
        $id = $this->findByMarcacao($dados['atividade']);
        //Para setar o valor NULL no banco quando uma celular for desmarcada.
        //Estava setando branco
        $dados['valor'] = (empty($dados['valor'])) ? null : $dados['valor'];
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

    /**
     * @param int atividade //seq_atividade
     * @param datetime data //data do evento
     * @param float valor //10,7.5,5,2.5
     * @param text positivo //feedback positivo sobre o dia da crianca
     * @param text negativo //feedback negativo sobre o dia da crianca
     *
     * @return true
     */
    public function saveEvent(array $dados)
    {
        //Verifica se ja existe um evento para a atividade e retorna o ID
        $id = $this->findByEvento($dados['evento']);
        //Para setar o valor NULL no banco quando uma celular for desmarcada.
        //Estava setando branco
        $dados['valor'] = (empty($dados['valor'])) ? null : $dados['valor'];
        if (is_null($id)) { //nao possui marcacao
            $atividade = $this->em->getReference('\n0va1s\QuadroMagico\Entity\AtividadeEntity', $dados['atividade']);
            $evento = new EventoEntity();
            $evento->setData($dados['data']);
            $evento->setValor($dados['valor']);
            $evento->setPositivo($dados['positivo']);
            $evento->setNegativo($dados['negativo']);
            $this->em->persist($evento);
            //Uma marcacao pertence a uma atividade
            $evento->setAtividade($atividade);
        } else { // possui marcacao
            $evento = $this->em->getReference('\n0va1s\QuadroMagico\Entity\EventoEntity', $id);
            $evento->setData($dados['data']);
            $evento->setValor($dados['valor']);
            $evento->setPositivo($dados['positivo']);
            $evento->setNegativo($dados['negativo']);
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
        $dados[] = array('atividade'=>'Arrumar a cama','valor'=>1,'proposito'=>'A');
        $dados[] = array('atividade'=>'Preparar seu café da manhã','valor'=>1,'proposito'=>'A');
        $dados[] = array('atividade'=>'Estudar ou fazer a tarefa','valor'=>1,'proposito'=>'E');
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
        foreach ($this->semana as $dia) {
            try {
                $mark = $this->em->createQuery("select distinct m.$dia from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id")
                    ->setParameter(':id', $quadro)
                    ->getOneOrNullResult();
                $specialGift[$dia] = ($mark[$dia] == 1) ? true : false;
            } catch (\Doctrine\ORM\NonUniqueResultException $e) {
                $specialGift[$dia] = false;
            }
        }
        return $specialGift;
    }

    public function sumValueDay(int $quadro)
    {
        foreach ($this->semana as $dia) {
            $arr[$dia] =  $this->em->createQuery("select sum(a.valor) as valor from n0va1s\QuadroMagico\Entity\QuadroEntity q 
                join q.atividades a join a.marcacoes m where q.id = :id and m.$dia = :sim")
                ->setParameter(':id', $quadro)
                ->setParameter(':sim', '1')
                ->getSingleResult();
        }
        return $result;
    }

    public function sumPoints(int $quadro)
    {
        $prev =  $this->em->createQuery('select sum(a.valor) as val, count(a.id) as qtd from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
            ->setParameter(':id', $quadro)
            ->getOneOrNullResult();
        $prev['val'] = is_null($prev['val']) ? 0 : $prev['val'];
        $day =  $this->sumValueDay($quadro);
        $real = $day['segunda']+$day['terca']+$day['quarta']+$day['quinta']+$day['sexta']+$day['sabado']+$day['domingo'];
        //70% do Total de pontos das atividades vezes a quantidade de atividade vezes 7 dias
        $total = round((($prev['val']*7)*.7));
        //Trata para nao haver divisao por zero
        $perc = $prev['val'] > 0 ? round(($real/($prev['val']*7))*100) : 0;
        return array('real'=>$real, 'prev'=>$total, 'perc'=>$perc);
    }

    public function sumPocketMoney(int $quadro)
    {
        $day =  $this->sumValueDay($quadro);
        $real = $day['segunda']+$day['terca']+$day['quarta']+$day['quinta']+$day['sexta']+$day['sabado']+$day['domingo'];
        return $real;
    }

    public function sumResult(int $quadro)
    {
        $peso = $this->em->createQuery('select sum(a.valor) as peso from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a where q.id = :id')
            ->setParameter(':id', $quadro)
            ->getResult(Query::HYDRATE_SINGLE_SCALAR);
        foreach ($this->semana as $dia) {
            $nota = $this->em->createQuery("select sum(a.valor * m.$dia) as nota from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id group by q.id")
                ->setParameter(':id', $quadro)
                ->getResult(Query::HYDRATE_SINGLE_SCALAR);
            $quali = ["Péssimo", "Ruim", "Bom", "Ótimo"];
            $arr[$dia] = "Não sei";
            $med = round($nota/$peso);
            if ($med) {
                $arr[$dia] = $quali[$med-1];
            }
        }
        return $arr;
    }

    public function mountBoard(int $quadro)
    {
        if ($quadro['tipo'] == 'F') {
            foreach ($this->semana as $dia) {
                $dados[$dia] = $this->em->createQuery("select a.id, m.$dia as valor, case m.$dia when 1 then 'pessimo' when 2 then 'ruim' when 3 then 'bom' when 4 then 'otimo' else 'duvida' end as emoji from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m 
                    where q.id = :id")
                    ->setParameter(':id', $quadro)
                    ->getResult(Query::HYDRATE_SCALAR);
            }
        } else {
            foreach ($this->semana as $dia) {
                $dados[$dia] = $this->em->createQuery("select a.id, m.$dia as valor, case m.$dia when 1 then 'pessimo' when 2 then 'otimo' else 'duvida' end as emoji from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id")
                    ->setParameter(':id', $quadro)
                    ->getResult(Query::HYDRATE_SCALAR);
            }
        }
        return $dados;
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
