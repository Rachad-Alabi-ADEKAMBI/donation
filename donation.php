<?php

include 'db.php';

$id = htmlspecialchars($_GET['id']) ;

$sql = $pdo->prepare("SELECT * FROM pays 
WHERE id = ?");

$sql->execute(array($id));

if (!empty ($_POST)){

    $errors = array ();

    if (empty ($_POST['amount'] || $_POST['amount'] < 0)) {
        $errors['amount'] = 'Invalid value for amount!';
    }

    if(empty($errors)){
                               
        //insertion dans la table users
        $amount = htmlspecialchars($_POST['amount']) ;

         $amountRounded =  number_format($amount, 2, ',', ' ');

        $amountFormated = str_replace(",",".",$amountRounded);

        $searchString = " ";
        $replaceString = "";
        $originalString = $amountFormated;
        $outputString = str_replace($searchString, $replaceString, $originalString); 
        
     //echo $outputString;

        header ("Location: paypal.php?id=$id&amount=$outputString");
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Which country is the most generous - Donation</title>
</head>
<body>

<div class="paypal">
            <a href="index.php"class="form__close" >
                <i class="fas fa-times"></i>
            </a>
        <h1>
        how generous do you want to be for your country ?
             <?php
            while ($datas = $sql->fetch()){  
            ?> ( <?=$datas['nom_en_gb']?>)<?php
            }
               ?>
            


        </h1> 

        <form method="POST" action="" >
            <input type="number" name="amount"  step="any"
            onkeyup="if(this.value<0){this.value= this.value * -1}" /> <br>

            <button type="submit" class="bouton" >
               Vote
            </button>
        </form>
        
    </div>

    



   

    <style>
        .paypal{
            margin: 50px auto;
            padding-top: 10px;
            text-align: center;
            width: 330px;
            height: 350px;
            padding-left: 10px;
            margin-bottom: 40px;
            border-radius: 10px;
            box-shadow: 0px 5px 28px #00000029;
        
        }
        
        .logo{
            width: 130px;
            margin: auto;
        }

        i{
            color: #222563;
            float: right;
            margin-right: 30px;
        }

        h1{
            color: #222563;
            font-size: 1.1em;
            margin: 40px auto;
        }

        .paypal__text{
            text-align: left;
        }

        input{
            font-size: 1px solid #222563;
            font-weight: bold;

        }

        span{
            color: #222563;
            font-weight: bold;
            font-size: 1.5em;
            text-align: right;
            margin-right: 0;
        }

        .bouton  span{
            font-weight: bold;    
            font-size: 1.4em;
            margin-top: -10px;
            float: right;
        }

        .paypal__text  span strong{
            color: #222563;
            font-weight: bold;
            font-size: 1em;
        }

        button{
                width: 160px;
                height: 40px;
                border: 1px black solid;
                font-size: 1em;
                margin:  20px auto;
                border-radius: 20px;
                text-align: center;
                background-color: rgba(28,31,73,255);
                border-color: rgba(28,31,73,255);
                font-weight: bold;  
                cursor: pointer;
                background-color: rgba(28,31,73,255);
                border-color: rgba(28,31,73,255);
                color: rgb(25, 206, 122);
            }


        .paypal-button-container:hover{
            transform: scale(1.1);
        }
</style>
</body>
</html>