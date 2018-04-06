<?php
namespace n0va1s\QuadroMagico\Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class SiteController implements ControllerProviderInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function connect(Application $app)
    {
        $ctrl = $app['controllers_factory'];

        $app['email_service'] = function () {
            return new EmailService($this->em);
        };
        //Login
        /*
        $app->get('/login', function (Request $req) use ($app) {
            return $app['twig']->render('login.twig', array(
                'error' => $app['security.last_error']($req),
                'last_username' => $app['session']->get('_security.last_username'),
            ));
        })->bind('indexLogin');
        */
        $app->get(
            '/dica', function () use ($app) {
                return $app['twig']->render(
                    'dica.twig',
                    array(),
                    new Response('OK', 200)
                );
            }
        )->bind('indexDica');

        $app->get(
            '/contato', function () use ($app) {
                return $app['twig']->render(
                    'contato.twig',
                    array(),
                    new Response('OK', 200)
                );
            }
        )->bind('indexContato');

        $app->post(
            '/contato/enviar', function (Request $req) use ($app) {
                $dados = $req->request->all();
                $message = (new \Swift_Message('[BrinqueCoin] Contato'))
                ->setFrom([$dados['email'] => $dados['nome']])
                ->setTo(['contato@brinquecoin.com'])
                ->setBody($dados['mensagem']);
                $result = $app['mailer']->send($message);
                if ($result) {
                    return $app['twig']->render(
                        'contato.twig', 
                        array('mensagem'=>'Obrigado! Sua mensagem foi enviada.'),
                        new Response('OK', 200)
                    );
                } else {
                    return $app->abort(
                        404, 
                        "Ops... não enviamos a menssagem. Tente novamente."
                    ); 
                }
            }
        )->bind('contatoEnviar');

        return $ctrl;
    }
}
