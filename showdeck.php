<?php
session_start();
include_once "FlashCard/Library.php";

$library = unserialize($_SESSION['library']);

/**
 * showdeck.php file mostly activates "actions" related to deck objects:
 * add card
 * remove card
 * edit card
 * show card's answer
 * take next card
 * This is accomplished by passing (and later reading from) $_GET['action'] parameter.
 */

/**
 * showdeck.php has to know which deck we are working with.
 * If deck is somehow not set, go back to the index.php page.
 */

$_SESSION['deck']=$_GET['deck'];
if(!isset($_SESSION['deck']))
    header('location: index.php');

/**
 * Check if changedeck.php provided information for
 * card information change - "Edit"
 * or its brand new card - "Add".
 * Third option is triggered when there are no cards in deck,
 * redirecting us to changedeck.php with "add" action activated.
 */

if (isset($_GET['submit']) && $_GET['submit'] == 'Edit')
{
    $library->getDeck($_SESSION['deck'])->getCard()->setQuestion($_GET['question']);
    $library->getDeck($_SESSION['deck'])->getCard()->setAnswer($_GET['answer']);
}
else if (isset($_GET['submit']) && $_GET['submit'] == 'Add')
{
    $library->getDeck($_SESSION['deck'])->addCard($_GET['question'], $_GET['answer']);
}
else if ($library->getDeck($_SESSION['deck'])->isEmpty())
{
    header('location: changedeck.php?deck=' . $_SESSION['deck'] . '&action=add');
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
            <h2><?php echo $_SESSION['deck']; ?></h2>
        </div>
        <div id="Body">
            <div>
                <label>Question:</label>
                <?php
                if (isset($_GET['action']) && $_GET['action'] == 'next')
                    $library->getDeck($_SESSION['deck'])->nextCard();
                echo '<span>' . $library->getDeck($_SESSION['deck'])->getCard()->getQuestion() . '</span>';
                ?>
            </div>
            <div>
                <label>Answer:</label>
                <?php
                if (isset($_GET['action']) && $_GET['action'] == 'answer')
                    echo '<span>' . $library->getDeck($_SESSION['deck'])->getCard()->getAnswer() . '</span>';
                else
                    echo '<span> <a href="showdeck.php?deck=' . $library->getDeck($_SESSION['deck'])->getName() . '&action=answer">Get Answer</a></span>';
                ?>
            </div>
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'answer')
            {
                echo '<div>';
                echo '<a href="showdeck.php?deck=' . $library->getDeck($_SESSION['deck'])->getName() . '&action=next">Next Card</a>';
                echo '</div>';
                echo '<div>';
                echo '<br>';
                echo '<a href="changedeck.php?deck=' . $library->getDeck($_SESSION['deck'])->getName() . '&action=remove">Remove</a> ';
                echo '<a href="changedeck.php?deck=' . $library->getDeck($_SESSION['deck'])->getName() . '&action=edit">Edit</a> ';
                echo '</div>';
            }
            echo '<br><br>';
            echo '<a href="index.php">Home Page</a> ';
            echo '<a href="changedeck.php?deck=' . $library->getDeck($_SESSION['deck'])->getName() . '&action=add">Add new card</a>';
            ?>
        </div>
    </body>
</html>
<?php
$_SESSION['library'] = serialize($library);
?>