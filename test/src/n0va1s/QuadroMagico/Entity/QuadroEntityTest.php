<?php

namespace n0va1s\QuadroMagico\Entity;

class QuadroEntityTest extends \PHPUnit\Framework\TestCase
{
    public function testVerificaTipoClasse()
    {
        $this->assertInstanceOf(
            "n0va1s\QuadroMagico\Entity\QuadroEntity", 
            new \n0va1s\QuadroMagico\Entity\QuadroEntity()
        );
    }

    public function testVerificaGetSet()
    {
        $quadro = $this->getMockBuilder(
            'n0va1s\QuadroMagico\Entity\QuadroEntity'
        )
            ->getMock();
        $tipo = $this->getMockBuilder(
            'n0va1s\QuadroMagico\Entity\TipoQuadroEntity'
        )
            ->getMock();
        
        $quadro->method('getId')->willReturn(1);
        $this->assertEquals(1, $quadro->getId());

        $quadro->method('getResponsavel')->willReturn('jp.pessoal@gmail.com');
        $this->assertEquals('jp.pessoal@gmail.com', $quadro->getResponsavel());

        $quadro->method('getTipo')->willReturn(
            new \n0va1s\QuadroMagico\Entity\TipoQuadroEntity()
        );
        $this->assertEquals(
            new \n0va1s\QuadroMagico\Entity\TipoQuadroEntity(), 
            $quadro->getTipo()
        );
        $quadro->method('getGenero')->willReturn('F');
        $this->assertEquals('F', $quadro->getGenero());

        $quadro->method('getIdade')->willReturn(10);
        $this->assertEquals(10, $quadro->getIdade());

        $quadro->method('getCrianca')->willReturn('Helena');
        $this->assertEquals('Helena', $quadro->getCrianca());

        $quadro->method('getRecompensa')->willReturn('Ir ao clube');
        $this->assertEquals('Ir ao clube', $quadro->getRecompensa());

        $quadro->method('getCodigo')->willReturn('dbf8797e');
        $this->assertEquals('dbf8797e', $quadro->getCodigo());
        
    }

    /**
    * @expectedException InvalidArgumentException
    */
    public function testCamposObrigatorios()
    {
        $quadro = $this->getMockBuilder(
            'n0va1s\QuadroMagico\Entity\QuadroEntity'
        )
            ->getMock();
        $quadro->method('setId')->will(
            $this->throwException(new \InvalidArgumentException)
        );
        $quadro->setId(null);
        $quadro->method('setTipo')->will(
            $this->throwException(new \InvalidArgumentException)
        );
        $quadro->setTipo(null);
        $quadro->method('setGenero')->will(
            $this->throwException(new \InvalidArgumentException)
        );
        $quadro->setGenero(null);
        $quadro->method('setIdade')->will(
            $this->throwException(new \InvalidArgumentException)
        );
        $quadro->setIdade(null);
        $quadro->method('setCriacao')->will(
            $this->throwException(new \InvalidArgumentException)
        );
        $quadro->setCrianca(null);
        $quadro->method('setResponsavel')->will(
            $this->throwException(new \InvalidArgumentException)
        );
        $quadro->setResponsavel(null);
    }
    
    /**
    * @expectedException InvalidArgumentException
    */
    public function testEmailInvalido()
    {
        $quadro = $this->getMockBuilder(
            'n0va1s\QuadroMagico\Entity\QuadroEntity'
        )
            ->getMock();
        $quadro->method('setResponsavel')->will(
            $this->throwException(new \InvalidArgumentException)
        );
        $quadro->setResponsavel('Teste');
    }
}
