<?php
class Card
{
    private $question;
    private $answer;

    function __construct($question = "", $answer = "")
    {
        $this->question = $question ? $question : "The question was not set.";
        $this->answer = $answer ? $answer : "The answer was not set.";
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }
}