<?php

/* forms/field.html.twig */
class __TwigTemplate_ef77ed5bfe8bc767719c1d4a7b0717963ded78f9dfa0aa49e8b19953f2780c39 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascript' => array($this, 'block_javascript'),
            'javascript_footer' => array($this, 'block_javascript_footer'),
            'field' => array($this, 'block_field'),
            'overridable' => array($this, 'block_overridable'),
            'contents' => array($this, 'block_contents'),
            'label' => array($this, 'block_label'),
            'group' => array($this, 'block_group'),
            'input' => array($this, 'block_input'),
            'global_attributes' => array($this, 'block_global_attributes'),
            'reset_field' => array($this, 'block_reset_field'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $assetFunction = $this->env->getFunction('parse_assets')->getCallable();
        $assetVariables = array();
        if ($assetVariables && !is_array($assetVariables)) {
            throw new UnexpectedValueException('{% scripts with x %}: x is not an array');
        }
        $location = "head";
        if ($location && !is_string($location)) {
            throw new UnexpectedValueException('{% scripts in x %}: x is not a string');
        }
        $priority = isset($assetVariables['priority']) ? $assetVariables['priority'] : 0;
        ob_start();
        // line 2
        echo "    ";
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 4
        echo "
    ";
        // line 5
        $this->displayBlock('javascript', $context, $blocks);
        $content = ob_get_clean();
        echo $assetFunction($content, $location, $priority);
        // line 9
        $assetFunction = $this->env->getFunction('parse_assets')->getCallable();
        $assetVariables = array();
        if ($assetVariables && !is_array($assetVariables)) {
            throw new UnexpectedValueException('{% scripts with x %}: x is not an array');
        }
        $location = "footer";
        if ($location && !is_string($location)) {
            throw new UnexpectedValueException('{% scripts in x %}: x is not a string');
        }
        $priority = isset($assetVariables['priority']) ? $assetVariables['priority'] : 0;
        ob_start();
        // line 10
        echo "    ";
        $this->displayBlock('javascript_footer', $context, $blocks);
        $content = ob_get_clean();
        echo $assetFunction($content, $location, $priority);
        // line 14
        $context["name"] = (((array_key_exists("name", $context) &&  !(null === (isset($context["name"]) ? $context["name"] : null)))) ? ((isset($context["name"]) ? $context["name"] : null)) : ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "name", array())));
        // line 15
        $context["default_value"] = (((array_key_exists("default_value", $context) &&  !(null === (isset($context["default_value"]) ? $context["default_value"] : null)))) ? ((isset($context["default_value"]) ? $context["default_value"] : null)) : ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "default", array())));
        // line 16
        $context["current_value"] = (((array_key_exists("current_value", $context) &&  !(null === (isset($context["current_value"]) ? $context["current_value"] : null)))) ? ((isset($context["current_value"]) ? $context["current_value"] : null)) : ((isset($context["value"]) ? $context["value"] : null)));
        // line 17
        $context["has_value"] =  !(null === (isset($context["current_value"]) ? $context["current_value"] : null));
        // line 18
        $context["value"] = (((isset($context["has_value"]) ? $context["has_value"] : null)) ? ((isset($context["current_value"]) ? $context["current_value"] : null)) : ((isset($context["default_value"]) ? $context["default_value"] : null)));
        // line 20
        $this->displayBlock('field', $context, $blocks);
    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo "    ";
    }

    // line 5
    public function block_javascript($context, array $blocks = array())
    {
        // line 6
        echo "    ";
    }

    // line 10
    public function block_javascript_footer($context, array $blocks = array())
    {
        // line 11
        echo "    ";
    }

    // line 20
    public function block_field($context, array $blocks = array())
    {
        // line 21
        if (( !$this->getAttribute((isset($context["field"]) ? $context["field"] : null), "isset", array()) ||  !(null === (isset($context["value"]) ? $context["value"] : null)))) {
            // line 22
            echo "    <div class=\"settings-param ";
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "type", array()), ".", "-"), "html", null, true);
            echo "\">
        ";
            // line 23
            $this->displayBlock('overridable', $context, $blocks);
            // line 29
            echo "        ";
            $this->displayBlock('contents', $context, $blocks);
            // line 70
            echo "    </div>
