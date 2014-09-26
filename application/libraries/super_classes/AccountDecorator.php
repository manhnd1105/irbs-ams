<?php
namespace super_classes;

/**
 * Class AccountDecorator
 * @package super_classes
 */
abstract class AccountDecorator extends Account
{
    /**
     * @var Account
     */
    protected $_account;

    /**
     * @param Account $acc
     */
    function __construct(Account $acc)
    {
        $this->_account = $acc;
    }
}
