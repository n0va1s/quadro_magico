<?php

/* leiaute.twig */
class __TwigTemplate_9a7c827e46557b9422a992a08a7d82e1595937176da5016df75b36b3513dbde5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'titulo' => array($this, 'block_titulo'),
            'topo' => array($this, 'block_topo'),
            'conteudo' => array($this, 'block_conteudo'),
            'rodape' => array($this, 'block_rodape'),
            'contato' => array($this, 'block_contato'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>

    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"Crie quadros de tarefa, de mesada ou de férias para ajudar na arte que é criar filhos entre 4 e 24 anos\">
    <meta name=\"keywords\" content=\"quadrinho, quadro, quadro de tarefa, quadro de tarefas, comportamento, mesada, filhos, filhas, crianças, meninos, meninas, regras, autonomia, jogos\"/>
    <meta name=\"robots\" content=\"index, follow\">
    <meta name=\"author\" content=\"jp.trabalho@gmail.com\">

    <title>";
        // line 13
        $this->displayBlock('titulo', $context, $blocks);
        echo "</title>

    <!-- Bootstrap Core CSS -->
    <!--<link href=\"/web/vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">-->
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">

   <!-- Login CSS -->
   <link href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("login.css", "css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    
    <!-- Theme CSS -->
    <link href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("clean-blog.css", "css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

    <!-- Form CSS -->
    <link href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("form.css", "css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

    <!-- Quadro CSS -->
    <link href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("quadro.css", "css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

    <!-- Custom Fonts -->
    <link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->
</head>
<body>

    <!-- Navigation -->
    <nav class=\"navbar navbar-default navbar-custom navbar-fixed-top\">
        <div class=\"container-fluid\">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class=\"navbar-header page-scroll\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#menu\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    Menu <i class=\"fa fa-bars\"></i>
                </button>
                <a class=\"navbar-brand\" href=\"/\">Início</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class=\"collapse navbar-collapse\" id=\"menu\">
                <ul class=\"nav navbar-nav navbar-right\">
                    <li>
                        <a href=\"";
        // line 60
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 60, $this->getSourceContext()); })()), "url_generator", array()), "generate", array(0 => "indexQuadro"), "method"), "html", null, true);
        echo "\">Quero criar um quadro</a>
                    </li>
                    <li>
                        <a href=\"";
        // line 63
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 63, $this->getSourceContext()); })()), "url_generator", array()), "generate", array(0 => "quadroConsultar"), "method"), "html", null, true);
        echo "\">Meus quadros</a>
                    </li>
                    <li>
                        <a href=\"";
        // line 66
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 66, $this->getSourceContext()); })()), "url_generator", array()), "generate", array(0 => "indexDica"), "method"), "html", null, true);
        echo "\">Dicas</a>
                    </li>
                    <li>
                        <a href=\"";
        // line 69
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 69, $this->getSourceContext()); })()), "url_generator", array()), "generate", array(0 => "indexContato"), "method"), "html", null, true);
        echo "\">Contato</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

";
        // line 78
        $this->displayBlock('topo', $context, $blocks);
        // line 100
        echo "
";
        // line 101
        $this->displayBlock('conteudo', $context, $blocks);
        // line 104
        echo "
";
        // line 105
        $this->displayBlock('rodape', $context, $blocks);
        // line 108
        echo "
";
        // line 109
        $this->displayBlock('contato', $context, $blocks);
        // line 132
        echo "    <!-- jQuery -->
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
    <!--<script src=\"/web/vendor/bootstrap/js/bootstrap.min.js\"></script>-->

    <!-- Contact Form JavaScript -->
    <script src=\"";
        // line 140
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("jqBootstrapValidation.js", "js"), "html", null, true);
        echo "\"></script>

    <!-- Theme JavaScript -->
    <script src=\"";
        // line 143
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("clean-blog.min.js", "js"), "html", null, true);
        echo "\"></script>

    <!-- JavaScript do quadro -->
    <script src=\"";
        // line 146
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("quadro.js", "js"), "html", null, true);
        echo "\"></script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-104095614-1', 'auto');
      ga('send', 'pageview');
    </script>
