<?php

/* exibeQuadro.twig */
class __TwigTemplate_fe76ded46d910bbfe596bb22499e9091fa7c2189a204565c248c4025c6f87555 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("leiaute.twig", "exibeQuadro.twig", 1);
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
    <header class=\"intro-header\" style=\"background-position: 1% 10%; background-image: url('";
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
        <input type=\"hidden\" id=\"tipo\" value=\"";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["tipo"]) || array_key_exists("tipo", $context) ? $context["tipo"] : (function () { throw new Twig_Error_Runtime('Variable "tipo" does not exist.', 22, $this->source); })()), "codigo", array()), "html", null, true);
        echo "\">
        <div class=\"row\">
            ";
        // line 24
        if ((twig_get_attribute($this->env, $this->source, (isset($context["tipo"]) || array_key_exists("tipo", $context) ? $context["tipo"] : (function () { throw new Twig_Error_Runtime('Variable "tipo" does not exist.', 24, $this->source); })()), "codigo", array()) == "T")) {
            // line 25
            echo "            <p>Oi <b>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 25, $this->source); })()), "crianca", array()), "html", null, true);
            echo "</b>, vc conquistou ";
            echo twig_escape_filter($this->env, (isset($context["real"]) || array_key_exists("real", $context) ? $context["real"] : (function () { throw new Twig_Error_Runtime('Variable "real" does not exist.', 25, $this->source); })()), "html", null, true);
            echo " dos ";
            echo twig_escape_filter($this->env, (isset($context["prev"]) || array_key_exists("prev", $context) ? $context["prev"] : (function () { throw new Twig_Error_Runtime('Variable "prev" does not exist.', 25, $this->source); })()), "html", null, true);
            echo " pontos (";
            echo twig_escape_filter($this->env, (isset($context["perc"]) || array_key_exists("perc", $context) ? $context["perc"] : (function () { throw new Twig_Error_Runtime('Variable "perc" does not exist.', 25, $this->source); })()), "html", null, true);
            echo "%) para <b>";
            echo twig_escape_filter($this->env, twig_lower_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 25, $this->source); })()), "recompensa", array())), "html", null, true);
            echo "</b></p>
            ";
        } elseif ((twig_get_attribute($this->env, $this->source,         // line 26
(isset($context["tipo"]) || array_key_exists("tipo", $context) ? $context["tipo"] : (function () { throw new Twig_Error_Runtime('Variable "tipo" does not exist.', 26, $this->source); })()), "codigo", array()) == "M")) {
            // line 27
            echo "            <p>Oi <b>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 27, $this->source); })()), "crianca", array()), "html", null, true);
            echo "</b>, vc conquistou ";
            echo twig_escape_filter($this->env, (isset($context["mesada"]) || array_key_exists("mesada", $context) ? $context["mesada"] : (function () { throw new Twig_Error_Runtime('Variable "mesada" does not exist.', 27, $this->source); })()), "html", null, true);
            echo " reais de mesada!</p>
            ";
        } elseif ((twig_get_attribute($this->env, $this->source,         // line 28
(isset($context["tipo"]) || array_key_exists("tipo", $context) ? $context["tipo"] : (function () { throw new Twig_Error_Runtime('Variable "tipo" does not exist.', 28, $this->source); })()), "codigo", array()) == "F")) {
            // line 29
            echo "            <p>Oi <b>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 29, $this->source); })()), "crianca", array()), "html", null, true);
            echo "</b>, faça o seu melhor possível para <b>";
            echo twig_escape_filter($this->env, twig_lower_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 29, $this->source); })()), "recompensa", array())), "html", null, true);
            echo "</b></p>
            ";
        } else {
            // line 31
            echo "            <p>Oi <b>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["quadro"]) || array_key_exists("quadro", $context) ? $context["quadro"] : (function () { throw new Twig_Error_Runtime('Variable "quadro" does not exist.', 31, $this->source); })()), "crianca", array()), "html", null, true);
            echo "</b>, vc consegue! #top</b></p>
            ";
        }
        // line 33
        echo "            ";
        if (array_key_exists("atividades", $context)) {
            // line 34
            echo "            <div style=\"overflow: auto; width: 100%; border: 1px;\">
                <table class=\"table table-borded\">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Tarefa</th>
                            ";
            // line 40
            if ((twig_get_attribute($this->env, $this->source, (isset($context["tipo"]) || array_key_exists("tipo", $context) ? $context["tipo"] : (function () { throw new Twig_Error_Runtime('Variable "tipo" does not exist.', 40, $this->source); })()), "codigo", array()) == "M")) {
                // line 41
                echo "                            <th>Valor</th>
                            ";
            }
            // line 43
            echo "                            <th>Seg</th>
                            <th>Ter</th>
                            <th>Qua</th>
                            <th>Qui</th>
                            <th>Sex</th>
                            <th>Sab</th>
                            <th>Dom</th>
                        </tr>
                    </thead>
                    ";
            // line 52
            if (array_key_exists("resultados", $context)) {
                // line 53
                echo "                    <tfoot>
                        ";
                // line 54
                if ((twig_get_attribute($this->env, $this->source, (isset($context["tipo"]) || array_key_exists("tipo", $context) ? $context["tipo"] : (function () { throw new Twig_Error_Runtime('Variable "tipo" does not exist.', 54, $this->source); })()), "codigo", array()) == "T")) {
                    // line 55
                    echo "                        <tr>
                            <th>&nbsp;</th>
                            <th>Pedido especial</th>
                            ";
                    // line 58
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["resultados"]) || array_key_exists("resultados", $context) ? $context["resultados"] : (function () { throw new Twig_Error_Runtime('Variable "resultados" does not exist.', 58, $this->source); })()));
                    foreach ($context['_seq'] as $context["_key"] => $context["resultado"]) {
                        // line 59
                        echo "                                ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($context["resultado"]);
                        foreach ($context['_seq'] as $context["_key"] => $context["dia"]) {
                            // line 60
                            echo "                            <th><span class=\"";
                            echo twig_escape_filter($this->env, $context["dia"], "html", null, true);
                            echo "\"></span></th>
                                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dia'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 62
                        echo "                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['resultado'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 63
                    echo "                        </tr>
                        ";
                } elseif ((twig_get_attribute($this->env, $this->source,                 // line 64
(isset($context["tipo"]) || array_key_exists("tipo", $context) ? $context["tipo"] : (function () { throw new Twig_Error_Runtime('Variable "tipo" does not exist.', 64, $this->source); })()), "codigo", array()) == "M")) {
                    // line 65
                    echo "                        <tr>
                            <th>&nbsp;</th>
                            <th>Mesada</th>
                            <th>&nbsp;</th>
                            ";
                    // line 69
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["resultados"]) || array_key_exists("resultados", $context) ? $context["resultados"] : (function () { throw new Twig_Error_Runtime('Variable "resultados" does not exist.', 69, $this->source); })()));
                    foreach ($context['_seq'] as $context["_key"] => $context["dia"]) {
                        // line 70
                        echo "                            <th>R\$ ";
                        echo twig_escape_filter($this->env, $context["dia"], "html", null, true);
                        echo "</th>
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dia'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 72
                    echo "                        </tr>
                        ";
                } elseif ((twig_get_attribute($this->env, $this->source,                 // line 73
(isset($context["tipo"]) || array_key_exists("tipo", $context) ? $context["tipo"] : (function () { throw new Twig_Error_Runtime('Variable "tipo" does not exist.', 73, $this->source); })()), "codigo", array()) == "F")) {
                    // line 74
                    echo "                        <tr>
                            <th>&nbsp;</th>
                            <th>O dia foi</th>
                            ";
                    // line 77
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["resultados"]) || array_key_exists("resultados", $context) ? $context["resultados"] : (function () { throw new Twig_Error_Runtime('Variable "resultados" does not exist.', 77, $this->source); })()));
                    foreach ($context['_seq'] as $context["_key"] => $context["dia"]) {
                        // line 78
                        echo "                            <th>";
                        echo twig_escape_filter($this->env, $context["dia"], "html", null, true);
                        echo "</th>
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dia'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 80
                    echo "                        </tr>
                        ";
                }
                // line 82
                echo "                    </tfoot>
                    ";
            }
            // line 84
            echo "                    <tbody>
                        ";
            // line 85
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["atividades"]) || array_key_exists("atividades", $context) ? $context["atividades"] : (function () { throw new Twig_Error_Runtime('Variable "atividades" does not exist.', 85, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["atividade"]) {
                // line 86
                echo "                        <tr>
                            ";
                // line 87
                if ( !(null === twig_get_attribute($this->env, $this->source, $context["atividade"], "imagem", array()))) {
                    // line 88
                    echo "                            <td class=\"imagem\"><img src=\"";
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(twig_get_attribute($this->env, $this->source, $context["atividade"], "imagem", array()), "file"), "html", null, true);
                    echo "\"></td>
                            ";
                } else {
                    // line 90
                    echo "                            <td class=\"imagem\"><img></td>
                            ";
                }
                // line 92
                echo "                            <td>";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "atividade", array()), "html", null, true);
                echo "</td>
                            ";
                // line 93
                if ((twig_get_attribute($this->env, $this->source, (isset($context["tipo"]) || array_key_exists("tipo", $context) ? $context["tipo"] : (function () { throw new Twig_Error_Runtime('Variable "tipo" does not exist.', 93, $this->source); })()), "codigo", array()) == "M")) {
                    // line 94
                    echo "                            <td>R\$ ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "valor", array()), "html", null, true);
                    echo "</td>
                            ";
                }
                // line 96
                echo "                            <td class=\"emoji\" id=\"seg_";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "id", array()), "html", null, true);
                echo "\"><span class=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "emoji_segunda", array()), "html", null, true);
                echo "\"></span></td>
                            <td class=\"emoji\" id=\"ter_";
                // line 97
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "id", array()), "html", null, true);
                echo "\"><span class=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "emoji_terca", array()), "html", null, true);
                echo "\"></span></td>
                            <td class=\"emoji\" id=\"qua_";
                // line 98
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "id", array()), "html", null, true);
                echo "\"><span class=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "emoji_quarta", array()), "html", null, true);
                echo "\"></span></td>
                            <td class=\"emoji\" id=\"qui_";
                // line 99
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "id", array()), "html", null, true);
                echo "\"><span class=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "emoji_quinta", array()), "html", null, true);
                echo "\"></span></td>
                            <td class=\"emoji\" id=\"sex_";
                // line 100
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "id", array()), "html", null, true);
                echo "\"><span class=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "emoji_sexta", array()), "html", null, true);
                echo "\"></span></td>
                            <td class=\"emoji\" id=\"sab_";
                // line 101
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "id", array()), "html", null, true);
                echo "\"><span class=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "emoji_sabado", array()), "html", null, true);
                echo "\"></span></td>
                            <td class=\"emoji\" id=\"dom_";
                // line 102
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "id", array()), "html", null, true);
                echo "\"><span class=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atividade"], "emoji_domingo", array()), "html", null, true);
                echo "\"></span></td>
                        </tr>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atividade'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 105
            echo "                    </tbody>
                </table>
            </div>
            ";
        } else {
            // line 109
            echo "            <div class=\"post-preview\">
                <br />
                <p class=\"post-meta\" align=\"center\">Nenhuma atividade cadastrada</p>
            </div>
            ";
        }
        // line 114
        echo "        </div>
        <center>
            <input type=\"submit\" class=\"btn btn-primary\" value=\"Atualizar resultado\" onClick=\"window.location.reload()\">
        <center>
    </div>
