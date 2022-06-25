<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>


<form class="form-horizontal" method="get" action="indexx.php">
    <fieldset>

        <!-- Form Name -->
        <legend>Connexion</legend>

        <input type='hidden' name='action' value='connexion'>
        <input type='hidden' name='controller' value='ControllerUtilisateur'>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">adresse mail</label>
            <div class="col-md-4">
                <input id="textinput" name="mail" type="text" placeholder="chantal-goya@yahoo.fr" class="form-control input-md" required>
            </div>
        </div>
        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="passwordinput">mot de passe</label>
            <div class="col-md-4">
                <input id="passwordinput" name="mdp" type="password" placeholder="124GHTUxu8@5" class="form-control input-md" required>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton"><p></p></label>
            <div class="col-md-12 text-center">
                <button id="singlebutton" class="btn btn-primary">Valider</button>
            </div>
        </div>

    </fieldset>
</form>