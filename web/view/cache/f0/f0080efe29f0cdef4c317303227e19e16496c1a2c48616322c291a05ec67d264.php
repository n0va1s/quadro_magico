<?php

/* listaQuadro.twig */
class __TwigTemplate_590ae4c80f8ff27e62a97b5de8f1df3a6aa53ded7c05af1e4cd5dcc7f0b89114 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("leiaute.twig", "listaQuadro.twig", 1);
        $this->blocks = array(
            'titulo' => array($this, 'block_titulo'),
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

    // line 2
    public function block_titulo($context, array $blocks = array())
    {
        echo "Um desejo por semana - Pesquisar Quadros";
    }

    // line 4
    public function block_topo($context, array $blocks = array())
    {
        // line 5
        echo "    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class=\"intro-header\" style=\"background-position: 1% 20%; background-image: url('";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("topo_criancas.png", "img"), "html", null, true);
        echo "')\">
        <div class=\"container\" style=\"background-color: rgb(0, 0, 0); opacity: 0.5; width: 100%; height: 100%;\">
            <div class=\"row\">
                <div class=\"col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0\">
                    <div class=\"site-heading\">
                        <h1>Um desejo por semana</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
";
    }

    // line 20
    public function block_conteudo($context, array $blocks = array())
    {
        // line 21
        echo "    <!-- Main Content -->
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2\">
                <form name=\"frmListaQuadro\" action=\"";
        // line 25
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("quadroListar");
        echo "\" method=\"POST\">
                    <h4>Encontre o seu(s) quadro(s)</h4>
                    <div class=\"form-group col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10\">
                        <label for=\"email\" class=\"sr-only\">Email</label>
                        <input type=\"email\" name=\"email\" class=\"form-control col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10\" laceholder=\"Informe seu email\" required data-validation-required-message=\"Qual o seu email?\">
                    </div>
                    <div>&nbsp;</div>
                    <center><button class=\"btn btn-primary\" type=\"submit\">Consultar</button></center>
                </form>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1\">
                ";
        // line 38
        if (array_key_exists("quadros", $context)) {
            // line 39
            echo "                    ";
            if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["quadros"] ?? null), "mensagem", array(), "any", true, true)) {
                // line 40
                echo "                        <div class=\"post-preview\">
                        <br /><p class=\"post-meta\" align=\"center\">";
                // line 41
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["quadros"]) || array_key_exists("quadros", $context) ? $context["quadros"] : (function () { throw new Twig_Error_Runtime('Variable "quadros" does not exist.', 41, $this->getSourceContext()); })()), "mensagem", array()), "html", null, true);
                echo "</p>
                        </div>
                    ";
            } else {
                // line 44
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
                                            <th><center>Excluir quadro</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ";
                // line 58
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["quadros"]) || array_key_exists("quadros", $context) ? $context["quadros"] : (function () { throw new Twig_Error_Runtime('Variable "quadros" does not exist.', 58, $this->getSourceContext()); })()));
                foreach ($context['_seq'] as $context["_key"] => $context["quadro"]) {
                    // line 59
                    echo "                                        <tr>
                                            <td><span>";
                    // line 60
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["quadro"], "tipo", array()), "html", null, true);
                    echo "</span></td>
                                            <td><span>";
                    // line 61
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["quadro"], "crianca", array()), "html", null, true);
                    echo "</span></td>
                                            <td><center><a href=";
                    // line 62
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 62, $this->getSourceContext()); })()), "url_generator", array()), "generate", array(0 => "quadroExibir", 1 => array("codigo" => twig_get_attribute($this->env, $this->getSourceContext(), $context["quadro"], "codigo", array()))), "method"), "html", null, true);
                    echo "><span class=\"glyphicon glyphicon-folder-open\"></span></a></center></td>
                                            <td><center><a href=\"";
                    // line 63
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("atividadeCadastrar", array("codigo" => twig_get_attribute($this->env, $this->getSourceContext(), $context["quadro"], "codigo", array()))), "html", null, true);
                    echo "\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center></td>
                                            <td><center><a href=\"";
                    // line 64
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("quadroDuplicar", array("codigo" => twig_get_attribute($this->env, $this->getSourceContext(), $context["quadro"], "codigo", array()))), "html", null, true);
                    echo "\"><span class=\"glyphicon glyphicon-plus\"></span></a></center></td>
                                            <td><center><a href=\"";
                    // line 65
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("quadroExcluir", array("codigo" => twig_get_attribute($this->env, $this->getSourceContext(), $context["quadro"], "codigo", array()))), "html", null, true);
                    echo "\"><span class=\"glyphicon glyphicon-remove\"></span></a></center></td>
                                        </tr>
                                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quadro'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 68
                echo "                                    </tbody>
                                </table>
                            </div>
                        </div>                        
                    ";
            }
            // line 73
            echo "                ";
        }
        // line 74
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
        return array (  160 => 74,  157 => 73,  150 => 68,  141 => 65,  137 => 64,  133 => 63,  129 => 62,  125 => 61,  121 => 60,  118 => 59,  114 => 58,  98 => 44,  92 => 41,  89 => 40,  86 => 39,  84 => 38,  68 => 25,  62 => 21,  59 => 20,  43 => 7,  39 => 5,  36 => 4,  30 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'leiaute.twig' %}
{% block titulo %}Um desejo por semana - Pesquisar Quadros{% endblock %}

{% block topo %}
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class=\"intro-header\" style=\"background-position: 1% 20%; background-image: url('{{ asset('topo_criancas.png', 'img') }}')\">
        <div class=\"container\" style=\"background-color: rgb(0, 0, 0); opacity: 0.5; width: 100%; height: 100%;\">
            <div class=\"row\">
                <div class=\"col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0\">
                    <div class=\"site-heading\">
                        <h1>Um desejo por semana</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
{% endblock %}

{% block conteudo %}
    <!-- Main Content -->
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2\">
                <form name=\"frmListaQuadro\" action=\"{{ path('quadroListar')}}\" method=\"POST\">
                    <h4>Encontre o seu(s) quadro(s)</h4>
                    <div class=\"form-group col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10\">
                        <label for=\"email\" class=\"sr-only\">Email</label>
                        <input type=\"email\" name=\"email\" class=\"form-control col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10\" laceholder=\"Informe seu email\" required data-validation-required-message=\"Qual o seu email?\">
                    </div>
                    <div>&nbsp;</div>
                    <center><button class=\"btn btn-primary\" type=\"submit\">Consultar</button></center>
                </form>
            </div>
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
                                            <th><center>Excluir quadro</center></th>
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
                                            <td><center><a href=\"{{ path('quadroExcluir',{'codigo':quadro.codigo})}}\"><span class=\"glyphicon glyphicon-remove\"></span></a></center></td>
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
", "listaQuadro.twig", "/home/novais/public-html/quadro_magico/web/view/listaQuadro.twig");
    }
}
