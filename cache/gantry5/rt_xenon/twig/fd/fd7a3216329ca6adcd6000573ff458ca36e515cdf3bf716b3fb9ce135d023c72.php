<?php

/* @particles/promocontent.html.twig */
class __TwigTemplate_f17d73f2cbe80629c73d383420149e5eb5741d73a93e5e8f5d46f61aa1a5d240 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/promocontent.html.twig", 1);
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
\t";
        // line 5
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array())) {
            echo "<h2 class=\"g-title\">";
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array());
            echo "</h2>";
        }
        // line 6
        echo "\t\t
\t<div class=\"g-promocontent\">
\t\t";
        // line 8
        ob_start();
        // line 9
        echo "\t\t\t";
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "link", array()) && ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "linkstyle", array()) == "inline"))) {
            // line 10
            echo "\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "link", array()));
            echo "\" class=\"button ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "readmoreclass", array()));
            echo "\">";
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "readmore", array());
            echo "</a>
\t\t\t";
        }
        // line 12
        echo "\t\t";
        $context["readmoreInline"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 13
        echo "\t\t";
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "link", array()) && ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "linkstyle", array()) == "aside"))) {
            // line 14
            echo "\t\t<div class=\"g-inline-action-content\"><div class=\"g-inline-action-text\">
\t\t";
        }
        // line 16
        echo "
\t\t";
        // line 17
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "promostyle", array()) == "standard")) {
            // line 18
            echo "\t\t<h2 class=\"g-title\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "promo", array()));
            echo "</h2>
\t\t";
            // line 19
            echo twig_escape_filter($this->env, (isset($context["readmoreInline"]) ? $context["readmoreInline"] : null), "html", null, true);
            echo "
\t\t";
        }
        // line 21
        echo "\t\t
\t\t";
        // line 22
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "promostyle", array()) == "promo")) {
            // line 23
            echo "\t\t<div class=\"g-promo\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "promo", array()));
            echo "</div>
\t\t";
            // line 24
            echo twig_escape_filter($this->env, (isset($context["readmoreInline"]) ? $context["readmoreInline"] : null), "html", null, true);
            echo "
\t\t";
        }
        // line 26
        echo "\t
\t\t";
        // line 27
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "promostyle", array()) == "superpromo")) {
            // line 28
            echo "\t\t<h2 class=\"g-superpromo\">
\t\t\t";
            // line 29
            if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "link", array())) {
                // line 30
                echo "\t\t\t<a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "link", array()));
                echo "\">
\t\t\t";
            }
            // line 32
            echo "\t\t\t\t";
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "promo", array());
            echo "
\t\t\t";
            // line 33
            if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "link", array())) {
                // line 34
                echo "\t\t\t</a>
\t\t\t";
            }
            // line 36
            echo "\t\t</h2>
\t\t";
            // line 37
            echo twig_escape_filter($this->env, (isset($context["readmoreInline"]) ? $context["readmoreInline"] : null), "html", null, true);
            echo "
\t\t";
        }
        // line 39
        echo "\t
\t\t";
        // line 40
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "promostyle", array()) == "subpromo")) {
            // line 41
            echo "\t\t<div class=\"g-subpromo\">
\t\t\t<span>";
            // line 42
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "promo", array());
            echo "</span>
\t\t\t";
            // line 43
            echo twig_escape_filter($this->env, (isset($context["readmoreInline"]) ? $context["readmoreInline"] : null), "html", null, true);
            echo "
\t\t</div>
\t\t";
        }
        // line 46
        echo "\t
\t\t";
        // line 47
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "tags", array())) {
            // line 48
            echo "\t\t<ul class=\"g-tags\">
\t\t";
            // line 49
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "tags", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 50
                echo "\t\t\t<li>
\t\t\t\t";
                // line 51
                if ($this->getAttribute($context["tag"], "link", array())) {
                    // line 52
                    echo "\t\t\t\t<a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "link", array()));
                    echo "\">
\t\t\t\t";
                }
                // line 54
                echo "\t\t\t\t\t";
                if ($this->getAttribute($context["tag"], "icon", array())) {
                    // line 55
                    echo "\t\t\t\t\t<i class=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "icon", array()));
                    echo "\"></i>
\t\t\t\t\t";
                }
                // line 57
                echo "\t\t\t\t\t";
                echo $this->getAttribute($context["tag"], "text", array());
                echo "
\t\t\t\t";
                // line 58
                if ($this->getAttribute($context["tag"], "link", array())) {
                    // line 59
                    echo "\t\t\t\t</a>
\t\t\t\t";
                }
                // line 61
                echo "\t\t\t</li>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 63
            echo "\t\t</ul>
\t\t";
        }
        // line 65
        echo "\t\t
\t\t";
        // line 66
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "desc", array())) {
            // line 67
            echo "\t\t<div class=\"g-textpromo\">
\t\t\t";
            // line 68
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "desc", array());
            echo "
\t\t</div>
\t\t";
        }
        // line 71
        echo "\t\t
\t\t";
        // line 72
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "link", array()) && ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "linkstyle", array()) == "aside"))) {
            // line 73
            echo "\t\t</div>
\t\t<div class=\"g-inline-action-button\">
\t\t";
        }
        // line 76
        echo "\t\t
