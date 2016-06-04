# TheBowlingGameKata

### Intro
  * We want know the score of the game.
  * The score of the game is the addition of the score of his frames.
  * A game has ten frames.
  * Each frame has until 2 rolls to knock down all the pins.
  * The score of the game will be defined in base of the result of all the rolls.
  * Format of a roll in a game result.
    * We are using an string to show the result of each roll.
    * 'X': strike (10 pins in the first roll).
    * '/': spare (10 pins in 2 rolls).
    * '1-9': number of pins knocked down if < 10.
    * '-': miss, no pin knocked down.
  * Score of the frame:
    * < 10 pins: the points are the number of pins knocked down.
    * Spare: 10 points + the number of pins of the next roll.
    * Strike: 10 points + the number of pins of the next two rolls.
    * If you do a Spare in the last frame you get one extra roll to score the frame.
    * If you do a Strike in the last frame you get two extra rolls to score the frame.
    * Examples:
      * Strike: "X--" (10 points), "XXX" (30 points), "X-/" (20 points), "X23" (15 points).
      * Spare: "-/X" (20 points), "3/-" (10 points), "4/1" (11 points), "9/X" (20 points).
      * <10 pins: "36" (9 points), "--" (0 points), "3-" (3 points), "-4" (4 points), "17" (8 points)

See [About this Kata](http://codingdojo.org/cgi-bin/index.pl?KataBowling)
See [Uncle Bob article about how to do it](http://butunclebob.com/ArticleS.UncleBob.TheBowlingGameKata)
