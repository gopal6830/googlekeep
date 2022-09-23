<?php
$connect=mysqli_connect("localhost","root","","googlekeep") or die("Connection Failed");
 if(!empty($_GET['save']))
 {
  $gettitle=$_GET['title'];
  $getname=$_GET['name'];
  $gettime=$_GET['time'];
  $query="insert into reminder(title,name,time) values('$gettitle','$getname',$gettime')";
  if(mysqli_query($connect,$query))
  {
    echo "Inserted";
    header('location:reminders.php');
  }
    else{
      echo "Not Inserted";
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Google Keep</title>
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

          <p style="width: 40px; height: 40px;margin-top:22px;font-family: arial;font-size: 20px  ;">Reminders</h2>
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
        <form method="get" action="reminders.php">
          <input type="text" class="note-title" name="title" placeholder="Title" />
          <input class="note-text" type="text" name="name" placeholder="Take a note..." />
          <input class="note-text" type="text" name="time" placeholder="Set time..." />

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
            </div>
            <input type="submit" class="close-btn"  type="submit" value="Close" name="save">
          </div>
        </form>
      </div>
 <?php
    $query="select * from reminder";
    $result=mysqli_query($connect,$query);
    while($row=mysqli_fetch_assoc($result))
    {
      ?>
      <div class="notes">
        <div class="note">
          <span class="material-icons check-circle">check_circle</span>
          <div class="title"><?php echo $row['title']?></div>
          <div class="text"><?php echo $row['name']?></div>
          <div class="text"><?php echo $row['time']?></div>
          <div class="note-footer">
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
              >
              <span class="tooltip-text">More</span>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
    ?> 
      <div style="margin-left:500px; margin-top:200px">
        <img src="reminder.png" alt="Paris" style="width:400px">
      </div>
    </main>
  </body>
</html>
