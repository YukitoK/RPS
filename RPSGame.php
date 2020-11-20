<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "rps";

$con = mysqli_connect($dbServername, $dbUsername, $dbPassword,$dbName);

if(mysqli_connect_error()){
    echo "Failed to connect!";
    exit();
}else{
    //echo "DB connected !";
}


if(isset($_POST['submit']) == true){
    //hold a variable
    $username = $_POST['username'];
    //trim(mysqli_real_escape_string(strip_tags(stripslashes($_POST['username']))));
    //store Session
    $_SESSION['username'] = $username;

    //redirect the user
    header("Location: ./RPSIndex.php");// link checken später
}
    
if (isset($_GET['logout']) == true){
    session_destroy();
    header("Location: ./RPSIndex.php");
}
    

function display_items($item = null){

    $items = array(
    "rock"      =>'<div align="left"><a href="?item=rock"><img src="./rock.jpg" width="150" height="150" alt="Rock"></a></div>',
    "paper"     =>'<div align="left"><a href="?item=paper"><img src="./paper.jpg" width="150" height="150" alt="Rock"></a></div>',
    "scissor"   =>'<div align="left"><a href="?item=scissor"><img src="./scissor.jpg" width="150" height="150" alt="Rock"></a></div>'
    );
if($item == null){
    foreach($items as $item => $value){
        echo $value;
    }
  }else{
      //echo $items[$item];
      echo str_replace("?item={$item}", "#", $items[$item]);
  }
}

function game(){
    if(isset($_GET['item']) == true){
       // Valid items
       $items = array('rock','paper','scissor');

       //Users item
       $user_item = strtolower($_GET['item']);

       //Computer item
       $comp_item = $items[rand(0, 2)];

       

       //Users item is valid
       if(in_array($user_item, $items) == false){
           echo "You must choose R, P, S";
           die();
       }
    //Scissor > Paper
    //Paper > Rock
    //Rock > Scissor
        display_items($user_item);
        display_items($comp_item);

    if( $user_item == 'scissor' && $comp_item == 'paper' ||
        $user_item == 'paper'   && $comp_item == 'rock' ||
        $user_item == 'rock'    && $comp_item == 'scissor'){
            echo "<div align='left'><br><h2>YOU WIN !</h2></div>";
            $win = 'Yes';
            $loss = null;
            $tie = null;
        }
    
        if( $comp_item == 'scissor' && $user_item == 'paper' ||
            $comp_item == 'paper'   && $user_item == 'rock' ||
            $comp_item == 'rock'    && $user_item == 'scissor'){
                echo "<div align='left'><br><h2>YOU LOOSE !</h2></div>";
            $win = null;
            $loss = 'No';
            $tie = null;

        }    

        if($user_item == $comp_item){
            echo "<div align='left'><br><h2>TIE !</h2></div>";
            $win = null;
            $loss = null;
            $tie = 'tie';
        }

        
        echo '<br><button type="button" class="btn btn-dark"><a href="./RPSIndex.php">Play Again!</a></button>';

        $sql = "INSERT INTO rpstable (id, username, win, tie, loss) VALUES ('', '{$_SESSION['username']}','$win','$tie','$loss');";
        mysqli_query($GLOBALS['con'], $sql);

    }else{
        display_items();
}
}
?>