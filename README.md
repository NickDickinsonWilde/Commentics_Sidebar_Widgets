Name: Sidebar Widgets
=============

Version:
--------
2.0

Authors:
--------
	Version 1.0: Dev Team
	
	Version 2.0: Nick Wilde\BriarMoon Design


Release History:
----------------
	2013/10/09 version 2.0 Modified into placeable widgets.
	
    2011/11/07 version 1.0 Initial idea, query coding. (as Recent Comments)

Compatible Commentics Versions:
-------------------------------
All

Description:
------------
Provides easily used (and quickly customizable) widgets to display; specifically:
    
	- Most Recent Comments: get_recent()
    
	- Most Commented Pages: get_most_commented()
    
	- Top Posters: get_top_posters()
    
	- Best Rated Pages: get_best_rated()

Status:
-------
Stable

Install:
--------
1. Copy the file sidebar_widgests.php to comments/
2. include the following code where you want to include widgets (calling the right widget of course):
    ```php
    <?php
	
        if (!isset($cmtx_path)) {
		
            $cmtx_path = 'comments/'; //to your true path ofc.
			
            define('IN_COMMENTICS', 'true');
			
        }
		
        include_once "comments/display_functions.php";
		
        echo get_recent(); //or whichever widget you want (see description or source)
		
    ?>
    ```

Uninstall:
----------
1. Remove the code from your site's page(s).

2. Delete sidebar_widgests.php

[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/PacificMorrowind/commentics_sidebar_widgets/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

