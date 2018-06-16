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

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
			'key' => 'group_5b241bb2a1bdf',
			'title' => 'Nivo Slider',
			'fields' => array(
					array(
							'key' => 'field_5b241bc507a95',
							'label' => 'Sliders',
							'name' => 'sliders',
							'type' => 'repeater',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
							),
							'collapsed' => '',
							'min' => 0,
							'max' => 0,
							'layout' => 'block',
							'button_label' => '',
							'sub_fields' => array(
									array(
											'key' => 'field_5b241be507a96',
											'label' => 'Image',
											'name' => 'image',
											'type' => 'image',
											'instructions' => '',
											'required' => 0,
											'conditional_logic' => 0,
											'wrapper' => array(
													'width' => '25',
													'class' => '',
													'id' => '',
											),
											'return_format' => 'url',
											'preview_size' => 'full',
											'library' => 'all',
											'min_width' => '',
											'min_height' => '',
											'min_size' => '',
											'max_width' => '',
											'max_height' => '',
											'max_size' => '',
											'mime_types' => 'png,jpg,jpeg',
									),
									array(
											'key' => 'field_5b241c8807a98',
											'label' => 'Information',
											'name' => 'information',
											'type' => 'group',
											'instructions' => '',
											'required' => 0,
											'conditional_logic' => 0,
											'wrapper' => array(
													'width' => '75',
													'class' => '',
													'id' => '',
											),
											'layout' => 'table',
											'sub_fields' => array(
													array(
															'key' => 'field_5b241d3d07a9a',
															'label' => 'Description',
															'name' => 'description',
															'type' => 'wysiwyg',
															'instructions' => '',
															'required' => 0,
															'conditional_logic' => 0,
															'wrapper' => array(
																	'width' => '65',
																	'class' => '',
																	'id' => '',
															),
															'default_value' => '',
															'tabs' => 'all',
															'toolbar' => 'full',
															'media_upload' => 1,
															'delay' => 0,
													),
													array(
															'key' => 'field_5b241d4807a9b',
															'label' => 'Link',
															'name' => 'link',
															'type' => 'page_link',
															'instructions' => '',
															'required' => 0,
															'conditional_logic' => 0,
															'wrapper' => array(
																	'width' => '',
																	'class' => '',
																	'id' => '',
															),
															'post_type' => array(
																	0 => 'product',
															),
															'taxonomy' => array(
															),
															'allow_null' => 0,
															'allow_archives' => 1,
															'multiple' => 0,
													),
											),
									),
							),
					),
			),
			'location' => array(
					array(
							array(
									'param' => 'post_type',
									'operator' => '==',
									'value' => 'slider',
							),
					),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
	));

	acf_add_local_field_group(array(
			'key' => 'group_5b23b96668211',
			'title' => 'Property details',
			'fields' => array(
					array(
							'key' => 'field_5b23c54254880',
							'label' => 'Condition',
							'name' => 'condition',
							'type' => 'group',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
							),
							'layout' => 'table',
							'sub_fields' => array(
									array(
											'key' => 'field_5b23c54d54881',
											'label' => 'Surface',
											'name' => 'surface',
											'type' => 'number',
											'instructions' => '',
											'required' => 0,
											'conditional_logic' => 0,
											'wrapper' => array(
													'width' => '',
													'class' => '',
													'id' => '',
											),
											'default_value' => '',
											'placeholder' => '',
											'prepend' => '',
											'append' => 'sqft',
											'min' => '',
											'max' => '',
											'step' => '',
									),
									array(
											'key' => 'field_5b23c56054882',
											'label' => 'Bedroom',
											'name' => 'bedroom',
											'type' => 'number',
											'instructions' => '',
											'required' => 0,
											'conditional_logic' => 0,
											'wrapper' => array(
													'width' => '',
													'class' => '',
													'id' => '',
											),
											'default_value' => '',
											'placeholder' => '',
											'prepend' => '',
											'append' => '',
											'min' => '',
											'max' => '',
											'step' => '',
									),
									array(
											'key' => 'field_5b23c56e54883',
											'label' => 'Bathroom',
											'name' => 'bathroom',
											'type' => 'number',
											'instructions' => '',
											'required' => 0,
											'conditional_logic' => 0,
											'wrapper' => array(
													'width' => '',
													'class' => '',
													'id' => '',
											),
											'default_value' => '',
											'placeholder' => '',
											'prepend' => '',
											'append' => '',
											'min' => '',
											'max' => '',
											'step' => '',
									),
									array(
											'key' => 'field_5b23c57e54884',
											'label' => 'Garage',
											'name' => 'garage',
											'type' => 'number',
											'instructions' => '',
											'required' => 0,
											'conditional_logic' => 0,
											'wrapper' => array(
													'width' => '',
													'class' => '',
													'id' => '',
											),
											'default_value' => '',
											'placeholder' => '',
											'prepend' => '',
											'append' => '',
											'min' => '',
											'max' => '',
											'step' => '',
									),
							),
					),
					array(
							'key' => 'field_5b23c5b5628c7',
							'label' => 'Basic Information',
							'name' => 'basic_information',
							'type' => 'group',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
							),
							'layout' => 'row',
							'sub_fields' => array(
									array(
											'key' => 'field_5b23ca29f3e57',
											'label' => 'Location',
											'name' => 'location',
											'type' => 'text',
											'instructions' => 'e.g : 568 E 1st Ave, Miami',
											'required' => 0,
											'conditional_logic' => 0,
											'wrapper' => array(
													'width' => '',
													'class' => '',
													'id' => '',
											),
											'default_value' => '',
											'placeholder' => '568 E 1st Ave, Miami',
											'prepend' => '',
											'append' => '',
											'maxlength' => '',
									),
									array(
											'key' => 'field_5b23cb04ebbff',
											'label' => 'Status',
											'name' => 'status',
											'type' => 'select',
											'instructions' => '',
											'required' => 0,
											'conditional_logic' => 0,
											'wrapper' => array(
													'width' => '',
													'class' => '',
													'id' => '',
											),
											'choices' => array(
													'for_sale' => 'For Sale',
													'for_rent' => 'For Rent',
											),
											'default_value' => array(
											),
											'allow_null' => 1,
											'multiple' => 0,
											'ui' => 0,
											'ajax' => 0,
											'return_format' => 'value',
											'placeholder' => '',
									),
							),
					),
					array(
							'key' => 'field_5b23c70aa0399',
							'label' => 'Amenities',
							'name' => 'amenities',
							'type' => 'checkbox',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
							),
							'choices' => array(
									'air-conditioning' => 'Air Conditioning',
									'bedding' => 'Bedding',
									'balcony' => 'Balcony',
									'cable-tv' => 'Cable TV',
									'internet' => 'Internet',
									'parking' => 'Parking',
									'lift' => 'lift',
									'pool' => 'Pool',
									'dishwasher' => 'Dishwasher',
									'toaster' => 'Toaster',
							),
							'allow_custom' => 0,
							'save_custom' => 0,
							'default_value' => array(
							),
							'layout' => 'horizontal',
							'toggle' => 0,
							'return_format' => 'array',
					),
			),
			'location' => array(
					array(
							array(
									'param' => 'post_type',
									'operator' => '==',
									'value' => 'product',
							),
					),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
	));

endif;