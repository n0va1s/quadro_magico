<?php

/* cadastroAtividade.twig */
class __TwigTemplate_26f0129ab42c9dc7b1712f76ab0cb99c54e6a4d6731259a2d62a94da5b7bf458 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("leiaute.twig", "cadastroAtividade.twig", 1);
        $this->blocks = array(
            'topo' => array($this, 'block_topo'),
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
                <h2><span class=\"fa fa-trophy\" aria-hidden=\"true\"></span>&nbsp; Cadastre as atividades do jogo</h2>
                <small>vamos desafiar ";
        // line 25
        if (array_key_exists("quadro", $context)) {
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 25, $this->source); })()), "crianca", array()), "html", null, true);
            echo "?";
        }
        echo "</small>
            </header>
        </div>
        <div class=\"row col-sm-8 col-sm-offset-2\">
            <form name=\"frmAtividade\" action=\"";
        // line 29
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("atividadeSalvar");
        echo "\" method=\"POST\">
                <div class=\"form-group col-sm-4\">
                    <label for=\"atividade\">Atividade</label>
                    <input type=\"text\" name=\"atividade\" class=\"form-control\" placeholder=\"Escovar os dentes\" autofocus required 
                    data-validation-required-message=\"Qual a atividade?\">
                </div>
                <div class=\"form-group col-sm-2\">
                    <label for=\"valor\">Valor</label>
                    <input type=\"text\" name=\"valor\" class=\"form-control\" placeholder=\"Pontos ou \$?\">
                </div>
                <div class=\"form-group col-sm-2\">
                    <label for=\"proposito\">Propósito</label>
                    <select name=\"proposito\" class=\"form-control\" required data-validation-required-message=\"O que vc quer trabalhar com esta atividade?\">
                        <option value=\"\" disabled selected>Propósito</option>
                        <option value=\"E\">Escola</option>
                        <option value=\"H\">Higiene</option>
                        <option value=\"C\">Comportamento</option>
                        <option value=\"A\">Autonomia</option>
                        <option value=\"D\">Casa</option>
                        <option value=\"F\">Exercício</option>
                        <option value=\"R\">Refeição</option>
                        <option value=\"I\">Espiritualidade</option>
                        <option value=\"M\">Meu momento</option>
                        <option value=\"W\">Nosso momento</option>
                        <option value=\"T\">Tarefas das família</option>
                        <option value=\"G\">Momentos cinza</option>
                    </select>
                </div>
                <div class=\"form-group col-sm-4\">
                    <label for=\"imagem\">Imagem</label>
                    <input type=\"file\" name=\"imagem\" id=\"imagem\" class=\"form-control col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8\">
                </div>
                <input type=\"hidden\" name=\"quadro\" value=\"";
        // line 61
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 61, $this->source); })()), "id", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"codigo\" value=\"";
        // line 62
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 62, $this->source); })()), "codigo", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"crianca\" value=\"";
        // line 63
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 63, $this->source); })()), "crianca", array()), "html", null, true);
        echo "\">
                <div class=\"form-group col-sm-12 text-center\">
                    <button type=\"submit\" class=\"btn btn-primary\">
                        <i class=\"glyphicon glyphicon-ok\"> Salvar</i>
                    </button>
                    <button type=\"reset\" class=\"btn btn-default\">
                        <i class=\"glyphicon glyphicon-remove\"> Limpar</i>
                    </button>
                    <a href=\"";
        // line 71
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 71, $this->source); })()), "url_generator", array()), "generate", array(0 => "quadroExibir", 1 => array("codigo" => twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 71, $this->source); })()), "codigo", array()))), "method"), "html", null, true);
        echo "\">
                    <button type=\"submit\" class=\"btn btn-warning\">
                        <i class=\"glyphicon glyphicon-folder-open\"></i>&nbsp;Ver o quadro
                    </button>
                    </a>
                </div>
            </form>
        </div>
        <div class=\"row col-sm-8 col-sm-offset-2\">
            ";
        // line 80
        if (array_key_exists("atividades", $context)) {
            // line 81
            echo "            <div class=\"table-responsive\">
                <table class=\"table\">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Propósito</th>
                            <th>Tarefa</th>
                            <th class=\"text-center\">Valor</th>
                            <th class=\"text-center\">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
            // line 93
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["atividades"]) || array_key_exists("atividades", $context) ? $context["atividades"] : (function () { throw new Twig_Error_Runtime('Variable "atividades" does not exist.', 93, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["atividade"]) {
                // line 94
                echo "                        <tr>
                            ";
                // line 95
                if ( !(null === twig_get_attribute($this->env, $this->source, $context["atividade"], "imagem", array()))) {
                    // line 96
                    echo "                            <td><img class=\"imagem\" src=\"";
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(twig_get_attribute($this->env, $this->source, $context["atividade"], "imagem", array()), "file"), "html", null, true);
                    echo "\"></td>
                            ";
                } else {
                    // line 98
                    echo "                            <td>&nbsp;</td>
                            ";
                }
                // line 100
                echo "                            ";
                if ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "E")) {
                    echo " ";
                    $context["proposito"] = "Escola";
                    // line 101
                    echo "                            ";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "H")) {
                    echo " ";
                    $context["proposito"] = "Higiene";
                    // line 102
                    echo "                            ";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "C")) {
                    echo " ";
                    $context["proposito"] = "Comportamento";
                    // line 103
                    echo "                            ";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "A")) {
                    echo " ";
                    $context["proposito"] = "Autonomia";
                    // line 104
                    echo "                            ";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "D")) {
                    echo " ";
                    $context["proposito"] = "Casa";
                    // line 105
                    echo "                            ";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "F")) {
                    echo " ";
                    $context["proposito"] = "Exercício";
                    // line 106
                    echo "                            ";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "R")) {
                    echo " ";
                    $context["proposito"] = "Refeição";
                    // line 107
                    echo "                            ";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "I")) {
                    echo " ";
                    $context["proposito"] = "Espiritualidade";
                    // line 108
                    echo "                            ";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "M")) {
                    echo " ";
                    $context["proposito"] = "Meu momento";
                    // line 109
                    echo "                            ";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "W")) {
                    echo " ";
                    $context["proposito"] = "Nosso momento";
                    // line 110
                    echo "                            ";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "T")) {
                    echo " ";
                    $context["proposito"] = "Tarefas da família";
                    // line 111
                    echo "                            ";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["atividade"], "proposito", array()) == "G")) {
                    echo " ";
                    $context["proposito"] = "Momentos cinza";
                    // line 112
                    echo "                            ";
                }
                // line 113
                echo "                            <td>";
                echo twig_escape_filter($this->env, (isset($context["proposito"]) || array_key_exists("proposito", $context) ? $context["proposito"] : (function () { throw new Twig_Error_Runtime('Variable "proposito" does not exist.', 113, $this->source); })()), "html", null, true);
                echo "</td>
                            <td>";
                // line 114
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "atividade", array()), "html", null, true);
                echo "</td>
                            <td class=\"text-center\">";
                // line 115
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "valor", array()), "html", null, true);
                echo "</td>
                            <td class=\"text-center\"><a href=\"";
                // line 116
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("atividadeExcluir", array("id" => twig_get_attribute($this->env, $this->source, $context["atividade"], "id", array()))), "html", null, true);
                echo "\"><span class=\"glyphicon glyphicon-remove\">&nbsp;</span></a></td>
                        </tr>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atividade'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 119
            echo "                    </tbody>
                </table>
            </div>
            ";
        } else {
            // line 123
            echo "            <div class=\"post-preview\">
                <br />
                <p class=\"post-meta\" align=\"center\">Nenhuma atividade cadastrada</p>
            </div>
            ";
        }
        // line 128
        echo "        </div>
    </div>
