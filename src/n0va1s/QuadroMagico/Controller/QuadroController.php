<?php

namespace n0va1s\QuadroMagico\Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use n0va1s\QuadroMagico\Service\QuadroService;
use n0va1s\QuadroMagico\Service\AtividadeService;

class QuadroController implements ControllerProviderInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function connect(Application $app)
    {
        //if ($app['security.authorization_checker']->isGranted('ROLE_ADMIN')) {
        $ctrl = $app['controllers_factory'];

        $app['quadro_service'] = function () {
            return new QuadroService($this->em);
        };

        $ctrl->get('/', function () use ($app) {
            return $app['twig']->render('cadastroQuadro.twig');
        })->bind('indexQuadro');

        $ctrl->post('/salvar', function (Request $req) use ($app) {
            $dados = $req->request->all();
            $quadro = $app['quadro_service']->save($dados);
            //Para recuperar o id do quadro no cadastro de atividades
            $app['session']->set('quadro', $quadro);
            //Se for um quadro novo
            if (empty($dados['id'])) {
                //Carregar atividades de exemplo
                $atividades = $app['atividade_service']->loadExamples($quadro['id']);
            }
            //Envia os dados do quadro para o responsavel
            $tipo = $dados['tipo'] = 'T'? 'tarefa' : 'mesada';
            $crianca = $dados['crianca'];
            $codigo = $dados['codigo'];
            $mail = (new \Swift_Message('[UmDesejoPorSemana] O quadro de '.$tipo.' para '.$crianca))
                ->setFrom('contato@umdesejoporsemana.com', 'Um Desejo Por Semana')
                ->setTo($dados['responsavel'])
                ->setBody("O quadro de $tipo para $crianca está disponível no endereço <br /> <a href='umdesejoporsemana.com/quadro/exibir/'$codigo", 'text/html');
            $app['mailer']->send($mail);
            //Redireciona para o cadastro de atividades
            return $app->redirect('./atividade'); //TODO:retirar a URL fixa
        })->bind('quadroSalvar');

        $ctrl->get('/consultar', function () use ($app) {
            return $app['twig']->render('listaQuadro.twig');
        })->bind('quadroConsultar');

        $ctrl->post('/listar', function (Request $req) use ($app) {
            $dados = $req->request->all();
            $quadros = $app['quadro_service']->findByEmail($dados['email']);
            $app['session']->set('email', $dados['email']);
            return $app['twig']->render('listaQuadro.twig', array('quadros'=>$quadros));
        })->bind('quadroListar');

        $ctrl->get('/exibir/{codigo}', function ($codigo) use ($app) {
            $quadro = $app['quadro_service']->findByCodigo($codigo);
            $atividades = $app['atividade_service']->findByQuadro($quadro['id']);
            //Carrega se houve pedido especial em um dos dias
            $specialGifts = $app['atividade_service']->loadSpecialGift($quadro['id']);
            //Totaliza quanto a crianca conseguiu de mesada no dia
            $valueDays = $app['atividade_service']->sumValueDay($quadro['id']);
            //Totaliza quantos pontos faltam para a crianca atingir a meta semanal (70%)
            $points = $app['atividade_service']->sumPoints($quadro['id']);
            //Totaliza quanto a crianca alcancou de mesada ate o momento
            $sumPocketMoney = $app['atividade_service']->sumPocketMoney($quadro['id']);
            return $app['twig']->render('exibeQuadro.twig', array('quadro'=>$quadro, 'atividades'=>$atividades, 'pedidoEspecial'=>$specialGifts, 'valorDia'=>$valueDays, 'totRealizado'=>$points['real'], 'totPrevisto'=>$points['prev'], 'pctRealizado'=>$points['perc'],'totMesada'=>$sumPocketMoney));
        })->bind('quadroExibir');

        $ctrl->get('/duplicar/{codigo}', function ($codigo) use ($app) {
            //Dados do quadro a ser duplicado
            $dados = $app['quadro_service']->findByCodigo($codigo);
            //Guarda o id do quadro de origem para duplicar as atividades
            $id = $dados['id'];
            //Remove o id do quadro para criar um novo quadro ao salvar
            unset($dados['id']);
            //Cria um novo quadro com os dados do quadro anterior
            $quadro = $app['quadro_service']->save($dados);
            //Carregar atividades do quadro anterior
            $atividades = $app['atividade_service']->loadActivities($id, $quadro['id']);
            //Informacoes duplicadas vao para a tela para alteracao
            return $app['twig']->render('cadastroQuadro.twig', array('quadro'=>$quadro));
        })->bind('quadroDuplicar');

        $ctrl->get('/excluir/{codigo}', function ($codigo) use ($app) {
            $quadro = $app['quadro_service']->findByCodigo($codigo);
            $excluiu = $app['quadro_service']->delete($quadro['id']);
            $quadros = $app['quadro_service']->findByEmail($app['session']->get('email'));
            return $app['twig']->render('listaQuadro.twig', array('quadros'=>$quadros));
        })->bind('quadroExcluir')
        ->assert('id', '\d+');

        $app['atividade_service'] = function () {
            return new AtividadeService($this->em);
        };

        $ctrl->get('/atividade', function () use ($app) {
            //Pesquisar as atividades do quadro
            $atividades = $app['atividade_service']->findByQuadro($app['session']->get('quadro')['id']);
            return $app['twig']->render('cadastroAtividade.twig', array('quadro'=>$app['session']->get('quadro'), 'atividades'=>$atividades));
        })->bind('indexAtividade');

        $ctrl->get('/atividade/cadastrar/{codigo}', function ($codigo) use ($app) {
            $quadro = $app['quadro_service']->findByCodigo($codigo);
            //Pesquisar as atividades do quadro
            $atividades = $app['atividade_service']->findByQuadro($quadro['id']);
            //Enviar o quadro para sessao para ser salvo junto com a atividade
            $app['session']->set('quadro', $quadro);
            return $app['twig']->render('cadastroAtividade.twig', array('quadro'=>$quadro, 'atividades'=>$atividades));
        })->bind('atividadeCadastrar');

        $ctrl->post('/atividade/salvar', function (Request $req) use ($app) {
            $dados = $req->request->all();
            $imagem = $req->files->get('imagem');
            //Recupera os dados do quadro da sessao
            $quadro = $app['session']->get('quadro');
            //Adiciona o id do quadro nos dados da atividade
            $dados['quadro'] = $quadro['id'];
            //Salvar a atividade
            $resultado = $app['atividade_service']->save($dados, $imagem);
            //Pesquisar as atividades do quadro
            $atividades = $app['atividade_service']->findByQuadro($quadro['id']);
            return $app['twig']->render('cadastroAtividade.twig', array('quadro'=>$quadro, 'atividades'=>$atividades));
        })->bind('atividadeSalvar');

        $ctrl->get('/atividade/excluir/{id}', function ($id) use ($app) {
            $resultado = $app['atividade_service']->delete($id);
            $quadro = $app['session']->get('quadro');
            $atividades = $app['atividade_service']->findByQuadro($quadro['id']);
            return $app['twig']->render('cadastroAtividade.twig', array('quadro'=>$quadro, 'atividades'=>$atividades));
        })->bind('atividadeExcluir')
        ->assert('id', '\d+');

        $ctrl->post('/atividade/marcar', function (Request $req) use ($app) {
            $dados = $req->request->all();
            $resultado = $app['atividade_service']->mark($dados);
            return $app->json($resultado);
        })->bind('atividadeMarcar');

        return $ctrl;
    }
}
