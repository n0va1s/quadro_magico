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
        })->bind('quadroCadastro');

        $ctrl->post('/salvar', function (Request $req) use ($app) {
            $dados = $req->request->all();
            $quadro = $app['quadro_service']->save($dados);
            //Para recuperar o id do quadro no cadastro de atividades
            $app['session']->set('quadro', $quadro);
            //return $app['twig']->render('cadastroAtividade.twig', array('quadro'=>$quadro));
            //Redireciona para o cadastro de atividades
            return $app->redirect('./atividade'); //TODO:retirar a URL fixa
        })->bind('quadroSalvar');

        $ctrl->get('/consulta', function () use ($app) {
            return $app['twig']->render('listaQuadro.twig');
        })->bind('quadroConsulta');

        $ctrl->post('/listar', function (Request $req) use ($app) {
            $dados = $req->request->all();
            $quadros = $app['quadro_service']->findByEmail($dados['email']);
            $app['session']->set('email', $dados['email']);
            return $app['twig']->render('listaQuadro.twig', array('quadros'=>$quadros));
        })->bind('quadroListar');

        $ctrl->get('/exibir/{id}', function ($id) use ($app) {
            $quadro = $app['quadro_service']->findById($id);
            $atividades = $app['atividade_service']->findByQuadro($quadro['id']);
            return $app['twig']->render('exibeQuadro.twig', array('quadro'=>$app['session']->get('quadro'), 'atividades'=>$atividades));
        })->bind('quadroExibir')
        ->assert('id', '\d+');

        $ctrl->get('/excluir/{id}', function ($id) use ($app) {
            $excluiu = $app['quadro_service']->delete($id);
            if ($excluiu) {
                $quadros = $app['quadro_service']->findByEmail($app['session']->get('email'));
                return $app['twig']->render('listaQuadro.twig', array('quadros'=>$quadros));
            } else {
                return $app['twig']->render('listaQuadro.twig', array('mensagem'=>'Não consegui excluir :('));
            }
        })->bind('quadroExcluir')
        ->assert('id', '\d+');

        $app['atividade_service'] = function () {
            return new AtividadeService($this->em);
        };

        $ctrl->get('/atividade', function () use ($app) {
            return $app['twig']->render('cadastroAtividade.twig', array('quadro'=>$app['session']->get('quadro')));
        })->bind('indexAtividade');

        $ctrl->post('/atividade/salvar', function (Request $req) use ($app) {
            $dados = $req->request->all();
            //Recupera os dados do quadro da sessao
            $quadro = $app['session']->get('quadro');
            //Adiciona o id do quadro nos dados da atividade
            $dados['quadro'] = $quadro['id'];
            $resultado = $app['atividade_service']->save($dados);
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
        return $ctrl;
    }
}
