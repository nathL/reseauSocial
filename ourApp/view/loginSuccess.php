<?php if($context->formDisplay == true){ echo '
<form method="post" action="ourApp.php?action=login">
   <label>Votre login</label> : <input type="text" name="login" /><br />
   <label for="pass">Votre mot de passe :</label>
   <input type="password" name="pass" id="pass" /><br />
   <input type="submit" value="Envoyer" />
</form>'; 
}else{
    echo '<p>Bienvenue sur notre application</p>'; 
}
