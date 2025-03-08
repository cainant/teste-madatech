<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel de Tarefas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Painel de Tarefas</h1>
    <div class="mb-3">
        <a href="<?= site_url('tasks/create') ?>" class="btn btn-primary">Criar Nova Tarefa</a>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($tasks)): ?>
            <?php foreach($tasks as $task): ?>
                <tr>
                    <td><?= $task['id'] ?></td>
                    <td><?= $task['title'] ?></td>
                    <td><?= $task['description'] ?></td>
                    <td><?= $task['STATUS'] ?></td>
                    <td>
                        <a href="<?= site_url('/tasks/delete/'.$task['id'])?>" class="btn btn-sm btn-danger" onclick="confirm('Você gostaria de excluir esta tarefa?')">Excluir</a>
                        <a href="<?= site_url('/tasks/edit/'.$task['id'])?>" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Nenhuma tarefa encontrada.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    function deleteTask(id) {
        if (confirm('Tem certeza que deseja excluir esta tarefa?')) {
            window.location.href = `<?= site_url('tasks/delete/')?>${id}`
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
