<?php session_start(); ?>
<?php include 'RPSGame.php' ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Rock Paper Scissors</title>
            <style>
              a:link {
                color: white;
                background-color: transparent;
                text-decoration: none;
              }

              a:visited {
                color: white;
                background-color: transparent;
                text-decoration: none;
              }

              a:hover {
                color: white;
                background-color: transparent;
                text-decoration: none;
              }

              a:active {
                color: white;
                background-color: transparent;
                text-decoration: none;
              }
            </style> 
  </head>
  <body>
    
    <?php if(isset($_SESSION['username']) == False){ ?>
      <div class="jumbotron">
            <form method="post">
            <h2>Enter Username to Play</h2>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button class="btn btn-dark" type="submit" name="submit" id="button-addon1">Play</button>
                </div>
              <input type="text" name="username" placeholder="Username" id="username" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
            </div>
      </div>
              
    <?php }else{ ?>
            <div class="jumbotron" id="game">
                   <h3>Welcome Back <?php echo $_SESSION['username'] ?></h3> 
                   <div><button type="button" class="btn btn-dark"><a href="?logout=true">Logout</a></button></div>
                   <br>
                <?php game(); ?>
            

    <?php } ?>

    <?php  
    if(!empty($_SESSION['username'])){

    ?>
    <div class="container" style="width: 400px; height: 300px; float: right; margin-top:-350px; margin-right:200px;overflow: scroll;">
      <table class="table table-dark " style="line-height:25px;">
        <tr>
          <th>User</th>
          <th>Wins</th>
          <th>Losses</th>
          <th>Ties</th>
        </tr>
    <?php
    $sql = "SELECT *,sum(tie)as tie,sum(loss)as loss, sum(win)as yes 
            FROM rpstable 
            GROUP BY username
            ORDER BY sum(win) DESC;"; 
    
    
    $results = mysqli_query($con, $sql);
    $check = mysqli_num_rows($results);

    if($check > 0){
        while($row = mysqli_fetch_assoc($results)){

            ?>
            <tr>
              <td><?php echo $row['username'] ?></td>
              <td><?php echo $row['yes'] ?></td>
              <td><?php echo $row['loss'] ?></td>
              <td><?php echo $row['tie'] ?></td>
            </tr>  
            <?php
            
        }
    }
  }
    ?>
    </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>