";
    }

    // line 132
    public function block_rodape($context, array $blocks = array())
    {
        // line 133
        echo "<footer>
    <div class=\"container\">
        <div class=\"row text-center\">
            <p>Quer dicas de atividades? Veja nossa seção de <b><a href=\"";
        // line 136
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("indexDica");
        echo "\">dicas</a></b></p>
        </div>
    </div>
</footer>
";
    }

    public function getTemplateName()
    {
        return "cadastroAtividade.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  291 => 136,  286 => 133,  283 => 132,  277 => 128,  270 => 123,  264 => 119,  255 => 116,  251 => 115,  247 => 114,  242 => 113,  239 => 112,  234 => 111,  229 => 110,  224 => 109,  219 => 108,  214 => 107,  209 => 106,  204 => 105,  199 => 104,  194 => 103,  189 => 102,  184 => 101,  179 => 100,  175 => 98,  169 => 96,  167 => 95,  164 => 94,  160 => 93,  146 => 81,  144 => 80,  132 => 71,  121 => 63,  117 => 62,  113 => 61,  78 => 29,  67 => 25,  60 => 20,  57 => 19,  41 => 6,  37 => 4,  34 => 3,  15 => 1,);
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
                <h2><span class=\"fa fa-trophy\" aria-hidden=\"true\"></span>&nbsp; Cadastre as atividades do jogo</h2>
                <small>vamos desafiar {% if quadro is defined %} {{ quadro.crianca }}?{% endif %}</small>
            </header>
        </div>
        <div class=\"row col-sm-8 col-sm-offset-2\">
            <form name=\"frmAtividade\" action=\"{{ path('atividadeSalvar')}}\" method=\"POST\">
                <div class=\"form-group col-sm-4\">
                    <label for=\"atividade\">Atividade</label>
                    <input type=\"text\" name=\"atividade\" class=\"form-control\" placeholder=\"Escovar os dentes\" autofocus required 
                    data-validation-required-message=\"Qual a atividade?\">
                </div>
                <div class=\"form-group col-sm-2\">
                    <label for=\"valor\">Valor</label>
                    <input type=\"text\" name=\"valor\" class=\"form-control\" placeholder=\"Pontos ou \$?\">
                </div>
                <div class=\"form-group col-sm-2\">
                    <label for=\"proposito\">Propósito</label>
                    <select name=\"proposito\" class=\"form-control\" required data-validation-required-message=\"O que vc quer trabalhar com esta atividade?\">
                        <option value=\"\" disabled selected>Propósito</option>
                        <option value=\"E\">Escola</option>
                        <option value=\"H\">Higiene</option>
                        <option value=\"C\">Comportamento</option>
                        <option value=\"A\">Autonomia</option>
                        <option value=\"D\">Casa</option>
                        <option value=\"F\">Exercício</option>
                        <option value=\"R\">Refeição</option>
                        <option value=\"I\">Espiritualidade</option>
                        <option value=\"M\">Meu momento</option>
                        <option value=\"W\">Nosso momento</option>
                        <option value=\"T\">Tarefas das família</option>
                        <option value=\"G\">Momentos cinza</option>
                    </select>
                </div>
                <div class=\"form-group col-sm-4\">
                    <label for=\"imagem\">Imagem</label>
                    <input type=\"file\" name=\"imagem\" id=\"imagem\" class=\"form-control col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8\">
                </div>
                <input type=\"hidden\" name=\"quadro\" value=\"{{ quadro.id }}\">
                <input type=\"hidden\" name=\"codigo\" value=\"{{ quadro.codigo }}\">
                <input type=\"hidden\" name=\"crianca\" value=\"{{ quadro.crianca }}\">
                <div class=\"form-group col-sm-12 text-center\">
                    <button type=\"submit\" class=\"btn btn-primary\">
                        <i class=\"glyphicon glyphicon-ok\"> Salvar</i>
                    </button>
                    <button type=\"reset\" class=\"btn btn-default\">
                        <i class=\"glyphicon glyphicon-remove\"> Limpar</i>
                    </button>
                    <a href=\"{{app.url_generator.generate('quadroExibir', {'codigo':quadro.codigo})}}\">
                    <button type=\"submit\" class=\"btn btn-warning\">
                        <i class=\"glyphicon glyphicon-folder-open\"></i>&nbsp;Ver o quadro
                    </button>
                    </a>
                </div>
            </form>
        </div>
        <div class=\"row col-sm-8 col-sm-offset-2\">
            {% if atividades is defined %}
            <div class=\"table-responsive\">
                <table class=\"table\">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Propósito</th>
                            <th>Tarefa</th>
                            <th class=\"text-center\">Valor</th>
                            <th class=\"text-center\">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for atividade in atividades %}
                        <tr>
                            {% if atividade.imagem is not null %}
                            <td><img class=\"imagem\" src=\"{{ asset(atividade.imagem, 'file') }}\"></td>
                            {% else %}
                            <td>&nbsp;</td>
                            {% endif %}
                            {% if atividade.proposito == 'E' %} {% set proposito = 'Escola' %}
                            {% elseif atividade.proposito == 'H' %} {% set proposito = 'Higiene' %}
                            {% elseif atividade.proposito == 'C' %} {% set proposito = 'Comportamento' %}
                            {% elseif atividade.proposito == 'A' %} {% set proposito = 'Autonomia' %}
                            {% elseif atividade.proposito == 'D' %} {% set proposito = 'Casa' %}
                            {% elseif atividade.proposito == 'F' %} {% set proposito = 'Exercício' %}
                            {% elseif atividade.proposito == 'R' %} {% set proposito = 'Refeição' %}
                            {% elseif atividade.proposito == 'I' %} {% set proposito = 'Espiritualidade' %}
                            {% elseif atividade.proposito == 'M' %} {% set proposito = 'Meu momento' %}
                            {% elseif atividade.proposito == 'W' %} {% set proposito = 'Nosso momento' %}
                            {% elseif atividade.proposito == 'T' %} {% set proposito = 'Tarefas da família' %}
                            {% elseif atividade.proposito == 'G' %} {% set proposito = 'Momentos cinza' %}
                            {% endif %}
                            <td>{{ proposito }}</td>
                            <td>{{ atividade.atividade }}</td>
                            <td class=\"text-center\">{{ atividade.valor }}</td>
                            <td class=\"text-center\"><a href=\"{{ path('atividadeExcluir',{id:atividade.id})}}\"><span class=\"glyphicon glyphicon-remove\">&nbsp;</span></a></td>
                        </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
            {% else %}
            <div class=\"post-preview\">
                <br />
                <p class=\"post-meta\" align=\"center\">Nenhuma atividade cadastrada</p>
            </div>
            {% endif %}
        </div>
    </div>
{% endblock %}

{% block rodape %}
<footer>
    <div class=\"container\">
        <div class=\"row text-center\">
            <p>Quer dicas de atividades? Veja nossa seção de <b><a href=\"{{ path('indexDica')}}\">dicas</a></b></p>
        </div>
    </div>
</footer>
{% endblock %}
", "cadastroAtividade.twig", "/home/85236250110/Documentos/trabalho/public-html/quadro_magico/web/view/cadastroAtividade.twig");
    }
}
