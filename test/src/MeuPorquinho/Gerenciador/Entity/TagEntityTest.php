<?php

namespace n0va1s\QuadroMagico\Entity;

class TagEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaTipoClasse()
    {
        $this->assertInstanceOf("n0va1s\QuadroMagico\Entity\TagEntity", new \n0va1s\QuadroMagico\Entity\TagEntity());
    }

    public function testVerificaGetSet()
    {
        $tag = $this->getMockBuilder('\n0va1s\QuadroMagico\Entity\TagEntity')
                    ->getMock();
        $tag->method('getDescricao')
            ->willReturn('Descrição da tag 1');
        $this->assertEquals("Descrição da tag 1", $tag->getDescricao());
    }
    /**
    * @expectedException InvalidArgumentException
    */
    public function testVerificaDescricaoObrigatoria()
    {
        $tag = $this->getMockBuilder('\n0va1s\QuadroMagico\Entity\TagEntity')
                    ->getMock();
        $tag->method('setDescricao')
            ->will($this->throwException(new \InvalidArgumentException));
        $tag->setDescricao(null);
    }
}
