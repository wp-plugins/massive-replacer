<?php
/*
Plugin Name: Massive Replacer
Plugin URI: http://blog-sumolari.sumolari.com/proyectos/wordpress/massive-replacer/
Description: Plugin que te permite definir contenido que se sustituir&aacute; por otro
Version: 1.0
Author: Sumolari
Author URI: http://blog-sumolari.sumolari.com
Copyright 2008  Sumolari  (email : info@sumolari.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
function massive_replacer_install () {
		add_option("mr_version", "1");
}
register_activation_hook(__FILE__,'massive_replacer_install');
function rep_all($text) {
	$mr_url = ''.get_bloginfo('url').'/wp-content/plugins/massive_replacer/replace.txt';
	$handle = fopen($mr_url, 'r');
	while ($names = fscanf($handle, "%s\t%s\n")) {
		list ($tas, $tqe) = $names;
		$text = str_replace($tas, $tqe, $text);
	}
	return $text;
	fclose ($handle);
}
add_filter('the_content', 'rep_all');
add_filter('the_title', 'rep_all');
?>