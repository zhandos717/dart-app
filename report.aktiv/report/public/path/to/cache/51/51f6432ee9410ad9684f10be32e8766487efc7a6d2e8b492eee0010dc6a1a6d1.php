<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* layouts/authorization.html */
class __TwigTemplate_727dd51ef6ed9b71a6f75c9dc39d96e8a6e6ee0bcfe6698a0bea58d412fba769 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!doctype html>
<html lang=\"en\">
<head>
    <!-- Required meta tags -->
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <!--favicon-->
    <link rel=\"icon\" href=\"/report/assets/images/favicon-32x32.png\" type=\"image/png\" />
    <!--plugins-->
    <link href=\"/report/assets/plugins/simplebar/css/simplebar.css\" rel=\"stylesheet\" />
    <link href=\"/report/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css\" rel=\"stylesheet\" />
    <link href=\"/report/assets/plugins/metismenu/css/metisMenu.min.css\" rel=\"stylesheet\" />
    <!-- loader-->
    <link href=\"/report/assets/css/pace.min.css\" rel=\"stylesheet\" />
    <script src=\"/report/assets/js/pace.min.js\"></script>
    <!-- Bootstrap CSS -->
    <link href=\"/report/assets/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"/report/assets/css/app.css\" rel=\"stylesheet\">
    <link href=\"/report/assets/css/icons.css\" rel=\"stylesheet\">
    <title> ";
        // line 20
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo " </title>
</head>
<body class=\"bg-login\">
    <!--wrapper-->
    ";
        // line 24
        $this->displayBlock('content', $context, $blocks);
        // line 26
        echo "    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src=\"/report/assets/js/bootstrap.bundle.min.js\"></script>
    <!--plugins-->
    <script src=\"/report/assets/js/jquery.min.js\"></script>
    <script src=\"/report/assets/plugins/simplebar/js/simplebar.min.js\"></script>
    <script src=\"/report/assets/plugins/metismenu/js/metisMenu.min.js\"></script>
    <script src=\"/report/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js\"></script>
    <!--Password show & hide js -->
    <script>
        \$(document).ready(function() {
            \$(\"#show_hide_password a\").on('click', function(event) {
                event.preventDefault();
                if (\$('#show_hide_password input').attr(\"type\") == \"text\") {
                    \$('#show_hide_password input').attr('type', 'password');
                    \$('#show_hide_password i').addClass(\"bx-hide\");
                    \$('#show_hide_password i').removeClass(\"bx-show\");
                } else if (\$('#show_hide_password input').attr(\"type\") == \"password\") {
                    \$('#show_hide_password input').attr('type', 'text');
                    \$('#show_hide_password i').removeClass(\"bx-hide\");
                    \$('#show_hide_password i').addClass(\"bx-show\");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src=\"/report/assets/js/app.js\"></script>
</body>

</html>";
    }

    // line 24
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 25
        echo "    ";
    }

    public function getTemplateName()
    {
        return "layouts/authorization.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  105 => 25,  101 => 24,  68 => 26,  66 => 24,  59 => 20,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "layouts/authorization.html", "/var/www/vhosts/aktiv-market.kz/report.aktiv-market.kz/report/resources/views/layouts/authorization.html");
    }
}
