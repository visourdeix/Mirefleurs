<?php

/* @gantry-admin/pages/configurations/layouts/particle-card.html.twig */
class __TwigTemplate_48672cfcd7f2508d43a0382632a29a37402d339f7d4a1eac074df536020f05db extends Twig_Template
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
        echo "<div class=\"card settings-block\">
    <h4>
        ";
        // line 3
        if ((isset($context["editable"]) ? $context["editable"] : null)) {
            // line 4
            echo "            <span data-title-editable=\"";
            echo twig_escape_filter($this->env, trim($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array())), "html", null, true);
            echo "\" class=\"title\">";
            echo twig_escape_filter($this->env, trim($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array())), "html", null, true);
            echo "</span>
            <i class=\"fa fa-pencil font-small\" tabindex=\"0\" aria-label=\"";
            // line 5
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_EDIT_TITLE", trim($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()))), "html", null, true);
            echo "\" data-title-edit=\"\"></i>
        ";
        } else {
            // line 7
            echo "            ";
            echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo "
        ";
        }
        // line 9
        echo "
        ";
        // line 10
        if ((isset($context["item"]) ? $context["item"] : null)) {
            // line 11
            echo "            <span class=\"badge font-small\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "subtype", array()), "html", null, true);
            echo "</span>
            ";
            // line 12
            if ($this->getAttribute($this->getAttribute((isset($context["blueprints"]) ? $context["blueprints"] : null), "fields", array()), "enabled", array())) {
                // line 13
                echo "                ";
                $this->loadTemplate("forms/fields/enable/enable.html.twig", "@gantry-admin/pages/configurations/layouts/particle-card.html.twig", 13)->display(array_merge($context, array("name" => (("particles." . (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "subtype", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "subtype", array()), $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "type", array()))) : ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "type", array())))) . ".enabled"), "field" => $this->getAttribute($this->getAttribute((isset($context["blueprints"]) ? $context["blueprints"] : null), "fields", array()), "enabled", array()), "value" => $this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "attributes", array()), "enabled", array()), "default" => 1, "disabled" =>  !$this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "get", array(0 => (("particles." . $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "subtype", array())) . ".enabled"), 1 => true), "method"))));
                // line 14
                echo "            ";
            }
            // line 15
            echo "        ";
        }
        // line 16
        echo "    </h4>

    <div class=\"inner-params\">
        ";
        // line 19
        $this->loadTemplate("forms/fields.html.twig", "@gantry-admin/pages/configurations/layouts/particle-card.html.twig", 19)->display($context);
        // line 20
        echo "    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/pages/configurations/layouts/particle-card.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 20,  69 => 19,  64 => 16,  61 => 15,  58 => 14,  55 => 13,  53 => 12,  48 => 11,  46 => 10,  43 => 9,  37 => 7,  32 => 5,  25 => 4,  23 => 3,  19 => 1,);
    }
}
/* <div class="card settings-block">*/
/*     <h4>*/
/*         {% if editable %}*/
/*             <span data-title-editable="{{ item.title|trim }}" class="title">{{ item.title|trim }}</span>*/
/*             <i class="fa fa-pencil font-small" tabindex="0" aria-label="{{ 'GANTRY5_PLATFORM_EDIT_TITLE'|trans(item.title|trim) }}" data-title-edit=""></i>*/
/*         {% else %}*/
/*             {{ title }}*/
/*         {% endif %}*/
/* */
/*         {% if item %}*/
/*             <span class="badge font-small">{{ item.subtype }}</span>*/
/*             {% if blueprints.fields.enabled %}*/
/*                 {% include 'forms/fields/enable/enable.html.twig' with {'name': 'particles.' ~ item.subtype|default(item.type) ~ '.enabled', 'field': blueprints.fields.enabled, 'value': item.attributes.enabled, 'default': 1, 'disabled': not gantry.config.get('particles.' ~ item.subtype ~ '.enabled', true)} %}*/
/*             {% endif %}*/
/*         {% endif %}*/
/*     </h4>*/
/* */
/*     <div class="inner-params">*/
/*         {% include 'forms/fields.html.twig' %}*/
/*     </div>*/
/* </div>*/
/* */
