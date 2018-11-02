<?php

namespace NFLScores\Commands;

use LaravelZero\Framework\Commands\Command;
use NFLScores\Models\NFL;

abstract class AbstractCommand extends Command
{
    /**
     * The NFL game handler.
     *
     * @var \NFLScores\Models\NFL
     */
    protected $NFL;

    /**
     * Injects the necessary dependencies.
     *
     * @param \NFLScores\Models\NFL $NFL
     */
    public function __construct(NFL $NFL)
    {
        parent::__construct();

        $this->NFL = $NFL;
    }
}
