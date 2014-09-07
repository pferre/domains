<?php

namespace Domains;

use Carbon\Carbon;
use Domains\Models\DomainName;

class Check
{

    /**
     * @var Carbon
     */
    private $carbon;


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
     * @return \Illuminate\Support\Collection
     */
    public function getRenewalDates()
    {
        $collection = $this->getDomainNamesCollection();

        $renewals = $collection->filter(function($dates)
        {
            $now = $this->carbon->now();
            $carbonInstances = new Carbon($dates->renewal_date);

            if ($carbonInstances->diffInDays($now) <= 7)
            {
                return true;
            }
        });

        return $renewals;

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDomainNamesCollection()
    {
        $domain = new DomainName();
        $collection = $domain->all();
        return $collection;
    }
}
