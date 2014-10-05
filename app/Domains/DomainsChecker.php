<?php

namespace Domains;

use Carbon\Carbon;
use Domains\Models\DomainName;

class DomainsChecker
{

    /**
     * @var Carbon
     */
    private $carbon;

    /**
     * @var int
     */
    private $noOfDaysBeforeSendingWarningMessage = 120;


    /**
     * @param Carbon $carbon
     */
    function __construct(Carbon $carbon = null)
    {
        $this->carbon = $this->createNewCarbon() ?: $carbon;
    }

    /**
     * @return Carbon
     */
    protected function createNewCarbon()
    {
        return new Carbon();
    }

    /**
     * Returns null if filter condition is not met
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRenewalDates()
    {
        $collection = $this->getAllDomainsAsCollection();

        $renewals = $collection->filter(function($dates)
        {
            $now = $this->carbon->now();
            $carbonInstances = new Carbon($dates->renewal_date);

            if ( $carbonInstances->diffInDays($now) <= $this->noOfDaysBeforeSendingWarningMessage )
            {
                return true;
            }
        });

        return $renewals->isEmpty() ? null : $renewals;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllDomainsAsCollection()
    {
        $domain = new DomainName();
        $collection = $domain->all();
        return $collection;
    }
}
