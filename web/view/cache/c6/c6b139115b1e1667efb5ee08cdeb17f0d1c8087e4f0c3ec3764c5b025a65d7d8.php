<?php

/* inicio.twig */
class __TwigTemplate_955d07b3dabc89b83fe045e9361e5cc61ca77c0319806e9fed85bb7fafe6d88d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("leiaute.twig", "inicio.twig", 1);
        $this->blocks = array(
            'titulo' => array($this, 'block_titulo'),
            'conteudo' => array($this, 'block_conteudo'),
            'rodape' => array($this, 'block_rodape'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "leiaute.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_titulo($context, array $blocks = array())
    {
        echo "Um desejo por semana - Página Inicial";
    }

    // line 4
    public function block_conteudo($context, array $blocks = array())
    {
        // line 5
        echo "    <!-- Main Content -->
    <div class=\"container\">
        <div class=\"row\">
            <p>Bem-vindo pai, mãe, avô, avó, tio, tia, padrinho, madrinha ...</p><br />
            <div class=\"col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1\" >
                    <h2 class=\"post-title\">O que é \"um desejo por semana\"?</h2>
                    <p class=\"post-meta\">
                        <b>Para pais e mães</b> que buscam desenvolver crianças, jovens e adolescentes confiantes e responsáveis, o
                        \"um desejo por semana\" é um <b>quadro de tarefas</b> diferente, sustentável e fácil de alterar.<br />Esse quadro está no <b>mundo digital</b> deles, possui uma metodologia de trabalho baseada em <b>jogos</b>, facilita a <b>comunicação</b> e permite o <b>acompanhamento mesmo à distância</b>.
                    </p>
                    <p class=\"post-meta\">
                        A criança deve cumprir 70% das atividades propostas pelo responsável para alcançar o <b>desejo da semana</b> que a criança escolheu. Pode ser uma ida ao clube, um passeio no parque, um dia de jogos em casa, ir a uma festa, etc... lembre-se que qualquer mudança leva ao menos 30 dias e que a persistência é a chave para o seu sucesso e o do filhote
                    </p>
                    <h2>Exemplo de quadro</h2>
                    <img src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("quadro.png", "img"), "html", null, true);
        echo "\" alt=\"Como funciona o quadro de tarefas\">
                    <h2>Regras do Jogo</h2>
                    <p class=\"post-meta\">
                    1. Escolha tarefas que corrijam ou aperfeiçoem um comportamento.<br />
                    2. Reserve um horário, antes de dormir, para conversar e preencher o quadro.<br />
                    3. Estabeleça metas semanais e comemore as conquistas. Apresente as consequências também.<br />
                    4. Não ceda às pressões. O adulto é você. Cara feia passa, um mau comportamento pode durar a vida toda.<br />
                    5. A quantidade de tarefas deve ser próxima à idade da criança até o limite de 8 por dia.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
 ";
    }

    // line 35
    public function block_rodape($context, array $blocks = array())
    {
        // line 36
        echo "<footer class=\"intro-header\" style=\"background-image: url(";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("idealizadores.jpg", "img"), "html", null, true);
        echo ")\">
    <div>
        <h2 style=\"color:white; text-align:center\">Os idealizadores</h2>
        <h3 style=\"color:white; text-align:left\">&nbsp;João Paulo,<br />&nbsp;pai do Johny,<br />&nbsp;do Dudu, analista de<br />&nbsp;sistemas e escoteiro</h3>
        <h3 style=\"color:white; text-align:right\">Isabela,&nbsp;<br />mãe da Lena,&nbsp;<br />dançarina e&nbsp;<br />analista de projetos&nbsp;</h3>
    </div>
</footer>
";
    }

    public function getTemplateName()
    {
        return "inicio.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 36,  74 => 35,  55 => 19,  39 => 5,  36 => 4,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'leiaute.twig' %}
{% block titulo %}Um desejo por semana - Página Inicial{% endblock %}

{% block conteudo %}
    <!-- Main Content -->
    <div class=\"container\">
        <div class=\"row\">
            <p>Bem-vindo pai, mãe, avô, avó, tio, tia, padrinho, madrinha ...</p><br />
            <div class=\"col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1\" >
                    <h2 class=\"post-title\">O que é \"um desejo por semana\"?</h2>
                    <p class=\"post-meta\">
                        <b>Para pais e mães</b> que buscam desenvolver crianças, jovens e adolescentes confiantes e responsáveis, o
                        \"um desejo por semana\" é um <b>quadro de tarefas</b> diferente, sustentável e fácil de alterar.<br />Esse quadro está no <b>mundo digital</b> deles, possui uma metodologia de trabalho baseada em <b>jogos</b>, facilita a <b>comunicação</b> e permite o <b>acompanhamento mesmo à distância</b>.
                    </p>
                    <p class=\"post-meta\">
                        A criança deve cumprir 70% das atividades propostas pelo responsável para alcançar o <b>desejo da semana</b> que a criança escolheu. Pode ser uma ida ao clube, um passeio no parque, um dia de jogos em casa, ir a uma festa, etc... lembre-se que qualquer mudança leva ao menos 30 dias e que a persistência é a chave para o seu sucesso e o do filhote
                    </p>
                    <h2>Exemplo de quadro</h2>
                    <img src=\"{{ asset('quadro.png', 'img') }}\" alt=\"Como funciona o quadro de tarefas\">
                    <h2>Regras do Jogo</h2>
                    <p class=\"post-meta\">
                    1. Escolha tarefas que corrijam ou aperfeiçoem um comportamento.<br />
                    2. Reserve um horário, antes de dormir, para conversar e preencher o quadro.<br />
                    3. Estabeleça metas semanais e comemore as conquistas. Apresente as consequências também.<br />
                    4. Não ceda às pressões. O adulto é você. Cara feia passa, um mau comportamento pode durar a vida toda.<br />
                    5. A quantidade de tarefas deve ser próxima à idade da criança até o limite de 8 por dia.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
 {% endblock %}

{% block rodape %}
<footer class=\"intro-header\" style=\"background-image: url({{ asset('idealizadores.jpg', 'img') }})\">
    <div>
        <h2 style=\"color:white; text-align:center\">Os idealizadores</h2>
        <h3 style=\"color:white; text-align:left\">&nbsp;João Paulo,<br />&nbsp;pai do Johny,<br />&nbsp;do Dudu, analista de<br />&nbsp;sistemas e escoteiro</h3>
        <h3 style=\"color:white; text-align:right\">Isabela,&nbsp;<br />mãe da Lena,&nbsp;<br />dançarina e&nbsp;<br />analista de projetos&nbsp;</h3>
    </div>
</footer>
{% endblock %}

", "inicio.twig", "/home/novais/public-html/quadro_magico/web/view/inicio.twig");
    }
}
