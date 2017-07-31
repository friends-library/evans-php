<?php

namespace Evans\Infrastructure\Debug;

use Doctrine\DBAL\Logging\SQLLogger;

class DumpSqlLogger implements SQLLogger
{
    /**
     * {@inheritdoc}
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        dump('---- START QUERY ----');
        dump($sql);
        if (! empty($params)) {
            dump($params);
        }
        if (! empty($types)) {
            dump($types);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function stopQuery()
    {
        dump('---- STOP QUERY ----');
        echo "<br /><br /><br />";
    }
}
