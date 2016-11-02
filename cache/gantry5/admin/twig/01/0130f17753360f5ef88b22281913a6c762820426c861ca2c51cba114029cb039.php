<?php

/* @gantry-admin//pages/menu/menu.html.twig */
class __TwigTemplate_3672a725b41798106725b173c863d90df10bc9b337eb9270f1954db34ea470a6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'gantry' => array($this, 'block_gantry'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate(((((isset($context["ajax"]) ? $context["ajax"] : null) - (isset($context["suffix"]) ? $context["suffix"] : null))) ? ("@gantry-admin/partials/ajax.html.twig") : ("@gantry-admin/partials/base.html.twig")), "@gantry-admin//pages/menu/menu.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_gantry($context, array $blocks = array())
    {
        // line 4
        echo "<form method=\"post\" action=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => "menu", 1 => (isset($context["id"]) ? $context["id"] : null)), "method"), "html", null, true);
        echo "\" data-mm-container=\"\">
    <div class=\"menu-header\">
        <span class=\"float-right\">
            <button class=\"button button-back-to-conf\">
                <i class=\"fa fa-fw fa-arrow-left\"></i> <span>";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_BACK_SETUP"), "html", null, true);
        echo "</span>
            </button>
            ";
        // line 10
        if ($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "authorize", array(0 => "menu.edit", 1 => (isset($context["id"]) ? $context["id"] : null)), "method")) {
            // line 11
            echo "            <button type=\"submit\" class=\"button button-primary button-save\" data-save=\"Menu\">
                <i class=\"fa fa-fw fa-check\"></i> <span>";
            // line 12
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_SAVE_MENU"), "html", null, true);
            echo "</span>
            </button>
            ";
        }
        // line 15
        echo "        </span>
        <h2 class=\"page-title\">";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_MENU_EDITOR"), "html", null, true);
        echo "</h2>
        <select placeholder=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_SELECT_ELI"), "html", null, true);
        echo "\"
                data-selectize-ajaxify=\"\"
                data-selectize=\"\"
                data-g5-ajaxify-target=\"[data-g5-content]\"
                class=\"menu-select-wrap\"
        >
            ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["menus"]) ? $context["menus"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["menu_name"]) {
            // line 24
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, $context["menu_name"]);
            echo "\"
                    ";
            // line 25
            if (((isset($context["id"]) ? $context["id"] : null) == $context["menu_name"])) {
                echo "selected=\"selected\"";
            }
            // line 26
            echo "                    data-data=\"";
            echo twig_escape_filter($this->env, twig_jsonencode_filter(array("url" => $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => "menu", 1 => $context["menu_name"]), "method"))), "html_attr");
            echo "\">
                ";
            // line 27
            echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, $context["menu_name"]), "html", null, true);
            echo ((((isset($context["default_menu"]) ? $context["default_menu"] : null) == $context["menu_name"])) ? (" ★") : (""));
            echo "
            </option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu_name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "        </select>
    </div>

    ";
        // line 33
        if ( !$this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "authorize", array(0 => "menu.edit", 1 => (isset($context["id"]) ? $context["id"] : null)), "method")) {
            // line 34
            echo "        <div class=\"alert alert-danger\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_MENU_EDIT_UNAUTHORIZED"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_MENU_EDIT_UNAUTHORIZED_PLATFORM"), "html", null, true);
            echo "</div>
    ";
        }
        // line 36
        echo "
    ";
        // line 37
        if ($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "authorize", array(0 => "menu.edit", 1 => (isset($context["id"]) ? $context["id"] : null)), "method")) {
            // line 38
            echo "    <div class=\"g5-mm-particles-picker\">
        <ul class=\"g-menu-addblock\">
            <li data-mm-blocktype=\"module\" data-mm-id=\"__module\">
                <span class=\"menu-item\">
                    <i class=\"fa fa-fw fa-hand-stop-o\"></i>
                    <span class=\"title\">";
            // line 43
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_MODULE"), "html", null, true);
            echo "</span>
                </span>
                <a class=\"config-cog\" href=\"";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => "menu/select/module"), "method"), "html", null, true);
            echo "\">
                    <i aria-label=\"";
            // line 46
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_MENU_MODULE_SETTINGS"), "html", null, true);
            echo "\" class=\"fa fa-cog\"></i>
                </a>
            </li>
            <li data-mm-blocktype=\"particle\" data-mm-id=\"__particle\">
                <span class=\"menu-item\">
                    <i class=\"fa fa-fw fa-hand-stop-o\"></i>
                    <span class=\"title\">";
            // line 52
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_PARTICLE"), "html", null, true);
            echo "</span>
                </span>
                <a class=\"config-cog\" href=\"";
            // line 54
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => "menu/select/particle"), "method"), "html", null, true);
            echo "\">
                    <i aria-label=\"";
            // line 55
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_MENU_PARTICLE_SETTINGS"), "html", null, true);
            echo "\" class=\"fa fa-cog\"></i>
                </a>
            </li>
        </ul>
    </div>
    ";
        }
        // line 61
        echo "
    <div id=\"menu-editor\"
         data-menu-ordering=\"";
        // line 63
        echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute((isset($context["menu"]) ? $context["menu"] : null), "ordering", array())), "html_attr");
        echo "\"
         data-menu-items=\"";
        // line 64
        echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute((isset($context["menu"]) ? $context["menu"] : null), "items", array())), "html_attr");
        echo "\"
         data-menu-settings=\"";
        // line 65
        echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute((isset($context["menu"]) ? $context["menu"] : null), "settings", array())), "html_attr");
        echo "\">
        ";
        // line 66
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["menu"]) ? $context["menu"] : null), "items", array()))) {
            // line 67
            echo "            ";
            $this->loadTemplate("menu/base.html.twig", "@gantry-admin//pages/menu/menu.html.twig", 67)->display(array_merge($context, array("item" => $this->getAttribute((isset($context["menu"]) ? $context["menu"] : null), "root", array()))));
            // line 68
            echo "        ";
        } else {
            // line 69
            echo "            ";
            $this->loadTemplate("menu/empty.html.twig", "@gantry-admin//pages/menu/menu.html.twig", 69)->display(array_merge($context, array("item" => $this->getAttribute((isset($context["menu"]) ? $context["menu"] : null), "root", array()))));
            // line 70
            echo "        ";
        }
        // line 71
        echo "    </div>

    <div id=\"trash\" data-mm-eraseparticle><div class=\"trash-zone\">&times;</div><span>";
        // line 73
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_DROP_DELETE"), "html", null, true);
        echo "</span></div>
