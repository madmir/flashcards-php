<?php
include_once "Card.php";

class Deck
{
    private $name;
    private $cards;
    private $pointer;

    function __construct($name = "")
    {
        $this->name = $name ? $name : "The name was not set.";
        $this->cards = array();
        $this->pointer = 0;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function addCard($question, $answer)
    {
        $this->cards[] = new Card($question, $answer);
        shuffle($this->cards); // Cards are rearranged whenever the new one is added.
        $this->pointer = 0;
    }

    public function removeCard()
    {
        unset($this->cards[$this->pointer]);
        shuffle($this->cards); // Remaining cards are rearranged whenever one of them is removed.
        $this->pointer = 0;
    }

    public function getCard()
    {
        return $this->cards[$this->pointer];
    }

    public function nextCard()
    {
        $this->pointer++;
        if ($this->pointer == count($this->cards)) // When array index (pointer) gets out of bounds,
            $this->pointer = 0;                    // return to the start.
        return $this->cards[$this->pointer];
    }

    public function getCardCount()
    {
        return count($this->cards);
    }

    public function isEmpty()
    {
        if (count($this->cards)>0)
            return false;
        else
            return true;
    }
}