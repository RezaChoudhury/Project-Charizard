<?php
    $dsn = 'mysql:host=localhost;dbname=vhserers_listings';
    $db = new PDO($dsn, 'vhserers_admin2', 'INLL+eJU&Ov5');


function favorite($db, $lid, $sessionID) {
    if(isset($_SESSION) && isset($_SESSION['login'])) { ?>
<div>
        <?php
            if(isset($_POST['fav']) && !empty($_POST['fav'])) {
                    $sql = "SELECT *
                            FROM fav
                            WHERE lid=:lid AND uid=:uid";
                    $result = $db->prepare($sql);
                    $values = array(':lid' => $lid,
                                    ':uid' => $sessionID);
                    $result->execute($values);
                    $count = $result->rowCount();
                    if($count == 1) {
                        $errors[]="";
                    }
                if(empty($errors)) {
                $sql = "INSERT INTO fav (lid, uid) VALUES (:lid, :uid)";            
                $result = $db->prepare($sql);
                $values = array(':lid' => $lid,
                                ':uid' => $sessionID);
                $res = $result->execute($values)or die(print_r($result->errorInfo(), true));;
                if($res) {
                    
                } else {
                    echo "failed";
                }
            }

        }
        if(isset($_POST['unFav']) && !empty($_POST['unFav'])) {
            $sql = "DELETE
                    FROM fav
                    WHERE lid=:lid AND uid=:uid";
            $result = $db->prepare($sql);
            $values = array(':lid' => $lid,
                            ':uid' => $sessionID);
            $result->execute($values);
            $count = $result->rowCount();
            if($count == 1) {
                $errors[]="";
            }
        if(empty($errors)) {
        $sql = "INSERT INTO fav (lid, uid) VALUES (:lid, :uid)";            
        $result = $db->prepare($sql);
        $values = array(':lid' => $lid,
                        ':uid' => $sessionID);
        $res = $result->execute($values)or die(print_r($result->errorInfo(), true));;
        if($res) {
            
        } else {
            echo "failed";
        }
    }

}
        if(!empty($errors)) {
            foreach($errors as $error) {
                echo $error;
            }
        }
        ?>
        <?php 
            $fav = "SELECT *
                    FROM fav
                    WHERE lid=:lid AND uid=:uid";
            $favResult = $db->prepare($fav);
            $values = array(':lid' => $lid,
                            ':uid' => $sessionID);
            $favResult->execute($values);
            $favCount = $favResult->rowCount();
            if($favCount == 1) { ?>

                    <form method="post" action="" class="inline">
                    <button type="submit" name="unFav" value="submit_value" class="link-button">
                    <i class="fa-solid fa-heart fa-2x"></i>
                    </button>
                    </form>
            <?php
            } else { ?>
    <form method="post" action="" class="inline">
  <button type="submit" name="fav" value="submit_value" class="link-button">
  <i class="fa-regular fa-heart fa-2x"></i>
  </button>
</form>
<?php } ?>
    </div>
    <?php } else { } } ?>