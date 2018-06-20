<?php
/**
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

/**
 * @param object $condition
 */
function set_property_bottom_list($condition) {
  if ( ! is_object($condition)) return;
	?>
	<div class="property-bottom-list">
    <ul>
      <li>
        <img src="<?= get_template_directory_uri() . '/img/icons/icon-1.png' ?>" alt="">
        <span><?= $condition->surface  ? $condition->surface  : 0 ?> m<sup>2</sup></span>
      </li>
      <li>
        <img src="<?= get_template_directory_uri() . '/img/icons/icon-2.png' ?>" alt="">
        <span><?= $condition->bedroom  ? $condition->bedroom  : 0 ?></span>
      </li>
      <li>
        <img src="<?= get_template_directory_uri() . '/img/icons/icon-3.png' ?>" alt="">
        <span><?= $condition->bathroom ? $condition->bathroom : 0 ?></span>
      </li>
      <li>
        <img src="<?= get_template_directory_uri() . '/img/icons/icon-4.png' ?>" alt="">
        <span><?= $condition->garage  ? $condition->garage  : 0?></span>
      </li>
    </ul>
  </div>
<?php
}

function embed_style_header() {
  ?>
    <style type="text/css">
			body {
				font-family: 'PT Sans', sans-serif;
			}
			h1, h2, h3, h4, h5, h6 {
				font-family: 'PT Sans', sans-serif;
			}
			sup {
				font-size: 10px;
			}

				/**
				Slider
				*/
	    .nivoSlider .middle-text h1,
	    .nivoSlider .middle-text h2,
	    .nivoSlider .middle-text h3,
	    .nivoSlider .middle-text h4,
	    .nivoSlider .middle-text h5,
	    .nivoSlider .middle-text h6,
	    .nivoSlider .middle-text strong{
		    color: #ffffff;
	    }
	    .nivoSlider .middle-text h1,
	    .nivoSlider .middle-text h2,
	    .nivoSlider .middle-text h3,
	    .nivoSlider .middle-text h4,
	    .nivoSlider .middle-text h5,
	    .nivoSlider .middle-text h6 {
		    text-transform: uppercase;
	    }
	    /**
	    Menu
	    */
	    .mean-container a.meanmenu-reveal span {
		    background: #b01d36;
	    }
	    .mean-container a.meanmenu-reveal {
		    color: #b01d36;
	    }


      /**
      Feature property
       */
      .property-desc-top h6 a:hover {
        color: #ffffff;
      }
      .property-desc-top h6 {
        line-height: 17px !important;
        margin-bottom: 6px;
        font-size: 14px;
      }
      .property-desc-top h4.price {
        color: #ffffff;
        font-size: 15px;
        top: 38%;
      }
      .property-desc-top .mg-price {
        color: white;
        position: absolute;
        right: 20px;
        font-size: 12px;
      }
      @media (max-width: 479px) {
	      .property-desc-top .mg-price {
		      position: static;
		      margin-bottom: 0px;
	      }
      }
	    .owl-item .property-img {
		    background: #d2d2d2;
		    display: flex;
	    }
	    .property-img > a {
		    margin: auto;
	    }
      .google-map-title > h5 {
	      color: #303030;
	      font-weight: 400;
	      margin-bottom: 15px;
      }

	    /**
	      Single property
	     */
      .acf-map {
	      width: 100%;
	      height: 400px;
	      border: #ccc solid 1px;
	      margin: 20px 0;
      }
      .single-property-details .price {
	      font-size: 30px !important;
      }
      .single-property-details .property-condition-list,
      .single-property-details .amenities-list {
	      background: #E7E7E7 none repeat scroll 0 0;
      }
	    .amenities-list ul li {
		    font-size: 13px;
		    margin-bottom: 15px;
	    }
	    .property-condition-list li span {
		    font-size: 13px;
	    }
	    .property-condition-list li {
		    margin-bottom: 20px;
	    }
	      /* fixes potential theme css conflict */
      .acf-map img {
	      max-width: inherit !important;
      }

      /**
      Find
      */
			.search-box-area {
				background: #b01d36 none repeat scroll 0 0;
			}
			.find-home {
				padding: 50px 0;
			}
			.find_home-box .price_filter {
				width: 100%;
			}

			#loginForm .bt-login {
				background: #ffffff none repeat scroll 0 0;
				border: 1px solid rgba(0, 0, 0, 0);
				color: #b01d36;
				font-weight: 700;
				height: 40px;
				line-height: 38px;
				-webkit-transition: all 0.3s ease 0s;
				transition: all 0.3s ease 0s;
				width: 100%;
			}

			#loginForm .bt-login:hover {
				background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
				border-color: #ffffff;
				color: #ffffff;
			}

			/**
			Sidebar
			*/
			.aside-title h5 {
				color: #000;
				font-weight: 300;
				text-transform: uppercase;
			}
			.aside-title h5::before {
				background: #101010 none repeat scroll 0 0;
				height: 1px;
				width: 100%;
			}

	    /**
	    Footer
	     */
	    .footer-bottom {
		    background: #575757 none repeat scroll 0 0;
	    }

    </style>
  <?php
}