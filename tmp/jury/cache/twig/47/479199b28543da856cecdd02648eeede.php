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

/* front/common/header.html.twig */
class __TwigTemplate_67d447b8b3b287e74843782e55f200ef extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/common/header.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/common/header.html.twig"));

        // line 1
        yield "<nav class=\"navbar navbar-expand-lg bg-white py-0 sticky-top shadow-sm\">
    <div class=\"container\">
        <a class=\"navbar-brand d-flex align-items-center\" href=\"";
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
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 14, $this->source); })()), "request", [], "any", false, false, false, 14), "attributes", [], "any", false, false, false, 14), "get", ["_route"], "method", false, false, false, 14) == "app_home")) ? ("active") : (""));
        yield "\"
                        ";
        // line 15
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 15, $this->source); })()), "request", [], "any", false, false, false, 15), "attributes", [], "any", false, false, false, 15), "get", ["_route"], "method", false, false, false, 15) == "app_home")) {
            yield "aria-current=\"page\"";
        }
        // line 16
        yield "                        href=\"";
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">Accueil</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link ";
        // line 18
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 18, $this->source); })()), "request", [], "any", false, false, false, 18), "attributes", [], "any", false, false, false, 18), "get", ["_route"], "method", false, false, false, 18) == "app_about")) ? ("active") : (""));
        yield "\"
                        ";
        // line 19
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 19, $this->source); })()), "request", [], "any", false, false, false, 19), "attributes", [], "any", false, false, false, 19), "get", ["_route"], "method", false, false, false, 19) == "app_about")) {
            yield "aria-current=\"page\"";
        }
        // line 20
        yield "                        href=\"";
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_about");
        yield "\">À Propos</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link ";
        // line 22
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 22, $this->source); })()), "request", [], "any", false, false, false, 22), "attributes", [], "any", false, false, false, 22), "get", ["_route"], "method", false, false, false, 22) == "app_category_index")) ? ("active") : (""));
        yield "\"
                        ";
        // line 23
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 23, $this->source); })()), "request", [], "any", false, false, false, 23), "attributes", [], "any", false, false, false, 23), "get", ["_route"], "method", false, false, false, 23) == "app_category_index")) {
            yield "aria-current=\"page\"";
        }
        // line 24
        yield "                        href=\"";
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_category_index");
        yield "\">Prestations</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link ";
        // line 26
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 26, $this->source); })()), "request", [], "any", false, false, false, 26), "attributes", [], "any", false, false, false, 26), "get", ["_route"], "method", false, false, false, 26) == "app_product_index")) ? ("active") : (""));
        yield "\"
                        ";
        // line 27
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 27, $this->source); })()), "request", [], "any", false, false, false, 27), "attributes", [], "any", false, false, false, 27), "get", ["_route"], "method", false, false, false, 27) == "app_product_index")) {
            yield "aria-current=\"page\"";
        }
        // line 28
        yield "                        href=\"";
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_product_index");
        yield "\">Galerie</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link ";
        // line 30
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 30, $this->source); })()), "request", [], "any", false, false, false, 30), "attributes", [], "any", false, false, false, 30), "get", ["_route"], "method", false, false, false, 30) == "app_quote_new")) ? ("active") : (""));
        yield "\"
                        ";
        // line 31
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 31, $this->source); })()), "request", [], "any", false, false, false, 31), "attributes", [], "any", false, false, false, 31), "get", ["_route"], "method", false, false, false, 31) == "app_quote_new")) {
            yield "aria-current=\"page\"";
        }
        // line 32
        yield "                        href=\"";
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_quote_new");
        yield "\">Demande de devis</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link ";
        // line 34
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 34, $this->source); })()), "request", [], "any", false, false, false, 34), "attributes", [], "any", false, false, false, 34), "get", ["_route"], "method", false, false, false, 34) == "app_contact")) ? ("active") : (""));
        yield "\"
                        ";
        // line 35
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 35, $this->source); })()), "request", [], "any", false, false, false, 35), "attributes", [], "any", false, false, false, 35), "get", ["_route"], "method", false, false, false, 35) == "app_contact")) {
            yield "aria-current=\"page\"";
        }
        // line 36
        yield "                        href=\"";
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_contact");
        yield "\">Contact</a></li>
                <li class=\"nav-item ms-lg-2\">
                    <button type=\"button\" class=\"btn btn-theme-toggle\" data-theme-toggle
                            aria-label=\"Activer le mode sombre\" title=\"Mode sombre\">
                        <i class=\"fas fa-moon\" aria-hidden=\"true\"></i>
                    </button>
                </li>
                <li class=\"nav-item ms-3\">
                    ";
        // line 44
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 44, $this->source); })()), "user", [], "any", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 45
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
            // line 52
            yield "                        <a href=\"";
            yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\" class=\"btn btn-gold\">Se connecter</a>
                    ";
        }
        // line 54
        yield "                </li>
                ";
        // line 55
        if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 56
            yield "                    <li class=\"nav-item ms-3\">
                        <a href=\"";
            // line 57
            yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
            yield "\" class=\"btn btn-outline-dark\">
                            <i class=\"fas fa-lock me-1\"></i> Admin
                        </a>
                    </li>
                ";
        }
        // line 62
        yield "            </ul>
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
        return "front/common/header.html.twig";
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
        return array (  195 => 62,  187 => 57,  184 => 56,  182 => 55,  179 => 54,  173 => 52,  162 => 45,  160 => 44,  148 => 36,  144 => 35,  140 => 34,  134 => 32,  130 => 31,  126 => 30,  120 => 28,  116 => 27,  112 => 26,  106 => 24,  102 => 23,  98 => 22,  92 => 20,  88 => 19,  84 => 18,  78 => 16,  74 => 15,  70 => 14,  57 => 4,  53 => 3,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<nav class=\"navbar navbar-expand-lg bg-white py-0 sticky-top shadow-sm\">
    <div class=\"container\">
        <a class=\"navbar-brand d-flex align-items-center\" href=\"{{ path(\x27app_home\x27) }}\">
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
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27app_home\x27 ? \x27active\x27 : \x27\x27 }}\"
                        {% if app.request.attributes.get(\x27_route\x27) == \x27app_home\x27 %}aria-current=\"page\"{% endif %}
                        href=\"{{ path(\x27app_home\x27) }}\">Accueil</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27app_about\x27 ? \x27active\x27 : \x27\x27 }}\"
                        {% if app.request.attributes.get(\x27_route\x27) == \x27app_about\x27 %}aria-current=\"page\"{% endif %}
                        href=\"{{ path(\x27app_about\x27) }}\">À Propos</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27app_category_index\x27 ? \x27active\x27 : \x27\x27 }}\"
                        {% if app.request.attributes.get(\x27_route\x27) == \x27app_category_index\x27 %}aria-current=\"page\"{% endif %}
                        href=\"{{ path(\x27app_category_index\x27) }}\">Prestations</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27app_product_index\x27 ? \x27active\x27 : \x27\x27 }}\"
                        {% if app.request.attributes.get(\x27_route\x27) == \x27app_product_index\x27 %}aria-current=\"page\"{% endif %}
                        href=\"{{ path(\x27app_product_index\x27) }}\">Galerie</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27app_quote_new\x27 ? \x27active\x27 : \x27\x27 }}\"
                        {% if app.request.attributes.get(\x27_route\x27) == \x27app_quote_new\x27 %}aria-current=\"page\"{% endif %}
                        href=\"{{ path(\x27app_quote_new\x27) }}\">Demande de devis</a></li>
                <li class=\"nav-item\"><a
                        class=\"nav-link {{ app.request.attributes.get(\x27_route\x27) == \x27app_contact\x27 ? \x27active\x27 : \x27\x27 }}\"
                        {% if app.request.attributes.get(\x27_route\x27) == \x27app_contact\x27 %}aria-current=\"page\"{% endif %}
                        href=\"{{ path(\x27app_contact\x27) }}\">Contact</a></li>
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
                {% if is_granted(\x27ROLE_ADMIN\x27) %}
                    <li class=\"nav-item ms-3\">
                        <a href=\"{{ path(\x27admin_dashboard\x27) }}\" class=\"btn btn-outline-dark\">
                            <i class=\"fas fa-lock me-1\"></i> Admin
                        </a>
                    </li>
                {% endif %}
            </ul>
        </div>
    </div>
</nav>
", "front/common/header.html.twig", "/var/www/html/templates/front/common/header.html.twig");
    }
}
