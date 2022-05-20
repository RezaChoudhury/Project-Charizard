<?php
session_start();
require_once('incl/connect.php');
$listSql= " SELECT *
            FROM list
            LEFT JOIN users ON list.uid = users.id
            ORDER BY list.lid
            ASC";
$listResult = $db->query($listSql);
//$listRow = $listResult->fetch(PDO::FETCH_ASSOC);
//Login
/* if(isset($_POST['login']) & !empty($_POST['login'])) {
    if(empty($_POST['loginUser'])){ $errors[]="Please enter your username/email.";}
    if(empty($_POST['loginPassword'])){ $errors[]="Please enter your password.";}
    if(empty($errors)){
		//checks login info
			$loginSql = "SELECT * FROM users WHERE ";
			if(filter_var($_POST['loginUser'], FILTER_VALIDATE_EMAIL)){
				$loginSql .="email=?";
			}else{
				$loginSql .="username=?";
			}
			$loginResult = $db->prepare($loginSql);
			$loginResult->execute(array($_POST['loginUser']));
			$loginCount = $loginResult->rowCount();
			$loginRes = $loginResult->fetch(PDO::FETCH_ASSOC);
			if ($loginCount == 1){
				if(password_verify($_POST['loginPassword'], $loginRes['password'])){
					// regenerate session id
					session_regenerate_id();
					$_SESSION['login'] = true;
					$_SESSION['id'] = $loginRes['id'];
					$_SESSION['last_login'] = time();
					
					//redirect to members page
				
				echo("<script>location.href = 'index.php';</script>");
				}else{
					$errors[]="Username or password is incorrect";
				}
			}else{
				$errors[]="This Email/Username does not exist.";
			}
						
	}
} */

