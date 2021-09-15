<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am an authenticated user
     */
    public function iAmAnAuthenticatedUser()
    {
        throw new PendingException();
    }

    /**
     * @When I am on the creation page
     */
    public function iAmOnTheCreationPage()
    {
        throw new PendingException();
    }

    /**
     * @When I fill the name field
     */
    public function iFillTheNameField()
    {
        throw new PendingException();
    }

    /**
     * @When I fill the description field
     */
    public function iFillTheDescriptionField()
    {
        throw new PendingException();
    }

    /**
     * @When I fill the price field
     */
    public function iFillThePriceField()
    {
        throw new PendingException();
    }

    /**
     * @When I press the button :arg1
     */
    public function iPressTheButton($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should be redirected to the home page
     */
    public function iShouldBeRedirectedToTheHomePage()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see my cake
     */
    public function iShouldSeeMyCake()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the success message
     */
    public function iShouldSeeTheSuccessMessage()
    {
        throw new PendingException();
    }
}
