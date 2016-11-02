<?php

/* @gantry-admin/partials/base.html.twig */
class __TwigTemplate_940e2025ad9466aa11bc4e9cc33728e1f34d654520eccdc9c86d934cba5d6148 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@gantry-admin/partials/page.html.twig", "@gantry-admin/partials/base.html.twig", 1);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascript' => array($this, 'block_javascript'),
            'content' => array($this, 'block_content'),
            'gantry_content_wrapper' => array($this, 'block_gantry_content_wrapper'),
            'gantry' => array($this, 'block_gantry'),
            'footer_section' => array($this, 'block_footer_section'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@gantry-admin/partials/page.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-admin://assets/css-compiled/g-admin.css"), "html", null, true);
        echo "\" type=\"text/css\" />
    <link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-admin://assets/css/font-awesome.min.css"), "html", null, true);
        echo "\" type=\"text/css\" />
    ";
        // line 6
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
    }

    // line 9
    public function block_javascript($context, array $blocks = array())
    {
        // line 10
        echo "    <script type=\"text/javascript\" async=\"async\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-admin://assets/js/main.js"), "html", null, true);
        echo "\"></script>
    ";
        // line 11
        $this->loadTemplate("@gantry-admin/partials/js-translations.html.twig", "@gantry-admin/partials/base.html.twig", 11)->display($context);
        // line 12
        echo "    ";
        $this->displayParentBlock("javascript", $context, $blocks);
        echo "
