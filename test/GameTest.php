<?php

class GameTest extends PHPUnit_Framework_TestCase
{

    public function testCreateGame()
    {
        $this->assertInstanceOf('KataBowling\Game', new KataBowling\Game);
    }
}