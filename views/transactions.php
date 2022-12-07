<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if(! empty($transactions)): ?> <!-- Checking to see if variable transactions exists -->
                    <?php foreach($transactions as $transaction): ?> <!-- Looping through transactions -->
                        <tr> <!-- displaying data from each interation into seperate columns by their key --> 
                            <td><?= formatDate($transaction['date']) ?></td> <!-- DATE-->
                            <td><?= $transaction['checkNumber'] ?></td> <!-- CHECK -->
                            <td><?= $transaction['description'] ?></td> <!-- DESCRIPTION -->
                            <td>
                                <?php if($transaction['amount'] < 0): ?> <!-- If the amount is negative then make it red-->
                                    <span style="color: red;">
                                        <?= formatDollarAmount($transaction['amount']) ?> <!-- AMOUNT -->
                                    </span>
                                <?php elseif($transaction['amount'] > 0): ?> <!-- else make it green-->
                                    <span style="color: green;">
                                        <?= formatDollarAmount($transaction['amount']) ?> <!-- AMOUNT -->
                                    </span>
                                <?php else: ?>
                                    <?= formatDollarAmount($transaction['amount']) ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?= formatDollarAmount($totals['netTotal']) ?? 0 ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?= formatDollarAmount($totals['totalExpense']) ?? 0 ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?= formatDollarAmount($totals['totalIncome']) ?? 0 ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
