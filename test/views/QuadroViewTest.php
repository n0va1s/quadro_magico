<?php

namespace views;

class QuadroViewTest extends \PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        //$this->setHost('localhost');
        //$this->setPort(4444);
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost:8888/quadro');
    }

    public function dadosValidos()
    {
        $dados[] = [
            [
                'responsavel'   => 'jp.pessoal@gmail.com',
                'tipo'          => '1',
                'genero'        => 'M',
                'idade'         => '12',
                'crianca'       => 'João Pedro Pires de Novais',
                'recompensa'    => 'Ir ao clube',
            ]
        ];
        return $dados;
    }

    public function dadosInvalidos()
    {
        $dados[] = [
            [
                'responsavel'   => 'José da Silva',
                'tipo'          => '99',
                'genero'        => 'X',
                'idade'         => null,
                'crianca'       => '@Teste',
                'recompensa'    => 'Teste...#$%*',
            ]
        ];
        return $dados;
    }

    public function fillFormAndSubmit(array $dados)
    {
        $form = $this->byId('frmQuadro');
        foreach ($dados as $campo => $valor) {
            $form->byName($campo)->value($valor);
        }
        $form->submit();
    }

    public function testSubmitComResponsavel()
    {
        $this->byName('email')->value('jp.pessoal@gmail.com');
        $this->byId('btnEnviar')->submit();
    }

    /**
    * @dataProvider dadosValidos
    */
    public function testSubmitDadosValidos(array $dados)
    {
        $this->url('/');
        $this->fillFormAndSubmit($dados);

        $content = $this->byTag('body')->text();
        $this->assertEquals('Quadro cadastrado!', $content);
    }

    /**
    * @dataProvider dadosInvalidos
    */
    public function testSubmitDadosInvalidos(array $dados)
    {
        $this->url('/');
        $this->fillFormAndSubmit($dados);
        $errorDiv = $this->byCssSelector('.alert.alert-danger');
        $this->assertEquals('Ops. Algum campo preenchido corretamente.', $errorDiv->text());
    }

    public function tearDown()
    {
        $this->stop();
    }
}
