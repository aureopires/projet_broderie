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

/* front/category/show.html.twig */
class __TwigTemplate_9a24e1c7356988f3565ea0c68486217e extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/category/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/category/show.html.twig"));

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

        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 3, $this->source); })()), "name", [], "any", false, false, false, 3), "html", null, true);
        
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
        <nav aria-label=\"breadcrumb\" class=\"mb-4\">
            <ol class=\"breadcrumb\">
                <li class=\"breadcrumb-item\"><a href=\"";
        // line 9
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_category_index");
        yield "\"
                                               class=\"text-decoration-none text-muted\">Catégories</a></li>
                <li class=\"breadcrumb-item active text-dark fw-semibold\" aria-current=\"page\">";
        // line 11
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 11, $this->source); })()), "name", [], "any", false, false, false, 11), "html", null, true);
        yield "</li>
            </ol>
        </nav>

        <div class=\"row g-5 align-items-center mb-5\">
            <div class=\"col-lg-5\">
                <div class=\"card border-0 shadow-sm rounded-4 overflow-hidden bg-light\">
                    ";
        // line 18
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["category"] ?? null), "image", [], "any", true, true, false, 18) && (($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 18, $this->source); })()), "image", [], "any", false, false, false, 18)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) {
            // line 19
            yield "                        ";
            if ((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 19, $this->source); })()), "image", [], "any", false, false, false, 19)) && is_string($_v1 = "https://") && str_starts_with($_v0, $_v1))) {
                // line 20
                yield "                            <img src=\"";
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 20, $this->source); })()), "image", [], "any", false, false, false, 20), "html", null, true);
                yield "\" class=\"img-fluid w-100 object-fit-cover\" style=\"max-height: 350px;\" alt=\"";
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 20, $this->source); })()), "name", [], "any", false, false, false, 20), "html", null, true);
                yield "\">
                        ";
            } else {
                // line 22
                yield "                            <img src=\"";
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/categories/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 22, $this->source); })()), "image", [], "any", false, false, false, 22))), "html", null, true);
                yield "\" class=\"img-fluid w-100 object-fit-cover\" style=\"max-height: 350px;\" alt=\"";
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 22, $this->source); })()), "name", [], "any", false, false, false, 22), "html", null, true);
                yield "\">
                        ";
            }
            // line 24
            yield "                    ";
        } else {
            // line 25
            yield "                        <div class=\"text-muted d-flex align-items-center justify-content-center\" style=\"height: 300px;\">
                            <i class=\"bi bi-folder2-image display-1\"></i>
                        </div>
                    ";
        }
        // line 29
        yield "                </div>
            </div>
            <div class=\"col-lg-7\">
                <span class=\"badge bg-secondary mb-3 px-3 py-2 rounded-pill\">Catégorie</span>
                <h1 class=\"fw-bold text-dark display-6 mb-3\">";
        // line 33
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 33, $this->source); })()), "name", [], "any", false, false, false, 33), "html", null, true);
        yield "</h1>
                <p class=\"text-muted\" style=\"line-height: 1.8;\">
                    ";
        // line 35
        yield (string) (((CoreExtension::getAttribute($this->env, $this->source, ($context["category"] ?? null), "description", [], "any", true, true, false, 35) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 35, $this->source); })()), "description", [], "any", false, false, false, 35)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 35, $this->source); })()), "description", [], "any", false, false, false, 35), "html", null, true)) : ("Aucune description disponible pour cette catégorie."));
        yield "
                </p>
            </div>
        </div>

        <hr class=\"text-muted opacity-25 my-5\">

        <div class=\"mb-4\">
            <h2 class=\"h3 fw-bold text-dark mb-4\">Produits dans cette catégorie</h2>
        </div>

        <div class=\"row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4\">
            ";
        // line 47
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["products"]) || array_key_exists("products", $context) ? $context["products"] : (function () { throw new RuntimeError('Variable "products" does not exist.', 47, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 48
            yield "                <div class=\"col\">
                    <div class=\"card h-100 shadow-sm border-0 rounded-4 overflow-hidden product-card\">
                        ";
            // line 50
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["product"], "image", [], "any", true, true, false, 50) && (($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 50)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) {
                // line 51
                yield "                            ";
                if ((is_string($_v2 = CoreExtension::getAttribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 51)) && is_string($_v3 = "https://") && str_starts_with($_v2, $_v3))) {
                    // line 52
                    yield "                                <img src=\"";
                    yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 52), "html", null, true);
                    yield "\" class=\"card-img-top object-fit-cover\" style=\"height: 240px;\" alt=\"";
                    yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "title", [], "any", false, false, false, 52), "html", null, true);
                    yield "\">
                            ";
                } else {
                    // line 54
                    yield "                                <img src=\"";
                    yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/products/" . CoreExtension::getAttribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 54))), "html", null, true);
                    yield "\" class=\"card-img-top object-fit-cover\" style=\"height: 240px;\" alt=\"";
                    yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "title", [], "any", false, false, false, 54), "html", null, true);
                    yield "\">
                            ";
                }
                // line 56
                yield "                        ";
            } else {
                // line 57
                yield "                            <div class=\"bg-light text-muted d-flex align-items-center justify-content-center\"
                                 style=\"height: 240px;\">
                                <i class=\"bi bi-image fs-1\"></i>
                            </div>
                        ";
            }
            // line 62
            yield "
                        <div class=\"card-body d-flex flex-column\">
                            <h3 class=\"h5 card-title fw-bold text-dark mb-2\">
                                <a href=\"";
            // line 65
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_product_show", ["slug" => CoreExtension::getAttribute($this->env, $this->source, $context["product"], "slug", [], "any", false, false, false, 65)]), "html", null, true);
            yield "\"
                                   class=\"text-decoration-none text-dark stretched-link\">
                                    ";
            // line 67
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "title", [], "any", false, false, false, 67), "html", null, true);
            yield "
                                </a>
                            </h3>
                            <p class=\"card-text text-muted small flex-grow-1\">
                                ";
            // line 71
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 71)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 71), 0, 85) . "..."), "html", null, true)) : (""));
            yield "
                            </p>
                            <div class=\"d-flex justify-content-between align-items-center mt-3 pt-2 border-top\">
                                <span class=\"fs-5 fw-bold text-primary\">";
            // line 74
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "indicativePrice", [], "any", false, false, false, 74), "html", null, true);
            yield " €</span>
                                <span class=\"btn btn-sm btn-outline-primary rounded-pill px-3\">Voir</span>
                            </div>
                        </div>
                    </div>
                </div>
            ";
            $context['_iterated'] = true;
        }
        // line 80
        if (!$context['_iterated']) {
            // line 81
            yield "                <div class=\"col-12\">
                    <div class=\"alert alert-info text-center py-4 rounded-4 shadow-sm\" role=\"alert\">
                        Aucun produit n\x27est associé à cette catégorie pour le moment.
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['product'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 87
        yield "        </div>

        <div class=\"mt-5\">
            <a href=\"";
        // line 90
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_category_index");
        yield "\" class=\"btn btn-outline-dark rounded-pill px-4\">
                <i class=\"bi bi-arrow-left me-2\"></i> Retour à la liste des catégories
            </a>
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
        return "front/category/show.html.twig";
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
        return array (  270 => 90,  265 => 87,  253 => 81,  251 => 80,  240 => 74,  234 => 71,  227 => 67,  222 => 65,  217 => 62,  210 => 57,  207 => 56,  199 => 54,  191 => 52,  188 => 51,  186 => 50,  182 => 48,  177 => 47,  162 => 35,  157 => 33,  151 => 29,  145 => 25,  142 => 24,  134 => 22,  126 => 20,  123 => 19,  121 => 18,  111 => 11,  106 => 9,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27front/base.html.twig\x27 %}

{% block title %}{{ category.name }}{% endblock %}

{% block body %}
    <div class=\"container my-5\">
        <nav aria-label=\"breadcrumb\" class=\"mb-4\">
            <ol class=\"breadcrumb\">
                <li class=\"breadcrumb-item\"><a href=\"{{ path(\x27app_category_index\x27) }}\"
                                               class=\"text-decoration-none text-muted\">Catégories</a></li>
                <li class=\"breadcrumb-item active text-dark fw-semibold\" aria-current=\"page\">{{ category.name }}</li>
            </ol>
        </nav>

        <div class=\"row g-5 align-items-center mb-5\">
            <div class=\"col-lg-5\">
                <div class=\"card border-0 shadow-sm rounded-4 overflow-hidden bg-light\">
                    {% if category.image is defined and category.image %}
                        {% if category.image starts with \x27https://\x27 %}
                            <img src=\"{{ category.image }}\" class=\"img-fluid w-100 object-fit-cover\" style=\"max-height: 350px;\" alt=\"{{ category.name }}\">
                        {% else %}
                            <img src=\"{{ asset(\x27uploads/categories/\x27 ~ category.image) }}\" class=\"img-fluid w-100 object-fit-cover\" style=\"max-height: 350px;\" alt=\"{{ category.name }}\">
                        {% endif %}
                    {% else %}
                        <div class=\"text-muted d-flex align-items-center justify-content-center\" style=\"height: 300px;\">
                            <i class=\"bi bi-folder2-image display-1\"></i>
                        </div>
                    {% endif %}
                </div>
            </div>
            <div class=\"col-lg-7\">
                <span class=\"badge bg-secondary mb-3 px-3 py-2 rounded-pill\">Catégorie</span>
                <h1 class=\"fw-bold text-dark display-6 mb-3\">{{ category.name }}</h1>
                <p class=\"text-muted\" style=\"line-height: 1.8;\">
                    {{ category.description ?? \x27Aucune description disponible pour cette catégorie.\x27 }}
                </p>
            </div>
        </div>

        <hr class=\"text-muted opacity-25 my-5\">

        <div class=\"mb-4\">
            <h2 class=\"h3 fw-bold text-dark mb-4\">Produits dans cette catégorie</h2>
        </div>

        <div class=\"row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4\">
            {% for product in products %}
                <div class=\"col\">
                    <div class=\"card h-100 shadow-sm border-0 rounded-4 overflow-hidden product-card\">
                        {% if product.image is defined and product.image %}
                            {% if product.image starts with \x27https://\x27 %}
                                <img src=\"{{ product.image }}\" class=\"card-img-top object-fit-cover\" style=\"height: 240px;\" alt=\"{{ product.title }}\">
                            {% else %}
                                <img src=\"{{ asset(\x27uploads/products/\x27 ~ product.image) }}\" class=\"card-img-top object-fit-cover\" style=\"height: 240px;\" alt=\"{{ product.title }}\">
                            {% endif %}
                        {% else %}
                            <div class=\"bg-light text-muted d-flex align-items-center justify-content-center\"
                                 style=\"height: 240px;\">
                                <i class=\"bi bi-image fs-1\"></i>
                            </div>
                        {% endif %}

                        <div class=\"card-body d-flex flex-column\">
                            <h3 class=\"h5 card-title fw-bold text-dark mb-2\">
                                <a href=\"{{ path(\x27app_product_show\x27, {slug: product.slug}) }}\"
                                   class=\"text-decoration-none text-dark stretched-link\">
                                    {{ product.title }}
                                </a>
                            </h3>
                            <p class=\"card-text text-muted small flex-grow-1\">
                                {{ product.description ? product.description|slice(0, 85) ~ \x27...\x27 : \x27\x27 }}
                            </p>
                            <div class=\"d-flex justify-content-between align-items-center mt-3 pt-2 border-top\">
                                <span class=\"fs-5 fw-bold text-primary\">{{ product.indicativePrice }} €</span>
                                <span class=\"btn btn-sm btn-outline-primary rounded-pill px-3\">Voir</span>
                            </div>
                        </div>
                    </div>
                </div>
            {% else %}
                <div class=\"col-12\">
                    <div class=\"alert alert-info text-center py-4 rounded-4 shadow-sm\" role=\"alert\">
                        Aucun produit n\x27est associé à cette catégorie pour le moment.
                    </div>
                </div>
            {% endfor %}
        </div>

        <div class=\"mt-5\">
            <a href=\"{{ path(\x27app_category_index\x27) }}\" class=\"btn btn-outline-dark rounded-pill px-4\">
                <i class=\"bi bi-arrow-left me-2\"></i> Retour à la liste des catégories
            </a>
        </div>
    </div>
{% endblock %}
", "front/category/show.html.twig", "/var/www/html/templates/front/category/show.html.twig");
    }
}
