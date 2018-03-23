<?php

namespace n0va1s\QuadroMagico\Controller;

use Silex\WebTestCase;

class CategoriaControllerTest extends WebTestCase
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

    public function testIndexQuadroAPP()
    {
        $this->client->request('GET', '/quadro/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Módulo Categoria', $this->client->getResponse()->getContent());
    }

    public function testInserirCategoriaAPI()
    {
        $this->client->request('POST', '/categoria/api/inserir', array('nomCategoria' => 'Categoria 1'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertGreaterThan(0, $dados['id']);
        return $dados['id'];
    }
    /**
     * @depends testInserirCategoriaAPI
     */
    public function testAtualizarCategoriaAPI(int $id)
    {
        $this->client->request('PUT', '/categoria/api/atualizar/'.$id, array('seqCategoria'=>$id, 'nomCategoria'=>'Categoria Nova'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(1, count($dados['id']));
        $this->assertContains('Categoria Nova', $dados['descricao']);
    }
    /**
     * @depends testInserirCategoriaAPI
     */
    public function testListarCategoriaIdAPI(int $id)
    {
        $this->client->request('GET', '/categoria/api/listar/'.$id);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(1, count($dados));
        $this->assertArrayHasKey('id', $dados[0]);
        $this->assertArrayHasKey('descricao', $dados[0]);
    }
    /**
     * @depends testInserirCategoriaAPI
     */
    public function testApagarCategoriaAPI(int $id)
    {
        $this->client->request('DELETE', '/categoria/api/apagar/'.$id, array('seqCategoria'=>$id));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $this->assertTrue((boolean)$this->client->getResponse()->getContent());
    }

    public function testListarCategoriaAPI()
    {
        $this->client->request('GET', '/categoria/api/listar/json');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $c = count(json_decode($this->client->getResponse()->getContent(), true));
        if ($c > 0) {
            $this->assertArrayHasKey('id', json_decode($this->client->getResponse()->getContent(), true)[$c-1]);
            $this->assertArrayHasKey('descricao', json_decode($this->client->getResponse()->getContent(), true)[$c-1]);
        }
    }

    public function tearDown()
    {
        unset($this->client);
    }
}
