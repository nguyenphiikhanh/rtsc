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

function __get_top_power()
{
    global $config;
    $query = "SELECT name, gender, player.id,
              CASE
                WHEN CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(data_point, ',', 2), ',', -1) AS UNSIGNED) > 500000000000 THEN 500000000000
                ELSE CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(data_point, ',', 2), ',', -1) AS UNSIGNED)
              END AS sm,
              CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(chuyen_sinh, ',', 1), '[', -1) AS UNSIGNED) AS cs,
              pet_power AS dt,
              REPLACE(JSON_UNQUOTE(JSON_EXTRACT(pet_info, '$.name')), '$', '') AS namedt
            FROM player
            INNER JOIN account ON account.id = player.account_id
            WHERE account.is_admin = 0 AND account.ban = 0
            ORDER BY cs DESC, sm DESC, dt DESC
            LIMIT 10;";

    $result = $config->query($query);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $item = $row;
            if ($row['sm'] > 500000000000) {
                $item['sm'] = "500000000000";
            }
            $item['sm_sum'] = $item['sm'] + $item['dt'];
            $data[] = $item;
        }
    }
    return $data;
}

function __get_top_kill_boss()
{
    global $config;
    $query = "SELECT *
                FROM player
                INNER JOIN account ON account.id = player.account_id
                WHERE account.is_admin = 0 AND account.ban = 0 AND player.kill_boss > 0
                ORDER BY player.kill_boss DESC
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