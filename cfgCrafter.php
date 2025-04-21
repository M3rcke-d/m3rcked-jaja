<?php
$defaultKeys = [
    // Movement
    'duck' => 'ctrl',
    'jump' => 'space',
    'speed' => 'shift',
    'use' => 'e',
    'lookatweapon' => 'f',
    
    // Combat
    'attack' => 'mouse1',
    'attack2' => 'mouse2',
    'reload' => 'r',
    'drop' => 'g',

    
    // Weapon Slots
    'slot1' => '1',
    'slot2' => '2',
    'slot3' => '3',
    'slot4' => '4',
    'slot5' => '5',
    'slot6' => '6',
    'slot7' => '7',
    'slot8' => '8',
	
    'slot10' => '0',

    
    // Inventory
    'invnext' => 'wheeldown',
    'invprev' => 'wheelup',
    'lastinv' => 'q',
    
    // Communication
    'messagemode' => 'y',
    'messagemode2' => 'u',
    'voicerecord' => 'v',
    
    // UI
    'score' => 'tab',
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Map form data to Python API structure
    $payload = [];
    // Movement
    if (!empty($_POST['include_movement'])) {
        $val = sanitizeKey($_POST['duck'] ?? '');
        if ($val !== '') $payload['duck'] = $val;
        $val = sanitizeKey($_POST['jump'] ?? '');
        if ($val !== '') $payload['jump'] = $val;
        $val = sanitizeKey($_POST['speed'] ?? '');
        if ($val !== '') $payload['speed'] = $val;
        $val = sanitizeKey($_POST['use'] ?? '');
        if ($val !== '') $payload['use'] = $val;
        $val = sanitizeKey($_POST['lookatweapon'] ?? '');
        if ($val !== '') $payload['lookatweapon'] = $val;
        $val = sanitizeKey($_POST['score'] ?? '');
        if ($val !== '') $payload['score'] = $val;
        // Include mwheelup/down if any (no direct inputs in form)
        $val = sanitizeKey($_POST['mwheelup'] ?? '');
        if ($val !== '') $payload['mwheelup'] = $val;
        $val = sanitizeKey($_POST['mwheeldown'] ?? '');
        if ($val !== '') $payload['mwheeldown'] = $val;
    }
    // Combat
    if (!empty($_POST['include_combat'])) {
        $val = sanitizeKey($_POST['attack'] ?? '');
        if ($val !== '') $payload['attack'] = $val;
        $val = sanitizeKey($_POST['attack2'] ?? '');
        if ($val !== '') $payload['attack2'] = $val;
        $val = sanitizeKey($_POST['reload'] ?? '');
        if ($val !== '') $payload['reload'] = $val;
        $val = sanitizeKey($_POST['drop'] ?? '');
        if ($val !== '') $payload['drop'] = $val;
        $val = sanitizeKey($_POST['use_action_slot_item'] ?? '');
        if ($val !== '') $payload['use_action_slot_item'] = $val;
    }
    // Weapon Slots (1-13 + Inventory)
    if (!empty($_POST['include_weaponslots'])) {
        for ($i = 1; $i <= 13; $i++) {
            $name = 'slot' . $i;
            $val = sanitizeKey($_POST[$name] ?? '');
            if ($val !== '') $payload[$name] = $val;
        }
        $val = sanitizeKey($_POST['invnext'] ?? '');
        if ($val !== '') $payload['invnext'] = $val;
        $val = sanitizeKey($_POST['invprev'] ?? '');
        if ($val !== '') $payload['invprev'] = $val;
        $val = sanitizeKey($_POST['lastinv'] ?? '');
        if ($val !== '') $payload['lastinv'] = $val;
    }
    // Communication
    if (!empty($_POST['include_communication'])) {
        $val = sanitizeKey($_POST['messagemode'] ?? '');
        if ($val !== '') $payload['messagemode'] = $val;
        $val = sanitizeKey($_POST['messagemode2'] ?? '');
        if ($val !== '') $payload['messagemode2'] = $val;
        $val = sanitizeKey($_POST['voicerecord'] ?? '');
        if ($val !== '') $payload['voicerecord'] = $val;
    }
    // HUD settings
    if (!empty($_POST['include_hud'])) {
        if (isset($_POST['hud_playercount']) && $_POST['hud_playercount'] !== '') {
            $payload['cl_hud_playercount_showcount'] = (int)$_POST['hud_playercount'];
        }
        if (isset($_POST['hud_scale']) && $_POST['hud_scale'] !== '') {
            $payload['cl_hud_scale'] = (float)$_POST['hud_scale'];
        }
        if (isset($_POST['hud_color']) && $_POST['hud_color'] !== '') {
            $payload['cl_hud_color'] = (int)$_POST['hud_color'];
        }
    }
    // Radar Settings
    if (!empty($_POST['include_radar'])) {
        if (isset($_POST['cl_radar_always_centered']) && $_POST['cl_radar_always_centered'] !== '') {
            $payload['cl_radar_always_centered'] = (int)$_POST['cl_radar_always_centered'];
        }
        if (isset($_POST['cl_radar_rotate']) && $_POST['cl_radar_rotate'] !== '') {
            $payload['cl_radar_rotate'] = (int)$_POST['cl_radar_rotate'];
        }
        if (isset($_POST['cl_radar_scale']) && $_POST['cl_radar_scale'] !== '') {
            $payload['cl_radar_scale'] = (float)$_POST['cl_radar_scale'];
        }
        if (isset($_POST['cl_radar_icon_scale_min']) && $_POST['cl_radar_icon_scale_min'] !== '') {
            $payload['cl_radar_icon_scale_min'] = (float)$_POST['cl_radar_icon_scale_min'];
        }
        if (isset($_POST['cl_radar_square_with_scoreboard']) && $_POST['cl_radar_square_with_scoreboard'] !== '') {
            $payload['cl_radar_square_with_scoreboard'] = (int)$_POST['cl_radar_square_with_scoreboard'];
        }
    }
    // Viewmodel Settings
    if (!empty($_POST['include_viewmodel'])) {
        if (isset($_POST['cl_righthand']) && $_POST['cl_righthand'] !== '') {
            $payload['cl_righthand'] = (int)$_POST['cl_righthand'];
        }
        if (isset($_POST['viewmodel_fov']) && $_POST['viewmodel_fov'] !== '') {
            $payload['viewmodel_fov'] = (int)$_POST['viewmodel_fov'];
        }
        if (isset($_POST['viewmodel_offset_x']) && $_POST['viewmodel_offset_x'] !== '') {
            $payload['viewmodel_offset_x'] = (float)$_POST['viewmodel_offset_x'];
        }
        if (isset($_POST['viewmodel_offset_y']) && $_POST['viewmodel_offset_y'] !== '') {
            $payload['viewmodel_offset_y'] = (float)$_POST['viewmodel_offset_y'];
        }
        if (isset($_POST['viewmodel_offset_z']) && $_POST['viewmodel_offset_z'] !== '') {
            $payload['viewmodel_offset_z'] = (float)$_POST['viewmodel_offset_z'];
        }
    }
    // Crosshair Settings
    if (!empty($_POST['include_crosshair'])) {
        if (isset($_POST['cl_crosshairalpha']) && $_POST['cl_crosshairalpha'] !== '') {
            $payload['cl_crosshairalpha'] = (int)($_POST['cl_crosshairalpha'] ?? 200);
        }
        if (isset($_POST['cl_crosshaircolor']) && $_POST['cl_crosshaircolor'] !== '') {
            $payload['cl_crosshaircolor'] = (int)($_POST['cl_crosshaircolor'] ?? 0);
        }
        if (isset($_POST['cl_crosshairdot']) && $_POST['cl_crosshairdot'] !== '') {
            $payload['cl_crosshairdot'] = (int)($_POST['cl_crosshairdot'] ?? 0);
        }
        if (isset($_POST['cl_crosshairoutline']) && $_POST['cl_crosshairoutline'] !== '') {
            $payload['cl_crosshairoutline'] = (int)($_POST['cl_crosshairoutline'] ?? 0);
        }
        if (isset($_POST['cl_crosshair_outline_thickness']) && $_POST['cl_crosshair_outline_thickness'] !== '') {
            $payload['cl_crosshair_outline_thickness'] = (float)($_POST['cl_crosshair_outline_thickness'] ?? 0.5);
        }
        if (isset($_POST['cl_crosshairstyle']) && $_POST['cl_crosshairstyle'] !== '') {
            $payload['cl_crosshairstyle'] = (int)($_POST['cl_crosshairstyle'] ?? 4);
        }
        if (isset($_POST['cl_crosshairsize']) && $_POST['cl_crosshairsize'] !== '') {
            $payload['cl_crosshairsize'] = (float)($_POST['cl_crosshairsize'] ?? 2.0);
        }
        if (isset($_POST['cl_crosshairgap']) && $_POST['cl_crosshairgap'] !== '') {
            $payload['cl_crosshairgap'] = (float)($_POST['cl_crosshairgap'] ?? 0);
        }
        if (isset($_POST['cl_crosshairthickness']) && $_POST['cl_crosshairthickness'] !== '') {
            $payload['cl_crosshairthickness'] = (float)($_POST['cl_crosshairthickness'] ?? 1.0);
        }
        if (isset($_POST['cl_crosshair_recoil']) && $_POST['cl_crosshair_recoil'] !== '') {
            $payload['cl_crosshair_recoil'] = (int)($_POST['cl_crosshair_recoil'] ?? 0);
        }
        if (isset($_POST['cl_crosshair_deployed_weapon_gap']) && $_POST['cl_crosshair_deployed_weapon_gap'] !== '') {
            $payload['cl_crosshair_deployed_weapon_gap'] = (int)($_POST['cl_crosshair_deployed_weapon_gap'] ?? 0);
        }
        if (isset($_POST['cl_crosshair_sniper_width']) && $_POST['cl_crosshair_sniper_width'] !== '') {
            $payload['cl_crosshair_sniper_width'] = (int)($_POST['cl_crosshair_sniper_width'] ?? 1);
        }
    }
    // Mouse Settings
    if (!empty($_POST['include_mouse'])) {
        if (isset($_POST['sensitivity']) && $_POST['sensitivity'] !== '') {
            $payload['sensitivity'] = (float)$_POST['sensitivity'];
        }
        if (isset($_POST['zoom_sensitivity']) && $_POST['zoom_sensitivity'] !== '') {
            $payload['zoom_sensitivity_ratio_mouse'] = (float)$_POST['zoom_sensitivity'];
        }
    }
    // Network & Performance
    if (!empty($_POST['include_network'])) {
        if (isset($_POST['cl_showfps']) && $_POST['cl_showfps'] !== '') {
            $payload['cl_showfps'] = (int)$_POST['cl_showfps'];
        }
        if (isset($_POST['net_graph']) && $_POST['net_graph'] !== '') {
            $payload['net_graph'] = (int)$_POST['net_graph'];
        }
        if (isset($_POST['fps_max']) && $_POST['fps_max'] !== '') {
            $payload['fps_max'] = (int)$_POST['fps_max'];
        }
        if (isset($_POST['mm_session_max_ping']) && $_POST['mm_session_max_ping'] !== '') {
            $payload['mm_session_max_ping'] = (int)$_POST['mm_session_max_ping'];
        }
    }
    // Damage Feedback
    if (!empty($_POST['include_damage'])) {
        if (isset($_POST['cl_damage_feedback_show']) && $_POST['cl_damage_feedback_show'] !== '') {
            $payload['cl_damage_feedback_show'] = (int)$_POST['cl_damage_feedback_show'];
        }
        if (isset($_POST['cl_damage_feedback_show_head']) && $_POST['cl_damage_feedback_show_head'] !== '') {
            $payload['cl_damage_feedback_show_head'] = (int)$_POST['cl_damage_feedback_show_head'];
        }
    }
    // Generate config output for preview or use
    $keybindCommands = [
    'jump', 'duck', 'use', 'speed', 'lookatweapon',
    'attack', 'attack2', 'reload', 'drop', 'use_action_slot_item',
    'slot1', 'slot2', 'slot3', 'slot4', 'slot5', 'slot6', 'slot7',
    'slot8', 'slot9', 'slot10', 'slot11', 'slot12', 'slot13',
    'invnext', 'invprev', 'lastinv',
    'messagemode', 'messagemode2', 'voicerecord',
    'score'
];

$generatedConfig = '';
foreach ($payload as $key => $value) {
    if (!empty($value)) {
        if (in_array($key, $keybindCommands)) {
            $generatedConfig .= "bind \"$value\" \"$key\"\n";
        } else {
            $generatedConfig .= "$key $value\n";
        }
    }
}

}

