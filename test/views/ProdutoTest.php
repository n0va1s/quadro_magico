<?php

namespace views;

class ProdutoTest extends \PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost:8888/produto');
    }

    public function testVerificaFormularioBranco()
    {
        $this->url('/');
        $this->assertEquals('code.education - Curso de PHP - Módulo Produto', $this->title());
    }
}
