<?php

namespace KataBowling;


class Game
{
    const NUM_FRAMES = 10;

    public function getScore($stringOfRollResults)
    {
        $gameScore = 0;
        foreach ($this->getFrames($stringOfRollResults) as $frame){
            $gameScore += $frame->getScore();
        }
        return $gameScore;
    }

    private function getFrames($stringOfRollResults)
    {
        $arrayOfRollResults = str_split($stringOfRollResults);
        $frames = array();
        for ($i=0;$i<self::NUM_FRAMES;$i++) {
            $frames[] = $this->getNextFrameOfRollResults($arrayOfRollResults);
            $arrayOfRollResults = $this->getRollResultsOfPendingFrames($arrayOfRollResults);
        }
        return $frames;
    }

    private function getFirstRoll($arrayOfRollResults)
    {
         return $arrayOfRollResults[0];
    }

    private function getSecondRoll($arrayOfRollResults)
    {
        return $this->getFirstRoll($arrayOfRollResults) == Roll::STRIKE ? null : $arrayOfRollResults[1];
    }

    private function getFirstExtraRoll($arrayOfRollResults)
    {
        if ($this->getSecondRoll($arrayOfRollResults) == Roll::SPARE) {
            return $arrayOfRollResults[2];
        }
        if ($this->getFirstRoll($arrayOfRollResults) == Roll::STRIKE) {
            return $arrayOfRollResults[1];
        }
        return  null;
    }

    private function getSecondExtraRoll($arrayOfRollResults)
    {
        if ($this->getFirstRoll($arrayOfRollResults) == Roll::STRIKE) {
            return $arrayOfRollResults[2];
        }
        return  null;
    }

    private function getNextFrameOfRollResults($arrayOfRollResults)
    {
        $firstRollResult = $this->getFirstRoll($arrayOfRollResults);
        $secondRollResult = $this->getSecondRoll($arrayOfRollResults);
        $firstExtraRollResult = $this->getFirstExtraRoll($arrayOfRollResults);
        $secondExtraRollResult = $this->getSecondExtraRoll($arrayOfRollResults);
        return new Frame($firstRollResult, $secondRollResult, $firstExtraRollResult, $secondExtraRollResult);
    }

    private function getRollResultsOfPendingFrames($arrayOfRollResults)
    {
        if ($this->getFirstRoll($arrayOfRollResults) == Roll::STRIKE) {
            return array_slice($arrayOfRollResults, 1);
        }
         return array_slice($arrayOfRollResults, 2);
    }
}