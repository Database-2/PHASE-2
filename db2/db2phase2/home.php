<?php
include 'config.php';
session_start();

// Set up user and ids 
if(!isset($_SESSION['uid'])){
  header("Location: login.php");
  exit();
}
$user_uid = "";
if(isset($user_uid)){
$user_uid = $_SESSION['uid'];
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}
.menu {
  float: left;
  width: 20%;
}
.menuitem {
  padding: 8px;
  margin-top: 7px;
  border-bottom: 1px solid #f1f1f1;
}
.main {
  float: left;
  width: 60%;
  padding: 0 20px;
  overflow: hidden;
}
.right {
  background-color: lightblue;
  float: left;
  width: 20%;
  padding: 10px 15px;
  margin-top: 7px;
}
.topright {
  position:absolute;
  top:5px;
  right:5px;
}

@media only screen and (max-width:800px) {
  /* For tablets: */
  .main {
    width: 80%;
    padding: 0;
  }
  .right {
    width: 100%;
  }
  .topcorner{
    width: 100%;
  }
}
@media only screen and (max-width:500px) {
  /* For mobile phones: */
  .menu, .main, .right {
    width: 100%;
  }
}

</style>
</head>
<body style="font-family:Verdana;">

<div class="topright">
  <form action="logout.php" method="POST">
    <input type="submit" name="logout" value= "Sign Out">
  </form>  
  </div>


<div style="background-color:#ffffff;padding:15px;">
  <center>
  <h1>Twitter</h1>
  </center>
</div>


<div style="overflow:auto">
  <div class="menu">
    <?php
        echo "Welcome, " .$_SESSION['username']. "!";
    ?>
  
    <div class="menuitem">
      <form action="profile.php" method="POST">
            <input type="submit" name="profile" value= "My Profile">
      </form>  
    </div> 

    <div class="menuitem">Follwers
    <output name="follower" for= "followers"></output></div>
    <div class="menuitem">Follwing
    <output name="following" for= "following"></output></div>
    <div class="menuitem">Search</div>
    <div class="menuitem">Message
	  <div>
	  <form action="inbox.php" method="POST" style='display:inline;'>
        <input type="submit" name="inbox" value= "Inbox">
      </form>
	  <form action="send.php" method="POST" style='display:inline;'>
        <input type="submit" name="send" value= "Send">
      </form>
	  </div>
	</div>
  </div>

  <div class="main">
    <form action="home.php" method="POST">
    <input type="text" name ="user_f" placeholder= "Search for user...." />
    <input type="submit" name ="search_user" value="Seach"/>
    </form>
            
<?php
 $search_u = $user_name_u ="";
 if(isset($_POST['user_f'])){
   $user_name_u = $_POST['user_f']; 
 }if(isset($_POST['search_user'])){
 $search_u = $_POST['search_user'];
 } 
    if ($search_u) {
      $sql = "SELECT username
              FROM `user` 
              WHERE username LIKE '$user_name_u%' 
              GROUP BY username";
      $result =$conn->query($sql);

     if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
      $current_username_f = $row["username"];
      echo "<ul style='list-style-type:none'>";
      echo "<li>".$current_username_f. "  <input type='submit' name='unfollow' value= 'unfollow'>  <input type='submit' name='follow' value= 'follow'>  </li>";
      echo "</ul>";
        
      }
     } else {
      echo "No result";
     }
   }
           
    ?> 
    <h2>Post</h2>
        <?php
      $sql ="SELECT username, body, post_time
             FROM
             (SELECT u2.username,  twitts.body, post_time
              FROM user u1, user u2, follow, twitts
              WHERE u1.uid = $user_uid 
                    AND follower_id = $user_uid
                    AND u2.uid = following_id
                    AND follow.following_id = twitts.uid   
                        UNION
              SELECT username, body, post_time
              FROM user, twitts
              WHERE twitts.uid = user.uid
                    AND user.uid = $user_uid
              ) results
            ORDER By post_time DESC";

      $result =$conn->query($sql);

     if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
        echo $row["username"];
        echo " "; 
        echo $row["post_time"];
        echo '<br />';
        echo $row["body"];
        echo '<br />';
        echo '<br />';
        }
      }else {
          echo "No result";
        }
      
      ?>
  </div>

