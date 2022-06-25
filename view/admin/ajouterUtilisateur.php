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



<form class="form-horizontal" method="get" action="indexx.php">
    <fieldset>

        <!-- Form Name -->
        <legend>Ajout d'un utilisateur</legend>

        <input type='hidden' name='action' value='ajoutUtilisateur'>
        <input type='hidden' name='controller' value='ControllerUtilisateur'>

        <!-- mail -->
        <div class="form-group" style="display: flex">
            <label class="col-md-4 control-label" for="textinput">adresse mail</label>
            <div class="col-md-4">
                <input id="mail" name="mail" type="text" placeholder="chantal-goya@yahoo.fr" class="form-control input-md" required onkeyup="erreurmail(this);">
            </div>
            <div class="col-md-3" id="erreurMail" style="border: solid; color: lightcoral; text-align: center; display: none">vous devez entrez une adresse mail valide !  </div>
        </div>
        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="passwordinput">mot de passe</label>
            <div class="col-md-4">
                <input id="passwordinput" name="mdp" type="password" placeholder="124GHTUxu8@5" class="form-control input-md" required>
            </div>
        </div>
        <!-- prenom-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">prenom</label>
            <div class="col-md-4">
                <input id="textinput" name="prenom" type="text" placeholder="chantal" class="form-control input-md" required>
            </div>
        </div>
        <!-- nom-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">nom</label>
            <div class="col-md-4">
                <input id="textinput" name="nom" type="text" placeholder="goya" class="form-control input-md" required>
            </div>
        </div>
        <!-- adresse-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">adresse</label>
            <div class="col-md-4">
                <input id="textinput" name="adresse" type="text" placeholder="68 Rue Goya 34000 Montpellier" class="form-control input-md" required>
            </div>
        </div>
        <!-- type d'utilisateur-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">estAdmin</label>
            <div class="col-md-4">
                <input id="textinput" name="estAdmin" type="text" placeholder="0 ou 1" class="form-control input-md" required>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton"><p></p></label>
            <div class="col-md-12 text-center">
                <button id="singlebutton" class="btn btn-primary" onclick='return validForm();'>Valider</button>
            </div>
        </div>

    </fieldset>
</form>

<script type="text/javascript">

    window.value = false; //le seul moyen que j'ai trouvé pour faire une variable globale :(

    function erreurmail(email) {
        let formOk;
        var e = document.querySelector('#erreurMail');
        var valid = (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(email.value);
        if (valid) { //si le courriel est valide, on cache l'erreur
            e.style.display = 'none';
            window.value = true;
            return false;
        } else {
            e.style.display = 'block';
            window.value =  false;
            return true;
        }
    }
    function validForm(){
        console.log(window.value)
        if (window.value){ return true;}
        return false;
    }

</script>


</body>
</html>