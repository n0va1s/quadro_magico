<?php

namespace n0va1s\QuadroMagico\Entity;

class ClienteEntityTest extends \PHPUnit_Framework_TestCase
{
    private $cliente;
    private $foto;

    public function setUp()
    {
        $this->foto = $this->getMockBuilder('Symfony\Component\HttpFoundation\File\UploadedFile')
                           ->enableOriginalConstructor()
                           ->setConstructorArgs([tempnam(sys_get_temp_dir(), ''), 'arquivo'])
                           ->getMock();

        $this->cliente = $this->getMockBuilder('\n0va1s\QuadroMagico\Entity\ClienteEntity')
                              ->getMock();
    }

    public function testVerificaTipoClasse()
    {
        $this->assertInstanceOf("n0va1s\QuadroMagico\Entity\ClienteEntity", new \n0va1s\QuadroMagico\Entity\ClienteEntity());
    }

    public function testVerificaGetSet()
    {
        $this->cliente->method('getNome')
                ->willReturn('João Paulo Cirino Silva de Novais');
        $this->assertEquals('João Paulo Cirino Silva de Novais', $this->cliente->getNome());

        $this->cliente->method('getEmail')
                ->willReturn('jp.trabalho@gmail.com');
        $this->assertEquals('jp.trabalho@gmail.com', $this->cliente->getEmail());
        
        $this->cliente->method('getDataCriacao')
                ->willReturn(new \DateTime());
        $this->assertEquals(new \DateTime(), $this->cliente->getDataCriacao());

        $this->cliente->method('getFoto')
                ->willReturn($this->foto);
        $this->assertInstanceOf("Symfony\Component\HttpFoundation\File\UploadedFile", $this->cliente->getFoto());
    }

    /**
    * @expectedException InvalidArgumentException
    */
    public function testVerificaEmailInvalido()
    {
        $this->cliente->method('setEmail')
                ->will($this->throwException(new \InvalidArgumentException));
        $this->cliente->setEmail("jp.trabalhogmail.com");
    }
}