//Registration
if(isset($_POST['reg']) & !empty($_POST['reg'])) {
    if(empty($_POST['username']) || strlen($_POST['username']) < 5) {
        $errors[]="Your username must be atleast 5 characters."; 
    }
    else {
        $sql = "SELECT * 
                FROM users
                WHERE username=?";
        $result = $db->prepare($sql);
        $result->execute(array($_POST['username']));
        $count = $result->rowCount();
        if($count == 1) {
            $errors[]="This username is already taken!";
        }
    }
    if(empty($_POST['email'])){ $errors[]="Please enter a valid email address";}
    else {
        $sql = "SELECT * users
                WHERE email=?";
        $result = $db->prepare($sql);
        $result->execute(array($_POST['email']));
        $count = $result->rowCount();
        if($count == 1) {
            $errors[]="This email is already registered!";
        }
    }
    if(empty($_POST['password']) || strlen($_POST['password']) < 6) {
        $errors[]="Your password must contain atleast 6 characters."; }
    else {
        if(empty($_POST['passwordC'])) {
            $errors[]="Please confirm your password."; 
        } else {
            if($_POST['password'] == $_POST['passwordC']) {
                $passHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            } else {
                $errors[]="Passwords do not match.";
            }
        }
    }
      
    if(empty($errors)) {
        $sql = "INSERT INTO users (username, email, `password`) VALUES (:username, :email, :passHash)";
        $result = $db->prepare($sql);
        $values = array(':username'     => $_POST['username'],
                        ':email'        => $_POST['email'],
                        ':passHash'     => $passHash
                        );
        $res = $result->execute($values)or die(print_r($result->errorInfo(), true));;
        
        if($res) {
            $messages[]="Registration was successful you will be redirected in 5 seconds.";
            echo("<script>
            setTimeout(function(){
                window.location.href = 'index.php';
             }, 5000);
            </script>");
        }else{
            $errors[]="Something went wrong!";
            
        }
        
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fake property listing</title>
        <script src="script.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.1/css/all.css" type="text/css">
        <script src="https://kit.fontawesome.com/355bb21480.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>

    <body>
        <div class="backer"></div>
        <?php include('incl/navbar.php'); ?>

        <main>
            <div class="mainWrapper">
                <div class="search downAnim"> 
                <?php if(!empty($errors)) {
                    echo '<div class="error">';
                    foreach($errors as $error) {
                        echo $error;
                    }
                    echo '</div>';
                }
                ?>         
                <form role="form" method="post" action="">
                    <span>Location</span>
                    <input type="text" autocomplete="off" name="locationSearch" value="<?php if(isset($_POST['locationSearch'])) { echo $_POST['locationSearch']; } ?>" placeholder="Where are you going?">
                    <span>Min price</span>
                    <select name="min" id="min" value="0">
                    <option value="0">No min</option><option value="100">&pound;100 pcm</option><option value="200">&pound;200 pcm</option><option value="300">&pound;300 pcm</option><option value="400">&pound;400 pcm</option><option value="500">&pound;500 pcm</option><option value="600">&pound;600 pcm</option><option value="700">&pound;700 pcm</option><option value="800">&pound;800 pcm</option><option value="900">&pound;900 pcm</option><option value="1000">&pound;1,000 pcm</option><option value="1250">&pound;1,250 pcm</option><option value="1500">&pound;1,500 pcm</option><option value="1750">&pound;1,750 pcm</option><option value="2000">&pound;2,000 pcm</option><option value="2250">&pound;2,250 pcm</option><option value="2500">&pound;2,500 pcm</option><option value="2750">&pound;2,750 pcm</option><option value="3000">&pound;3,000 pcm</option><option value="3250">&pound;3,250 pcm</option><option value="3500">&pound;3,500 pcm</option><option value="3750">&pound;3,750 pcm</option><option value="4000">&pound;4,000 pcm</option><option value="4250">&pound;4,250 pcm</option><option value="4500">&pound;4,500 pcm</option><option value="4750">&pound;4,750 pcm</option><option value="5000">&pound;5,000 pcm</option><option value="5500">&pound;5,500 pcm</option><option value="6000">&pound;6,000 pcm</option><option value="6500">&pound;6,500 pcm</option><option value="7000">&pound;7,000 pcm</option><option value="7500">&pound;7,500 pcm</option><option value="8000">&pound;8,000 pcm</option><option value="8500">&pound;8,500 pcm</option><option value="9000">&pound;9,000 pcm</option><option value="9500">&pound;9,500 pcm</option><option value="10000">&pound;10,000 pcm</option><option value="12500">&pound;12,500 pcm</option><option value="15000">&pound;15,000 pcm</option><option value="17500">&pound;17,500 pcm</option><option value="20000">&pound;20,000 pcm</option><option value="25000">&pound;25,000 pcm</option>
                    </select>
                    <span>Max price</span>
                    <select name="max" id="max" value="0">
                    <option value="0">No min</option><option value="100">&pound;100 pcm</option><option value="200">&pound;200 pcm</option><option value="300">&pound;300 pcm</option><option value="400">&pound;400 pcm</option><option value="500">&pound;500 pcm</option><option value="600">&pound;600 pcm</option><option value="700">&pound;700 pcm</option><option value="800">&pound;800 pcm</option><option value="900">&pound;900 pcm</option><option value="1000">&pound;1,000 pcm</option><option value="1250">&pound;1,250 pcm</option><option value="1500">&pound;1,500 pcm</option><option value="1750">&pound;1,750 pcm</option><option value="2000">&pound;2,000 pcm</option><option value="2250">&pound;2,250 pcm</option><option value="2500">&pound;2,500 pcm</option><option value="2750">&pound;2,750 pcm</option><option value="3000">&pound;3,000 pcm</option><option value="3250">&pound;3,250 pcm</option><option value="3500">&pound;3,500 pcm</option><option value="3750">&pound;3,750 pcm</option><option value="4000">&pound;4,000 pcm</option><option value="4250">&pound;4,250 pcm</option><option value="4500">&pound;4,500 pcm</option><option value="4750">&pound;4,750 pcm</option><option value="5000">&pound;5,000 pcm</option><option value="5500">&pound;5,500 pcm</option><option value="6000">&pound;6,000 pcm</option><option value="6500">&pound;6,500 pcm</option><option value="7000">&pound;7,000 pcm</option><option value="7500">&pound;7,500 pcm</option><option value="8000">&pound;8,000 pcm</option><option value="8500">&pound;8,500 pcm</option><option value="9000">&pound;9,000 pcm</option><option value="9500">&pound;9,500 pcm</option><option value="10000">&pound;10,000 pcm</option><option value="12500">&pound;12,500 pcm</option><option value="15000">&pound;15,000 pcm</option><option value="17500">&pound;17,500 pcm</option><option value="20000">&pound;20,000 pcm</option><option value="25000">&pound;25,000 pcm</option>
                    </select>
                    <span>Beds</span>
                    <select name="bedSearch" id="bedSearch" value="0">
                        <option value="0">No min</option>
                        <option value="1">1+</option>
                        <option value="2" >2+</option>
                        <option value="3" >3+</option>
                        <option value="4" >4+</option>
                        <option value="5" >5+</option>
                    </select>
                    <span>Baths</span>
                    <select name="bathSearch" id="bathSearch" value="0">
                        <option value="0">No min</option>
                        <option value="1">1+</option>
                        <option value="2" >2+</option>
                        <option value="3" >3+</option>
                        <option value="4" >4+</option>
                        <option value="5" >5+</option>
                    </select>
                    <button type="submit" name="search" value="search"><i class="fa-solid fa-magnifying-glass fa-2x"></i></button>
                </form>
                </div>
                    <?php
                    if(isset($_POST['search']) & !empty($_POST['search'])) {
                        ?>
                                        <div class="recent">

<div class="listings">
                        <?php
                        $max = $_POST['max'];
                        if(empty($_POST['locationSearch'])) { $errors[]="Please enter a location";}
                        if(empty($_POST['max'])) { $max = "100000000000";}

                        if(empty($errors)) {
                            $sql = "SELECT * 
                                    FROM list
                                    LEFT JOIN users ON list.uid = users.id
                                    WHERE location = :loc  AND price >= :min AND price <= :max AND beds >= :beds AND baths >= :baths OR street= :loc OR outcode = :loc";
                            $result = $db->prepare($sql);
                            $values = array(':loc' => $_POST['locationSearch'],
                                            ':min'      => $_POST['min'],
                                            ':max'      => $max,
                                            ':beds'     => $_POST['bedSearch'],
                                            ':baths'    => $_POST['bathSearch']);
                            $res = $result->execute($values);
                            $count = $result->rowCount();
                            if ($res) {
                                if($count >= 1) {               
                        ?>
                                            <?php if(!empty($errors)) {
                    echo '<div class="error">';
                    foreach($errors as $error) {
                        echo $error;
                    }
                    echo '</div>';
                }?>     
                           <?php foreach($result as $row) {
                               $imgVal = $row['lid'];
                                $imgSql =  "SELECT *
                                            FROM images
                                            WHERE lid=?
                                            LIMIT 1";
                                $imgResult = $db->prepare($imgSql);
                                $imgResult->execute(array($imgVal));
                                $imgCount = $imgResult->rowCount();
                                $imgRes = $imgResult->fetch(PDO::FETCH_ASSOC);
                                
                                echo '<a href="info.php?id='.$row['code'].'">';
                                echo '    <div class="card downAnim">';
                                if($imgCount >= 1) {
                                echo '        <div class="header"><img src="'.$imgRes['url'].'"></div>';
                                }else {
                                    echo '        <div class="header"><img src="https://media.istockphoto.com/vectors/thumbnail-image-vector-graphic-vector-id1147544807?k=20&m=1147544807&s=612x612&w=0&h=pBhz1dkwsCMq37Udtp9sfxbjaMl27JUapoyYpQm0anc="></div>';

                                }
                                echo '        <div class="title">'.$row['property'].' ';
                                switch ($row['type']) {
                                    case "1":
                                    echo "For rent";
                                    break;
                                    case "2":
                                    echo "For sale";
                                    break;
                                    default:
                                    echo "Undefined";
                                }
                                echo ' in '.$row['location'].'</div>';
                                echo '       <div class="main">&pound;'.number_format($row['price']).'</div>';
                                echo '        <div class="stat">';
                                echo '            <span class="pill-primary"><i class="fas fa-bed"></i> '.$row['beds'].'</span>';
                                echo '            <span class="pill-primary"><i class="fas fa-bath"></i> '.$row['baths'].'</span>';
                                echo '            <span class="pill-secondary">Student friendly</span>';
                                echo '        </div>';
                                echo '       <div class="footer">'.$row['posted'].'</div>';
                                echo '    </div>';
                                echo '</a>';
                                
                            }
                            } else {
                                echo "No results found.";
                            }
                        }else{ echo 'oops'; }
                    }
                    echo '</div></div>';
                }  
                ?> 
                
                    
                    <?php if(!empty($errors)) {
                    echo '<div class="error">';
                    foreach($errors as $error) {
                        echo $error;
                    }
                    echo '</div>';
                }
                ?>
                
                    <div class="nest">
                        <div class="image-box"><img src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2018/04/11/20/brighton.jpg?quality=75&width=982&height=726&auto=webp" style="width: 100%;">
                            <div class="text-over">Brighton</div>
                        </div>
                        <div class="image-box"><img src="https://images.musement.com/cover/0002/49/london-jpeg_header-148518.jpeg?w=982&h=726&q=75&fit=crop" style="width: 100%;">
                            <div class="text-over">London</div>
                        </div>                       
                        <div class="image-box"><img src="https://cdn1.matadornetwork.com/blogs/1/2020/01/Gay-village-alongside-Canal-street-in-Manchester-England-1200x853.jpg?quality=75&width=982&height=726&auto=webp" style="width: 100%;">
                            <div class="text-over">Manchester</div>
                        </div>                     
                    </div>
                </div>
        </main>
        <footer><h2>Register</h2>
<form role="form" method="post" action="">
    <input type="text" name="username" placeholder="Name">
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder ="Password">
    <input type="password" name="passwordC" placeholder ="Confirm password">
    <input type="submit" name="reg" value="Register">
</form></footer>
   
    </body>
