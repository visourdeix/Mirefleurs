<?php

/* @particles/pricingtable.html.twig */
class __TwigTemplate_ee0825db162fa40f9e9e798e9459ffc8e3f0ca237aec9ee5897cfde11e160b16 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/pricingtable.html.twig", 1);
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "class", array()));
        echo "\">
  ";
        // line 5
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array())) {
            echo "<h2 class=\"g-title\">";
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array());
            echo "</h2>";
        }
        // line 6
        echo "  <ul class=\"g-pricingtable\">
\t";
        // line 7
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "icon", array())) {
            echo " <li class=\"g-pricingtable-icon\"><i class=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "icon", array()));
            echo "\"></i></li> ";
        }
        // line 8
        echo "\t";
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "columntitle", array())) {
            echo " <li class=\"g-pricingtable-title\">";
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "columntitle", array());
            echo "</li> ";
        }
        // line 9
        echo "\t";
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "columnsubtitle", array())) {
            echo " <li class=\"g-pricingtable-subtitle\">";
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "columnsubtitle", array());
            echo "</li> ";
        }
        // line 10
        echo "\t";
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "price", array())) {
            echo " <li class=\"g-pricingtable-price\">";
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "price", array());
            echo "</li> ";
        }
        // line 11
        echo "\t";
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "desc", array())) {
            echo " <li class=\"g-pricingtable-desc\">";
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "desc", array());
            echo "</li> ";
        }
        // line 12
        echo "
    ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "items", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 14
            echo "\t\t<li class=\"g-pricingtable-item\">";
            echo $this->getAttribute($context["item"], "text", array());
            echo "</li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "
    ";
        // line 17
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "buttontext", array())) {
            echo " <li class=\"g-pricingtable-cta\"><a target=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "buttontarget", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "buttontarget", array()), "_self")) : ("_self")));
            echo "\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "buttonlink", array()));
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "buttontext", array()));
            echo "\" class=\"button ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "buttonclass", array()));
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "buttontext", array()));
            echo "</a></li> ";
        }
        // line 18
        echo "
  </ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "@particles/pricingtable.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 18,  98 => 17,  95 => 16,  86 => 14,  82 => 13,  79 => 12,  72 => 11,  65 => 10,  58 => 9,  51 => 8,  45 => 7,  42 => 6,  36 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends '@nucleus/partials/particle.html.twig' %}*/
/* */
/* {% block particle %}*/
/* <div class="{{ particle.class|e }}">*/
/*   {% if particle.title %}<h2 class="g-title">{{ particle.title|raw }}</h2>{% endif %}*/
/*   <ul class="g-pricingtable">*/
/* 	{% if particle.icon %} <li class="g-pricingtable-icon"><i class="{{ particle.icon|e }}"></i></li> {% endif %}*/
/* 	{% if particle.columntitle %} <li class="g-pricingtable-title">{{ particle.columntitle|raw }}</li> {% endif %}*/
/* 	{% if particle.columnsubtitle %} <li class="g-pricingtable-subtitle">{{ particle.columnsubtitle|raw }}</li> {% endif %}*/
/* 	{% if particle.price %} <li class="g-pricingtable-price">{{ particle.price|raw }}</li> {% endif %}*/
/* 	{% if particle.desc %} <li class="g-pricingtable-desc">{{ particle.desc|raw }}</li> {% endif %}*/
/* */
/*     {% for item in particle.items %}*/
/* 		<li class="g-pricingtable-item">{{ item.text|raw }}</li>*/
/*     {% endfor %}*/
/* */
/*     {% if particle.buttontext %} <li class="g-pricingtable-cta"><a target="{{ particle.buttontarget|default('_self')|e }}" href="{{ particle.buttonlink|e }}" title="{{ particle.buttontext|e }}" class="button {{ particle.buttonclass|e }}">{{ particle.buttontext|e }}</a></li> {% endif %}*/
/* */
/*   </ul>*/
/* </div>*/
/* {% endblock %}*/
