<div id="top">
    <?php print anchor(base_url(), '<h1>RedBeanPHP Test Application</h1>'); ?>
    <h2>A simple music collection manager</h2>
</div>
<div id="navigation">
    <ul>
        <?php foreach($nav as $key => $tab) : ?>
            <li><?php print anchor('index/' . $tab['mname'], $tab['title'], array('class' => $tab['state'])); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="clear"></div>