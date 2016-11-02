<?php

/* @gantry-admin/modals/atom.html.twig */
class __TwigTemplate_93cb9339e31d7ebb46e3ffb7d4b40f4406fc93df7220eb559156e50fcb7052de extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'gantry' => array($this, 'block_gantry'),
            'title' => array($this, 'block_title'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate(((((isset($context["ajax"]) ? $context["ajax"] : null) - (isset($context["suffix"]) ? $context["suffix"] : null))) ? ("@gantry-admin/partials/ajax.html.twig") : ("@gantry-admin/partials/base.html.twig")), "@gantry-admin/modals/atom.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_gantry($context, array $blocks = array())
    {
        // line 4
        echo "    <form method=\"post\"
          action=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => (isset($context["action"]) ? $context["action"] : null)), "method"), "html", null, true);
        echo "\"
          data-g-inheritance-settings=\"";
        // line 6
        echo twig_escape_filter($this->env, twig_jsonencode_filter(array("id" => $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "type" => "atom", "subtype" => $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "type", array()))), "html_attr");
        echo "\"
    >
        <input type=\"hidden\" name=\"id\" value=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
        echo "\" />
        <div class=\"g-tabs\" role=\"tablist\">
            <ul>
                ";
        // line 12
        echo "                <li class=\"active\">
                    <a href=\"#\" id=\"g-settings-atom-tab\" role=\"presentation\" aria-controls=\"g-settings-atom\" role=\"tab\" aria-expanded=\"true\">
                        ";
        // line 14
        if ((isset($context["inheritable"]) ? $context["inheritable"] : null)) {
            echo "<i class=\"fa fa-fw fa-";
            echo ((($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "inherit", array()) && twig_in_filter("attributes", $this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "inherit", array()), "include", array())))) ? ("lock") : ("unlock"));
            echo "\"></i>";
        }
        // line 15
        echo "                        ";
        $this->displayBlock('title', $context, $blocks);
        // line 18
        echo "                    </a>
                </li>
                ";
        // line 21
        echo "                ";
        if ((isset($context["inheritance"]) ? $context["inheritance"] : null)) {
            // line 22
            echo "                    <li>
                        <a href=\"#\" id=\"g-settings-inheritance-tab\" role=\"presentation\" aria-controls=\"g-settings-inheritance\" aria-expanded=\"false\">
                            ";
            // line 24
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_INHERITANCE"), "html", null, true);
            echo "
                        </a>
                    </li>
                ";
        }
        // line 28
        echo "            </ul>
        </div>

        <div class=\"g-panes\">
            ";
        // line 33
        echo "            <div class=\"g-pane active\" role=\"tabpanel\" id=\"g-settings-atom\" aria-labelledby=\"g-settings-atom-tab\" aria-expanded=\"true\">
                ";
        // line 34
        $this->loadTemplate("@gantry-admin/pages/configurations/layouts/particle-card.html.twig", "@gantry-admin/modals/atom.html.twig", 34)->display(array_merge($context, array("title" => $this->getAttribute(        // line 35
(isset($context["item"]) ? $context["item"] : null), "title", array()), "blueprints" => $this->getAttribute(        // line 36
(isset($context["blueprints"]) ? $context["blueprints"] : null), "form", array()), "overrideable" => (        // line 37
(isset($context["overrideable"]) ? $context["overrideable"] : null) && ( !$this->getAttribute($this->getAttribute((isset($context["blueprints"]) ? $context["blueprints"] : null), "form", array(), "any", false, true), "overrideable", array(), "any", true, true) || $this->getAttribute($this->getAttribute((isset($context["blueprints"]) ? $context["blueprints"] : null), "form", array()), "overrideable", array()))), "inherit" => (((twig_in_filter("attributes", $this->getAttribute($this->getAttribute(        // line 38
(isset($context["item"]) ? $context["item"] : null), "inherit", array()), "include", array())) && twig_in_filter($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "inherit", array()), "outline", array()), $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["inheritance"]) ? $context["inheritance"] : null), "form", array()), "fields", array()), "outline", array()), "filter", array())))) ? ($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "inherit", array()), "outline", array())) : (null)))));
        // line 40
        echo "            </div>

            ";
        // line 43
        echo "            ";
        if ((isset($context["inheritance"]) ? $context["inheritance"] : null)) {
            // line 44
            echo "                <div class=\"g-pane\" role=\"tabpanel\" id=\"g-settings-inheritance\" aria-labelledby=\"g-settings-inheritance-tab\" aria-expanded=\"false\">
                    <div class=\"card settings-block\">
                        <h4>
                            ";
            // line 47
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_INHERITANCE"), "html", null, true);
            echo "
                        </h4>
                        <div class=\"inner-params\">
                            ";
            // line 50
            $this->loadTemplate("forms/fields.html.twig", "@gantry-admin/modals/atom.html.twig", 50)->display(array("gantry" =>             // line 51
(isset($context["gantry"]) ? $context["gantry"] : null), "blueprints" => $this->getAttribute(            // line 52
(isset($context["inheritance"]) ? $context["inheritance"] : null), "form", array()), "data" => array("inherit" => $this->getAttribute(            // line 53
(isset($context["item"]) ? $context["item"] : null), "inherit", array())), "prefix" => "inherit."));
            // line 56
            echo "                        </div>
                    </div>
                </div>
            ";
        }
        // line 60
        echo "        </div>

        <div class=\"g-modal-actions\">
            <button class=\"button button-primary\" type=\"submit\">";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_APPLY"), "html", null, true);
        echo "</button>
            <button class=\"button button-primary\" data-apply-and-save=\"\">";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_APPLY_SAVE"), "html", null, true);
        echo "</button>
            <button class=\"button g5-dialog-close\">";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_CANCEL"), "html", null, true);
        echo "</button>
        </div>
    </form>
