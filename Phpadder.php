<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 10/1/14
 * Time: 10:04 AM
 */

class Phpadder {

    private $a;
    private $b;
    public $sum;

    public function __construct($a, $b) {
        $this->a = $a;
        $this->b = $b;
    }

    public function add() {
        $this->sum = $this->a + $this->b;
    }

    public function display() {
        return $this->sum;
    }
}