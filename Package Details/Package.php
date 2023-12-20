<?php 
include "../Database/database.php";
$Login= new Login("localhost","user","password","cinema");
$movie=[];
$package=$Login->getPackage();
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Package</title>
        <link rel="stylesheet" href="Package.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    
    <body>
        <div class="container">
            <div class="card-deck mb-3 text-center">
            <?php foreach( $package as $package)
            {
            ?>
                <div class="card1">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal"><?php echo $package["keyword"]?></h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title"><?php echo $package["packageName"]?></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                        <?php echo $package["packageDetail"]?>
                        </ul>
                    </div>
                </div>
                <?php }?>


            </div>
        </div>
    </body>
</html>
