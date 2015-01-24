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
    private $noOfDaysBeforeSendingWarningMessage = 60;
    /**
     * @var DomainName
     */
    private $domains;


    /**
     * @param Carbon $carbon
     * @param DomainName $domains
     */
    function __construct(Carbon $carbon = null, DomainName $domains = null)
    {
        $this->carbon = $this->createNewCarbon() ?: $carbon;

        $this->domains = $this->createDomainNameInstance() ?: $domains;
    }

    /**
     * @return Carbon
     */
    protected function createNewCarbon()
    {
        return new Carbon();
    }

    /**
     * @return DomainName
     */
    public function createDomainNameInstance()
    {
        return new DomainName();
    }

    /**
     * Returns null if filter condition is not met
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRenewalDates()
    {
        $collection = $this->domains->getAllDomains();

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

        return $domain->getAllDomains();
    }

}
