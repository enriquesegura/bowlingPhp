<?php

class GameTest extends PHPUnit_Framework_TestCase
{

    public function testCreateGame()
    {
        $this->assertInstanceOf('KataBowling\Game', new KataBowling\Game);
    }

    public function testPerfectGame()
    {
        $game = new \KataBowling\Game();
        $this->assertEquals(300, $game->getScore());
    }

    public function testSplitFrames()
    {
        $game = new \KataBowling\Game();
        $this->assertEquals(300, $game->getScore());
    }

}