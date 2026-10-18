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

/* front/legal/privacy.html.twig */
class __TwigTemplate_57f7a42625263d39f1feee9d902fef1f extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/legal/privacy.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/legal/privacy.html.twig"));

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

        yield "Données personnelles et confidentialité | L’Aiguille des Volcans";
        
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
        <div class=\"row justify-content-center\">
            <div class=\"col-lg-9\">
                <h1 class=\"mb-4\">Données personnelles et confidentialité</h1>
                <p>Cette page explique comment L’Aiguille des Volcans utilise les informations que vous transmettez pour demander un devis, contacter l’atelier, créer un compte ou publier un avis.</p>

                <h2 class=\"h4 mt-4\">Qui est responsable de vos données ?</h2>
                <p>Oceane Roux, responsable de L’Aiguille des Volcans, au 4 Route de Clermont, 63530 Volvic.</p>
                <p>Contact : <a href=\"mailto:contact@laiguilledesvolcans.fr\">contact@laiguilledesvolcans.fr</a>. Vous pouvez également contacter l’atelier par courrier à cette adresse professionnelle ou par téléphone au <a href=\"tel:+33677895869\">06 77 89 58 69</a>.</p>

                <h2 class=\"h4 mt-4\">À quoi servent les informations recueillies ?</h2>
                <ul>
                    <li><strong>Demande de devis :</strong> vos coordonnées, les caractéristiques de votre projet et, si vous le joignez, votre logo permettent de préparer une réponse et de suivre votre demande. Le traitement repose sur les mesures précontractuelles prises à votre demande.</li>
                    <li><strong>Formulaire de contact :</strong> votre nom, votre adresse e-mail et votre message permettent de répondre à votre sollicitation. Le traitement repose sur l’intérêt légitime de l’atelier à répondre aux personnes qui le contactent.</li>
                    <li><strong>Compte utilisateur :</strong> votre nom, votre adresse e-mail et vos informations de connexion permettent de fournir le service de compte demandé et de vous identifier lorsque vous déposez un avis. Le traitement repose sur l’exécution de ce service.</li>
                    <li><strong>Avis :</strong> le commentaire, la note, le prénom et la date servent à présenter les retours des utilisateurs après modération. Le traitement repose sur l’intérêt légitime de l’atelier à présenter ces retours et à en contrôler la publication.</li>
                </ul>
                <p>Les informations de connexion, les rôles et les journaux techniques sont également utilisés pour protéger le site et ses accès, au titre de l’intérêt légitime de l’atelier à assurer leur sécurité.</p>

                <h2 class=\"h4 mt-4\">Quelles informations sont obligatoires ?</h2>
                <p>Les champs obligatoires sont identifiés dans les formulaires. Sans ces informations, le formulaire ne peut pas être validé. Le logo et le nom de votre organisme sont facultatifs dans la demande de devis ; l’entité est facultative dans le contact. Vous pouvez demander un devis sans créer de compte et déposer un avis général sans sélectionner de produit.</p>
                <p>Ne transmettez pas de données sensibles ou d’informations sur d’autres personnes qui ne sont pas nécessaires à votre demande.</p>

                <h2 class=\"h4 mt-4\">Qui peut accéder à vos données ?</h2>
                <p>La responsable de l’atelier et les personnes habilitées à gérer le site accèdent aux informations nécessaires au traitement de vos demandes. L’hébergement est assuré par OVHcloud, prestataire technique. Le service de messagerie intervient dans l’acheminement et la conservation des échanges lorsqu’il est utilisé.</p>
                <p>Après validation d’un avis, son commentaire, sa note, le prénom de l’auteur et sa date peuvent être visibles par les visiteurs. Votre adresse e-mail, votre téléphone et les détails de votre devis ne sont pas affichés dans les avis publics. Les logos des devis sont accessibles dans l’espace réservé aux administrateurs.</p>

                <h2 class=\"h4 mt-4\">Combien de temps sont-elles conservées ?</h2>
                <ul>
                    <li><strong>Contact et devis :</strong> pendant le suivi de votre demande, puis au maximum trois ans après votre dernier contact avec l’atelier. Les données devenues inutiles sont supprimées plus tôt.</li>
                    <li><strong>Logos :</strong> uniquement pendant le temps nécessaire à l’étude ou à la réalisation du projet concerné. Ils sont retirés lorsqu’ils ne sont plus nécessaires et au plus tard lors de la suppression du devis associé.</li>
                    <li><strong>Comptes :</strong> pendant l’utilisation du service, jusqu’à la clôture du compte. Les informations devenues inutiles sont examinées et supprimées lors de la revue des comptes.</li>
                    <li><strong>Avis :</strong> tant qu’ils sont publiés et utiles pour présenter les retours sur l’atelier. Vous pouvez demander leur retrait.</li>
                    <li><strong>Journaux techniques et sauvegardes :</strong> pendant le temps nécessaire au diagnostic, à la sécurité et à la restauration du service. Ils ne sont pas utilisés pour contacter les visiteurs à des fins commerciales.</li>
                </ul>
                <p>Une conservation distincte et limitée peut être nécessaire pour répondre à une obligation légale ou établir, exercer ou défendre un droit. Les informations ainsi conservées ne sont plus utilisées pour le suivi courant de vos demandes.</p>

                <h2 class=\"h4 mt-4\">Quels sont vos droits ?</h2>
                <p>Vous pouvez demander l’accès à vos données, leur rectification, leur effacement ou la limitation de leur traitement. Selon le traitement concerné, vous pouvez également exercer votre droit d’opposition ou de portabilité. Ces droits s’exercent dans les conditions prévues par le RGPD.</p>
                <p>Adressez votre demande à Oceane Roux avec les coordonnées indiquées en haut de cette page. Précisez votre demande et les informations permettant de retrouver les données concernées. Si un doute raisonnable existe sur votre identité, seules les informations nécessaires à cette vérification vous seront demandées.</p>
                <p>Une réponse vous est apportée en principe dans un délai d’un mois. Si vous estimez que vos droits ne sont pas respectés, vous pouvez adresser une réclamation à la <a href=\"https://www.cnil.fr/fr/adresser-une-plainte\">CNIL</a>.</p>

                <h2 class=\"h4 mt-4\">Navigation et services externes</h2>
                <p>Le site utilise une session pour les fonctionnalités de connexion et de sécurité. Votre choix de thème clair ou sombre est mémorisé dans votre navigateur. Ces mécanismes servent au fonctionnement du site.</p>
                <p>La page de contact contient une carte Google Maps. Son chargement peut transmettre des informations techniques, notamment votre adresse IP, à Google. Les liens vers les réseaux sociaux vous dirigent vers des services externes qui appliquent leurs propres règles de confidentialité. Vous pouvez consulter la <a href=\"https://policies.google.com/privacy?hl=fr\">politique de confidentialité de Google</a> pour connaître ses traitements et les éventuels transferts internationaux.</p>

                <p class=\"text-muted small mt-4\">Dernière mise à jour : 12 octobre 2026.</p>
            </div>
        </div>
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
        return "front/legal/privacy.html.twig";
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
        return array (  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27front/base.html.twig\x27 %}