";
    }

    // line 121
    public function block_rodape($context, array $blocks = array())
    {
        // line 122
        echo "<footer>
    <div class=\"container\">
        <div class=\"row\" align=\"center\">
            <p>Vc faz parte de uma comunidade com muitas outras crianças, jovens e adolescentes no Brasil e no mundo</p>
        </div>
    </div>
</footer>
";
    }

    public function getTemplateName()
    {
        return "exibeQuadro.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  336 => 122,  333 => 121,  324 => 114,  317 => 109,  311 => 105,  300 => 102,  294 => 101,  288 => 100,  282 => 99,  276 => 98,  270 => 97,  263 => 96,  257 => 94,  255 => 93,  250 => 92,  246 => 90,  240 => 88,  238 => 87,  235 => 86,  231 => 85,  228 => 84,  224 => 82,  220 => 80,  211 => 78,  207 => 77,  202 => 74,  200 => 73,  197 => 72,  188 => 70,  184 => 69,  178 => 65,  176 => 64,  173 => 63,  167 => 62,  158 => 60,  153 => 59,  149 => 58,  144 => 55,  142 => 54,  139 => 53,  137 => 52,  126 => 43,  122 => 41,  120 => 40,  112 => 34,  109 => 33,  103 => 31,  95 => 29,  93 => 28,  86 => 27,  84 => 26,  71 => 25,  69 => 24,  64 => 22,  60 => 20,  57 => 19,  41 => 6,  37 => 4,  34 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'leiaute.twig' %}

{% block topo %}
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class=\"intro-header\" style=\"background-position: 1% 10%; background-image: url('{{ asset('topo_criancas.png', 'img') }}')\">
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
        <input type=\"hidden\" id=\"tipo\" value=\"{{ tipo.codigo }}\">
        <div class=\"row\">
            {% if tipo.codigo == 'T' %}
            <p>Oi <b>{{quadro.crianca}}</b>, vc conquistou {{ real}} dos {{ prev }} pontos ({{ perc }}%) para <b>{{quadro.recompensa|lower}}</b></p>
            {% elseif tipo.codigo == 'M' %}
            <p>Oi <b>{{quadro.crianca}}</b>, vc conquistou {{ mesada }} reais de mesada!</p>
            {% elseif tipo.codigo == 'F' %}
            <p>Oi <b>{{quadro.crianca}}</b>, faça o seu melhor possível para <b>{{quadro.recompensa|lower}}</b></p>
            {% else %}
            <p>Oi <b>{{quadro.crianca}}</b>, vc consegue! #top</b></p>
            {% endif %}
            {% if atividades is defined %}
            <div style=\"overflow: auto; width: 100%; border: 1px;\">
                <table class=\"table table-borded\">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Tarefa</th>
                            {% if tipo.codigo == 'M' %}
                            <th>Valor</th>
                            {% endif %}
                            <th>Seg</th>
                            <th>Ter</th>
                            <th>Qua</th>
                            <th>Qui</th>
                            <th>Sex</th>
                            <th>Sab</th>
                            <th>Dom</th>
                        </tr>
                    </thead>
                    {% if resultados is defined %}
                    <tfoot>
                        {% if tipo.codigo == 'T' %}
                        <tr>
                            <th>&nbsp;</th>
                            <th>Pedido especial</th>
                            {% for resultado in resultados %}
                                {% for dia in resultado %}
                            <th><span class=\"{{ dia }}\"></span></th>
                                {% endfor %}
                            {% endfor %}
                        </tr>
                        {% elseif tipo.codigo == 'M' %}
                        <tr>
                            <th>&nbsp;</th>
                            <th>Mesada</th>
                            <th>&nbsp;</th>
                            {% for dia in resultados %}
                            <th>R\$ {{ dia }}</th>
                            {% endfor %}
                        </tr>
                        {% elseif tipo.codigo == 'F' %}
                        <tr>
                            <th>&nbsp;</th>
                            <th>O dia foi</th>
                            {% for dia in resultados %}
                            <th>{{ dia }}</th>
                            {% endfor %}
                        </tr>
                        {% endif %}
                    </tfoot>
                    {% endif %}
                    <tbody>
                        {% for atividade in atividades %}
                        <tr>
                            {% if atividade.imagem is not null %}
                            <td class=\"imagem\"><img src=\"{{ asset(atividade.imagem, 'file') }}\"></td>
                            {% else %}
                            <td class=\"imagem\"><img></td>
                            {% endif %}
                            <td>{{ atividade.atividade}}</td>
                            {% if tipo.codigo == 'M' %}
                            <td>R\$ {{ atividade.valor}}</td>
                            {% endif %}
                            <td class=\"emoji\" id=\"seg_{{ atividade.id }}\"><span class=\"{{ atividade.emoji_segunda }}\"></span></td>
                            <td class=\"emoji\" id=\"ter_{{ atividade.id }}\"><span class=\"{{ atividade.emoji_terca }}\"></span></td>
                            <td class=\"emoji\" id=\"qua_{{ atividade.id }}\"><span class=\"{{ atividade.emoji_quarta }}\"></span></td>
                            <td class=\"emoji\" id=\"qui_{{ atividade.id }}\"><span class=\"{{ atividade.emoji_quinta }}\"></span></td>
                            <td class=\"emoji\" id=\"sex_{{ atividade.id }}\"><span class=\"{{ atividade.emoji_sexta }}\"></span></td>
                            <td class=\"emoji\" id=\"sab_{{ atividade.id }}\"><span class=\"{{ atividade.emoji_sabado }}\"></span></td>
                            <td class=\"emoji\" id=\"dom_{{ atividade.id }}\"><span class=\"{{ atividade.emoji_domingo }}\"></span></td>
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
        <center>
            <input type=\"submit\" class=\"btn btn-primary\" value=\"Atualizar resultado\" onClick=\"window.location.reload()\">
        <center>
    </div>
{% endblock %}

{% block rodape %}
<footer>
    <div class=\"container\">
        <div class=\"row\" align=\"center\">
            <p>Vc faz parte de uma comunidade com muitas outras crianças, jovens e adolescentes no Brasil e no mundo</p>
        </div>
    </div>
</footer>
{% endblock %}
", "exibeQuadro.twig", "/home/85236250110/Documentos/trabalho/public-html/quadro_magico/web/view/exibeQuadro.twig");
    }
}
