<?php
session_start();
require_once('incl/connect.php');
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$val = isset($_GET['id']) ? $_GET['id'] : 0;
$sql= "SELECT *
       FROM list
       LEFT JOIN users ON list.uid = users.id
       WHERE code=?";
$result = $db->prepare($sql);
$result->execute(array($val));
$row = $result->fetch(PDO::FETCH_ASSOC);
$count = $result->rowCount();
$imgVal = $row['lid'];
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
    <?php include_once('incl/navbar.php'); ?>
        <?php
            if($count == 1) { ?>
        <main>
        <a href="search.php"><p style="margin-bottom: .5rem"><i class="fa-solid fa-angle-left"></i>  Return to search</p></a>
            <div class="infoWrapper">       
                <div class="images">
                <?php
                    $imgSql = "SELECT *
                            FROM images
                            WHERE lid=?";
                    $imgResult = $db->prepare($imgSql);
                    $imgResult->execute(array($imgVal));
                    $imgCount = $imgResult->rowCount();
                    if($imgCount >= 1) {
                        $i = 1;
                        foreach($imgResult as $res) { ?>
                            <div class="mySlides fade">
                                <div class="numbertext"><?php echo $i++.' / '.$imgCount; ?></div>
                                <img src="<?php echo $res['url']; ?>" class="img" style="width:100%">
                                
                            </div>
                            <?php } 
                                }else{ 
                            ?>
                                                                                    <div class="mySlides fade">
                                
                                <img src="https://media.istockphoto.com/vectors/thumbnail-image-vector-graphic-vector-id1147544807?k=20&m=1147544807&s=612x612&w=0&h=pBhz1dkwsCMq37Udtp9sfxbjaMl27JUapoyYpQm0anc=" class="img" style="width:100%">
                                
                            </div>
                            <?php } ?>
                     
                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>

                    <script>
        const photoBtn = document.getElementsByClassName('postPhoto')[0]
        const uploader = document.getElementsByClassName('photos')[0]
        
        photoBtn.addEventListener('click', () => {
            uploader.classList.toggle('activee')
        })
                </script>               

                <div class="info">
                <div class="nestedPrice">
                        <div>
                        <p style="font-size: 1.5rem"><span class="span" data-text="Price">&pound;<?php echo number_format($row['price']); ?>
                        <?php
                        if($row['type'] == 1) {
                            echo 'pcm';
                        }
                        ?>
                        </p></span>
                        </div>
                        <div style="text-align: end;">
                        <img src="https://st.zoocdn.com/zoopla_static_agent_logo_(714194).png">
                        </div>
                    </div>
                    <div class="nestedInfo">
                    <div class="nestedButtons"><a href="#" class="myButton"><i class="fa-regular fa-envelope"></i> Contact agent</a></div>
                <?php
 if(isset($_SESSION) && isset($_SESSION['login'])) {
    if($_SESSION['id'] == $row['uid']) {
        ?><br>
        <a href="#" class="postPhoto">Upload image</a>
        <div class="photos activee">
        <form role="form" method="post" action="">
            <input type="text" name="url" placeholder="Url">
            <input type="submit" name="imageUp" value="Upload">
    </form>
    
    </div>
        <?php
        if(isset($_POST['imageUp']) & !empty($_POST['imageUp'])) {
            if(empty($_POST['url'])){ $errors[]="Please enter a URL";}
            else {
                $sql = "SELECT *
                        FROM images
                        WHERE url=?";
                $result = $db->prepare($sql);
                $result->execute(array($_POST['url']));
                $res = $result->rowCount();
                if($res >= 1) {
                    $errors[]="This image already exists";
                }
            }
            if(empty($errors)){
                $sql = "INSERT INTO images (lid, uid, url)
                VALUES (:lid, :uid, :url)";
                $result = $db->prepare($sql);
                $values = array(':lid' => $imgVal,
                                ':uid' => $row['uid'],
                                ':url' => $_POST['url']);
                $res = $result->execute($values)or die(print_r($result->errorInfo(), true));;
                if($res) {
                    echo "Images added";
                    echo("<script>
                    setTimeout(function(){
                        window.location.href = 'info.php?id=".$val."';
                     }, 1000);
                    </script>");
                }
            }

        }
    }else{
        
    }
}else{
    
}
?>

</div>
                </div>
                <div class="desc">

                    <div class="specs" style="margin-bottom: 1rem">
                        <div>
                            <p><span class="span" data-text="Property"><i class="fas fa-home"></i> <?php echo $row['property']; ?></span></p>
                        </div>
                        <div>
                            <p><span class="span" data-text="Bedrooms"><i class="fas fa-bed"></i> <small>x</small><?php echo $row['beds']; ?></span></p> 
                        </div>
                        <div>
                            <p><span class="span" data-text="Bathrooms"><i class="fas fa-bath"></i> <small>x</small><?php echo $row['baths']; ?></span></p>
                        </div>
                        <?php if($row['size'] == "0") { echo '<div></div>'; }else{ ?> <div>
                            <p><span class="span" data-text="Size"><i class="fas fa-drafting-compass"></i> <?php echo $row['size']; ?> sq. m.</span></p>
                        </div><?php } ?>
                        <br>
                    </div>
                    <style>
    #map {
  height: 200px;
  /* The height is 400 pixels */
  width: 100%;
  /* The width is the width of the web page */
}
</style>
<div id="map"></div>
<?php
$lat = $row['lat'];
$long = $row['lng'];
?>
<script>   
function initMap() {
const uluru = { lat: <?php echo $lat; ?>, lng: <?php echo $long; ?> };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 18,
    center: uluru,
    disableDefaultUI: true,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
}
  </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBne4JlPQsu7hihflY8R9IYgd7pQSlaH6U&callback=initMap&v=weekly"
      async ></script>
                    <p><?php echo nl2br($row['descr']); ?></p>
                </div>
            </div>
</main>
        <?php } else { 
            echo '<main style="margin-top: 5rem"><h2>404 listing not found</h2></main>';
        } ?>
    </body>
    <style>
        .photos {
    display: none;
}
.photos.activee {
    display: grid;
    justify-content: center;
    padding-bottom: 1rem;
}
.postPhoto {
    display: grid;
    padding: 1rem;
    justify-content: center;
}
</style>
    <script>
        const photoButton = document.getElementsByClassName('postPhoto')[0]
        const uploader = document.getElementsByClassName('photos')[0]
        
        photoButton.addEventListener('click', () => {
            uploader.classList.toggle('activee')
        })

        const photoButton = document.getElementsByClassName('postPhoto')[0]
        const uploader = document.getElementsByClassName('photos')[0]
        
        photoButton.addEventListener('click', () => {
            uploader.classList.toggle('activee')
        })
                </script>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        }
    </script>
</html>
