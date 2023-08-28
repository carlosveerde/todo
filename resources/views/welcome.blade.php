<!DOCTYPE html>
<html>
<head>
  <title>CRUD com Bootstrap e jQuery</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <h1>Gerenciamento de Tarefas</h1>
    <form id="taskForm">
      <input type="hidden" id="taskId">
      <div class="form-group">
        <label>Título</label>
        <input type="text" class="form-control" id="title" required>
      </div>
      <div class="form-group">
        <label>Descrição</label>
        <textarea class="form-control" id="description" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

    <table class="table mt-5">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Descrição</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody id="taskTable">
      </tbody>
    </table>
  </div>
</body>

<script>
    $(document).ready(function() {
  // Carregar tarefas
  loadTasks();

  // Adicionar ou atualizar tarefa
  $('#taskForm').on('submit', function(e) {
    e.preventDefault();
    const id = $('#taskId').val();
    const title = $('#title').val();
    const description = $('#description').val();

    if (id) {
      // Atualizar
      $.ajax({
        url: `/task/${id}`,
        method: 'PUT',
        data: { title, description }
      }).done(function() {
        loadTasks();
        $('#taskForm')[0].reset();
        $('#taskId').val('');
      });
    } else {
      // Adicionar
      $.post('/tasks', { title, description }).done(function() {
        loadTasks();
        $('#taskForm')[0].reset();
      });
    }
  });

  // Função para carregar tarefas
  function loadTasks() {
    $('#taskTable').empty();
    $.get('/list-tasks', function(tasks) {
      tasks.forEach(function(task) {
        $('#taskTable').append(`
          <tr>
            <td>${task.id}</td>
            <td>${task.title}</td>
            <td>${task.description}</td>
            <td>
              <button onclick="editTask(${task.id})" class="btn btn-warning">Editar</button>
              <button onclick="deleteTask(${task.id})" class="btn btn-danger">Excluir</button>
            </td>
          </tr>
        `);
      });
    });
  }

  // Editar tarefa
  window.editTask = function(id) {
    $.get(`/task/${id}`, function(task) {
      $('#taskId').val(task.id);
      $('#title').val(task.title);
      $('#description').val(task.description);
    });
  };

  // Deletar tarefa
  window.deleteTask = function(id) {
    if (confirm('Tem certeza que deseja deletar esta tarefa?')) {
      $.ajax({
        url: `/task/${id}`,
        method: 'DELETE'
      }).done(function() {
        loadTasks();
      });
    }
  };
});

</script>
</html>