{% block title %}Données personnelles et confidentialité | L’Aiguille des Volcans{% endblock %}

{% block body %}
    <main class=\"container py-5\">
        <div class=\"row justify-content-center\">
            <div class=\"col-lg-9\">
                <h1 class=\"mb-4\">Données personnelles et confidentialité</h1>
                <p>Cette page explique comment L’Aiguille des Volcans utilise les informations que vous transmettez pour demander un devis, contacter l’atelier, créer un compte ou publier un avis.</p>

                <h2 class=\"h4 mt-4\">Qui est responsable de vos données ?</h2>
                <p>Oceane Roux, responsable de L’Aiguille des Volcans, au 4 Route de Clermont, 63530 Volvic.</p>
                <p>Contact : <a href=\"mailto:contact@laiguilledesvolcans.fr\">contact@laiguilledesvolcans.fr</a>. Vous pouvez également contacter l’atelier par courrier à cette adresse professionnelle ou par téléphone au <a href=\"tel:+33677895869\">06 77 89 58 69</a>.</p>

                <h2 class=\"h4 mt-4\">À quoi servent les informations recueillies ?</h2>
                <ul>
                    <li><strong>Demande de devis :</strong> vos coordonnées, les caractéristiques de votre projet et, si vous le joignez, votre logo permettent de préparer une réponse et de suivre votre demande. Le traitement repose sur les mesures précontractuelles prises à votre demande.</li>
                    <li><strong>Formulaire de contact :</strong> votre nom, votre adresse e-mail et votre message permettent de répondre à votre sollicitation. Le traitement repose sur l’intérêt légitime de l’atelier à répondre aux personnes qui le contactent.</li>
                    <li><strong>Compte utilisateur :</strong> votre nom, votre adresse e-mail et vos informations de connexion permettent de fournir le service de compte demandé et de vous identifier lorsque vous déposez un avis. Le traitement repose sur l’exécution de ce service.</li>
                    <li><strong>Avis :</strong> le commentaire, la note, le prénom et la date servent à présenter les retours des utilisateurs après modération. Le traitement repose sur l’intérêt légitime de l’atelier à présenter ces retours et à en contrôler la publication.</li>
                </ul>
                <p>Les informations de connexion, les rôles et les journaux techniques sont également utilisés pour protéger le site et ses accès, au titre de l’intérêt légitime de l’atelier à assurer leur sécurité.</p>

                <h2 class=\"h4 mt-4\">Quelles informations sont obligatoires ?</h2>
                <p>Les champs obligatoires sont identifiés dans les formulaires. Sans ces informations, le formulaire ne peut pas être validé. Le logo et le nom de votre organisme sont facultatifs dans la demande de devis ; l’entité est facultative dans le contact. Vous pouvez demander un devis sans créer de compte et déposer un avis général sans sélectionner de produit.</p>
                <p>Ne transmettez pas de données sensibles ou d’informations sur d’autres personnes qui ne sont pas nécessaires à votre demande.</p>

                <h2 class=\"h4 mt-4\">Qui peut accéder à vos données ?</h2>
                <p>La responsable de l’atelier et les personnes habilitées à gérer le site accèdent aux informations nécessaires au traitement de vos demandes. L’hébergement est assuré par OVHcloud, prestataire technique. Le service de messagerie intervient dans l’acheminement et la conservation des échanges lorsqu’il est utilisé.</p>
                <p>Après validation d’un avis, son commentaire, sa note, le prénom de l’auteur et sa date peuvent être visibles par les visiteurs. Votre adresse e-mail, votre téléphone et les détails de votre devis ne sont pas affichés dans les avis publics. Les logos des devis sont accessibles dans l’espace réservé aux administrateurs.</p>

                <h2 class=\"h4 mt-4\">Combien de temps sont-elles conservées ?</h2>
                <ul>
                    <li><strong>Contact et devis :</strong> pendant le suivi de votre demande, puis au maximum trois ans après votre dernier contact avec l’atelier. Les données devenues inutiles sont supprimées plus tôt.</li>
                    <li><strong>Logos :</strong> uniquement pendant le temps nécessaire à l’étude ou à la réalisation du projet concerné. Ils sont retirés lorsqu’ils ne sont plus nécessaires et au plus tard lors de la suppression du devis associé.</li>
                    <li><strong>Comptes :</strong> pendant l’utilisation du service, jusqu’à la clôture du compte. Les informations devenues inutiles sont examinées et supprimées lors de la revue des comptes.</li>
                    <li><strong>Avis :</strong> tant qu’ils sont publiés et utiles pour présenter les retours sur l’atelier. Vous pouvez demander leur retrait.</li>
                    <li><strong>Journaux techniques et sauvegardes :</strong> pendant le temps nécessaire au diagnostic, à la sécurité et à la restauration du service. Ils ne sont pas utilisés pour contacter les visiteurs à des fins commerciales.</li>
                </ul>
                <p>Une conservation distincte et limitée peut être nécessaire pour répondre à une obligation légale ou établir, exercer ou défendre un droit. Les informations ainsi conservées ne sont plus utilisées pour le suivi courant de vos demandes.</p>

                <h2 class=\"h4 mt-4\">Quels sont vos droits ?</h2>
                <p>Vous pouvez demander l’accès à vos données, leur rectification, leur effacement ou la limitation de leur traitement. Selon le traitement concerné, vous pouvez également exercer votre droit d’opposition ou de portabilité. Ces droits s’exercent dans les conditions prévues par le RGPD.</p>
                <p>Adressez votre demande à Oceane Roux avec les coordonnées indiquées en haut de cette page. Précisez votre demande et les informations permettant de retrouver les données concernées. Si un doute raisonnable existe sur votre identité, seules les informations nécessaires à cette vérification vous seront demandées.</p>
                <p>Une réponse vous est apportée en principe dans un délai d’un mois. Si vous estimez que vos droits ne sont pas respectés, vous pouvez adresser une réclamation à la <a href=\"https://www.cnil.fr/fr/adresser-une-plainte\">CNIL</a>.</p>

                <h2 class=\"h4 mt-4\">Navigation et services externes</h2>
                <p>Le site utilise une session pour les fonctionnalités de connexion et de sécurité. Votre choix de thème clair ou sombre est mémorisé dans votre navigateur. Ces mécanismes servent au fonctionnement du site.</p>
                <p>La page de contact contient une carte Google Maps. Son chargement peut transmettre des informations techniques, notamment votre adresse IP, à Google. Les liens vers les réseaux sociaux vous dirigent vers des services externes qui appliquent leurs propres règles de confidentialité. Vous pouvez consulter la <a href=\"https://policies.google.com/privacy?hl=fr\">politique de confidentialité de Google</a> pour connaître ses traitements et les éventuels transferts internationaux.</p>

                <p class=\"text-muted small mt-4\">Dernière mise à jour : 12 octobre 2026.</p>
            </div>
        </div>
    </main>
{% endblock %}
", "front/legal/privacy.html.twig", "/var/www/html/templates/front/legal/privacy.html.twig");
    }
}
