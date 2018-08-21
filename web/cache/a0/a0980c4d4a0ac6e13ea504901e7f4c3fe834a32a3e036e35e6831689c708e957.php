<?php

/* listaQuadro.twig */
class __TwigTemplate_75820e5ef26725ef05e943449a04f5a4c44177898770dc499630046677cc5db7 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("leiaute.twig", "listaQuadro.twig", 1);
        $this->blocks = array(
            'topo' => array($this, 'block_topo'),
            'conteudo' => array($this, 'block_conteudo'),
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

    // line 3
    public function block_topo($context, array $blocks = array())
    {
        // line 4
        echo "    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class=\"intro-header\" style=\"background-position: 1% 20%; background-image: url('";
        // line 6
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("topo_criancas.png", "img"), "html", null, true);
        echo "')\">
        <div class=\"container\" style=\"background-color: rgb(0, 0, 0); opacity: 0.5; width: 100%; height: 100%;\">
            <div class=\"row site-heading col-sm-12\">
                <h1>BrinqueCoin</h1>
            </div>
        </div>
    </header>
";
    }

    // line 15
    public function block_conteudo($context, array $blocks = array())
    {
        // line 16
        echo "    <!-- Main Content -->
    <div class=\"container\">
        <div class=\"row col-sm-8 col-sm-offset-2\">
            <header>
                <h2><span class=\"fa fa-search\" aria-hidden=\"true\"></span>&nbsp;Encontre seu quadro</h2>
                <small>veja ações disponíveis para o seu quadro</small>
            </header>
        </div>
        <div class=\"row col-sm-8 col-sm-offset-2\">
            <form name=\"frmListaQuadro\" action=\"";
        // line 25
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("quadroListar");
        echo "\" method=\"POST\">
                <div class=\"form-group col-sm-12\">
                    <label for=\"email\" class=\"sr-only\" >Email</label>
                    <input type=\"email\" name=\"email\" class=\"form-control\" placeholder=\"Informe o email cadastrado\" required data-validation-required-message=\"Qual o seu email?\">
                </div>
                <div class=\"form-group col-sm-12 text-center\">
                    <button type=\"submit\" class=\"btn btn-primary\">
                        <i class=\"glyphicon glyphicon-ok\"> Consultar</i>
                    </button>
                    <button type=\"reset\" class=\"btn btn-default\">
                        <i class=\"glyphicon glyphicon-remove\"> Limpar</i>
                    </button>
                </div>
            </form>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1\">
                ";
        // line 42
        if (array_key_exists("quadros", $context)) {
            // line 43
            echo "                    ";
            if (twig_get_attribute($this->env, $this->source, ($context["quadros"] ?? null), "mensagem", array(), "any", true, true)) {
                // line 44
                echo "                        <div class=\"post-preview\">
                        <br /><p class=\"post-meta\" align=\"center\">";
                // line 45
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadros"]) || array_key_exists("quadros", $context) ? $context["quadros"] : (function () { throw new Twig_Error_Runtime('Variable "quadros" does not exist.', 45, $this->source); })()), "mensagem", array()), "html", null, true);
                echo "</p>
                        </div>
                    ";
            } else {
                // line 48
                echo "                        <div class=\"row\" style=\"overflow: auto; width: 100%;\">
                            <div class=\"table table-borded\">
                                <table class=\"table\">
                                    <thead>
                                        <tr>
                                            <th>Quadro</th>
                                            <th>Filho(a)</th>
                                            <th><center>Abrir quadro</center></th>
                                            <th><center>Alterar atividades</center></th>
                                             <th><center>Nova semana</center></th>
                                            <th><center>Fechar quadro</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ";
                // line 62
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["quadros"]) || array_key_exists("quadros", $context) ? $context["quadros"] : (function () { throw new Twig_Error_Runtime('Variable "quadros" does not exist.', 62, $this->source); })()));
                foreach ($context['_seq'] as $context["_key"] => $context["quadro"]) {
                    // line 63
                    echo "                                        <tr>
                                            <td><span>";
                    // line 64
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quadro"], "tipo", array()), "html", null, true);
                    echo "</span></td>
                                            <td><span>";
                    // line 65
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["quadro"], "crianca", array()), "html", null, true);
                    echo "</span></td>
                                            <td><center><a href=";
                    // line 66
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 66, $this->source); })()), "url_generator", array()), "generate", array(0 => "quadroExibir", 1 => array("codigo" => twig_get_attribute($this->env, $this->source, $context["quadro"], "codigo", array()))), "method"), "html", null, true);
                    echo "><span class=\"glyphicon glyphicon-folder-open\"></span></a></center></td>
                                            <td><center><a href=\"";
                    // line 67
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("atividadeCadastrar", array("codigo" => twig_get_attribute($this->env, $this->source, $context["quadro"], "codigo", array()))), "html", null, true);
                    echo "\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center></td>
                                            <td><center><a href=\"";
                    // line 68
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("quadroDuplicar", array("codigo" => twig_get_attribute($this->env, $this->source, $context["quadro"], "codigo", array()))), "html", null, true);
                    echo "\"><span class=\"glyphicon glyphicon-plus\"></span></a></center></td>
                                            <td><center><a href=\"";
                    // line 69
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("quadroDesativar", array("codigo" => twig_get_attribute($this->env, $this->source, $context["quadro"], "codigo", array()))), "html", null, true);
                    echo "\"><span class=\"glyphicon glyphicon-remove\"></span></a></center></td>
                                        </tr>
                                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quadro'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 72
                echo "                                    </tbody>
                                </table>
                            </div>
                        </div>                        
                    ";
            }
            // line 77
            echo "                ";
        }
        // line 78
        echo "            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "listaQuadro.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 78,  159 => 77,  152 => 72,  143 => 69,  139 => 68,  135 => 67,  131 => 66,  127 => 65,  123 => 64,  120 => 63,  116 => 62,  100 => 48,  94 => 45,  91 => 44,  88 => 43,  86 => 42,  66 => 25,  55 => 16,  52 => 15,  40 => 6,  36 => 4,  33 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'leiaute.twig' %}

