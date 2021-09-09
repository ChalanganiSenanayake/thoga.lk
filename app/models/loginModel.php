<?php

require_once(__DIR__ . '/../../core/db_model.php');

class loginModel extends db_model
{

  function get_all_users()
  {
    return $this->read('user', array('*'), null);
  }

  function get_user($uname, $pwd)
  {
    $pwd = md5($pwd);
    $sql = "SELECT * FROM `user` WHERE username = '$uname' and password = '$pwd' OR email='$uname' and password = '$pwd'";
    $result = $this->connection->query($sql);

    if ($result) {
      return $result;
    } else
      echo "error0";
  }

  function get_data($uname)
  {
    // return $this->read('user', array('*'), array('username'=>$uname, 'email'=>$uname));
    $sql = "SELECT a.*, b.user_type, c.*, d.name_en AS c_name, p.name_en AS p_name, t.name_en AS d_name, n.name_en AS n1, m.name_en AS n2 FROM user as a INNER JOIN usertype AS b ON a.usertype_id = b.type_id INNER JOIN address as c on a.`user_id`=c.`user_id` INNER JOIN cities AS d on c.city=d.id INNER JOIN provinces AS p on c.province=p.id INNER JOIN districts AS t on c.district=t.id INNER JOIN cities AS n on a.nearestcity1=n.id INNER JOIN cities AS m on a.nearestcity2=m.id WHERE username = '$uname' OR email = '$uname'";
    $result = $this->connection->query($sql);
    echo $sql;
    $finale = array();
    if ($result) {
      while ($row = mysqli_fetch_assoc($result))
        //print_r($row);
        array_push($finale, $row);
      return $finale;
    } else
      echo "error";
  }

  function log_admin($uname, $pwd)
  {
    $pwd = $pwd;
    $sql = "SELECT * FROM `admin` WHERE user_name = '$uname' and password = '$pwd'";
    echo $sql;
    $result = $this->connection->query($sql);
    if ($result) {
      return $result;
    } else
      echo "error0";
  }

  function get_driver_id($uid){
    $sql = "SELECT driver_id,verified_state FROM driver WHERE user_id = '$uid'";
    $result = $this->connection->query($sql);
    $finale = array();
    if ($result) {
      while ($row = mysqli_fetch_assoc($result))
        //print_r($row);
        array_push($finale, $row);
      return $finale;
    } else
      echo "error";
  }
  

}
