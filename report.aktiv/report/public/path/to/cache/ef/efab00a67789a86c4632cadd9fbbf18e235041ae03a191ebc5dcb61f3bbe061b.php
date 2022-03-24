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

/* authorization\login.html */
class __TwigTemplate_3310adfeb6be3d0a4eb06a87a5ae19fbd4ae1f1d21546001cfd33b4a091ac0a4 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layouts/authorization.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layouts/authorization.html", "authorization\\login.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "<div class=\"wrapper\">
    <div class=\"section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0\">
        <div class=\"container-fluid\">
            <div class=\"row row-cols-1 row-cols-lg-2 row-cols-xl-3\">
                <div class=\"col mx-auto\">
                    <div class=\"card\">
                        <div class=\"card-body\">
                            <div class=\"border p-4 rounded\">
                                <div class=\"form-body\">
                                    <form class=\"row g-3\" action='login-post' method=\"post\">
                                        <div class=\"col-12\">
                               
                                            <label for=\"inputEmailAddress\" class=\"form-label\">LOGIN!</label>
                                            <input type=\"text\" required class=\"form-control\" id=\"inputEmailAddress\"
                                                name=\"login\" placeholder=\"Email Address\">
                                        </div>
                                        <div class=\"col-12\">
                                            <label for=\"inputChoosePassword\" class=\"form-label\">Password</label>
                                            <div class=\"input-group\" id=\"show_hide_password\">
                                                <input type=\"password\" name='password' required
                                                    class=\"form-control border-end-0\" id=\"inputChoosePassword\"
                                                    placeholder=\"Enter Password\"> <a href=\"javascript:;\"
                                                    class=\"input-group-text bg-transparent\"><i
                                                        class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class=\"col-12\">
                                            <div class=\"d-grid\">
                                                <button type=\"submit\" class=\"btn btn-primary\"><i
                                                        class=\"bx bxs-lock-open\"></i>Sign in</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "authorization\\login.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "authorization\\login.html", "/var/www/vhosts/aktiv-market.kz/report.aktiv-market.kz/report/resources/views/authorization/login.html");
    }
}
