<?php

/* forms/fields/gantry/inherit.html.twig */
class __TwigTemplate_7cbf7115c1b912f236c04491265c01c4d7a20c9a6bfce5d00e2e4b4204cb8657 extends Twig_Template
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
        echo "<div class=\"g-inherit";
        echo (((isset($context["inherit"]) ? $context["inherit"] : null)) ? ("") : (" hide"));
        echo "\">
    <div class=\"g-inherit-content\">
        ";
        // line 3
        echo $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_INHERITING_FROM_X", (("<strong>" . twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "outlines", array()), "name", array(0 => (isset($context["inherit"]) ? $context["inherit"] : null)), "method"))) . "</strong>"));
        echo "
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "forms/fields/gantry/inherit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 3,  19 => 1,);
    }
}
/* <div class="g-inherit{{ inherit ? '' : ' hide' }}">*/
/*     <div class="g-inherit-content">*/
/*         {{ 'GANTRY5_PLATFORM_INHERITING_FROM_X'|trans('<strong>' ~ gantry.outlines.name(inherit)|e ~ '</strong>')|raw }}*/
/*     </div>*/
/* </div>*/
