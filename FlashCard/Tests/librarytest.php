<?php

namespace FlashCard;
include_once "../Library.php";


$library = new Library();

$newDeck = new Deck();
$newDeck->setName("deck1");
$newDeck->addCard("Whats up?", "Sta ima?");
$newDeck->addCard("Hello", "Zdravo");
$newDeck->addCard("See you", "Vidimo se");
$newDeck->removeCard(1);
$library->addDeck($newDeck->getName(), $newDeck);
//$library->removeDeck($newDeck->getName());

echo $library->getDeck("deck1")->nextCard()->getAnswer().PHP_EOL;
echo $newDeck->nextCard()->getAnswer().PHP_EOL;
echo $newDeck->nextCard()->getAnswer().PHP_EOL;
echo $newDeck->nextCard()->getAnswer().PHP_EOL;
//echo $newDeck->nextCard()->getAnswer().PHP_EOL;

print_r($library->getDecks());

echo "---------------------------------".PHP_EOL;