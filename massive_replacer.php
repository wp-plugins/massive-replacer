<?php
/*
Plugin Name: Massive Replacer
Plugin URI: http://blog-sumolari.sumolari.com/proyectos/wordpress/massive-replacer/
Description: Plugin que te permite definir contenido que se sustituir&aacute; por otro
Version: 2.0
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
register_activation_hook(__FILE__,'mr_install');

add_action('admin_menu', 'mr_add_page');
function mr_add_page() {
	add_menu_page("configuraci&oacute;n de Massive Replacer", "Massive Replacer", 8, __FILE__, 'create_page');
}

$mr_db_version = "1.0";
function mr_install () {
   global $wpdb;
   $table_name = $wpdb->prefix . "massive_replacer";
   if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	   $sql = "CREATE TABLE " . $table_name . " (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  val1 text NOT NULL,
		  val2 text NOT NULL,
		  UNIQUE KEY id (id)
		);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
	$val1 = "WordPress";
	$va2 = "<strong>WordPress</strong>";		
	$insert = "INSERT INTO " . $table_name .
				" (val1, val2) " .
				"VALUES (" . $wpdb->escape($val1) . "','" . $wpdb->escape($va2) . "')";	
	$results = $wpdb->query( $insert );
	add_option("mr_version", "2.0");
	add_option("mr_orig", "WordPress");
	add_option("mr_repl", "<strong>WordPress</strong>");
}

function create_page () {
	echo '	<div class="wrap"><h2>Massive Replacer</h2><form name="mr_op" id="mr_op" method="post" action="options.php">';
	wp_nonce_field('update-options');
	echo '
			<table class="form-table"><tbody><tr class="form-field form-required"><th scope="row" valign="top"><label for="cat_name">Texto a reemplazar</label></th>
			<td><textarea name="mr_orig" id="mr_orig" rows="5" cols="50" style="width: 97%;">'; echo get_option('mr_orig'); echo'</textarea><br>Textos originales a reemplazar. Separa cada texto a reemplazar con una coma (",").</td></tr>
			
			<tr class="form-field"><th scope="row" valign="top"><label for="category_nicename">Texto que aparecer&aacute;</label></th>
			<td><textarea name="mr_repl" id="mr_repl" rows="5" cols="50" style="width: 97%;">'; echo get_option('mr_repl'); echo'</textarea><br>Escribe aqu&iacute; el texto que aparecer&aacute; en lugar del texto a reemplazar. Separa cada texto a reemplazar con una coma (",").</td></tr>
			
			<input type="hidden" name="action" value="update" />
			
			<input type="hidden" name="page_options" value="mr_orig, mr_repl" />
			
			</tbody></table>
			
			<p class="submit"><input class="button" name="submit" value="Actualizar reemplazos" type="submit" /></p></form>
			';
			
			echo '<h2>Reemplazos actuales</h2><p>En la siguiente tabla se muestran los reemplazos actuales:</p><table class="widefat"<thead><tr><th scope="col">Cadena de texto original</th><th scope="col">Cadena de texto resultante</th></tr></thead><tbody>';

			lista_sustituciones();
			
			echo '</tbody></table>';
			
			echo '<h2>Sobre el autor</h2><p>Este plugin ha sido creado por <a href="http://blog-sumolari.sumolari.com">Sumolari</a>. Si te ha gustado este plugin, dif&uacute;ndelos entre tus amigos, y colabora para que cada vez m&aacute;s personas lo usen.</p><p>Puedes crear variantes de este plugin, pero siempre respetando el Copyright del original, y dejando un link visible a <a href="http://blog-sumolari.sumolari.com">http://blog-sumolari.sumolari.com</a> y el nombre del autor original (<strong>Sumolari</strong>). </p><p>Si tienes problemas usando este plugin, no dudes en preguntar en <a href="http://foro.sumolari.com">nuestros foros</a>.</p>';
}

function interpreta_datos ($mr_orig, $mr_repl) {

	$md_o = explode("]]||[[", $mr_orig);
	
	foreach ($md_o as $value) {
		echo "Texto original --> $value<br/>";
	}
	
	$md_r = explode("]]||[[", $mr_repl);
	
	foreach ($md_r as $value) {
		echo "Texto reemplazado --> $value<br/>";
	}

}

function lista_sustituciones() {

	$mr_orig = get_option('mr_orig');
	$mr_repl = get_option('mr_repl');

	$md_o = explode("]]||[[", $mr_orig);
	$md_r = explode("]]||[[", $mr_repl);
	
	$md_d = array_combine($md_o, $md_r);

	foreach ($md_d as $key => $value) {
		echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
	}

}

function rep_all($text) {

	$mr_orig = get_option('mr_orig');
	$mr_repl = get_option('mr_repl');

	$md_o = explode("]]||[[", $mr_orig);
	$md_r = explode("]]||[[", $mr_repl);
	
	$md_d = array_combine($md_o, $md_r);

	foreach ($md_d as $key => $value) {
		$text = str_replace($key, $value, $text);
	}

	return $text;
}

add_filter('the_content', 'rep_all');
add_filter('the_title', 'rep_all');
?>