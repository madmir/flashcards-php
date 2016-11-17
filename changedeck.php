<?php
session_start();
include_once "FlashCard/Library.php";

$library = unserialize($_SESSION['library']);

/**
 * changedeck.php is place where cards are removed and add/edit information is set.
 */

/**
 * changedeck.php has to know which deck we are working with.
 * If deck is somehow not set, go back to the index.php page.
 */

$_SESSION['deck']=$_GET['deck'];
if(!isset($_SESSION['deck']))
    header('location: index.php');
else if (isset($_GET['action']) && $_GET['action'] == 'remove')
{
    $library->getDeck($_SESSION['deck'])->removeCard();
    header('location: showdeck.php?deck=' . $_SESSION['deck']);
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
        <form method="get" action="showdeck.php" >
            <div>
                <label>Question:</label>
                <?php
                    if (isset($_GET['action']) && $_GET['action'] == 'edit')
                        echo '<input type="text" name="question" value="' . $library->getDeck($_SESSION['deck'])->getCard()->getQuestion() . '" />';
                    else if (isset($_GET['action']) && $_GET['action'] == 'add')
                        echo '<input type="text" name="question" />';
                    echo '<input type="hidden" name="deck" value="' . $_SESSION['deck'] . '">';
                ?>
            </div>
            <div>
                <label>Answer:</label>
                <?php
                if (isset($_GET['action']) && $_GET['action'] == 'edit')
                    echo '<input type="text" name="answer" value="' . $library->getDeck($_SESSION['deck'])->getCard()->getAnswer() . '" />';
                else if (isset($_GET['action']) && $_GET['action'] == 'add')
                    echo '<input type="text" name="answer" />';
                ?>
            </div>
            <div>
                <?php
                if (isset($_GET['action']) && $_GET['action'] == 'edit')
                    echo '<input type="submit" name="submit" value="Edit">';
                else if (isset($_GET['action']) && $_GET['action'] == 'add')
                    echo '<input type="submit" name="submit" value="Add">';
                echo '<br><br>';
                echo '<a href="index.php">Home page</a> ';
                ?>
            </div>
        </form>
    </body>
</html>
<?php
$_SESSION['library'] = serialize($library);
?>