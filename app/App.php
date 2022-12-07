<?php

declare(strict_types = 1);

// Your Code

// Reading files from directory
function getTransactionFiles(string $dirPath): array{ // Creating a function to pull the directories and return them as an array
    $files = []; //Setting an empty array for the files to be stored in

    foreach(scandir($dirPath) as $file) { //Scanning the directory path which will look at the transaction_files directory
        if(is_dir($file)){ // If the file referenced is a directory
            continue; // Skip it
        }
        $files[] = $dirPath . $file; //Then add directory path and file to the files array
    }
    return $files;
}

// Read each file and extract transactions from them
function getTransactions(string $fileName, ?callable $transactionHandler = null): array { //Making a function that takes a filename as a parameter 
    if(! file_exists($fileName)){ // If file doesnt exist
        trigger_error('File "' . $fileName . '" does not exist! ', E_USER_ERROR); // Display custom error which tells the user the file does not exist
    }

    $file = fopen($fileName,'r'); // This will open the file for reading

    fgetcsv($file); // Makes it so the first line is ignored for some reason

    $transactions = []; // Creating an empty array for transactions to be stored

    while(($transaction = fgetcsv($file)) !== false) { // Read file line by line 
        if($transactionHandler !== null) {
            $transaction = $transactionHandler($transaction);
        }

        $transactions[] = $transaction; //put that data into the transactions array
    }
    return $transactions;
}

// Function to format each row
function extractTransaction(array $transactionRow): array {
    [$date, $checkNumber, $description, $amount] = $transactionRow; // Destructuring $transactionRow array

    $amount = (float) str_replace(['$', ','], '', $amount); //Looking at amount, replacing the specified values with nothing, so they get removed, so $amount just becomes a number ($100,000) becomes(100000)
    
    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount
    ];

}

// A function to calculate totals
function calculateTotals(array $transactions): array {
    
    $totals = [ // Creating a totals array and setting the values for each one
        'netTotal' => 0,
        'totalIncome' => 0,
        'totalExpense' => 0
    ];

    // Loop over all transactions
    foreach($transactions as $transaction) {
        $totals['netTotal'] += $transaction['amount'];

        if($transaction['amount'] >= 0) {
            $totals['totalIncome'] += $transaction['amount'];
        } else {
            $totals['totalExpense'] += $transaction['amount'];
        }
    }

    return $totals;
}