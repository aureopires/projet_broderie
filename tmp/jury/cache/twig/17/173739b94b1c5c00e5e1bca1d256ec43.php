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

/* front/legal/_privacy_notice.html.twig */
class __TwigTemplate_b6c993b393362e8e8ddd1518f66dc788 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/legal/_privacy_notice.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/legal/_privacy_notice.html.twig"));

        // line 1
        yield "<p class=\"small text-muted mt-3\">
    Oceane Roux, responsable de L’Aiguille des Volcans, utilise vos informations pour ";
        // line 2
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["purpose"]) || array_key_exists("purpose", $context) ? $context["purpose"] : (function () { throw new RuntimeError('Variable "purpose" does not exist.', 2, $this->source); })()), "html", null, true);
        yield ".
    Tous les champs sont obligatoires";
        // line 3
        if ((($tmp = ((array_key_exists("optionalFields", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["optionalFields"]) || array_key_exists("optionalFields", $context) ? $context["optionalFields"] : (function () { throw new RuntimeError('Variable "optionalFields" does not exist.', 3, $this->source); })()), "")) : (""))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield ", sauf ";
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["optionalFields"]) || array_key_exists("optionalFields", $context) ? $context["optionalFields"] : (function () { throw new RuntimeError('Variable "optionalFields" does not exist.', 3, $this->source); })()), "html", null, true);
        }
        yield ".
    Sans les informations obligatoires, le formulaire ne peut pas être validé.
    <a href=\"";
        // line 5
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_privacy");
        yield "\">Consultez les informations sur vos données personnelles et vos droits.</a>
</p>
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
        return "front/legal/_privacy_notice.html.twig";
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
        return array (  64 => 5,  56 => 3,  52 => 2,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<p class=\"small text-muted mt-3\">
    Oceane Roux, responsable de L’Aiguille des Volcans, utilise vos informations pour {{ purpose }}.
    Tous les champs sont obligatoires{% if optionalFields|default(\x27\x27) %}, sauf {{ optionalFields }}{% endif %}.
    Sans les informations obligatoires, le formulaire ne peut pas être validé.
    <a href=\"{{ path(\x27app_privacy\x27) }}\">Consultez les informations sur vos données personnelles et vos droits.</a>
</p>
", "front/legal/_privacy_notice.html.twig", "/var/www/html/templates/front/legal/_privacy_notice.html.twig");
    }
}
