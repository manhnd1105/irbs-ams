<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 10/1/14
 * Time: 11:33 AM
 */
use Behat\Behat\Context\Context;

class LoginContext implements Context
{
    private $account_name;
    private $password;
    private $status;



    /**
     * @When /^I fill them into textboxes$/
     */
    public function iFillThemIntoTextboxes()
    {
        $factory = \super_classes\InkiuAccountFactory::get_instance();
        $this->status = $factory->validate($this->account_name, $this->password);
    }

    /**
     * @Then /^I should be redirected to main view$/
     */
    public function iShouldBeRedirectedToMainView()
    {
        if ($this->status)
        {
            echo 'OK';
        }
    }

    /**
     * @Given /^My information should be loaded on session and displayed in top bar$/
     */
    public function myInformationShouldBeLoadedOnSessionAndDisplayedInTopBar()
    {
    }

    /**
     * @Then /^I should be redirected to login view to fill information again$/
     */
    public function iShouldBeRedirectedToLoginViewToFillInformationAgain()
    {
        if (!$this->status)
        {
            echo 'Invalid information';
        }
    }

    /**
     * @Given /^I have my account name "([^"]*)" and my password "([^"]*)"$/
     * @param string $account_name
     * @param string $password
     */
    public function iHaveMyAccountNameAndMyPassword($account_name, $password)
    {
        $this->account_name = $account_name;
        $this->password = $password;
    }

    /**
     * @Then /^I should get "([^"]*)"$/
     */
    public function iShouldGet($arg1)
    {
        return "OK";
//        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}