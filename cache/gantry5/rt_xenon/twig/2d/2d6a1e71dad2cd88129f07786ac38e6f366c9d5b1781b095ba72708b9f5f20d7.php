<?php

/* @particles/assets.html.twig */
class __TwigTemplate_c2e22ae1b745eb40477d550cc8e6b67fa75a669715526419cf3a24ce72a6ab3d extends Twig_Template
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
        ob_start();
        // line 2
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "enabled", array())) {
            // line 3
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "css", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["css"]) {
                // line 4
                echo "        ";
                if ($this->getAttribute($context["css"], "location", array())) {
                    // line 5
                    echo "            ";
                    $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "document", array()), "addStyle", array(0 => twig_array_merge((($this->getAttribute($context["css"], "extra", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["css"], "extra", array()), array())) : (array())), array("href" => $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($context["css"], "location", array())))), 1 => $this->getAttribute($context["css"], "priority", array())), "method");
                    // line 6
                    echo "        ";
                }
                // line 7
                echo "
        ";
                // line 8
                if ($this->getAttribute($context["css"], "inline", array())) {
                    // line 9
                    echo "            ";
                    $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "document", array()), "addInlineStyle", array(0 => twig_array_merge((($this->getAttribute($context["css"], "extra", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["css"], "extra", array()), array())) : (array())), array("content" => $this->getAttribute($context["css"], "inline", array()))), 1 => $this->getAttribute($context["css"], "priority", array())), "method");
                    // line 10
                    echo "        ";
                }
                // line 11
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            echo "
    ";
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "javascript", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
                // line 14
                echo "        ";
                if ($this->getAttribute($context["script"], "location", array())) {
                    // line 15
                    echo "            ";
                    $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "document", array()), "addScript", array(0 => twig_array_merge((($this->getAttribute($context["script"], "extra", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["script"], "extra", array()), array())) : (array())), array("src" => $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($context["script"], "location", array())))), 1 => $this->getAttribute($context["script"], "priority", array()), 2 => ((($this->getAttribute($context["script"], "in_footer", array()) == true)) ? ("footer") : ("head"))), "method");
                    // line 16
                    echo "        ";
                }
                // line 17
                echo "
        ";
                // line 18
                if ($this->getAttribute($context["script"], "inline", array())) {
                    // line 19
                    echo "            ";
                    $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "document", array()), "addInlineScript", array(0 => twig_array_merge((($this->getAttribute($context["script"], "extra", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["script"], "extra", array()), array())) : (array())), array("content" => $this->getAttribute($context["script"], "inline", array()))), 1 => $this->getAttribute($context["script"], "priority", array()), 2 => ((($this->getAttribute($context["script"], "in_footer", array()) == true)) ? ("footer") : ("head"))), "method");
                    // line 20
                    echo "        ";
                }
                // line 21
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "@particles/assets.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 21,  78 => 20,  75 => 19,  73 => 18,  70 => 17,  67 => 16,  64 => 15,  61 => 14,  57 => 13,  54 => 12,  48 => 11,  45 => 10,  42 => 9,  40 => 8,  37 => 7,  34 => 6,  31 => 5,  28 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }
}
/* {% spaceless %}*/
/* {% if (particle.enabled) %}*/
/*     {% for css in particle.css %}*/
/*         {% if css.location %}*/
/*             {% do gantry.document.addStyle(css.extra|default({})|merge({href: url(css.location)}), css.priority) %}*/
/*         {% endif %}*/
/* */
/*         {% if css.inline %}*/
/*             {% do gantry.document.addInlineStyle(css.extra|default({})|merge({content: css.inline}), css.priority) %}*/
/*         {% endif %}*/
/*     {% endfor %}*/
/* */
/*     {% for script in particle.javascript %}*/
/*         {% if script.location %}*/
/*             {% do gantry.document.addScript(script.extra|default({})|merge({src: url(script.location)}), script.priority, script.in_footer == true ? 'footer' : 'head') %}*/
/*         {% endif %}*/
/* */
/*         {% if script.inline %}*/
/*             {% do gantry.document.addInlineScript(script.extra|default({})|merge({content: script.inline}), script.priority, script.in_footer == true ? 'footer' : 'head') %}*/
/*         {% endif %}*/
/*     {% endfor %}*/
/* {% endif %}*/
/* {% endspaceless %}*/
