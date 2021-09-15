<?php

namespace spec\App\Domain\Currency;

use App\Domain\Currency\Convertor;
use PhpSpec\ObjectBehavior;

class ConvertorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Convertor::class);
    }
}
