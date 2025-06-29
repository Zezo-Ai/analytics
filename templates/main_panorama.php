<?php
/**
 * Analytics
 *
 * SPDX-FileCopyrightText: 2019-2022 Marcel Scherello
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

use OCP\Util;

Util::addStyle('analytics', 'style');
Util::addStyle('analytics', 'sharetabview');
Util::addStyle('analytics', '3rdParty/datatables.min');
Util::addStyle('files_sharing', 'icons');
Util::addStyle('analytics', 'wizard');
Util::addStyle('analytics', 'print');
Util::addStyle('analytics', 'dashboard');
Util::addScript('analytics', 'visualization');
Util::addScript('analytics', 'navigation');
Util::addScript('analytics', 'sidebar');
Util::addScript('analytics', '3rdParty/datatables.min');
Util::addScript('analytics', '3rdParty/chart.umd');
Util::addScript('analytics', '3rdParty/chartjs-plugin-funnel.min');
Util::addScript('analytics', '3rdParty/chartjs-adapter-moment');
Util::addScript('analytics', '3rdParty/chartjs-plugin-datalabels.min');
Util::addScript('analytics', '3rdParty/chartjs-plugin-zoom.min');
Util::addScript('analytics', '3rdParty/moment.min');
Util::addScript('analytics', '3rdParty/cloner');
Util::addScript('analytics', 'userGuidance');
Util::addScript('analytics', '3rdParty/jspdf.umd.min');
Util::addScript('analytics', '3rdParty/html2canvas.min');
Util::addScript('analytics', 'panorama');
?>

<div id="app-navigation">
    <?php print_unescaped($this->inc('part.navigation')); ?>
    <?php print_unescaped($this->inc('part.settings')); ?>
</div>

<div id="app-content">panorama old
    <div id="loading">
        <i class="ioc-spinner ioc-spin"></i>
    </div>

    <?php print_unescaped($this->inc('part.intro')); ?>
    <?php print_unescaped($this->inc('part.content_panorama')); ?>

    <div id="analytics-warning" style="width:50%; padding: 50px">
        <h2><?php p($l->t('Analytics')); ?></h2>
        <br>
        <h3><?php p($l->t('Javascript issue')); ?></h3>
        <span><?php p($l->t('If you see this message, please disable AdBlock/uBlock for this domain (only).')); ?></span>
        <br>
        <span><?php p($l->t('The EasyPrivacy list is blocking some scripts because of a wildcard filter for *analytics*.')); ?></span>
        <br>
        <br>
        <a href="https://github.com/Rello/analytics/wiki/EasyPrivacy-Blocklist"
           target="_blank"><?php p($l->t('More Information …')); ?></a>
    </div>
</div>
<?php print_unescaped($this->inc('part.sidebar')); ?>
<div>
    <?php print_unescaped($this->inc('part.templates')); ?>
	<?php print_unescaped($this->inc('wizard')); ?>
</div>
