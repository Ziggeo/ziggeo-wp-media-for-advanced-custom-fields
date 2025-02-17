=== Ziggeo Media for Advanced Custom Fields ===
Contributors: oliverfriedmann, baned
Tags: ziggeo, video, video field, advanced custom fields, video form, acf
Requires at least: 3.0.1
Tested up to: 6.7.2
Stable tag: 1.1
Requires PHP: 5.2.4
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

This plugin brings video player and recorder (including screen recording) to your Advanced Custom Fields (ACF) by utilizing the powerful and award winning Ziggeo for video.

Please note that you need to install and setup [Ziggeo plugin](https://wordpress.org/plugins/ziggeo/) first. This plugin is offered as an extension of the same.
You will also need the [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) plugin.

== Who is this for? ==

Are you using ACF to create setups and workflows you usually could not?
Need a way to capture different types of media?
Want to show video where you otherwise would not be able to?

If any of that sounds like your story, then this is the right plugin for you.

= Benefits =

Allows you to quickly add videos to your ACF setups and workflows.
Simple integration of Ziggeo to your Advanced Custom Fields.
Add player, recorder, screen recorder and more to your ACF
Native integration, clean imlpementation and great support

== Screenshots ==

1. Add Group - Add Fields within Group
2. New Field - Available Ziggeo Field types 

== Installation ==
 
1. Upload plugin zip file to your plugins directory. Usually that would be to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. That is it or
1. Use the Plugins Add new section to find the plugin and install
 
== Frequently Asked Questions ==

= How does it work? =

This plugin will provide you with the Ziggeo Fields section within the Advanced Custom Fields. Once you open it, it will reveal all of the different types of fields that we support.

By few simple steps you can quickly add multimedia to your forms.

= Where does integration happen? =

Integration happens within your website. All the data you gather will still be available to you in same panels and integrations as before.

As always we will host multimedia that is captured within your Ziggeo account and link to the same will be used as a submitted value within your ACF forms.

= How can I get some support =

We provide active support to all that have any questions or need any assistance with our plugin or our service.
To submit your questions simply go to our [Help Center](https://support.ziggeo.com/hc/en-us). Alternatively just send us an email to [support@ziggeo.com](mailto:support@ziggeo.com).

= I have an idea or suggestion =

Please go to our [WordPress forum](https://support.ziggeo.com/hc/en-us/community/topics/200753347-WordPress-plugin) and add your suggestion within it. This allows everyone to see and vote on it and us to determine what should be next.

== Upgrade Notice ==

= 1.1 =
* Improvement: Updated to support lazyload feature of Ziggeo core plugin
* Improvement: Added support for template v2
* Fix: Fixed a typo in the recorder code
* Improvement: Made sure that during template parsing by ACF bridge plugin we do not assume everything is Ziggeo embedding, and consider that something might be a videowall or otherwise.

== Changelog ==

= 1.0 =
* Initial commit
