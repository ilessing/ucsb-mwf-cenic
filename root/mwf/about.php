<?php

/**
 * 
 * @package mwf
 *
 * @author ebollens
 * @copyright Copyright (c) 2010-11 UC Regents
 * @license http://mwf.ucla.edu/license
 * @version 20110519
 *
 * @uses Decorator
 * @uses Site_Decorator
 * @uses HTML_Decorator
 * @uses HTML_Start_HTML_Decorator
 * @uses Head_Site_Decorator
 * @uses Body_Start_HTML_Decorator
 * @uses Header_Site_Decorator
 * @uses Content_Full_Site_Decorator
 * @uses Button_Full_Site_Decorator
 * @uses Default_Footer_Site_Decorator
 * @uses Body_End_HTML_Decorator
 * @uses HTML_End_HTML_Decorator
 */

require_once(dirname(dirname(__FILE__)).'/assets/config.php');
require_once(dirname(dirname(__FILE__)).'/assets/lib/decorator.class.php');

echo HTML_Decorator::html_start()->render();

echo Site_Decorator::head()->set_title('MWF About')->render();

echo HTML_Decorator::body_start()->render();

echo Site_Decorator::header()
        ->set_title('MWF About')
        ->render();


echo '<div class="content"><h2>UCSB Local Details</h2><p>
	<a href="https://it.ucsb.edu/groups/mdg">The Mobile Development Group</a> at UCSB will be the organizing point for campus web developers interested in collaborating with others on this instance of the MWF for UCSB. The <a href="http://www.library.ucsb.edu/" >UCSB Library</a> is hosting an instance of the framework for the UCSB Community. This instance of MWF was last updated 2013-04-03 to version 1.3.03. Please contact <a href="http://www.library.ucsb.edu/staff?term_node_tid_depth=396"">Ian Lessing</a> at the Library or <a href="http://sist.sa.ucsb.edu/">Joe Sabado</a> in Student Affairs with questions, comments or concerns.
	</p></div>';








echo Site_Decorator::content()
            ->set_padded()
            ->add_header('The Framework')
            ->add_paragraph('The Mobile Web Framework is a cross-platform web framework that focuses on mobile web standards, semantic markup, device agnosticism and graceful degradation, providing a robust presentation layer that allows applications to define a single set of markup optimized for HTML 5 capable devices that degrades gracefully to any HTML 4.01 or XHTML MP 2.0 compliant device including Blackberry, Windows Mobile and even T9 phones.')
            ->render();

echo Site_Decorator::content()
            ->set_padded()
            ->add_header('The Initiative')
            ->add_paragraph('The framework project began in early 2010 as a joint venture between the UCLA Office of Information Technology and UCLA Communications as a means to reach all campus mobile users via a single platform in a reasonable and cost-effective manner. The framework first went into production at the beginning of Fall 2010 with the launch of UCLA Mobile.')
            ->add_paragraph('Over ten campus units are now participating at UCLA, four other campuses in the UC system have launched production applications using the framework, and a number of other institutions both in the UC and beyond are currently involved in the initiative.')
            ->render();

echo Site_Decorator::button()
                ->set_padded()
                ->add_option(Config::get('global', 'back_to_home_text'), Config::get('global', 'site_url'))
                ->render();

echo Site_Decorator::default_footer()->render();

echo HTML_Decorator::body_end()->render();

echo HTML_Decorator::html_end()->render();
