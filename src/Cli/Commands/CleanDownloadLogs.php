<?php

namespace Evans\Cli\Commands;

use Cake\Chronos\Chronos;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class CleanDownloadLogs extends Command
{
    /**
     * @var QueryBuilder
     */
    protected $db;

    /**
     * @var CrawlerDetect
     */
    protected $crawlerDetector;

    /**
     * @param QueryBuilder $db
     * @param CrawlerDetect $crawlerDetector
     */
    public function __construct(
        QueryBuilder $db,
        CrawlerDetect $crawlerDetector
    ) {
        parent::__construct();
        $this->db = $db;
        $this->crawlerDetector = $crawlerDetector;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
           ->setName('downloads:clean')
           ->setDescription('Remove search engine download logs');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $downloads = $this->getRecentDownloads();
        if (empty($downloads)) {
            return;
        }

        $deleteIds = [];
        foreach ($downloads as $download) {
            if ($this->crawlerDetector->isCrawler($download['user_agent'])) {
                $deleteIds[] = $download['id'];
            }
        }

        if (empty($deleteIds)) {
            return;
        }

        $this->db->getConnection()->executeQuery(
            'DELETE FROM `downloads` WHERE `id` IN (?)',
            [$deleteIds],
            [Connection::PARAM_STR_ARRAY]
        );
    }

    /**
     * Get recent download rows
     *
     * @return array
     */
    protected function getRecentDownloads(): array
    {
        $time = (string) Chronos::now()->subMinutes(6);

        return $this->db
            ->select('id', 'user_agent')
            ->from('downloads')
            ->where('created_at > ?')
            ->setParameter(0, $time)
            ->execute()
            ->fetchAll();
    }
}
