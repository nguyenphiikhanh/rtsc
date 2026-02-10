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
    $query = "SELECT name, gender, player.id, CapCS_SuPhu, CapCS_DeTu,
              CASE
                WHEN CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(data_point, ',', 2), ',', -1) AS UNSIGNED) > 500000000000 THEN 500000000000
                ELSE CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(data_point, ',', 2), ',', -1) AS UNSIGNED)
              END AS sm,
              REPLACE(JSON_EXTRACT(pet, '$[0][2]'), '$', '') AS namedt,
              JSON_EXTRACT(pet, '$[1][1]') AS sm_dt
            FROM player
            INNER JOIN account ON account.id = player.account_id
            WHERE account.is_admin = 0 AND account.ban = 0
            ORDER BY CapCS_SuPhu DESC, sm DESC, CapCS_DeTu DESC
            LIMIT 10;";

    $result = $config->query($query);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $item = $row;
            if ($row['sm'] > 500000000000) {
                $item['sm'] = "500000000000";
            }
            $item['sm_sum'] = $item['sm'] + $item['sm_dt'];
            $data[] = $item;
        }
    }
    // die(json_encode($data));
    return $data;
}

function __get_top_kill_boss()
{
    global $config;
    $query = "SELECT player.name, player.kill_boss
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