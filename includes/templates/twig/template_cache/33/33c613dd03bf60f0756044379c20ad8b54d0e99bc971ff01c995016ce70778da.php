<?php

/* @Shortcodes/property-details-gallery.html */
class __TwigTemplate_05e11b99c0d9f20db05cd4d0d869655e9a00d10904d57090b623c307534c7213 extends Twig_Template
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
<div class=\"pro-details-image mb-60\">
  <div class=\"pro-details-big-image\">
    <div class=\"tab-content\">

      ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["galleries"]) ? $context["galleries"] : null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["gallery"]) {
            // line 7
            echo "        <div role=\"tabpanel\" class=\"tab-pane fade in ";
            if (($this->getAttribute($context["loop"], "index", array()) == 1)) {
                echo " active ";
            }
            echo "\" id=\"pro-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["gallery"], "id", array()), "html", null, true);
            echo "\">
          <a href=\"";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["gallery"], "image_url", array()), 0, array(), "array"), "html", null, true);
            echo "\" data-lightbox=\"image-1\" data-title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["gallery"], "title", array()), "html", null, true);
            echo "\">
            <img src=\"";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["gallery"], "image_url", array()), 0, array(), "array"), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["gallery"], "title", array()), "html", null, true);
            echo "\">
          </a>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['gallery'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "
    </div>
  </div>
  <div class=\"pro-details-carousel\">

    ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["galleries"]) ? $context["galleries"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["gallery"]) {
            // line 19
            echo "      <div class=\"pro-details-item\">
        <a href=\"#pro-";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["gallery"], "id", array()), "html", null, true);
            echo "\" data-toggle=\"tab\">
          <img src=\"";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["gallery"], "image_url", array()), 0, array(), "array"), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["gallery"], "title", array()), "html", null, true);
            echo "\">
        </a>
      </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['gallery'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "@Shortcodes/property-details-gallery.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 25,  96 => 21,  92 => 20,  89 => 19,  85 => 18,  78 => 13,  58 => 9,  52 => 8,  43 => 7,  26 => 6,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@Shortcodes/property-details-gallery.html", "C:\\xampp\\htdocs\\managna\\wp-content\\themes\\managnasarl\\includes\\templates\\twig\\shortcodes\\property-details-gallery.html");
    }
}
