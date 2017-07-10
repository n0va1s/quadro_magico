<?php

namespace n0va1s\QuadroMagico\Controller;

use Silex\WebTestCase;

class TagControllerTest extends WebTestCase
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

    public function testIndexTagAPP()
    {
        $this->client->request('GET', '/tag/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Módulo Tag (API)', $this->client->getResponse()->getContent());
    }

    public function testInserirTagAPI()
    {
        $this->client->request('POST', '/tag/api/inserir', array('nomTag' => 'Tag 1'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertGreaterThan(0, $dados['id']);
        return $dados['id'];
    }
    /**
     * @depends testInserirTagAPI
     */
    public function testAtualizarTagAPI(int $id)
    {
        $this->client->request('PUT', '/tag/api/atualizar/'.$id, array('seqTag'=>$id, 'nomTag'=>'Tag Nova'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(1, count($dados['id']));
        $this->assertContains('Tag Nova', $dados['descricao']);
    }
    /**
     * @depends testInserirTagAPI
     */
    public function testListarTagIdAPI(int $id)
    {
        $this->client->request('GET', '/tag/api/listar/'.$id);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(1, count($dados));
        $this->assertArrayHasKey('id', $dados[0]);
        $this->assertArrayHasKey('descricao', $dados[0]);
    }
    /**
     * @depends testInserirTagAPI
     */
    public function testApagarTagAPI(int $id)
    {
        $this->client->request('DELETE', '/tag/api/apagar/'.$id, array('seqTag'=>$id));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $this->assertTrue((boolean)$this->client->getResponse()->getContent());
    }

    public function testListarTagAPI()
    {
        $this->client->request('GET', '/tag/api/listar/json');
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
