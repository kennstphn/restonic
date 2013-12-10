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

/* if ($page_type == 'home') {
	$doc->addStyleSheet('templates/'.$this->template.'/css/jquery.maximage.min.css');
	$doc->addScript('templates/' . $this->template . '/js/jquery.cycle.all.js');
	$doc->addScript('templates/' . $this->template . '/js/jquery.maximage.js');
}*/
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <jdoc:include type="head" />
</head>

<body class="<?php echo $page_type; ?>">
	<header class="container">
		<section>
			<div class="logo">
				<a href="<?php echo $this->baseurl; ?>">
					<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/<?php echo $params->get('logo', 'light'); ?>-logo.png" />
				</a>
			</div>
			<div class="search-social">
				<div class="search">
					<jdoc:include type="modules" name="search" style="none" />
				</div>
				<div class="social">
					<jdoc:include type="modules" name="social-media" style="none" />
				</div>
			</div>
			<nav>
				<div class="navbar">
					<jdoc:include type="modules" name="top-menu" style="none" />
				</div>
			</nav>
		</section>
	</header>
	<?php if ($this->countModules('main-banner')): ?>
		<section class="main-banner">
			<jdoc:include type="modules" name="main-banner" type="none" />
		</section>
	<?php endif; ?>
	<?php if($page_type != 'home'): // only show mainbody on non-homepage ?>
		<section class="container">
			<div class="main-body-row">
				<?php if ($this->countModules('sidebar')): ?>
					<aside>
						<jdoc:include type="modules" name="sidebar" style="xhtml" />
					</aside>
					<div class="main-body-sidebar">
						<jdoc:include type="message" />
						<jdoc:include type="component" />
					</div>
				<?php else: ?>
					<div class="main-body">
						<jdoc:include type="message" />
						<jdoc:include type="component" />
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>
	<footer>
		<section class="container">
			<?php if ($this->countModules('footer-menu')): ?>
				<jdoc:include type="modules" name="footer-menu" style="xhtml" />
			<?php endif; ?>
			<?php if ($this->countModules('bestbuy') ||$this->countModules('choice')): ?>
				<div class="footer-logos">
					<jdoc:include type="modules" name="bestbuy" style="none" />
					<jdoc:include type="modules" name="choice" style="none" />
				</div>
			<?php endif; ?>
		</section>
	</footer>
</body>
</html>