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

/* front/home/index.html.twig */
class __TwigTemplate_cfeb4b80a5ea6ef2677c2258dd4b8167 extends Template
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
        return "front/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/home/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/home/index.html.twig"));

        $this->parent = $this->load("front/base.html.twig", 1);
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
        yield "
    <section class=\"hero-section\">
        <div class=\"container\">
            <div class=\"row align-items-center\">
                <div class=\"col-lg-6 mb-4 mb-lg-0\">
                    <span class=\"hero-subtitle\">Atelier de broderie, personnalisation textile & couture</span>
                    <h1 class=\"hero-title mb-4\">L\x27art du fil, <br>
                        <span style=\"font-style: italic; font-weight: normal; color: var(--primary-color);\">
                            la beauté du sur-mesure</span>
                    </h1>
                    <p class=\"text-muted mb-4\">Des créations uniques brodées avec passion pour les particuliers,
                        professionnels, associations et collectivités.</p>
                    <a href=\"";
        // line 16
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_category_index");
        yield "\" class=\"btn btn-gold\">Découvrir nos prestations <i
                            class=\"fas fa-arrow-right ms-2\"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class=\"py-5 bg-white\">
        <div class=\"container\">
            <div class=\"row justify-content-center mb-5\">
                <div class=\"col-lg-10\">
                    <h2 class=\"fw-bold mt-2\">Bienvenue dans mon atelier de broderie</h2>
                    <p class=\"text-muted mt-3\">
                        Bienvenue dans mon atelier de broderie, personnalisation textile et de couture, un espace où
                        créativité, savoir-faire et passion se rencontrent pour donner vie à chacun de vos projets.
                        Je vous accompagne dans la réalisation de créations uniques et personnalisées que vous soyez un
                        particulier une entreprise une association ou une collectivité. Chaque projet est conçu avec
                        soin en tenant compte de vos envies et de vos besoins afin de vous proposer un résultat de
                        qualité qui vous ressemble.
                        Mes prestations comprennent de la broderie personnalisée sur différents textiles, la
                        personnalisation de vêtements et d’accessoires ainsi que des travaux de couture retouche et des
                        créations sur mesure. Que ce soit pour un cadeau, une tenue professionnelle ou un projet
                        personnel, je mets mon expertise à votre service pour créer des pièces uniques et durables.
                        A travers mon atelier, je souhaite valoriser le travail artisanal, l’écoute et la proximité avec
                        les clients. Chaque réalisation est effectuée avec minutie et le souci du détail dans le but de
                        vous offrir un produit à la hauteur de vos attentes.
                    </p>
                </div>
            </div>

            <div class=\"row justify-content-center mb-5\">
                <div class=\"col-lg-10\">
                    <h3 class=\"fw-bold mb-4 text-center\">Réalisations récentes :</h3>
                    <div class=\"row g-4 justify-content-center\">
                        <div class=\"col-md-4\">
                            <div class=\"d-flex justify-content-center align-items-center bg-light rounded shadow-sm p-2\"
                                 style=\"height: 280px;\">
                                <img src=\"";
        // line 53
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/recent1.jpg"), "html", null, true);
        yield "\" alt=\"Réalisation récente 1\"
                                     class=\"rounded\" style=\"max-height: 100%; max-width: 100%; object-fit: contain;\">
                            </div>
                        </div>
                        <div class=\"col-md-4\">
                            <div class=\"d-flex justify-content-center align-items-center bg-light rounded shadow-sm p-2\"
                                 style=\"height: 280px;\">
                                <img src=\"";
        // line 60
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/recent2.jpg"), "html", null, true);
        yield "\" alt=\"Réalisation récente 2\"
                                     class=\"rounded\" style=\"max-height: 100%; max-width: 100%; object-fit: contain;\">
                            </div>
                        </div>
                        <div class=\"col-md-4\">
                            <div class=\"d-flex justify-content-center align-items-center bg-light rounded shadow-sm p-2\"
                                 style=\"height: 280px;\">
                                <img src=\"";
        // line 67
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/recent3.jpg"), "html", null, true);
        yield "\" alt=\"Réalisation récente 3\"
                                     class=\"rounded\" style=\"max-height: 100%; max-width: 100%; object-fit: contain;\">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"row g-4 text-center mt-4\">
                <h3 class=\"fw-bold mb-4 text-center\">Pour qui ?</h3>

                <div class=\"col-md-4\">
                    <div class=\"p-4 border rounded-3 h-100 bg-light\">
                        <h4 class=\"h5 fw-bold mb-3\">Pour les particuliers</h4>
                        <p class=\"text-muted small\">Faites plaisir ou faites-vous plaisir ! Rendez vos moments en
                            souvenirs inoubliables grâce à des textiles personnalisés.</p>
                    </div>
                </div>
                <div class=\"col-md-4\">
                    <div class=\"p-4 border rounded-3 h-100 bg-light\">
                        <h4 class=\"h5 fw-bold mb-3\">Vous êtes professionnels ?</h4>
                        <p class=\"text-muted small\">Je vous aide à transformer votre image d’entreprise grâce à la
                            broderie, la sublimation ou bien le flocage.</p>
                    </div>
                </div>
                <div class=\"col-md-4\">
                    <div class=\"p-4 border rounded-3 h-100 bg-light\">
                        <h4 class=\"h5 fw-bold mb-3\">Les associations</h4>
                        <p class=\"text-muted small\">Développez l\x27esprit d\x27équipe et l\x27identité de votre association avec
                            des personnalisations de qualité.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class=\"py-5 bg-light\">
        <div class=\"container\">
            <div class=\"text-center mb-5\">
                <span class=\"hero-subtitle\">Témoignages</span>
                <h2 class=\"fw-bold\">Ce que nos clients disent</h2>
            </div>

            <div class=\"row g-4\">
                ";
        // line 111
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["reviews"]) || array_key_exists("reviews", $context) ? $context["reviews"] : (function () { throw new RuntimeError('Variable "reviews" does not exist.', 111, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["review"]) {
            // line 112
            yield "                    <div class=\"col-md-4\">
                        <div class=\"card h-100 border-0 shadow-sm p-3\">
                            <div class=\"card-body d-flex flex-column justify-content-between\">
                                <div>
                                    <div class=\"mb-3 text-warning\">
                                        ";
            // line 117
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(1, 5));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 118
                yield "                                            ";
                if (($context["i"] <= CoreExtension::getAttribute($this->env, $this->source, $context["review"], "rating", [], "any", false, false, false, 118))) {
                    // line 119
                    yield "                                                <i class=\"fas fa-star\"></i>
                                            ";
                } else {
                    // line 121
                    yield "                                                <i class=\"far fa-star\"></i>
                                            ";
                }
                // line 123
                yield "                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
            $context = array_intersect_key($context, $_parent);
            $context += $_parent;
            // line 124
            yield "                                    </div>
                                    <p class=\"card-text text-muted small\" style=\"text-align: justify;\">
                                        \"";
            // line 126
            yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["review"], "content", [], "any", false, false, false, 126), "html", null, true);
            yield "\"</p>
                                </div>
                                <div class=\"mt-3 pt-3 border-top\">
                                    <span class=\"fw-bold small text-dark\">
                                        ";
            // line 130
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["review"], "product", [], "any", false, false, false, 130)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 131
                yield "                                        ";
                yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["review"], "product", [], "any", false, false, false, 131), "title", [], "any", false, false, false, 131), "html", null, true);
                yield " -
                                        ";
            }
            // line 133
            yield "                                        ";
            yield (string) (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["review"], "user", [], "any", false, false, false, 133)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["review"], "user", [], "any", false, false, false, 133), "firstName", [], "any", false, false, false, 133), "html", null, true)) : ("Client"));
            yield "
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            $context['_iterated'] = true;
        }
        // line 139
        if (!$context['_iterated']) {
            // line 140
            yield "                    <div class=\"col-12 text-center text-muted\">
                        <p>Aucun avis pour le moment.</p>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['review'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent);
        $context += $_parent;
        // line 144
        yield "            </div>

            <div class=\"text-end mt-4\">
                <a href=\"";
        // line 147
        yield (string) $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("front_review_index");
        yield "\" class=\"text-dark fw-bold text-decoration-none\">
                    Voir tous les avis <i class=\"fas fa-arrow-right ms-2\"></i>
                </a>
            </div>
        </div>
    </section>



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
        return "front/home/index.html.twig";
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
        return array (  280 => 147,  275 => 144,  265 => 140,  263 => 139,  251 => 133,  245 => 131,  243 => 130,  236 => 126,  232 => 124,  225 => 123,  221 => 121,  217 => 119,  214 => 118,  210 => 117,  203 => 112,  198 => 111,  151 => 67,  141 => 60,  131 => 53,  91 => 16,  77 => 4,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27front/base.html.twig\x27 %}

{% block body %}

    <section class=\"hero-section\">
        <div class=\"container\">
            <div class=\"row align-items-center\">
                <div class=\"col-lg-6 mb-4 mb-lg-0\">
                    <span class=\"hero-subtitle\">Atelier de broderie, personnalisation textile & couture</span>
                    <h1 class=\"hero-title mb-4\">L\x27art du fil, <br>
                        <span style=\"font-style: italic; font-weight: normal; color: var(--primary-color);\">
                            la beauté du sur-mesure</span>
                    </h1>
                    <p class=\"text-muted mb-4\">Des créations uniques brodées avec passion pour les particuliers,
                        professionnels, associations et collectivités.</p>
                    <a href=\"{{ path(\x27app_category_index\x27) }}\" class=\"btn btn-gold\">Découvrir nos prestations <i
                            class=\"fas fa-arrow-right ms-2\"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class=\"py-5 bg-white\">
        <div class=\"container\">
            <div class=\"row justify-content-center mb-5\">
                <div class=\"col-lg-10\">
                    <h2 class=\"fw-bold mt-2\">Bienvenue dans mon atelier de broderie</h2>
                    <p class=\"text-muted mt-3\">
                        Bienvenue dans mon atelier de broderie, personnalisation textile et de couture, un espace où
                        créativité, savoir-faire et passion se rencontrent pour donner vie à chacun de vos projets.
                        Je vous accompagne dans la réalisation de créations uniques et personnalisées que vous soyez un
                        particulier une entreprise une association ou une collectivité. Chaque projet est conçu avec
                        soin en tenant compte de vos envies et de vos besoins afin de vous proposer un résultat de
                        qualité qui vous ressemble.
                        Mes prestations comprennent de la broderie personnalisée sur différents textiles, la
                        personnalisation de vêtements et d’accessoires ainsi que des travaux de couture retouche et des
                        créations sur mesure. Que ce soit pour un cadeau, une tenue professionnelle ou un projet
                        personnel, je mets mon expertise à votre service pour créer des pièces uniques et durables.
                        A travers mon atelier, je souhaite valoriser le travail artisanal, l’écoute et la proximité avec
                        les clients. Chaque réalisation est effectuée avec minutie et le souci du détail dans le but de
                        vous offrir un produit à la hauteur de vos attentes.
                    </p>
                </div>
            </div>

            <div class=\"row justify-content-center mb-5\">
                <div class=\"col-lg-10\">
                    <h3 class=\"fw-bold mb-4 text-center\">Réalisations récentes :</h3>
                    <div class=\"row g-4 justify-content-center\">
                        <div class=\"col-md-4\">
                            <div class=\"d-flex justify-content-center align-items-center bg-light rounded shadow-sm p-2\"
                                 style=\"height: 280px;\">
                                <img src=\"{{ asset(\x27build/images/recent1.jpg\x27) }}\" alt=\"Réalisation récente 1\"
                                     class=\"rounded\" style=\"max-height: 100%; max-width: 100%; object-fit: contain;\">
                            </div>
                        </div>
                        <div class=\"col-md-4\">
                            <div class=\"d-flex justify-content-center align-items-center bg-light rounded shadow-sm p-2\"
                                 style=\"height: 280px;\">
                                <img src=\"{{ asset(\x27build/images/recent2.jpg\x27) }}\" alt=\"Réalisation récente 2\"
                                     class=\"rounded\" style=\"max-height: 100%; max-width: 100%; object-fit: contain;\">
                            </div>
                        </div>
                        <div class=\"col-md-4\">
                            <div class=\"d-flex justify-content-center align-items-center bg-light rounded shadow-sm p-2\"
                                 style=\"height: 280px;\">
                                <img src=\"{{ asset(\x27build/images/recent3.jpg\x27) }}\" alt=\"Réalisation récente 3\"
                                     class=\"rounded\" style=\"max-height: 100%; max-width: 100%; object-fit: contain;\">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"row g-4 text-center mt-4\">
                <h3 class=\"fw-bold mb-4 text-center\">Pour qui ?</h3>

                <div class=\"col-md-4\">
                    <div class=\"p-4 border rounded-3 h-100 bg-light\">
                        <h4 class=\"h5 fw-bold mb-3\">Pour les particuliers</h4>
                        <p class=\"text-muted small\">Faites plaisir ou faites-vous plaisir ! Rendez vos moments en
                            souvenirs inoubliables grâce à des textiles personnalisés.</p>
                    </div>
                </div>
                <div class=\"col-md-4\">
                    <div class=\"p-4 border rounded-3 h-100 bg-light\">
                        <h4 class=\"h5 fw-bold mb-3\">Vous êtes professionnels ?</h4>
                        <p class=\"text-muted small\">Je vous aide à transformer votre image d’entreprise grâce à la
                            broderie, la sublimation ou bien le flocage.</p>
                    </div>
                </div>
                <div class=\"col-md-4\">
                    <div class=\"p-4 border rounded-3 h-100 bg-light\">
                        <h4 class=\"h5 fw-bold mb-3\">Les associations</h4>
                        <p class=\"text-muted small\">Développez l\x27esprit d\x27équipe et l\x27identité de votre association avec
                            des personnalisations de qualité.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class=\"py-5 bg-light\">
        <div class=\"container\">
            <div class=\"text-center mb-5\">
                <span class=\"hero-subtitle\">Témoignages</span>
                <h2 class=\"fw-bold\">Ce que nos clients disent</h2>
            </div>

            <div class=\"row g-4\">
                {% for review in reviews %}
                    <div class=\"col-md-4\">
                        <div class=\"card h-100 border-0 shadow-sm p-3\">
                            <div class=\"card-body d-flex flex-column justify-content-between\">
                                <div>
                                    <div class=\"mb-3 text-warning\">
                                        {% for i in 1..5 %}
                                            {% if i <= review.rating %}
                                                <i class=\"fas fa-star\"></i>
                                            {% else %}
                                                <i class=\"far fa-star\"></i>
                                            {% endif %}
                                        {% endfor %}
                                    </div>
                                    <p class=\"card-text text-muted small\" style=\"text-align: justify;\">
                                        \"{{ review.content }}\"</p>
                                </div>
                                <div class=\"mt-3 pt-3 border-top\">
                                    <span class=\"fw-bold small text-dark\">
                                        {% if review.product %}
                                        {{ review.product.title }} -
                                        {% endif %}
                                        {{ review.user ? review.user.firstName : \x27Client\x27 }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                {% else %}
                    <div class=\"col-12 text-center text-muted\">
                        <p>Aucun avis pour le moment.</p>
                    </div>
                {% endfor %}
            </div>

            <div class=\"text-end mt-4\">
                <a href=\"{{ path(\x27front_review_index\x27) }}\" class=\"text-dark fw-bold text-decoration-none\">
                    Voir tous les avis <i class=\"fas fa-arrow-right ms-2\"></i>
                </a>
            </div>
        </div>
    </section>



{% endblock %}
", "front/home/index.html.twig", "/var/www/html/templates/front/home/index.html.twig");
    }
}
