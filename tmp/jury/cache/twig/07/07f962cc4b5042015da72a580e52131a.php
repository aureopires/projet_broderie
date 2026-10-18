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

/* admin/dashboard/index.html.twig */
class __TwigTemplate_a24469b67f5d842d58b8a88ff62717ec extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "admin/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/dashboard/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/dashboard/index.html.twig"));

        $this->parent = $this->load("admin/base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Tableau de bord - Administration";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "    <main class=\"container py-5\">
        <div class=\"d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4\">
            <div>
                <p class=\"text-muted mb-1\">Administration</p>
                <h1 class=\"fw-bold mb-0\">Tableau de bord</h1>
            </div>
            <a href=\"";
        // line 12
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\" class=\"btn btn-outline-dark\">
                <i class=\"fas fa-arrow-left me-1\"></i> Voir le site
            </a>
        </div>

        <div class=\"row g-4 mb-5\">
            ";
        // line 18
        $context["summary_cards"] = [["label" => "Demandes de devis", "value" =>         // line 19
(isset($context["quote_requests_count"]) || array_key_exists("quote_requests_count", $context) ? $context["quote_requests_count"] : (function () { throw new RuntimeError('Variable "quote_requests_count" does not exist.', 19, $this->source); })()), "icon" => "fa-file-signature", "route" => "admin_quote_request_index"], ["label" => "Nouveaux devis", "value" =>         // line 20
(isset($context["new_quote_requests_count"]) || array_key_exists("new_quote_requests_count", $context) ? $context["new_quote_requests_count"] : (function () { throw new RuntimeError('Variable "new_quote_requests_count" does not exist.', 20, $this->source); })()), "icon" => "fa-clock", "route" => "admin_quote_request_index"], ["label" => "Avis", "value" =>         // line 21
(isset($context["reviews_count"]) || array_key_exists("reviews_count", $context) ? $context["reviews_count"] : (function () { throw new RuntimeError('Variable "reviews_count" does not exist.', 21, $this->source); })()), "icon" => "fa-star", "route" => "admin_review_index"], ["label" => "Produits", "value" =>         // line 22
(isset($context["products_count"]) || array_key_exists("products_count", $context) ? $context["products_count"] : (function () { throw new RuntimeError('Variable "products_count" does not exist.', 22, $this->source); })()), "icon" => "fa-shirt", "route" => "admin_product_index"], ["label" => "Catégories", "value" =>         // line 23
(isset($context["categories_count"]) || array_key_exists("categories_count", $context) ? $context["categories_count"] : (function () { throw new RuntimeError('Variable "categories_count" does not exist.', 23, $this->source); })()), "icon" => "fa-layer-group", "route" => "admin_category_index"], ["label" => "Utilisateurs", "value" =>         // line 24
(isset($context["users_count"]) || array_key_exists("users_count", $context) ? $context["users_count"] : (function () { throw new RuntimeError('Variable "users_count" does not exist.', 24, $this->source); })()), "icon" => "fa-users", "route" => "admin_user_index"]];
        // line 26
        yield "            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["summary_cards"]) || array_key_exists("summary_cards", $context) ? $context["summary_cards"] : (function () { throw new RuntimeError('Variable "summary_cards" does not exist.', 26, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["card"]) {
            // line 27
            yield "                <div class=\"col-sm-6 col-xl-2\">
                    <a href=\"";
            // line 28
            yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(CoreExtension::getAttribute($this->env, $this->source, $context["card"], "route", [], "any", false, false, false, 28));
            yield "\" class=\"text-decoration-none\">
                        <div class=\"card h-100 border-0 shadow-sm p-3\">
                            <div class=\"d-flex justify-content-between align-items-start\">
                                <span class=\"text-muted small\">";
            // line 31
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["card"], "label", [], "any", false, false, false, 31), "html", null, true);
            yield "</span>
                                <i class=\"fas ";
            // line 32
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["card"], "icon", [], "any", false, false, false, 32), "html", null, true);
            yield " text-warning\"></i>
                            </div>
                            <strong class=\"fs-2 text-dark mt-2\">";
            // line 34
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["card"], "value", [], "any", false, false, false, 34), "html", null, true);
            yield "</strong>
                        </div>
                    </a>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['card'], $context['_parent']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 39
        yield "        </div>

        <div class=\"row g-4 mb-5\">
            <div class=\"col-lg-6\">
                <div class=\"card h-100 border-0 shadow-sm\">
                    <div class=\"card-body\">
                        <div class=\"d-flex justify-content-between align-items-center mb-3\">
                            <h2 class=\"h5 fw-bold mb-0\">Dernières demandes de devis</h2>
                            <a href=\"";
        // line 47
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_quote_request_index");
        yield "\" class=\"small text-decoration-none\">Tout voir</a>
                        </div>
                        ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["latest_quote_requests"]) || array_key_exists("latest_quote_requests", $context) ? $context["latest_quote_requests"] : (function () { throw new RuntimeError('Variable "latest_quote_requests" does not exist.', 49, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
            // line 50
            yield "                            <a href=\"";
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_quote_request_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["quote"], "id", [], "any", false, false, false, 50)]), "html", null, true);
            yield "\"
                               class=\"d-flex justify-content-between align-items-center gap-3 py-3 border-top text-decoration-none\">
                                <div>
                                    <strong class=\"d-block text-dark\">";
            // line 53
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote"], "name", [], "any", false, false, false, 53), "html", null, true);
            yield "</strong>
                                    <span class=\"text-muted small\">";
            // line 54
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["quote"], "articleType", [], "any", false, false, false, 54)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote"], "articleType", [], "any", false, false, false, 54), "html", null, true)) : ("Demande personnalisée"));
            yield "</span>
                                </div>
                                <div class=\"text-end\">
                                    <span class=\"badge ";
            // line 57
            yield (string) (((CoreExtension::getAttribute($this->env, $this->source, $context["quote"], "status", [], "any", false, false, false, 57) == "new")) ? ("bg-warning text-dark") : ((((CoreExtension::getAttribute($this->env, $this->source, $context["quote"], "status", [], "any", false, false, false, 57) == "processing")) ? ("bg-info text-dark") : ("bg-success"))));
            yield "\">
                                        ";
            // line 58
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["quote"], "status", [], "any", false, false, false, 58)), "html", null, true);
            yield "
                                    </span>
                                    <small class=\"d-block text-muted mt-1\">";
            // line 60
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["quote"], "createdAt", [], "any", false, false, false, 60)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["quote"], "createdAt", [], "any", false, false, false, 60), "d/m/Y"), "html", null, true)) : (""));
            yield "</small>
                                </div>
                            </a>
                        ";
            $context['_iterated'] = true;
        }
        // line 63
        if (!$context['_iterated']) {
            // line 64
            yield "                            <p class=\"text-muted mb-0\">Aucune demande de devis.</p>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['quote'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 66
        yield "                    </div>
                </div>
            </div>

            <div class=\"col-lg-6\">
                <div class=\"card h-100 border-0 shadow-sm\">
                    <div class=\"card-body\">
                        <div class=\"d-flex justify-content-between align-items-center mb-3\">
                            <h2 class=\"h5 fw-bold mb-0\">Derniers avis</h2>
                            <a href=\"";
        // line 75
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_review_index");
        yield "\" class=\"small text-decoration-none\">Tout voir</a>
                        </div>
                        ";
        // line 77
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["latest_reviews"]) || array_key_exists("latest_reviews", $context) ? $context["latest_reviews"] : (function () { throw new RuntimeError('Variable "latest_reviews" does not exist.', 77, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["review"]) {
            // line 78
            yield "                            <a href=\"";
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_review_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["review"], "id", [], "any", false, false, false, 78)]), "html", null, true);
            yield "\"
                               class=\"d-block py-3 border-top text-decoration-none\">
                                <div class=\"d-flex justify-content-between gap-3\">
                                    <strong class=\"text-dark\">";
            // line 81
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["review"], "user", [], "any", false, false, false, 81)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["review"], "user", [], "any", false, false, false, 81), "firstName", [], "any", false, false, false, 81), "html", null, true)) : ("Client"));
            yield "</strong>
                                    <div class=\"text-end\">
                                        <span class=\"text-warning\">
                                            ";
            // line 84
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(1, 5));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                yield "<i class=\"";
                yield (string) ((($context["i"] <= CoreExtension::getAttribute($this->env, $this->source, $context["review"], "rating", [], "any", false, false, false, 84))) ? ("fas fa-star") : ("far fa-star"));
                yield "\"></i>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
            $context = array_intersect_key($context, $_parent);
            $context += $_parent;
            // line 85
            yield "                                        </span>
                                        <span class=\"badge d-block mt-1 ";
            // line 86
            yield (string) (((CoreExtension::getAttribute($this->env, $this->source, $context["review"], "status", [], "any", false, false, false, 86) == "pending")) ? ("bg-warning text-dark") : ((((CoreExtension::getAttribute($this->env, $this->source, $context["review"], "status", [], "any", false, false, false, 86) == "approved")) ? ("bg-success") : ("bg-danger"))));
            yield "\">
                                            ";
            // line 87
            yield (string) (((CoreExtension::getAttribute($this->env, $this->source, $context["review"], "status", [], "any", false, false, false, 87) == "pending")) ? ("En attente") : ((((CoreExtension::getAttribute($this->env, $this->source, $context["review"], "status", [], "any", false, false, false, 87) == "approved")) ? ("Approuvé") : ("Rejeté"))));
            yield "
                                        </span>
                                    </div>
                                </div>
                                <span class=\"text-muted small\">";
            // line 91
            yield (string) (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["review"], "content", [], "any", false, false, false, 91)) > 90)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["review"], "content", [], "any", false, false, false, 91), 0, 90) . "…"), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["review"], "content", [], "any", false, false, false, 91), "html", null, true)));
            yield "</span>
                            </a>
                        ";
            $context['_iterated'] = true;
        }
        // line 93
        if (!$context['_iterated']) {
            // line 94
            yield "                            <p class=\"text-muted mb-0\">Aucun avis.</p>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['review'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 96
        yield "                    </div>
                </div>
            </div>
        </div>

        <h2 class=\"h5 fw-bold mb-3\">Accès rapides</h2>
        <div class=\"row g-3\">
            ";
        // line 103
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["Demandes de devis" => ["fa-file-signature", "admin_quote_request_index"], "Avis clients" => ["fa-star", "admin_review_index"], "Produits" => ["fa-shirt", "admin_product_index"], "Catégories" => ["fa-layer-group", "admin_category_index"], "Utilisateurs" => ["fa-users", "admin_user_index"]]);
        foreach ($context['_seq'] as $context["label"] => $context["route"]) {
            // line 110
            yield "                <div class=\"col-md-6 col-xl\">
                    <a href=\"";
            // line 111
            yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(CoreExtension::getAttribute($this->env, $this->source, $context["route"], 1, [], "array", false, false, false, 111));
            yield "\" class=\"btn btn-outline-dark w-100 py-3\">
                        <i class=\"fas ";
            // line 112
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["route"], 0, [], "array", false, false, false, 112), "html", null, true);
            yield " me-2\"></i>";
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
            yield "
                    </a>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['route'], $context['_parent']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 116
        yield "        </div>
    </main>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/dashboard/index.html.twig";
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
        return array (  335 => 116,  322 => 112,  318 => 111,  315 => 110,  311 => 103,  302 => 96,  294 => 94,  292 => 93,  285 => 91,  278 => 87,  274 => 86,  271 => 85,  259 => 84,  253 => 81,  246 => 78,  241 => 77,  236 => 75,  225 => 66,  217 => 64,  215 => 63,  207 => 60,  202 => 58,  198 => 57,  192 => 54,  188 => 53,  181 => 50,  176 => 49,  171 => 47,  161 => 39,  149 => 34,  144 => 32,  140 => 31,  134 => 28,  131 => 27,  126 => 26,  124 => 24,  123 => 23,  122 => 22,  121 => 21,  120 => 20,  119 => 19,  118 => 18,  109 => 12,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27admin/base.html.twig\x27 %}

