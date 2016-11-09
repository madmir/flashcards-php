<?php
session_start();
include_once "FlashCard/Library.php";

/**
 * $_SESSION is used for data persistence.
 * Nothing is stored in database.
 *
 * library object needs to be
 * serialized (see bottom of the file)/ unserialized
 * when put into/removed from the $_SESSION
 */
if(isset($_SESSION['library']))
    $library = unserialize($_SESSION['library']);
else
{
    /**
     * Two default decks.
     */
    $library = new Library();
    $newDeck = new Deck("English to Bosnian");
    $newDeck->addCard("Hello", "Zdravo");
    $newDeck->addCard("Whats up?", "Sta ima?");
    $newDeck->addCard("See you", "Vidimo se");
    $library->addDeck($newDeck->getName(), $newDeck);

    $newDeck = new Deck("Capitals of the World");
    $newDeck->addCard("Denmark", "Copenhagen");
    $newDeck->addCard("Argentina", "Buenos Aires");
    $newDeck->addCard("Egypt", "Cairo");
    $newDeck->addCard("Japan", "Tokyo");
    $newDeck->addCard("New Zealand", "Wellington");
    $library->addDeck($newDeck->getName(), $newDeck);
}

if (isset($_GET['submit']) && $_GET['submit'] == 'Add') // add new deck; "Add" button pressed
{
    $library->addDeck($_GET['name'], new Deck($_GET['name']));
}
else if (isset($_GET['action']) && $_GET['action'] == 'remove') // remove deck; clicked on [x], line 66
{
    $library->removeDeck($_GET['name']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>FlashCard Application</title>
		<link href="styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
		<div id="Header">
			<h2>FlashCard deck list</h2>
		</div>        
        <div id="Body">
            <div>
                <ul id="List">
                    <?php
                    if ($library->isEmpty())
                        echo 'The deck library is empty.';
                    else
                    {
                        foreach ($library->getDecks() as $deck) // list decks in the library
                        {
                            echo '<li><a href="showdeck.php?deck=' . $deck->getName() . '">' . $deck->getName() . '</a> <a href="index.php?name=' . $deck->getName() . '&action=remove">[x]</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <div>
                <form method="get" action="index.php" >
                    <div>
                        <label>New deck name:</label>
                        <input type="text" name="name" />
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Add">
                    </div>
                </form>
            </div>
        </div>
	</body>
</html>
<?php
$_SESSION['library'] = serialize($library);
?>