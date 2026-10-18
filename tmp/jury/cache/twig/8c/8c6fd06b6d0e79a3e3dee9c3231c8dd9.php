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

/* front/common/footer.html.twig */
class __TwigTemplate_e12df4ccc0425578169201e94b1142bd extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/common/footer.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/common/footer.html.twig"));

        // line 1
        yield "<footer>
    <!-- Feature Bar Bottom -->
    <div class=\"feature-bar bg-white\">
        <div class=\"container\">
            <div class=\"row text-center text-md-start g-4\">
                <div class=\"col-md-3 d-flex align-items-center justify-content-center justify-content-md-start\">
                    <i class=\"fas fa-heart fa-2x text-warning me-3\"></i>
                    <div>
                        <h6 class=\"fw-bold mb-0\">Fait avec passion</h6>
                        <small class=\"text-muted\">Un savoir-faire artisanal et des finitions soignées.</small>
                    </div>
                </div>
                <div class=\"col-md-3 d-flex align-items-center justify-content-center justify-content-md-start\">
                    <i class=\"fas fa-award fa-2x text-warning me-3\"></i>
                    <div>
                        <h6 class=\"fw-bold mb-0\">Qualité & Durabilité</h6>
                        <small class=\"text-muted\">Matériaux sélectionnés pour durer dans le temps.</small>
                    </div>
                </div>
                <div class=\"col-md-3 d-flex align-items-center justify-content-center justify-content-md-start\">
                    <i class=\"fas fa-hands-helping fa-2x text-warning me-3\"></i>
                    <div>
                        <h6 class=\"fw-bold mb-0\">Écoute & Conseil</h6>
                        <small class=\"text-muted\">Accompagnement personnalisé à chaque étape.</small>
                    </div>
                </div>
                <div class=\"col-md-3 d-flex align-items-center justify-content-center justify-content-md-start\">
                    <i class=\"fas fa-map-marker-alt fa-2x text-warning me-3\"></i>
                    <div>
                        <h6 class=\"fw-bold mb-0\">Atelier Local</h6>
                        <small class=\"text-muted\">Basé à Clermont-Ferrand (63), au cœur de l’Auvergne.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class=\"container text-center py-3\">
        <a href=\"";
        // line 40
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_privacy");
        yield "\">Données personnelles et confidentialité</a>
    </div>
</footer>
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
        return "front/common/footer.html.twig";
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
        return array (  90 => 40,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<footer>
    <!-- Feature Bar Bottom -->
    <div class=\"feature-bar bg-white\">
        <div class=\"container\">
            <div class=\"row text-center text-md-start g-4\">
                <div class=\"col-md-3 d-flex align-items-center justify-content-center justify-content-md-start\">
                    <i class=\"fas fa-heart fa-2x text-warning me-3\"></i>
                    <div>
                        <h6 class=\"fw-bold mb-0\">Fait avec passion</h6>
                        <small class=\"text-muted\">Un savoir-faire artisanal et des finitions soignées.</small>
                    </div>
                </div>
                <div class=\"col-md-3 d-flex align-items-center justify-content-center justify-content-md-start\">
                    <i class=\"fas fa-award fa-2x text-warning me-3\"></i>
                    <div>
                        <h6 class=\"fw-bold mb-0\">Qualité & Durabilité</h6>
                        <small class=\"text-muted\">Matériaux sélectionnés pour durer dans le temps.</small>
                    </div>
                </div>
                <div class=\"col-md-3 d-flex align-items-center justify-content-center justify-content-md-start\">
                    <i class=\"fas fa-hands-helping fa-2x text-warning me-3\"></i>
                    <div>
                        <h6 class=\"fw-bold mb-0\">Écoute & Conseil</h6>
                        <small class=\"text-muted\">Accompagnement personnalisé à chaque étape.</small>
                    </div>
                </div>
                <div class=\"col-md-3 d-flex align-items-center justify-content-center justify-content-md-start\">
                    <i class=\"fas fa-map-marker-alt fa-2x text-warning me-3\"></i>
                    <div>
                        <h6 class=\"fw-bold mb-0\">Atelier Local</h6>
                        <small class=\"text-muted\">Basé à Clermont-Ferrand (63), au cœur de l’Auvergne.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class=\"container text-center py-3\">
        <a href=\"{{ path(\x27app_privacy\x27) }}\">Données personnelles et confidentialité</a>
    </div>
</footer>
", "front/common/footer.html.twig", "/var/www/html/templates/front/common/footer.html.twig");
    }
}
