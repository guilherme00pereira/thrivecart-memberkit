<?php

?>
<div class="wrap">
    <h1>ThriveCart MemberKit</h1>

    <nav class="nav-tab-wrapper">
        <a href="#tab1" class="nav-tab nav-tab-active">Settings</a>
        <a href="#tab2" class="nav-tab">Logs</a>
    </nav>
    <div id="tab1">
        <h3>Tab 1 Content</h3>
        <form method="post" action="options.php">
            <?php
            settings_fields('thrivecart-memberkit-settings');
            do_settings_sections('thrivecart-memberkit-settings');
            submit_button();
            ?>
        </form>
    </div>
    <div id="tab2">
        <h3>Tab 2 Content</h3>
    </div>

</div>