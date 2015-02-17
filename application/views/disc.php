<?php if($message != '') : ?>
    <div class="message">
        <?php print $message; ?>
    </div>
<?php endif; ?>
<div id="display">
    <?php if($discs['count'] > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th class="ttitle">Title</th>
                    <th class="tname">Artist</th>
                    <th class="tyear">Year</th>
                    <th class="tedit"></th>
                    <th class="tdel"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($discs['discs'] as $disc) : ?>
                    <tr>
                        <td class="ttitle"><?php print $disc->title; ?></td>
                        <td class="tname"><?php print $disc->artist; ?></td>
                        <td class="tyear"><?php print $disc->year; ?></td>
                        <td class="tedit"><?php print anchor('index/updatedisc/' . $disc->id, 'Edit'); ?></td>
                        <td class="tdel"><?php print anchor('index/deletedisc/' . $disc->id, 'Delete'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        No discs found.
    <?php endif; ?>
</div>
<div id="adddisc">
    <?php print anchor('index/adddisc','ADD DISC'); ?>
</div>
<div class="clear"></div>