</body>
</html>";
    }

    // line 13
    public function block_titulo($context, array $blocks = array())
    {
        echo "BrinqueCoin - as moedas da brincadeira";
    }

    // line 78
    public function block_topo($context, array $blocks = array())
    {
        // line 79
        echo "    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class=\"intro-header\" style=\"background-image: url('";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("topo_familia.jpg", "img"), "html", null, true);
        echo "')\">
        <div class=\"container\" style=\"background-color: rgb(0, 0, 0); opacity: 0.5; width: 100%; height: 100%;\">
            <div class=\"row\">
                <div class=\"col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0\">
                    <div class=\"site-heading\">
                        <h1>BrinqueCoin</h1>
                        <hr class=\"small\">
                        <span class=\"subheading\">Jogue com seus filhos, organize a rotina e crie filhos responsáveis, confiantes e felizes</span>
                    </div>
                </div>
            </div>
            <div class=\"row\">
                <center><a href=\"";
        // line 93
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 93, $this->getSourceContext()); })()), "url_generator", array()), "generate", array(0 => "indexQuadro"), "method"), "html", null, true);
        echo "\"><button class=\"btn btn-primary\" type=\"submit\">Crie seu quadro</button></a></center>
                <br />
                <br />
            </div>
        </div>
    </header>
