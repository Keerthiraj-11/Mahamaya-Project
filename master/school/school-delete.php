<?php 
require '../include/dbconnection.php';

?>
<form action="/master/include/code" method="POST">
    <div class="modal-footer">
    <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="delete_school" value="<?=$student['id']; ?>" class="btn btn-danger">Delete</button>
    </div>
    
</form>