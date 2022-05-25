<?php
	$name = $base->notepad($_POST['prog']); 
?>
<div class="explorer video-container">
    <div class="explorer-space">
      <div class="status">
        <div class="tab active"><i class="material-icons foldericon"><?= $name['type']."</i>".$name['content_title'] ?></div>
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
      <div class="file-space">
		<audio controls>
			<source src="documents/audio/<?= $name['content_body'] ?>" type="audio/ogg">
		Your browser does not support the audio tag
		</video>
        
      </div>
    </div>
  </div>