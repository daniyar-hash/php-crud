<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
  </head>
  <body>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="my-3 h2 text-center">CRUD with AJAX, Bootstrap</h1>
        </div>
    </div>

    <div class="row">
      <div class="col-12">
        <!-- Button trigger modal add city -->
          <button type="button" class="btn btn-primary rounded-0 btn-add" data-bs-toggle="modal" data-bs-target="#addCity">
          Add City
          </button>
      </div>

      <div class="table-responsive my-3">

       <?php require_once 'views/index-content.tpl.php';  ?>
       
      </div>
      </div>
    </div>
<!-- Modal add city -->
<div class="modal fade" id="addCity"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add City</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  id="addCityForm" method="post">
          <div class="modal-body">
            <div class="mb-3">
              <label for="addName" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="addName" placeholder="City Name">
            
            </div>
            <div class="mb-3">
              <label for="addPopulation" class="form-label">Population</label>
                <input type="number" class="form-control" name="population" id="addPopulation" placeholder="Population City">
                <input type="hidden" name="addCity">
           
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-add-submit">Save</button>
         </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Modal edit city -->
<div class="modal fade" id="editCity" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit City</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>


    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/main.js"></script>
  </body>
</html>