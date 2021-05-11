<?php
    include 'classes/db.php';

    $init_db = new Database();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(empty($_POST['tekst'])) {
            Header('Loction: index.php');
        }

        $init_db->insert($_POST);
    }

    $teksts = $init_db->get_all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <?php

        echo '<h3>Pokušaj polaganja ispita</h3> <br><br>';
        

        echo '<br><br>';

    ?>
    <hr>
    <form action="" method="post">
        <input type="text" name="auti" placeholder="Unesi ime automobila">
        <br>
        <input type="submit" value="Spremi">
    </form>
    <hr>
    <br><br>
    <h2>Popisa automoblia</h2>

    <?php if(!empty($teksts)): ?>
        <table border="1">
            <tr>
                <th>RB</th>
                <th>Ime Automobila</th>
                <th>Akcije</th>
            </tr>
            <?php foreach($teksts as $tekst): ?>
                <tr>
                    <td><?php echo $tekst['id']; ?></td>
                    <td><?php echo $tekst['auti']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $tekst['id']; ?>" >Ažuriraj</a> | 
                        <a href="delete.php?id=<?php echo $tekst['id']; ?>" >Izbriši</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <hr>
</body>
</html>