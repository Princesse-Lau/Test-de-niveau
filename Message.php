<?php
    session_start();  

    $conn = mysqli_connect("localhost","root","","exercice");                    
    if($conn->connect_error) die('Erreur : ' .$conn->connect_error);
?>
<!DOCTYPE html>
	<html>
        <head>
            <title>Attestation</title>
            <meta charset="utf-8"> 
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel = "stylesheet" href = "exercice.css">
        </head>
        <body>
            <?php 
                $etudiant = "SELECT * FROM etudiant WHERE IdEtudiant = '{$_SESSION['IdEtudiant']}'";
                $student = $conn->query($etudiant);

                /*$idconv = $etu['convention'];
                $convention = "SELECT * FROM convention WHERE idConvention = '$idconv'";
                $conv = $conn->query($convention);*/
            ?>
            <form method="POST" action="Message.php">
                <div class="container">
                    <?php
                        while($info = $student->fetch_assoc() /*&& $rmation = $conv->fetch_assoc()*/) {
                    ?>
                    
                    <div class="centered">
                        <p style="font-family: fantasy; font-size: x-large; text-align: center;">Envoyer à <?php echo $info['mail'];?></p>
                        <br>
                        <br>
                        <?php /*$info = $student->fetch_assoc(); $rmation = $conv->fetch_assoc()*/?>
                        <p style="font-size: large;">Bonjour <?php echo $info['nom'];?> <?php echo $info['prenom'];?>
                        <br>
                        <br>
                        <br>
                        Vous avez suivi <?php /*echo $rmation['nbHeur'];*/?> de formation chez FormationPlus.
                        <br>
                        Pouvez-vous nous retourner ce mail avec la pièce jointe signée.
                        <br>
                        <br>
                        <br>
                        Cordialement,<br>FormationPlus
                        <br></p>
                        <input type="submit" name="submit" value="Envoyer">
                    </div><?php }?>          
                </div>
            </form>
            <?php    
                if (isset($_POST['submit'])) {
                    /*$Text = "Bonjour '$info['nom']' '$info['prenom']'
                    Vous avez suivi '$convention['nbHeur'] de formation chez FormationPlus.
                    Pouvez-vous nous retourner ce mail avec la pièce jointe signée.
                    Cordialement,FormationPlus";*/

                    $connect = mysqli_query($conn, "INSERT INTO atestation (etudiant, convention, message) 
                            VALUES ('{$_SESSION['IdEtudiant']}', '$idconv', '$Text');");

                    header('Location: Index.php');
                    exit();
                }
            ?>
            <?php $conn->close(); ?>
        </body>
    </html>