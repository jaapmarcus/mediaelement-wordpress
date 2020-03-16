# mediaelement-wordpress
Media Elements plugin for Wordpress 

This version is still in test / development status please do not use yet...

This plugin only modifies the default behaviour of Wordpress.



Due the fact Wordpress uses 2 different methods

Gutenberg Editor / New Style Editor

* Adds Media Elements player as an additional over the video element there for the following options are currently not supported
+ Multiple sources see https://github.com/WordPress/gutenberg/issues/9457 how ever you can change the block as html and then use the default syntax for multiple sources
+ Support for tracks / Closed captions https://github.com/WordPress/gutenberg/issues/7673 or change the html by you self with the normal syntax

The Classic style editor

+ Currently no support for Vimeo. 
+ Due to outside of control of Wordpress multiple renders can be added.
+ In the old plugin you where able to set to disable controls, progress bar and ect currently not posible.

TODO Add support to add adtional plugins / renders
(Vimeo, Vast, IMA, And many more...)

