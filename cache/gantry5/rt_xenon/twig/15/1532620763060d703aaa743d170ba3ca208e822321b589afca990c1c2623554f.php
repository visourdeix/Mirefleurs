<?php

/* @particles/social.html.twig */
class __TwigTemplate_fbd9df0d707c8b7be94ef20a461dc77460190b36e820f83b58e556c52847b99c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/social.html.twig", 1);
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
        echo "    ";
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array())) {
            echo "<h2 class=\"g-title\">";
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array());
            echo "</h2>";
        }
        // line 5
        echo "    <div class=\"g-social ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "css", array()), "class", array()), "html", null, true);
        echo "\">
        ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "items", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 7
            echo "            <a target=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "target", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "target", array()), "_blank")) : ("_blank")));
            echo "\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "link", array()));
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "text", array()));
            echo "\">
                ";
            // line 8
            if (twig_in_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "display", array()), array(0 => "both", 1 => "icons_only"))) {
                echo "<span class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "icon", array()));
                echo "\"></span>";
            }
            // line 9
            echo "                ";
            if (twig_in_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "display", array()), array(0 => "both", 1 => "text_only"))) {
                echo "<span class=\"g-social-text\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "text", array()));
                echo "</span>";
            }
            // line 10
            echo "            </a>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "@particles/social.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 12,  69 => 10,  62 => 9,  56 => 8,  47 => 7,  43 => 6,  38 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends '@nucleus/partials/particle.html.twig' %}*/
/* */
/* {% block particle %}*/
/*     {% if particle.title %}<h2 class="g-title">{{ particle.title|raw }}</h2>{% endif %}*/
/*     <div class="g-social {{ particle.css.class }}">*/
/*         {% for item in particle.items %}*/
/*             <a target="{{ particle.target|default('_blank')|e }}" href="{{ item.link|e }}" title="{{ item.text|e }}">*/
/*                 {% if particle.display in ['both', 'icons_only'] %}<span class="{{ item.icon|e }}"></span>{% endif %}*/
/*                 {% if particle.display in ['both', 'text_only'] %}<span class="g-social-text">{{ item.text|e }}</span>{% endif %}*/
/*             </a>*/
/*         {% endfor %}*/
/*     </div>*/
/* {% endblock %}*/
/* */
