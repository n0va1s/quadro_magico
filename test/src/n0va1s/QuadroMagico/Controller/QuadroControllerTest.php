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

    public function testAPISalvarQuadroTarefa()
    {
        $this->client->request('POST', '/quadro/salvar', array('id'=>null,'tipo'=>'3',
        'email'=> 'jp.pessoal@gmail.com','genero'=>'M','idade'=>'10','crianca'=>'Meu Filho da Silva',
        'recompensa'=>null));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertGreaterThan(0, $dados['id']);
        return $dados['id'];
    }

    public function testAPISalvarQuadroMesada()
    {
        $this->client->request('POST', '/quadro/salvar', array('id'=>null,'tipo'=>'2',
        'email'=> 'jp.pessoal@gmail.com','genero'=>'M','idade'=>'10','crianca'=>'Meu Filho da Silva',
        'recompensa'=>null));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertGreaterThan(0, $dados['id']);
        return $dados['id'];
    }

    public function testAPISalvarQuadroFerias()
    {
        $this->client->request('POST', '/quadro/salvar', array('id'=>null,'tipo'=>'1',
        'email'=> 'jp.pessoal@gmail.com','genero'=>'M','idade'=>'10','crianca'=>'Meu Filho da Silva',
        'recompensa'=>null));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertGreaterThan(0, $dados['id']);
        return $dados['id'];
    }
    /**
     * @depends testAPISalvarQuadroTarefa
     */
    public function testAPIAtualizarQuadro(int $id)
    {
        $this->client->request('POST', '/quadro/salvar', array('id'=>$id,'tipo'=>'3',
        'email'=> 'jp.pessoal@gmail.com','genero'=>'M','idade'=>'10','crianca'=>'Meu Filho da Silva',
        'recompensa'=>'atualizado'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(1, count($dados['id']));
        $this->assertContains('atualizado', $dados['recompensa']);
    }
    /**
     * @depends testAPISalvarQuadroTarefa
     */
    public function testAPIQuadroListar(int $id)
    {
        $this->client->request('GET', '/quadro/listar', array('email'=>'jp.pessoal@gmail.com'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(1, count($dados));
        $this->assertArrayHasKey('id', $dados[0]);
        $this->assertArrayHasKey('descricao', $dados[0]);
    }
    /**
     * @depends testAPISalvarQuadroTarefa
     */
    public function testAPIQuadroDeletar(int $codigo)
    {
        $this->client->request('DELETE', '/quadro/'.$codigo);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $this->assertTrue((boolean)$this->client->getResponse()->getContent());
    }

    public function tearDown()
    {
        unset($this->client);
    }
}
