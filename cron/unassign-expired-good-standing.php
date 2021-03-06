<?php
require('../template/top.php');
require(BASE . '/api/discord/bots/admin.php');

$users = AdminBot::get_all_users();

//var_dump(json_decode($users->result));

$discord_users = json_decode($users->result);
echo "<pre>";
foreach ($discord_users as $key => $val) {
    if (in_array(DISCORD_GOOD_STANDING_ROLE_ID, $val->roles)) {
        $user = $untrobotics->get_user_by_discord_id($val->user->id);
        $is_good_standing = $untrobotics->is_user_in_good_standing($user);
        if (!$is_good_standing) {
            echo $key . ": {$val->user->username}#{$val->user->discriminator} ({$val->user->id}) [{$user['id']}]" . PHP_EOL;
        }
        //echo $untrobotics->get_user_by_discord_id($val->user->id)['id'];
    }
}
?>