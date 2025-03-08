<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Editar Tarefa</h1>
    <?php if (session()->has('errors')) : ?>
        <div class="alert alert-danger">
            <?php foreach (session('errors') as $error) : ?>
                <p><?= $error ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <?php if (!empty($task)): ?>
    <?= form_open('tasks/edit/'.$task['id']) ?>
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" name="title" id="title"
                   value="<?= $task['title'] ?>">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" name="description" id="description"
                      rows="3"><?= $task['description'] ?></textarea>
        </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" name="status" id="status" required>
            <option value="pendente" <?= $task['STATUS'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
            <option value="em andamento" <?= $task['STATUS'] == 'em andamento' ? 'selected' : '' ?>>Em Andamento</option>
            <option value="concluída" <?= $task['STATUS'] == 'concluída' ? 'selected' : '' ?>>Concluída</option>
        </select>
    </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="<?= site_url('tasks') ?>" class="btn btn-secondary">Voltar</a>
    <?= form_close() ?>
    <?php else: ?>
    <tr>
        <td colspan="5" class="text-center">Nenhuma tarefa encontrada.</td>
    </tr>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>