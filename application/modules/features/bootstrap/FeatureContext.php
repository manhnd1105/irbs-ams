<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

require_once __DIR__ . '/../../../../Phpadder.php';
/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
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
     * @var Phpadder
     */
    private $Adder;

    /**
     * @Given /^I have the number (\d+) and the number (\d+)$/
     * @param int $arg1
     * @param int $arg2
     */
    public function iHaveTheNumberAndTheNumber($arg1, $arg2)
    {
        $this->Adder = new Phpadder($arg1, $arg2);
//        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When /^I add them together$/
     */
    public function iAddThemTogether()
    {
        $this->Adder->add();
//        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then /^I should get (\d+)$/
     * @param int $sum
     * @throws Exception
     */
    public function iShouldGet($sum) {
        if ($this->Adder->sum != $sum) {
            throw new Exception("Actual sum: ".$this->Adder->sum);
        }
        $this->Adder->display();
    }

    /**
     * @Given /^I have the number (\d+) and the number (\d+), and the number (\d+)$/
     */
    public function iHaveTheNumberAndTheNumberAndTheNumber($arg1, $arg2, $arg3)
    {
        $this->Adder = new Phpadder($arg1, $arg2);
        $this->Adder->add($arg1, $arg2);
//        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}
