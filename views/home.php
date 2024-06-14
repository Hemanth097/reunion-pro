<?php include 'header.php'; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Enter Your Name</h2>
            <form action="polls.php" method="POST">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
