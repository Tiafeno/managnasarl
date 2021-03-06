/*
 * Copyright (c) 2018 Tiafeno Finel
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files, to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

(function ($) {
  "use strict";
  $(document).ready(function () {
    /*------------------
        5. Price Slider
    --------------------------*/
    var echelle = $("#slider-range");
    var optionSlider = vc_search_filter.slider;
    var min_price = parseFloat(optionSlider.min_price);
    var max_price = parseFloat(optionSlider.max_price);
    var limite = parseFloat(optionSlider.max_price_limite);
    echelle.slider({
      range: true,
      min: min_price,
      max: limite,
      values: [min_price, max_price],
      slide: function (event, ui) {
        $("#amount").val(ui.values[0] + "MGA - " + ui.values[1] + "MGA");
      }
    });

  });
})(jQuery);
