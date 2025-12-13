<?php

require_once __DIR__ . '/../config/config.php';

function __get_top_event()
{
    global $config;
    $query = "SELECT * FROM player
                    INNER JOIN account ON account.id = player.account_id
                    WHERE account.is_admin = 0 AND account.ban = 0 AND player.su_kien_new > 0
                    ORDER BY player.su_kien_new DESC
                    LIMIT 10";

    $result = $config->query($query);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}