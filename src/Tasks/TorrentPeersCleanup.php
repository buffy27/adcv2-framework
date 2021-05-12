<?php


namespace App\Tasks;

use App\Entity\Logs;
use App\Entity\Peers;
use Doctrine\ORM\EntityManagerInterface;
use Rewieer\TaskSchedulerBundle\Task\AbstractScheduledTask;
use Rewieer\TaskSchedulerBundle\Task\Schedule;

class TorrentPeersCleanup extends AbstractScheduledTask
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function initialize(Schedule $schedule)
    {
        $schedule->everyHours(2);
    }

    public function run()
    {
        $peers = $this->entityManager->getRepository(Peers::class)->findAll();
        foreach ($peers as $peer) {
            $interval  = date_diff($peer->getLastAction(), new \DateTime('now'));
            if ($interval->h > 0) {
                $this->entityManager->remove($peer);
            }
        }
        $this->entityManager->flush();
    }
}