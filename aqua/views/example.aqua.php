<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AquaFramework</title>

    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

</head>
<body>

<div>
    <h1>Your IP: {{ ip }}</h1>

    <form method="post" action="example">

        <input type="text" name="name" value="{{name}}">
        <input type="hidden" name="_token" id="csrf-token" value="{{_token}}" />

        <button type="submit">Absenden</button>

    </form>

</div>

</body>
</html>