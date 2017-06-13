<?php

namespace views;

class InicioTest extends \PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost:8888');
    }

    public function testVerificaFormularioBranco()
    {
        $this->url('/');
        $this->assertEquals('code.education - Curso de PHP - módulo Silex', $this->title());
    }
}
