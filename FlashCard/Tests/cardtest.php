<?php

include_once "../Card.php";


$defaultFlashCard = new Card ("Hi", "Zdravo");

$defaultFlashCard->setQuestion("Hello");
echo $defaultFlashCard->getQuestion().PHP_EOL;;
echo $defaultFlashCard->getAnswer();