<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

/* YOUR CODE (Instructions in README.md) */
require APP_PATH . 'App.php'; // Requiring the code from app.php
require APP_PATH . 'helpers.php';

$files = getTransactionFiles(FILES_PATH); // Calling the function getTransactionFiles() set in app.php, with FILES_PATH as an argument

$transactions = []; // New empty transactions array
foreach($files as $file) { // Looping over all files pulled in from *** $files = getTransactionFiles(FILES_PATH); ***
    $transactions = array_merge($transactions, getTransactions($file, 'extractTransaction')); // Getting the transactions from the file and merging it with the emptry transactions array
}

$totals = calculateTotals($transactions);

require VIEWS_PATH . 'transactions.php'; // Requiring the transactions.php view file where the transactions variable will be available

// echo '<pre>';
// print_r($transactions);
// echo '</pre>';