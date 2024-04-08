<?php
/**
 * @var array $settings
 */

use G28\ThriveCartMemberKit\Plugin;

?>

<div>
    <table class="form-table">
        <tr>
            <th scope="row">ThriveCart API Key</th>
            <td>
                <input type="text" id="thrivecart_api_key" name="thrivecart_api_key"
                       value="<?php echo esc_attr($settings[Plugin::getThrivecartApiKey()]); ?>" style="width: 500px"/>
            </td>
        </tr>
        <tr>
            <th scope="row">MemberKit API Key</th>
            <td>
                <input type="text" id="memberkit_api_key" name="memberkit_api_key"
                       value="<?php echo esc_attr($settings[Plugin::getMemberkitApiKey()]); ?>" style="width: 500px"/>
            </td>
        </tr>
        <tr>
            <th scope="row">MemberKit API URL</th>
            <td>
                <input type="text" id="memberkit_api_url" name="memberkit_api_url"
                       value="<?php echo esc_attr($settings[Plugin::getMemberkitApiUrl()]); ?>" style="width: 500px"/>
            </td>
        </tr>
    </table>
    <div>
        <button id="btn-settings" class="button button-primary">Guardar</button>
        <span id="loading-settings" class="spinner"></span>
    </div>
    <div id="settings-message-container">

    </div>
</div>

