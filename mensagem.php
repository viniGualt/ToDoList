<?php

if (isset($_SESSION['type']) && $_SESSION['type'] == 'success') {
    $css = 'alert alert-success alert-dismissible fade show';
} elseif (isset($_SESSION['type']) && $_SESSION['type'] == 'error') {
    $css = 'alert alert-danger alert-dismissible fade show';
}

if (isset($_SESSION['message'])):
?>

<div class="container mt-2">
    <div class="<?=$css?>" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
    </div>
</div>

<?php
unset($_SESSION['message']);
endif;
?>