<!--trending first query -->

  <div class="right">
    <h1>What is trending?</h1>
    <h2>The post that has the most number of likes.</h2>
    <?php
      $sql = "SELECT body, COUNT(thumb.tid) 
              FROM twitts, thumb
              WHERE twitts.tid = thumb.tid
              GROUP BY body
              Having count(thumb.tid) =
              (SELECT MAX(thumbcount) FROM
              (SELECT body, COUNT(thumb.tid) as thumbcount
               FROM twitts, thumb
               WHERE twitts.tid = thumb.tid 
               GROUP BY body) t1)";
      $result =$conn->query($sql);

     if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        echo $row["body"];
          echo '<br />';
        # code...
      }
     }
    ?>
    <h2>Count the number that contains the keyword "flu"?</h2>
    <p>
      <?php
      $sql = "SELECT COUNT(body), location
              FROM `twitts`, `user`
              WHERE twitts.uid = user.uid AND `body` LIKE '%flu%'
              GROUP BY location";
      $result =$conn->query($sql);

     if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        echo $row["body"];
        echo '<br />';
        
      }
     } else {
      echo "No result";
     }
     ?></p>
  
    
    <h2>Find all the posts made by one person</h2>
    <form action="home.php" method="POST">
    <input type="text" name ="user_s" placeholder= "Search for user...." />
    <input type="submit" name ="submit_search" value="Seach"/>
    </form>
            
    <?php
    $search = $user_name ="";

    if(isset($_POST['user_s'])){
    $user_name = $_POST['user_s'];
  }
