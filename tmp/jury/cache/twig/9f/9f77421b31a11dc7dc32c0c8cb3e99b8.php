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

/* admin/admin_quote_request/index.html.twig */
class __TwigTemplate_b64fb66db3d2cf6cb895c210ac4af0b8 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/admin_quote_request/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/admin_quote_request/index.html.twig"));

        $this->parent = $this->load("admin/base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
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

        // line 4
        yield "    <h1>Demandes de devis</h1>

    <a href=\"";
        // line 6
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_quote_request_new");
        yield "\">Créer</a>

    <div class=\"table-responsive\">
    <table class=\"table\">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Message</th>
                <th>Statut</th>
                <th>Créé le</th>
                <th>Article</th>
                <th>Origine</th>
                <th>Marquage</th>
                <th>Logo</th>
                <th>Quantité</th>
                <th>Organisme</th>
                <th>Nom organisme</th>
                <th>Téléphone</th>
                <th>Utilisateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["quote_requests"]) || array_key_exists("quote_requests", $context) ? $context["quote_requests"] : (function () { throw new RuntimeError('Variable "quote_requests" does not exist.', 30, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["quote_request"]) {
            // line 31
            yield "            <tr>
                <td>";
            // line 32
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "name", [], "any", false, false, false, 32), "html", null, true);
            yield "</td>
                <td>";
            // line 33
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "email", [], "any", false, false, false, 33), "html", null, true);
            yield "</td>
                <td>";
            // line 34
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "message", [], "any", false, false, false, 34), "html", null, true);
            yield "</td>
                <td>";
            // line 35
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "status", [], "any", false, false, false, 35), "html", null, true);
            yield "</td>
                <td>";
            // line 36
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "createdAt", [], "any", false, false, false, 36)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "createdAt", [], "any", false, false, false, 36), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                <td>";
            // line 37
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "articleType", [], "any", false, false, false, 37), "html", null, true);
            yield "</td>
                <td>";
            // line 38
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "articleOrigin", [], "any", false, false, false, 38), "html", null, true);
            yield "</td>
                <td>";
            // line 39
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "markingType", [], "any", false, false, false, 39), "html", null, true);
            yield "</td>
                <td>
                    ";
            // line 41
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "logo", [], "any", false, false, false, 41)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 42
                yield "                        <a href=\"";
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_quote_request_logo", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "id", [], "any", false, false, false, 42)]), "html", null, true);
                yield "\">Télécharger le logo</a>
                    ";
            } else {
                // line 44
                yield "                        Aucun logo
                    ";
            }
            // line 46
            yield "                </td>
                <td>";
            // line 47
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "quantity", [], "any", false, false, false, 47), "html", null, true);
            yield "</td>
                <td>";
            // line 48
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "organizationType", [], "any", false, false, false, 48), "html", null, true);
            yield "</td>
                <td>";
            // line 49
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "organizationName", [], "any", false, false, false, 49), "html", null, true);
            yield "</td>
                <td>";
            // line 50
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "phone", [], "any", false, false, false, 50), "html", null, true);
            yield "</td>
                <td>";
            // line 51
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "user", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "user", [], "any", false, false, false, 51), "id", [], "any", false, false, false, 51), "html", null, true)) : (""));
            yield "</td>
                <td>
                    <a href=\"";
            // line 53
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_quote_request_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "id", [], "any", false, false, false, 53)]), "html", null, true);
            yield "\">Voir</a>
                    <a href=\"";
            // line 54
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_quote_request_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["quote_request"], "id", [], "any", false, false, false, 54)]), "html", null, true);
            yield "\">Modifier</a>
                </td>
            </tr>
        ";
            $context['_iterated'] = true;
        }
        // line 57
        if (!$context['_iterated']) {
            // line 58
            yield "            <tr>
                <td colspan=\"15\">Aucun enregistrement.</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['quote_request'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 62
        yield "        </tbody>
    </table>
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
        return "admin/admin_quote_request/index.html.twig";
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
        return array (  209 => 62,  199 => 58,  197 => 57,  189 => 54,  185 => 53,  180 => 51,  176 => 50,  172 => 49,  168 => 48,  164 => 47,  161 => 46,  157 => 44,  151 => 42,  149 => 41,  144 => 39,  140 => 38,  136 => 37,  132 => 36,  128 => 35,  124 => 34,  120 => 33,  116 => 32,  113 => 31,  108 => 30,  81 => 6,  77 => 4,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27admin/base.html.twig\x27 %}

{% block body %}
    <h1>Demandes de devis</h1>

    <a href=\"{{ path(\x27admin_quote_request_new\x27) }}\">Créer</a>

    <div class=\"table-responsive\">
    <table class=\"table\">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Message</th>
                <th>Statut</th>
                <th>Créé le</th>
                <th>Article</th>
                <th>Origine</th>
                <th>Marquage</th>
                <th>Logo</th>
                <th>Quantité</th>
                <th>Organisme</th>
                <th>Nom organisme</th>
                <th>Téléphone</th>
                <th>Utilisateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        {% for quote_request in quote_requests %}
            <tr>
                <td>{{ quote_request.name }}</td>
                <td>{{ quote_request.email }}</td>
                <td>{{ quote_request.message }}</td>
                <td>{{ quote_request.status }}</td>
                <td>{{ quote_request.createdAt ? quote_request.createdAt|date(\x27Y-m-d H:i:s\x27) : \x27\x27 }}</td>
                <td>{{ quote_request.articleType }}</td>
                <td>{{ quote_request.articleOrigin }}</td>
                <td>{{ quote_request.markingType }}</td>
                <td>
                    {% if quote_request.logo %}
                        <a href=\"{{ path(\x27admin_quote_request_logo\x27, {id: quote_request.id}) }}\">Télécharger le logo</a>
                    {% else %}
                        Aucun logo
                    {% endif %}
                </td>
                <td>{{ quote_request.quantity }}</td>
                <td>{{ quote_request.organizationType }}</td>
                <td>{{ quote_request.organizationName }}</td>
                <td>{{ quote_request.phone }}</td>
                <td>{{ quote_request.user ? quote_request.user.id : \x27\x27 }}</td>
                <td>
                    <a href=\"{{ path(\x27admin_quote_request_show\x27, {\x27id\x27: quote_request.id}) }}\">Voir</a>
                    <a href=\"{{ path(\x27admin_quote_request_edit\x27, {\x27id\x27: quote_request.id}) }}\">Modifier</a>
                </td>
            </tr>
        {% else %}
            <tr>
                <td colspan=\"15\">Aucun enregistrement.</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
    </div>

{% endblock %}
", "admin/admin_quote_request/index.html.twig", "/var/www/html/templates/admin/admin_quote_request/index.html.twig");
    }
}
