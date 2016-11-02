<?php

/* forms/fields.html.twig */
class __TwigTemplate_6c6ca5f7273ebf95d953961c24bf14e65ca2f8945c6b102b43fe758c5a53a474 extends Twig_Template
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
        $context["scope"] = (((array_key_exists("scope", $context) &&  !(null === (isset($context["scope"]) ? $context["scope"] : null)))) ? ((isset($context["scope"]) ? $context["scope"] : null)) : ((isset($context["prefix"]) ? $context["prefix"] : null)));
        // line 2
        echo "
";
        // line 3
        if ($this->getAttribute((isset($context["blueprints"]) ? $context["blueprints"] : null), "type", array())) {
            // line 4
            echo "    ";
            $context["field"] = (isset($context["blueprints"]) ? $context["blueprints"] : null);
            // line 5
            echo "    ";
            $context["current_value"] = (isset($context["data"]) ? $context["data"] : null);
            // line 6
            echo "    ";
            $context["default_value"] = (isset($context["defaults"]) ? $context["defaults"] : null);
            // line 7
            echo "
    ";
            // line 8
            $this->loadTemplate(array(0 => (("forms/fields/" . twig_replace_filter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "type", array()), ".", "/")) . ".html.twig"), 1 => "forms/fields/unknown/unknown.html.twig"), "forms/fields.html.twig", 8)->display($context);
            // line 9
            echo "
";
        } else {
            // line 11
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["blueprints"]) ? $context["blueprints"] : null), "fields", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["name"] => $context["field"]) {
                // line 12
                echo "        ";
                if ((is_string($__internal_0c3dae215a9fdad76672a6e2d52fd1e916a6edf4fc00a90fbb23e05a70db29ed = $context["name"]) && is_string($__internal_7e1bd555c16529f1e0a64833110fbd3abd890a2fa28bd9f8ae3c47bd11c8acbc = ".") && ('' === $__internal_7e1bd555c16529f1e0a64833110fbd3abd890a2fa28bd9f8ae3c47bd11c8acbc || 0 === strpos($__internal_0c3dae215a9fdad76672a6e2d52fd1e916a6edf4fc00a90fbb23e05a70db29ed, $__internal_7e1bd555c16529f1e0a64833110fbd3abd890a2fa28bd9f8ae3c47bd11c8acbc)))) {
                    // line 13
                    echo "            ";
                    $context["name"] = twig_slice($this->env, $context["name"], 1, null);
                    // line 14
                    echo "        ";
                }
                // line 15
                echo "
        ";
                // line 16
                $context["current_value"] = $this->env->getExtension('GantryTwig')->nestedFunc((isset($context["data"]) ? $context["data"] : null), ((isset($context["scope"]) ? $context["scope"] : null) . $context["name"]));
                // line 17
                echo "        ";
                $context["default_value"] = $this->env->getExtension('GantryTwig')->nestedFunc((isset($context["defaults"]) ? $context["defaults"] : null), ((isset($context["scope"]) ? $context["scope"] : null) . $context["name"]));
                // line 18
                echo "        ";
                $context["has_value"] =  !(null === (isset($context["current_value"]) ? $context["current_value"] : null));
                // line 19
                echo "        ";
                $context["field_overrideable"] = (($this->getAttribute($context["field"], "overridable", array(), "any", true, true)) ? ($this->getAttribute($context["field"], "overridable", array())) : ((($this->getAttribute($context["field"], "overrideable", array(), "any", true, true)) ? ($this->getAttribute($context["field"], "overrideable", array())) : (true))));
                // line 20
                echo "
        ";
                // line 21
                if ((((($this->getAttribute($context["field"], "type", array()) && !twig_in_filter($context["name"], (isset($context["skip"]) ? $context["skip"] : null))) &&  !$this->getAttribute($context["field"], "skip", array())) &&  !(((isset($context["ignore_not_overrideable"]) ? $context["ignore_not_overrideable"] : null) &&  !(isset($context["field_overrideable"]) ? $context["field_overrideable"] : null)) &&  !(isset($context["has_value"]) ? $context["has_value"] : null))) &&  !( !(isset($context["has_value"]) ? $context["has_value"] : null) && (isset($context["not_global_overrideable"]) ? $context["not_global_overrideable"] : null)))) {
                    // line 22
                    echo "            ";
                    $context["field"] = ($context["field"] + array("name" => $context["name"]));
                    // line 23
                    echo "
            ";
                    // line 24
                    $this->loadTemplate(array(0 => (("forms/fields/" . twig_replace_filter($this->getAttribute($context["field"], "type", array()), ".", "/")) . ".html.twig"), 1 => "forms/fields/unknown/unknown.html.twig"), "forms/fields.html.twig", 24)->display($context);
                    // line 25
                    echo "        ";
                }
                // line 26
                echo "    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['field'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    public function getTemplateName()
    {
        return "forms/fields.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 26,  98 => 25,  96 => 24,  93 => 23,  90 => 22,  88 => 21,  85 => 20,  82 => 19,  79 => 18,  76 => 17,  74 => 16,  71 => 15,  68 => 14,  65 => 13,  62 => 12,  44 => 11,  40 => 9,  38 => 8,  35 => 7,  32 => 6,  29 => 5,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }
}
/* {% set scope = scope ?? prefix %}*/
/* */
/* {% if blueprints.type %}*/
/*     {% set field = blueprints %}*/
/*     {% set current_value = data %}*/
/*     {% set default_value = defaults %}*/
/* */
/*     {% include ["forms/fields/" ~ field.type|replace('.', '/') ~ ".html.twig", 'forms/fields/unknown/unknown.html.twig'] %}*/
/* */
/* {% else %}*/
/*     {% for name, field in blueprints.fields %}*/
/*         {% if name starts with '.' %}*/
/*             {% set name = name[1:] %}*/
/*         {% endif %}*/
/* */
/*         {% set current_value = nested(data, scope ~ name) %}*/
/*         {% set default_value = nested(defaults, scope ~ name) %}*/
/*         {% set has_value = current_value is not null %}*/
/*         {% set field_overrideable = field.overridable is defined ? field.overridable : (field.overrideable is defined ? field.overrideable : true) %}*/
/* */
/*         {% if field.type and name not in skip and not field.skip and not(ignore_not_overrideable and not field_overrideable and not has_value) and not(not has_value and not_global_overrideable) %}*/
/*             {% set field = field + {'name': name} %}*/
/* */
/*             {% include ["forms/fields/" ~ field.type|replace('.', '/') ~ ".html.twig", 'forms/fields/unknown/unknown.html.twig'] %}*/
/*         {% endif %}*/
/*     {% endfor %}*/
/* {% endif %}*/
/* */
