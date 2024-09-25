</head>

<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">

  <input type="hidden" id="urlBase" value="<?= URL ?>">
  <input type="hidden" id="controller" value="<?= $controller ?>">
  <input type="hidden" id="view" value="<?= $view ?>">

  <div class="row">
    <div class="col-2 mt-5">
      <div class="card bg-secondary shadow">
        <div class="card-body">
          <?php require_once 'src/views/layout/sidebar.php'; ?>
        </div>
      </div>
    </div>

    <div class="col-10 mt-5">