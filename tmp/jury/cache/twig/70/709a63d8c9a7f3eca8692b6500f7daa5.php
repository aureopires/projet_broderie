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

/* front/product/show.html.twig */
class __TwigTemplate_b29e7405e1acf6e3229edf9ee4f4ec73 extends Template
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
        return "front/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/product/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/product/show.html.twig"));

        $this->parent = $this->load("front/base.html.twig", 1);
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

        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 3, $this->source); })()), "title", [], "any", false, false, false, 3), "html", null, true);
        
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
        yield "    <div class=\"container my-5\">
        <!-- Fil d\x27Ariane (Breadcrumb) -->
        <nav aria-label=\"breadcrumb\" class=\"mb-4\">
            <ol class=\"breadcrumb\">
                <li class=\"breadcrumb-item\"><a href=\"";
        // line 10
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_product_index");
        yield "\"
                                               class=\"text-decoration-none text-muted\">Catalogue</a></li>
                <li class=\"breadcrumb-item active text-dark fw-semibold\" aria-current=\"page\">";
        // line 12
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 12, $this->source); })()), "title", [], "any", false, false, false, 12), "html", null, true);
        yield "</li>
            </ol>
        </nav>

        <div class=\"row g-4 align-items-center\">
            <div class=\"col-lg-6\">
                <div class=\"card border-0 shadow-sm rounded-4 overflow-hidden bg-light\">
                    ";
        // line 19
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["product"] ?? null), "image", [], "any", true, true, false, 19) && (($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 19, $this->source); })()), "image", [], "any", false, false, false, 19)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) {
            // line 20
            yield "                        ";
            if ((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 20, $this->source); })()), "image", [], "any", false, false, false, 20)) && is_string($_v1 = "https://") && str_starts_with($_v0, $_v1))) {
                // line 21
                yield "                            <button type=\"button\" class=\"lightbox-trigger p-0 border-0 w-100\"
                                    data-lightbox-src=\"";
                // line 22
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 22, $this->source); })()), "image", [], "any", false, false, false, 22), "html", null, true);
                yield "\"
                                    data-lightbox-title=\"";
                // line 23
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 23, $this->source); })()), "title", [], "any", false, false, false, 23), "html", null, true);
                yield "\">
                                <img src=\"";
                // line 24
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 24, $this->source); })()), "image", [], "any", false, false, false, 24), "html", null, true);
                yield "\" class=\"img-fluid w-100 object-fit-cover\" style=\"max-height: 500px;\" alt=\"";
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 24, $this->source); })()), "title", [], "any", false, false, false, 24), "html", null, true);
                yield "\">
                            </button>
                        ";
            } else {
                // line 27
                yield "                            <button type=\"button\" class=\"lightbox-trigger p-0 border-0 w-100\"
                                    data-lightbox-src=\"";
                // line 28
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/products/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 28, $this->source); })()), "image", [], "any", false, false, false, 28))), "html", null, true);
                yield "\"
                                    data-lightbox-title=\"";
                // line 29
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 29, $this->source); })()), "title", [], "any", false, false, false, 29), "html", null, true);
                yield "\">
                                <img src=\"";
                // line 30
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/products/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 30, $this->source); })()), "image", [], "any", false, false, false, 30))), "html", null, true);
                yield "\" class=\"img-fluid w-100 object-fit-cover\" style=\"max-height: 500px;\" alt=\"";
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 30, $this->source); })()), "title", [], "any", false, false, false, 30), "html", null, true);
                yield "\">
                            </button>
                        ";
            }
            // line 33
            yield "                    ";
        } else {
            // line 34
            yield "                        <div class=\"text-muted d-flex align-items-center justify-content-center\" style=\"height: 450px;\">
                            <i class=\"bi bi-image display-1\"></i>
                        </div>
                    ";
        }
        // line 38
        yield "                </div>
            </div>

            <div class=\"col-lg-6\">
                <span class=\"badge bg-secondary mb-3 px-3 py-2 rounded-pill\">Pièce Unique</span>
                <h1 class=\"fw-bold text-dark display-6 mb-3\">";
        // line 43
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 43, $this->source); })()), "title", [], "any", false, false, false, 43), "html", null, true);
        yield "</h1>

                <div class=\"mb-4\">
                    <span class=\"text-muted small d-block mb-1\">Prix indicatif</span>
                    <h2 class=\"text-primary fw-bold display-5\">";
        // line 47
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 47, $this->source); })()), "indicativePrice", [], "any", false, false, false, 47), "html", null, true);
        yield " €</h2>
                </div>

                <hr class=\"text-muted opacity-25 my-4\">

                <div class=\"mb-4\">
                    <h4 class=\"h5 fw-bold text-dark mb-2\">Description</h4>
                    <p class=\"text-muted\" style=\"line-height: 1.8;\">
                        ";
        // line 55
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, ($context["product"] ?? null), "description", [], "any", true, true, false, 55) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 55, $this->source); })()), "description", [], "any", false, false, false, 55)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["product"]) || array_key_exists("product", $context) ? $context["product"] : (function () { throw new RuntimeError('Variable "product" does not exist.', 55, $this->source); })()), "description", [], "any", false, false, false, 55), "html", null, true)) : ("Aucune description détaillée disponible pour cette création."));
        yield "
                    </p>
                </div>

                <div class=\"d-flex gap-3 align-items-center mt-5\">
                    <a href=\"";
        // line 60
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_product_index");
        yield "\" class=\"btn btn-outline-dark px-4 py-2 rounded-pill\">
                        <i class=\"bi bi-arrow-left me-2\"></i> Retour au catalogue
                    </a>
                </div>
            </div>
        </div>
    </div>
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
        return "front/product/show.html.twig";
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
        return array (  207 => 60,  199 => 55,  188 => 47,  181 => 43,  174 => 38,  168 => 34,  165 => 33,  157 => 30,  153 => 29,  149 => 28,  146 => 27,  138 => 24,  134 => 23,  130 => 22,  127 => 21,  124 => 20,  122 => 19,  112 => 12,  107 => 10,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27front/base.html.twig\x27 %}

