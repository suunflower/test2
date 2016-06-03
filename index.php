<?php
	include 'function.php';
	if(isset($_GET['delete'])){
	delete($con);
  	}
  	if(isset($_POST['submit'])){
  		newEntry($con);
  	}
  	if(isset($_POST['submit_edit'])){
  	     updateEntry($con);
    }
  	$entries = getEntries($con);
  ?><!DOCTYPE html><html lang="de">	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style_gb.css" rel="stylesheet">
    <title>gb</title>
	</head>	
	<body>
	<header>
		<h1>Gästebuch</h1>
	</header>
	<section>
		<?php
			foreach($entries as $entry){
				echo "<h2>".$entry['name']."</h2>";
				echo "<p>".$entry['kommentar']."</p>";
				echo "<p><a href='?delete=".$entry['id']."'>löschen</a> ";
				echo "<a href='?edit=".$entry['id']."'>bearbeiten</a>";
				echo "</p><hr>";
			}
		?>
	</section>
	<section id="new">
		<a href="?new" class="btn_new">Neuer Eintrag</a>
		<?php
			if(isset($_GET['edit']) or (isset($_GET['new']))){
				echo '<form action="" method="post">';
				if(isset($_GET['new'])){
					echo '<input type="name" class="input" name="name" placeholder="Name"></input>';
					echo '<textarea name="new" class="input" placeholder="neu">';
					echo '</textarea>';
					echo '<input type="submit" name="submit" class="button" value="speichern"></input>';
				}
				elseif(isset($_GET['edit'])){
					$sql = "SELECT kommentar FROM guestbook WHERE id=".$_GET['edit'];
					$res = mysqli_query($con, $sql);
					$row = mysqli_fetch_assoc($res);
					echo '<textarea name="new" class="input">';
					echo $row['kommentar'];
					echo '</textarea>';
					echo '<input type="submit" name="submit_edit" class="button" value="speichern"></input>';
				}
				echo '</form>';
			}
		?>
	</section>
  </body>
</html>