\t\t";
        // line 77
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "link", array()) && (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "linkstyle", array()) == "block") || ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "linkstyle", array()) == "aside")))) {
            // line 78
            echo "\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "link", array()));
            echo "\" class=\"button ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "readmoreclass", array()));
            echo "\">";
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "readmore", array());
            echo "</a>
\t\t";
        }
        // line 80
        echo "\t\t
\t\t";
        // line 81
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "link", array()) && ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "linkstyle", array()) == "aside"))) {
            // line 82
            echo "\t\t</div></div>
\t\t";
        }
        // line 84
        echo "\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@particles/promocontent.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  256 => 84,  252 => 82,  250 => 81,  247 => 80,  237 => 78,  235 => 77,  232 => 76,  227 => 73,  225 => 72,  222 => 71,  216 => 68,  213 => 67,  211 => 66,  208 => 65,  204 => 63,  197 => 61,  193 => 59,  191 => 58,  186 => 57,  180 => 55,  177 => 54,  171 => 52,  169 => 51,  166 => 50,  162 => 49,  159 => 48,  157 => 47,  154 => 46,  148 => 43,  144 => 42,  141 => 41,  139 => 40,  136 => 39,  131 => 37,  128 => 36,  124 => 34,  122 => 33,  117 => 32,  111 => 30,  109 => 29,  106 => 28,  104 => 27,  101 => 26,  96 => 24,  91 => 23,  89 => 22,  86 => 21,  81 => 19,  76 => 18,  74 => 17,  71 => 16,  67 => 14,  64 => 13,  61 => 12,  51 => 10,  48 => 9,  46 => 8,  42 => 6,  36 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends '@nucleus/partials/particle.html.twig' %}*/
/* */
/* {% block particle %}*/
/* <div class="{{ particle.class|e }}">*/
/* 	{% if particle.title %}<h2 class="g-title">{{ particle.title|raw }}</h2>{% endif %}*/
/* 		*/
/* 	<div class="g-promocontent">*/
/* 		{% set readmoreInline %}*/
/* 			{% if particle.link and particle.linkstyle == 'inline' %}*/
/* 			<a href="{{ particle.link|e }}" class="button {{ particle.readmoreclass|e }}">{{ particle.readmore|raw }}</a>*/
/* 			{% endif %}*/
/* 		{% endset %}*/
/* 		{% if particle.link and particle.linkstyle == 'aside' %}*/
/* 		<div class="g-inline-action-content"><div class="g-inline-action-text">*/
/* 		{% endif %}*/
/* */
/* 		{% if particle.promostyle == 'standard' %}*/
/* 		<h2 class="g-title">{{ particle.promo|e }}</h2>*/
/* 		{{ readmoreInline }}*/
/* 		{% endif %}*/
/* 		*/
/* 		{% if particle.promostyle == 'promo' %}*/
/* 		<div class="g-promo">{{ particle.promo|e }}</div>*/
/* 		{{ readmoreInline }}*/
/* 		{% endif %}*/
/* 	*/
/* 		{% if particle.promostyle == 'superpromo' %}*/
/* 		<h2 class="g-superpromo">*/
/* 			{% if particle.link %}*/
/* 			<a href="{{ particle.link|e }}">*/
/* 			{% endif %}*/
/* 				{{ particle.promo|raw }}*/
/* 			{% if particle.link %}*/
/* 			</a>*/
/* 			{% endif %}*/
/* 		</h2>*/
/* 		{{ readmoreInline }}*/
/* 		{% endif %}*/
/* 	*/
/* 		{% if particle.promostyle == 'subpromo' %}*/
/* 		<div class="g-subpromo">*/
/* 			<span>{{ particle.promo|raw }}</span>*/
/* 			{{ readmoreInline }}*/
/* 		</div>*/
/* 		{% endif %}*/
/* 	*/
/* 		{% if particle.tags %}*/
/* 		<ul class="g-tags">*/
/* 		{% for tag in particle.tags %}*/
/* 			<li>*/
/* 				{% if tag.link %}*/
/* 				<a href="{{ tag.link|e }}">*/
/* 				{% endif %}*/
/* 					{% if tag.icon %}*/
/* 					<i class="{{ tag.icon|e }}"></i>*/
/* 					{% endif %}*/
/* 					{{ tag.text|raw }}*/
/* 				{% if tag.link %}*/
/* 				</a>*/
/* 				{% endif %}*/
/* 			</li>*/
/* 		{% endfor %}*/
/* 		</ul>*/
/* 		{% endif %}*/
/* 		*/
/* 		{% if particle.desc %}*/
/* 		<div class="g-textpromo">*/
/* 			{{ particle.desc|raw }}*/
/* 		</div>*/
/* 		{% endif %}*/
/* 		*/
/* 		{% if particle.link and particle.linkstyle == 'aside' %}*/
/* 		</div>*/
/* 		<div class="g-inline-action-button">*/
/* 		{% endif %}*/
/* 		*/
/* 		{% if particle.link and (particle.linkstyle == 'block' or particle.linkstyle == 'aside') %}*/
/* 		<a href="{{ particle.link|e }}" class="button {{ particle.readmoreclass|e }}">{{ particle.readmore|raw }}</a>*/
/* 		{% endif %}*/
/* 		*/
/* 		{% if particle.link and particle.linkstyle == 'aside' %}*/
/* 		</div></div>*/
/* 		{% endif %}*/
/* 	</div>*/
/* </div>*/
/* {% endblock %}*/