{% block title %}{{ product.title }}{% endblock %}

{% block body %}
    <div class=\"container my-5\">
        <!-- Fil d\x27Ariane (Breadcrumb) -->
        <nav aria-label=\"breadcrumb\" class=\"mb-4\">
            <ol class=\"breadcrumb\">
                <li class=\"breadcrumb-item\"><a href=\"{{ path(\x27app_product_index\x27) }}\"
                                               class=\"text-decoration-none text-muted\">Catalogue</a></li>
                <li class=\"breadcrumb-item active text-dark fw-semibold\" aria-current=\"page\">{{ product.title }}</li>
            </ol>
        </nav>

        <div class=\"row g-4 align-items-center\">
            <div class=\"col-lg-6\">
                <div class=\"card border-0 shadow-sm rounded-4 overflow-hidden bg-light\">
                    {% if product.image is defined and product.image %}
                        {% if product.image starts with \x27https://\x27 %}
                            <button type=\"button\" class=\"lightbox-trigger p-0 border-0 w-100\"
                                    data-lightbox-src=\"{{ product.image }}\"
                                    data-lightbox-title=\"{{ product.title }}\">
                                <img src=\"{{ product.image }}\" class=\"img-fluid w-100 object-fit-cover\" style=\"max-height: 500px;\" alt=\"{{ product.title }}\">
                            </button>
                        {% else %}
                            <button type=\"button\" class=\"lightbox-trigger p-0 border-0 w-100\"
                                    data-lightbox-src=\"{{ asset(\x27uploads/products/\x27 ~ product.image) }}\"
                                    data-lightbox-title=\"{{ product.title }}\">
                                <img src=\"{{ asset(\x27uploads/products/\x27 ~ product.image) }}\" class=\"img-fluid w-100 object-fit-cover\" style=\"max-height: 500px;\" alt=\"{{ product.title }}\">
                            </button>
                        {% endif %}
                    {% else %}
                        <div class=\"text-muted d-flex align-items-center justify-content-center\" style=\"height: 450px;\">
                            <i class=\"bi bi-image display-1\"></i>
                        </div>
                    {% endif %}
                </div>
            </div>

            <div class=\"col-lg-6\">
                <span class=\"badge bg-secondary mb-3 px-3 py-2 rounded-pill\">Pièce Unique</span>
                <h1 class=\"fw-bold text-dark display-6 mb-3\">{{ product.title }}</h1>

                <div class=\"mb-4\">
                    <span class=\"text-muted small d-block mb-1\">Prix indicatif</span>
                    <h2 class=\"text-primary fw-bold display-5\">{{ product.indicativePrice }} €</h2>
                </div>

                <hr class=\"text-muted opacity-25 my-4\">

                <div class=\"mb-4\">
                    <h4 class=\"h5 fw-bold text-dark mb-2\">Description</h4>
                    <p class=\"text-muted\" style=\"line-height: 1.8;\">
                        {{ product.description ?? \x27Aucune description détaillée disponible pour cette création.\x27 }}
                    </p>
                </div>

                <div class=\"d-flex gap-3 align-items-center mt-5\">
                    <a href=\"{{ path(\x27app_product_index\x27) }}\" class=\"btn btn-outline-dark px-4 py-2 rounded-pill\">
                        <i class=\"bi bi-arrow-left me-2\"></i> Retour au catalogue
                    </a>
                </div>
            </div>
        </div>
    </div>
{% endblock %}
", "front/product/show.html.twig", "/var/www/html/templates/front/product/show.html.twig");
    }
}
