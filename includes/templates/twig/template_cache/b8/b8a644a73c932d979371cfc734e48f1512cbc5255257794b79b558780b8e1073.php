<?php

/* @VC/property-recently.html */
class __TwigTemplate_f9cec453e4e3cca61eef57623a2e80f44ab7857327cf902038f560c1502fbf3c extends Twig_Template
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
        echo "
<!--
  ~ Copyright (c) 2018 Tiafeno Finel
  ~
  ~ Permission is hereby granted, free of charge, to any person obtaining a copy
  ~ of this software and associated documentation files, to deal
  ~ in the Software without restriction, including without limitation the rights
  ~ to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  ~ copies of the Software, and to permit persons to whom the Software is
  ~ furnished to do so, subject to the following conditions:
  ~
  ~ The above copyright notice and this permission notice shall be included in all
  ~ copies or substantial portions of the Software.
  ~
  ~ THE SOFTWARE IS PROVIDED \"AS IS\", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  ~ IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  ~ FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  ~ AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  ~ LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  ~ OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
  ~ SOFTWARE.
  -->

<!-- Property recently section start-->
<div class=\"property-area fadeInUp wow ptb-40\" data-wow-delay=\"0.2s\" >
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-12\">
        <div class=\"feature-property-title ptb-20\">
          <h3 style=\"text-transform: uppercase\">";
        // line 30
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</h3>
        </div>
      </div>
    </div>
    <div class=\"row\">
      <div class=\"tab-content\">
        <div role=\"tabpanel\" class=\"tab-pane active\">
          <div class=\"property-list\">
          ";
        // line 38
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["posts"]) ? $context["posts"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 39
            echo "            <div class=\"col-md-4\">
              <div class=\"single-property\">
                <div class=\"property-img\">
                  <a href=\"";
            // line 42
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "post_url", array()), "html", null, true);
            echo "\">
                    <img src=\"";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["post"], "post_thumbnail", array()), 0, array(), "array"), "html", null, true);
            echo "\" alt=\"\">
                  </a>
                </div>
                <div class=\"property-desc\">
                  <div class=\"property-desc-top\">
                    <h6>
                      <a href=\"";
            // line 49
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "post_url", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "post_title", array()), "html", null, true);
            echo "\">
                        ";
            // line 50
            echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute($context["post"], "post_title", array()), 0, 30), "html", null, true);
            echo "
                      </a>
                    </h6>
                    <h4 class=\"price euroMoney\">";
            // line 53
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "price", array()), "html", null, true);
            echo "</h4>
                    <p class=\"mg-price mgaMoney\"></p>
                    <div class=\"property-location\">
                      <p><img src=\"";
            // line 56
            echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
            echo "/img/icons/icon-5.png\" alt=\"\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "location", array()), "html", null, true);
            echo "</p>
                    </div>
                  </div>
                  <div class=\"property-desc-bottom\">
                    <div class=\"property-bottom-list\">
                      <ul>
                        <li>
                          <img src=\"";
            // line 63
            echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
            echo "/img/icons/icon-1.png\" alt=\"\">
                          <span>";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "surface", array()), "html", null, true);
            echo " m<sup>2</sup></span>
                        </li>
                        ";
            // line 66
            if (($this->getAttribute($context["post"], "property", array()) != "ground")) {
                // line 67
                echo "                          <li>
                            <img src=\"";
                // line 68
                echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
                echo "/img/icons/icon-2.png\" alt=\"\">
                            <span>";
                // line 69
                echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "bedroom", array()), "html", null, true);
                echo "</span>
                          </li>
                          <li>
                            <img src=\"";
                // line 72
                echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
                echo "/img/icons/icon-3.png\" alt=\"\">
                            <span>";
                // line 73
                echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "bathroom", array()), "html", null, true);
                echo "</span>
                          </li>
                          <li>
                            <img src=\"";
                // line 76
                echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
                echo "/img/icons/icon-4.png\" alt=\"\">
                            <span>";
                // line 77
                echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "garage", array()), "html", null, true);
                echo "</span>
                          </li>
                        ";
            }
            // line 80
            echo "                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        echo "
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Property recently section end-->";
    }

    public function getTemplateName()
    {
        return "@VC/property-recently.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 87,  157 => 80,  151 => 77,  147 => 76,  141 => 73,  137 => 72,  131 => 69,  127 => 68,  124 => 67,  122 => 66,  117 => 64,  113 => 63,  101 => 56,  95 => 53,  89 => 50,  83 => 49,  74 => 43,  70 => 42,  65 => 39,  61 => 38,  50 => 30,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@VC/property-recently.html", "C:\\xampp\\htdocs\\managna\\wp-content\\themes\\managnasarl\\includes\\templates\\twig\\vc\\property-recently.html");
    }
}
