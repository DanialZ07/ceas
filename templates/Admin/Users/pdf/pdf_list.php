<!DOCTYPE html>
<html>

<head>
    <title>PDF</title>
    <style>
        @page {
            margin: 10px 10px 10px 10px !important;
            padding: 0px 0px 0px 0px !important;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>USER LIST</h1>
    <table border="1" width="100%">
        <tr>
            <td>ID</td>
            <td>Group</td>
            <td>Fullname</td>
            <td>Email</td>
            <td>Status</td>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= h($user->id) ?></td>
                <td><?= h($user->user_group->name) ?></td>
                <td><?= h($user->fullname) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->status) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>