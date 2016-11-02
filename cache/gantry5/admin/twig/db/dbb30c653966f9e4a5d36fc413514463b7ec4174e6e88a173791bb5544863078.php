<?php

/* @gantry-admin/partials/php_unsupported.html.twig */
class __TwigTemplate_d3923034b024587ac958eed288273f245accac424218c9435b056a2c79551ca7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["php_version"] = twig_constant("PHP_VERSION");
        // line 2
        echo "
";
        // line 3
        if ((is_string($__internal_b60de2a38ed76b32d5f9183b159e6dd906c7d77561d120d7e71cc792006472eb = (isset($context["php_version"]) ? $context["php_version"] : null)) && is_string($__internal_0c192d9768a19db94a5a0d233251a3fbe4e06140449217727474570908c7d8e6 = "5.4") && ('' === $__internal_0c192d9768a19db94a5a0d233251a3fbe4e06140449217727474570908c7d8e6 || 0 === strpos($__internal_b60de2a38ed76b32d5f9183b159e6dd906c7d77561d120d7e71cc792006472eb, $__internal_0c192d9768a19db94a5a0d233251a3fbe4e06140449217727474570908c7d8e6)))) {
            // line 4
            echo "<div class=\"g-grid\">
    <div class=\"g-block alert alert-warning g-php-outdated\">
        ";
            // line 6
            echo $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_PHP54_WARNING", (isset($context["php_version"]) ? $context["php_version"] : null));
            echo "
    </div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "@gantry-admin/partials/php_unsupported.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 6,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }
}
/* {% set php_version = constant('PHP_VERSION') %}*/
/* */
/* {% if php_version starts with '5.4' %}*/
/* <div class="g-grid">*/
/*     <div class="g-block alert alert-warning g-php-outdated">*/
/*         {{ 'GANTRY5_PLATFORM_PHP54_WARNING'|trans(php_version)|raw }}*/
/*     </div>*/
/* </div>*/
/* {% endif %}*/
