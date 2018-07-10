<?php

/* @VC/search-filter.html */
class __TwigTemplate_b3a0a69c1d97e27fb9a8f069c10d81e3943b1fd193888e693f0274900c18ae75 extends Twig_Template
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
<!-- Search Filter start-->
<div class=\"find-home\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-12\">
        <div class=\"find-home-title\">
          <h3>";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</h3>
        </div>
      </div>
      <form role=\"search\" method=\"get\" action=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["search"]) ? $context["search"] : null), "action", array(), "array"), "html", null, true);
        echo "\">
        <div class=\"col-md-3 col-sm-4 col-xs-12\">
          <div class=\"find-home-item custom-select mb-40\">
            <select name=\"property\" class=\"selectpicker\" title=\"Type de bien\" data-hide-disabled=\"true\" data-live-search=\"false\">
              <option value=\"\">Tous les biens</option>
              <option value=\"house\">Maison</option>
              <option value=\"ground\">Terrain</option>
              <option value=\"apartment\">Appartement</option>
            </select>
          </div>
        </div>
        <div class=\"col-md-3 col-sm-4 col-xs-12\">
          <div class=\"find-home-item custom-select\">
            <select name=\"status\" class=\"selectpicker\" title=\"Louer / Acheter\" data-hide-disabled=\"true\" data-live-search=\"false\">
              <option value=\"\">Louer / Acheter</option>
              <option value=\"for_rent\">A Louer</option>
              <option value=\"for_sale\">A Vendre</option>
            </select>
          </div>
        </div>
        <div class=\"col-md-3 col-sm-4 col-xs-12\">
          <div class=\"find-home-item mb-40\">
            <input type=\"number\" name=\"area\" placeholder=\"Nombre de pièces\">
          </div>
        </div>
        <div class=\"col-md-3 col-sm-4 col-xs-12\">
          <div class=\"find-home-item mb-40\">
            <input type=\"search\" class=\"search-field\" value=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["search"]) ? $context["search"] : null), "search_query", array(), "array"), "html", null, true);
        echo "\" name=\"s\" placeholder=\"Votre recherche ici\">
          </div>
        </div>
        <div class=\"col-md-9 col-sm-4 col-xs-12\">
          <div class=\"find-home-item\">
            <!-- shop-filter -->
            <div class=\"shop-filter\">
              <div class=\"price_filter\">
                <div class=\"price_slider_amount\">
                  <input type=\"submit\" value=\"Echelle des prix\"/>
                  <input type=\"text\" id=\"amount\" name=\"price\" placeholder=\"Add Your Price\"/>
                </div>
                <div id=\"slider-range\"></div>
              </div>
            </div>
          </div>
        </div>
        <div class=\"clo-md-3 col-sm-3 col-xs-12\">
          <div class=\"find-home-item\">
            <input type=\"hidden\" name=\"post_type\" value=\"product\" />
            <button type=\"submit\">RECHERCHE</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Search Filter end-->

";
    }

    public function getTemplateName()
    {
        return "@VC/search-filter.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 38,  34 => 11,  28 => 8,  19 => 1,);
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
<!-- Search Filter start-->
<div class=\"find-home\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-12\">
        <div class=\"find-home-title\">
          <h3>{{ title }}</h3>
        </div>
      </div>
      <form role=\"search\" method=\"get\" action=\"{{ search['action'] }}\">
        <div class=\"col-md-3 col-sm-4 col-xs-12\">
          <div class=\"find-home-item custom-select mb-40\">
            <select name=\"property\" class=\"selectpicker\" title=\"Type de bien\" data-hide-disabled=\"true\" data-live-search=\"false\">
              <option value=\"\">Tous les biens</option>
              <option value=\"house\">Maison</option>
              <option value=\"ground\">Terrain</option>
              <option value=\"apartment\">Appartement</option>
            </select>
          </div>
        </div>
        <div class=\"col-md-3 col-sm-4 col-xs-12\">
          <div class=\"find-home-item custom-select\">
            <select name=\"status\" class=\"selectpicker\" title=\"Louer / Acheter\" data-hide-disabled=\"true\" data-live-search=\"false\">
              <option value=\"\">Louer / Acheter</option>
              <option value=\"for_rent\">A Louer</option>
              <option value=\"for_sale\">A Vendre</option>
            </select>
          </div>
        </div>
        <div class=\"col-md-3 col-sm-4 col-xs-12\">
          <div class=\"find-home-item mb-40\">
            <input type=\"number\" name=\"area\" placeholder=\"Nombre de pièces\">
          </div>
        </div>
        <div class=\"col-md-3 col-sm-4 col-xs-12\">
          <div class=\"find-home-item mb-40\">
            <input type=\"search\" class=\"search-field\" value=\"{{ search['search_query'] }}\" name=\"s\" placeholder=\"Votre recherche ici\">
          </div>
        </div>
        <div class=\"col-md-9 col-sm-4 col-xs-12\">
          <div class=\"find-home-item\">
            <!-- shop-filter -->
            <div class=\"shop-filter\">
              <div class=\"price_filter\">
                <div class=\"price_slider_amount\">
                  <input type=\"submit\" value=\"Echelle des prix\"/>
                  <input type=\"text\" id=\"amount\" name=\"price\" placeholder=\"Add Your Price\"/>
                </div>
                <div id=\"slider-range\"></div>
              </div>
            </div>
          </div>
        </div>
        <div class=\"clo-md-3 col-sm-3 col-xs-12\">
          <div class=\"find-home-item\">
            <input type=\"hidden\" name=\"post_type\" value=\"product\" />
            <button type=\"submit\">RECHERCHE</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Search Filter end-->

", "@VC/search-filter.html", "C:\\xampp\\htdocs\\managna\\wp-content\\themes\\managnasarl\\includes\\templates\\twig\\vc\\search-filter.html");
    }
}