{% block title %}Tableau de bord - Administration{% endblock %}

{% block body %}
    <main class=\"container py-5\">
        <div class=\"d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4\">
            <div>
                <p class=\"text-muted mb-1\">Administration</p>
                <h1 class=\"fw-bold mb-0\">Tableau de bord</h1>
            </div>
            <a href=\"{{ path(\x27app_home\x27) }}\" class=\"btn btn-outline-dark\">
                <i class=\"fas fa-arrow-left me-1\"></i> Voir le site
            </a>
        </div>

        <div class=\"row g-4 mb-5\">
            {% set summary_cards = [
                {label: \x27Demandes de devis\x27, value: quote_requests_count, icon: \x27fa-file-signature\x27, route: \x27admin_quote_request_index\x27},
                {label: \x27Nouveaux devis\x27, value: new_quote_requests_count, icon: \x27fa-clock\x27, route: \x27admin_quote_request_index\x27},
                {label: \x27Avis\x27, value: reviews_count, icon: \x27fa-star\x27, route: \x27admin_review_index\x27},
                {label: \x27Produits\x27, value: products_count, icon: \x27fa-shirt\x27, route: \x27admin_product_index\x27},
                {label: \x27Catégories\x27, value: categories_count, icon: \x27fa-layer-group\x27, route: \x27admin_category_index\x27},
                {label: \x27Utilisateurs\x27, value: users_count, icon: \x27fa-users\x27, route: \x27admin_user_index\x27}
            ] %}
            {% for card in summary_cards %}
                <div class=\"col-sm-6 col-xl-2\">
                    <a href=\"{{ path(card.route) }}\" class=\"text-decoration-none\">
                        <div class=\"card h-100 border-0 shadow-sm p-3\">
                            <div class=\"d-flex justify-content-between align-items-start\">
                                <span class=\"text-muted small\">{{ card.label }}</span>
                                <i class=\"fas {{ card.icon }} text-warning\"></i>
                            </div>
                            <strong class=\"fs-2 text-dark mt-2\">{{ card.value }}</strong>
                        </div>
                    </a>
                </div>
            {% endfor %}
        </div>

        <div class=\"row g-4 mb-5\">
            <div class=\"col-lg-6\">
                <div class=\"card h-100 border-0 shadow-sm\">
                    <div class=\"card-body\">
                        <div class=\"d-flex justify-content-between align-items-center mb-3\">
                            <h2 class=\"h5 fw-bold mb-0\">Dernières demandes de devis</h2>
                            <a href=\"{{ path(\x27admin_quote_request_index\x27) }}\" class=\"small text-decoration-none\">Tout voir</a>
                        </div>
                        {% for quote in latest_quote_requests %}
                            <a href=\"{{ path(\x27admin_quote_request_show\x27, {id: quote.id}) }}\"
                               class=\"d-flex justify-content-between align-items-center gap-3 py-3 border-top text-decoration-none\">
                                <div>
                                    <strong class=\"d-block text-dark\">{{ quote.name }}</strong>
                                    <span class=\"text-muted small\">{{ quote.articleType ?: \x27Demande personnalisée\x27 }}</span>
                                </div>
                                <div class=\"text-end\">
                                    <span class=\"badge {{ quote.status == \x27new\x27 ? \x27bg-warning text-dark\x27 : (quote.status == \x27processing\x27 ? \x27bg-info text-dark\x27 : \x27bg-success\x27) }}\">
                                        {{ quote.status|capitalize }}
                                    </span>
                                    <small class=\"d-block text-muted mt-1\">{{ quote.createdAt ? quote.createdAt|date(\x27d/m/Y\x27) : \x27\x27 }}</small>
                                </div>
                            </a>
                        {% else %}
                            <p class=\"text-muted mb-0\">Aucune demande de devis.</p>
                        {% endfor %}
                    </div>
                </div>
            </div>

            <div class=\"col-lg-6\">
                <div class=\"card h-100 border-0 shadow-sm\">
                    <div class=\"card-body\">
                        <div class=\"d-flex justify-content-between align-items-center mb-3\">
                            <h2 class=\"h5 fw-bold mb-0\">Derniers avis</h2>
                            <a href=\"{{ path(\x27admin_review_index\x27) }}\" class=\"small text-decoration-none\">Tout voir</a>
                        </div>
                        {% for review in latest_reviews %}
                            <a href=\"{{ path(\x27admin_review_show\x27, {id: review.id}) }}\"
                               class=\"d-block py-3 border-top text-decoration-none\">
                                <div class=\"d-flex justify-content-between gap-3\">
                                    <strong class=\"text-dark\">{{ review.user ? review.user.firstName : \x27Client\x27 }}</strong>
                                    <div class=\"text-end\">
                                        <span class=\"text-warning\">
                                            {% for i in 1..5 %}<i class=\"{{ i <= review.rating ? \x27fas fa-star\x27 : \x27far fa-star\x27 }}\"></i>{% endfor %}
                                        </span>
                                        <span class=\"badge d-block mt-1 {{ review.status == \x27pending\x27 ? \x27bg-warning text-dark\x27 : (review.status == \x27approved\x27 ? \x27bg-success\x27 : \x27bg-danger\x27) }}\">
                                            {{ review.status == \x27pending\x27 ? \x27En attente\x27 : (review.status == \x27approved\x27 ? \x27Approuvé\x27 : \x27Rejeté\x27) }}
                                        </span>
                                    </div>
                                </div>
                                <span class=\"text-muted small\">{{ review.content|length > 90 ? review.content|slice(0, 90) ~ \x27…\x27 : review.content }}</span>
                            </a>
                        {% else %}
                            <p class=\"text-muted mb-0\">Aucun avis.</p>
                        {% endfor %}
                    </div>
                </div>
            </div>
        </div>

        <h2 class=\"h5 fw-bold mb-3\">Accès rapides</h2>
        <div class=\"row g-3\">
            {% for label, route in {
                \x27Demandes de devis\x27: [\x27fa-file-signature\x27, \x27admin_quote_request_index\x27],
                \x27Avis clients\x27: [\x27fa-star\x27, \x27admin_review_index\x27],
                \x27Produits\x27: [\x27fa-shirt\x27, \x27admin_product_index\x27],
                \x27Catégories\x27: [\x27fa-layer-group\x27, \x27admin_category_index\x27],
                \x27Utilisateurs\x27: [\x27fa-users\x27, \x27admin_user_index\x27]
            } %}
                <div class=\"col-md-6 col-xl\">
                    <a href=\"{{ path(route[1]) }}\" class=\"btn btn-outline-dark w-100 py-3\">
                        <i class=\"fas {{ route[0] }} me-2\"></i>{{ label }}
                    </a>
                </div>
            {% endfor %}
        </div>
    </main>
{% endblock %}
", "admin/dashboard/index.html.twig", "/var/www/html/templates/admin/dashboard/index.html.twig");
    }
}