if(isset($_POST['submit_search'])){
$search = $_POST['submit_search'];
}
  
    if ($search) {
      $sql = "SELECT body
              FROM `user`,`twitts` 
              WHERE user.uid =  twitts.uid AND username LIKE '$user_name%' 
              GROUP BY body";
      $result =$conn->query($sql);

     if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        echo $row["body"];
        echo '<br />';
        
      }
     } else {
      echo "No result";
     }
   }
           
    ?> 
    
    <h2>Who has the most twitter follwers?</h2>
     <p>     
      <?php
      $sql = "SELECT username
              FROM `user`,`follow` 
              WHERE uid = following_id 
              GROUP BY uid
              ORDER BY COUNT(uid) DESC
              LIMIT 1";
      $result =$conn->query($sql);

     if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        echo $row["username"];
        # code...
      }
     }
           
    ?> 
  </p>
  
    <h2>Who twits the most in a year?</h2>
    
    <form action="home.php" method="POST">
    <select name="yearlist" >
    <option value="2018">2018</option>
    <option value="2017">2017</option>
    <option value="2016">2016</option>
    <option value="2015">2015</option>
    <option value="2014">2014</option>
    <option value="2013">2013</option>
    <option value="2012">2012</option>
    <option value="2011">2011</option>
    <option value="2010">2010</option>
    <option value="2009">2009</option>
    <option value="2008">2008</option>
    <option value="2007">2007</option>
    <option value="2006">2006</option>
    <option value="2005">2005</option>
    <option value="2004">2004</option>
    <option value="2003">2003</option>
    <option value="2002">2002</option>
    <option value="2001">2001</option>
    <option value="2000">2000</option>
    <option value="1999">1999</option>
    <option value="1998">1998</option>
    <option value="1997">1997</option>
    <option value="1996">1996</option>
    <option value="1995">1995</option>
    <option value="1994">1994</option>
    <option value="1993">1993</option>
    <option value="1992">1992</option>
    <option value="1991">1991</option>
    <option value="1990">1990</option>
    <option value="1989">1989</option>
    <option value="1988">1988</option>
    <option value="1987">1987</option>
    <option value="1986">1986</option>
    <option value="1985">1985</option>
    <option value="1984">1984</option>
    <option value="1983">1983</option>
    <option value="1982">1982</option>
    <option value="1981">1981</option>
    <option value="1980">1980</option>
    <option value="1979">1979</option>
    <option value="1978">1978</option>
    <option value="1977">1977</option>
    <option value="1976">1976</option>
    <option value="1975">1975</option>
    <option value="1974">1974</option>
    <option value="1973">1973</option>
    <option value="1972">1972</option>
    <option value="1971">1971</option>
    <option value="1970">1970</option>
    <option value="1969">1969</option>
    <option value="1968">1968</option>
    <option value="1967">1967</option>
    <option value="1966">1966</option>
    <option value="1965">1965</option>
    <option value="1964">1964</option>
    <option value="1963">1963</option>
    <option value="1962">1962</option>
    <option value="1961">1961</option>
    <option value="1960">1960</option>
    <option value="1959">1959</option>
    <option value="1958">1958</option>
    <option value="1957">1957</option>
    <option value="1956">1956</option>
    <option value="1955">1955</option>
    <option value="1954">1954</option>
    <option value="1953">1953</option>
    <option value="1952">1952</option>
    <option value="1951">1951</option>
    <option value="1950">1950</option>
    <option value="1949">1949</option>
    <option value="1948">1948</option>
    <option value="1947">1947</option>
    <option value="1946">1946</option>
    <option value="1945">1945</option>
    <option value="1944">1944</option>
    <option value="1943">1943</option>
    <option value="1942">1942</option>
    <option value="1941">1941</option>
    <option value="1940">1940</option>
    <option value="1939">1939</option>
    <option value="1938">1938</option>
    <option value="1937">1937</option>
    <option value="1936">1936</option>
    <option value="1935">1935</option>
    <option value="1934">1934</option>
    <option value="1933">1933</option>
    <option value="1932">1932</option>
    <option value="1931">1931</option>
    <option value="1930">1930</option>
    <option value="1929">1929</option>
    <option value="1928">1928</option>
    <option value="1927">1927</option>
    <option value="1926">1926</option>
    <option value="1925">1925</option>
    <option value="1924">1924</option>
    <option value="1923">1923</option>
    <option value="1922">1922</option>
    <option value="1921">1921</option>
    <option value="1920">1920</option>
    <option value="1919">1919</option>
    <option value="1918">1918</option>
    <option value="1917">1917</option>
    <option value="1916">1916</option>
    <option value="1915">1915</option>
    <option value="1914">1914</option>
    <option value="1913">1913</option>
    <option value="1912">1912</option>
    <option value="1911">1911</option>
    <option value="1910">1910</option>
    <option value="1909">1909</option>
    <option value="1908">1908</option>
    <option value="1907">1907</option>
    <option value="1906">1906</option>
    <option value="1905">1905</option>
    <option value="1904">1904</option>
    <option value="1903">1903</option>
    <option value="1902">1902</option>
    <option value="1901">1901</option>
    <option value="1900">1900</option>
     </select>
     <input type="submit" name ="submit" value="choose"/>
      </form>

    <?php

    $year ="";
    $year_list="";
    if(isset($_POST['submit'])){
      $year = $_POST['yearlist'];
    }
  
    if ($year) {
      # code...
        $sql = "SELECT username
              FROM `user`,`twitts` 
              WHERE user.uid =  twitts.uid AND twitts.post_time LIKE '$year%' 
              GROUP BY twitts.uid
              ORDER BY COUNT(twitts.uid) DESC
              LIMIT 1";
      $result =$conn->query($sql);

     if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        echo $row["username"];
      }
    }else{
      echo "Please select another year";
    }
    }             
  ?>

  </div>

</div>
</body>
</html>