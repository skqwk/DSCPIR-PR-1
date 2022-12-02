<?php
foreach ($documents as $document) {
    if (!is_null($document['Contents'])) {
        echo "<table>";
        echo  "<tr><th>Filename</th><th>Date</th></tr>";
        foreach ($document['Contents'] as $object) {
                    echo "<tr><td><a class='card-body' href='".
                    "http://localhost:".getenv("MINIO_SERVER_PORT")."/".$login."/".$object['Key']."'>".
                    $object['Key'].
                    "</a></td>"."<td>".$object['LastModified']."</td>";
            }
        echo "</table>";
        } else {
            echo 'Your bucket is empty';
        }
}
?>
<br>
<br>
<br>
<form enctype="multipart/form-data" action="documents/load" method="POST">
    <div>
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
    <input class="custom-file-input" id="file_field" name="fileToUpload" type="file" value="Upload"/>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Send file"/>
</form>