{% block topo %}
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class=\"intro-header\" style=\"background-position: 1% 20%; background-image: url('{{ asset('topo_criancas.png', 'img') }}')\">
        <div class=\"container\" style=\"background-color: rgb(0, 0, 0); opacity: 0.5; width: 100%; height: 100%;\">
            <div class=\"row site-heading col-sm-12\">
                <h1>BrinqueCoin</h1>
            </div>
        </div>
    </header>
{% endblock %}

{% block conteudo %}
    <!-- Main Content -->
    <div class=\"container\">
        <div class=\"row col-sm-8 col-sm-offset-2\">
            <header>
                <h2><span class=\"fa fa-search\" aria-hidden=\"true\"></span>&nbsp;Encontre seu quadro</h2>
                <small>veja ações disponíveis para o seu quadro</small>
            </header>
        </div>
        <div class=\"row col-sm-8 col-sm-offset-2\">
            <form name=\"frmListaQuadro\" action=\"{{ path('quadroListar')}}\" method=\"POST\">
                <div class=\"form-group col-sm-12\">
                    <label for=\"email\" class=\"sr-only\" >Email</label>
                    <input type=\"email\" name=\"email\" class=\"form-control\" placeholder=\"Informe o email cadastrado\" required data-validation-required-message=\"Qual o seu email?\">
                </div>
                <div class=\"form-group col-sm-12 text-center\">
                    <button type=\"submit\" class=\"btn btn-primary\">
                        <i class=\"glyphicon glyphicon-ok\"> Consultar</i>
                    </button>
                    <button type=\"reset\" class=\"btn btn-default\">
                        <i class=\"glyphicon glyphicon-remove\"> Limpar</i>
                    </button>
                </div>
            </form>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1\">
                {% if quadros is defined %}
                    {% if quadros.mensagem is defined %}
                        <div class=\"post-preview\">
                        <br /><p class=\"post-meta\" align=\"center\">{{quadros.mensagem}}</p>
                        </div>
                    {% else %}
                        <div class=\"row\" style=\"overflow: auto; width: 100%;\">
                            <div class=\"table table-borded\">
                                <table class=\"table\">
                                    <thead>
                                        <tr>
                                            <th>Quadro</th>
                                            <th>Filho(a)</th>
                                            <th><center>Abrir quadro</center></th>
                                            <th><center>Alterar atividades</center></th>
                                             <th><center>Nova semana</center></th>
                                            <th><center>Fechar quadro</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {% for quadro in quadros %}
                                        <tr>
                                            <td><span>{{quadro.tipo}}</span></td>
                                            <td><span>{{ quadro.crianca }}</span></td>
                                            <td><center><a href={{app.url_generator.generate('quadroExibir', {'codigo':quadro.codigo})}}><span class=\"glyphicon glyphicon-folder-open\"></span></a></center></td>
                                            <td><center><a href=\"{{ path('atividadeCadastrar', {codigo:quadro.codigo})}}\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center></td>
                                            <td><center><a href=\"{{ path('quadroDuplicar', {codigo:quadro.codigo})}}\"><span class=\"glyphicon glyphicon-plus\"></span></a></center></td>
                                            <td><center><a href=\"{{ path('quadroDesativar',{'codigo':quadro.codigo})}}\"><span class=\"glyphicon glyphicon-remove\"></span></a></center></td>
                                        </tr>
                                        {% endfor %}
                                    </tbody>
                                </table>
                            </div>
                        </div>                        
                    {% endif %}
                {% endif %}
            </div>
        </div>
    </div>
{% endblock %}
", "listaQuadro.twig", "/home/85236250110/Documentos/trabalho/public-html/quadro_magico/web/view/listaQuadro.twig");
    }
}