";
    }

    // line 101
    public function block_conteudo($context, array $blocks = array())
    {
        // line 102
        echo "
";
    }

    // line 105
    public function block_rodape($context, array $blocks = array())
    {
        // line 106
        echo "    
";
    }

    // line 109
    public function block_contato($context, array $blocks = array())
    {
        // line 110
        echo "<!-- Footer -->
<footer>
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1\">
                <p class=\"copyright text-muted\">Faça parte da nossa comunidade</p>
                <ul class=\"list-inline text-center\">
                    <li>
                        <a href=\"https://facebook.com/Um-Desejo-Por-Semana-1774391249517839\">
                            <span class=\"fa-stack fa-lg\">
                                <i class=\"fa fa-circle fa-stack-2x\"></i>
                                <i class=\"fa fa-facebook fa-stack-1x fa-inverse\"></i>
                            </span>
                        </a>
                    </li>
                </ul>
                <p class=\"copyright text-muted\">n0va1s 2016</p>
            </div>
        </div>
    </div>
</footer>
";
    }

    public function getTemplateName()
    {
        return "leiaute.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  243 => 110,  240 => 109,  235 => 106,  232 => 105,  227 => 102,  224 => 101,  213 => 93,  198 => 81,  194 => 79,  191 => 78,  185 => 13,  169 => 146,  163 => 143,  157 => 140,  147 => 132,  145 => 109,  142 => 108,  140 => 105,  137 => 104,  135 => 101,  132 => 100,  130 => 78,  118 => 69,  112 => 66,  106 => 63,  100 => 60,  66 => 29,  60 => 26,  54 => 23,  48 => 20,  38 => 13,  24 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"en\">
<head>

    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"Crie quadros de tarefa, de mesada ou de férias para ajudar na arte que é criar filhos entre 4 e 24 anos\">
    <meta name=\"keywords\" content=\"quadrinho, quadro, quadro de tarefa, quadro de tarefas, comportamento, mesada, filhos, filhas, crianças, meninos, meninas, regras, autonomia, jogos\"/>
    <meta name=\"robots\" content=\"index, follow\">
    <meta name=\"author\" content=\"jp.trabalho@gmail.com\">

    <title>{% block titulo %}BrinqueCoin - as moedas da brincadeira{% endblock %}</title>

    <!-- Bootstrap Core CSS -->
    <!--<link href=\"/web/vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">-->
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">

   <!-- Login CSS -->
   <link href=\"{{ asset('login.css', 'css') }}\" rel=\"stylesheet\">
    
    <!-- Theme CSS -->
    <link href=\"{{ asset('clean-blog.css', 'css') }}\" rel=\"stylesheet\">

    <!-- Form CSS -->
    <link href=\"{{ asset('form.css', 'css') }}\" rel=\"stylesheet\">

    <!-- Quadro CSS -->
    <link href=\"{{ asset('quadro.css', 'css') }}\" rel=\"stylesheet\">

    <!-- Custom Fonts -->
    <link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->
</head>
<body>

    <!-- Navigation -->
    <nav class=\"navbar navbar-default navbar-custom navbar-fixed-top\">
        <div class=\"container-fluid\">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class=\"navbar-header page-scroll\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#menu\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    Menu <i class=\"fa fa-bars\"></i>
                </button>
                <a class=\"navbar-brand\" href=\"/\">Início</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class=\"collapse navbar-collapse\" id=\"menu\">
                <ul class=\"nav navbar-nav navbar-right\">
                    <li>
                        <a href=\"{{ app.url_generator.generate('indexQuadro') }}\">Quero criar um quadro</a>
                    </li>
                    <li>
                        <a href=\"{{ app.url_generator.generate('quadroConsultar') }}\">Meus quadros</a>
                    </li>
                    <li>
                        <a href=\"{{ app.url_generator.generate('indexDica') }}\">Dicas</a>
                    </li>
                    <li>
                        <a href=\"{{ app.url_generator.generate('indexContato') }}\">Contato</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

{% block topo %}
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class=\"intro-header\" style=\"background-image: url('{{ asset('topo_familia.jpg', 'img') }}')\">
        <div class=\"container\" style=\"background-color: rgb(0, 0, 0); opacity: 0.5; width: 100%; height: 100%;\">
            <div class=\"row\">
                <div class=\"col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0\">
                    <div class=\"site-heading\">
                        <h1>BrinqueCoin</h1>
                        <hr class=\"small\">
                        <span class=\"subheading\">Jogue com seus filhos, organize a rotina e crie filhos responsáveis, confiantes e felizes</span>
                    </div>
                </div>
            </div>
            <div class=\"row\">
                <center><a href=\"{{ app.url_generator.generate('indexQuadro') }}\"><button class=\"btn btn-primary\" type=\"submit\">Crie seu quadro</button></a></center>
                <br />
                <br />
            </div>
        </div>
    </header>
{% endblock %}

{% block conteudo %}

{% endblock %}

{% block rodape %}
    
{% endblock rodape %}

{% block contato %}
<!-- Footer -->
<footer>
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1\">
                <p class=\"copyright text-muted\">Faça parte da nossa comunidade</p>
                <ul class=\"list-inline text-center\">
                    <li>
                        <a href=\"https://facebook.com/Um-Desejo-Por-Semana-1774391249517839\">
                            <span class=\"fa-stack fa-lg\">
                                <i class=\"fa fa-circle fa-stack-2x\"></i>
                                <i class=\"fa fa-facebook fa-stack-1x fa-inverse\"></i>
                            </span>
                        </a>
                    </li>
                </ul>
                <p class=\"copyright text-muted\">n0va1s 2016</p>
            </div>
        </div>
    </div>
</footer>
{% endblock %}
    <!-- jQuery -->
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
    <!--<script src=\"/web/vendor/bootstrap/js/bootstrap.min.js\"></script>-->

    <!-- Contact Form JavaScript -->
    <script src=\"{{ asset('jqBootstrapValidation.js', 'js') }}\"></script>

    <!-- Theme JavaScript -->
    <script src=\"{{ asset('clean-blog.min.js', 'js') }}\"></script>

    <!-- JavaScript do quadro -->
    <script src=\"{{ asset('quadro.js', 'js') }}\"></script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-104095614-1', 'auto');
      ga('send', 'pageview');
    </script>
</body>
</html>", "leiaute.twig", "/home/85236250110/Documentos/trabalho/public-html/quadro_magico/web/view/leiaute.twig");
    }
}
