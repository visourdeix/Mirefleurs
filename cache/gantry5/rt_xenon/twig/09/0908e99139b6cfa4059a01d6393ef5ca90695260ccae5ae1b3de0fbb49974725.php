<?php

/* @nucleus/page_head.html.twig */
class __TwigTemplate_859dbfd2cddce97d444d93509f6972271ec4bb11596c65369c2f68aef662cec8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head_stylesheets' => array($this, 'block_head_stylesheets'),
            'head_platform' => array($this, 'block_head_platform'),
            'head_overrides' => array($this, 'block_head_overrides'),
            'head_meta' => array($this, 'block_head_meta'),
            'head_title' => array($this, 'block_head_title'),
            'head_application' => array($this, 'block_head_application'),
            'head_ie_stylesheets' => array($this, 'block_head_ie_stylesheets'),
            'head' => array($this, 'block_head'),
            'head_custom' => array($this, 'block_head_custom'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $assetFunction = $this->env->getFunction('parse_assets')->getCallable();
        $assetVariables = array("priority" => 10);
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
        $this->displayBlock('head_stylesheets', $context, $blocks);
        // line 12
        $this->displayBlock('head_platform', $context, $blocks);
        // line 13
        echo "
    ";
        // line 14
        $this->displayBlock('head_overrides', $context, $blocks);
        $content = ob_get_clean();
        echo $assetFunction($content, $location, $priority);
        // line 23
        if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "atoms", array())) {
            // line 24
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "atoms", array()));
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
            foreach ($context['_seq'] as $context["_key"] => $context["atom"]) {
                // line 25
                echo "        ";
                $this->loadTemplate((("@particles/" . $this->getAttribute($context["atom"], "type", array())) . ".html.twig"), "@nucleus/page_head.html.twig", 25)->display(array_merge($context, array("particle" => $this->getAttribute($context["atom"], "attributes", array()))));
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atom'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 28
        echo "
";
        // line 29
        $this->loadTemplate("@particles/assets.html.twig", "@nucleus/page_head.html.twig", 29)->display(array_merge($context, array("particle" => twig_array_merge($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "assets", array()), array("enabled" => 1)))));
        // line 30
        echo "
<head>
    ";
        // line 32
        $this->displayBlock('head_meta', $context, $blocks);
        // line 63
        $this->displayBlock('head_title', $context, $blocks);
        // line 67
        echo "
    ";
        // line 68
        $this->displayBlock('head_application', $context, $blocks);
        // line 72
        echo "
    ";
        // line 73
        $this->displayBlock('head_ie_stylesheets', $context, $blocks);
        // line 81
        $this->displayBlock('head', $context, $blocks);
        // line 82
        echo "    ";
        $this->displayBlock('head_custom', $context, $blocks);
        // line 87
        echo "</head>
