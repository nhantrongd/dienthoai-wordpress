=== Swift Demo Import ===
Contributors: bnayawpguy
Tags: demo importer, mysticalthemes, widgets, content, import, one click import, content
Requires at least: 5.0
Tested up to: 6.0
Stable tag: 2.0.6
Requires PHP: 5.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Swift Demo Import imports the demo with just single click. It is as easy as that. It also install all the recommended or required plugins and also reset the website.

== Description ==

Swift Demo Import imports the full demo with just one click. It is specially developed to add a demo importer functionality in the theme developed by Mystical Themes but it can also be used by any other themes as well. 

You just need to define the array that includes the location of the demo zip files and other informations. The other information includes name of the demo, preview image, theme option array, menu array, home page and blog page slug(if any), required plugins array and the tags that categorizes the theme.

The demo zip should contain the XML file, customizer (.dat) file, widget (.wie) file, theme option (.json), revolutions slider zip. It is not necessary to add all these files in the demo zip. You can skip the files if your demo does not need it.

<h4>Features</h4>
<ul>
<li>Reset website(Optional)</li>
<li>Install recommended and required plugins automatically</li>
<li>Imports Revolution slider</li>
<li>Imports fully functional demo</li>
</ul>

== Installation ==
The easy way to install the plugin is via WordPress.org plugin directory.

<ol>
<li>Go to WordPress Dashboard > Plugins > Add New</li>
<li>Search for "Swift Demo Import" and install the plugin.</li>
<li>Activate Plugin from "Plugins" menu in WordPress.</li>
</ol>

== Frequently Asked Questions ==

= How to predefine demo imports?  =

An answer to that question.
<code>
<?php
function sdi_import_files_array(){
    return array(
        'demo-slug1' => array( // demo-slug should match the 'external_url' zip file name
            'name' => 'Demo Import One',
            'type' => 'pro', // the value should be either 'free' or 'pro' - default is 'free'
            'buy_url' => 'http://www.your_domain.com/theme-name/', // optional - only if the 'type' is set to 'pro'
            'external_url' => 'http://www.your_domain.com/import/demo-slug1.zip', // zip file should contain content.xml, customizer.dat, widget.wie, option_name1.json, option_name2.json, revslider.zip(exported slider content from revolution slider) - you can skip any of the files if your demo does not need it
            'image' => 'http://www.your_domain.com/import/screenshot.png',
            'preview_url' => 'http://www.your_domain.com/demo-slug',
            'options_array' => array('option_name1','option_name2'), // option_name1.json, option_name2.json file should be included in the zip file
            'menu_array' => array( // list of menus
                'primary' => 'Primary Menu',
                'secondary' => 'Secondary Menu'
            ),
            'plugins' => array( // these plugins will be installed automatically before demo import
                'simple-floating-menu' => array(
                    'name' => 'Simple Floating Menu', // name of the plugin
                    'source' => 'wordpress', // source is either 'wordpress' for plugins in WordPress directory or 'remote' for external stored 
                    'file_path' => 'simple-floating-menu/simple-floating-menu.php' // path of the main file of the plugin
                ),
                'contact-form-7' => array(
                    'name' => 'Contact Form 7',
                    'source' => 'wordpress',
                    'file_path' => 'contact-form-7/wp-contact-form-7.php'
                )
                'revslider' => array(
                    'name' => 'Slider Revolution',
                    'source' => 'remote',
                    'file_path' => 'revslider/revslider.php',
                    'location' => 'http://www.your_domain.com/import/revslider.zip' // if source is 'remote', add the location of the plugin zip
                )
            ),
            'home_slug' => 'home',
            'blog_slug' => 'blog',
            'tags' => array( // Optional - add filter tab on the header to sort the demo by their type
                'magazine' => 'Magazine',
                'business' => 'Business',
                'blog' => 'Blog'
            )
        ),
        'demo-slug2' => array(
            'name' => 'Demo Import Two',
            'external_url' => 'http://www.your_domain.com/import/demo-slug2.zip',
            'image' => 'http://www.your_domain.com/import/screenshot.png',
            'preview_url' => 'http://www.your_domain.com/demo-slug2',
            'menu_array' => array(
                'primary' => 'Primary Menu'
            ),
            'home_slug' => 'home',
            'blog_slug' => 'blog'
        )
    );
}

add_filter( 'sdi_import_files', 'sdi_import_files_array' );
?>
</code>

== Screenshots ==

 
== Changelog ==
= 2.0.6 = 5 June, 2022
* Fixed SVG not importing issue

= 2.0.5 = 25 Jan, 2022
* Meta Store Demos Added

= 2.0.3 =
* Demo importing causing error on long time fixed

= 2.0.2 =
* Added Support for Rezoto Theme

= 2.0.1 =
* Minor Changes

= 2.0.0 =
* Added Support for Resoto and Meta Store Demos

= 1.0.4 =
* Fixed the minor js error
* Fixed the compatibility issue with elementor

= 1.0.3 =
* Added support for svg upload

= 1.0.2 =
* Added Elementor Custom Fonts & Color Import options

= 1.0.1 =
* Fixed menu import issue

= 1.0.0 =
* Initial Release

== Upgrade Notice ==

= 1.0 =
Release