function sanitizeKey($key) {
    return strtolower(preg_replace('/[^a-z0-9_]/i', '', $key));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CS2 Config Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
            background-color: grey;
        }
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        fieldset {
            padding: 1rem;
            border: 1px solid #ddd;
            background: #f9f9f9;
            border-radius: 5px;
        }
        legend {
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 0.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
        }
        .keybind {
            width: 120px;
            padding: 5px;
            margin-left: 5px;
            cursor: pointer;
            background: #f8f8f8;
        }
        input[type="number"],
        select {
            padding: 4px;
            width: 80px;
            margin-left: 5px;
        }
        .active {
            border: 2px solid #2196F3 !important;
        }
        .toggle-group {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .toggle-group input[type="checkbox"] {
            margin-right: 0.5rem;
        }
        .clear-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 0.9em;
            line-height: 1;
            margin-left: 5px;
        }
        input[type="submit"] {
            grid-column: span 2;
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>CS2 Configuration Generator</h1>
    <button type="button" id="previewButton">Show Config Preview</button>
    <h3>Config Preview:</h3>
    <textarea id="configPreview" rows="10" cols="100" readonly><?php if(isset($generatedConfig)) echo htmlspecialchars($generatedConfig); ?></textarea>
    <br>
    <form method="post">
        <!-- Movement Section -->
        <fieldset>
            <legend>Movement</legend>
            <label class="toggle-group"><input type="checkbox" name="include_movement" checked>Include in Config</label>
            <label>Duck: <input type="text" class="keybind" name="duck" readonly> <button type="button" class="clear-btn">❌</button></label>
            <label>Jump: <input type="text" class="keybind" name="jump" readonly> <button type="button" class="clear-btn">❌</button></label>
            <label>Walk: <input type="text" class="keybind" name="speed" readonly> <button type="button" class="clear-btn">❌</button></label>
            <label>Use: <input type="text" class="keybind" name="use" readonly> <button type="button" class="clear-btn">❌</button></label>
            <label>Inspect Weapon: <input type="text" class="keybind" name="lookatweapon" readonly> <button type="button" class="clear-btn">❌</button></label>
            <label>Show scoreboard: <input type="text" class="keybind" name="score" readonly> <button type="button" class="clear-btn">❌</button></label>
        </fieldset>
        <!-- Combat Section -->
        <fieldset>
            <legend>Combat</legend>
            <label class="toggle-group"><input type="checkbox" name="include_combat" checked>Include in Config</label>
            <label>Attack: <input type="text" class="keybind" name="attack" readonly> <button type="button" class="clear-btn">❌</button></label>
            <label>Alt Attack: <input type="text" class="keybind" name="attack2" readonly> <button type="button" class="clear-btn">❌</button></label>
            <label>Reload: <input type="text" class="keybind" name="reload" readonly> <button type="button" class="clear-btn">❌</button></label>
            <label>Drop: <input type="text" class="keybind" name="drop" readonly> <button type="button" class="clear-btn">❌</button></label>
            <label>Use Slot Item: <input type="text" class="keybind" name="use_action_slot_item" readonly> <button type="button" class="clear-btn">❌</button></label>
        </fieldset>
        <!-- Weapon Slots -->
        <fieldset>
            <legend>Weapon Slots</legend>
            <label class="toggle-group"><input type="checkbox" name="include_weaponslots" checked>Include in Config</label>
            <div style="display: flex; gap: 2rem;">
                <div>
                    <label>Primary (Slot 1): <input type="text" class="keybind" name="slot1" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Secondary (Slot 2): <input type="text" class="keybind" name="slot2" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Melee (Slot 3): <input type="text" class="keybind" name="slot3" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Cycle (Slot 4): <input type="text" class="keybind" name="slot4" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Bomb (Slot 5): <input type="text" class="keybind" name="slot5" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>HE Grenade (Slot 6): <input type="text" class="keybind" name="slot6" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Flashbang (Slot 7): <input type="text" class="keybind" name="slot7" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                </div>
                <div>
                    <label>Smoke (Slot 8): <input type="text" class="keybind" name="slot8" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Decoy (Slot 9): <input type="text" class="keybind" name="slot9" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Molotov (Slot 10): <input type="text" class="keybind" name="slot10" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Zeus x27 (Slot 11): <input type="text" class="keybind" name="slot11" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Healthshot (Slot 12): <input type="text" class="keybind" name="slot12" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Utility Items (Slot 13): <input type="text" class="keybind" name="slot13" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Next Item: <input type="text" class="keybind" name="invnext" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Previous Item: <input type="text" class="keybind" name="invprev" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                    <label>Last Item: <input type="text" class="keybind" name="lastinv" readonly> <button type="button" class="clear-btn">❌</button></label><br>
                </div>
            </div>
        </fieldset>
        <!-- Communication Section -->
        <fieldset>
            <legend>Communication</legend>
            <label class="toggle-group"><input type="checkbox" name="include_communication" checked>Include in Config</label>
            <label>All Chat: <input type="text" class="keybind" name="messagemode" readonly> <button type="button" class="clear-btn">❌</button></label>
            <label>Team Chat: <input type="text" class="keybind" name="messagemode2" readonly> <button type="button" class="clear-btn">❌</button></label>
            <label>Voice Chat: <input type="text" class="keybind" name="voicerecord" readonly> <button type="button" class="clear-btn">❌</button></label>
        </fieldset>
        <!-- HUD Settings -->
        <fieldset>
            <legend>HUD Settings</legend>
            <label class="toggle-group"><input type="checkbox" name="include_hud" checked>Include in Config</label>
            <label>Show Player Count:
                <select name="hud_playercount">
                    <option value="1" selected>Yes</option>
                    <option value="0">No</option>
                </select>
            </label>
            <label>HUD Scale:
                <input type="number" name="hud_scale" min="0.5" max="1.5" step="0.1" value="1.0">
            </label>
            <label>HUD Color:
                <select name="hud_color">
                    <?php for ($c = 0; $c <= 5; $c++): ?>
                        <option value="<?= $c ?>">Color <?= $c ?></option>
                    <?php endfor; ?>
                </select>
            </label>
        </fieldset>
        <!-- Radar Settings -->
        <fieldset>
            <legend>Radar Settings</legend>
            <label class="toggle-group"><input type="checkbox" name="include_radar" checked>Include in Config</label>
            <label>Always Centered:
                <select name="cl_radar_always_centered">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </label>
            <label>Rotate:
                <select name="cl_radar_rotate">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </label>
            <label>Scale: <input type="number" name="cl_radar_scale" step="0.05" min="0.25" max="1.0" value="0.7"></label>
            <label>Icon Scale Min: <input type="number" name="cl_radar_icon_scale_min" step="0.05" min="0.4" max="1.25" value="0.6"></label>
            <label>Square with Scoreboard:
                <select name="cl_radar_square_with_scoreboard">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </label>
        </fieldset>
        <!-- Crosshair Settings -->
        <fieldset>
            <legend>Crosshair</legend>
            <label class="toggle-group"><input type="checkbox" name="include_crosshair" checked>Include in Config</label>
            <label>Alpha: <input type="number" name="cl_crosshairalpha" min="0" max="255" value="200"></label>
            <label>Color:
                <select name="cl_crosshaircolor">
                    <?php for ($c = 0; $c <= 5; $c++) echo "<option value='$c'>$c</option>"; ?>
                </select>
            </label>
            <label>Dot:
                <select name="cl_crosshairdot">
                    <option value="0">Off</option>
                    <option value="1">On</option>
                </select>
            </label>
            <label>Outline:
                <select name="cl_crosshairoutline">
                    <option value="0">Off</option>
                    <option value="1">On</option>
                </select>
            </label>
            <label>Outline Thickness: <input type="number" name="cl_crosshair_outline_thickness" min="0.1" max="3" step="0.1" value="0.5"></label>
            <label>Style:
                <select name="cl_crosshairstyle">
                    <?php for ($s = 0; $s <= 6; $s++) echo "<option value='$s'>$s</option>"; ?>
                </select>
            </label>
            <label>Size: <input type="number" name="cl_crosshairsize" min="0.1" max="5.0" step="0.1" value="2.0"></label>
            <label>Gap: <input type="number" name="cl_crosshairgap" min="-10" max="10" step="0.5" value="0"></label>
            <label>Thickness: <input type="number" name="cl_crosshairthickness" min="0.1" max="3.0" step="0.1" value="1.0"></label>
            <label>Recoil Follow:
                <select name="cl_crosshair_recoil">
                    <option value="0">Off</option>
                    <option value="1">On</option>
                </select>
            </label>
            <label>Weapon Gap:
                <select name="cl_crosshair_deployed_weapon_gap">
                    <option value="0">Off</option>
                    <option value="1">On</option>
                </select>
            </label>
            <label>Sniper Width: <input type="number" name="cl_crosshair_sniper_width" min="1" max="8" value="1"></label>
        </fieldset>
        <!-- Mouse Settings -->
        <fieldset>
            <legend>Mouse</legend>
            <label class="toggle-group"><input type="checkbox" name="include_mouse" checked>Include in Config</label>
            <label>Sensitivity: <input type="number" name="sensitivity" step="0.01" value="1.0"></label>
            <label>Zoom Sensitivity: <input type="number" name="zoom_sensitivity" step="0.01" value="1.0"></label>
        </fieldset>
        <!-- Viewmodel Settings -->
        <fieldset>
            <legend>Viewmodel</legend>
            <label class="toggle-group"><input type="checkbox" name="include_viewmodel" checked>Include in Config</label>
            <label>Right Hand:
                <select name="cl_righthand">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </label>
            <label>FOV: <input type="number" name="viewmodel_fov" min="54" max="68" value="60"></label>
            <label>Offset X: <input type="number" name="viewmodel_offset_x" step="0.1" min="-2" max="2.5" value="1.0"></label>
            <label>Offset Y: <input type="number" name="viewmodel_offset_y" step="0.1" min="-2" max="2" value="1.0"></label>
            <label>Offset Z: <input type="number" name="viewmodel_offset_z" step="0.1" min="-2" max="2" value="-1.5"></label>
        </fieldset>
        <!-- Network & Performance -->
        <fieldset>
            <legend>Network & Performance</legend>
            <label class="toggle-group"><input type="checkbox" name="include_network" checked>Include in Config</label>
            <label>Show FPS:
                <select name="cl_showfps">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </label>
            <label>Net Graph:
                <select name="net_graph">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </label>
            <label>FPS Max: <input type="number" name="fps_max" min="0" max="1000" value="400"></label>
            <label>Max Ping: <input type="number" name="mm_session_max_ping" min="50" max="350" value="350"></label>
        </fieldset>
        <!-- Damage Feedback -->
        <fieldset>
            <legend>Damage Feedback</legend>
            <label class="toggle-group"><input type="checkbox" name="include_damage" checked>Include in Config</label>
            <label>Show Body Damage:
                <select name="cl_damage_feedback_show">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </label>
            <label>Show Headshots:
                <select name="cl_damage_feedback_show_head">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </label>
        </fieldset>
        <input type="submit" value="Generate Config">
    </form>
    <script>
        // Prevent M4/M5 default behavior
        document.addEventListener('mousedown', function(e) {
            if (e.button === 3 || e.button === 4) {
                e.preventDefault();
            }
        });
        // Lock browser back navigation
        window.addEventListener('popstate', function(e) {
            history.pushState(null, '', window.location.href);
        });
        window.addEventListener('load', function() {
            history.pushState(null, '', window.location.href);
        });
        // Set default keybind values from PHP
        document.addEventListener('DOMContentLoaded', function() {
            <?php foreach ($defaultKeys as $name => $value): ?>
                if (document.querySelector('[name="<?= $name ?>"]')) {
                    document.querySelector('[name="<?= $name ?>"]').value = '<?= $value ?>';
                }
            <?php endforeach; ?>
        });
        let activeInput = null;
        // Input activation
        document.querySelectorAll('.keybind').forEach(input => {
            input.addEventListener('click', () => {
                if (activeInput) activeInput.classList.remove('active');
                activeInput = input;
                input.value = '';
                input.classList.add('active');
            });
        });
        // Keyboard binding
        document.addEventListener('keydown', e => {
            if (!activeInput) return;
            e.preventDefault();
            const keyMap = {
                'ShiftLeft': 'shift', 'ShiftRight': 'rshift',
                'ControlLeft': 'ctrl', 'ControlRight': 'rctrl',
                'AltLeft': 'alt', 'AltRight': 'ralt',
                'Space': 'space', 'Escape': 'escape'
            };
            let key = keyMap[e.code] || e.code.replace(/Key|Digit|Numpad/, '').toLowerCase();
            if (/^Digit\d$/.test(e.code)) key = e.code.slice(-1);
            if (/^Numpad\d$/.test(e.code)) key = `kp_${e.code.slice(-1)}`;
            activeInput.value = key;
            activeInput.classList.remove('active');
            activeInput = null;
        });
        // Mouse buttons
        document.addEventListener('mousedown', e => {
            if (!activeInput) return;
            const buttons = ['mouse1', 'mouse2', 'mouse3', 'mouse4', 'mouse5'];
            activeInput.value = buttons[e.button] || `mouse${e.button + 1}`;
            activeInput.classList.remove('active');
            activeInput = null;
        });
        // Mouse wheel input
        document.addEventListener('wheel', e => {
            if (!activeInput) return;
            const direction = e.deltaY < 0 ? 'wheelup' : 'wheeldown';
            activeInput.value = direction;
            activeInput.classList.remove('active');
            activeInput = null;
        });
        // Clear button functionality
        document.querySelectorAll('.clear-btn').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                const input = btn.previousElementSibling;
                if (input && input.tagName === 'INPUT') {
                    input.value = '';
                    if (input.classList.contains('active')) {
                        input.classList.remove('active');
                        activeInput = null;
                    }
                }
            });
        });
        // Config Preview Handler
        document.getElementById('previewButton').addEventListener('click', function () {
            const form = document.querySelector('form');
            const formData = new FormData(form);
            formData.append('preview', '1');
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(text => {
                document.getElementById('configPreview').value = text;
            });
        });
    </script>
</body>
</html>
