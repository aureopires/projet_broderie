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

/* common/_alert.html.twig */
class __TwigTemplate_1959a2cbceca8bd36bcdc13b8329482f extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "common/_alert.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "common/_alert.html.twig"));

        // line 1
        yield "
";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 2, $this->source); })()), "flashes", [], "any", false, false, false, 2));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 3
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 4
                yield "        <div class=\"alert alert-";
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield " d-flex align-items-center\" role=\"alert\">
            ";
                // line 5
                if (($context["label"] == "danger")) {
                    // line 6
                    yield "                <i class=\"fa-solid fa-triangle-exclamation\"></i>
            ";
                } elseif ((                // line 7
$context["label"] == "warning")) {
                    // line 8
                    yield "                <i class=\"fa-solid fa-triangle-exclamation\"></i>
            ";
                } elseif ((                // line 9
$context["label"] == "success")) {
                    // line 10
                    yield "                <i class=\"fa-solid fa-circle-check\"></i>
            ";
                }
                // line 12
                yield "            <div class=\"ms-2\">";
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "</div>
            <button type=\"button\" class=\"btn-close ms-auto\" aria-label=\"Fermer\" data-bs-dismiss=\"alert\"></button>
        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent);
            $context += $_parent;
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "common/_alert.html.twig";
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
        return array (  82 => 12,  78 => 10,  76 => 9,  73 => 8,  71 => 7,  68 => 6,  66 => 5,  61 => 4,  56 => 3,  52 => 2,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("
{% for label, messages in app.flashes %}
    {% for message in messages %}
        <div class=\"alert alert-{{ label }} d-flex align-items-center\" role=\"alert\">
            {% if label == \x27danger\x27 %}
                <i class=\"fa-solid fa-triangle-exclamation\"></i>
            {% elseif label == \x27warning\x27 %}
                <i class=\"fa-solid fa-triangle-exclamation\"></i>
            {% elseif label == \x27success\x27 %}
                <i class=\"fa-solid fa-circle-check\"></i>
            {% endif %}
            <div class=\"ms-2\">{{ message }}</div>
            <button type=\"button\" class=\"btn-close ms-auto\" aria-label=\"Fermer\" data-bs-dismiss=\"alert\"></button>
        </div>
    {% endfor %}
{% endfor %}
", "common/_alert.html.twig", "/var/www/html/templates/common/_alert.html.twig");
    }
}
