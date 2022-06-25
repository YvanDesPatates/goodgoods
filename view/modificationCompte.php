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
        <legend>Création de compte</legend>

        <div style="width: 100%; text-align: center; margin-bottom: 30px"> <h4> Entrez les informations que vous souhaitez changer et validez </h4> </div>

        <input type='hidden' name='action' value='modifierCompte'>
        <input type='hidden' name='controller' value='ControllerUtilisateur'>

        <!-- mail -->
        <div class="form-group" style="display: flex">
            <label class="col-md-4 control-label" for="textinput"> prenom </label>
            <div class="col-md-4">
                <input id="prenom" name="prenom" type="text" placeholder="votre prenom" class="form-control input-md">
            </div>
        </div>
        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="passwordinput">ancien mot de passe</label>
            <div class="col-md-4">
                <input id="ancienMdp" name="ancienMdp" type="password" class="form-control input-md" >
            </div>
        </div>
        <!-- psw new -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="passwordinput">nouveau mot de passe</label>
            <div class="col-md-4">
                <input id="passwordinput" name="nouveauMdp" type="password" class="form-control input-md" onkeyup="erreurMdpIdentique(this);" >
            </div>
            <div class="erreur" style="display: none" id="erreurMdp">votre nouveau mot de passe doit être différent de l'ancien </div>
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

    window.value = true; //le seul moyen que j'ai trouvé pour faire une variable globale :(

    function erreurMdpIdentique(champ) {
        if (champ.value != ""){
            e = document.querySelector('#erreurMdp');
            if (champ.value != document.querySelector('#ancienMdp').value){
                window.value = true;
                e.style.display = 'none';
            }else {
                window.value = false;
                e.style.display = 'block';
            }
        }else window.value = true;
    }
    function validForm(){
        console.log(window.value)
        if (window.value){ return true;}
        return false;
    }

</script>


</body>
</html>