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

            $app->before(
                function (Request $request) {
                    if (0 === strpos(
                        $request->headers->get(
                            'Content-Type'
                        ), 
                        'application/json'
                    )
                    ) {
                        $data = json_decode($request->getContent(), true);
                        $request->request->replace(
                            is_array($data) ? $data : array()
                        );
                    }
                }
            );

            $ctrl->post(
                '/botQuadroIncluir', function (Request $req) use ($app) {
                    $dados = $req->request->all();
                    $quadro = $app['quadro_service']->save($dados);
                    if ($quadro->getId() > 0) {
                        return new Response(
                            $app->json(array('id'=>$quadro->getId())), 201
                        );
                    } else {
                        return $app->abort(
                            500, 
                            "Não consegui salvar o quadro de {$dados["crianca"]}"
                        );
                    }
                }
            )->bind('botQuadroIncluir');

            $ctrl->put(
                '/botQuadroAlterar', function (Request $req) use ($app) {
                    $dados = $req->request->all();
                    $quadro = $app['quadro_service']->save($dados);
                    return $app->json($quadro);
                }
            )->bind('botQuadroAlterar');

            $ctrl->delete(
                '/botQuadroExcluir/{id}', function ($id) use ($app) {
                    if ($id) {
                        $resultado = $app['quadro_service']->delete($id);
                        return new Response($app->json(array('excluido'=>$resultado)), 201);
                    } else {
                        return $app->abort(500, "Não foi possível excluir o quadro");
                    }
                }
            )->bind('botQuadroExcluir');

            $ctrl->get(
                '/botQuadroListar', function (Request $req) use ($app) {
                    if ($validator->isValid($req->request->get('email'), new RFCValidation())) {
                        $quadros = $app['quadro_service']->findByEmail(
                            $req->request->get('email')
                        );
                        if ($quadros) {
                            return new Response($app->json($quadros), 201);
                        } else {
                            return $app->abort(
                                500, 
                                "Não encontrei quadros para o email {$email}"
                            );
                        }                    
                    } else {
                        return $app->abort(
                            500, 
                            "Ops... esse email não é válido."
                        );
                    }
                }
            )->bind('botQuadroListar');

            return $ctrl;
    }
}
