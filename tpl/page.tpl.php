<?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
<?php print render($page['help']); ?>
<?php print $messages; ?>
<?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

	<div class="container">
	 	
	 	<main id="main" role="main">
		
			<a id="main-content"></a>
			<nav class="breadcrumb">
		  		<?php echo $breadcrumb; ?>
			</nav>
			<?php if(!$is_front): ?>
			<h1><?php echo $title; ?></h1>
			<?php endif; ?>
			<?php echo render($page['content']); ?>

			
		</main>

		
	</div>

	<footer id="footer" role="contentinfo" class="">
	    	    
		<ul class="list-inline">
			<li><a href="/contact">Contact</a></li>
			<li><?php echo l('Mentions légales', 'node/69'); ?></li>
			<li>&copy; CNRS <?php echo date('Y'); ?></li>
		</ul>
	
	</footer>

	<a href="#" class="cd-top"><?php echo t('Back to top'); ?></a>