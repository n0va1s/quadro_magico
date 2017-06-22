<?php

namespace n0va1s\QuadroMagico\Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use n0va1s\QuadroMagico\Service\ResponsavelService;

class ResponsavelController implements ControllerProviderInterface
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

            $app['responsavel_service'] = function () {
                return new \n0va1s\QuadroMagico\Service\ResponsavelService($this->em);
            };
            //aplicacao
            $ctrl->get('/', function () use ($app) {
                return $app['twig']->render('cadastroResponsavel.twig');
            })->bind('indexResponsavel');

            $ctrl->post('/responsavel', function (Request $req) use ($app) {
                $dados = $req->request->all();
                $resultado = $app['responsavel_service']->save($dados);
                return $app->json($resultado);
            })->bind('responsavelSalvar');

            $ctrl->delete('/responsavel/{id}', function ($id) use ($app) {
                $dados = $req->request->all();
                $resultado = $app['responsavel_service']->delete($id);
                return $app->json($resultado);
            })->bind('responsavelExcluir');

            return $ctrl;
    }
}
