<?php
$connect=mysqli_connect("localhost","root","","googlekeep") or die("Connection Failed");
if(!empty($_GET['restore']))
 {
  $id=$_GET['restore'];
  $query="insert into notes select * from trash where id=$id";
  $result=mysqli_query($connect,$query);
  $row=mysqli_fetch_assoc($result);
  unlink("image/".$row['filename']);
  $query="insert into notes(title,name,filename) values('$title','$name','$filename')";
  $query="delete from trash where id=$id";

  if(mysqli_query($connect,$query))
  {
    echo "Record Deleted";
    header('location:trash.php');
  }
  else{
    echo "Record Not Deleted";
  }
 }
if(!empty($_GET['didse']))
 {
  $id=$_GET['didse'];
  $query="select * from trash where id=$id";
  $result=mysqli_query($connect,$query);
  $row=mysqli_fetch_assoc($result);
  unlink("image/".$row['filename']);
  $query="delete from trash where id=$id";

  if(mysqli_query($connect,$query))
  {
    echo "Record Deleted";
    header('location:trash.php');
  }
  else{
    echo "Record Not Deleted";
  }
 }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><img src="edit.png">Google Keep</title>
    <link
      href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <nav>
      <div class="logo-area">
        <div class="tooltip">
          <span class="material-icons-outlined hover">menu</span>
          <span class="tooltip-text">Main Menu</span>
        </div>

        <img

          src="https://www.gstatic.com/images/branding/product/1x/keep_2020q4_48dp.png"
          style="width: 40px; height: 40px;"
        />
        <span class="logo-text">Keep</span>
      </div>

      <div class="search-area">
        <div class="tooltip">
          <span class="material-icons-outlined hover">search</span>
          <span class="tooltip-text">Search</span>
        </div>
        <input type="text" placeholder="Search" />
      </div>
      <div class="settings-area">
        <div class="tooltip">
          <span class="material-icons-outlined hover">refresh</span>
          <span class="tooltip-text">Refresh</span>
        </div>
        <div class="tooltip">
          <span class="material-icons-outlined hover">view_agenda</span>
          <span class="tooltip-text">List View</span>
        </div>
        <div class="tooltip">
          <span class="material-icons-outlined hover">settings</span>
          <span class="tooltip-text">Settings</span>
        </div>
      </div>
      <div class="profile-actions-area">
        <div class="tooltip">
          <span class="material-icons-outlined hover">apps</span>
          <span class="tooltip-text">Apps</span>
        </div>
        <div class="tooltip">
          <span class="material-icons-outlined hover">account_circle</span>
          <span class="tooltip-text">Account</span>
        </div>
      </div>
    </nav>
    <main>
       <div class="sidebar">
        <div class="sidebar-item">
          <span class="material-icons-outlined hover active">lightbulb</span>
          <span  class="sidebar-text"> <a class="abc hovers" href="index.php";>Notes</a></span>
        </div>
        <div class="sidebar-item">
          <span class="material-icons-outlined hover ">notifications</span>
          <span class="sidebar-text "><a class="abc hovers" href="reminders.php";>Reminders</a></span>
        </div>
        <div class="sidebar-item">
          <span class="material-icons-outlined hover"> edit</span>
          <span class="sidebar-text"><a class="abc hovers" href="editlabels.php";>Edit</a></span>
        </div>
        <div class="sidebar-item">
          <span class="material-icons-outlined hover">archive</span>
          <span class="sidebar-text"><a class="abc hovers" href="archieve.php";>Archive</a></span>
        </div>
        <div class="sidebar-item">
          <span class="material-icons-outlined hover">delete</span>
          <span class="sidebar-text"><a class="abc hovers" href="trash.php";>Trash</a></span>
        </div>
      </div>
      <?php
    $query="select * from trash";
    $result=mysqli_query($connect,$query);
    while($row=mysqli_fetch_assoc($result))
    {
      ?>
      <div class="notes">
        <div class="note">
          <!-- <span class="material-icons check-circle">check_circle</span> -->
          <div class="title"><?php echo $row['title']?></div>
          <div class="text"><?php echo $row['name']?></div>
          <div class="note-footer">
            <!-- <div class="tooltip">
              <span class="material-icons-outlined hover small-icon"
                >add_alert</span
              >
              <span class="tooltip-text">Remind me</span>
            </div>
            <div class="tooltip">
              <span class="material-icons-outlined hover small-icon"
                >person_add</span
              >
              <span class="tooltip-text">Collaborator</span>
            </div>
            <div class="tooltip">
              <span class="material-icons-outlined hover small-icon"
                >palette</span
              >
              <span class="tooltip-text">Change Color</span>
            </div>
            <div class="tooltip">
              <span class="material-icons-outlined hover small-icon"
                >image</span
              >
               <span class="tooltip-text">Add Image</span>
            </div>
            <div class="tooltip">
              <span class="material-icons-outlined hover small-icon"
                >archive</span
              >
              <span class="tooltip-text">Archive</span>
            </div>
            <div class="tooltip">
              <span class="material-icons-outlined hover small-icon"
                >more_vert</span
                <div class="tooltip">
                <a href="editlabels.php"><img class="material-icons-outlined hover small-icon" width="35" height="35" src="edit.png" 
                  ></a>  
                
                <span class="tooltip-text">Edit</span>
              </div>
            </div>
              >
              <span class="tooltip-text">More</span>
            </div> -->
          </div>

          <div>
              <img src="./image/<?php echo $row['filename']; ?>" width="200" height="200" style="margin-left:20px">
        </div>
        <div class="tooltip">
                <a href="trash.php?restore=<?php echo $row ['id'] ?>"><img class="material-icons-outlined hover small-icon" width="35" height="35" src="restore.png" 
                  ></a>  
                
                <span class="tooltip-text">Restore</span>
              </div>
              <div class="tooltip">
                <a href="trash.php?didse=<?php echo $row ['id'] ?>"><img class="material-icons-outlined hover small-icon" width="35" height="35" src="delete.png" 
                  ></a>  
                
                <span class="tooltip-text">You Want To Delete</span>
              </div>
        </div>

      </div>
      <?php
    }
    ?>
    </main>
  </body>
</html>
