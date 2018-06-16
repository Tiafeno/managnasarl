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

    $(".property-list").owlCarousel({
      autoPlay: false,
      slideSpeed: 2000,
      pagination: false,
      navigation: true,
      items: 3,
      navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [991, 2],
      itemsTablet: [767, 1],
      itemsMobile: [479, 1],
    });

    $(".happy-client-list").owlCarousel({
      autoPlay: false,
      slideSpeed: 2000,
      pagination: false,
      navigation: true,
      items: 4,
      navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [991, 3],
      itemsTablet: [768, 1],
      itemsMobile: [479, 1],
    });

    $(".brand-list").owlCarousel({
      autoPlay: false,
      slideSpeed: 2000,
      pagination: false,
      navigation: false,
      items: 5,
      navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
      itemsDesktop: [1199, 4],
      itemsDesktopSmall: [991, 3],
      itemsTablet: [768, 2],
      itemsMobile: [479, 1],
    });

    $(".property_list").owlCarousel({
      autoPlay: false,
      slideSpeed: 2000,
      pagination: false,
      navigation: true,
      items: 1,
      navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
      itemsDesktop: [1199, 1],
      itemsDesktopSmall: [980, 1],
      itemsTablet: [768, 1],
      itemsMobile: [479, 1],
    });

  });
})(jQuery);