<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         *{
    margin: 0;
    
}
header{
    background-color: #00205b!important; 
    color:whitesmoke;height: 100px;
}
header a{
position: absolute;
right: 100px;
    color: whitesmoke;
 font-size: 3rem;
 top: 10px;
}
header h1{
    padding-top: 30px;
}
.home{
    text-decoration: none;
}
.dashbord{
    display: grid;
    column-gap: 2rem;
    grid-template-columns: 1fr 1fr;
   
}
.dash{
    margin-top: 200px;
    display: grid;
    grid-template-columns: repeat(3,1fr);
    column-gap: 10rem;
    height: 15rem;
    
   

}
.class {
    border: black solid 0.1px;
    position: relative;
    right: 200px;
}

.frame{
    display: grid;
    width: 38%;
    height: 500px;
    margin-left: 4%;
    margin-top: 4%;
  /*   border: black solid 0.1px; */
    padding: 15px;
    border-radius: 20px;

}
.task{
    display: grid;
    border: solid black 0.1px;
    height: 4rem;
    text-decoration: none;
    color: black;
    margin: 10px;
    text-align: center;
    background-color: rgb(202, 201, 200);
    border-radius: 10px;
}
marquee{
    position: relative;
    left: 100px;
    font-size: 4rem;
    top: -2rem;
    
}
header h1{
    margin-left: 100px;
}
.inputt{
    width: 500px;
    height: 50px;
}
.input1{
    display: grid;
    
   
}
 .back{
    height: 50px;
    text-decoration: none;
    color: black;
 

}
.backk{  
    margin-left: 500px
}
.notification{
    position: absolute;
text-align: center;
top: 1000px;
}
        .post{
            display:grid;
            border: 1px solid gray;
            height:300px;
            width:50%;
            text-align:center;
            margin-left:25%;
            border-radius:20px;
            overflow:auto;
            padding:10px;
        }
        .h1news{
            text-align:center;
            margin-top:2%;
        }
        .title{
            text-align:center;
        }
    </style>
</head>
<body>
<header>
        <h1>School logo</h1>
        <a href="/mysm/Home Page/index.html" class="home">Back home</a>
    </header>
<?php
// Establish database connection (replace with your own database credentials)
$hostname = 'localhost';
$username = "root";
$password = "";
$db_name = "mysms";

// Establish a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed");

}
else{
$sql="SELECT Post, Title FROM news";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    ?><h1 class="h1news">News</h1><br><br><?php
    ?><div class="news"><?php  

while ($row = mysqli_fetch_assoc($result)){
    ?><p class="title"><?php echo $row["Title"] ?> </p><br> </div><?php
    ?><p class="post" style><?php echo $row["Post"] ?> </p><br><br><br><?php  
    
}
}


}

?>
</body>
</html>