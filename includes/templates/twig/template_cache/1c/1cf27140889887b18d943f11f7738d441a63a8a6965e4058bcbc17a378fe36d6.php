<?php

/* @VC/our-offers.html */
class __TwigTemplate_6e93ff2707b0a7463c3d025c9912c21e6a3a2c5cd978722905dcc2d8de88f619 extends Twig_Template
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
                  <h4 class=\"price ariary\">";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute($context["sale"], "price", array()), "html", null, true);
            echo "</h4>
                  <!--<p class=\"mg-price mgaMoney\"></p>-->
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
            echo " ";
            echo call_user_func_array($this->env->getFilter('Unit')->getCallable(), array($this->getAttribute($context["sale"], "unit", array())));
            echo "</span>
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
                  <h4 class=\"price ariary\">";
            // line 120
            echo twig_escape_filter($this->env, $this->getAttribute($context["rent"], "price", array()), "html", null, true);
            echo "</h4>
                  <!--<p class=\"mg-price mgaMoney\"></p>-->
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
            echo " ";
            echo call_user_func_array($this->env->getFilter('Unit')->getCallable(), array($this->getAttribute($context["rent"], "unit", array())));
            echo "</span>
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
        return array (  301 => 154,  289 => 147,  283 => 144,  279 => 143,  273 => 140,  269 => 139,  263 => 136,  259 => 135,  256 => 134,  254 => 133,  247 => 131,  243 => 130,  231 => 123,  225 => 120,  219 => 117,  213 => 116,  204 => 110,  200 => 109,  195 => 106,  191 => 105,  187 => 103,  175 => 96,  169 => 93,  165 => 92,  159 => 89,  155 => 88,  149 => 85,  145 => 84,  142 => 83,  140 => 82,  133 => 80,  129 => 79,  117 => 72,  111 => 69,  105 => 66,  99 => 65,  90 => 59,  86 => 58,  81 => 55,  77 => 54,  49 => 29,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("
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
          <h3>{{title}}</h3>
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
          {% for sale in posts.sales %}
          <div class=\"col-md-4\">
            <div class=\"single-property\">
              <div class=\"property-img\">
                <a href=\"{{ sale.post_url }}\">
                  <img src=\"{{ sale.post_thumbnail[0] }}\" alt=\"\">
                </a>
              </div>
              <div class=\"property-desc\">
                <div class=\"property-desc-top\">
                  <h6>
                    <a href=\"{{ sale.post_url }}\" title=\"{{ sale.post_title }}\">
                      {{ sale.post_title }}
                    </a>
                  </h6>
                  <h4 class=\"price ariary\">{{ sale.price }}</h4>
                  <!--<p class=\"mg-price mgaMoney\"></p>-->
                  <div class=\"property-location\">
                    <p><img src=\"{{get_template_directory_uri}}/img/icons/icon-5.png\" alt=\"\">{{ sale.location }}</p>
                  </div>
                </div>
                <div class=\"property-desc-bottom\">
                  <div class=\"property-bottom-list\">
                    <ul>
                      <li>
                        <img src=\"{{get_template_directory_uri}}/img/icons/icon-1.png\" alt=\"\">
                        <span>{{ sale.surface }} {{sale.unit|Unit|raw}}</span>
                      </li>
                      {% if sale.property != 'ground' %}
                        <li>
                          <img src=\"{{get_template_directory_uri}}/img/icons/icon-2.png\" alt=\"\">
                          <span>{{ sale.bedroom }}</span>
                        </li>
                        <li>
                          <img src=\"{{get_template_directory_uri}}/img/icons/icon-3.png\" alt=\"\">
                          <span>{{ sale.bathroom }}</span>
                        </li>
                        <li>
                          <img src=\"{{get_template_directory_uri}}/img/icons/icon-4.png\" alt=\"\">
                          <span>{{ sale.garage }}</span>
                        </li>
                      {% endif %}
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {% endfor %}
        </div>
        <div role=\"tabpanel\" class=\"tab-pane fade\" id=\"rent\">
          {% for rent in posts.rents %}
          <div class=\"col-md-4\">
            <div class=\"single-property\">
              <div class=\"property-img\">
                <a href=\"{{ rent.post_url }}\">
                  <img src=\"{{ rent.post_thumbnail[0] }}\" alt=\"\">
                </a>
              </div>
              <div class=\"property-desc\">
                <div class=\"property-desc-top\">
                  <h6>
                    <a href=\"{{ rent.post_url }}\" title=\"{{ rent.post_title }}\">
                      {{ rent.post_title }}
                    </a>
                  </h6>
                  <h4 class=\"price ariary\">{{ rent.price }}</h4>
                  <!--<p class=\"mg-price mgaMoney\"></p>-->
                  <div class=\"property-location\">
                    <p><img src=\"{{get_template_directory_uri}}/img/icons/icon-5.png\" alt=\"\">{{ rent.location }}</p>
                  </div>
                </div>
                <div class=\"property-desc-bottom\">
                  <div class=\"property-bottom-list\">
                    <ul>
                      <li>
                        <img src=\"{{get_template_directory_uri}}/img/icons/icon-1.png\" alt=\"\">
                        <span>{{rent.surface}} {{rent.unit|Unit|raw}}</span>
                      </li>
                      {% if rent.property != 'ground' %}
                        <li>
                          <img src=\"{{get_template_directory_uri}}/img/icons/icon-2.png\" alt=\"\">
                          <span>{{ rent.bedroom }}</span>
                        </li>
                        <li>
                          <img src=\"{{get_template_directory_uri}}/img/icons/icon-3.png\" alt=\"\">
                          <span>{{ rent.bathroom }}</span>
                        </li>
                        <li>
                          <img src=\"{{get_template_directory_uri}}/img/icons/icon-4.png\" alt=\"\">
                          <span>{{ rent.garage }}</span>
                        </li>
                      {% endif %}
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {% endfor %}

      </div>
    </div>
  </div>
  </div>
</div>
<!--Our offers section end-->", "@VC/our-offers.html", "C:\\xampp\\htdocs\\managna\\wp-content\\themes\\managnasarl\\includes\\templates\\twig\\vc\\our-offers.html");
    }
}
