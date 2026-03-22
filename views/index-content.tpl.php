  <?php if(!empty($cities)):  ?> 

   <?= $pagination; ?>

  <table class="table table-hover">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Population</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>

    <?php  foreach($cities as $val):?>
    <tr id="city-<?= $val['id'] ?>">
      <th scope="row"><?= $val['id'] ?></th>
      <td><?= $val['name'] ?></td>
      <td><?= $val['population'] ?></td>
      <td>
      <button type="button" class="btn btn-info btn-edit" data-bs-toggle="modal" data-id="<?= $val['id'] ?>" data-bs-target="#editCity">
      Edit
      </button>
        <button type="button" class="btn btn-danger btn-delete" data-bs-toggle="modal" data-id="<?= $val['id'] ?>"  data-bs-target="#deleteCity">
      Delete
      </button>
        </td>
    </tr>
    <?php  endforeach; ?>
   
  </tbody>
</table>
   <?= $pagination; ?>

   <?php else: ?>
    <p>Cities Not found...</p>
    <?php endif; ?>