<?php require_once 'views/layout/head.php'; ?>

<?php require_once 'views/layout/header.php'; ?>

<div>
  <h1>CRUD Users</h1>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Names</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="tbody"></tbody>
  </table>
</div>

<?php require_once 'views/layout/foot.php'; ?>

<script src="<?= URL ?>/public/js/user.js"></script>

<?php require_once 'views/layout/footer.php'; ?>