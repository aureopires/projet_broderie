<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Sandbox\SecurityNotAllowedTestError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* admin/common/header.html.twig */
class __TwigTemplate_0e1d8d892aff961b2ac091e68d9873a7 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/common/header.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/common/header.html.twig"));

        // line 1
        yield "<nav class=\"navbar navbar-expand-lg bg-white py-0 sticky-top shadow-sm\">
    <div class=\"container\">
        <a class=\"navbar d-flex align-items-center\" href=\"";
        // line 3
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">
            <img src=\"";
        // line 4
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/logo_nav.png"), "html", null, true);
        yield "\" alt=\"L\x27Aiguille des Volcans\" height=\"75\"
                 class=\"d-inline-block align-text-top\" data-theme-logo>
        </a>
        <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\"
                aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Afficher ou masquer le menu\">
            <span class=\"navbar-toggler-icon\"></span>
        </button>
        <div class=\"collapse navbar-collapse justify-content-end\" id=\"navbarNav\">
            <ul class=\"navbar-nav align-items-center\">
                <li class=\"nav-item\"><a
                        class=\"nav-link ";
        // line 14
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 14, $this->source); })()), "request", [], "any", false, false, false, 14), "attributes", [], "any", false, false, false, 14), "get", ["_route"], "method", false, false, false, 14) == "admin_dashboard")) ? ("active") : (""));
        yield "\"
                        href=\"";
        // line 15
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\">Dashboard</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link ";
        // line 17
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 17, $this->source); })()), "request", [], "any", false, false, false, 17), "attributes", [], "any", false, false, false, 17), "get", ["_route"], "method", false, false, false, 17) == "admin_quote_request_index")) ? ("active") : (""));
        yield "\"
                        href=\"";
        // line 18
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_quote_request_index");
        yield "\">Devis</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link ";
        // line 20
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 20, $this->source); })()), "request", [], "any", false, false, false, 20), "attributes", [], "any", false, false, false, 20), "get", ["_route"], "method", false, false, false, 20) == "admin_review_index")) ? ("active") : (""));
        yield "\"
                        href=\"";
        // line 21
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_review_index");
        yield "\">Avis</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link ";
        // line 23
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 23, $this->source); })()), "request", [], "any", false, false, false, 23), "attributes", [], "any", false, false, false, 23), "get", ["_route"], "method", false, false, false, 23) == "admin_product_index")) ? ("active") : (""));
        yield "\"
                        href=\"";
        // line 24
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_product_index");
        yield "\">Produits</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link ";
        // line 26
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 26, $this->source); })()), "request", [], "any", false, false, false, 26), "attributes", [], "any", false, false, false, 26), "get", ["_route"], "method", false, false, false, 26) == "admin_category_index")) ? ("active") : (""));
        yield "\"
                        href=\"";
        // line 27
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_category_index");
        yield "\">Categories</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link ";
        // line 29
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 29, $this->source); })()), "request", [], "any", false, false, false, 29), "attributes", [], "any", false, false, false, 29), "get", ["_route"], "method", false, false, false, 29) == "admin_user_index")) ? ("active") : (""));
        yield "\"
                        href=\"";
        // line 30
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_user_index");
        yield "\">Utilisateurs</a></li>
                <li class=\"nav-item ms-lg-2\">
                    <button type=\"button\" class=\"btn btn-theme-toggle\" data-theme-toggle
                            aria-label=\"Activer le mode sombre\" title=\"Mode sombre\">
                        <i class=\"fas fa-moon\" aria-hidden=\"true\"></i>
                    </button>
                </li>
                <li class=\"nav-item ms-3\">
                    ";
        // line 38
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 38, $this->source); })()), "user", [], "any", false, false, false, 38)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 39
            yield "                        <a href=\"";
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\LogoutUrlExtension']->getLogoutPath(), "html", null, true);
            yield "\"
                           class=\"btn btn-outline-dark\"
                           aria-label=\"Se déconnecter\"
                           title=\"Se déconnecter\">
                            <i class=\"fa-solid fa-right-from-bracket\" aria-hidden=\"true\"></i>
                        </a>
                    ";
        } else {
            // line 46
            yield "                        <a href=\"";
            yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\" class=\"btn btn-gold\">Se connecter</a>
                    ";
        }
        // line 48
        yield "                </li>
            </ul>
        </div>
    </div>
</nav>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/common/header.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  149 => 48,  143 => 46,  132 => 39,  130 => 38,  119 => 30,  115 => 29,  110 => 27,  106 => 26,  101 => 24,  97 => 23,  92 => 21,  88 => 20,  83 => 18,  79 => 17,  74 => 15,  70 => 14,  57 => 4,  53 => 3,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<nav class=\"navbar navbar-expand-lg bg-white py-0 sticky-top shadow-sm\">
    <div class=\"container\">
        <a class=\"navbar d-flex align-items-center\" href=\"{{ path(\x27app_home\x27) }}\">
            <img src=\"{{ asset(\x27build/images/logo_nav.png\x27) }}\" alt=\"L\x27Aiguille des Volcans\" height=\"75\"
                 class=\"d-inline-block align-text-top\" data-theme-logo>
        </a>
        <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\"
                aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Afficher ou masquer le menu\">
            <span class=\"navbar-toggler-icon\"></span>
        </button>
        <div class=\"collapse navbar-collapse justify-content-end\" id=\"navbarNav\">
            <ul class=\"navbar-nav align-items-center\">
                <li class=\"nav-item\"><a
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27admin_dashboard\x27 ? \x27active\x27 : \x27\x27 }}\"
                        href=\"{{ path(\x27admin_dashboard\x27) }}\">Dashboard</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27admin_quote_request_index\x27 ? \x27active\x27 : \x27\x27 }}\"
                        href=\"{{ path(\x27admin_quote_request_index\x27) }}\">Devis</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27admin_review_index\x27 ? \x27active\x27 : \x27\x27 }}\"
                        href=\"{{ path(\x27admin_review_index\x27) }}\">Avis</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27admin_product_index\x27 ? \x27active\x27 : \x27\x27 }}\"
                        href=\"{{ path(\x27admin_product_index\x27) }}\">Produits</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27admin_category_index\x27 ? \x27active\x27 : \x27\x27 }}\"
                        href=\"{{ path(\x27admin_category_index\x27) }}\">Categories</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27admin_user_index\x27 ? \x27active\x27 : \x27\x27 }}\"
                        href=\"{{ path(\x27admin_user_index\x27) }}\">Utilisateurs</a></li>
                <li class=\"nav-item ms-lg-2\">
                    <button type=\"button\" class=\"btn btn-theme-toggle\" data-theme-toggle
                            aria-label=\"Activer le mode sombre\" title=\"Mode sombre\">
                        <i class=\"fas fa-moon\" aria-hidden=\"true\"></i>
                    </button>
                </li>
                <li class=\"nav-item ms-3\">
                    {% if app.user %}
                        <a href=\"{{ logout_path() }}\"
                           class=\"btn btn-outline-dark\"
                           aria-label=\"Se déconnecter\"
                           title=\"Se déconnecter\">
                            <i class=\"fa-solid fa-right-from-bracket\" aria-hidden=\"true\"></i>
                        </a>
                    {% else %}
                        <a href=\"{{ path(\x27app_login\x27) }}\" class=\"btn btn-gold\">Se connecter</a>
                    {% endif %}
                </li>
            </ul>
        </div>
    </div>
</nav>
", "admin/common/header.html.twig", "/var/www/html/templates/admin/common/header.html.twig");
    }
}
