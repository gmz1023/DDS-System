<?php
$pid = $_POST[ 'prog' ];
$name = $base->progName($pid);
if(!isset($_SESSION['corrupt']))
{
	$_SESSION['corrupt'] = 1;
}
else
{
	$_SESSION['corrupt'] = $_SESSION['corrupt']+1;
}
?>
<div class="explorer noselect">
    <div class="explorer-space">
      <div class="status">
        <div class="tab active"><i class="material-icons foldericon"><?= $name['icon']."</i>".$name['name'] ?></div>
        <div class="bar-button"><i class="material-icons close-icon" id='close'>clear</i></div>
      </div>
     <!-- <div class="toolbar">
        <ul class="views">
          <li class="active">Folder</li>
          <li>Unistall</li>
        </ul>
        <ul class="tools">
          <li><i class="material-icons">content_copy</i></li>
          <li><i class="material-icons">content_cut</i></li>
          <li><i class="material-icons">delete</i></li>
          <li class="separator"><i class="material-icons">create_new_folder</i></li>
          <li class="separator"><i class="material-icons">select_all</i></li>
          <li class="separator"><i class="material-icons">view_column</i></li>
          <li><i class="material-icons">keyboard_arrow_down</i></li>
        </ul>
      </div> !-->
      <div class="file-space corrupt">
   		<?= $base->desktop_display($pid); ?>
        <h1>File Corrupted</h1>
		  
		  <p>It seems the file you're trying to access is corrupted.</p>
      </div>
  </div>