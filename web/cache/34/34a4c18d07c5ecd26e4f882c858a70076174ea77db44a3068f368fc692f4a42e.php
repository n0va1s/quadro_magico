<?php

/* cadastroQuadro.twig */
class __TwigTemplate_f69310eedaa2e57d25cfec7058bd3d6ff24b7b583b14a306e9fa38316eadf9a8 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("leiaute.twig", "cadastroQuadro.twig", 1);
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
            <div class=\"row\">
                <div class=\"col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0\">
                    <div class=\"site-heading\">
                        <h1>BrinqueCoin</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
";
    }

    // line 19
    public function block_conteudo($context, array $blocks = array())
    {
        // line 20
        echo "    <!-- Main Content -->
    <div class=\"container\">
        <div class=\"row col-sm-8 col-sm-offset-2\">
            <header>
                <h2><span class=\"fa fa-trophy\" aria-hidden=\"true\"></span>&nbsp;Crie seu quadro</h2>
                <small>combinem uma recompensa especial, tá?</small>
            </header>
        </div>
        <div class=\"row col-sm-8 col-sm-offset-2\">
            <form name=\"frmQuadro\" action=\"";
        // line 29
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("quadroSalvar");
        echo "\" method=\"POST\">
                <div class=\"form-group col-sm-2\">
                    <label for=\"tipo\">Quadro</label>
                    <select name=\"tipo\" class=\"form-control\" required data-validation-required-message=\"Que tipo de quadro vc quer?\" autofocus>
                        <option value=\"\" disabled selected>Um quadro de</option>
                        ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tipos"]) || array_key_exists("tipos", $context) ? $context["tipos"] : (function () { throw new Twig_Error_Runtime('Variable "tipos" does not exist.', 34, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            // line 35
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tipo"], "id", array()), "html", null, true);
            echo "\" ";
            if ((array_key_exists("quadro", $context) && (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 35, $this->source); })()), "tipo", array()), "id", array()) == twig_get_attribute($this->env, $this->source, $context["tipo"], "id", array())))) {
                echo " selected ";
            }
            echo ">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tipo"], "descricao", array()), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo " 
                    </select>
                </div>
                <div class=\"form-group col-sm-2\">
                    <label for=\"genero\">Para</label>
                    <select name=\"genero\" class=\"form-control\" required data-validation-required-message=\"É para um menino ou uma menina? Um homem ou uma mulher?\">
                        <option value=\"\" disabled selected>Para</option>
                        <option value=\"M\" ";
        // line 43
        if ((array_key_exists("quadro", $context) && (twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 43, $this->source); })()), "genero", array()) == "M"))) {
            echo " selected ";
        }
        echo ">o</option>
                        <option value=\"F\" ";
        // line 44
        if ((array_key_exists("quadro", $context) && (twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 44, $this->source); })()), "genero", array()) == "F"))) {
            echo " selected ";
        }
        echo ">a</option>
                    </select>
                </div>
                <div class=\"form-group col-sm-6\">
                    <label for=\"nome\">Nome</label>
                    <input type=\"text\" name=\"crianca\" class=\"form-control\" placeholder=\"Chamado (a)\" required data-validation-required-message=\"Qual o nome dele ou dela?\" value=\"";
        // line 49
        if (array_key_exists("quadro", $context)) {
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 49, $this->source); })()), "crianca", array()), "html", null, true);
        }
        echo "\">
                </div>
                <div class=\"form-group col-sm-2\">
                    <label for=\"idade\">Idade</label>
                    <input type=\"text\" min=\"3\" name=\"idade\" class=\"form-control\" placeholder=\"10 anos\" required data-validation-required-message=\"Quantos anos ele ou ela tem?\" value=\"";
        // line 53
        if (array_key_exists("quadro", $context)) {
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 53, $this->source); })()), "idade", array()), "html", null, true);
        }
        echo "\">
                </div>
                <div class=\"form-group col-sm-6\">
                    <label for=\"recompensa\">Recompensa</label>
                    <input type=\"text\" name=\"recompensa\" class=\"form-control\" placeholder=\"Qual a recompensa combinada?\" value=\"";
        // line 57
        if (array_key_exists("quadro", $context)) {
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 57, $this->source); })()), "recompensa", array()), "html", null, true);
        }
        echo "\">
                </div>
                <div class=\"form-group col-sm-6\">
                    <label for=\"email\">Email do responsável</label>
                    <input type=\"email\" name=\"email\" class=\"form-control\" placeholder=\"seuemail@provedor.com\" required data-validation-required-message=\"Qual o seu email?\" value=\"";
        // line 61
        if (array_key_exists("quadro", $context)) {
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 61, $this->source); })()), "responsavel", array()), "html", null, true);
        }
        echo "\">
                </div>
                <input type=\"hidden\" name=\"id\" value=\"";
        // line 63
        if (array_key_exists("quadro", $context)) {
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 63, $this->source); })()), "id", array()), "html", null, true);
            echo " ";
        }
        echo "\">
                <div class=\"form-group col-sm-12 text-center\">
                    <button type=\"submit\" class=\"btn btn-primary\">
                        <i class=\"glyphicon glyphicon-ok\"> Criar</i>
                    </button>
                    <button type=\"reset\" class=\"btn btn-default\">
                        <i class=\"glyphicon glyphicon-remove\"> Limpar</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "cadastroQuadro.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 63,  149 => 61,  140 => 57,  131 => 53,  122 => 49,  112 => 44,  106 => 43,  97 => 36,  82 => 35,  78 => 34,  70 => 29,  59 => 20,  56 => 19,  40 => 6,  36 => 4,  33 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'leiaute.twig' %}

