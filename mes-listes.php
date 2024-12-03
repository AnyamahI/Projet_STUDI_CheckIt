<?php 
    require_once 'templates/header.php';
    require_once 'lib/pdo.php'; 
    require_once 'lib/list.php';

    if (isset($_SESSION['user'])) {
        $list =getListsByUserId($pdo, $_SESSION['user']['id']);
    }
?>
<div class="container">
    <h1>Mes listes</h1>
    <div class="row">

    <?php if (isset($_SESSION['user'])) { ?>
        <?php if ($lists) { 
            foreach ($lists as $lists) ?>
                <div class="col-md-4 my-2">
				<div class="card w-100">
					<div class="card-header d-flex align-items-center justify-content-evenly">
						<i class="bi bi-card-checklist"></i>
                        <h3 class="card-title"><?php $list['title']?></h3>
					</div>
					<div class="card-body d-flex justify-content-between align-items-end">
						<a href="#" class="btn btn-primary">Voire la liste</a>
                        <div>
                            <span class="badge rounded-pill text-bg-primary"><?=$list['category_nam']?></span>
                        </div>
					</div>
				</div> 
			</div>
        <?php } else { ?>
            <p>Aucune liste</p>
        <?php } ?>

        <?php } else { ?>
        <p>Connectez vous pour consulter vos listes</p>
        <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
    <?php } ?>


</div>



<?php require_once __DIR__. '/templates/footer.php'; ?>