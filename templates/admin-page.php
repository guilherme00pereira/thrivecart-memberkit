<?php

?>
<div class="wrap">
    <h1>ThriveCart MemberKit</h1>

    <div id="tcmk-tabs">
        <ul class="nav-tab-wrapper">
            <li>
                <a href="#tab1" class="nav-tab">Settings</a>
            </li>
            <li>
                <a href="#tab2" class="nav-tab">Logs</a>
            </li>
        </ul>
        <div id="tab1" class="tcmk-tab-content">
            <h3>Tab 1 Content</h3>
            <form method="post" action="options.php">
                <?php
                settings_fields('thrivecart-memberkit-settings');
                do_settings_sections('thrivecart-memberkit-settings');
                submit_button();
                ?>
            </form>
        </div>
        <div id="tab2" class="tcmk-tab-content">
            <h3>Tab 2 Content</h3>
        </div>
    </div>

</div>