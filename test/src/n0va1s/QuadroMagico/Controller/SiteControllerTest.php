<?php

namespace n0va1s\QuadroMagico\Controller;

use Silex\WebTestCase;

class ProdutoControllerTest extends WebTestCase
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

    public function testIndexProdutoAPP()
    {
        $this->client->request('GET', '/produto/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Módulo Produto (API)', $this->client->getResponse()->getContent());
    }

    public function testIncluirProdutoAPP()
    {
        $this->client->request('GET', '/produto/incluir');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Informe', $this->client->getResponse()->getContent());
    }

    public function testGravarProdutoAPP()
    {
        $entrada = array('nomProduto'=>'Nome do Produto APP',
            'desProduto'=>'Novo Produto APP', 'valProduto'=>'100.00');
        $this->client->request('POST', '/produto/gravar', $entrada);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $saida = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertGreaterThan(0, $saida['id']);
        return $saida['id'];
    }
    /**
     * @depends testGravarProdutoAPP
     */
    public function testAlterarProdutoAPP(int $id)
    {
        $this->client->request('GET', '/produto/alterar/'.$id);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $saida = json_decode($this->client->getResponse()->getContent(), true);
        //O valor nao e alterado ainda, apenas monstrado na tela para alteracao
        $this->assertContains('Novo Produto APP', $saida['descricao']);
        $this->assertArrayHasKey('id', $saida);
    }
    /**
     * @depends testGravarProdutoAPP
     */
    public function testExcluirProdutoAPP(int $id)
    {
        $this->client->request('GET', '/produto/excluir/'.$id);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue((boolean)$this->client->getResponse()->getContent());
    }

    public function testListarProdutoAPP()
    {
        $this->client->request('GET', '/produto/listar/html');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Novo produto (+)', $this->client->getResponse()->getContent());
    }

    public function testInserirProdutoAPI()
    {
        $entrada = array('nomProduto'=>'Nome do Produto API',
            'desProduto'=>'Descricao do Produto API', 'valProduto'=>'88.88');
        $this->client->request('POST', '/produto/api/inserir', $entrada);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $saida = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertGreaterThan(0, $saida['id']);
        return $saida['id'];
    }
    /**
     * @depends testInserirProdutoAPI
     */
    public function testAtualizarProdutoAPI(int $id)
    {
        $entrada = array('nomProduto'=>'Nome do Produto API Atualizado',
            'desProduto'=>'Descricao do Produto API Atualizado', 'valProduto'=>'77.77');
        $this->client->request('PUT', '/produto/api/atualizar/'.$id, $entrada);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $saida = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(1, count($saida['id']));
        $this->assertContains('Descricao do Produto API Atualizado', $saida['descricao']);
    }
    /**
     * @depends testInserirProdutoAPI
     */
    public function testListarProdutoIdAPI(int $id)
    {
        $this->client->request('GET', '/produto/api/listar/'.$id);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $saida = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(4, count($saida)); //retornam 4 campos no array
        $this->assertArrayHasKey('id', $saida);
        $this->assertArrayHasKey('descricao', $saida);
    }

    public function testListarProdutoPaginadoAPI()
    {
        $this->client->request('GET', '/produto/api/listar/paginado/1');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
    }

    /**
     * @depends testInserirProdutoAPI
     */
    public function testApagarProdutoAPI(int $id)
    {
        $this->client->request('DELETE', '/produto/api/apagar/'.$id, array('seqProduto'=>$id));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $this->assertTrue((boolean)$this->client->getResponse()->getContent());
    }

    public function testListarProdutoAPI()
    {
        $this->client->request('GET', '/produto/api/listar/json');
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
