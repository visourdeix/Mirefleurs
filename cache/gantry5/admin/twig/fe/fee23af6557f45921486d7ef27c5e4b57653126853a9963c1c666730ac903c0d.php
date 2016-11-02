<?php

/* forms/fields/textarea/textarea.html.twig */
class __TwigTemplate_a7f9911e0ea9310f7a4f2872cef0815ef8b6ba9ea57d3f495ffc71388f500dee extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'input' => array($this, 'block_input'),
            'reset_field' => array($this, 'block_reset_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((("forms/" . ((array_key_exists("layout", $context)) ? (_twig_default_filter((isset($context["layout"]) ? $context["layout"] : null), "field")) : ("field"))) . ".html.twig"), "forms/fields/textarea/textarea.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_input($context, array $blocks = array())
    {
        // line 4
        echo "    <textarea
            ";
        // line 6
        echo "            name=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->fieldNameFilter(((isset($context["scope"]) ? $context["scope"] : null) . (isset($context["name"]) ? $context["name"] : null))), "html", null, true);
        echo "\"
            ";
        // line 8
        echo "            ";
        $this->displayBlock("global_attributes", $context, $blocks);
        echo "
            ";
        // line 10
        echo "            ";
        if (twig_in_filter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "autofocus", array()), array(0 => "on", 1 => "true", 2 => 1))) {
            echo "autofocus=\"autofocus\"";
        }
        // line 11
        echo "            ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "cols", array(), "any", true, true)) {
            echo "cols=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "cols", array()), "html", null, true);
            echo "\"";
        }
        // line 12
        echo "            ";
        if (twig_in_filter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "disabled", array()), array(0 => "on", 1 => "true", 2 => 1))) {
            echo "disabled=\"disabled\"";
        }
        // line 13
        echo "            ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "maxlength", array(), "any", true, true)) {
            echo "maxlength=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "maxlength", array()), "html", null, true);
            echo "\"";
        }
        // line 14
        echo "            ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "minlength", array(), "any", true, true)) {
            echo "minlength=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "minlength", array()), "html", null, true);
            echo "\"";
        }
        // line 15
        echo "            ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "placeholder", array(), "any", true, true)) {
            echo "placeholder=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "placeholder", array()), "html", null, true);
            echo "\"";
        }
        // line 16
        echo "            ";
        if (twig_in_filter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "readonly", array()), array(0 => "on", 1 => "true", 2 => 1))) {
            echo "readonly=\"readonly\"";
        }
        // line 17
        echo "            ";
        if (twig_in_filter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "required", array()), array(0 => "on", 1 => "true", 2 => 1))) {
            echo "required=\"required\"";
        }
        // line 18
        echo "            ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "rows", array(), "any", true, true)) {
            echo "rows=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "rows", array()), "html", null, true);
            echo "\"";
        }
        // line 19
        echo "            ";
        if (twig_in_filter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "wrap", array()), array(0 => "hard", 1 => "soft"))) {
            echo "wrap=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "wrap", array()), "html", null, true);
            echo "\"";
        }
        // line 20
        echo "            >";
        echo twig_escape_filter($this->env, twig_join_filter((isset($context["value"]) ? $context["value"] : null), "
"), "html", null, true);
        echo "</textarea>

    ";
        // line 22
        $this->displayBlock('reset_field', $context, $blocks);
    }

    public function block_reset_field($context, array $blocks = array())
    {
        $this->displayParentBlock("reset_field", $context, $blocks);
    }

    public function getTemplateName()
    {
        return "forms/fields/textarea/textarea.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 22,  106 => 20,  99 => 19,  92 => 18,  87 => 17,  82 => 16,  75 => 15,  68 => 14,  61 => 13,  56 => 12,  49 => 11,  44 => 10,  39 => 8,  34 => 6,  31 => 4,  28 => 3,  19 => 1,);
    }
}
/* {% extends 'forms/' ~ layout|default('field') ~ '.html.twig' %}*/
/* */
/* {% block input %}*/
/*     <textarea*/
/*             {# required attribute structures #}*/
/*             name="{{ (scope ~ name)|fieldName }}"*/
/*             {# global attribute structures #}*/
/*             {{ block('global_attributes') }}*/
/*             {# non-gloval attribute structures #}*/
/*             {% if field.autofocus in ['on', 'true', 1] %}autofocus="autofocus"{% endif %}*/
/*             {% if field.cols is defined %}cols="{{ field.cols }}"{% endif %}*/
/*             {% if field.disabled in ['on', 'true', 1] %}disabled="disabled"{% endif %}*/
/*             {% if field.maxlength is defined %}maxlength="{{ field.maxlength }}"{% endif %}*/
/*             {% if field.minlength is defined %}minlength="{{ field.minlength }}"{% endif %}*/
/*             {% if field.placeholder is defined %}placeholder="{{ field.placeholder }}"{% endif %}*/
/*             {% if field.readonly in ['on', 'true', 1] %}readonly="readonly"{% endif %}*/
/*             {% if field.required in ['on', 'true', 1] %}required="required"{% endif %}*/
/*             {% if field.rows is defined %}rows="{{ field.rows }}"{% endif %}*/
/*             {% if field.wrap in ['hard', 'soft'] %}wrap="{{ field.wrap }}"{% endif %}*/
/*             >{{ value|join("\n") }}</textarea>*/
/* */
/*     {% block reset_field %}{{ parent() }}{% endblock %}*/
/* {% endblock %}*/
/* */
