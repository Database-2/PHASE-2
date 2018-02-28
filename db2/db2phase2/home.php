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
    <input type="submit" name="submit" value= "Sign Out">
  </div>

<div style="background-color:#ffffff;padding:15px;">
  <center>
  <h1>Twitter</h1>
  </center>
</div>


<div style="overflow:auto">
  <div class="menu">
    <div class="menuitem">Current user's info</div>
    <div class="menuitem">follwers
    <output name="follower" for= "followers"></output></div>
    <div class="menuitem">follwing
    <output name="following" for= "following"></output></div>
    <div class="menuitem">Search</div>
    <div class="menuitem">Message</div>
  </div>

  <div class="main">
    <h2>Post</h2>
    <p></p>
  </div>


  <div class="right">
    <h2>What is trending?</h2>
    <p>The post that has the most number of likes.</p>
    <h2>Who has the most twitter follwers?</h2>
     <p>   </p>
    <h2>Who twits the most in a year?</h2>
    <p> </p>
  </div>

</div>

</body>
</html>
