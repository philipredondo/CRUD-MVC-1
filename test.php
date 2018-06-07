<?php
move_uploaded_file($_FILES['uploadFile']['tmp_name'],"docs/".$_FILES['uploadFile']['name']);
?>