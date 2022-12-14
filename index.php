<?php
$connect=mysqli_connect("localhost","root","","googlekeep") or die("Connection Failed");
 if(!empty($_POST['save']))
 {
  $title=$_POST['title'];
  $name=$_POST['name'];
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];
  $folder = "./image/" . $filename;
  
  $query="insert into notes(title,name,filename) values('$title','$name','$filename')";
  move_uploaded_file($tempname, $folder);
  if(mysqli_query($connect,$query))
  {
    echo "Inserted";
    // header('location:index.php');
  }
    else{
      echo "Not Inserted";
    }
  }
  if(!empty($_GET['dids']))
 {
  $id=$_GET['dids'];
  $query="insert into trash select * from notes where id=$id";
  $result=mysqli_query($connect,$query);
  $row=mysqli_fetch_assoc($result);
  unlink("image/".$row['filename']);
  $query="insert into trash(title,name,filename) values('$title','$name','$filename')";
  $query="delete from notes where id=$id";

  if(mysqli_query($connect,$query))
  {
    echo "Record Deleted";
    header('location:index.php');
  }
  else{
    echo "Record Not Deleted";
  }
 }
 if(!empty($_GET['did']))
 {
  $id=$_GET['did'];
  $query="insert into archieve select * from notes where id=$id";
  $result=mysqli_query($connect,$query);
  $row=mysqli_fetch_assoc($result);
  unlink("image/".$row['filename']);
  $query="insert into archieve(title,name,filename) values('$title','$name','$filename')";
  $query="delete from notes where id=$id";

  if(mysqli_query($connect,$query))
  {
    echo "Record Deleted";
    header('location:index.php');
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
      <form method="request" action="index.php">
      <div class="search-area">
        <div class="tooltip">
          <span class="material-icons-outlined hover">search</span>
          <span class="tooltip-text">search</span>
        </div>
        <input type="text" name="sa"  placeholder="You Can Search Here"/>
        <input type="submit" name="v" value="Search" class="hovers" style="text-align: right;">
      </div>
    </form>
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

      <div class="form-container active-form">
        <form method="post" action="index.php" enctype="multipart/form-data">
          <input type="hidden" name="editid" value="<?php if(!empty($row['id'])) echo $row['id'] ?>" >
          <input type="text" class="note-title" name="title" value="<?php if(!empty($row['title'])) echo $row['title'] ?>" placeholder="Title" />
          <input class="note-text" type="text" name="name" value="<?php if(!empty($row['name'])) echo $row['name'] ?>" placeholder="Take a note..." />
          <div class="form-actions">
            <div class="icons">
              <div class="tooltip">
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
                
                <input class="tooltip-text"  type="file" value="<?php if(!empty($row['filename'])) echo $row['filename'] ?>" name="uploadfile" />
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
                >
                <span class="tooltip-text">More</span>
              </div>
              <div class="tooltip">
                <span class="material-icons-outlined hover small-icon"
                  >undo</span
                >
                <span class="tooltip-text">Undo</span>
              </div>
              <div class="tooltip">
                <span class="material-icons-outlined hover small-icon"
                  >redo</span
                >
                <span class="tooltip-text">Redo</span>
              </div>  
             <!--  <div class="tooltip">
                <a href="editlabels.php"><img class="material-icons-outlined hover small-icon" width="35" height="35" src="edit.png" 
                  ></a>  
                
                <span class="tooltip-text">Edit</span> -->
              </div>
            <input type="submit" class="close-btn"  type="submit" value="Close" name="save">
          </div>
        </form>
      </div>
<?php
if(!empty($_REQUEST['v']))
    {
      $searchtitle=$_REQUEST['sa'];
      $query="select * from notes where title like '%$searchtitle%'";
    }else{
    $query="select * from notes";
  }
    $result=mysqli_query($connect,$query);
    while($row=mysqli_fetch_assoc($result))
    {
      ?>
      <div class="notes">
        <div class="note">
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
                <a href="editlabels.php?eid=<?php echo $row ['id'] ?>"><img class="material-icons-outlined hover small-icon" width="35" height="35" src="edit.png" 
                  ></a>  
                
                <span class="tooltip-text">Edit</span>
              </div>
               <div class="tooltip">
              <a href="index.php?did=<?php echo $row ['id'] ?>" class="material-icons-outlined hover small-icon"> 
                archive</a>
              
              <span class="tooltip-text">Archive</span>
            </div>
              <div class="tooltip">
                <a href="index.php?dids=<?php echo $row ['id'] ?>"><img class="material-icons-outlined hover small-icon" width="35" height="35" src="delete.png" 
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