";
    }

    // line 15
    public function block_content($context, array $blocks = array())
    {
        // line 16
        echo "    <div id=\"main-header\" data-mode-indicator=\"production\">
        ";
        // line 17
        $this->loadTemplate("@gantry-admin/partials/php_unsupported.html.twig", "@gantry-admin/partials/base.html.twig", 17)->display($context);
        // line 18
        echo "        ";
        $this->loadTemplate("@gantry-admin/partials/header.html.twig", "@gantry-admin/partials/base.html.twig", 18)->display($context);
        // line 19
        echo "    </div>
    <div class=\"inner-container\">
        ";
        // line 21
        $this->loadTemplate("@gantry-admin/partials/updates.html.twig", "@gantry-admin/partials/base.html.twig", 21)->display($context);
        // line 22
        echo "        ";
        $this->displayBlock('gantry_content_wrapper', $context, $blocks);
        // line 37
        echo "    </div>
";
    }

    // line 22
    public function block_gantry_content_wrapper($context, array $blocks = array())
    {
        // line 23
        echo "            <div data-g5-content-wrapper=\"\">
                ";
        // line 24
        $this->loadTemplate("@gantry-admin/partials/navigation.html.twig", "@gantry-admin/partials/base.html.twig", 24)->display($context);
        // line 25
        echo "                <div class=\"g-grid\">
                    <div class=\"g-block main-block\">
                        <section id=\"g-main\">
                            <div class=\"g-content\" data-g5-content=\"\">
                                ";
        // line 29
        $this->displayBlock('gantry', $context, $blocks);
        // line 31
        echo "                            </div>
                        </section>
                    </div>
                </div>
            </div>
        ";
    }

    // line 29
    public function block_gantry($context, array $blocks = array())
    {
        // line 30
        echo "                                ";
    }

    // line 40
    public function block_footer_section($context, array $blocks = array())
    {
        // line 41
        echo "    <footer id=\"footer\">
        <div>
            ";
        // line 43
        echo $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_FOOTER");
        echo "
        </div>
        ";
        // line 45
        $context["version"] = twig_constant("GANTRY5_VERSION");
        // line 46
        echo "        ";
        $context["version_date"] = twig_constant("GANTRY5_VERSION_DATE");
        // line 47
        echo "        <div>
            ";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_FOOTER_VERSION"), "html", null, true);
        echo " <span class=\"g-version\">";
        echo twig_escape_filter($this->env, (isset($context["version"]) ? $context["version"] : null), "html", null, true);
        echo "</span>
            /
            ";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_FOOTER_RELEASED"), "html", null, true);
        echo " <span class=\"g-version-date\">";
        echo twig_escape_filter($this->env, (isset($context["version_date"]) ? $context["version_date"] : null), "html", null, true);
        echo "</span>
        </div>
        <div><a href=\"#\" data-changelog=\"";
        // line 52
        echo twig_escape_filter($this->env, twig_constant("GANTRY5_VERSION"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_CHANGELOG"), "html", null, true);
        echo "</a></div>
    </footer>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/partials/base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  159 => 52,  152 => 50,  145 => 48,  142 => 47,  139 => 46,  137 => 45,  132 => 43,  128 => 41,  125 => 40,  121 => 30,  118 => 29,  109 => 31,  107 => 29,  101 => 25,  99 => 24,  96 => 23,  93 => 22,  88 => 37,  85 => 22,  83 => 21,  79 => 19,  76 => 18,  74 => 17,  71 => 16,  68 => 15,  61 => 12,  59 => 11,  54 => 10,  51 => 9,  45 => 6,  41 => 5,  36 => 4,  33 => 3,  11 => 1,);
    }
}
/* {% extends "@gantry-admin/partials/page.html.twig" %}*/
/* */
/* {% block stylesheets %}*/
/*     <link rel="stylesheet" href="{{ url('gantry-admin://assets/css-compiled/g-admin.css') }}" type="text/css" />*/
/*     <link rel="stylesheet" href="{{ url('gantry-admin://assets/css/font-awesome.min.css') }}" type="text/css" />*/
/*     {{ parent() }}*/
/* {% endblock %}*/
/* */
/* {% block javascript %}*/
/*     <script type="text/javascript" async="async" src="{{ url('gantry-admin://assets/js/main.js') }}"></script>*/
/*     {% include "@gantry-admin/partials/js-translations.html.twig" %}*/
/*     {{ parent() }}*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/*     <div id="main-header" data-mode-indicator="production">*/
/*         {% include "@gantry-admin/partials/php_unsupported.html.twig" %}*/
/*         {% include "@gantry-admin/partials/header.html.twig" %}*/
/*     </div>*/
/*     <div class="inner-container">*/
/*         {% include "@gantry-admin/partials/updates.html.twig" %}*/
/*         {% block gantry_content_wrapper %}*/
/*             <div data-g5-content-wrapper="">*/
/*                 {% include "@gantry-admin/partials/navigation.html.twig" %}*/
/*                 <div class="g-grid">*/
/*                     <div class="g-block main-block">*/
/*                         <section id="g-main">*/
/*                             <div class="g-content" data-g5-content="">*/
/*                                 {% block gantry %}*/
/*                                 {% endblock %}*/
/*                             </div>*/
/*                         </section>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         {% endblock %}*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block footer_section %}*/
/*     <footer id="footer">*/
/*         <div>*/
/*             {{ 'GANTRY5_PLATFORM_FOOTER'|trans|raw }}*/
/*         </div>*/
/*         {% set version = constant('GANTRY5_VERSION') %}*/
/*         {% set version_date = constant('GANTRY5_VERSION_DATE') %}*/
/*         <div>*/
/*             {{ 'GANTRY5_PLATFORM_FOOTER_VERSION'|trans }} <span class="g-version">{{ version }}</span>*/
/*             /*/
/*             {{ 'GANTRY5_PLATFORM_FOOTER_RELEASED'|trans }} <span class="g-version-date">{{ version_date}}</span>*/
/*         </div>*/
/*         <div><a href="#" data-changelog="{{ constant('GANTRY5_VERSION') }}">{{ 'GANTRY5_PLATFORM_CHANGELOG'|trans }}</a></div>*/
/*     </footer>*/
/* {% endblock %}*/
/* */
