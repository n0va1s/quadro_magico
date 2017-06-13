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
        $ctrl = $app['controllers_factory'];

        $app['quadro_service'] = function () {
            return new \n0va1s\QuadroMagico\Service\QuadroService($this->em);
        };
        //aplicacao
        $ctrl->get('/crianca', function () use ($app) {
            return $app['twig']->render('crianca.twig');
        })->bind('indexCrianca');

        $ctrl->get('/jovem', function () use ($app) {
            return $app['twig']->render('jovem.twig');
        })->bind('indexJovem');

        $ctrl->get('/adolescente', function () use ($app) {
            return $app['twig']->render('adolescente.twig');
        })->bind('indexAdolescente');

        $ctrl->get('/app/listar', function ($id) use ($app) {
            $resultado = $app['quadro_service']->findById($id);
            return $app['twig']->render('adolescente.twig', ['atividades'=>$resultado]);
        })->bind('listarAtividadeHtml');

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

        return $ctrl;
    }
}
