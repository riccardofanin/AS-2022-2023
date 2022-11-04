<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="Post" action="pagina2.php">
        <label for="tRighe">Righe: </label>
        <input type="number" name="tRighe" min="0">
        <label for="tColonne">Colonne </label>
        <input type="number" name="tColonne" min="0">

        <select name="colore">
            <option value="true">si</option>
            <option value="false">no</option>
        </select>

        <input type="submit" value="">
    </form>
</body>
</html>