";
    }

    // line 2
    public function block_head_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://css/font-awesome.min.css"), "html", null, true);
        echo "\" type=\"text/css\"/>
        <link rel=\"stylesheet\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-engine://css-compiled/nucleus.css"), "html", null, true);
        echo "\" type=\"text/css\"/>
        ";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array(), "any", false, true), "configuration", array(), "any", false, true), "css", array(), "any", false, true), "persistent", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array(), "any", false, true), "configuration", array(), "any", false, true), "css", array(), "any", false, true), "persistent", array()), $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "configuration", array()), "css", array()), "files", array()))) : ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "configuration", array()), "css", array()), "files", array()))));
        foreach ($context['_seq'] as $context["_key"] => $context["css"]) {
            // line 6
            $context["url"] = $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "css", array(0 => $context["css"]), "method"));
            if ((isset($context["url"]) ? $context["url"] : null)) {
                // line 7
                echo "            <link rel=\"stylesheet\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "css", array(0 => $context["css"]), "method")), "html", null, true);
                echo "\" type=\"text/css\"/>
        ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "    ";
    }

    // line 12
    public function block_head_platform($context, array $blocks = array())
    {
    }

    // line 14
    public function block_head_overrides($context, array $blocks = array())
    {
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "configuration", array()), "css", array()), "overrides", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["css"]) {
            // line 16
            $context["url"] = $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "css", array(0 => $context["css"]), "method"));
            if ((isset($context["url"]) ? $context["url"] : null)) {
                // line 17
                echo "            <link rel=\"stylesheet\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "css", array(0 => $context["css"]), "method")), "html", null, true);
                echo "\" type=\"text/css\"/>
        ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "    ";
    }

    // line 32
    public function block_head_meta($context, array $blocks = array())
    {
        // line 33
        echo "        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
        ";
        // line 35
        if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "meta", array())) {
            // line 36
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "meta", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["attributes"]) {
                // line 37
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["attributes"]);
                foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                    // line 38
                    echo "                    <meta name=\"";
                    echo twig_escape_filter($this->env, $context["key"]);
                    echo "\" property=\"";
                    echo twig_escape_filter($this->env, $context["key"]);
                    echo "\" content=\"";
                    echo twig_escape_filter($this->env, $context["value"]);
                    echo "\" />
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attributes'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 43
        echo "<link rel=\"shortcut icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/favicon.ico"), "html", null, true);
        echo "\" type=\"image/x-icon\" />
        <link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/apple-icon-57x57.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/apple-icon-60x60.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/apple-icon-72x72.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/apple-icon-76x76.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/apple-icon-114x114.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/apple-icon-120x120.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/apple-icon-144x144.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/apple-icon-152x152.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"";
        // line 52
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/apple-icon-180x180.png"), "html", null, true);
        echo "\">
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/favicon-16x16.png"), "html", null, true);
        echo "\" sizes=\"16x16\">
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/favicon-32x32.png"), "html", null, true);
        echo "\" sizes=\"32x32\">
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/favicon-96x96.png"), "html", null, true);
        echo "\" sizes=\"96x96\">
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/android-icon-192x192.png"), "html", null, true);
        echo "\" sizes=\"192x192\">