{% block topo %}
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class=\"intro-header\" style=\"background-position: 1% 20%; background-image: url('{{ asset('topo_criancas.png', 'img') }}')\">
        <div class=\"container\" style=\"background-color: rgb(0, 0, 0); opacity: 0.5; width: 100%; height: 100%;\">
            <div class=\"row\">
                <div class=\"col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0\">
                    <div class=\"site-heading\">
                        <h1>BrinqueCoin</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
{% endblock %}

{% block conteudo %}
    <!-- Main Content -->
    <div class=\"container\">
        <div class=\"row col-sm-8 col-sm-offset-2\">
            <header>
                <h2><span class=\"fa fa-trophy\" aria-hidden=\"true\"></span>&nbsp;Crie seu quadro</h2>
                <small>combinem uma recompensa especial, tá?</small>
            </header>
        </div>
        <div class=\"row col-sm-8 col-sm-offset-2\">
            <form name=\"frmQuadro\" action=\"{{ path('quadroSalvar')}}\" method=\"POST\">
                <div class=\"form-group col-sm-2\">
                    <label for=\"tipo\">Quadro</label>
                    <select name=\"tipo\" class=\"form-control\" required data-validation-required-message=\"Que tipo de quadro vc quer?\" autofocus>
                        <option value=\"\" disabled selected>Um quadro de</option>
                        {% for tipo in tipos %}
                            <option value=\"{{ tipo.id }}\" {% if quadro is defined and quadro.tipo.id == tipo.id %} selected {% endif %}>{{ tipo.descricao }}</option>
                        {% endfor %} 
                    </select>
                </div>
                <div class=\"form-group col-sm-2\">
                    <label for=\"genero\">Para</label>
                    <select name=\"genero\" class=\"form-control\" required data-validation-required-message=\"É para um menino ou uma menina? Um homem ou uma mulher?\">
                        <option value=\"\" disabled selected>Para</option>
                        <option value=\"M\" {% if quadro is defined and quadro.genero == 'M' %} selected {% endif %}>o</option>
                        <option value=\"F\" {% if quadro is defined and quadro.genero == 'F' %} selected {% endif %}>a</option>
                    </select>
                </div>
                <div class=\"form-group col-sm-6\">
                    <label for=\"nome\">Nome</label>
                    <input type=\"text\" name=\"crianca\" class=\"form-control\" placeholder=\"Chamado (a)\" required data-validation-required-message=\"Qual o nome dele ou dela?\" value=\"{% if quadro is defined %}{{ quadro.crianca }}{% endif %}\">
                </div>
                <div class=\"form-group col-sm-2\">
                    <label for=\"idade\">Idade</label>
                    <input type=\"text\" min=\"3\" name=\"idade\" class=\"form-control\" placeholder=\"10 anos\" required data-validation-required-message=\"Quantos anos ele ou ela tem?\" value=\"{% if quadro is defined %}{{ quadro.idade }}{% endif %}\">
                </div>
                <div class=\"form-group col-sm-6\">
                    <label for=\"recompensa\">Recompensa</label>
                    <input type=\"text\" name=\"recompensa\" class=\"form-control\" placeholder=\"Qual a recompensa combinada?\" value=\"{% if quadro is defined %}{{ quadro.recompensa }}{% endif %}\">
                </div>
                <div class=\"form-group col-sm-6\">
                    <label for=\"email\">Email do responsável</label>
                    <input type=\"email\" name=\"email\" class=\"form-control\" placeholder=\"seuemail@provedor.com\" required data-validation-required-message=\"Qual o seu email?\" value=\"{% if quadro is defined %}{{ quadro.responsavel }}{% endif %}\">
                </div>
                <input type=\"hidden\" name=\"id\" value=\"{% if quadro is defined %} {{ quadro.id }} {% endif %}\">
                <div class=\"form-group col-sm-12 text-center\">
                    <button type=\"submit\" class=\"btn btn-primary\">
                        <i class=\"glyphicon glyphicon-ok\"> Criar</i>
                    </button>
                    <button type=\"reset\" class=\"btn btn-default\">
                        <i class=\"glyphicon glyphicon-remove\"> Limpar</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
{% endblock %}
", "cadastroQuadro.twig", "/home/85236250110/Documentos/trabalho/public-html/quadro_magico/web/view/cadastroQuadro.twig");
    }
}
