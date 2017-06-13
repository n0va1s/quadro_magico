<?php

namespace views;

class TagTest extends \PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost:8888/tag');
    }

    public function testVerificaFormularioBranco()
    {
        $this->url('/');
        $this->assertEquals('code.education - Curso de PHP - Módulo Tag', $this->title());
    }
}
