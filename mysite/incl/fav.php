<?php
require_once('incl/connect.php');
                $sql = "INSERT INTO fav (lid, uid) VALUES (:lid, :uid)";            
                $result = $db->prepare($sql);
                $values = array(':lid' => $row['lid'],
                                ':uid' => $_SESSION['id']);
                $res = $result->execute($values)or die(print_r($result->errorInfo(), true));;
                if($res) {
                    echo "Added";
                } else {
                    echo "failed";
                }
            }


?>