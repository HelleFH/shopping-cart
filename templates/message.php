<?php
if (isset($_SESSION['message'])) {
?>
    <div class="container mx-auto mt-8">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-6">
                <div id="message" class="alert-info text-center p-3">
                    <strong>
                        <?php echo $_SESSION['message']; ?>
                    </strong>
                </div>
            </div>
        </div>
    </div>
<?php
    unset($_SESSION['message']);
}
?>
