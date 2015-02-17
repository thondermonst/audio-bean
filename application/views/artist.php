<?php if($message != '') : ?>
    <div class="message">
        <?php print $message; ?>
    </div>
<?php endif; ?>
<div id="display">
    <?php if($artists['count'] > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th class="tname">Artist name</th>
                    <th class="tedit"></th>
                    <th class="tdel"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($artists['artists'] as $artist) : ?>
                    <tr>
                        <td class="tname"><?php print $artist->name; ?></td>
                        <td class="tedit"><?php print anchor('index/updateartist/' . $artist->id, 'Edit'); ?></td>
                        <td class="tdel"><?php print anchor('index/deleteartist/' . $artist->id, 'Delete'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        No artists found.
    <?php endif; ?>
</div>
<div id="addartist">
    <?php print anchor('index/addartist','ADD ARTIST'); ?>
</div>
<div class="clear"></div>