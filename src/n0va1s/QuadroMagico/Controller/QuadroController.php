<?php

namespace n0va1s\QuadroMagico\Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Doctrine\ORM\EntityManager;
use n0va1s\QuadroMagico\Service\AtividadeService;
use n0va1s\QuadroMagico\Service\DominioService;
use n0va1s\QuadroMagico\Service\QuadroService;

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

        $app['dominio_service'] = function () {
            return new DominioService($this->em);
        };

        $ctrl->get('/', function () use ($app) {
            $tipos = $app['dominio_service']->fetchAll();
            return $app['twig']->render('cadastroQuadro.twig', array('tipos'=>$tipos));
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
            $tipo = $app['dominio_service']->findById($quadro['tipo']->getId());
            $crianca = $dados['crianca'];
            $codigo = $dados['codigo'];
            $mail = (new \Swift_Message('[UmDesejoPorSemana] O quadro de '.$tipo.' para '.$crianca))
                ->setFrom('contato@umdesejoporsemana.com', 'Um Desejo Por Semana')
                ->setTo($dados['responsavel'])
                ->setBody("O quadro de $tipo para $crianca está disponível no endereço <br /> <a href='umdesejoporsemana.com/quadro/exibir/'$codigo", 'text/html');
            $app['mailer']->send($mail);
            //Cria um novo request para o cadastro de atividades
            $dados = array('quadro'=>$quadro, 'tipo'=>$tipo);
            $subRequest = $req::create('/quadro/atividade', 'GET', $dados);
            $response = $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);
            return $response;
            
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
            $tipo = $app['dominio_service']->findById($quadro['tipo']->getId());
            $atividades = $app['atividade_service']->findByQuadro($quadro);
            $resultados = $app['atividade_service']->mountBoardResult($quadro);
            //Totaliza quantos pontos faltam para a crianca atingir a meta semanal (70%)
            $progresso = $app['atividade_service']->calcProgress($quadro);
            $mesada = $app['atividade_service']->calcPocketMoney($quadro);
            return $app['twig']->render('exibeQuadro.twig', array('quadro'=>$quadro, 'tipo'=>$tipo, 'atividades'=>$atividades, 'resultados'=>$resultados, 'real'=>$progresso['real'], 'prev'=>$progresso['prev'], 'perc'=>$progresso['perc'], 'mesada'=>$mesada));
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
            //Lista de tipos de quadro
            $tipos = $app['dominio_service']->fetchAll();
            //Carregar atividades do quadro anterior
            $atividades = $app['atividade_service']->loadActivities($id, $quadro['id']);
            //Informacoes duplicadas vao para a tela para alteracao
            return $app['twig']->render('cadastroQuadro.twig', array('quadro'=>$quadro, 'tipos'=>$tipos));
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

        $ctrl->get('/atividade', function (Request $req) use ($app) {
            $dados = $req->request->all();
            //Caso o request venha do salvar quadro e nao do cadastro de atividade
            if (empty($dados)) {
                $quadro = $req->query->get('quadro');
                $tipo = $req->query->get('tipo');
            }
            $quadro = $app['quadro_service']->findById($quadro);
            //Pesquisar as atividades do quadro
            $atividades = $app['atividade_service']->findByQuadro($quadro);
            return $app['twig']->render('cadastroAtividade.twig', array('quadro'=>$quadro, 'atividades'=>$atividades, 'tipo'=>$tipo));
        })->bind('indexAtividade');

        $ctrl->get('/atividade/cadastrar/{codigo}', function ($codigo) use ($app) {
            $quadro = $app['quadro_service']->findByCodigo($codigo);
            //Pesquisar as atividades do quadro
            $atividades = $app['atividade_service']->findByQuadro($quadro);
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
            $atividades = $app['atividade_service']->findByQuadro($quadro);
            return $app['twig']->render('cadastroAtividade.twig', array('quadro'=>$quadro, 'atividades'=>$atividades));
        })->bind('atividadeSalvar');

        $ctrl->get('/atividade/excluir/{id}', function ($id) use ($app) {
            $resultado = $app['atividade_service']->delete($id);
            $quadro = $app['session']->get('quadro');
            $atividades = $app['atividade_service']->findByQuadro($quadro);
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
