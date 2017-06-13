<?php

namespace n0va1s\QuadroMagico\Entity;

class CategoriaEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaTipoClasse()
    {
        $this->assertInstanceOf("n0va1s\QuadroMagico\Entity\CategoriaEntity", new \n0va1s\QuadroMagico\Entity\CategoriaEntity());
    }

    public function testVerificaGetSet()
    {
        $categoria = $this->getMockBuilder('\n0va1s\QuadroMagico\Entity\CategoriaEntity')
                          ->getMock();
        $categoria->method('getDescricao')
                  ->willReturn('Descrição do produto 1');

        $this->assertEquals('Descrição do produto 1', $categoria->getDescricao());
    }
    /**
    * @expectedException InvalidArgumentException
    */
    public function testVerificaDescricaoObrigatoria()
    {
        $categoria = $this->getMockBuilder('\n0va1s\QuadroMagico\Entity\CategoriaEntity')
                        ->getMock();
        $categoria->method('setDescricao')
                  ->will($this->throwException(new \InvalidArgumentException));

        $categoria->setDescricao(null);
    }
}