\t\t<link rel=\"manifest\" href=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/manifest.json"), "html", null, true);
        echo "\">
        <meta name=\"msapplication-TileColor\" content=\"#ffffff\" />
        <meta name=\"msapplication-TileImage\" content=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://images/favicons/ms-icon-144x144.png"), "html", null, true);
        echo "\" />
        <meta name=\"theme-color\" content=\"#ffffff\" />
    ";
    }

    // line 63
    public function block_head_title($context, array $blocks = array())
    {
        // line 64
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>Title</title>";
    }

    // line 68
    public function block_head_application($context, array $blocks = array())
    {
        // line 69
        echo twig_join_filter($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "styles", array(0 => "head"), "method"), "
");
        echo "
        ";
        // line 70
        echo twig_join_filter($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "scripts", array(0 => "head"), "method"), "
");
    }

    // line 73
    public function block_head_ie_stylesheets($context, array $blocks = array())
    {
        // line 74
        echo "<!--[if (gte IE 8)&(lte IE 9)]>
        <script type=\"text/javascript\" src=\"";
        // line 75
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://js/html5shiv-printshiv.min.js"), "html", null, true);
        echo "\"></script>
        <link rel=\"stylesheet\" href=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-engine://css/nucleus-ie9.css"), "html", null, true);
        echo "\" type=\"text/css\"/>
        <script type=\"text/javascript\" src=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://js/matchmedia.polyfill.js"), "html", null, true);
        echo "\"></script>
        <![endif]-->
    ";
    }

    // line 81
    public function block_head($context, array $blocks = array())
    {
    }

    // line 82
    public function block_head_custom($context, array $blocks = array())
    {
        // line 83
        echo "        ";
        if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "head_bottom", array())) {
            // line 84
            echo "        ";
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "head_bottom", array());
            echo "
        ";
        }
        // line 86
        echo "    ";
    }

    public function getTemplateName()
    {
        return "@nucleus/page_head.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  348 => 86,  342 => 84,  339 => 83,  336 => 82,  331 => 81,  324 => 77,  320 => 76,  316 => 75,  313 => 74,  310 => 73,  305 => 70,  300 => 69,  297 => 68,  292 => 64,  289 => 63,  282 => 59,  277 => 57,  273 => 56,  269 => 55,  265 => 54,  261 => 53,  257 => 52,  253 => 51,  249 => 50,  245 => 49,  241 => 48,  237 => 47,  233 => 46,  229 => 45,  225 => 44,  220 => 43,  202 => 38,  198 => 37,  194 => 36,  192 => 35,  188 => 33,  185 => 32,  181 => 20,  171 => 17,  168 => 16,  164 => 15,  161 => 14,  156 => 12,  152 => 10,  142 => 7,  139 => 6,  135 => 5,  131 => 4,  126 => 3,  123 => 2,  118 => 87,  115 => 82,  113 => 81,  111 => 73,  108 => 72,  106 => 68,  103 => 67,  101 => 63,  99 => 32,  95 => 30,  93 => 29,  90 => 28,  75 => 26,  72 => 25,  54 => 24,  52 => 23,  48 => 14,  45 => 13,  43 => 12,  40 => 2,  28 => 1,);
    }
}
/* {% assets with { priority: 10 } %}*/
/*     {% block head_stylesheets -%}*/
/*         <link rel="stylesheet" href="{{ url('gantry-assets://css/font-awesome.min.css') }}" type="text/css"/>*/
/*         <link rel="stylesheet" href="{{ url('gantry-engine://css-compiled/nucleus.css') }}" type="text/css"/>*/
/*         {% for css in gantry.theme.configuration.css.persistent|default(gantry.theme.configuration.css.files) %}*/
/*             {%- set url = url(gantry.theme.css(css)) %}{% if url %}*/
/*             <link rel="stylesheet" href="{{ url(gantry.theme.css(css)) }}" type="text/css"/>*/
/*         {% endif %}*/
/*         {%- endfor %}*/
/*     {% endblock -%}*/
/* */
/*     {% block head_platform %}{% endblock %}*/
/* */
/*     {% block head_overrides -%}*/
/*         {% for css in gantry.theme.configuration.css.overrides %}*/
/*             {%- set url = url(gantry.theme.css(css)) %}{% if url %}*/
/*             <link rel="stylesheet" href="{{ url(gantry.theme.css(css)) }}" type="text/css"/>*/
/*         {% endif %}*/
/*         {%- endfor %}*/
/*     {% endblock -%}*/
/* {% endassets -%}*/
/* */
/* {% if gantry.config.page.head.atoms %}*/
/*     {% for atom in gantry.config.page.head.atoms %}*/
/*         {% include '@particles/' ~ atom.type ~ '.html.twig' with { particle: atom.attributes } %}*/
/*     {% endfor %}*/
/* {% endif %}*/
/* */
/* {% include '@particles/assets.html.twig' with { particle: gantry.config.page.assets|merge({'enabled': 1 }) } %}*/
/* */
/* <head>*/
/*     {% block head_meta %}*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1.0">*/
/*         <meta http-equiv="X-UA-Compatible" content="IE=edge" />*/
/*         {% if gantry.config.page.head.meta -%}*/
/*             {% for attributes in gantry.config.page.head.meta -%}*/
/*                 {%- for key, value in attributes %}*/
/*                     <meta name="{{ key|e }}" property="{{ key|e }}" content="{{ value|e }}" />*/
/*                 {% endfor -%}*/
/*             {%- endfor -%}*/
/*         {%- endif -%}*/
/* */
/* 		<link rel="shortcut icon" href="{{ url('gantry-assets://images/favicons/favicon.ico') }}" type="image/x-icon" />*/
/*         <link rel="apple-touch-icon" sizes="57x57" href="{{ url('gantry-assets://images/favicons/apple-icon-57x57.png') }}">*/
/*         <link rel="apple-touch-icon" sizes="60x60" href="{{ url('gantry-assets://images/favicons/apple-icon-60x60.png') }}">*/
/*         <link rel="apple-touch-icon" sizes="72x72" href="{{ url('gantry-assets://images/favicons/apple-icon-72x72.png') }}">*/
/*         <link rel="apple-touch-icon" sizes="76x76" href="{{ url('gantry-assets://images/favicons/apple-icon-76x76.png') }}">*/
/*         <link rel="apple-touch-icon" sizes="114x114" href="{{ url('gantry-assets://images/favicons/apple-icon-114x114.png') }}">*/
/*         <link rel="apple-touch-icon" sizes="120x120" href="{{ url('gantry-assets://images/favicons/apple-icon-120x120.png') }}">*/
/*         <link rel="apple-touch-icon" sizes="144x144" href="{{ url('gantry-assets://images/favicons/apple-icon-144x144.png') }}">*/
/*         <link rel="apple-touch-icon" sizes="152x152" href="{{ url('gantry-assets://images/favicons/apple-icon-152x152.png') }}">*/
/*         <link rel="apple-touch-icon" sizes="180x180" href="{{ url('gantry-assets://images/favicons/apple-icon-180x180.png') }}">*/
/*         <link rel="icon" type="image/png" href="{{ url('gantry-assets://images/favicons/favicon-16x16.png') }}" sizes="16x16">*/
/*         <link rel="icon" type="image/png" href="{{ url('gantry-assets://images/favicons/favicon-32x32.png') }}" sizes="32x32">*/
/*         <link rel="icon" type="image/png" href="{{ url('gantry-assets://images/favicons/favicon-96x96.png') }}" sizes="96x96">*/
/*         <link rel="icon" type="image/png" href="{{ url('gantry-assets://images/favicons/android-icon-192x192.png') }}" sizes="192x192">*/
/* 		<link rel="manifest" href="{{ url('gantry-assets://images/favicons/manifest.json') }}">*/
/*         <meta name="msapplication-TileColor" content="#ffffff" />*/
/*         <meta name="msapplication-TileImage" content="{{ url('gantry-assets://images/favicons/ms-icon-144x144.png') }}" />*/
/*         <meta name="theme-color" content="#ffffff" />*/
/*     {% endblock %}*/
/* */
/*     {%- block head_title -%}*/
/*         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />*/
/*         <title>Title</title>*/
/*     {%- endblock %}*/
/* */
/*     {% block head_application -%}*/
/*         {{ gantry.styles('head')|join("\n")|raw }}*/
/*         {{ gantry.scripts('head')|join("\n")|raw }}*/
/*     {%- endblock %}*/
/* */
/*     {% block head_ie_stylesheets -%}*/
/*         <!--[if (gte IE 8)&(lte IE 9)]>*/
/*         <script type="text/javascript" src="{{ url('gantry-assets://js/html5shiv-printshiv.min.js') }}"></script>*/
/*         <link rel="stylesheet" href="{{ url('gantry-engine://css/nucleus-ie9.css') }}" type="text/css"/>*/
/*         <script type="text/javascript" src="{{ url('gantry-assets://js/matchmedia.polyfill.js') }}"></script>*/
/*         <![endif]-->*/
/*     {% endblock -%}*/
/* */
/*     {% block head %}{% endblock %}*/
/*     {% block head_custom %}*/
/*         {% if gantry.config.page.head.head_bottom %}*/
/*         {{ gantry.config.page.head.head_bottom|raw }}*/
/*         {% endif %}*/
/*     {% endblock %}*/
/* </head>*/
/* */
