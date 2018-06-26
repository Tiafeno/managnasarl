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
  $(document).ready(function () {
    var ariarySelectors = $('.ariary');
    var ariaryNumber =  NaN;


    $.each(ariarySelectors, function (key, element) {
      $(element).text(function () {
        ariaryNumber = parseInt($(element).text());
        if (isNaN(ariaryNumber)) return 'Le prix n\'est pas informer';
        return new Intl.NumberFormat('de-DE', {
          style: 'currency',
          currency: 'MGA'
        }).format(ariaryNumber);
      });
      var parent = $(element).parents('.property-desc-top');
      parent
        .find('.euroMoney')
        .text(function () {
          var curValue = ariaryNumber / jManagna.currency.rates.MGA;
          return new Intl.NumberFormat('de-DE', {
            style: 'currency',
            currency: 'EUR'
          }).format(curValue);
        });
    });

  })
})(jQuery);