<style>
/* Style The Dropdown Button */
.dropbtn {

  color: black;
  padding: 16px;
  font-size: 16px;
  border: none;

}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  right: 15px;
  min-width: 180px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 10px 5px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hovers */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */

}
</style>
<?php 
require_once "../dbh.php";
    $image_sql_read = "SELECT * FROM picture WHERE us_id = $UserId";
        if($image_result = mysqli_query($conn, $image_sql_read)){
            if(mysqli_num_rows($image_result) > 0){
                while($image_row = mysqli_fetch_array($image_result)){
                    $image = $image_row['picture'];         
                }
            }
        }
?>
<nav class="navbar navbar-light bg-light">
    <table width = 100%>
      <tr>
        <td><a href='https://ithb.ac.id/'><img src="../assets/image/ithb.png" alt="logo" style="height:50px; width:100px;"></a></td>
      
        <td style="text-align:right"><h4 style="letter-spacing: 12px; word-spacing: 20px; align: right;">•  CURRICULUM VITAE  •</h4></td>
      
        <td style="text-align:right">
          <form action="../logout.php" method="POST">
            <div class="dropdown">
              <a class="dropbtn">
              <?php if (!empty ($image)){
                echo "<img src='../assets/icon/".$image."' class='rounded-circle z-depth-0' alt='avatar image' height='35' width='35'> $UserEmail 𝅏";

              } else{
                echo "<img src='../assets/image/pp.png' class='rounded-circle z-depth-0' alt='avatar image' height='35' width='35'> $UserEmail 𝅏";
              }?>
              </a>
              <div class="dropdown-content">
                <button  class="btn btn-outline-dark btn-sm btn-block" type="submit" name="logout_button">🏃💨 Logout</button>
              </div>
            </div>
          </form>
        </td>
      </tr>
</table>
  </nav>