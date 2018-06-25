<?php

/* @VC/our-offers.html */
class __TwigTemplate_f09dfc369a95ccececa8619ec9dcd7423af4cb11025604fd2f9baa33994219de extends Twig_Template
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
<!-- Our offers section start-->
<div class=\"property-area fadeInUp wow ptb-50\" data-wow-delay=\"0.2s\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-12\">
        <div class=\"feature-property-title\">
          <h3>";
        // line 29
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</h3>
        </div>
      </div>
    </div>
    <div class=\"row\">
      <div class=\"col-md-12\">
        <div class=\"property-tab-menu\">
          <ul class=\"nav\" role=\"tablist\">
            <li role=\"presentation\" class=\"active\">
              <a href=\"#sale\" aria-controls=\"sale\" data-toggle=\"tab\">
                PROPRIÉTÉ À VENDRE
              </a>
            </li>
            <li role=\"presentation\">
              <a href=\"#rent\" aria-controls=\"rent\" data-toggle=\"tab\">
                PROPRIÉTÉ À LOUER
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class=\"row\">
      <div class=\"tab-content\">
        <div role=\"tabpanel\" class=\"tab-pane active\" id=\"sale\">
          ";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["posts"]) ? $context["posts"] : null), "sales", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["sale"]) {
            // line 55
            echo "          <div class=\"col-md-4\">
            <div class=\"single-property\">
              <div class=\"property-img\">
                <a href=\"";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute($context["sale"], "post_url", array()), "html", null, true);
            echo "\">
                  <img src=\"";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["sale"], "post_thumbnail", array()), 0, array(), "array"), "html", null, true);
            echo "\" alt=\"\">
                </a>
              </div>
              <div class=\"property-desc\">
                <div class=\"property-desc-top\">
                  <h6>
                    <a href=\"";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute($context["sale"], "post_url", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["sale"], "post_title", array()), "html", null, true);
            echo "\">
                      ";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute($context["sale"], "post_title", array()), "html", null, true);
            echo "
                    </a>
                  </h6>
                  <h4 class=\"price euroMoney\">";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute($context["sale"], "price", array()), "html", null, true);
            echo "</h4>
                  <p class=\"mg-price mgaMoney\"></p>
                  <div class=\"property-location\">
                    <p><img src=\"";
            // line 72
            echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
            echo "/img/icons/icon-5.png\" alt=\"\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["sale"], "location", array()), "html", null, true);
            echo "</p>
                  </div>
                </div>
                <div class=\"property-desc-bottom\">
                  <div class=\"property-bottom-list\">
                    <ul>
                      <li>
                        <img src=\"";
            // line 79
            echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
            echo "/img/icons/icon-1.png\" alt=\"\">
                        <span>";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute($context["sale"], "surface", array()), "html", null, true);
            echo " m<sup>2</sup></span>
                      </li>
                      ";
            // line 82
            if (($this->getAttribute($context["sale"], "property", array()) != "ground")) {
                // line 83
                echo "                        <li>
                          <img src=\"";
                // line 84
                echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
                echo "/img/icons/icon-2.png\" alt=\"\">
                          <span>";
                // line 85
                echo twig_escape_filter($this->env, $this->getAttribute($context["sale"], "bedroom", array()), "html", null, true);
                echo "</span>
                        </li>
                        <li>
                          <img src=\"";
                // line 88
                echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
                echo "/img/icons/icon-3.png\" alt=\"\">
                          <span>";
                // line 89
                echo twig_escape_filter($this->env, $this->getAttribute($context["sale"], "bathroom", array()), "html", null, true);
                echo "</span>
                        </li>
                        <li>
                          <img src=\"";
                // line 92
                echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
                echo "/img/icons/icon-4.png\" alt=\"\">
                          <span>";
                // line 93
                echo twig_escape_filter($this->env, $this->getAttribute($context["sale"], "garage", array()), "html", null, true);
                echo "</span>
                        </li>
                      ";
            }
            // line 96
            echo "                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sale'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 103
        echo "        </div>
        <div role=\"tabpanel\" class=\"tab-pane fade\" id=\"rent\">
          ";
        // line 105
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["posts"]) ? $context["posts"] : null), "rents", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["rent"]) {
            // line 106
            echo "          <div class=\"col-md-4\">
            <div class=\"single-property\">
              <div class=\"property-img\">
                <a href=\"";
            // line 109
            echo twig_escape_filter($this->env, $this->getAttribute($context["rent"], "post_url", array()), "html", null, true);
            echo "\">
                  <img src=\"";
            // line 110
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["rent"], "post_thumbnail", array()), 0, array(), "array"), "html", null, true);
            echo "\" alt=\"\">
                </a>
              </div>
              <div class=\"property-desc\">
                <div class=\"property-desc-top\">
                  <h6>
                    <a href=\"";
            // line 116
            echo twig_escape_filter($this->env, $this->getAttribute($context["rent"], "post_url", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["rent"], "post_title", array()), "html", null, true);
            echo "\">
                      ";
            // line 117
            echo twig_escape_filter($this->env, $this->getAttribute($context["rent"], "post_title", array()), "html", null, true);
            echo "
                    </a>
                  </h6>
                  <h4 class=\"price euroMoney\">";
            // line 120
            echo twig_escape_filter($this->env, $this->getAttribute($context["rent"], "price", array()), "html", null, true);
            echo "</h4>
                  <p class=\"mg-price mgaMoney\"></p>
                  <div class=\"property-location\">
                    <p><img src=\"";
            // line 123
            echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
            echo "/img/icons/icon-5.png\" alt=\"\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["rent"], "location", array()), "html", null, true);
            echo "</p>
                  </div>
                </div>
                <div class=\"property-desc-bottom\">
                  <div class=\"property-bottom-list\">
                    <ul>
                      <li>
                        <img src=\"";
            // line 130
            echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
            echo "/img/icons/icon-1.png\" alt=\"\">
                        <span>";
            // line 131
            echo twig_escape_filter($this->env, $this->getAttribute($context["rent"], "surface", array()), "html", null, true);
            echo " sqft</span>
                      </li>
                      ";
            // line 133
            if (($this->getAttribute($context["rent"], "property", array()) != "ground")) {
                // line 134
                echo "                        <li>
                          <img src=\"";
                // line 135
                echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
                echo "/img/icons/icon-2.png\" alt=\"\">
                          <span>";
                // line 136
                echo twig_escape_filter($this->env, $this->getAttribute($context["rent"], "bedroom", array()), "html", null, true);
                echo "</span>
                        </li>
                        <li>
                          <img src=\"";
                // line 139
                echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
                echo "/img/icons/icon-3.png\" alt=\"\">
                          <span>";
                // line 140
                echo twig_escape_filter($this->env, $this->getAttribute($context["rent"], "bathroom", array()), "html", null, true);
                echo "</span>
                        </li>
                        <li>
                          <img src=\"";
                // line 143
                echo twig_escape_filter($this->env, (isset($context["get_template_directory_uri"]) ? $context["get_template_directory_uri"] : null), "html", null, true);
                echo "/img/icons/icon-4.png\" alt=\"\">
                          <span>";
                // line 144
                echo twig_escape_filter($this->env, $this->getAttribute($context["rent"], "garage", array()), "html", null, true);
                echo "</span>
                        </li>
                      ";
            }
            // line 147
            echo "                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rent'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 154
        echo "
      </div>
    </div>
  </div>
  </div>
</div>
<!--Our offers section end-->";
    }

    public function getTemplateName()
    {
        return "@VC/our-offers.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  297 => 154,  285 => 147,  279 => 144,  275 => 143,  269 => 140,  265 => 139,  259 => 136,  255 => 135,  252 => 134,  250 => 133,  245 => 131,  241 => 130,  229 => 123,  223 => 120,  217 => 117,  211 => 116,  202 => 110,  198 => 109,  193 => 106,  189 => 105,  185 => 103,  173 => 96,  167 => 93,  163 => 92,  157 => 89,  153 => 88,  147 => 85,  143 => 84,  140 => 83,  138 => 82,  133 => 80,  129 => 79,  117 => 72,  111 => 69,  105 => 66,  99 => 65,  90 => 59,  86 => 58,  81 => 55,  77 => 54,  49 => 29,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@VC/our-offers.html", "C:\\xampp\\htdocs\\managna\\wp-content\\themes\\managnasarl\\includes\\templates\\twig\\vc\\our-offers.html");
    }
}
