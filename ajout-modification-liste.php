<?php 

require_once __DIR__ . "/templates/header.php"; 
require_once 'lib/pdo.php'; 
require_once 'lib/list.php';
require_once 'lib/category.php';

$categories = getCategories($pdo);

if (isset($_POST['saveList'])) {
  if(!empty($_POST['title'])) {
    $res = saveList($pdo, $_POST['title'], (int)$_SESSION['user']['id'], $_POST['category_id']);
    if ($res) {
      
    } else {
      //erreur
    }
  } else {
    // erreur
  }
}
?>

<div class="container col-xxl-8">
  <h1>Liste</h1>
</div>


<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Ajouter une liste par defaut
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <form action="" method="post">
          <div class="mb-3">
            <label for="title" class="form-lable">Titre</label>
            <input type="text" id="title" name="title" class="form-control">
          </div>
          <div class="mb-3">
            <label for="category_id" class="form-lable">Catégory</label>
            <select id="category_id" name="category_name" class="form-control">
              <?php foreach ($categories as $category) { ?>
                <option value="<?=$category['id'] ?>"><?=$category['name'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="mb-3">
            <input type="submit" value="Enregistrement" name="saveList" class=" btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




<?php require_once __DIR__ . '/templates/footer.php'; ?>