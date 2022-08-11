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
                $etudiant = "SELECT * FROM etudiant";
                $student = $conn->query($etudiant);
            ?>
            <form method="POST" action="Info.php" >
                <div class="container">
                    <div class="centered-element"><div class="info"><table>
                        <thead>
                            <tr style="height: 50px;">
                                <th>ID</th>
                                <th style="width: 100px;">Nom</th>
                                <th style="width: 100px;">Prénom</th>
                                <th style="width: 100px;">E-mail</th>
                            </tr>
                        </thead>
                        <?php
                            while($info = $student->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $info['IdEtudiant'];?></td>
                                <td><?php echo $info['nom'];?></td>
                                <td><?php echo $info['prenom'];?></td>
                                <td><?php echo $info['mail'];?></td>
                            </tr>
                        <?php } ?>
                    </table></div></div>
                    
                    <div class="ajout">
                        <p>Entrez l'ID de l'élève 
                            <input type="number" name="IdEtudiant">
                            <button style="border-radius: 30px; background-color: rgb(206, 223, 231);" name="button">Entrer</button>
                        </p>
                        <?php 
                            ob_start();   
                            if (isset($_POST['button'])){
                                $_SESSION['IdEtudiant'] = $_POST['IdEtudiant'];
                                header('Location: Message.php');
                                exit();
                            }
                            ob_end_flush();
                        ?>

                        <p>Ou bien ajouter un élève dans la base de donnée:</p>
                        <input type="text" name="Nom" placeholder="Nom">
                        <input type="text" name="Prénom" placeholder="Prénom">
                        <input type="email" name="Email" placeholder="Email">
                        <input type="number" name="nbHeure" placeholder="Nombre d'Heure">
                        <button style="border-radius: 30px; background-color: rgb(206, 223, 231);" name="submit">Enregistrer</button>
                    </div>

                    <?php
                        ob_start();
                        if (isset($_POST['submit'])) {
                            $nom = $_POST['Nom'];
                            $prenom = $_POST['Prénom'];
                            $mail = $_POST['Email'];
                            $nbHeur = $_POST['nbHeure'];

                            $sql = mysqli_query($conn, "INSERT INTO etudiant (nom, prenom, mail) 
                            VALUES ('$nom', '$prenom', '$mail'); INSERT INTO convention (nom, nbHeur) 
                            VALUES ('$nom', '$nbHeur')");

                            $connect = mysqli_query($conn, "SELECT * FROM etudiant WHERE nom = '$nom' AND prenom = '$prenom'");
                            $save = $connect->fetch_assoc();
                            $_SESSION['IdEtudiant'] = $connect['IdEtudiant'];
                            header('Location: Message.php');
                            exit();
                        }
                        ob_end_flush();
                    ?>    
                </div>
            </form>
            <?php $conn->close(); ?>
        </body>
    </html>