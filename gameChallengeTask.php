<?php

// Make a gameCard Class for calling each loop
class gameCard {

    // Define Attribute
    public $color;
    public $shape;

    public function __construct($color, $shape) {
        $this->color = $color;
        $this->shape = $shape;
    }
    // compare both value if shape and color is matched
    public function isMatch($card) {
        return $this->color === $card->color && $this->shape === $card->shape;
    }

    // Display output
    public function display() {
        return "{$this->color} {$this->shape} <br>";
    }
}

// as requirement we have pre set data
$colors = ['Red', 'Blue', 'Green', 'Yellow'];
$shapes = ['Square', 'Circle', 'Triangle', 'Oval'];


$cardsArray = [];
foreach ($colors as $color) {
    foreach ($shapes as $shape) {
        // each card have same color and same shape that's why two time call the class
        $cardsArray[] = new gameCard($color, $shape);
        $cardsArray[] = new gameCard($color, $shape);
    }
}

// Shuffle method use to change the index of array every time 
shuffle($cardsArray);

// echo "<pre>"; print_r($cardsArray); echo "</pre>";
// die();

// Initalizse all variable here
$player1_score = 0;
$player2_score = 0;
$turn = 1;
$matches = [];
$flipped = [];
$turncount=1;
// Start the game
echo "<h3 style='color:blue; margin-top:10px'>Welcome to Coding Game Challenge!</h3><br>";

// run the loop unitl the no card left
while (count($cardsArray) > 0) {


    $turnPerson = ($turn === 1) ? 'John' : 'Michale';
    echo "<h4>Player {$turn}'s $turnPerson turn:</h1><br>";
    echo "turn# $turncount:<br>";
    // get to random cards
    $first_flip = array_rand($cardsArray);
    $second_flip = array_rand($cardsArray);

    // Ensure the same card is not selected again
    while ($second_flip == $first_flip) {
        $second_flip = array_rand($cardsArray);
    }

    $card1 = $cardsArray[$first_flip];
    $card2 = $cardsArray[$second_flip];
    echo "Flipped cards: {$card1->display()} and {$card2->display()}<br>";

    // Check if the cards match
    if ($card1->isMatch($card2)) {
        echo "<span style='color:green'>Match found! </span><br>";
        // Remove matched cards from the cardsArray
        unset($cardsArray[$first_flip]);
        unset($cardsArray[$second_flip]);

        // Adjust the cardsArray indices
        $cardsArray = array_values($cardsArray);

        // Give points to the current player
        if ($turn === 1) {
            $player1_score++;
        } else {
            $player2_score++;
        }
    } else {


        // remove the card from array becuase they already used it. 
        // Developer note you can comment these three lines as well if you wanna play long game like until something is matched

        unset($cardsArray[$first_flip]);
        unset($cardsArray[$second_flip]);
        $cardsArray = array_values($cardsArray);



        echo "<span style='color:red'>No match Found.</span><br>";
    }

    // Switch turns
    $turn = ($turn === 1) ? 2 : 1;
    $turncount++;
    // Show current scores
    echo "Player 1  score: $player1_score, Player 2 score: $player2_score<br>";
}

echo "<h2>Final Result </h2><br>";
//  Check the Winner
if ($player1_score > $player2_score) {
    echo "<span style='color:green'> Player 1 John  Wins with $player1_score matching pairs!<br><span>";

    echo "<span style='color:red'> Player 2 Michale Lost with $player2_score matching pairs!<br><span>";
} elseif ($player2_score > $player1_score) {

    echo "<span style='color:green'> Player 2 Michale Wins with $player2_score matching pairs!<br><span>";

    echo "<span style='color:red'> Player 1  John Lost with $player1_score matching pairs!<br><span>";
} else {
    echo "It's a tie! Both players have same $player1_score  pairs.<br>";
}


echo "<a href=''>Click here for new Game </a><br>";

?>
