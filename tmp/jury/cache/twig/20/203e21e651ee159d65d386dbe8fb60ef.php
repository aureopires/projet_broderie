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

/* admin/admin_quote_request/show.html.twig */
class __TwigTemplate_df8cd1ea5bf205925e55aa1fa01919c3 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/admin_quote_request/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/admin_quote_request/show.html.twig"));

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
        yield "    <h1>Demande de devis</h1>

    <a href=\"";
        // line 6
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_quote_request_index");
        yield "\">Retour à la liste</a>

    <table class=\"table\">
        <tbody>
            <tr>
                <th>Nom</th>
                <td>";
        // line 12
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 12, $this->source); })()), "name", [], "any", false, false, false, 12), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>";
        // line 16
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 16, $this->source); })()), "email", [], "any", false, false, false, 16), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Message</th>
                <td>";
        // line 20
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 20, $this->source); })()), "message", [], "any", false, false, false, 20), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Type d\x27article</th>
                <td>";
        // line 24
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 24, $this->source); })()), "articleType", [], "any", false, false, false, 24), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Origine de l\x27article</th>
                <td>";
        // line 28
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 28, $this->source); })()), "articleOrigin", [], "any", false, false, false, 28), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Type de marquage</th>
                <td>";
        // line 32
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 32, $this->source); })()), "markingType", [], "any", false, false, false, 32), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Logo</th>
                <td>
                    ";
        // line 37
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 37, $this->source); })()), "logo", [], "any", false, false, false, 37)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 38
            yield "                        <a href=\"";
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_quote_request_logo", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 38, $this->source); })()), "id", [], "any", false, false, false, 38)]), "html", null, true);
            yield "\">Télécharger le logo</a>
                    ";
        }
        // line 40
        yield "                </td>
            </tr>
            <tr>
                <th>Quantité</th>
                <td>";
        // line 44
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 44, $this->source); })()), "quantity", [], "any", false, false, false, 44), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Type d\x27organisme</th>
                <td>";
        // line 48
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 48, $this->source); })()), "organizationType", [], "any", false, false, false, 48), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Nom de l\x27organisme</th>
                <td>";
        // line 52
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 52, $this->source); })()), "organizationName", [], "any", false, false, false, 52), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>";
        // line 56
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 56, $this->source); })()), "phone", [], "any", false, false, false, 56), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Utilisateur</th>
                <td>";
        // line 60
        yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 60, $this->source); })()), "user", [], "any", false, false, false, 60)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 60, $this->source); })()), "user", [], "any", false, false, false, 60), "id", [], "any", false, false, false, 60), "html", null, true)) : (""));
        yield "</td>
            </tr>
            <tr>
                <th>Statut</th>
                <td>";
        // line 64
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 64, $this->source); })()), "status", [], "any", false, false, false, 64), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Créé le</th>
                <td>";
        // line 68
        yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 68, $this->source); })()), "createdAt", [], "any", false, false, false, 68)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 68, $this->source); })()), "createdAt", [], "any", false, false, false, 68), "Y-m-d H:i:s"), "html", null, true)) : (""));
        yield "</td>
            </tr>
        </tbody>
    </table>

    <a href=\"";
        // line 73
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_quote_request_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["quote_request"]) || array_key_exists("quote_request", $context) ? $context["quote_request"] : (function () { throw new RuntimeError('Variable "quote_request" does not exist.', 73, $this->source); })()), "id", [], "any", false, false, false, 73)]), "html", null, true);
        yield "\" class=\"btn btn-warning\">Modifier</a>

    ";
        // line 75
        yield (string) Twig\Extension\CoreExtension::include($this->env, $context, "admin/admin_quote_request/_delete_form.html.twig");
        yield "
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
        return "admin/admin_quote_request/show.html.twig";
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
        return array (  202 => 75,  197 => 73,  189 => 68,  182 => 64,  175 => 60,  168 => 56,  161 => 52,  154 => 48,  147 => 44,  141 => 40,  135 => 38,  133 => 37,  125 => 32,  118 => 28,  111 => 24,  104 => 20,  97 => 16,  90 => 12,  81 => 6,  77 => 4,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27admin/base.html.twig\x27 %}

{% block body %}
    <h1>Demande de devis</h1>

    <a href=\"{{ path(\x27admin_quote_request_index\x27) }}\">Retour à la liste</a>

    <table class=\"table\">
        <tbody>
            <tr>
                <th>Nom</th>
                <td>{{ quote_request.name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ quote_request.email }}</td>
            </tr>
            <tr>
                <th>Message</th>
                <td>{{ quote_request.message }}</td>
            </tr>
            <tr>
                <th>Type d\x27article</th>
                <td>{{ quote_request.articleType }}</td>
            </tr>
            <tr>
                <th>Origine de l\x27article</th>
                <td>{{ quote_request.articleOrigin }}</td>
            </tr>
            <tr>
                <th>Type de marquage</th>
                <td>{{ quote_request.markingType }}</td>
            </tr>
            <tr>
                <th>Logo</th>
                <td>
                    {% if quote_request.logo %}
                        <a href=\"{{ path(\x27admin_quote_request_logo\x27, {id: quote_request.id}) }}\">Télécharger le logo</a>
                    {% endif %}
                </td>
            </tr>
            <tr>
                <th>Quantité</th>
                <td>{{ quote_request.quantity }}</td>
            </tr>
            <tr>
                <th>Type d\x27organisme</th>
                <td>{{ quote_request.organizationType }}</td>
            </tr>
            <tr>
                <th>Nom de l\x27organisme</th>
                <td>{{ quote_request.organizationName }}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{{ quote_request.phone }}</td>
            </tr>
            <tr>
                <th>Utilisateur</th>
                <td>{{ quote_request.user ? quote_request.user.id : \x27\x27 }}</td>
            </tr>
            <tr>
                <th>Statut</th>
                <td>{{ quote_request.status }}</td>
            </tr>
            <tr>
                <th>Créé le</th>
                <td>{{ quote_request.createdAt ? quote_request.createdAt|date(\x27Y-m-d H:i:s\x27) : \x27\x27 }}</td>
            </tr>
        </tbody>
    </table>

    <a href=\"{{ path(\x27admin_quote_request_edit\x27, {\x27id\x27: quote_request.id}) }}\" class=\"btn btn-warning\">Modifier</a>

    {{ include(\x27admin/admin_quote_request/_delete_form.html.twig\x27) }}
{% endblock %}
", "admin/admin_quote_request/show.html.twig", "/var/www/html/templates/admin/admin_quote_request/show.html.twig");
    }
}
