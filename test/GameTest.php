<?php

use KataBowling\Game;
use KataBowling\Roll;

class GameTest extends PHPUnit_Framework_TestCase
{
    public function testZeroScoreGame()
    {
        $game = new Game();
        $rollsResult = Roll::MISS . Roll::MISS . // frame 1
            Roll::MISS . Roll::MISS . // frame 2
            Roll::MISS . Roll::MISS . // frame 3
            Roll::MISS . Roll::MISS . // frame 4
            Roll::MISS . Roll::MISS . // frame 5
            Roll::MISS . Roll::MISS . // frame 6
            Roll::MISS . Roll::MISS . // frame 7
            Roll::MISS . Roll::MISS . // frame 8
            Roll::MISS . Roll::MISS . // frame 9
            Roll::MISS . Roll::MISS; // frame 10
        $this->assertEquals(0, $game->getScore($rollsResult));
    }

    public function testKnockedDownPinsPointScoreGame()
    {
        $game = new Game();
        $rollsResult = $this->pinsKnockedDownToRollResult(1) . Roll::MISS . // frame 1
            Roll::MISS . Roll::MISS . // frame 2
            Roll::MISS . Roll::MISS . // frame 3
            Roll::MISS . Roll::MISS . // frame 4
            Roll::MISS . Roll::MISS . // frame 5
            Roll::MISS . $this->pinsKnockedDownToRollResult(7) . // frame 6
            Roll::MISS . Roll::MISS . // frame 7
            Roll::MISS . Roll::MISS . // frame 8
            Roll::MISS . Roll::MISS . // frame 9
            Roll::MISS . Roll::MISS; // frame 10
        $this->assertEquals(8, $game->getScore($rollsResult));
    }

    public function testSparePointScoreGame()
    {
        $game = new Game();
        $rollsResult = $this->pinsKnockedDownToRollResult(1) . Roll::MISS . // frame 1
            Roll::MISS . Roll::MISS . // frame 2
            Roll::MISS . Roll::MISS . // frame 3
            $this->pinsKnockedDownToRollResult(3) . Roll::SPARE . // frame 4
            $this->pinsKnockedDownToRollResult(4) . Roll::MISS . // frame 5
            Roll::MISS . $this->pinsKnockedDownToRollResult(7) . // frame 6
            Roll::MISS . Roll::MISS . // frame 7
            Roll::MISS . Roll::MISS . // frame 8
            Roll::MISS . Roll::MISS . // frame 9
            Roll::MISS . Roll::MISS; // frame 10
        $this->assertEquals(26, $game->getScore($rollsResult));
    }

    public function testStrikePointScoreGame()
    {
        $game = new Game();
        $rollsResult = $this->pinsKnockedDownToRollResult(1) . Roll::MISS . // frame 1
            Roll::MISS . Roll::MISS . // frame 2
            Roll::STRIKE . // frame 3
            $this->pinsKnockedDownToRollResult(3) . Roll::SPARE . // frame 4
            $this->pinsKnockedDownToRollResult(4) . Roll::MISS . // frame 5
            Roll::MISS . $this->pinsKnockedDownToRollResult(7) . // frame 6
            Roll::MISS . Roll::MISS . // frame 7
            Roll::MISS . Roll::MISS . // frame 8
            Roll::MISS . Roll::MISS . // frame 9
            Roll::MISS . Roll::MISS; // frame 10
        $this->assertEquals(46, $game->getScore($rollsResult));
        $r = "XXXXXXXXXX2/";
        $this->assertEquals(46, $game->getScore($r));
    }
    
    private function pinsKnockedDownToRollResult($numberOfPinsKnockedDown)
    {
        if ($numberOfPinsKnockedDown > 9 || $numberOfPinsKnockedDown < 1) {
            throw new Exception('Invalid number of pins knocked down');
        }
        return "$numberOfPinsKnockedDown";
    }
}