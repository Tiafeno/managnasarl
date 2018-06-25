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
    var euroMoney = $('.euroMoney');

    $('.ariary').each(function (index, element) {
      $(element).text(function () {
        var value = parseInt($(element).text());
        return new Intl.NumberFormat('de-DE', {
          style: 'currency',
          currency: 'MGA'
        }).format(value);
      })
    });

    $.each(euroMoney, function (key, element) {
      var price = parseFloat($(element).text());
      $(element).text(function (index) {
        var curValue = parseFloat($(this).text().trim());
        return new Intl.NumberFormat('de-DE', {
          style: 'currency',
          currency: 'EUR'
        }).format(curValue);
      });
      var parent = $(element).parents('.property-desc-top');
      parent
        .find('.mgaMoney')
        .text(function () {
          var curValue = price * jManagna.currency.rates.MGA;
          return new Intl.NumberFormat('de-DE', {
            style: 'currency',
            currency: 'MGA'
          }).format(curValue);
        });
    });

  })
})(jQuery);