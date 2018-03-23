<?php

namespace n0va1s\QuadroMagico\Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use n0va1s\QuadroMagico\Service\QuadroService;

class BotController implements ControllerProviderInterface
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

            $app->before(function (Request $request) {
                if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                    $data = json_decode($request->getContent(), true);
                    $request->request->replace(is_array($data) ? $data : array());
                }
            });

            $ctrl->post('/botSalvarQuadro', function (Request $req) use ($app) {
                $dados = $req->request->all();
                $quadro = $app['quadro_service']->save($dados);
                return $app->json($quadro);
            })->bind('botQuadroSalvar');

            $ctrl->put('/botQuadroAtualizar', function (Request $req) use ($app) {
                $dados = $req->request->all();
                $quadro = $app['quadro_service']->save($dados);
                return $app->json($quadro);
            })->bind('botQuadroAtualizar');

            $ctrl->delete('/botQuadroExcluir/{id}', function ($id) use ($app) {
                $resultado = $app['quadro_service']->delete($id);
                return $app->json($resultado);
            })->bind('botQuadroExcluir');

            $ctrl->get('/botQuadroListar', function (Request $req) use ($app) {
                $email = $req->request->get('email');
                $quadros = $app['quadro_service']->findByEmail($email);
                return $app->json($quadros);
            })->bind('botQuadroListar');

            return $ctrl;
    }
}
