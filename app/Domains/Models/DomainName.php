<?php

namespace Domains\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


/**
 * Class DomainName
 * @package Domains\Models
 */
class DomainName extends Eloquent {

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allDomains()
    {
        return $this->all();
    }

    /**
     * @return mixed
     */
    public function renewalDate()
    {
        $nextWeek  = date('Y-m-d', time() + (7 * 24 * 60 * 60));
        //if renewal date is <= (today - 1 week)

        return $this->where('renewal_date', '<=' , $nextWeek)
                    ->get()
                    ->toArray()
            ;

    }

} 