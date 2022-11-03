<?php
//we should add pings, like @IFDoop, and make links clickable
  session_start(); 
 
if(isset($_GET['logout'])){    
     
    //Simple exit message
    $logout_message = "<div class='msgln'><span class='left-info'><b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat</span><br></div>";
    file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
     
    session_destroy();
    header("Location: index.php"); //Redirect the user
}
 
if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
}
 
function loginForm(){
    echo
    '<div id="loginform">
    <p>Please Login to continue</p>
    <form action="index.php" method="post">
      <label for="name">Name &mdash;</label>
      <input type="text" name="name" id="name" />
      <input type="submit" name="enter" id="enter" value="Enter" />
    </form>
  </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
} function family(){
  echo
  '<a href="https://ifdchat.ifdoop.repl.co/family/index.php"><button>FAMILY CHAT</button></a>';
}
 
?>
 
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
 
        <title>IFD Chat</title>
      <link rel="icon" href="file:///C:/Users/Roy%20wijaya/Pictures/IFD%20CHAT.png">
            <meta name="theme-color" content="#FFD500">
        <meta name="description" content="Public Chat, Fiery Theme" >
      
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
    <?php
    if(!isset($_SESSION['name'])){
        loginForm();
    }
    else {
    
}
?>
        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Welcome to IFD Chat, <b><?php echo $_SESSION['name'];?></b>!</p>
                <p class="logout"><a id="exit" href="https://IFDChat.ifdoop.repl.co/index.php">Logout</a></p>
            </div>
 
                        <div id="chatbox">
            <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $contents = file_get_contents("log.html");          
                echo $contents;
            }
            ?>
            </div>
 
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value=">" />
            </form>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js">   </script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });
 
                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
 //replace ajax code with sse code. i cant 
//because i dont know sse code and how to replace
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div
 
                            //Auto-scroll           
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }
                    
    $(document).ready(function() {
        if("<?php echo $timezone; ?>".length==0){
            var visitortime = new Date();
            var visitortimezone = "GMT " + -visitortime.getTimezoneOffset()/60;
            $.ajax({
                type: "GET",
                url: "http://ifdchat.ifdoop.repl.co/timezone.php",
                data: 'time='+ visitortimezone,
                success: function(){
                    location.reload();
                }
            });
        }
    });
                setInterval (loadLog, 1650);
 
 
                
                $("#exit").click(function () {
                    var exit = confirm("Are you sure you want to end the session?");
                    if (exit == true) {
                    window.location = "index.php?logout=true";
                    }
                });
            });
        </script>
      <a href="https://ifdchat.ifdoop.repl.co/001/index.php"><button>ROOM 001</button></a><a href="https://ifdchat.ifdoop.repl.co/002/index.php"><button>ROOM 002</button></a>
      <br><a href="https://ifdchat.ifdoop.repl.co/vintage/index.php"><button>Old Version</button></a><a href="https://ifdchat.ifdoop.repl.co/index.php"><button>HOME</button></a>
      <?php if(($_SESSION['name']=="IFDoop" || $_SESSION['name']=="Roy")) {
      family();
    } ?><br>
<br><br><br><br><br><button type="button"onclick="        black()">Black Theme</button><button type='button' onclick="fire()">Fire Theme</button><script>function black() {
var GEBTN = document.querySelector('body');
  
GEBTN.style = 'color:yellow;';

GEBTN.style.background= "black";


} function fire() {
var GEBTN = document.querySelector('body');
  
GEBTN.style = 'color:black;';

GEBTN.style.background= "linear-gradient(yellow, #ffa200, #c90000)";


  
}
</script><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <footer>1.4.1</footer>
      
    </body>
</html>
