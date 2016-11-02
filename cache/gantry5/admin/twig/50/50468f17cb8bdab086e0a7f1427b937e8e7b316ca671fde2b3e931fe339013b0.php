<?php

/* forms/fields/collection/list.html.twig */
class __TwigTemplate_c358c7f601e60ec592d219f84f14c1df3bb2800c24fb99cfbbbe7b5c4245a7cd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'field' => array($this, 'block_field'),
            'contents' => array($this, 'block_contents'),
            'label' => array($this, 'block_label'),
            'input' => array($this, 'block_input'),
            'collection_fields' => array($this, 'block_collection_fields'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((("forms/" . ((array_key_exists("layout", $context)) ? (_twig_default_filter((isset($context["layout"]) ? $context["layout"] : null), "field")) : ("field"))) . ".html.twig"), "forms/fields/collection/list.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 4
        $context["value"] = (((( !$this->getAttribute((isset($context["field"]) ? $context["field"] : null), "key", array()) && twig_test_iterable((isset($context["value"]) ? $context["value"] : null))) && twig_length_filter($this->env, (isset($context["value"]) ? $context["value"] : null)))) ? ($this->env->getExtension('GantryTwig')->valuesFilter((isset($context["value"]) ? $context["value"] : null))) : ((isset($context["value"]) ? $context["value"] : null)));
        // line 1
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    public function block_field($context, array $blocks = array())
    {
        // line 7
        echo "    ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "is_current", array())) {
            // line 8
            echo "        <div class=\"g-filter-actions\">
            <div class=\"g-panel-filters\" data-g-global-filter=\"\">
                <div class=\"search settings-block\">
                    ";
            // line 11
            $context["filter"] = array("element" => ".settings-param", "title" => ".settings-param-title, h4 .g-title", "fallback" => true);
            // line 12
            echo "                    <input type=\"text\" data-g-collapse-filter=\"";
            echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["filter"]) ? $context["filter"] : null)), "html_attr");
            echo "\" placeholder=\"";
            echo twig_escape_filter($this->env, (($this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_FILTER") . " ") . twig_capitalize_string_filter($this->env, (isset($context["group"]) ? $context["group"] : null))), "html", null, true);
            echo "...\" aria-label=\"";
            echo twig_escape_filter($this->env, (($this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_FILTER") . " ") . twig_capitalize_string_filter($this->env, (isset($context["group"]) ? $context["group"] : null))), "html", null, true);
            echo "...\" role=\"search\">
                    <i class=\"fa fa-fw fa-search\"></i>
                </div>
                <button class=\"button\" type=\"button\" data-g-collapse-all=\"true\"><i class=\"fa fa-fw fa-toggle-up\"></i> ";
            // line 15
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_COLLAPSE_ALL"), "html", null, true);
            echo "</button>
                <button class=\"button\" type=\"button\" data-g-collapse-all=\"false\"><i class=\"fa fa-fw fa-toggle-down\"></i> ";
            // line 16
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_EXPAND_ALL"), "html", null, true);
            echo "</button>
            </div>
        </div>
        <div class=\"cards-wrapper g-grid\">
            ";
            // line 20
            $context["labels"] = array("collapse" => $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_COLLAPSE"), "expand" => $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_EXPAND"));
            // line 21
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : null));
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
            foreach ($context['_seq'] as $context["key"] => $context["val"]) {
                // line 22
                echo "                ";
                $context["title"] = ((($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "value", array()) == $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "key", array()))) ? ($context["key"]) : ($this->getAttribute($context["val"], $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "value", array()), array(), "array")));
                // line 23
                echo "                ";
                $context["prefix"] = (((((isset($context["route"]) ? $context["route"] : null) . ".") . $context["key"]) . ".") . $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "value", array()));
                // line 24
                echo "                <div class=\"card settings-block\">
                    <h4
                        data-g-collapse=\"";
                // line 26
                echo twig_escape_filter($this->env, twig_jsonencode_filter(twig_array_merge((isset($context["labels"]) ? $context["labels"] : null), array("collapsed" => false, "id" => (isset($context["prefix"]) ? $context["prefix"] : null), "store" => false, "target" => "~ .inner-params"))), "html_attr");
                echo "\"
                    >
                        <span class=\"g-collapse\" data-title=\"";
                // line 28
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["labels"]) ? $context["labels"] : null), "collapse", array()), "html", null, true);
                echo "\" data-tip=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["labels"]) ? $context["labels"] : null), "collapse", array()), "html", null, true);
                echo "\" data-tip-place=\"top-right\"><i class=\"fa fa-fw fa-caret-up\"></i></span>
                        <span data-title-editable=\"";
                // line 29
                echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
                echo "\" data-collection-key=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->fieldNameFilter((((((isset($context["scope"]) ? $context["scope"] : null) . ".") . $context["key"]) . ".") . $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "value", array()))), "html", null, true);
                echo "\" class=\"g-title\">";
                echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
                echo "</span>
                        <i class=\"fa fa-pencil font-small\"  tabindex=\"0\" aria-label=\"";
                // line 30
                echo twig_escape_filter($this->env, twig_replace_filter($this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_EDIT_TITLE"), array("%s" => (isset($context["title"]) ? $context["title"] : null))), "html", null, true);
                echo "\" data-title-edit=\"\"></i>
                    </h4>
                    <div class=\"inner-params\">
                        ";
                // line 33
                $this->displayBlock("collection_fields", $context, $blocks);
                echo "
                    </div>
                </div>
            ";
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
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "        </div>
    ";
        } else {
            // line 39
            echo "        ";
            $context["can_reorder"] = ((($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "reorder", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "reorder", array())))) ? ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "reorder", array())) : (true));
            // line 40
            echo "        ";
            $context["can_remove"] = ((($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "deletion", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "deletion", array())))) ? ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "deletion", array())) : (true));
            // line 41
            echo "        ";
            $context["can_addnew"] = ((($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "add_new", array(), "any", true, true) &&  !(null === $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "add_new", array())))) ? ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "add_new", array())) : (true));
            // line 42
            echo "        <div class=\"settings-param ";
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "type", array()), ".", "-"), "html", null, true);
            echo "\">
            ";
            // line 43
            if ((((isset($context["overrideable"]) ? $context["overrideable"] : null) && (( !$this->getAttribute((isset($context["field"]) ? $context["field"] : null), "overridable", array(), "any", true, true) || ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "overridable", array()) == true)) || (isset($context["has_value"]) ? $context["has_value"] : null))) && ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "type", array()) != "container.set"))) {
                // line 44
                echo "                ";
                $this->loadTemplate("forms/override.html.twig", "forms/fields/collection/list.html.twig", 44)->display(array_merge($context, array("scope" => (isset($context["scope"]) ? $context["scope"] : null), "name" => (isset($context["name"]) ? $context["name"] : null), "field" => (isset($context["field"]) ? $context["field"] : null))));
                // line 45
                echo "            ";
            }
            // line 46
            echo "            ";
            $this->displayBlock('contents', $context, $blocks);
            // line 120
            echo "        </div>
    ";
        }
    }

    // line 46
    public function block_contents($context, array $blocks = array())
    {
        // line 47
        echo "                ";
        $context["field_route"] = twig_replace_filter((((((isset($context["route"]) ? $context["route"] : null) . ".") . (isset($context["prefix"]) ? $context["prefix"] : null)) . ".") . $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "name", array())), ".", "/");
        // line 48
        echo "                <span class=\"settings-param-title float-left\">
                    ";
        // line 49
        $this->displayBlock('label', $context, $blocks);
        // line 57
        echo "                </span>
                <div class=\"settings-param-field\" data-field-name=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "name", array()), "html", null, true);
        echo "\">
                    ";
        // line 59
        $this->displayBlock('input', $context, $blocks);
        // line 118
        echo "                </div>
            ";
    }

    // line 49
    public function block_label($context, array $blocks = array())
    {
        // line 50
        echo "                        ";
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "description", array())) {
            // line 51
            echo "                            <span aria-label=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "description", array()), "html", null, true);
            echo "\" data-tip=\"";
            echo $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "description", array());
            echo "\" data-tip-place=\"top-right\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "label", array()), "html", null, true);
            echo "</span>
                        ";
        } else {
            // line 53
            echo "                            ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "label", array()), "html", null, true);
            echo "
                        ";
        }
        // line 55
        echo "                        ";
        echo ((twig_in_filter($this->getAttribute($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "validate", array()), "required", array()), array(0 => "on", 1 => "true", 2 => 1))) ? ("<span class=\"required\">*</span>") : (""));
        echo "
                    ";
    }

    // line 59
    public function block_input($context, array $blocks = array())
    {
        // line 60
        echo "<div class=\"g5-collection-wrapper\">
                        <ul>";
        // line 62
        if ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "fields", array())) {
            // line 63
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : null));
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
            foreach ($context['_seq'] as $context["key"] => $context["val"]) {
                // line 64
                echo "                                    ";
                if (($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "ajax", array()) == true)) {
                    // line 65
                    echo "                                        <li data-collection-item=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "value", array()), "html", null, true);
                    echo "\">
                                            ";
                    // line 66
                    $context["itemValue"] = ((($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "value", array()) == $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "key", array()))) ? ($context["key"]) : ($this->getAttribute($context["val"], $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "value", array()), array(), "array")));
                    // line 67
                    echo "                                            ";
                    if ((isset($context["can_reorder"]) ? $context["can_reorder"] : null)) {
                        echo "<i class=\"fa fa-reorder font-small item-reorder\"></i>";
                    }
                    // line 68
                    echo "                                            <a class=\"config-cog\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => (((isset($context["field_route"]) ? $context["field_route"] : null) . "/") . $context["key"])), "method"), "html", null, true);
                    echo "\"><span data-title-editable=\"";
                    echo twig_escape_filter($this->env, (isset($context["itemValue"]) ? $context["itemValue"] : null), "html", null, true);
                    echo "\" class=\"g-title\">";
                    echo twig_escape_filter($this->env, (isset($context["itemValue"]) ? $context["itemValue"] : null), "html", null, true);
                    echo "</span></a>
                                            ";
                    // line 69
                    if ((isset($context["can_remove"]) ? $context["can_remove"] : null)) {
                        echo "<i class=\"fa fa-fw fa-trash font-small\" data-collection-remove=\"\"></i>";
                    }
                    // line 70
                    echo "                                            ";
                    if ((isset($context["can_addnew"]) ? $context["can_addnew"] : null)) {
                        echo "<i class=\"fa fa-files-o font-small\" data-collection-duplicate=\"\"></i>";
                    }
                    // line 71
                    echo "                                            <i class=\"fa fa-fw fa-pencil font-small\" tabindex=\"0\" aria-label=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->transFilter("GANTRY5_PLATFORM_EDIT_TITLE", (isset($context["itemValue"]) ? $context["itemValue"] : null)), "html", null, true);
                    echo "\" data-title-edit=\"\"></i>
                                        </li>
                                    ";
                } else {
                    // line 74
                    echo "                                        ";
                    $this->displayBlock('collection_fields', $context, $blocks);
                    // line 98
                    echo "                                    ";
                }
                // line 99
                echo "                                ";
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
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 101
        echo "</ul>
                    </div>
                    <div>
                        <ul style=\"display: none\">
                            <li data-collection-nosort=\"\" data-collection-template=\"";
        // line 105
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : null), "value", array()), "html", null, true);
        echo "\" style=\"display: none;\">
                                ";
        // line 106
        if ((isset($context["can_reorder"]) ? $context["can_reorder"] : null)) {
            echo "<i class=\"fa fa-reorder font-small item-reorder\"></i>";
        }
        // line 107
        echo "                                <a class=\"config-cog\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => ((isset($context["field_route"]) ? $context["field_route"] : null) . "/%id%")), "method"), "html", null, true);
        echo "\"><span data-title-editable=\"New item\" class=\"title\">New item</span></a>
                                ";
        // line 108
        if ((isset($context["can_remove"]) ? $context["can_remove"] : null)) {
            echo "<i class=\"fa fa-fw fa-trash font-small\" data-collection-remove=\"\"></i>";
        }
        // line 109
        echo "                                ";
        if ((isset($context["can_addnew"]) ? $context["can_addnew"] : null)) {
            echo "<i class=\"fa fa-files-o font-small\" data-collection-duplicate=\"\"></i>";
        }
        // line 110
        echo "                                <i class=\"fa fa-fw fa-pencil font-small\" data-title-edit=\"\"></i>
                            </li>
                        </ul>
                        ";
        // line 113
        if ((isset($context["can_addnew"]) ? $context["can_addnew"] : null)) {
            echo "<span class=\"collection-addnew button button-simple\" data-collection-addnew=\"\" title=\"Add new item\"><i class=\"fa fa-plus font-small\"></i></span>";
        }
        // line 114
        echo "                        <a href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "route", array(0 => (isset($context["field_route"]) ? $context["field_route"] : null)), "method"), "html", null, true);
        echo "\" class=\"collection-editall button button-simple\" data-collection-editall=\"\" title=\"Edit all items\" ";
        if ((twig_length_filter($this->env, (isset($context["value"]) ? $context["value"] : null)) <= 1)) {
            echo "style=\"display: none;\"";
        }
        echo "><i class=\"fa fa-th-large font-small\"></i></a>
                    </div>
                    <input data-collection-data=\"\" name=\"";
        // line 116
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->fieldNameFilter((((isset($context["scope"]) ? $context["scope"] : null) . (isset($context["name"]) ? $context["name"] : null)) . "._json")), "html", null, true);
        echo "\" type=\"hidden\" value=\"";
        echo twig_escape_filter($this->env, twig_jsonencode_filter(((array_key_exists("value", $context)) ? (_twig_default_filter((isset($context["value"]) ? $context["value"] : null), array())) : (array())), twig_constant("JSON_UNESCAPED_SLASHES")), "html_attr");
        echo "\"/>
                    ";
    }

    // line 74
    public function block_collection_fields($context, array $blocks = array())
    {
        // line 75
        echo "                                            <div data-g5-collections=\"\">
                                                ";
        // line 76
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "fields", array()));
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
        foreach ($context['_seq'] as $context["childName"] => $context["child"]) {
            // line 77
            echo "                                                    ";
            if ((is_string($__internal_cf844d64acb8ac0d52e48810afb09f9b9e53e12e1182b22758e52491f2a829df = $context["childName"]) && is_string($__internal_6d0ceae87b4a5d3bfb27eae350aa400faf8cf82d171d46a6de9ceb94898801f8 = ".") && ('' === $__internal_6d0ceae87b4a5d3bfb27eae350aa400faf8cf82d171d46a6de9ceb94898801f8 || 0 === strpos($__internal_cf844d64acb8ac0d52e48810afb09f9b9e53e12e1182b22758e52491f2a829df, $__internal_6d0ceae87b4a5d3bfb27eae350aa400faf8cf82d171d46a6de9ceb94898801f8)))) {
                // line 78
                echo "                                                        ";
                $context["childKey"] = trim($context["childName"], ".");
                // line 79
                echo "                                                        ";
                $context["childValue"] = $this->getAttribute((isset($context["val"]) ? $context["val"] : null), twig_slice($this->env, $context["childName"], 1, null), array(), "array");
                // line 80
                echo "                                                        ";
                $context["childName"] = ((((isset($context["name"]) ? $context["name"] : null) . ".") . (isset($context["key"]) ? $context["key"] : null)) . $context["childName"]);
                // line 81
                echo "                                                    ";
            } else {
                // line 82
                echo "                                                        ";
                $context["childKey"] = $context["childName"];
                // line 83
                echo "                                                        ";
                $context["childValue"] = $this->env->getExtension('GantryTwig')->nestedFunc((isset($context["data"]) ? $context["data"] : null), ((isset($context["scope"]) ? $context["scope"] : null) . $context["childName"]));
                // line 84
                echo "                                                        ";
                $context["childName"] = twig_replace_filter($context["childName"], array("*" => (isset($context["key"]) ? $context["key"] : null)));
                // line 85
                echo "                                                    ";
            }
            // line 86
            echo "                                                    ";
            if (((!twig_in_filter($context["childName"], (isset($context["skip"]) ? $context["skip"] : null)) &&  !$this->getAttribute($context["child"], "skip", array())) && ($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "value", array()) != (isset($context["childKey"]) ? $context["childKey"] : null)))) {
                // line 87
                echo "                                                         ";
                if (($this->getAttribute($context["child"], "type", array()) == "key")) {
                    // line 88
                    echo "                                                             ";
                    $this->loadTemplate("forms/fields/key/key.html.twig", "forms/fields/collection/list.html.twig", 88)->display(array_merge($context, array("name" =>                     // line 89
$context["childName"], "field" => $context["child"], "value" => (isset($context["key"]) ? $context["key"] : null))));
                    // line 90
                    echo "                                                         ";
                } elseif ($this->getAttribute($context["child"], "type", array())) {
                    // line 91
                    echo "                                                             ";
                    $this->loadTemplate(array(0 => (("forms/fields/" . twig_replace_filter($this->getAttribute($context["child"], "type", array()), ".", "/")) . ".html.twig"), 1 => "forms/fields/unknown/unknown.html.twig"), "forms/fields/collection/list.html.twig", 91)->display(array_merge($context, array("name" =>                     // line 92
$context["childName"], "field" => $context["child"], "current_value" => (isset($context["childValue"]) ? $context["childValue"] : null), "value" => null, "default_value" => null, "prefix" => ((((isset($context["prefix"]) ? $context["prefix"] : null)) ? (((isset($context["prefix"]) ? $context["prefix"] : null) . ".")) : ("")) . $context["childName"]))));
                    // line 93
                    echo "                                                        ";
                }
                // line 94
                echo "                                                    ";
            }
            // line 95
            echo "                                                ";
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
        unset($context['_seq'], $context['_iterated'], $context['childName'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "                                            </div>
                                        ";
    }

    public function getTemplateName()
    {
        return "forms/fields/collection/list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  459 => 96,  445 => 95,  442 => 94,  439 => 93,  437 => 92,  435 => 91,  432 => 90,  430 => 89,  428 => 88,  425 => 87,  422 => 86,  419 => 85,  416 => 84,  413 => 83,  410 => 82,  407 => 81,  404 => 80,  401 => 79,  398 => 78,  395 => 77,  378 => 76,  375 => 75,  372 => 74,  364 => 116,  354 => 114,  350 => 113,  345 => 110,  340 => 109,  336 => 108,  331 => 107,  327 => 106,  323 => 105,  317 => 101,  302 => 99,  299 => 98,  296 => 74,  289 => 71,  284 => 70,  280 => 69,  271 => 68,  266 => 67,  264 => 66,  259 => 65,  256 => 64,  239 => 63,  237 => 62,  234 => 60,  231 => 59,  224 => 55,  218 => 53,  208 => 51,  205 => 50,  202 => 49,  197 => 118,  195 => 59,  191 => 58,  188 => 57,  186 => 49,  183 => 48,  180 => 47,  177 => 46,  171 => 120,  168 => 46,  165 => 45,  162 => 44,  160 => 43,  155 => 42,  152 => 41,  149 => 40,  146 => 39,  142 => 37,  124 => 33,  118 => 30,  110 => 29,  104 => 28,  99 => 26,  95 => 24,  92 => 23,  89 => 22,  71 => 21,  69 => 20,  62 => 16,  58 => 15,  47 => 12,  45 => 11,  40 => 8,  37 => 7,  34 => 6,  30 => 1,  28 => 4,  22 => 1,);
    }
}
/* {% extends 'forms/' ~ layout|default('field') ~ '.html.twig' %}*/
/* */
/* {# If values contains a plain list of items, we need to reindex them. #}*/
/* {% set value = not field.key and value is iterable and value|length ? value|values : value %}*/
/* */
/* {% block field %}*/
/*     {% if field.is_current %}*/
/*         <div class="g-filter-actions">*/
/*             <div class="g-panel-filters" data-g-global-filter="">*/
/*                 <div class="search settings-block">*/
/*                     {% set filter = {'element': '.settings-param', 'title': '.settings-param-title, h4 .g-title', 'fallback': true} %}*/
/*                     <input type="text" data-g-collapse-filter="{{ filter|json_encode|e('html_attr') }}" placeholder="{{ 'GANTRY5_PLATFORM_FILTER'|trans ~ ' ' ~ group|capitalize }}..." aria-label="{{ 'GANTRY5_PLATFORM_FILTER'|trans ~ ' ' ~ group|capitalize }}..." role="search">*/
/*                     <i class="fa fa-fw fa-search"></i>*/
/*                 </div>*/
/*                 <button class="button" type="button" data-g-collapse-all="true"><i class="fa fa-fw fa-toggle-up"></i> {{ 'GANTRY5_PLATFORM_COLLAPSE_ALL'|trans }}</button>*/
/*                 <button class="button" type="button" data-g-collapse-all="false"><i class="fa fa-fw fa-toggle-down"></i> {{ 'GANTRY5_PLATFORM_EXPAND_ALL'|trans }}</button>*/
/*             </div>*/
/*         </div>*/
/*         <div class="cards-wrapper g-grid">*/
/*             {% set labels = {collapse: 'GANTRY5_PLATFORM_COLLAPSE'|trans, expand: 'GANTRY5_PLATFORM_EXPAND'|trans} %}*/
/*             {% for key, val in value %}*/
/*                 {% set title = (field.value == field.key ? key : val[field.value]) %}*/
/*                 {% set prefix = route ~ '.' ~ key ~ '.' ~ field.value %}*/
/*                 <div class="card settings-block">*/
/*                     <h4*/
/*                         data-g-collapse="{{ labels|merge({collapsed: false, id: prefix, store: false,  target: '~ .inner-params' })|json_encode|e('html_attr') }}"*/
/*                     >*/
/*                         <span class="g-collapse" data-title="{{ labels.collapse }}" data-tip="{{ labels.collapse }}" data-tip-place="top-right"><i class="fa fa-fw fa-caret-up"></i></span>*/
/*                         <span data-title-editable="{{ title }}" data-collection-key="{{ (scope ~ '.' ~ key ~ '.' ~ field.value)|fieldName }}" class="g-title">{{ title }}</span>*/
/*                         <i class="fa fa-pencil font-small"  tabindex="0" aria-label="{{ 'GANTRY5_PLATFORM_EDIT_TITLE'|trans|replace({'%s': title}) }}" data-title-edit=""></i>*/
/*                     </h4>*/
/*                     <div class="inner-params">*/
/*                         {{ block('collection_fields') }}*/
/*                     </div>*/
/*                 </div>*/
/*             {% endfor %}*/
/*         </div>*/
/*     {% else %}*/
/*         {% set can_reorder = field.reorder ?? true %}*/
/*         {% set can_remove = field.deletion ?? true %}*/
/*         {% set can_addnew = field.add_new ?? true %}*/
/*         <div class="settings-param {{ field.type|replace('.', '-') }}">*/
/*             {% if overrideable and (field.overridable is not defined or field.overridable == true or has_value) and field.type != 'container.set' %}*/
/*                 {% include 'forms/override.html.twig' with {'scope': scope, 'name': name, 'field': field} %}*/
/*             {% endif %}*/
/*             {% block contents %}*/
/*                 {% set field_route = (route ~ '.' ~ prefix ~ '.' ~ field.name)|replace('.', '/') %}*/
/*                 <span class="settings-param-title float-left">*/
/*                     {% block label %}*/
/*                         {% if field.description %}*/
/*                             <span aria-label="{{ field.description }}" data-tip="{{ field.description|raw }}" data-tip-place="top-right">{{ field.label }}</span>*/
/*                         {% else %}*/
/*                             {{ field.label }}*/
/*                         {% endif %}*/
/*                         {{ field.validate.required in ['on', 'true', 1] ? '<span class="required">*</span>' }}*/
/*                     {% endblock %}*/
/*                 </span>*/
/*                 <div class="settings-param-field" data-field-name="{{ field.name }}">*/
/*                     {% block input -%}*/
/*                         <div class="g5-collection-wrapper">*/
/*                         <ul>*/
/*                         {%- if field.fields -%}*/
/*                                 {% for key, val in value %}*/
/*                                     {% if (field.ajax == true) %}*/
/*                                         <li data-collection-item="{{ field.value }}">*/
/*                                             {% set itemValue = field.value == field.key ? key : val[field.value] %}*/
/*                                             {% if can_reorder %}<i class="fa fa-reorder font-small item-reorder"></i>{% endif %}*/
/*                                             <a class="config-cog" href="{{ gantry.route(field_route ~ '/' ~ key) }}"><span data-title-editable="{{ itemValue }}" class="g-title">{{ itemValue }}</span></a>*/
/*                                             {% if can_remove %}<i class="fa fa-fw fa-trash font-small" data-collection-remove=""></i>{% endif %}*/
/*                                             {% if can_addnew %}<i class="fa fa-files-o font-small" data-collection-duplicate=""></i>{% endif %}*/
/*                                             <i class="fa fa-fw fa-pencil font-small" tabindex="0" aria-label="{{ 'GANTRY5_PLATFORM_EDIT_TITLE'|trans(itemValue) }}" data-title-edit=""></i>*/
/*                                         </li>*/
/*                                     {% else %}*/
/*                                         {% block collection_fields %}*/
/*                                             <div data-g5-collections="">*/
/*                                                 {% for childName, child in field.fields %}*/
/*                                                     {% if childName starts with '.' %}*/
/*                                                         {% set childKey = childName|trim('.') %}*/
/*                                                         {% set childValue = val[childName[1:]] %}*/
/*                                                         {% set childName = name ~ '.' ~ key ~ childName %}*/
/*                                                     {% else %}*/
/*                                                         {% set childKey = childName %}*/
/*                                                         {% set childValue = nested(data, scope ~ childName) %}*/
/*                                                         {% set childName = childName|replace({'*': key}) %}*/
/*                                                     {% endif %}*/
/*                                                     {% if childName not in skip and not child.skip and field.value != childKey %}*/
/*                                                          {% if child.type == 'key' %}*/
/*                                                              {% include 'forms/fields/key/key.html.twig'*/
/*                                                              with {name: childName, field: child, value: key} %}*/
/*                                                          {% elseif child.type %}*/
/*                                                              {% include ["forms/fields/" ~ child.type|replace('.', '/') ~ ".html.twig", 'forms/fields/unknown/unknown.html.twig']*/
/*                                                              with {name: childName, field: child, current_value: childValue, value: null, default_value: null, prefix: (prefix ? prefix ~ '.' : '') ~ childName} %}*/
/*                                                         {% endif %}*/
/*                                                     {% endif %}*/
/*                                                 {% endfor %}*/
/*                                             </div>*/
/*                                         {% endblock %}*/
/*                                     {% endif %}*/
/*                                 {% endfor %}*/
/*                         {%- endif -%}*/
/*                     </ul>*/
/*                     </div>*/
/*                     <div>*/
/*                         <ul style="display: none">*/
/*                             <li data-collection-nosort="" data-collection-template="{{ field.value }}" style="display: none;">*/
/*                                 {% if can_reorder %}<i class="fa fa-reorder font-small item-reorder"></i>{% endif %}*/
/*                                 <a class="config-cog" href="{{ gantry.route(field_route ~ '/%id%') }}"><span data-title-editable="New item" class="title">New item</span></a>*/
/*                                 {% if can_remove %}<i class="fa fa-fw fa-trash font-small" data-collection-remove=""></i>{% endif %}*/
/*                                 {% if can_addnew %}<i class="fa fa-files-o font-small" data-collection-duplicate=""></i>{% endif %}*/
/*                                 <i class="fa fa-fw fa-pencil font-small" data-title-edit=""></i>*/
/*                             </li>*/
/*                         </ul>*/
/*                         {% if can_addnew %}<span class="collection-addnew button button-simple" data-collection-addnew="" title="Add new item"><i class="fa fa-plus font-small"></i></span>{% endif %}*/
/*                         <a href="{{ gantry.route(field_route) }}" class="collection-editall button button-simple" data-collection-editall="" title="Edit all items" {% if value|length <= 1 %}style="display: none;"{% endif %}><i class="fa fa-th-large font-small"></i></a>*/
/*                     </div>*/
/*                     <input data-collection-data="" name="{{ (scope ~ name ~ '._json')|fieldName }}" type="hidden" value="{{ value|default({})|json_encode(constant('JSON_UNESCAPED_SLASHES'))|e('html_attr') }}"/>*/
/*                     {% endblock %}*/
/*                 </div>*/
/*             {% endblock %}*/
/*         </div>*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
