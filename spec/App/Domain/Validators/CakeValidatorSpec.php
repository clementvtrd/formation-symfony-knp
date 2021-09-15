<?php

namespace spec\App\Domain\Validators;

use App\Domain\Validators\CakeValidator;
use PhpSpec\ObjectBehavior;

class CakeValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CakeValidator::class);
    }

    function it_should_return_false_if_there_is_special_char()
    {
        $this->noSpecialChar('Hd:;:;::$*')->shouldReturn(false);
    }

    function it_should_return_true_if_there_is_no_special_char()
    {
        $this->noSpecialChar('Mon Gateau de ouf')->shouldReturn(true);
    }

    function it_checks_if_there_is_enough_caracters() 
    {
        $this->minLen('Mon Gateau de ouf', 6)->shouldReturn(true);
    }

    function it_checks_if_there_is_not_too_much_caracters() 
    {
        $this->maxLen('Mon Gateau de ouf trop bien trop chouette', 20)->shouldReturn(false);
    }

    function it_checks_name_is_valid ()
    {
        $this->checkName('Mon Gateau de ouf')->shouldReturn(true);
    }

    function it_checks_name_is_not_valid ()
    {
        $this->checkName('Mon Gateau d%e ouf')->shouldReturn(false);
    }

}
