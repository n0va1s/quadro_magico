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
        try {
            $mark = $this->em->createQuery('select distinct m.segunda from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['segunda'] = ($mark['segunda'] == 'S') ? true : false;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            $specialGift['segunda'] = false;
        }

        try {
            $mark = $this->em->createQuery('select distinct m.terca from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['terca'] = ($mark['terca'] == 'S') ? true : false;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            $specialGift['terca'] = false;
        }

        try {
            $mark = $this->em->createQuery('select distinct m.quarta from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['quarta'] = ($mark['quarta'] == 'S') ? true : false;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            $specialGift['quarta'] = false;
        }

        try {
            $mark = $this->em->createQuery('select distinct m.quinta from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['quinta'] = ($mark['quinta'] == 'S') ? true : false;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            $specialGift['quinta'] = false;
        }

        try {
            $mark = $this->em->createQuery('select distinct m.sexta from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['sexta'] = ($mark['sexta'] == 'S') ? true : false;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            $specialGift['sexta'] = false;
        }

        try {
            $mark = $this->em->createQuery('select distinct m.sabado from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['sabado'] = ($mark['sabado'] == 'S') ? true : false;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            $specialGift['sabado'] = false;
        }

        try {
            $mark = $this->em->createQuery('select distinct m.domingo from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id')
                ->setParameter(':id', $quadro)
                ->getOneOrNullResult();
            $specialGift['domingo'] = ($mark['domingo'] == 'S') ? true : false;
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            $specialGift['domingo'] = false;
            //echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
        return $specialGift;
    }

    public function sumValueDay(int $quadro)
    {
        $arr['segunda'] =  $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.segunda = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $arr['terca'] = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.terca = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $arr['quarta'] = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.quarta = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $arr['quinta'] = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.quinta = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $arr['sexta'] = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.sexta = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $arr['sabado'] = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.sabado = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
        $arr['domingo'] = $this->em->createQuery('select sum(a.valor) as valor from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id and m.domingo = :sim')
            ->setParameter(':id', $quadro)
            ->setParameter(':sim', 'S')
            ->getSingleResult();
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
        $arr['segunda'] = $this->em->createQuery('select sum(a.valor * m.segunda) as nota from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id group by q.id')
            ->setParameter(':id', $quadro)
            ->getSingleResult();
        $arr['terca'] = $this->em->createQuery('select sum(a.valor * m.terca) as nota from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id group by q.id')
            ->setParameter(':id', $quadro)
            ->getSingleResult();
        $arr['quarta'] = $this->em->createQuery('select sum(a.valor * m.quarta) as nota from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id group by q.id')
            ->setParameter(':id', $quadro)
            ->getSingleResult();
        $arr['quinta'] = $this->em->createQuery('select sum(a.valor * m.quinta) as nota from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id group by q.id')
            ->setParameter(':id', $quadro)
            ->getSingleResult();
        $arr['sexta'] = $this->em->createQuery('select sum(a.valor * m.sexta) as nota from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id group by q.id')
            ->setParameter(':id', $quadro)
            ->getSingleResult();
        $arr['sabado'] = $this->em->createQuery('select sum(a.valor * m.sabado) as nota from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id group by q.id')
            ->setParameter(':id', $quadro)
            ->getSingleResult();
        $arr['domingo'] = $this->em->createQuery('select sum(a.valor * m.domingo) as nota from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id group by q.id')
            ->setParameter(':id', $quadro)
            ->getSingleResult();
        $arr['atividades'] = $this->em->createQuery('select sum(a.valor) as peso from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a where q.id = :id')
            ->setParameter(':id', $quadro)
            ->getSingleResult();
        return $arr;
    }

    public function getResult(int $quadro)
    {
        $result =  $this->sumResult($quadro);
        switch (round($result['segunda']['nota'] / $result['atividades']['peso'])) {
            case "1":
                $arr['segunda'] = "Péssimo";
                break;
            case "2":
                $arr['segunda'] = "Ruim";
                break;
            case "3":
                $arr['segunda'] = "Bom";
                break;
            case "4":
                $arr['segunda'] = "Ótimo";
                break;
            default:
                $arr['segunda'] = "Não sei";
        }
        switch (round($result['terca']['nota'] / $result['atividades']['peso'])) {
            case "1":
                $arr['terca'] = "Péssimo";
                break;
            case "2":
                $arr['terca'] = "Ruim";
                break;
            case "3":
                $arr['terca'] = "Bom";
                break;
            case "4":
                $arr['terca'] = "Ótimo";
                break;
            default:
                $arr['terca'] = "Não sei";
        }
        switch (round($result['quarta']['nota'] / $result['atividades']['peso'])) {
            case "1":
                $arr['quarta'] = "Péssimo";
                break;
            case "2":
                $arr['quarta'] = "Ruim";
                break;
            case "3":
                $arr['quarta'] = "Bom";
                break;
            case "4":
                $arr['quarta'] = "Ótimo";
                break;
            default:
                $arr['quarta'] = "Não sei";
        }
        switch (round($result['quinta']['nota'] / $result['atividades']['peso'])) {
            case "1":
                $arr['quinta'] = "Péssimo";
                break;
            case "2":
                $arr['quinta'] = "Ruim";
                break;
            case "3":
                $arr['quinta'] = "Bom";
                break;
            case "4":
                $arr['quinta'] = "Ótimo";
                break;
            default:
                $arr['quinta'] = "Não sei";
        }
        switch (round($result['sexta']['nota'] / $result['atividades']['peso'])) {
            case "1":
                $arr['sexta'] = "Péssimo";
                break;
            case "2":
                $arr['sexta'] = "Ruim";
                break;
            case "3":
                $arr['sexta'] = "Bom";
                break;
            case "4":
                $arr['sexta'] = "Ótimo";
                break;
            default:
                $arr['sexta'] = "Não sei";
        }
        switch (round($result['sabado']['nota'] / $result['atividades']['peso'])) {
            case "1":
                $arr['sabado'] = "Péssimo";
                break;
            case "2":
                $arr['sabado'] = "Ruim";
                break;
            case "3":
                $arr['sabado'] = "Bom";
                break;
            case "4":
                $arr['sabado'] = "Ótimo";
                break;
            default:
                $arr['sabado'] = "Não sei";
        }
        switch (round($result['domingo']['nota'] / $result['atividades']['peso'])) {
            case "1":
                $arr['domingo'] = "Péssimo";
                break;
            case "2":
                $arr['domingo'] = "Ruim";
                break;
            case "3":
                $arr['domingo'] = "Bom";
                break;
            case "4":
                $arr['domingo'] = "Ótimo";
                break;
            default:
                $arr['domingo'] = "Não sei";
        }
        return $arr;
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
