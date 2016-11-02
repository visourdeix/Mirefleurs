<?php

/* forms/fields/input/hidden.html.twig */
class __TwigTemplate_deed182f82e8fc7cfa6ba32ca1cc7b2695b80b858660c20b82833d9b2ad773b4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'overridable' => array($this, 'block_overridable'),
            'label' => array($this, 'block_label'),
            'input' => array($this, 'block_input'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((((isset($context["default"]) ? $context["default"] : null)) ? ("partials/field.html.twig") : ((("forms/" . ((array_key_exists("layout", $context)) ? (_twig_default_filter((isset($context["layout"]) ? $context["layout"] : null), "field")) : ("field"))) . ".html.twig"))), "forms/fields/input/hidden.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_overridable($context, array $blocks = array())
    {
    }

    // line 8
    public function block_label($context, array $blocks = array())
    {
    }

    // line 11
    public function block_input($context, array $blocks = array())
    {
        // line 12
        echo "    ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "array", array())) {
            // line 13
            echo "        ";
            $context["name"] = ((isset($context["name"]) ? $context["name"] : null) . "._json");
            // line 14
            echo "        ";
            $context["value"] = twig_jsonencode_filter(((array_key_exists("value", $context)) ? (_twig_default_filter((isset($context["value"]) ? $context["value"] : null), array())) : (array())));
            // line 15
            echo "        ";
        } else {
            // line 16
            echo "        ";
            $context["value"] = twig_join_filter((isset($context["value"]) ? $context["value"] : null), ", ");
            // line 17
            echo "    ";
        }
        // line 18
        echo "
    <input
        ";
        // line 21
        echo "        type=\"hidden\"
        name=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->fieldNameFilter(((isset($context["scope"]) ? $context["scope"] : null) . (isset($context["name"]) ? $context["name"] : null))), "html", null, true);
        echo "\"
        value=\"";
        // line 23
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
        echo "\"
        ";
        // line 25
        echo "        ";
        $this->displayBlock("global_attributes", $context, $blocks);
        echo "
    />
";
    }

    public function getTemplateName()
    {
        return "forms/fields/input/hidden.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 25,  71 => 23,  67 => 22,  64 => 21,  60 => 18,  57 => 17,  54 => 16,  51 => 15,  48 => 14,  45 => 13,  42 => 12,  39 => 11,  34 => 8,  29 => 4,  20 => 1,);
    }
}
/* {% extends default ? "partials/field.html.twig" : 'forms/' ~ layout|default('field') ~ '.html.twig' %}*/
/* */
/* {# Not overridable #}*/
/* {% block overridable %}*/
/* {% endblock %}*/
/* */
/* {# No label #}*/
/* {% block label %}*/
/* {% endblock %}*/
/* */
/* {% block input %}*/
/*     {% if field.array %}*/
/*         {% set name = name ~ '._json' %}*/
/*         {% set value = value|default([])|json_encode %}*/
/*         {% else %}*/
/*         {% set value = value|join(', ') %}*/
/*     {% endif %}*/
/* */
/*     <input*/
/*         {# required attribute structures #}*/
/*         type="hidden"*/
/*         name="{{ (scope ~ name)|fieldName }}"*/
/*         value="{{ value }}"*/
/*         {# global attribute structures #}*/
/*         {{ block('global_attributes') }}*/
/*     />*/
/* {% endblock %}*/
/* */
