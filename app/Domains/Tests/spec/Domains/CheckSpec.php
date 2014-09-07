<?php

namespace spec\Domains;

use Carbon\Carbon;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckSpec extends ObjectBehavior
{
    function let(Carbon $carbon, $eloquent)
    {
        $eloquent->beADoubleOf('Illuminate\Database\Eloquent\Model');
        $this->beConstructedWith($carbon);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Domains\Check');
    }

    function it_returns_collection_of_carbon_dates()
    {
        $this->getRenewalDates()->shouldBeCollection();
    }

}
