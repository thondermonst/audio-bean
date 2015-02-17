<div id="subnavigation">
	<ul>
		<?php foreach($subnav as $key => $tab) : ?>
			<li><?php print anchor('index/' . $tab['mname'], $tab['title'], array('class' => $tab['state'])); ?></li>
		<?php endforeach; ?>
	</ul>
</div>
<div id="bottom">
	<?php print anchor('http://tom.vermost.be/', '&copy; 2012  Tom Vermost'); ?>
</div>
<div class="clear"></div>