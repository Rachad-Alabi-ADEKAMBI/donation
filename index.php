<?php
include 'db.php';

//$req = $pdo->query("SELECT * FROM pays ORDER BY id ASC ");

if (isset($_GET['q']) AND !empty($_GET['q'])){
    $q = htmlspecialchars($_GET['q']);

    $req = $pdo->query('SELECT *
    FROM pays WHERE nom_en_gb LIKE  "%'.$q.'%"');
}
 
//$req->execute(array('Ang'));



?>
    
    
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Which country is the most generous ? - Home</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="vote">
        <h1 class="vote__title">
            Which country is the most generous ?
        </h1>
      

        <div class="vote__top">
            <?php  
                $sql = $pdo->query("SELECT * FROM pays ORDER BY total DESC
                LIMIT 1 OFFSET 1 ");
                
                $sql->execute();
                
                while ($datas = $sql->fetch()){     ?>
                    <div class="vote__top__element">

                        <img src="<?php echo strtolower($datas['alpha2']) ?>.png" alt="">
                            <h2 class="country">
                                <?php
                                  $nbr = strlen($datas['nom_en_gb']) ;
                                  

                                  if ($nbr >= 10){
                                      echo substr($datas['nom_en_gb'], 0, 6).'..';
                                  }
                  
                                  if ($nbr <10){
                                      echo $datas['nom_en_gb'];
                                  }
                                  ?>
                            </h2>

                            <p>
                            <?= $datas['total'] ?> € donated
                            </p>

                            <button>
                                <a href="donation.php?id=<?= $datas['id'] ?>">
                                    Vote now
                                </a>
                            </button>

                            <div class="prize">
                                <i class="fas fa-trophy second"></i>
                            </div>
                    </div>
                <?php } ?>


                <?php  
                $sql = $pdo->query("SELECT * FROM pays ORDER BY total DESC
                LIMIT 1");
                
                $sql->execute();
                
                while ($datas = $sql->fetch()){     ?>
                    <div class="vote__top__element first">
                    <img src="<?php echo strtolower($datas['alpha2']) ?>.png" alt="">
        
                        <h2 class="country">
                        <?php
                                  $nbr = strlen($datas['nom_en_gb']) ;

                                  if ($nbr >= 10){
                                      echo substr($datas['nom_en_gb'], 0, 6).'..';
                                  }
                  
                                  if ($nbr <10){
                                      echo $datas['nom_en_gb'];
                                  }
                                  ?>
                        </h2>
        
                        <p>
                        <?= $datas['total'] ?> € donated
                        </p>
        
                        <button>
                            <a href="donation.php?id=<?= $datas['id'] ?>">
                                Vote now
                            </a>
                        </button>
        
                        <div class="prize">
                            <i class="fas fa-trophy first"></i>
                        </div>
                    </div>
                <?php } ?>


                <?php  
                $sql = $pdo->query("SELECT * FROM pays ORDER BY total DESC
                LIMIT 1 OFFSET 2 ");
                
                $sql->execute();
                
                while ($datas = $sql->fetch()){     ?>
                    <div class="vote__top__element">
                    <img src="<?php echo strtolower($datas['alpha2']) ?>.png" alt="">
                        <h2 class="country">
                        <?php
                                  $nbr = strlen($datas['nom_en_gb']) ;

                                  if ($nbr >= 10){
                                      echo substr($datas['nom_en_gb'], 0, 6).'..';
                                  }
                  
                                  if ($nbr <10){
                                      echo $datas['nom_en_gb'];
                                  }
                                  ?>
                        </h2>
        
                        <p>
                        <?= $datas['total'] ?> € donated
                        </p>
        
                        <button>
                            <a href="donation.php?id=<?= $datas['id'] ?>">
                                Vote now
                            </a>
                        </button>
        
                        <div class="prize">
                            <i class="fas fa-trophy third"></i>
                        </div>
                    </div>
                <?php }  ?>
        </div>

        <div class="vote__bottom">
              <?php
                $sql = $pdo->query("SELECT * FROM pays ORDER BY total DESC 
                        LIMIT 7 OFFSET 3 ");
                        
                        $sql->execute();

                        $i= 3;
                    
                        while ($datas = $sql->fetch()){     ?>
                    <div class="vote__bottom__element">
                        <div class="rank">
                            <?php 
                            $i++;
                        echo $i;

                            ?>
                        </div>

                        <img src="<?php echo strtolower($datas['alpha2']) ?>.png" alt="Flag">
                
                        <p class="country">
                        <?php   $nbr = strlen($datas['nom_en_gb']) ;

                        if ($nbr >= 10){
                            echo substr($datas['nom_en_gb'], 0, 6).'..';
                        }

                        if ($nbr <10){
                            echo $datas['nom_en_gb'];
                        }

                        ?>
                        
                        </p>

                        <div class="donation">
                        <?= $datas['total'] ?> € donated
                        </div>

                        <button>
                                    <a href="donation.php?id=<?= $datas['id'] ?>">
                                        Vote now
                                    </a>
                                </button>
                    </div>
                <?php } ?>           
        </div>

        <div class="vote__search">
            <form action="" method="GET">
                <input type="search" placeholder="USA" name="q"> <br>
                
                <button type="submit" >
                    Search
                </button>
            </form>

            <ul>
               
                    <?php
                while ($datas = $req->fetch()){?>
               <li>  <img src="https://ipdata.co/flags/<?php echo strtolower($datas['alpha2']) ?>.png" alt="Flag">
                 <?= $datas['nom_en_gb']; ?>  <button>
                                    <a href="donation.php?id=<?= $datas['id'] ?>">
                                        Vote now
                                    </a>
                                </button> </li> <br>
               <?php }?>
            </ul>

        </div>
    </div>
</body>
</html>