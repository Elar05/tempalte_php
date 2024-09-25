<?php require_once 'src/views/layout/head.php'; ?>
<?php require_once 'src/views/layout/header.php'; ?>

<div class="card bg-secondary shadow">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="card-title m-0">User Actions</h4>

    <button class="btn btn-primary" id="btnNew" data-bs-toggle="modal" data-bs-target="#modalContainer">
      Nuevo
    </button>
  </div>

  <div class="card-body">
    <div id="divList" class="card bg-secondary"></div>
  </div>
</div>

<div class="modal fade" id="modalContainer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-secondary">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" id="btnCancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="txtId" class="Popup">

        <div class="mb-4">
          <label for="name" class="mb-1">Nombre</label>
          <input type="text" id="txtName" class="form-control Popup Reque Guardar">
        </div>

        <div class="text-end">
          <button class="btn btn-primary" id="btnSave">
            <i class="fa fa-save"></i> Guardar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once "src/views/layout/footer.php"; ?>
<script src="<?= URL ?>/public/js/Security.js"></script>
<?php require_once "src/views/layout/foot.php"; ?>