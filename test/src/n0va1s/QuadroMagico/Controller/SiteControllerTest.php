<?php

namespace n0va1s\QuadroMagico\Controller;

use Silex\WebTestCase;

class SiteControllerTest extends WebTestCase
{
    private $client;
    
    public function createApplication()
    {
        $app = require __DIR__.'/../../../../app.php';
        $app['session.test'] = true;
        return $app;
    }

    protected function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    /* Index */
    public function testAPPIndex()
    {
        $this->client->request('GET', '/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('BrinqueCoin', $this->client->getResponse()->getContent());
    }

    public function testAPPMenu()
    {
        $this->client->request('GET', '/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Início', $this->client->getResponse()->getContent());
        $this->assertContains('Quero criar um quadro', $this->client->getResponse()->getContent());
        $this->assertContains('Meus quadros', $this->client->getResponse()->getContent());        
        $this->assertContains('Dicas', $this->client->getResponse()->getContent());
        $this->assertContains('Crie seu quadro', $this->client->getResponse()->getContent());
    }

    public function testAPPBlocosConteudo()
    {
        $this->client->request('GET', '/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Início', $this->client->getResponse()->getContent());
        $this->assertContains('Regras do Jogo', $this->client->getResponse()->getContent());
        $this->assertContains('Os idealizadores', $this->client->getResponse()->getContent());
        $this->assertContains('brinquecoin@brinquecoin.com', $this->client->getResponse()->getContent());
    }

    /* cadastro de quadro */
    public function testAPPQuadroCadastro()
    {
        $this->client->request('GET', '/quadro/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('BrinqueCoin', $this->client->getResponse()->getContent());
        $this->assertContains('Crie o seu quadro', $this->client->getResponse()->getContent());
    }

    /* meus quadros */
    public function testAPPQuadroConsulta()
    {
        $this->client->request('GET', '/quadro/consultar');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('BrinqueCoin', $this->client->getResponse()->getContent());
        $this->assertContains('Encontre o seu(s) quadro(s)', $this->client->getResponse()->getContent());
    }

    /* dicas */
    public function testAPPDica()
    {
        $this->client->request('GET', '/dica');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('BrinqueCoin', $this->client->getResponse()->getContent());
        $this->assertContains('Higiene', $this->client->getResponse()->getContent());
        $this->assertContains('Autonomia', $this->client->getResponse()->getContent());
    }

    public function tearDown()
    {
        unset($this->client);
    }
}