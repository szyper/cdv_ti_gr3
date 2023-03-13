<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
	<h4>Lista</h4>
	<ul>
		<li>
			Poznań
			<ol type="A">
				<li>Polna</li>
				<li>Gnieźnieńska</li>
			</ol>
		</li>
		<li>Gniezno</li>
		<li>Jarocin</li>
	</ul>

    <?php
        $city = "Poznań";
        echo <<< LIST
            <hr>HEREDOC<br>
            <ul>
                <li>
                    $city
                    <ol type="A">
                        <li>Polna</li>
                        <li>Gnieźnieńska</li>
                    </ol>
                </li>
                <li>Gniezno</li>
                <li>Jarocin</li>
	        </ul>
LIST;

    ?>
</body>
</html>