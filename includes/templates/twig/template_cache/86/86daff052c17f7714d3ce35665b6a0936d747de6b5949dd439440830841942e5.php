<?php

/* @VC/slider.html */
class __TwigTemplate_37344503093a29369e6c1c1e59faa542a6e088c9905f02b1d6c018c388c49c1a extends Twig_Template
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
        echo "<!DOCTYPE html>
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

<!--slider section start-->
<div class=\"slider-container overlay\">
    <!-- Slider Image -->
    <div id=\"mainSlider\" class=\"nivoSlider slider-image managnaSlider\">
      ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sliders"]) ? $context["sliders"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["slider"]) {
            // line 29
            echo "        <img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["slider"], "image_url", array()), "sizes", array(), "array"), "large", array(), "array"), "html", null, true);
            echo "\" alt=\"\" title=\"#";
            echo twig_escape_filter($this->env, $this->getAttribute($context["slider"], "layout", array()), "html", null, true);
            echo "\">
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['slider'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "    </div>

  <!-- Slider -->
  ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sliders"]) ? $context["sliders"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["slider"]) {
            // line 35
            echo "    <div id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["slider"], "layout", array()), "html", null, true);
            echo "\" class=\"nivo-html-caption slider-caption-1\">
      <div class=\"display-table\">
        <div class=\"display-tablecell\">
          <div class=\"container \">
            <div class=\"row\">
              <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"slide1-text\">
                  <div class=\"middle-text\">

                    <div class=\"desc wow fadeUp animated\" data-wow-duration=\"1.4s\" data-wow-delay=\"0.4s\"
                         style=\"visibility: visible; animation-duration: 1.4s; animation-delay: 0.4s; animation-name: fadeUp;\">
                      ";
            // line 46
            echo $this->getAttribute($context["slider"], "desc", array());
            echo "
                    </div>

                    ";
            // line 49
            if ( !twig_test_empty($this->getAttribute($context["slider"], "link", array()))) {
                // line 50
                echo "                    <div class=\"contact-us wow fadeUp animated\" data-wow-duration=\"1.5s\" data-wow-delay=\".5s\"
                         style=\"visibility: visible; animation-duration: 1.5s; animation-delay: 0.5s; animation-name: fadeUp;\">
                      <a href=\"";
                // line 52
                echo twig_escape_filter($this->env, $this->getAttribute($context["slider"], "link", array()), "html", null, true);
                echo "\">VOIR</a>
                    </div>
                    ";
            }
            // line 55
            echo "
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['slider'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 65
        echo "
</div>
<!--slider section end-->";
    }

    public function getTemplateName()
    {
        return "@VC/slider.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 65,  105 => 55,  99 => 52,  95 => 50,  93 => 49,  87 => 46,  72 => 35,  68 => 34,  63 => 31,  52 => 29,  48 => 28,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@VC/slider.html", "C:\\xampp\\htdocs\\managna\\wp-content\\themes\\managnasarl\\includes\\templates\\twig\\vc\\slider.html");
    }
}
