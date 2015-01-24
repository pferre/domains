<?php

namespace Domains\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;


/**
 * Class DomainName
 * @package Domains\Models
 */
class DomainName extends Eloquent {

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllDomains()
    {
        return $this->all();
    }

} 