<?php

namespace n0va1s\QuadroMagico\Entity;

class ProdutoEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaTipoClasse()
    {
        $this->assertInstanceOf("n0va1s\QuadroMagico\Entity\ProdutoEntity", new \JP\Sistema\Entity\ProdutoEntity());
    }

    public function testVerificaGetSet()
    {
        $produto = $this->getMockBuilder('\n0va1s\QuadroMagico\Entity\ProdutoEntity')
                        ->getMock();
        
        $produto->method('getNome')
                ->willReturn('Nome do Produto 1');
        $this->assertEquals('Nome do Produto 1', $produto->getNome());

        $produto->method('getDescricao')
                ->willReturn('Descrição do produto 1');
        $this->assertEquals('Descrição do produto 1', $produto->getDescricao());

        $produto->method('getValor')
                ->willReturn(100.00);
        $this->assertEquals(100.00, $produto->getValor());

        $produto->method('getCategoria')
                ->willReturn(1);
        $this->assertEquals(1, $produto->getCategoria());
    }
    
    /**
    * @expectedException InvalidArgumentException
    */
    public function testVerificaValorInvalido()
    {
        $produto = $this->getMockBuilder('\n0va1s\QuadroMagico\Entity\ProdutoEntity')
                    ->getMock();
        $produto->method('setValor')
                ->will($this->throwException(new \InvalidArgumentException));
        $produto->setValor('ABC');
    }
}