</form>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin//pages/menu/menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 73,  191 => 71,  188 => 70,  185 => 69,  182 => 68,  179 => 67,  177 => 66,  173 => 65,  169 => 64,  165 => 63,  161 => 61,  152 => 55,  148 => 54,  143 => 52,  134 => 46,  130 => 45,  125 => 43,  118 => 38,  116 => 37,  113 => 36,  105 => 34,  103 => 33,  98 => 30,  88 => 27,  83 => 26,  79 => 25,  74 => 24,  70 => 23,  61 => 17,  57 => 16,  54 => 15,  48 => 12,  45 => 11,  43 => 10,  38 => 8,  30 => 4,  27 => 3,  18 => 1,);
    }
}
/* {% extends ajax-suffix ? "@gantry-admin/partials/ajax.html.twig" : "@gantry-admin/partials/base.html.twig" %}*/
/* */
/* {% block gantry %}*/
/* <form method="post" action="{{ gantry.route('menu', id) }}" data-mm-container="">*/
/*     <div class="menu-header">*/
/*         <span class="float-right">*/
/*             <button class="button button-back-to-conf">*/
/*                 <i class="fa fa-fw fa-arrow-left"></i> <span>{{ 'GANTRY5_PLATFORM_BACK_SETUP'|trans }}</span>*/
/*             </button>*/
/*             {% if gantry.authorize('menu.edit', id) %}*/
/*             <button type="submit" class="button button-primary button-save" data-save="Menu">*/
/*                 <i class="fa fa-fw fa-check"></i> <span>{{ 'GANTRY5_PLATFORM_SAVE_MENU'|trans }}</span>*/
/*             </button>*/
/*             {% endif %}*/
/*         </span>*/
/*         <h2 class="page-title">{{ 'GANTRY5_PLATFORM_MENU_EDITOR'|trans }}</h2>*/
/*         <select placeholder="{{ 'GANTRY5_PLATFORM_SELECT_ELI'|trans }}"*/
/*                 data-selectize-ajaxify=""*/
/*                 data-selectize=""*/
/*                 data-g5-ajaxify-target="[data-g5-content]"*/
/*                 class="menu-select-wrap"*/
/*         >*/
/*             {% for menu_name in menus %}*/
/*             <option value="{{ menu_name|e }}"*/
/*                     {% if id == menu_name %}selected="selected"{% endif %}*/
/*                     data-data="{{ {url: gantry.route('menu', menu_name)}|json_encode|e('html_attr') }}">*/
/*                 {{ menu_name|capitalize }}{{ default_menu == menu_name ? ' ★' : '' }}*/
/*             </option>*/
/*             {% endfor %}*/
/*         </select>*/
/*     </div>*/
/* */
/*     {% if not gantry.authorize('menu.edit', id) %}*/
/*         <div class="alert alert-danger">{{ 'GANTRY5_PLATFORM_MENU_EDIT_UNAUTHORIZED'|trans }} {{ 'GANTRY5_PLATFORM_MENU_EDIT_UNAUTHORIZED_PLATFORM'|trans }}</div>*/
/*     {% endif %}*/
/* */
/*     {% if gantry.authorize('menu.edit', id) %}*/
/*     <div class="g5-mm-particles-picker">*/
/*         <ul class="g-menu-addblock">*/
/*             <li data-mm-blocktype="module" data-mm-id="__module">*/
/*                 <span class="menu-item">*/
/*                     <i class="fa fa-fw fa-hand-stop-o"></i>*/
/*                     <span class="title">{{ 'GANTRY5_PLATFORM_MODULE'|trans }}</span>*/
/*                 </span>*/
/*                 <a class="config-cog" href="{{ gantry.route('menu/select/module') }}">*/
/*                     <i aria-label="{{ 'GANTRY5_PLATFORM_MENU_MODULE_SETTINGS'|trans }}" class="fa fa-cog"></i>*/
/*                 </a>*/
/*             </li>*/
/*             <li data-mm-blocktype="particle" data-mm-id="__particle">*/
/*                 <span class="menu-item">*/
/*                     <i class="fa fa-fw fa-hand-stop-o"></i>*/
/*                     <span class="title">{{ 'GANTRY5_PLATFORM_PARTICLE'|trans }}</span>*/
/*                 </span>*/
/*                 <a class="config-cog" href="{{ gantry.route('menu/select/particle') }}">*/
/*                     <i aria-label="{{ 'GANTRY5_PLATFORM_MENU_PARTICLE_SETTINGS'|trans }}" class="fa fa-cog"></i>*/
/*                 </a>*/
/*             </li>*/
/*         </ul>*/
/*     </div>*/
/*     {% endif %}*/
/* */
/*     <div id="menu-editor"*/
/*          data-menu-ordering="{{ menu.ordering|json_encode|escape('html_attr') }}"*/
/*          data-menu-items="{{ menu.items|json_encode|escape('html_attr') }}"*/
/*          data-menu-settings="{{ menu.settings|json_encode|escape('html_attr') }}">*/
/*         {% if menu.items|length %}*/
/*             {% include 'menu/base.html.twig' with {'item': menu.root} %}*/
/*         {% else %}*/
/*             {% include 'menu/empty.html.twig' with {'item': menu.root} %}*/
/*         {% endif %}*/
/*     </div>*/
/* */
/*     <div id="trash" data-mm-eraseparticle><div class="trash-zone">&times;</div><span>{{ 'GANTRY5_PLATFORM_DROP_DELETE'|trans }}</span></div>*/
/* </form>*/
/* {% endblock %}*/
/* */
