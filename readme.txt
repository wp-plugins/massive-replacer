=== Plugin Name ===
Contributors: 
Donate link: 
Tags: comments, post, formatting, sidebar
Requires at least: 2.0
Tested up to: 2.5.1
Stable tag: trunk

Massive Replacer lets you replace a string determined by a different.

== Description ==

With Massive Replacer you can replace strings of your posts by other different.
You can, among other things, put in bold text of all articles or replace your letter combinations for various other.

The strings that you want replace are placed in `wp-content/plugin/massive_replacer/replace.txt`.

This file is divided into three parts:

The first one is the text string that you want to replace. By default you find “WordPress”.
To separate the original string from the one that you want to place instead, you must insert a tabulation.
The text string that is going to appear has to be written after this tabulation.

There are a couple of relevant things that you have to be taken into account:
Characters such as accents, blank spaces, and so on have to be replaced by their HTML codes. For instance, a blank space is replaced by "&nbsp;".
This is a bit tiresome but it allows us to add HTML code to a text string, and so allows us to use bold text, underlined, italics, and so on.


== Installation ==

1. Unzip `massive_replacer.zip`
2. Upload `massive_replacer` directory to the 'wp-content/plugins' directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Edit `wp-content/plugins/massive_replacer/replace.txt` to replace strings
5. Enjoy :) !

== Frequently Asked Questions ==

= Why I see strange characters? =

You must replace that characters with their HTML code.

== Screenshots ==

1. Wordpress without Massive Replacer
2. Wordpress with Massive Replacer
3. Installation, first step
4. Installation, second step
5. Installation, third step
6. Editing `replace.txt`