<?php

namespace views;

class CategoriaTest extends \PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost:8888/categoria');
    }

    public function testVerificaFormularioBranco()
    {
        $this->url('/');
        $this->assertEquals('code.education - Curso de PHP - Módulo Categoria', $this->title());
    }

    //$this->byName();
    //$this->byId();
    //$this->byCssSelector();
    //$this->bylinkText();
}
