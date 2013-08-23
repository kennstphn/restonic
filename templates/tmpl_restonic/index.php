<?php
/**
 * @package     Joomla
 * @subpackage  Restonic2
 * 
 * @copyright   Copyright (c) 2012 - 2013
 * @license GNU General Public License Version 2 or Later
 */

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');

// get some template functions
require_once('templates/' .  $this->template . '/template_function.php');

// check to see if we are home
$page_type = tmpHelper::pageType();

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <jdoc:include type="head" />
</head>

<body class="<?php echo $page_type; ?>">
    <div class="container">
        <div class="container-inner">
            <header class="row-fluid">
                <div class="container">
                    <div class="span3">
                        <a href="<?php echo $this->baseurl; ?>">
                            <img src="<?php echo $this->baseurl . "/templates/" . $this->template . "/images/logo.png" ; ?>" />
                        </a>
                    </div>
                    <div class="span9">
                        <div class="span12">
                            <div class="span2">
                                <jdoc:include type="modules" name="anniversary" style="xhtml" />
                            </div>
                            <div class="offset4 span6">
                                <jdoc:include type="modules" name="search" style="xhtml" />
                                <jdoc:include type="modules" name="social" style="xhtml" />
                            </div>
                        </div>
                        <div class="span12">
                            <div class="navbar">
                                <jdoc:include type="modules" name="top-menu" style="none" />
                            </div>
                            <jdoc:inclyde type="modules" name="breadcrumbs" style="xhtml" />
                        </div>
                    </div>
                </div>
            </header>
            <section class="row-fluid" id="mainbody">
                <div class="container">
                    <aside class="span3">
                        <jdoc:include type="modules" name="sidebar" style="xhtml" />
                    </aside>
                    <div class="span9">
                        <jdoc:include type="message" />
                        <jdoc:include type="component" />
                    </div>
                </div>
            </section>
            <footer class="row-fluid">
                <div class="container">
                    <jdoc:include type="modules" name="footer-menu" style="xhtml" />
                </div>
            </footer>
        </div>
    </div>
</body>
</html>