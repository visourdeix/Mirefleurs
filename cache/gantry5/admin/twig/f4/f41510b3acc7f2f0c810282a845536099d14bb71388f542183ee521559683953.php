<?php

/* forms/fields/input/selectize.html.twig */
class __TwigTemplate_554949a679791df05fce71cc83838aae3cbd921ca17d4758e2d6c75e46e6dc5d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'global_attributes' => array($this, 'block_global_attributes'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((((isset($context["default"]) ? $context["default"] : null)) ? ("partials/field.html.twig") : ((("forms/" . ((array_key_exists("layout", $context)) ? (_twig_default_filter((isset($context["layout"]) ? $context["layout"] : null), "field")) : ("field"))) . ".html.twig"))), "forms/fields/input/selectize.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_global_attributes($context, array $blocks = array())
    {
        // line 4
        echo "    type=\"text\"
    data-selectize=\"";
        // line 5
        echo twig_escape_filter($this->env, twig_jsonencode_filter((($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "selectize", array(), "any", true, true)) ? (twig_array_merge(array("create" => true), $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "selectize", array()))) : (array("create" => true)))), "html_attr");
        echo "\"

    ";
        // line 7
        $this->displayParentBlock("global_attributes", $context, $blocks);
        echo "
";
    }

    public function getTemplateName()
    {
        return "forms/fields/input/selectize.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 7,  33 => 5,  30 => 4,  27 => 3,  18 => 1,);
    }
}
/* {% extends default ? "partials/field.html.twig" : 'forms/' ~ layout|default('field') ~ '.html.twig' %}*/
/* */
/* {% block global_attributes %}*/
/*     type="text"*/
/*     data-selectize="{{ (field.selectize is defined ? {'create': true}|merge(field.selectize) : {'create': true})|json_encode()|e('html_attr') }}"*/
/* */
/*     {{ parent() }}*/
/* {% endblock %}*/
/* */