";
    }

    // line 15
    public function block_title($context, array $blocks = array())
    {
        // line 16
        echo "                            ";
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_ATOM"), "html", null, true);
        echo "
                        ";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/modals/atom.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  148 => 16,  145 => 15,  137 => 65,  133 => 64,  129 => 63,  124 => 60,  118 => 56,  116 => 53,  115 => 52,  114 => 51,  113 => 50,  107 => 47,  102 => 44,  99 => 43,  95 => 40,  93 => 38,  92 => 37,  91 => 36,  90 => 35,  89 => 34,  86 => 33,  80 => 28,  73 => 24,  69 => 22,  66 => 21,  62 => 18,  59 => 15,  53 => 14,  49 => 12,  43 => 8,  38 => 6,  34 => 5,  31 => 4,  28 => 3,  19 => 1,);
    }
}
/* {% extends ajax-suffix ? "@gantry-admin/partials/ajax.html.twig" : "@gantry-admin/partials/base.html.twig" %}*/
/* */
/* {% block gantry %}*/
/*     <form method="post"*/
/*           action="{{ gantry.route(action) }}"*/
/*           data-g-inheritance-settings="{{ {'id': item.id, 'type': 'atom', subtype: item.type}|json_encode|e('html_attr') }}"*/
/*     >*/
/*         <input type="hidden" name="id" value="{{ item.id }}" />*/
/*         <div class="g-tabs" role="tablist">*/
/*             <ul>*/
/*                 {# Settings Tab #}*/
/*                 <li class="active">*/
/*                     <a href="#" id="g-settings-atom-tab" role="presentation" aria-controls="g-settings-atom" role="tab" aria-expanded="true">*/
/*                         {% if inheritable %}<i class="fa fa-fw fa-{{ (item.inherit and ('attributes' in item.inherit.include)) ? 'lock' : 'unlock' }}"></i>{% endif %}*/
/*                         {% block title %}*/
/*                             {{ 'GANTRY5_PLATFORM_ATOM'|trans }}*/
/*                         {% endblock %}*/
/*                     </a>*/
/*                 </li>*/
/*                 {# Inheritance Tab #}*/
/*                 {% if inheritance %}*/
/*                     <li>*/
/*                         <a href="#" id="g-settings-inheritance-tab" role="presentation" aria-controls="g-settings-inheritance" aria-expanded="false">*/
/*                             {{ 'GANTRY5_PLATFORM_INHERITANCE'|trans }}*/
/*                         </a>*/
/*                     </li>*/
/*                 {% endif %}*/
/*             </ul>*/
/*         </div>*/
/* */
/*         <div class="g-panes">*/
/*             {# Settings Pane #}*/
/*             <div class="g-pane active" role="tabpanel" id="g-settings-atom" aria-labelledby="g-settings-atom-tab" aria-expanded="true">*/
/*                 {% include '@gantry-admin/pages/configurations/layouts/particle-card.html.twig' with {*/
/*                 title: item.title,*/
/*                 blueprints: blueprints.form,*/
/*                 overrideable: overrideable and (blueprints.form.overrideable is not defined or blueprints.form.overrideable),*/
/*                 inherit: 'attributes' in item.inherit.include and item.inherit.outline in inheritance.form.fields.outline.filter ? item.inherit.outline : null*/
/*                 } %}*/
/*             </div>*/
/* */
/*             {# Inheritance Pane #}*/
/*             {% if inheritance %}*/
/*                 <div class="g-pane" role="tabpanel" id="g-settings-inheritance" aria-labelledby="g-settings-inheritance-tab" aria-expanded="false">*/
/*                     <div class="card settings-block">*/
/*                         <h4>*/
/*                             {{ 'GANTRY5_PLATFORM_INHERITANCE'|trans }}*/
/*                         </h4>*/
/*                         <div class="inner-params">*/
/*                             {% include 'forms/fields.html.twig' with {*/
/*                             gantry: gantry,*/
/*                             blueprints: inheritance.form,*/
/*                             data: {inherit: item.inherit},*/
/*                             prefix: 'inherit.'*/
/*                             } only %}*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             {% endif %}*/
/*         </div>*/
/* */
/*         <div class="g-modal-actions">*/
/*             <button class="button button-primary" type="submit">{{ 'GANTRY5_PLATFORM_APPLY'|trans }}</button>*/
/*             <button class="button button-primary" data-apply-and-save="">{{ 'GANTRY5_PLATFORM_APPLY_SAVE'|trans }}</button>*/
/*             <button class="button g5-dialog-close">{{ 'GANTRY5_PLATFORM_CANCEL'|trans }}</button>*/
/*         </div>*/
/*     </form>*/
/* {% endblock %}*/
/* */
