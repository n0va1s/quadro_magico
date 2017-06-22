<?php

namespace n0va1s\QuadroMagico\Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
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
                return new \n0va1s\QuadroMagico\Service\QuadroService($this->em);
            };
            //aplicacao
            $ctrl->get('/', function () use ($app) {
                return $app['twig']->render('cadastroQuadro.twig');
            })->bind('indexQuadro');

            $ctrl->post('/quadro', function (Request $req) use ($app) {
                //$dados = $req->request->all();
                //$resultado = $app['quadro_service']->save($dados);
                return $app['twig']->render('cadastroQuadro.twig');
            })->bind('quadroSalvar');

            $ctrl->get('/atividade', function (Request $req) use ($app) {
                return $app['twig']->render('cadastroAtividade.twig');
            })->bind('indexAtividade');

            $ctrl->post('/atividade', function (Request $req) use ($app) {
                //$dados = $req->request->all();
                //$resultado = $app['quadro_service']->save($dados);
                return $app['twig']->render('cadastroAtividade.twig');
            })->bind('atividadeSalvar');

            //api
            $ctrl->get('/api/listar', function () use ($app) {
                $resultado = $app['quadro_service']->fetchall();
                return $app->json($resultado);
            })->bind('listarCategoriaJson');

            $ctrl->get('/api/listar/{id}', function ($id) use ($app) {
                $resultado = $app['quadro_service']->findById($id);
                return $app->json($resultado);
            })->bind('listarCategoriaIdJson')
            ->assert('id', '\d+');

            $ctrl->post('/api/inserir', function (Request $req) use ($app) {
                $dados = $req->request->all();
                $resultado = $app['quadro_service']->save($dados);
                return $app->json($resultado);
            })->bind('inserirAtividade');

            $ctrl->put('/api/atualizar/{id}', function (Request $req) use ($app) {
                $dados = $req->request->all();
                $resultado = $app['quadro_service']->save($dados);
                return $app->json($resultado);
            })->bind('atualizarAtividade')
            ->assert('id', '\d+');

            $ctrl->delete('/api/apagar/{id}', function ($id) use ($app) {
                $resultado = $app['quadro_service']->delete($id);
                return $app->json($resultado);
            })->bind('apagarAtividade')
            ->assert('id', '\d+');
        /*} else {
            return $app->abort(500, 'Faça login para usar essa opção');
        }*/
            return $ctrl;
    }
}
