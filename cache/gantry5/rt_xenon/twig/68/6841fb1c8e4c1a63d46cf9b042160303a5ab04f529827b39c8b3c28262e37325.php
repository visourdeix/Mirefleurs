<?php

/* @particles/copyright.html.twig */
class __TwigTemplate_f44763967f7368c8e8c90457bf5cc8486e8dfa6ecc4b53509647e84564b813f5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/copyright.html.twig", 1);
        $this->blocks = array(
            'particle' => array($this, 'block_particle'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@nucleus/partials/particle.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["start_date"] = ((twig_in_filter(trim($this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "date", array()), "start", array())), array(0 => "now", 1 => ""))) ? (twig_date_format_filter($this->env, "now", "Y")) : (twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "date", array()), "start", array()))));
        // line 4
        $context["end_date"] = ((twig_in_filter(trim($this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "date", array()), "end", array())), array(0 => "now", 1 => ""))) ? (twig_date_format_filter($this->env, "now", "Y")) : (twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "date", array()), "end", array()))));
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    public function block_particle($context, array $blocks = array())
    {
        // line 7
        echo "<div class=\"g-copyright ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "css", array()), "class", array()), "html", null, true);
        echo "\">
\tCopyright &copy;
\t";
        // line 9
        if (((isset($context["start_date"]) ? $context["start_date"] : null) != (isset($context["end_date"]) ? $context["end_date"] : null))) {
            echo twig_escape_filter($this->env, (isset($context["start_date"]) ? $context["start_date"] : null));
            echo " - ";
        }
        // line 10
        echo "\t";
        echo twig_escape_filter($this->env, (isset($context["end_date"]) ? $context["end_date"] : null));
        echo "
\t";
        // line 11
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "owner", array())) {
            echo "<a target=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "target", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "target", array()), "_blank")) : ("_blank")));
            echo "\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "link", array()));
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "owner", array()));
            echo "\">";
        }
        // line 12
        echo "\t\t";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "owner", array()));
        echo "
\t";
        // line 13
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "owner", array())) {
            echo "</a>";
        }
        // line 14
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "@particles/copyright.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 14,  67 => 13,  62 => 12,  52 => 11,  47 => 10,  42 => 9,  36 => 7,  33 => 6,  29 => 1,  27 => 4,  25 => 3,  11 => 1,);
    }
}
/* {% extends '@nucleus/partials/particle.html.twig' %}*/
/* */
/* {% set start_date = particle.date.start|trim in ['now', ''] ? 'now'|date('Y') : particle.date.start|e %}*/
/* {% set end_date = particle.date.end|trim in ['now', ''] ? 'now'|date('Y') : particle.date.end|e %}*/
/* */
/* {% block particle %}*/
/* <div class="g-copyright {{ particle.css.class }}">*/
/* 	Copyright &copy;*/
/* 	{% if (start_date != end_date) %}{{ start_date|e }} - {% endif %}*/
/* 	{{ end_date|e }}*/
/* 	{% if particle.owner %}<a target="{{ particle.target|default('_blank')|e }}" href="{{ particle.link|e }}" title="{{ particle.owner|e }}">{% endif %}*/
/* 		{{ particle.owner|e }}*/
/* 	{% if particle.owner %}</a>{% endif %}*/
/* </div>*/
/* {% endblock %}*/
/* */
