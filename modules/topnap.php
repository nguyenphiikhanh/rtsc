<?php
require_once __DIR__ . '/../config/config.php';

function __get_top_nap()
{
    global $config;
    $query = "SELECT player.name, account.tongnap FROM player
                INNER JOIN account ON account.id = player.account_id
                WHERE account.is_admin = 0 AND account.ban = 0 AND account.tongnap > 0
                ORDER BY account.tongnap DESC
                LIMIT 10";

    $result = $config->query($query);
    $data = [];
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'name' => $row['name'],
                'tongnap' => $row['tongnap']
            ];;
        }
    }
    return $data;
}