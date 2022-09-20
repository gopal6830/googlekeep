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
    header('location:index.php');
  }
    else{
      echo "Not Inserted";
    }
  }
//   if (isset($_POST['save'])) {
 
//     $filename = $_FILES["uploadfile"]["name"];
//     $tempname = $_FILES["uploadfile"]["tmp_name"];
//     $folder = "./image/" . $filename;

 
//     // Get all the submitted data from the form
//     $query = "INSERT INTO notes (filename) VALUES ('$filename')";
 
//     // Execute query
//     mysqli_query($connect, $query);
 
//     // Now let's move the uploaded image into the folder: image
//     if () {
//        {
//         header('location:index.php');
//        }
//     } else {
//        header('location:index.php');
//         echo "<h3>  Failed to upload image!</h3>";
//     }
// }
  if(!empty($_GET['eid']))
 {
  $id=$_GET['eid'];
  $query="select * from notes where id=$id";
  $result=mysqli_query($connect,$query);
  $row=mysqli_fetch_assoc($result);
 }
 // if(!empty($_POST['update']))
 // {
 //  $id=$result['id'];
 //  // var_dump($id);
 //  // print_r($id); 
 //  $title=$_POST['title'];
 //  $name=$_POST['name'];
 //  $filename=$_FILES['uploadfile']['name'];
 //  $filepath=$_FILES['uploadfile']['tmp_name'];
 //  // break the name into two parts
 //  $imagename=explode(".", $filename);
 //  $ext=$imagename[1];
  
 //  // print_r($imagename);
 //  //echo $ext;
 //  $query="show table status like 'filenme' ";
 //  $result=mysqli_query($connect,$query);
 //  $data=mysqli_fetch_assoc($result);
 //  //print_r($row);
 //  // $id=$row['Auto_increment'];
 //  // unlink("uploadimages/".$data['image']);
 //  $newfilename=$id.".".$ext;
 // if(!empty($_POST['update']))
 // {
 //  $title=$_POST['title'];
 //  $name=$_POST['name'];
 //  $filename = $_FILES["uploadfile"]["name"];
 //  $tempname = $_FILES["uploadfile"]["tmp_name"];
 //  $folder = "./image/" . $filename;
 //  $query="update notes set  title='$title' name='$name', filename='$filename' ";
 //  if(mysqli_query($connect,$query))
 //  {
 //    move_uploaded_file($tempname,$folder);
 //    header('location:index.php');
 //  }
 //  else{
 //    echo "Recodd Not  Updated";
 //  }


 // }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <!-- <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
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
              <div class="tooltip">
                <a href="editlabels.php"><img class="material-icons-outlined hover small-icon" width="35" height="35" src="edit.png" 
                  ></a>  
                
                <span class="tooltip-text">Edit</span>
              </div>
            </div><input type="submit" class="close-btn"  type="submit" value="Update" name="update">
          </div>
        </form>
      </div>
     
    </main>
  </body>
</html>