<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>


<div class="componentheading">
	Find a retailer.
</div>

<p>Looking for a retailer near you? Simply enter your zip code and find one closest to you.</p><br><br>
        <p>Enter Zip Code: <input type="text" name="zip" id="zip" />
        <select id="distanceConfig">
        	<option value="10" selected="selected">10 Miles</option>
        	<option value="20">20 Miles</option>
        	<option value="50">50 Miles</option>
        	<option value="100">100 Miles</option>
        </select>
        
        <input type="submit" name="submit" id="submit" value="Search Locations" /><img src="components/com_locateretailers/assets/images/ajax-loader.gif" id="loader" /></p>    
        <div id="map_canvas"></div>
        <div id="results"></div>
        <div id="no"></div>