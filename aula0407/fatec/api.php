<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit;

require_once 'config.php';

$action = $_GET['action'] ?? '';
$table  = $_GET['table']  ?? '';
$mode   = $_GET['mode']   ?? '';
$body   = json_decode(file_get_contents('php://input'), true) ?? [];

$conn = getConnection();

// ─── ALLOWED TABLES & QUERIES ─────────────────────────────
$list_queries = [
    'alunos' => "
        SELECT a.*, t.nome AS turma_nome
        FROM aluno a
        LEFT JOIN turma t ON t.codturma = a.codturma
        ORDER BY a.nome
    ",
    'professores' => "
        SELECT * FROM professor ORDER BY nome
    ",
    'cursos' => "
        SELECT * FROM curso ORDER BY nome
    ",
    'disciplinas' => "
        SELECT d.*, p.nome AS prof_nome
        FROM disciplina d
        LEFT JOIN professor p ON p.rp = d.codprof
        ORDER BY d.nome
    ",
    'turmas' => "
        SELECT t.*, c.nome AS curso_nome
        FROM turma t
        LEFT JOIN curso c ON c.codcurso = t.codcurso
        ORDER BY t.nome
    ",
    'item_disc_curso' => "
        SELECT i.*, d.nome AS disc_nome, c.nome AS curso_nome
        FROM item_disc_curso i
        JOIN disciplina d ON d.coddisc = i.coddisc
        JOIN curso c ON c.codcurso = i.codcurso
        ORDER BY c.nome, d.nome
    ",
];

$pk_map = [
    'alunos'         => 'ra',
    'professores'    => 'rp',
    'cursos'         => 'codcurso',
    'disciplinas'    => 'coddisc',
    'turmas'         => 'codturma',
    'item_disc_curso'=> 'coditem',
];

$table_map = [
    'alunos'         => 'aluno',
    'professores'    => 'professor',
    'cursos'         => 'curso',
    'disciplinas'    => 'disciplina',
    'turmas'         => 'turma',
    'item_disc_curso'=> 'item_disc_curso',
];

$allowed = array_keys($pk_map);

if (!in_array($table, $allowed)) {
    echo json_encode(['error' => 'Tabela inválida.']); exit;
}

// ─── FIELDS PER TABLE ─────────────────────────────────────
$fields_map = [
    'alunos'         => ['nome','cpf','email_pessoal','email_institucional','telefone','data_nasc','endereco','cidade','codturma'],
    'professores'    => ['nome','cpf','email_pessoal','email_institucional','telefone','data_nasc','endereco','cidade'],
    'cursos'         => ['nome','carga_horaria','modalidade','tipo_curso'],
    'disciplinas'    => ['nome','carga_horaria','codprof'],
    'turmas'         => ['nome','codcurso'],
    'item_disc_curso'=> ['coddisc','codcurso'],
];

// ─── LIST ─────────────────────────────────────────────────
if ($action === 'list') {
    $sql = $list_queries[$table];

    if ($mode === 'count') {
        $result = $conn->query($sql);
        echo json_encode($result ? $result->num_rows : 0);
        exit;
    }

    $result = $conn->query($sql);
    if (!$result) {
        echo json_encode(['error' => $conn->error]); exit;
    }
    $rows = [];
    while ($row = $result->fetch_assoc()) $rows[] = $row;
    echo json_encode($rows);
    exit;
}

// ─── CREATE ───────────────────────────────────────────────
if ($action === 'create') {
    $fields = $fields_map[$table];
    $real_table = $table_map[$table];

    $cols = [];
    $vals = [];
    $types = '';
    $params = [];

    foreach ($fields as $field) {
        $val = $body[$field] ?? null;
        // Nullable FK fields
        if (in_array($field, ['codturma','codprof','codcurso']) && ($val === '' || $val === null)) {
            $val = null;
        }
        if ($val === '') $val = null;

        $cols[]   = "`$field`";
        $vals[]   = '?';
        $params[] = $val;
        $types   .= ($val === null ? 's' : (is_int($val) ? 'i' : 's'));
    }

    $sql = "INSERT INTO `$real_table` (" . implode(',', $cols) . ") VALUES (" . implode(',', $vals) . ")";
    $stmt = $conn->prepare($sql);
    if (!$stmt) { echo json_encode(['error' => $conn->error]); exit; }

    // bind_param with nullable support
    $bind = [&$types];
    foreach ($params as $k => &$v) $bind[] = &$params[$k];
    call_user_func_array([$stmt, 'bind_param'], $bind);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'id' => $stmt->insert_id]);
    } else {
        echo json_encode(['error' => $stmt->error]);
    }
    exit;
}

// ─── UPDATE ───────────────────────────────────────────────
if ($action === 'update') {
    $fields     = $fields_map[$table];
    $real_table = $table_map[$table];
    $pk         = $pk_map[$table];
    $pk_val     = $body['pk'] ?? null;

    if (!$pk_val) { echo json_encode(['error' => 'PK não informado']); exit; }

    $sets   = [];
    $types  = '';
    $params = [];

    foreach ($fields as $field) {
        $val = $body[$field] ?? null;
        if (in_array($field, ['codturma','codprof','codcurso']) && ($val === '' || $val === null)) $val = null;
        if ($val === '') $val = null;

        $sets[]   = "`$field` = ?";
        $params[] = $val;
        $types   .= 's';
    }

    $params[] = $pk_val;
    $types   .= 'i';

    $sql  = "UPDATE `$real_table` SET " . implode(', ', $sets) . " WHERE `$pk` = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) { echo json_encode(['error' => $conn->error]); exit; }

    $bind = [&$types];
    foreach ($params as $k => &$v) $bind[] = &$params[$k];
    call_user_func_array([$stmt, 'bind_param'], $bind);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => $stmt->error]);
    }
    exit;
}

// ─── DELETE ───────────────────────────────────────────────
if ($action === 'delete') {
    $real_table = $table_map[$table];
    $pk         = $pk_map[$table];
    $pk_val     = $body['pk'] ?? null;

    if (!$pk_val) { echo json_encode(['error' => 'PK não informado']); exit; }

    $stmt = $conn->prepare("DELETE FROM `$real_table` WHERE `$pk` = ?");
    if (!$stmt) { echo json_encode(['error' => $conn->error]); exit; }
    $stmt->bind_param('i', $pk_val);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => $stmt->error]);
    }
    exit;
}

echo json_encode(['error' => 'Ação inválida.']);
$conn->close();
?>
