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

/* front/product/index.html.twig */
class __TwigTemplate_4ca17fba027cb9d82d13752b5335d7fb extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/product/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/product/index.html.twig"));

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

        yield "Nos Créations Brodées";
        
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
        <div class=\"text-center mb-5\">
            <h1 class=\"display-5 fw-bold text-dark\">Nos Créations Brodées</h1>
            <p class=\"text-muted\">Découvrez notre collection exclusive de pièces uniques brodées avec amour.</p>
        </div>

        ";
        // line 12
        if ((array_key_exists("categories", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 12, $this->source); })())) > 0))) {
            // line 13
            yield "            <div class=\"mb-5 text-center\">
                <h3 class=\"h6 text-uppercase text-secondary fw-bold mb-3 tracking-wide\">Catégories</h3>
                <div class=\"d-flex justify-content-center flex-wrap gap-2\">
                    ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 16, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 17
                yield "                        <a href=\"";
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_category_show", ["slug" => CoreExtension::getAttribute($this->env, $this->source, $context["category"], "slug", [], "any", false, false, false, 17)]), "html", null, true);
                yield "\"
                           class=\"btn btn-outline-dark btn-sm rounded-pill px-3 py-2\">
                            ";
                // line 19
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 19), "html", null, true);
                yield "
                        </a>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['category'], $context['_parent']);
            $context = array_intersect_key($context, $_parent);
            $context += $_parent;
            // line 22
            yield "                </div>
            </div>
        ";
        }
        // line 25
        yield "
        <div class=\"row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4\">
            ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["products"]) || array_key_exists("products", $context) ? $context["products"] : (function () { throw new RuntimeError('Variable "products" does not exist.', 27, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 28
            yield "                <div class=\"col\">
                    <div class=\"card h-100 shadow-sm border-0 rounded-4 overflow-hidden product-card\">
                        ";
            // line 30
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["product"], "image", [], "any", true, true, false, 30) && (($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 30)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) {
                // line 31
                yield "                            ";
                if ((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 31)) && is_string($_v1 = "https://") && str_starts_with($_v0, $_v1))) {
                    // line 32
                    yield "                                <img src=\"";
                    yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 32), "html", null, true);
                    yield "\" class=\"card-img-top object-fit-cover\" style=\"height: 240px;\" alt=\"";
                    yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "title", [], "any", false, false, false, 32), "html", null, true);
                    yield "\">
                            ";
                } else {
                    // line 34
                    yield "                                <img src=\"";
                    yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/products/" . CoreExtension::getAttribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 34))), "html", null, true);
                    yield "\" class=\"card-img-top object-fit-cover\" style=\"height: 240px;\" alt=\"";
                    yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "title", [], "any", false, false, false, 34), "html", null, true);
                    yield "\">
                            ";
                }
                // line 36
                yield "                        ";
            } else {
                // line 37
                yield "                            <div class=\"bg-light text-muted d-flex align-items-center justify-content-center\"
                                 style=\"height: 240px;\">
                                <i class=\"bi bi-image fs-1\"></i>
                            </div>
                        ";
            }
            // line 42
            yield "
                        <div class=\"card-body d-flex flex-column\">
                            <h3 class=\"h5 card-title fw-bold text-dark mb-2\">
                                <a href=\"";
            // line 45
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_product_show", ["slug" => CoreExtension::getAttribute($this->env, $this->source, $context["product"], "slug", [], "any", false, false, false, 45)]), "html", null, true);
            yield "\"
                                   class=\"text-decoration-none text-dark stretched-link\">
                                    ";
            // line 47
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "title", [], "any", false, false, false, 47), "html", null, true);
            yield "
                                </a>
                            </h3>
                            <p class=\"card-text text-muted small flex-grow-1\">
                                ";
            // line 51
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 51), 0, 85) . "..."), "html", null, true)) : (""));
            yield "
                            </p>
                            <div class=\"d-flex justify-content-between align-items-center mt-3 pt-2 border-top\">
                                <span class=\"fs-5 fw-bold text-primary\">";
            // line 54
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "indicativePrice", [], "any", false, false, false, 54), "html", null, true);
            yield " €</span>
                                <span class=\"btn btn-sm btn-outline-primary rounded-pill px-3\">Voir</span>
                            </div>
                        </div>
                    </div>
                </div>
            ";
            $context['_iterated'] = true;
        }
        // line 60
        if (!$context['_iterated']) {
            // line 61
            yield "                <div class=\"col-12\">
                    <div class=\"alert alert-info text-center py-4 rounded-4 shadow-sm\" role=\"alert\">
                        Aucun produit disponible pour le moment.
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['product'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 67
        yield "        </div>
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
        return "front/product/index.html.twig";
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
        return array (  233 => 67,  221 => 61,  219 => 60,  208 => 54,  202 => 51,  195 => 47,  190 => 45,  185 => 42,  178 => 37,  175 => 36,  167 => 34,  159 => 32,  156 => 31,  154 => 30,  150 => 28,  145 => 27,  141 => 25,  136 => 22,  126 => 19,  120 => 17,  116 => 16,  111 => 13,  109 => 12,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27front/base.html.twig\x27 %}

{% block title %}Nos Créations Brodées{% endblock %}

{% block body %}
    <div class=\"container my-5\">
        <div class=\"text-center mb-5\">
            <h1 class=\"display-5 fw-bold text-dark\">Nos Créations Brodées</h1>
            <p class=\"text-muted\">Découvrez notre collection exclusive de pièces uniques brodées avec amour.</p>
        </div>

        {% if categories is defined and categories|length > 0 %}
            <div class=\"mb-5 text-center\">
                <h3 class=\"h6 text-uppercase text-secondary fw-bold mb-3 tracking-wide\">Catégories</h3>
                <div class=\"d-flex justify-content-center flex-wrap gap-2\">
                    {% for category in categories %}
                        <a href=\"{{ path(\x27app_category_show\x27, {slug: category.slug}) }}\"
                           class=\"btn btn-outline-dark btn-sm rounded-pill px-3 py-2\">
                            {{ category.name }}
                        </a>
                    {% endfor %}
                </div>
            </div>
        {% endif %}

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
                        Aucun produit disponible pour le moment.
                    </div>
                </div>
            {% endfor %}
        </div>
    </div>
{% endblock %}
", "front/product/index.html.twig", "/var/www/html/templates/front/product/index.html.twig");
    }
}
