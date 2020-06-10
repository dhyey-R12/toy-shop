<?php
	
	/*---------------------------First highlight color-------------------*/

	$vw_landing_page_first_color = get_theme_mod('vw_landing_page_first_color');

	$vw_landing_page_custom_css = '';

	if($vw_landing_page_first_color != false){
		$vw_landing_page_custom_css .='.pagination a:hover, .pagination .current, #comments a.comment-reply-link{';
			$vw_landing_page_custom_css .='background-color: '.esc_html($vw_landing_page_first_color).';';
		$vw_landing_page_custom_css .='}';
	}
	if($vw_landing_page_first_color != false){
		$vw_landing_page_custom_css .='a, .custom-social-icons i:hover, #footer .custom-social-icons i:hover, #footer li a:hover, .post-navigation a:hover .post-title,.post-navigation a:focus .post-title, .post-navigation a:hover,.post-navigation a:focus, .main-navigation a:hover, .main-navigation ul.sub-menu a:hover, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, #footer .more-button a:hover, #footer .more-button:hover i{';
			$vw_landing_page_custom_css .='color: '.esc_html($vw_landing_page_first_color).';';
		$vw_landing_page_custom_css .='}';
	}
	if($vw_landing_page_first_color != false){
		$vw_landing_page_custom_css .='.post-main-box, #sidebar .widget{
		box-shadow: 0px 15px 10px -15px '.esc_html($vw_landing_page_first_color).';
		}';
	}
	if($vw_landing_page_first_color != false){
		$vw_landing_page_custom_css .='.main-navigation ul ul{';
			$vw_landing_page_custom_css .='border-top-color: '.esc_html($vw_landing_page_first_color).';';
		$vw_landing_page_custom_css .='}';
	}
	if($vw_landing_page_first_color != false){
		$vw_landing_page_custom_css .='.main-navigation ul ul{';
			$vw_landing_page_custom_css .='border-bottom-color: '.esc_html($vw_landing_page_first_color).';';
		$vw_landing_page_custom_css .='}';
	}

	/*---------------------------Second highlight color-------------------*/

	$vw_landing_page_second_color = get_theme_mod('vw_landing_page_second_color');

	if($vw_landing_page_first_color != false || $vw_landing_page_second_color != false){
		$vw_landing_page_custom_css .='input[type="submit"], #topbar, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, #slider .view-more:hover, .view-more, #info-section, #footer-2, #comments input[type="submit"], #sidebar .custom-social-icons i,#footer .custom-social-icons i, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, nav.woocommerce-MyAccount-navigation ul li, .scrollup i, #sidebar .widget_price_filter .ui-slider .ui-slider-range, #sidebar .widget_price_filter .ui-slider .ui-slider-handle, #sidebar .woocommerce-product-search button, #footer .widget_price_filter .ui-slider .ui-slider-range, #footer .widget_price_filter .ui-slider .ui-slider-handle, #footer .woocommerce-product-search button, #footer a.custom_read_more, #sidebar a.custom_read_more{
		background: linear-gradient(-90deg, '.esc_html($vw_landing_page_first_color).', '.esc_html($vw_landing_page_second_color).');
		}';
	}
	if($vw_landing_page_first_color != false || $vw_landing_page_second_color != false){
		$vw_landing_page_custom_css .='#slider .carousel-caption{
		border-image: linear-gradient(to bottom, '.esc_html($vw_landing_page_first_color).', '.esc_html($vw_landing_page_second_color).') 1 100%;
		}';
	}
	if($vw_landing_page_first_color != false || $vw_landing_page_second_color != false){
		$vw_landing_page_custom_css .='#about-section hr,.post-info hr{
		border-image: linear-gradient(to left, '.esc_html($vw_landing_page_first_color).', '.esc_html($vw_landing_page_second_color).') 1;
		}';
	}
	if($vw_landing_page_first_color != false || $vw_landing_page_second_color != false){
		$vw_landing_page_custom_css .='#footer h3:after{
		border-image: linear-gradient(to left, '.esc_html($vw_landing_page_first_color).', '.esc_html($vw_landing_page_second_color).') 1;
		}';
	}
	
	/*---------------------------Width Layout -------------------*/

	$theme_lay = get_theme_mod( 'vw_landing_page_width_option','Full Width');
    if($theme_lay == 'Boxed'){
		$vw_landing_page_custom_css .='body{';
			$vw_landing_page_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_landing_page_custom_css .='}';
	}else if($theme_lay == 'Wide Width'){
		$vw_landing_page_custom_css .='body{';
			$vw_landing_page_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_landing_page_custom_css .='}';
	}else if($theme_lay == 'Full Width'){
		$vw_landing_page_custom_css .='body{';
			$vw_landing_page_custom_css .='max-width: 100%;';
		$vw_landing_page_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$theme_lay = get_theme_mod( 'vw_landing_page_slider_opacity_color','0.5');
	if($theme_lay == '0'){
		$vw_landing_page_custom_css .='#slider img{';
			$vw_landing_page_custom_css .='opacity:0';
		$vw_landing_page_custom_css .='}';
		}else if($theme_lay == '0.1'){
		$vw_landing_page_custom_css .='#slider img{';
			$vw_landing_page_custom_css .='opacity:0.1';
		$vw_landing_page_custom_css .='}';
		}else if($theme_lay == '0.2'){
		$vw_landing_page_custom_css .='#slider img{';
			$vw_landing_page_custom_css .='opacity:0.2';
		$vw_landing_page_custom_css .='}';
		}else if($theme_lay == '0.3'){
		$vw_landing_page_custom_css .='#slider img{';
			$vw_landing_page_custom_css .='opacity:0.3';
		$vw_landing_page_custom_css .='}';
		}else if($theme_lay == '0.4'){
		$vw_landing_page_custom_css .='#slider img{';
			$vw_landing_page_custom_css .='opacity:0.4';
		$vw_landing_page_custom_css .='}';
		}else if($theme_lay == '0.5'){
		$vw_landing_page_custom_css .='#slider img{';
			$vw_landing_page_custom_css .='opacity:0.5';
		$vw_landing_page_custom_css .='}';
		}else if($theme_lay == '0.6'){
		$vw_landing_page_custom_css .='#slider img{';
			$vw_landing_page_custom_css .='opacity:0.6';
		$vw_landing_page_custom_css .='}';
		}else if($theme_lay == '0.7'){
		$vw_landing_page_custom_css .='#slider img{';
			$vw_landing_page_custom_css .='opacity:0.7';
		$vw_landing_page_custom_css .='}';
		}else if($theme_lay == '0.8'){
		$vw_landing_page_custom_css .='#slider img{';
			$vw_landing_page_custom_css .='opacity:0.8';
		$vw_landing_page_custom_css .='}';
		}else if($theme_lay == '0.9'){
		$vw_landing_page_custom_css .='#slider img{';
			$vw_landing_page_custom_css .='opacity:0.9';
		$vw_landing_page_custom_css .='}';
		}

	/*---------------------------Slider Content Layout -------------------*/

	$theme_lay = get_theme_mod( 'vw_landing_page_slider_content_option','Left');
    if($theme_lay == 'Left'){
		$vw_landing_page_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_landing_page_custom_css .='text-align:left; left:15%; right:35%;';
		$vw_landing_page_custom_css .='}';
	}else if($theme_lay == 'Center'){
		$vw_landing_page_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_landing_page_custom_css .='text-align:center; left:20%; right:20%;';
		$vw_landing_page_custom_css .='}';
		$vw_landing_page_custom_css .='#slider .carousel-caption{';
			$vw_landing_page_custom_css .='border-left:none;';
		$vw_landing_page_custom_css .='}';
	}else if($theme_lay == 'Right'){
		$vw_landing_page_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_landing_page_custom_css .='text-align:right; left:35%; right:16%;';
		$vw_landing_page_custom_css .='}';
		$vw_landing_page_custom_css .='#slider .carousel-caption{';
			$vw_landing_page_custom_css .='border-left:none; border-right:solid 5px;';
		$vw_landing_page_custom_css .='}';
		$vw_landing_page_custom_css .='#slider .inner_carousel{';
			$vw_landing_page_custom_css .='padding-right: 20px;';
	}

	/*---------------------------Blog Layout -------------------*/

	$theme_lay = get_theme_mod( 'vw_landing_page_blog_layout_option','Default');
    if($theme_lay == 'Default'){
		$vw_landing_page_custom_css .='.post-main-box{';
			$vw_landing_page_custom_css .='';
		$vw_landing_page_custom_css .='}';
	}else if($theme_lay == 'Center'){
		$vw_landing_page_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn{';
			$vw_landing_page_custom_css .='text-align:center;';
		$vw_landing_page_custom_css .='}';
		$vw_landing_page_custom_css .='.post-info{';
			$vw_landing_page_custom_css .='margin-top:10px;';
		$vw_landing_page_custom_css .='}';
		$vw_landing_page_custom_css .='.post-info hr{';
			$vw_landing_page_custom_css .='margin:10px auto;';
		$vw_landing_page_custom_css .='}';
	}else if($theme_lay == 'Left'){
		$vw_landing_page_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn, #our-services p{';
			$vw_landing_page_custom_css .='text-align:Left;';
		$vw_landing_page_custom_css .='}';
		$vw_landing_page_custom_css .='.post-info hr{';
			$vw_landing_page_custom_css .='margin-bottom:10px;';
		$vw_landing_page_custom_css .='}';
		$vw_landing_page_custom_css .='.post-main-box h2{';
			$vw_landing_page_custom_css .='margin-top:10px;';
		$vw_landing_page_custom_css .='}';
	}

	/*------------------------------Responsive Media -----------------------*/

	$vw_landing_page_resp_topbar = get_theme_mod( 'vw_landing_page_resp_topbar_hide_show',false);
    if($vw_landing_page_resp_topbar == true){
    	$vw_landing_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_landing_page_custom_css .='#topbar{';
			$vw_landing_page_custom_css .='display:block;';
		$vw_landing_page_custom_css .='} }';
	}else if($vw_landing_page_resp_topbar == false){
		$vw_landing_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_landing_page_custom_css .='#topbar{';
			$vw_landing_page_custom_css .='display:none;';
		$vw_landing_page_custom_css .='} }';
	}

	$vw_landing_page_resp_stickyheader = get_theme_mod( 'vw_landing_page_stickyheader_hide_show',false);
    if($vw_landing_page_resp_stickyheader == true){
    	$vw_landing_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_landing_page_custom_css .='.header-fixed{';
			$vw_landing_page_custom_css .='display:block;';
		$vw_landing_page_custom_css .='} }';
	}else if($vw_landing_page_resp_stickyheader == false){
		$vw_landing_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_landing_page_custom_css .='.header-fixed{';
			$vw_landing_page_custom_css .='display:none;';
		$vw_landing_page_custom_css .='} }';
	}

	$vw_landing_page_resp_slider = get_theme_mod( 'vw_landing_page_resp_slider_hide_show',false);
    if($vw_landing_page_resp_slider == true){
    	$vw_landing_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_landing_page_custom_css .='#slider{';
			$vw_landing_page_custom_css .='display:block;';
		$vw_landing_page_custom_css .='} }';
	}else if($vw_landing_page_resp_slider == false){
		$vw_landing_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_landing_page_custom_css .='#slider{';
			$vw_landing_page_custom_css .='display:none;';
		$vw_landing_page_custom_css .='} }';
	}

	$vw_landing_page_resp_metabox = get_theme_mod( 'vw_landing_page_metabox_hide_show',true);
    if($vw_landing_page_resp_metabox == true){
    	$vw_landing_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_landing_page_custom_css .='.post-info{';
			$vw_landing_page_custom_css .='display:block;';
		$vw_landing_page_custom_css .='} }';
	}else if($vw_landing_page_resp_metabox == false){
		$vw_landing_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_landing_page_custom_css .='.post-info{';
			$vw_landing_page_custom_css .='display:none;';
		$vw_landing_page_custom_css .='} }';
	}

	$vw_landing_page_resp_sidebar = get_theme_mod( 'vw_landing_page_sidebar_hide_show',true);
    if($vw_landing_page_resp_sidebar == true){
    	$vw_landing_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_landing_page_custom_css .='#sidebar{';
			$vw_landing_page_custom_css .='display:block;';
		$vw_landing_page_custom_css .='} }';
	}else if($vw_landing_page_resp_sidebar == false){
		$vw_landing_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_landing_page_custom_css .='#sidebar{';
			$vw_landing_page_custom_css .='display:none;';
		$vw_landing_page_custom_css .='} }';
	}

	/*------------- Top Bar Settings ------------------*/

	$vw_landing_page_topbar_padding_top_bottom = get_theme_mod('vw_landing_page_topbar_padding_top_bottom');
	if($vw_landing_page_topbar_padding_top_bottom != false){
		$vw_landing_page_custom_css .='#topbar{';
			$vw_landing_page_custom_css .='padding-top: '.esc_html($vw_landing_page_topbar_padding_top_bottom).'; padding-bottom: '.esc_html($vw_landing_page_topbar_padding_top_bottom).';';
		$vw_landing_page_custom_css .='}';
	}

	/*------------------ Search Settings -----------------*/
	
	$vw_landing_page_search_padding_top_bottom = get_theme_mod('vw_landing_page_search_padding_top_bottom');
	$vw_landing_page_search_padding_left_right = get_theme_mod('vw_landing_page_search_padding_left_right');
	$vw_landing_page_search_font_size = get_theme_mod('vw_landing_page_search_font_size');
	$vw_landing_page_search_border_radius = get_theme_mod('vw_landing_page_search_border_radius');
	if($vw_landing_page_search_padding_top_bottom != false || $vw_landing_page_search_padding_left_right != false || $vw_landing_page_search_font_size != false || $vw_landing_page_search_border_radius != false){
		$vw_landing_page_custom_css .='.search-box i{';
			$vw_landing_page_custom_css .='padding-top: '.esc_html($vw_landing_page_search_padding_top_bottom).'; padding-bottom: '.esc_html($vw_landing_page_search_padding_top_bottom).';padding-left: '.esc_html($vw_landing_page_search_padding_left_right).';padding-right: '.esc_html($vw_landing_page_search_padding_left_right).';font-size: '.esc_html($vw_landing_page_search_font_size).';border-radius: '.esc_html($vw_landing_page_search_border_radius).'px;';
		$vw_landing_page_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$vw_landing_page_button_padding_top_bottom = get_theme_mod('vw_landing_page_button_padding_top_bottom');
	$vw_landing_page_button_padding_left_right = get_theme_mod('vw_landing_page_button_padding_left_right');
	if($vw_landing_page_button_padding_top_bottom != false || $vw_landing_page_button_padding_left_right != false){
		$vw_landing_page_custom_css .='.view-more{';
			$vw_landing_page_custom_css .='padding-top: '.esc_html($vw_landing_page_button_padding_top_bottom).'; padding-bottom: '.esc_html($vw_landing_page_button_padding_top_bottom).';padding-left: '.esc_html($vw_landing_page_button_padding_left_right).';padding-right: '.esc_html($vw_landing_page_button_padding_left_right).';';
		$vw_landing_page_custom_css .='}';
	}

	$vw_landing_page_button_border_radius = get_theme_mod('vw_landing_page_button_border_radius');
	if($vw_landing_page_button_border_radius != false){
		$vw_landing_page_custom_css .='.view-more{';
			$vw_landing_page_custom_css .='border-radius: '.esc_html($vw_landing_page_button_border_radius).'px;';
		$vw_landing_page_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_landing_page_copyright_alingment = get_theme_mod('vw_landing_page_copyright_alingment');
	if($vw_landing_page_copyright_alingment != false){
		$vw_landing_page_custom_css .='.copyright p{';
			$vw_landing_page_custom_css .='text-align: '.esc_html($vw_landing_page_copyright_alingment).';';
		$vw_landing_page_custom_css .='}';
	}

	$vw_landing_page_copyright_padding_top_bottom = get_theme_mod('vw_landing_page_copyright_padding_top_bottom');
	if($vw_landing_page_copyright_padding_top_bottom != false){
		$vw_landing_page_custom_css .='#footer-2{';
			$vw_landing_page_custom_css .='padding-top: '.esc_html($vw_landing_page_copyright_padding_top_bottom).'; padding-bottom: '.esc_html($vw_landing_page_copyright_padding_top_bottom).';';
		$vw_landing_page_custom_css .='}';
	}