";
        }
    }

    // line 23
    public function block_overridable($context, array $blocks = array())
    {
        // line 24
        echo "        ";
        $context["field_overridable"] = ((($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "overridable", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "overridable", array())))) ? ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "overridable", array())) : (((($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "overrideable", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "overrideable", array())))) ? ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "overrideable", array())) : (true))));
        // line 25
        echo "        ";
        if (((isset($context["overrideable"]) ? $context["overrideable"] : null) && ((isset($context["field_overridable"]) ? $context["field_overridable"] : null) || (isset($context["has_value"]) ? $context["has_value"] : null)))) {
            // line 26
            echo "            ";
            $this->loadTemplate("forms/override.html.twig", "forms/field.html.twig", 26)->display(array_merge($context, array("scope" => (isset($context["scope"]) ? $context["scope"] : null), "name" => (isset($context["name"]) ? $context["name"] : null), "field" => (isset($context["field"]) ? $context["field"] : null))));
            // line 27
            echo "        ";
        }
        // line 28
        echo "        ";
    }

    // line 29
    public function block_contents($context, array $blocks = array())
    {
        // line 30
        echo "            <span class=\"settings-param-title float-left\">
                ";
        // line 31
        $this->displayBlock('label', $context, $blocks);
        // line 42
        echo "            </span>
            <div class=\"settings-param-field\">
                ";
        // line 44
        $this->displayBlock('group', $context, $blocks);
        // line 68
        echo "            </div>
        ";
    }

    // line 31
    public function block_label($context, array $blocks = array())
    {
        // line 32
        echo "                    ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "description", array())) {
            // line 33
            echo "                        ";
            $context["description"] = $this->env->getExtension('GantryTwig')->transKeyFilter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "description", array()), "FORM_FIELD", (isset($context["scope"]) ? $context["scope"] : null), (isset($context["name"]) ? $context["name"] : null), "DESC");
            // line 34
            echo "                        <span data-tip=\"";
            echo (isset($context["description"]) ? $context["description"] : null);
            echo "\" data-tip-place=\"top-right\" aria-label=\"";
            echo twig_escape_filter($this->env, (isset($context["description"]) ? $context["description"] : null), "html", null, true);
            echo "\" data-title=\"";
            echo twig_escape_filter($this->env, (isset($context["description"]) ? $context["description"] : null), "html", null, true);
            echo "\">
                            ";
            // line 35
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transKeyFilter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "label", array()), "FORM_FIELD", (isset($context["scope"]) ? $context["scope"] : null), (isset($context["name"]) ? $context["name"] : null), "LABEL"), "html", null, true);
            echo "
                        </span>
                    ";
        } else {
            // line 38
            echo "                        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transKeyFilter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "label", array()), "FORM_FIELD", (isset($context["scope"]) ? $context["scope"] : null), (isset($context["name"]) ? $context["name"] : null), "LABEL"), "html", null, true);
            echo "
                    ";
        }
        // line 40
        echo "                    ";
        echo ((twig_in_filter($this->getAttribute($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "validate", array()), "required", array()), array(0 => "on", 1 => "true", 2 => 1))) ? ("<span class=\"required\">*</span>") : (""));
        echo "
                ";
    }

    // line 44
    public function block_group($context, array $blocks = array())
    {
        // line 45
        echo "                    ";
        $this->displayBlock('input', $context, $blocks);
        // line 67
        echo "                ";
    }

    // line 45
    public function block_input($context, array $blocks = array())
    {
        // line 46
        echo "                        <input
                                ";
        // line 48
        echo "                                name=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->fieldNameFilter(((isset($context["scope"]) ? $context["scope"] : null) . (isset($context["name"]) ? $context["name"] : null))), "html", null, true);
        echo "\"
                                value=\"";
        // line 49
        echo twig_escape_filter($this->env, twig_join_filter((isset($context["value"]) ? $context["value"] : null), ", "), "html", null, true);
        echo "\"
                                ";
        // line 51
        echo "                                ";
        $this->displayBlock('global_attributes', $context, $blocks);
        // line 59
        echo "                                />

                        ";
        // line 61
        $this->displayBlock('reset_field', $context, $blocks);
        // line 66
        echo "                    ";
    }

    // line 51
    public function block_global_attributes($context, array $blocks = array())
    {
        // line 52
        echo "                                    ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "class", array(), "any", true, true)) {
            echo " class=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "class", array()), "html", null, true);
            echo "\" ";
        }
        // line 53
        echo "                                    ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "id", array(), "any", true, true)) {
            echo " id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "id", array()), "html", null, true);
            echo "\" ";
        }
        // line 54
        echo "                                    ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "style", array(), "any", true, true)) {
            echo " style=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "style", array()), "html", null, true);
            echo "\" ";
        }
        // line 55
        echo "                                    ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "title", array(), "any", true, true)) {
            echo " title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "title", array()), "html", null, true);
            echo "\" ";
        }
        // line 56
        echo "                                    ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "override_target", array(), "any", true, true)) {
            echo " data-override-target=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "override_target", array()), "html_attr");
            echo "\" ";
        }
        // line 57
        echo "                                    aria-label=\"";
        echo twig_escape_filter($this->env, trim(twig_title_string_filter($this->env, twig_replace_filter(((isset($context["scope"]) ? $context["scope"] : null) . (isset($context["name"]) ? $context["name"] : null)), array("." => " ")))), "html", null, true);
        echo "\"
                                ";
    }

    // line 61
    public function block_reset_field($context, array $blocks = array())
    {
        // line 62
        if (( !$this->getAttribute((isset($context["field"]) ? $context["field"] : null), "reset_field", array(), "any", true, true) || twig_in_filter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "reset_field", array()), array(0 => "on", 1 => "true", 2 => 1)))) {
            // line 63
            echo "                                <span class=\"g-reset-field\" data-g-reset-field=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->fieldNameFilter(((isset($context["scope"]) ? $context["scope"] : null) . (isset($context["name"]) ? $context["name"] : null))), "html", null, true);
            echo "\"><i class=\"fa  fa-fw fa-times-circle\"></i></span>
                            ";
        }
    }

    public function getTemplateName()
    {
        return "forms/field.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  288 => 63,  286 => 62,  283 => 61,  276 => 57,  269 => 56,  262 => 55,  255 => 54,  248 => 53,  241 => 52,  238 => 51,  234 => 66,  232 => 61,  228 => 59,  225 => 51,  221 => 49,  216 => 48,  213 => 46,  210 => 45,  206 => 67,  203 => 45,  200 => 44,  193 => 40,  187 => 38,  181 => 35,  172 => 34,  169 => 33,  166 => 32,  163 => 31,  158 => 68,  156 => 44,  152 => 42,  150 => 31,  147 => 30,  144 => 29,  140 => 28,  137 => 27,  134 => 26,  131 => 25,  128 => 24,  125 => 23,  119 => 70,  116 => 29,  114 => 23,  109 => 22,  107 => 21,  104 => 20,  100 => 11,  97 => 10,  93 => 6,  90 => 5,  86 => 3,  83 => 2,  79 => 20,  77 => 18,  75 => 17,  73 => 16,  71 => 15,  69 => 14,  64 => 10,  52 => 9,  48 => 5,  45 => 4,  42 => 2,  30 => 1,);
    }
}
/* {% assets %}*/
/*     {% block stylesheets %}*/
/*     {% endblock %}*/
/* */
/*     {% block javascript %}*/
/*     {% endblock %}*/
/* {% endassets -%}*/
/* */
/* {% assets in 'footer' %}*/
/*     {% block javascript_footer %}*/
/*     {% endblock %}*/
/* {% endassets -%}*/
/* */
/* {% set name = (name ?? field.name) -%}*/
/* {% set default_value = (default_value ?? field.default) -%}*/
/* {% set current_value = (current_value ?? value) -%}*/
/* {% set has_value = current_value is not null -%}*/
/* {% set value = has_value ? current_value : default_value -%}*/
/* */
/* {% block field %}*/
/* {% if not field.isset or value is not null %}*/
/*     <div class="settings-param {{ field.type|replace('.', '-') }}">*/
/*         {% block overridable %}*/
/*         {% set field_overridable = field.overridable ?? (field.overrideable ?? true) %}*/
/*         {% if overrideable and (field_overridable or has_value) %}*/
/*             {% include 'forms/override.html.twig' with {'scope': scope, 'name': name, 'field': field} %}*/
/*         {% endif %}*/
/*         {% endblock %}*/
/*         {% block contents %}*/
/*             <span class="settings-param-title float-left">*/
/*                 {% block label %}*/
/*                     {% if field.description %}*/
/*                         {% set description = field.description|trans_key('FORM_FIELD', scope, name, 'DESC') %}*/
/*                         <span data-tip="{{ description|raw }}" data-tip-place="top-right" aria-label="{{ description }}" data-title="{{ description }}">*/
/*                             {{ field.label|trans_key('FORM_FIELD', scope, name, 'LABEL') }}*/
/*                         </span>*/
/*                     {% else %}*/
/*                         {{ field.label|trans_key('FORM_FIELD', scope, name, 'LABEL') }}*/
/*                     {% endif %}*/
/*                     {{ field.validate.required in ['on', 'true', 1] ? '<span class="required">*</span>' }}*/
/*                 {% endblock %}*/
/*             </span>*/
/*             <div class="settings-param-field">*/
/*                 {% block group %}*/
/*                     {% block input %}*/
/*                         <input*/
/*                                 {# required attribute structures #}*/
/*                                 name="{{ (scope ~ name)|fieldName }}"*/
/*                                 value="{{ value|join(', ') }}"*/
/*                                 {# global attribute structures #}*/
/*                                 {% block global_attributes %}*/
/*                                     {% if field.class is defined %} class="{{ field.class }}" {% endif %}*/
/*                                     {% if field.id is defined %} id="{{ field.id }}" {% endif %}*/
/*                                     {% if field.style is defined %} style="{{ field.style }}" {% endif %}*/
/*                                     {% if field.title is defined %} title="{{ field.title }}" {% endif %}*/
/*                                     {% if field.override_target is defined %} data-override-target="{{ field.override_target|e('html_attr') }}" {% endif %}*/
/*                                     aria-label="{{ (scope ~ name)|replace({'.': ' '})|title|trim }}"*/
/*                                 {% endblock %}*/
/*                                 />*/
/* */
/*                         {% block reset_field -%}*/
/*                             {% if field.reset_field is not defined or field.reset_field in ['on', 'true', 1] %}*/
/*                                 <span class="g-reset-field" data-g-reset-field="{{ (scope ~ name)|fieldName }}"><i class="fa  fa-fw fa-times-circle"></i></span>*/
/*                             {% endif %}*/
/*                         {%- endblock %}*/
/*                     {% endblock %}*/
/*                 {% endblock %}*/
/*             </div>*/
/*         {% endblock %}*/
/*     </div>*/
/* {% endif %}*/
/* {% endblock %}*/
/* */
