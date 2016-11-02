<?php

/* @gantry-admin/partials/header.html.twig */
class __TwigTemplate_33c3af512ca516980f6fd6d2e8a9529085655df69721398b8beb13884154be01 extends Twig_Template
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
        echo "<div class=\"g-grid\">
    <div class=\"g-block\">
        <div class=\"g-content clearfix\">
            <span class=\"theme-title\">
                <i class=\"fa fa-tint\"></i>
                ";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_THEME"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "title", array()), "html", null, true);
        echo "
                <small>(v";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "version", array()), "html", null, true);
        echo " / ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "name", array()), "html", null, true);
        echo ")</small>
            </span>

            ";
        // line 10
        $context["settings_url"] = $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "platform", array()), "settings", array());
        // line 11
        echo "            ";
        $context["settings_key"] = $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "platform", array()), "settings_key", array());
        // line 12
        echo "            <ul class=\"float-right\">
                <li ";
        // line 13
        echo ((((isset($context["location"]) ? $context["location"] : null) == "configurations")) ? ("class=\"active\"") : (""));
        echo ">
                    <a data-g5-ajaxify=\"\"
                       data-g5-ajaxify-target=\"[data-g5-content]\"
                       href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => "configurations"), "method"), "html", null, true);
        echo "\"
                    >
                        <i class=\"fa fa-fw fa-th\"></i> ";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_OUTLINES"), "html", null, true);
        echo "
                    </a>
                </li>
                ";
        // line 22
        echo "                ";
        // line 27
        echo "                ";
        if ($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "authorize", array(0 => "menu.manage"), "method")) {
            // line 28
            echo "                <li ";
            echo ((((isset($context["location"]) ? $context["location"] : null) == "menu")) ? ("class=\"active\"") : (""));
            echo ">
                    <a data-g5-ajaxify=\"\" data-g5-ajaxify-target=\"[data-g5-content]\" href=\"";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => "menu"), "method"), "html", null, true);
            echo "\">
                        <i class=\"fa fa-fw fa-bars\"></i> <span>";
            // line 30
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_MENU"), "html", null, true);
            echo "</span>
                    </a>
                </li>
                ";
        }
        // line 34
        echo "                <li ";
        echo ((((isset($context["location"]) ? $context["location"] : null) == "about")) ? ("class=\"active\"") : (""));
        echo ">
                    <a data-g5-ajaxify=\"\" data-g5-ajaxify-target=\"[data-g5-content]\" href=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => "about"), "method"), "html", null, true);
        echo "\">
                        <i class=\"fa fa-fw fa-question-circle\"></i> <span>";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_ABOUT"), "html", null, true);
        echo "</span>
                    </a>
                </li>
                <li data-g-extras data-g-popover data-g-popover-style=\"extras\" aria-haspopup=\"true\" aria-expanded=\"false\" role=\"presentation\">
                    <a href=\"#\"><i class=\"fa fa-fw fa-cog\"></i> ";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_EXTRAS"), "html", null, true);
        echo " <i class=\"small fa fa-fw fa-chevron-down\"></i></a>
                    <ul data-popover-content class=\"hidden\" tabindex=\"0\">
                        ";
        // line 42
        $context["prod_mode"] = $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_PRODUCTION");
        // line 43
        echo "                        ";
        $context["dev_mode"] = $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_DEVELOPMENT");
        // line 44
        echo "                        <li data-g-devprod=\"";
        echo twig_escape_filter($this->env, twig_jsonencode_filter(array(0 => (isset($context["dev_mode"]) ? $context["dev_mode"] : null), 1 => (isset($context["prod_mode"]) ? $context["prod_mode"] : null))), "html_attr");
        echo "\">
                            <i class=\"fa fa-fw fa-wrench\"></i> <span class=\"devprod-mode\">";
        // line 45
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "global", array()), "production", array())) ? ((isset($context["prod_mode"]) ? $context["prod_mode"] : null)) : ((isset($context["dev_mode"]) ? $context["dev_mode"] : null))), "html", null, true);
        echo "</span>
                            <div class=\"float-right\">
                                <span class=\"enabler\" role=\"checkbox\" aria-checked=\"";
        // line 47
        echo ((($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "global", array()), "production", array()) == "0")) ? ("false") : ("true"));
        echo "\" tabindex=\"0\" aria-label=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_PRODUCTION_MODE_ARIA_LABEL"), "html", null, true);
        echo "\">
                                <input type=\"hidden\" name=\"production_mode\" value=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "global", array()), "production", array()), "html", null, true);
        echo "\">
                                    <span class=\"toggle\"><span class=\"knob\"></span></span>
                                </span>
                            </div>
                        </li>
                        <li data-g-popover-follow>
                            <a tabindex=\"0\"
                               href=\"";
        // line 55
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => "cache"), "method"), "html", null, true);
        echo "\"
                               data-ajax-action=\"\"
                               data-ajax-action-method=\"get\"
                               data-ajax-action-indicator=\"li[data-g-extras]\"
                            ><i class=\"fa fa-fw fa-recycle\"></i> ";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_CLEAR_CACHE"), "html", null, true);
        echo "
                            </a>
                        </li>
                        ";
        // line 62
        if ((isset($context["settings_url"]) ? $context["settings_url"] : null)) {
            // line 63
            echo "                            <li>
                                <a tabindex=\"0\"
                                   href=\"";
            // line 65
            echo twig_escape_filter($this->env, (isset($context["settings_url"]) ? $context["settings_url"] : null), "html", null, true);
            echo "\"
                                   data-settings-key=\"";
            // line 66
            echo twig_escape_filter($this->env, (isset($context["settings_key"]) ? $context["settings_key"] : null), "html", null, true);
            echo "\"
                                >
                                    <i class=\"fa fa-fw fa-";
            // line 68
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "platform", array()), "name", array()), "html", null, true);
            echo "\"></i> ";
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_PLATFORM_SETTINGS"), "html", null, true);
            echo "
                                </a>
                            </li>
                        ";
        }
        // line 72
        echo "                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/partials/header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 72,  166 => 68,  161 => 66,  157 => 65,  153 => 63,  151 => 62,  145 => 59,  138 => 55,  128 => 48,  122 => 47,  117 => 45,  112 => 44,  109 => 43,  107 => 42,  102 => 40,  95 => 36,  91 => 35,  86 => 34,  79 => 30,  75 => 29,  70 => 28,  67 => 27,  65 => 22,  59 => 18,  54 => 16,  48 => 13,  45 => 12,  42 => 11,  40 => 10,  32 => 7,  26 => 6,  19 => 1,);
    }
}
/* <div class="g-grid">*/
/*     <div class="g-block">*/
/*         <div class="g-content clearfix">*/
/*             <span class="theme-title">*/
/*                 <i class="fa fa-tint"></i>*/
/*                 {{ 'GANTRY5_PLATFORM_THEME'|trans }}: {{ gantry.theme.title }}*/
/*                 <small>(v{{ gantry.theme.version }} / {{ gantry.theme.name }})</small>*/
/*             </span>*/
/* */
/*             {% set settings_url = gantry.platform.settings %}*/
/*             {% set settings_key = gantry.platform.settings_key %}*/
/*             <ul class="float-right">*/
/*                 <li {{ (location == 'configurations') ? 'class="active"' }}>*/
/*                     <a data-g5-ajaxify=""*/
/*                        data-g5-ajaxify-target="[data-g5-content]"*/
/*                        href="{{ gantry.route('configurations') }}"*/
/*                     >*/
/*                         <i class="fa fa-fw fa-th"></i> {{ 'GANTRY5_PLATFORM_OUTLINES'|trans }}*/
/*                     </a>*/
/*                 </li>*/
/*                 {#TODO: Hide positions for the moment#}*/
/*                 {#<li {{ (location == 'positions') ? 'class="active"' }}>*/
/*                     <a data-g5-ajaxify="" data-g5-ajaxify-target="[data-g5-content]" href="{{ gantry.route('positions') }}">*/
/*                         <i class="fa fa-fw fa-object-group"></i> <span>{{ 'GANTRY5_PLATFORM_POSITIONS'|trans }}</span>*/
/*                     </a>*/
/*                 </li>#}*/
/*                 {% if gantry.authorize('menu.manage') %}*/
/*                 <li {{ (location == 'menu') ? 'class="active"' }}>*/
/*                     <a data-g5-ajaxify="" data-g5-ajaxify-target="[data-g5-content]" href="{{ gantry.route('menu') }}">*/
/*                         <i class="fa fa-fw fa-bars"></i> <span>{{ 'GANTRY5_PLATFORM_MENU'|trans }}</span>*/
/*                     </a>*/
/*                 </li>*/
/*                 {% endif %}*/
/*                 <li {{ (location == 'about') ? 'class="active"' }}>*/
/*                     <a data-g5-ajaxify="" data-g5-ajaxify-target="[data-g5-content]" href="{{ gantry.route('about') }}">*/
/*                         <i class="fa fa-fw fa-question-circle"></i> <span>{{ 'GANTRY5_PLATFORM_ABOUT'|trans }}</span>*/
/*                     </a>*/
/*                 </li>*/
/*                 <li data-g-extras data-g-popover data-g-popover-style="extras" aria-haspopup="true" aria-expanded="false" role="presentation">*/
/*                     <a href="#"><i class="fa fa-fw fa-cog"></i> {{ 'GANTRY5_PLATFORM_EXTRAS'|trans }} <i class="small fa fa-fw fa-chevron-down"></i></a>*/
/*                     <ul data-popover-content class="hidden" tabindex="0">*/
/*                         {% set prod_mode = 'GANTRY5_PLATFORM_PRODUCTION'|trans %}*/
/*                         {% set dev_mode = 'GANTRY5_PLATFORM_DEVELOPMENT'|trans %}*/
/*                         <li data-g-devprod="{{ {0: dev_mode, 1: prod_mode}|json_encode|e('html_attr') }}">*/
/*                             <i class="fa fa-fw fa-wrench"></i> <span class="devprod-mode">{{ gantry.global.production ? prod_mode : dev_mode }}</span>*/
/*                             <div class="float-right">*/
/*                                 <span class="enabler" role="checkbox" aria-checked="{{ gantry.global.production == '0' ? 'false' : 'true'}}" tabindex="0" aria-label="{{ 'GANTRY5_PLATFORM_PRODUCTION_MODE_ARIA_LABEL'|trans }}">*/
/*                                 <input type="hidden" name="production_mode" value="{{ gantry.global.production }}">*/
/*                                     <span class="toggle"><span class="knob"></span></span>*/
/*                                 </span>*/
/*                             </div>*/
/*                         </li>*/
/*                         <li data-g-popover-follow>*/
/*                             <a tabindex="0"*/
/*                                href="{{ gantry.route('cache') }}"*/
/*                                data-ajax-action=""*/
/*                                data-ajax-action-method="get"*/
/*                                data-ajax-action-indicator="li[data-g-extras]"*/
/*                             ><i class="fa fa-fw fa-recycle"></i> {{ 'GANTRY5_PLATFORM_CLEAR_CACHE'|trans }}*/
/*                             </a>*/
/*                         </li>*/
/*                         {% if settings_url %}*/
/*                             <li>*/
/*                                 <a tabindex="0"*/
/*                                    href="{{ settings_url }}"*/
/*                                    data-settings-key="{{ settings_key }}"*/
/*                                 >*/
/*                                     <i class="fa fa-fw fa-{{ gantry.platform.name }}"></i> {{ 'GANTRY5_PLATFORM_PLATFORM_SETTINGS'|trans }}*/
/*                                 </a>*/
/*                             </li>*/
/*                         {% endif %}*/
/*                     </ul>*/
/*                 </li>*/
/*             </ul>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
