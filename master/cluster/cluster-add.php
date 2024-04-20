<?php
require '../include/dbconnection.php';

?>
<!-- HTML content goes here -->
<div class="container mt-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="/master/include/code" method="POST" id="clusteradd">
                        <div class="mb-3 input-control">
                            <label>Cluster Name</label>
                            <input type="text" name="cname" class="form-control" placeholder="Ex: Cluster-01">
                            <small class="error"></small>
                        </div>
                        <div class="mb-3 input-control">
                            <label>Cluster Owned-By</label>
                            <input type="text" name="cownedby" class="form-control" placeholder="Cluster Handled-By">
                            <small class="error"></small>
                        </div>
                        <input type="hidden" name="cid" class="form-control" placeholder="Ex:- C01">
                        <input type="hidden" name="cadd_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="saveCluster">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="save_cluster" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
