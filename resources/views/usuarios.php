<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?> </title>
</head>
<body>
    <h1>Usuarios</h1>

    <?php foreach ($usuarios as $value) : ?>
        <li> <?= htmlspecialchars($value["nombre"]). ' *** ' .htmlspecialchars($value['apellido']). ' *** ' .htmlspecialchars($value['email']); ?> </li>
    <?php endforeach; ?>

</body>
</html>