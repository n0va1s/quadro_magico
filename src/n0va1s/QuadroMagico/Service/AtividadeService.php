<?php

namespace n0va1s\QuadroMagico\Service;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use n0va1s\QuadroMagico\Entity\AtividadeEntity;
use n0va1s\QuadroMagico\Entity\MarcacaoEntity;
use n0va1s\QuadroMagico\Entity\TipoQuadroEntity;
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
        $temMarcacao = $this->hasMarcacao($dados['atividade']);
        //Para setar o valor NULL no banco quando uma celular for desmarcada.
        //Estava setando branco
        $dados['valor'] = (empty($dados['valor'])) ? null : $dados['valor'];
        if (!$temMarcacao) { //nao possui marcacao
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
            $marcacao = $this->em->getReference('\n0va1s\QuadroMagico\Entity\MarcacaoEntity', $temMarcacao->getId());
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

    public function delete($quadro)
    {
        $excluiu = ArquivoService::apagarImagem($quadro->getAtividades()[0]->getImagem());
        if ($excluiu) {
            $this->em->remove($quadro->getAtividades()[0]);
            $this->em->flush();
            //Lista de atividades atualizada
            return $this->findByQuadro($quadro);
        } else {
            return false;
        }
    }

    public function findByQuadro($quadro)
    {
        if ($quadro->getTipo()->getCodigo() == 'F') {
            $dados = $this->em->createQuery("select a.id, a.imagem, a.atividade, a.valor, a.proposito,
                m.segunda as mark_segunda, case m.segunda when 1 then 'pessimo' when 2 then 'ruim' when 3 then 'bom' when 4 then 'otimo' else 'duvida' end as emoji_segunda,
                m.terca as mark_terca, case m.terca when 1 then 'pessimo' when 2 then 'ruim' when 3 then 'bom' when 4 then 'otimo' else 'duvida' end as emoji_terca, 
                m.quarta as mark_quarta, case m.quarta when 1 then 'pessimo' when 2 then 'ruim' when 3 then 'bom' when 4 then 'otimo' else 'duvida' end as emoji_quarta,
                m.quinta as mark_quinta, case m.quinta when 1 then 'pessimo' when 2 then 'ruim' when 3 then 'bom' when 4 then 'otimo' else 'duvida' end as emoji_quinta,
                m.sexta as mark_sexta, case m.sexta when 1 then 'pessimo' when 2 then 'ruim' when 3 then 'bom' when 4 then 'otimo' else 'duvida' end as emoji_sexta,
                m.sabado as mark_sabado, case m.sabado when 1 then 'pessimo' when 2 then 'ruim' when 3 then 'bom' when 4 then 'otimo' else 'duvida' end as emoji_sabado,
                m.domingo as mark_domingo, case m.domingo when 1 then 'pessimo' when 2 then 'ruim' when 3 then 'bom' when 4 then 'otimo' else 'duvida' end as emoji_domingo
                from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a left join a.marcacoes m 
                where q.id = :id")
                ->setParameter(':id', $quadro->getId())
                ->getArrayResult();
        } else {
            $dados = $this->em->createQuery("select a.id, a.imagem, a.atividade, a.valor, a.proposito,
                m.segunda as mark_segunda, case m.segunda when 1 then 'pessimo' when 2 then 'otimo' else 'duvida' end as emoji_segunda,
                m.terca as mark_terca, case m.terca when 1 then 'pessimo' when 2 then 'otimo' else 'duvida' end as emoji_terca,
                m.quarta as mark_quarta, case m.quarta when 1 then 'pessimo' when 2 then 'otimo' else 'duvida' end as emoji_quarta,
                m.quinta as mark_quinta, case m.quinta when 1 then 'pessimo' when 2 then 'otimo' else 'duvida' end as emoji_quinta,
                m.sexta as mark_sexta, case m.sexta when 1 then 'pessimo' when 2 then 'otimo' else 'duvida' end as emoji_sexta,
                m.sabado as mark_sabado, case m.sabado when 1 then 'pessimo' when 2 then 'otimo' else 'duvida' end as emoji_sabado,
                m.domingo as mark_domingo, case m.domingo when 1 then 'pessimo' when 2 then 'otimo' else 'duvida' end as emoji_domingo
                from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a left join a.marcacoes m where q.id = :id")
                ->setParameter(':id', $quadro->getId())
                ->getArrayResult();
        }
        return $dados;
    }

    public function findById(int $id)
    {
        $dados = $this->em->createQuery('select q, a, m from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a left join a.marcacoes m where a.id = :id')
            ->setParameter('id', $id)
            ->getOneOrNullResult();
        return $dados;
    }

    public function hasMarcacao(int $id)
    {
        $marcacao = $this->em->createQuery('select c from \n0va1s\QuadroMagico\Entity\MarcacaoEntity c where c.atividade = :id')
            ->setParameter('id', $id)
            ->getOneOrNullResult();
        return $marcacao;
    }
    //Cria um array com exemplos de atividades durante a criacao do quadro
    public function loadExamples($quadro)
    {
        if ($quadro->getTipo()->getCodigo() == 'T') {
            $dados[] = array('atividade'=>'Arrumar a cama','valor'=>1,'proposito'=>'A');
            $dados[] = array('atividade'=>'Preparar seu café da manhã','valor'=>1,'proposito'=>'A');
            $dados[] = array('atividade'=>'Estudar ou fazer a tarefa','valor'=>1,'proposito'=>'E');
            $dados[] = array('atividade'=>'Comer ao menos 4 tipos de alimentos','valor'=>1,'proposito'=>'R');
            $dados[] = array('atividade'=>'Fazer a oração antes das refeições ou antes de dormir','valor'=>1,'proposito'=>'I');
            $dados[] = array('atividade'=>'Fazer uma tarefa doméstica','valor'=>1,'proposito'=>'D');
            $dados[] = array('atividade'=>'Não brigar, responder ou falar palavrão','valor'=>1,'proposito'=>'C');
            $dados[] = array('atividade'=>'Não deixar suas coisas espalhadas pela casa','valor'=>1,'proposito'=>'A');
        } elseif ($quadro->getTipo()->getCodigo() == 'M') {
            $dados[] = array('atividade'=>'Arrumar a cama','valor'=>0.5,'proposito'=>'A');
            $dados[] = array('atividade'=>'Fazer a tarefa','valor'=>0.5,'proposito'=>'E');
            $dados[] = array('atividade'=>'Lavar a louça','valor'=>0.5,'proposito'=>'D');
            $dados[] = array('atividade'=>'Comer ao menos 4 tipos de alimentos','valor'=>1.5,'proposito'=>'R');
            $dados[] = array('atividade'=>'Cortar a grama','valor'=>0.5,'proposito'=>'D');
            $dados[] = array('atividade'=>'Varrer a casa','valor'=>1,'proposito'=>'D');
            $dados[] = array('atividade'=>'Cuidar do bicho de estimação','valor'=>0.5,'proposito'=>'I');

        } elseif ($quadro->getTipo()->getCodigo() == 'F') {
            $dados[] = array('atividade'=>'Refeição','valor'=>3,'proposito'=>'R');
            $dados[] = array('atividade'=>'Comportamento','valor'=>3,'proposito'=>'C');
            $dados[] = array('atividade'=>'Higiene','valor'=>1,'proposito'=>'H');
            $dados[] = array('atividade'=>'Obrigações','valor'=>2,'proposito'=>'A');
            $dados[] = array('atividade'=>'Espiritualidade','valor'=>2,'proposito'=>'I');
            $dados[] = array('atividade'=>'Atividade física','valor'=>2,'proposito'=>'F');
        }
        foreach ($dados as $atividade) {
            $atividade['quadro'] = $quadro->getId();
            $this->save($atividade);
        }
        return true;
    }
    //Copia as atividades do quadro antigo no quadro novo (duplicado)
    public function loadActivities($quadroOLD, $quadroNEW)
    {
        $atividades = $this->findByQuadro($quadroOLD);
        foreach ($atividades as $atividade) {
            //Adicionar o id do novo quadro para ser relacionado a atividade copiada do quadro anterior
            $atividade['quadro'] = $quadroNEW->getId();
            //Remover o id para que entre na inclusao e nao na alteracao
            unset($atividade['id']);
            //Remover informacoes desnecessaria a duplicacao
            unset($atividade['cadastro']);
            unset($atividade['marcacoes']);
            $this->save($atividade);
        }
        return true;
    }
    //Calcula o resultado do dia
    //Para  FERIAS: OTIMO, BOM, RUIM ou PESSIMO
    //Para MESADA: valor acumulado no dia
    //Para TAREFA: TRUE ou FALSE para o pedido especial
    public function mountBoardResult($quadro)
    {
        foreach ($this->semana as $dia) {
            if ($quadro->getTipo()->getCodigo() == 'F') {
                $resultado[] = $this->sumResult($quadro, $dia);
            } elseif ($quadro->getTipo()->getCodigo() == 'M') {
                $resultado[] = $this->calcDayMoney($quadro, $dia);
            } elseif ($quadro->getTipo()->getCodigo() == 'T') {
                $resultado['resultado'][$dia] = $this->loadSpecialGift($quadro, $dia);
            }
        }
        return $resultado;
    }
    //Calcula ao resultado do dia do quadro de TAREFA da crianca
    //True - ganhou o pedido especial. Coracao preenchido
    //False - NÃO ganhou o pedido especial. Coracao vazio
    public function loadSpecialGift($quadro, string $dia)
    {
        try {
            $mark = $this->em->createQuery("select distinct m.$dia from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id")
            ->setParameter(':id', $quadro->getId())
            ->getOneOrNullResult(Query::HYDRATE_SINGLE_SCALAR);
            $specialGift = ($mark == 2) ? 'glyphicon glyphicon-heart' : 'glyphicon glyphicon-heart-empty';
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            $specialGift = 'glyphicon glyphicon-heart-empty';
        }
        return $specialGift;
    }
    //Calcula o total de pontos das atividades realizadas no dia
    //o total de pontos possiveis no quadro e o progresso da crianca
    public function calcProgress($quadro)
    {
        //Calcula os pontos das atividades realizadas (otimo) no quadro
        //Nao soma o valor registrado no quadro, mas o valor da atividade
        foreach ($this->semana as $dia) {
            $real += $this->em->createQuery("select sum(a.valor) as val 
                from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m 
                where q.id=:id and m.$dia = :feito group by q.id")
                ->setParameter(':id', $quadro->getId())
                ->setParameter(':feito', '2')
                ->getOneOrNullResult(Query::HYDRATE_SINGLE_SCALAR);
        }
        //Calcula a quantidade de atividades do quadro e a soma dos pesos
        $prev =  $this->em->createQuery('select sum(a.valor) as val, count(a.id) as qtd from \n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id
            group by q.id')
            ->setParameter(':id', $quadro->getId())
            ->getOneOrNullResult();
        //Calcula o total de pontos possivel para a semana
        $total = round((($prev['val']??0)*7));
        //Calcula o percentual de execucao
        $perc = round((($real??0) / (($prev['val']??0)*7))*100);
        return array('real'=>$real, 'prev'=>$total, 'perc'=>$perc);
    }
    //Calcula quanto a crianca conseguiu de mesada por dia
    public function calcDayMoney($quadro, $dia)
    {
        //Calcula a quantia com base no valor atribuido a atividade e nao ao valor da marcacao
        $valor = $this->em->createQuery("select sum(a.valor) as val 
            from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m 
            where q.id=:id and m.$dia=:otimo group by q.id")
            ->setParameter(':id', $quadro->getId())
            ->setParameter(":otimo", '2')
            ->getOneOrNullResult(Query::HYDRATE_SINGLE_SCALAR);
        return $valor;
    }
    //Calcula o valor total da semana da crianca
    public function calcPocketMoney($quadro)
    {
        //Calcula os pontos das atividades realizadas no quadro
        foreach ($this->semana as $dia) {
            $total += $this->em->createQuery("select sum(a.valor) as val 
                from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m 
                where q.id=:id and m.$dia=:otimo group by q.id")
                ->setParameter(':id', $quadro->getId())
                ->setParameter(':otimo', '2')
                ->getOneOrNullResult(Query::HYDRATE_SINGLE_SCALAR);
        }
        return $total;
    }
  
    //Calcula ao resultado do dia do quadro de FERIAS da crianca
    //1 - PESSIMO
    //2 - RUIM
    //3 - BOM
    //4 - OTIMO
    public function sumResult($quadro, string $dia)
    {
        $peso = $this->em->createQuery('select sum(a.valor) as peso from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a where q.id = :id')
            ->setParameter(':id', $quadro->getId())
            ->getOneOrNullResult(Query::HYDRATE_SINGLE_SCALAR) ?? 1;//retorna 1 caso o valor seja nulo PHP7
        $nota = $this->em->createQuery("select sum(a.valor * m.$dia) as nota from n0va1s\QuadroMagico\Entity\QuadroEntity q join q.atividades a join a.marcacoes m where q.id = :id group by q.id")
            ->setParameter(':id', $quadro->getId())
            ->getOneOrNullResult(Query::HYDRATE_SINGLE_SCALAR) ?? 0;//retorna 0 caso o valor seja nulo PHP7
        $quali = ["Péssimo", "Ruim", "Bom", "Ótimo"];
        $result = "Não sei";
        $med = round($nota/$peso);
        if ($med) {
            $result = $quali[$med-1];
        }
        return $result;
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
