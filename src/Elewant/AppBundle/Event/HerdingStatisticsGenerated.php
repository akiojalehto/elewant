<?php

declare(strict_types=1);

namespace Elewant\AppBundle\Event;

use Elewant\AppBundle\Statistics\CalculatedHerdingStatistics;
use Symfony\Component\EventDispatcher\Event;

final class HerdingStatisticsGenerated extends Event
{
    const NAME = 'app.herding.statistics.generated';

    /**
     * @var CalculatedHerdingStatistics
     */
    private $statistics;

    public function __construct(CalculatedHerdingStatistics $statistics)
    {
        $this->statistics = $statistics;
    }

    public function statistics(): CalculatedHerdingStatistics
    {
        return $this->statistics;
    }
}
