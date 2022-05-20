<?php 
session_start();
require_once('incl/connect.php');
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if(isset($_POST['list']) & !empty($_POST['list'])) {
    if(empty($_POST['title']) || strlen($_POST['title']) < 5) {
        $errors[]="Your title must be atleast 5 characters.";
    }
    if(empty($_POST['location'])){ $errors[]="Please enter a location.";}
    if(empty($_POST['street'])){ $errors[]="Please enter a street name.";}
    if(empty($_POST['postCode'])){ $errors[]="Please enter a postcode.";}
    if(empty($_POST['outCode'])){ $errors[]="Please enter a outcode.";}
    if(empty($_POST['beds'])){ $errors[]="Please enter how many bedrooms.";}
    if(empty($_POST['baths'])){ $errors[]="Please enter how many bathrooms.";}
    if(empty($_POST['property'])){ $errors[]="Please enter how many bedrooms.";}
    if(empty($_POST['type'])){ $errors[]="Please enter a type.";}
    if(empty($_POST['price'])){ $errors[]="Please enter a price.";}
    if(empty($_POST['desc']) || strlen($_POST['desc']) < 10) {
        $errors[]="Your description must be atleast 10 characters.";
    }
    if(empty($errors)) {
        echo $_POST['lng'];
        echo '<br>';
        echo $_POST['lat'];
        echo '<br>';
        echo $_POST['street'];
        echo '<br>';
        echo $_POST['postCode'];
        echo '<br>';
        echo $_POST['outCode'];
        echo '<br>';
        $time = time();
        $code = $_SESSION['id'].$time.$_SESSION['id'];
        $sql = "INSERT INTO list (uid, title, type, price, descr, location, street, postcode, outcode, beds, baths, size, property, lng, lat, code) VALUES (:uid, :title, :type, :price, :descr, :location, :street, :postcode, :outcode, :beds, :baths, :size, :property, :lng, :lat, :code)";
        $result = $db->prepare($sql);
        $values = array(':uid'     => $_SESSION['id'],
                        ':title'    => $_POST['title'],
                        ':type'     => $_POST['type'],
                        ':price'    => $_POST['price'],
                        ':descr'     => $_POST['desc'],
                        ':location'     => $_POST['location'],
                        ':street'     => $_POST['street'],
                        ':postcode'     => $_POST['postCode'],
                        ':outcode'     => $_POST['outCode'],
                        ':beds'     => $_POST['beds'],
                        ':baths'     => $_POST['baths'],
                        ':size'     => $_POST['size'],
                        ':property'     => $_POST['property'],
                        ':lng'     => $_POST['lng'],
                        ':lat'     => $_POST['lat'],
                        ':code'     => $code
                        );
        $res = $result->execute($values)or die(print_r($result->errorInfo(), true));;
        
        if($res) {
            $messages[]="Listing has been added you will be redirected in 5 seconds.";
            echo '<script type="text/javascript">
            window.location = "info.php?id='.$code.'";
            </script>';
        }else{
            $errors[]="Something went wrong!";
            
        }
        
    }
}
if(isset($_SESSION) && isset($_SESSION['login'])){ 
$sql = "SELECT *
        FROM users
        WHERE id=?";
$result = $db->prepare($sql);
$res = $result->execute(array($_SESSION['id']));
$row = $result->fetch(PDO::FETCH_ASSOC);
$username = $row['username'];
?>
<?php
if(!empty($errors)) {
    foreach($errors as $error){
        echo $error;
    }
}
?>
<script>
  window.onload = () => {
  const search = document.getElementById("searchPost");
  const searchElement = document.getElementById("searchField");
  const searchButton = document.getElementById("submit");
  searchButton.addEventListener('click', (e) => {
    results.innerHTML = '';
    e.preventDefault();
    searchPost(searchElement.value);
  })
}

function searchPost(query) {
    const url = `https://api.postcodes.io/postcodes/${query}`;
    fetch(url)
    .then(response => response.json())
    .then((jsonData) => {
        console.log(jsonData)
        if(jsonData.status == "200") {
        const latt = jsonData.result.latitude;
        const long = jsonData.result.longitude;
        const postCode = jsonData.result.postcode;
        const outCode = jsonData.result.outcode;
        const district = jsonData.result.nuts;
        console.log(latt)
        console.log(long)

        var postCodeTag = document.createElement("p");
        var postCodeText = document.createTextNode(postCode);
        postCodeTag.appendChild(postCodeText);

        var outCodeTag = document.createElement("p");
        var outCodeText = document.createTextNode(outCode);
        outCodeTag.appendChild(outCodeText);

        var districtTag = document.createElement("p");
        var districtText = document.createTextNode(district);
        districtTag.appendChild(districtText);

        var element = document.getElementById("results");
        element.appendChild(postCodeTag);
        element.appendChild(outCodeTag);
        element.appendChild(districtTag);
        document.getElementById("postCode").value = postCode;
        document.getElementById("outCode").value = outCode;
        document.getElementById("lat").value = latt;
        document.getElementById("long").value = long;

          // The location of Uluru
  const uluru = { lat: latt, lng: long };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("mapp"), {
    zoom: 18,
    center: uluru,
    disableDefaultUI: true,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
}else { 
    var postCodeFailTag = document.createElement("p");
    var postCodeFailText = document.createTextNode("Please enter a valid postcode");
    postCodeFailTag.appendChild(postCodeFailText);

    var element = document.getElementById("results");
    element.appendChild(postCodeFailTag);
    console.log("Invalid Postcode")}
    });
}
</script>

            <link rel="stylesheet" href="style.css" type="text/css">
<?php include_once('incl/navbar.php'); ?>
<main>
<div class="search-box">
		<form id="searchPost">
			<input type="text" name="search" id="searchField" placeholder="Search..."/>
			<button id="submit">Search</button>
			</form>
			</div>
			<br>
<h2>Welcome <?php echo $username; ?> | <a href="logout.php">Logout</a></h2>  
<form role="form" method="post" action="">
    <input type="text" name="title" placeholder="Title">
    <input type="number" name="price" placeholder ="Price">
    <input type="text" name="desc" placeholder ="Description">
    <input type="text" name="postCode" id="postCode" readonly/>
    <input type="text" name="location" placeholder="Town/City">
    <input type="text" name="street" id="street" placeholder="Street name"/>
    <input type="number" name="beds" placeholder="# of bedrooms">
    <input type="number" name="baths" placeholder ="# of bathrooms">
    <input type="number" name="size" placeholder ="Size M2 if applicable">
    <select name="property" id="property" value="0">
        <option value="0">Property type</option>
        <option value="Flat">Flat</option>
        <option value="Detached" >Detached</option>
        <option value="Semi-detatched" >Semi-detached</option>
        <option value="Bungalow" >Bungalow</option>
    </select>
    <select name="type" id="type" value="0">
        <option value="0">Rent/buy</option>
        <option value="1">Rent</option>
        <option value="2" >Sell</option>
    </select>
    <input type="text" name="outCode" id="outCode" readonly/>
            <input type="text" name="lat" id="lat" readonly/>
            <input type="text" name="lng" id="long" readonly/>
    <input type="submit" name="list" value="Submit">
</form>
<BR>
<?php }else{ echo "Login to make a listing."; } ?>

</form>
		<div id="results" class="result-box">
        <input type="text" name="postCode" id="postCode"/>
</div>
<div id="mapp"></div>
