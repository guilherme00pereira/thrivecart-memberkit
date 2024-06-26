<?php
use G28\ThriveCartMemberKit\Plugin;
?>
<div class="wrap">
    <h1>ThriveCart MemberKit</h1>

    <div id="tcmk-tabs">
        <ul class="nav-tab-wrapper">
            <li>
                <a href="#tab1" class="nav-tab">Integración</a>
            </li>
            <li>
                <a href="#tab2" class="nav-tab">Ajustes</a>
            </li>
            <li>
                <a href="#tab3" class="nav-tab">Logs</a>
            </li>
        </ul>


        <div id="tab1" class="tcmk-tab-content">
            <h3>Gestionar la integración entre los productos ThriveCart y los grupos MemberKit</h3>
            <?php include_once sprintf("%sintegration-partial.php", Plugin::getTemplateDir()); ?>
        </div>


        <div id="tab2" class="tcmk-tab-content">
            <h3>Ajustes </h3>
            <?php include_once sprintf("%ssettings-partial.php", Plugin::getTemplateDir()); ?>
        </div>

        <div id="tab3" class="tcmk-tab-content">
            <h3>Logs</h3>
            <?php include_once sprintf("%slog-partial.php", Plugin::getTemplateDir()); ?>
        </div>


    </div>

</div>