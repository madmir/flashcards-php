<?php
include_once "Deck.php";

class Library
{
    private $decks;

    function __construct()
    {
        $this->decks = array();
    }

    public function addDeck($name, $deck)
    {
        $this->decks[$name] = $deck;
    }

    public function removeDeck($name)
    {
        unset($this->decks[$name]);
    }

    public function getDeck($name)
    {
        return $this->decks[$name];
    }

    public function getDecks()
    {
        return $this->decks;
    }

    public function isEmpty()
    {
        if (count($this->decks)>0)
            return false;
        else
            return true;
    }
}