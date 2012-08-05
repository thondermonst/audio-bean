<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php foreach($meta as $key => $value) : ?>
        <meta name="<?php print $key; ?>" content="<?php print $value; ?>" />
    <?php endforeach; ?>
    <link rel="icon" href="<?php print base_url(); ?>img/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?php print base_url(); ?>img/favicon.ico" type="image/x-icon"/> 
    <?php foreach($css as $stylesheet) : ?>
        <link href="<?php print base_url() . 'css/' . $stylesheet; ?>" rel="stylesheet" type="text/css" />
    <?php endforeach; ?>
    <?php foreach($js as $script) : ?>
        <?php if(substr($script, 0, 7) == 'http://') : ?>
            <script src="<?php print $script; ?>" type="text/javascript"></script>
        <?php else : ?>
            <script src="<?php print base_url() . 'js/' . $script; ?>" type="text/javascript"></script>
        <?php endif; ?>
    <?php endforeach; ?>
    <title><?php print $page_title . ' | ' . $site_name; ?></title>
    <script type="text/javascript">
        base_url = "<?php print base_url(); ?>";
    </script>
</head>
<body>
    <div id="container">
        <div id="header">
            <?php echo $header; ?>
        </div>
        <div id="main">
            <div class="title"><?php print $page_title; ?></div>
            <?php echo $full; ?>
        </div>
        <div id="footer">
            <?php echo $footer; ?>
        </div>
        <div class="clear"></div>
    </div>
</body>
</html>