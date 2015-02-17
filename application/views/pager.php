<?php if(count($pager) > 1) : ?>
<div id="pager">
    <ul>
    <?php foreach($pager as $item) : ?>
        <li><?php print anchor($item['link'], $item['display'], array('class' => $item['status'])); ?></li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>