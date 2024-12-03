<?php 
require("includes/connection.php");
require_once ("includes/dbcon.php");

try {

    // start a new transaction (disable auto-commit)
    $dbCon->beginTransaction();

    // withdraw amount from savings account
    $handle = $dbCon->prepare("UPDATE BankAccount 
                                SET Balance = Balance - :amount 
                                WHERE AccountID = 1");
    $handle->execute();
    echo "Succesfully withdrew amount from Savings Account<br/>";

    $dbCon->commit(); // commit both queries as ONE atomic unit (ACID principles...)
    echo "Committed transaction.<br/>";
    echo "Succesfully transferred your money<br/>";
}
catch (Exception $e) {
    echo "An error occured: " . $e . "<br/>";

    $dbCon->rollBack(); 

    echo "Rollback.... Nothing has been committed and our DB is in a consistent state";  
}

?>