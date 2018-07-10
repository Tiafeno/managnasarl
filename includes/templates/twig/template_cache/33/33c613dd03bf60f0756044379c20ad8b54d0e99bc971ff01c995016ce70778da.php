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
        echo "<script type=\"text/javascript\">
  (function(\$) {
    \$(document).ready(function() {
      \$('.pro-details-carousel').slick({
        dots: false,
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });
    })
  })(jQuery);
</script>
<style type=\"text/css\">
  .pro-details-item a {
    padding: 10px;
    display: block;
  }
  .slick-prev:before, .slick-next:before {
    color: #000000 !important;
  }
</style>
<div class=\"pro-details-image mb-5\">
  <div class=\"pro-details-big-image\">
    <div class=\"tab-content\">

      ";
        // line 54
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
            // line 55
            echo "        <div role=\"tabpanel\" class=\"tab-pane fade in ";
            if (($this->getAttribute($context["loop"], "index", array()) == 1)) {
                echo " active ";
            }
            echo "\" id=\"pro-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["gallery"], "id", array()), "html", null, true);
            echo "\">
          <a href=\"";
            // line 56
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["gallery"], "image_url", array()), 0, array(), "array"), "html", null, true);
            echo "\" data-lightbox=\"image-1\" data-title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["gallery"], "title", array()), "html", null, true);
            echo "\">
            <img src=\"";
            // line 57
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
        // line 61
        echo "
    </div>
  </div>
  <div class=\"pro-details-carousel\">

    ";
        // line 66
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["galleries"]) ? $context["galleries"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["gallery"]) {
            // line 67
            echo "      <div class=\"pro-details-item\">
        <a href=\"#pro-";
            // line 68
            echo twig_escape_filter($this->env, $this->getAttribute($context["gallery"], "id", array()), "html", null, true);
            echo "\" data-toggle=\"tab\">
          <img src=\"";
            // line 69
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
        // line 73
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
        return array (  156 => 73,  144 => 69,  140 => 68,  137 => 67,  133 => 66,  126 => 61,  106 => 57,  100 => 56,  91 => 55,  74 => 54,  19 => 1,);
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
