<?php

namespace Evans\Infrastructure\Providers;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Contracts\Container\Container;
use Evans\Infrastructure\Debug\DumpSqlLogger;

class DatabaseProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $container): void
    {
        $container->bind(QueryBuilder::class, function (Container $container) {
            $config = new Configuration();
            if (getenv('DEBUG_QUERIES') === true) {
                $config->setSQLLogger(new DumpSqlLogger());
            }
            $connectionParams = [
                'dbname' => getenv('DB_NAME'),
                'user' => getenv('DB_USER'),
                'password' => getenv('DB_PASSWORD'),
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            ];
            $connection = DriverManager::getConnection($connectionParams, $config);
            return $connection->createQueryBuilder();
        });
    }
}
