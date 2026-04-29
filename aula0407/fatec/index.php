<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FATEC — Sistema Acadêmico</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #0d0e12;
    --surface: #13151c;
    --surface2: #1a1d27;
    --border: #252836;
    --accent: #4f8ef7;
    --accent2: #7c5ef7;
    --green: #3ecf8e;
    --red: #f75f5f;
    --yellow: #f7c84f;
    --text: #e8eaf0;
    --muted: #6b7280;
    --mono: 'DM Mono', monospace;
    --sans: 'Syne', sans-serif;
  }
  * { margin:0; padding:0; box-sizing:border-box; }
  body { background:var(--bg); color:var(--text); font-family:var(--sans); min-height:100vh; display:flex; }

  /* SIDEBAR */
  aside {
    width: 240px; min-height: 100vh; background: var(--surface);
    border-right: 1px solid var(--border); display:flex; flex-direction:column;
    position: fixed; top:0; left:0; height:100vh; z-index:100;
  }
  .logo {
    padding: 28px 24px 20px;
    border-bottom: 1px solid var(--border);
  }
  .logo-badge {
    display:inline-block; background: var(--accent);
    color:#fff; font-size:10px; font-weight:700; letter-spacing:2px;
    padding:3px 8px; border-radius:3px; margin-bottom:8px;
    font-family: var(--mono);
  }
  .logo h1 { font-size:22px; font-weight:800; letter-spacing:-0.5px; line-height:1.1; }
  .logo p { color:var(--muted); font-size:11px; font-family:var(--mono); margin-top:4px; }

  nav { padding:16px 12px; flex:1; }
  .nav-section { margin-bottom:24px; }
  .nav-label {
    font-size:10px; font-weight:700; letter-spacing:2px; color:var(--muted);
    text-transform:uppercase; padding:0 12px; margin-bottom:8px;
    font-family:var(--mono);
  }
  .nav-item {
    display:flex; align-items:center; gap:10px; padding:10px 12px;
    border-radius:8px; cursor:pointer; transition:all 0.15s;
    color:var(--muted); font-size:13px; font-weight:600; letter-spacing:0.2px;
    border: 1px solid transparent;
  }
  .nav-item:hover { background:var(--surface2); color:var(--text); }
  .nav-item.active { background:var(--surface2); color:var(--accent); border-color:var(--border); }
  .nav-icon { font-size:16px; width:20px; text-align:center; }

  .sidebar-footer {
    padding:16px 24px; border-top:1px solid var(--border);
    font-size:11px; color:var(--muted); font-family:var(--mono);
  }

  /* MAIN */
  main { margin-left:240px; flex:1; padding:32px; min-height:100vh; }

  .page-header {
    display:flex; align-items:flex-start; justify-content:space-between;
    margin-bottom:32px; padding-bottom:24px; border-bottom:1px solid var(--border);
  }
  .page-title h2 { font-size:28px; font-weight:800; letter-spacing:-0.5px; }
  .page-title p { color:var(--muted); font-size:13px; font-family:var(--mono); margin-top:4px; }
  .btn-primary {
    background:var(--accent); color:#fff; border:none; padding:10px 20px;
    border-radius:8px; font-family:var(--sans); font-size:13px; font-weight:700;
    cursor:pointer; transition:all 0.15s; letter-spacing:0.3px;
    display:flex; align-items:center; gap:8px;
  }
  .btn-primary:hover { background:#3a7de8; transform:translateY(-1px); }

  /* TABLE */
  .table-wrap {
    background:var(--surface); border:1px solid var(--border); border-radius:12px; overflow:hidden;
  }
  .table-toolbar {
    padding:16px 20px; border-bottom:1px solid var(--border);
    display:flex; align-items:center; gap:12px;
  }
  .search-box {
    background:var(--surface2); border:1px solid var(--border); color:var(--text);
    padding:8px 14px; border-radius:7px; font-family:var(--mono); font-size:12px;
    outline:none; width:250px; transition:border-color 0.15s;
  }
  .search-box:focus { border-color:var(--accent); }
  .count-badge {
    margin-left:auto; background:var(--surface2); border:1px solid var(--border);
    color:var(--muted); font-size:11px; font-family:var(--mono);
    padding:4px 12px; border-radius:20px;
  }
  table { width:100%; border-collapse:collapse; }
  thead th {
    padding:12px 20px; text-align:left; font-size:10px; font-weight:700;
    letter-spacing:1.5px; text-transform:uppercase; color:var(--muted);
    border-bottom:1px solid var(--border); font-family:var(--mono);
    background:var(--surface);
  }
  tbody tr { border-bottom:1px solid var(--border); transition:background 0.1s; }
  tbody tr:last-child { border-bottom:none; }
  tbody tr:hover { background:var(--surface2); }
  td { padding:14px 20px; font-size:13px; font-family:var(--mono); }
  td.name-cell { font-family:var(--sans); font-weight:600; font-size:14px; }

  .tag {
    display:inline-block; padding:3px 10px; border-radius:20px; font-size:10px;
    font-weight:700; letter-spacing:0.5px; font-family:var(--mono);
  }
  .tag-blue { background:rgba(79,142,247,0.15); color:var(--accent); }
  .tag-green { background:rgba(62,207,142,0.15); color:var(--green); }
  .tag-purple { background:rgba(124,94,247,0.15); color:var(--accent2); }
  .tag-yellow { background:rgba(247,200,79,0.15); color:var(--yellow); }

  .actions { display:flex; gap:6px; }
  .btn-edit, .btn-del {
    border:none; padding:6px 12px; border-radius:6px; font-size:11px;
    font-weight:700; cursor:pointer; font-family:var(--mono); transition:all 0.15s;
    letter-spacing:0.3px;
  }
  .btn-edit { background:rgba(79,142,247,0.15); color:var(--accent); }
  .btn-edit:hover { background:rgba(79,142,247,0.3); }
  .btn-del { background:rgba(247,95,95,0.1); color:var(--red); }
  .btn-del:hover { background:rgba(247,95,95,0.25); }

  /* MODAL */
  .modal-overlay {
    display:none; position:fixed; inset:0; background:rgba(0,0,0,0.7);
    z-index:200; align-items:center; justify-content:center;
    backdrop-filter:blur(4px);
  }
  .modal-overlay.show { display:flex; }
  .modal {
    background:var(--surface); border:1px solid var(--border); border-radius:16px;
    width:560px; max-width:95vw; max-height:90vh; overflow-y:auto;
    animation: slideUp 0.2s ease;
  }
  @keyframes slideUp {
    from { opacity:0; transform:translateY(20px); }
    to { opacity:1; transform:translateY(0); }
  }
  .modal-header {
    padding:24px 28px 20px; border-bottom:1px solid var(--border);
    display:flex; align-items:center; justify-content:space-between;
  }
  .modal-header h3 { font-size:18px; font-weight:800; }
  .modal-close {
    background:var(--surface2); border:1px solid var(--border); color:var(--muted);
    width:32px; height:32px; border-radius:8px; cursor:pointer; font-size:16px;
    display:flex; align-items:center; justify-content:center; transition:all 0.15s;
  }
  .modal-close:hover { color:var(--text); border-color:var(--muted); }
  .modal-body { padding:24px 28px; }
  .modal-footer {
    padding:16px 28px 24px; display:flex; gap:10px; justify-content:flex-end;
  }

  .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
  .form-group { display:flex; flex-direction:column; gap:6px; }
  .form-group.full { grid-column:1/-1; }
  .form-group label { font-size:11px; font-weight:700; color:var(--muted); letter-spacing:1px; text-transform:uppercase; font-family:var(--mono); }
  .form-group input, .form-group select, .form-group textarea {
    background:var(--surface2); border:1px solid var(--border); color:var(--text);
    padding:10px 14px; border-radius:8px; font-family:var(--mono); font-size:13px;
    outline:none; transition:border-color 0.15s; width:100%;
  }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color:var(--accent); }
  .form-group select option { background:var(--surface2); }

  .btn-cancel {
    background:var(--surface2); border:1px solid var(--border); color:var(--muted);
    padding:10px 20px; border-radius:8px; font-family:var(--sans); font-size:13px;
    font-weight:700; cursor:pointer; transition:all 0.15s;
  }
  .btn-cancel:hover { color:var(--text); border-color:var(--muted); }

  /* ALERT */
  .alert {
    position:fixed; top:24px; right:24px; z-index:999;
    background:var(--surface); border:1px solid var(--border); border-radius:10px;
    padding:14px 20px; font-size:13px; font-family:var(--mono);
    display:flex; align-items:center; gap:10px; min-width:280px;
    animation: slideIn 0.2s ease; box-shadow: 0 8px 32px rgba(0,0,0,0.4);
  }
  .alert.success { border-color:var(--green); }
  .alert.error { border-color:var(--red); }
  .alert-dot { width:8px; height:8px; border-radius:50%; flex-shrink:0; }
  .alert.success .alert-dot { background:var(--green); }
  .alert.error .alert-dot { background:var(--red); }
  @keyframes slideIn {
    from { opacity:0; transform:translateX(20px); }
    to { opacity:1; transform:translateX(0); }
  }

  /* EMPTY STATE */
  .empty-state {
    padding:60px 20px; text-align:center; color:var(--muted);
  }
  .empty-state .empty-icon { font-size:48px; margin-bottom:16px; opacity:0.4; }
  .empty-state p { font-family:var(--mono); font-size:13px; }

  /* LOADING */
  .loading { padding:40px; text-align:center; color:var(--muted); font-family:var(--mono); font-size:13px; }

  /* CONFIRM MODAL */
  .confirm-modal {
    background:var(--surface); border:1px solid var(--red); border-radius:16px;
    width:400px; padding:32px; text-align:center;
  }
  .confirm-modal h3 { font-size:18px; font-weight:800; margin-bottom:12px; }
  .confirm-modal p { color:var(--muted); font-family:var(--mono); font-size:12px; margin-bottom:24px; line-height:1.6; }
  .confirm-btns { display:flex; gap:10px; justify-content:center; }
  .btn-danger {
    background:var(--red); color:#fff; border:none; padding:10px 24px;
    border-radius:8px; font-family:var(--sans); font-size:13px; font-weight:700;
    cursor:pointer; transition:all 0.15s;
  }
  .btn-danger:hover { background:#e04e4e; }

  /* STATS CARDS */
  .stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:28px; }
  .stat-card {
    background:var(--surface); border:1px solid var(--border); border-radius:12px;
    padding:20px 24px; display:flex; align-items:center; gap:16px;
  }
  .stat-icon { font-size:28px; }
  .stat-value { font-size:28px; font-weight:800; }
  .stat-label { color:var(--muted); font-size:11px; font-family:var(--mono); letter-spacing:1px; }

  /* RESPONSIVE */
  @media(max-width:768px){
    aside { width:200px; }
    main { margin-left:200px; padding:20px; }
    .form-grid { grid-template-columns:1fr; }
    .stats-grid { grid-template-columns:1fr; }
  }
</style>
</head>
<body>

<aside>
  <div class="logo">
    <div class="logo-badge">ACADÊMICO</div>
    <h1>FATEC<br>Sistema</h1>
    <p>v1.0 — Gestão Acadêmica</p>
  </div>
  <nav>
    <div class="nav-section">
      <div class="nav-label">Visão Geral</div>
      <div class="nav-item active" onclick="loadPage('dashboard')">
        <span class="nav-icon">⬛</span> Dashboard
      </div>
    </div>
    <div class="nav-section">
      <div class="nav-label">Cadastros</div>
      <div class="nav-item" onclick="loadPage('alunos')">
        <span class="nav-icon">👤</span> Alunos
      </div>
      <div class="nav-item" onclick="loadPage('professores')">
        <span class="nav-icon">🎓</span> Professores
      </div>
      <div class="nav-item" onclick="loadPage('cursos')">
        <span class="nav-icon">📚</span> Cursos
      </div>
      <div class="nav-item" onclick="loadPage('disciplinas')">
        <span class="nav-icon">📖</span> Disciplinas
      </div>
      <div class="nav-item" onclick="loadPage('turmas')">
        <span class="nav-icon">🏫</span> Turmas
      </div>
    </div>
    <div class="nav-section">
      <div class="nav-label">Vínculos</div>
      <div class="nav-item" onclick="loadPage('item_disc_curso')">
        <span class="nav-icon">🔗</span> Disc. ↔ Curso
      </div>
    </div>
  </nav>
  <div class="sidebar-footer">FATEC © 2025</div>
</aside>

<main id="main-content">
  <div class="loading">Carregando...</div>
</main>

<!-- MODAL GENÉRICO -->
<div class="modal-overlay" id="modal-overlay">
  <div class="modal" id="modal">
    <div class="modal-header">
      <h3 id="modal-title">Modal</h3>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-body" id="modal-body"></div>
    <div class="modal-footer" id="modal-footer"></div>
  </div>
</div>

<!-- MODAL CONFIRMAR DELETE -->
<div class="modal-overlay" id="confirm-overlay">
  <div class="confirm-modal">
    <h3>⚠️ Confirmar Exclusão</h3>
    <p id="confirm-msg">Tem certeza que deseja excluir este registro? Esta ação não pode ser desfeita.</p>
    <div class="confirm-btns">
      <button class="btn-cancel" onclick="closeConfirm()">Cancelar</button>
      <button class="btn-danger" id="confirm-btn">Excluir</button>
    </div>
  </div>
</div>

<script>
const API = 'api.php';
let currentPage = '';
let deleteCallback = null;

// ─── NAVIGATION ───────────────────────────────────────────
function loadPage(page) {
  currentPage = page;
  document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
  event?.currentTarget?.classList.add('active');

  // find by text match if no event
  document.querySelectorAll('.nav-item').forEach(el => {
    if(el.onclick?.toString().includes(`'${page}'`)) el.classList.add('active');
  });

  const pages = {
    dashboard: renderDashboard,
    alunos: () => renderCRUD('alunos'),
    professores: () => renderCRUD('professores'),
    cursos: () => renderCRUD('cursos'),
    disciplinas: () => renderCRUD('disciplinas'),
    turmas: () => renderCRUD('turmas'),
    item_disc_curso: () => renderCRUD('item_disc_curso'),
  };
  if(pages[page]) pages[page]();
}

// ─── DASHBOARD ────────────────────────────────────────────
async function renderDashboard() {
  const main = document.getElementById('main-content');
  main.innerHTML = '<div class="loading">Carregando dashboard...</div>';
  
  const tables = ['alunos','professores','cursos','disciplinas','turmas'];
  const counts = await Promise.all(tables.map(t => apiFetch('list', t, {}, 'count')));
  
  const icons = ['👤','🎓','📚','📖','🏫'];
  const labels = ['Alunos','Professores','Cursos','Disciplinas','Turmas'];
  const colors = ['accent','green','accent2','yellow','accent'];
  
  main.innerHTML = `
    <div class="page-header">
      <div class="page-title">
        <h2>Dashboard</h2>
        <p>sistema_academico / visao_geral</p>
      </div>
    </div>
    <div class="stats-grid">
      ${tables.map((t,i) => `
        <div class="stat-card" style="cursor:pointer" onclick="loadPage('${t}')">
          <div class="stat-icon">${icons[i]}</div>
          <div>
            <div class="stat-value" style="color:var(--${colors[i]})">${counts[i]}</div>
            <div class="stat-label">${labels[i].toUpperCase()} CADASTRADOS</div>
          </div>
        </div>
      `).join('')}
    </div>
    <div class="table-wrap" style="padding:28px;text-align:center;color:var(--muted)">
      <p style="font-family:var(--mono);font-size:13px;line-height:2">
        Bem-vindo ao Sistema Acadêmico FATEC.<br>
        Use o menu lateral para navegar entre os módulos de cadastro.
      </p>
    </div>
  `;
}

// ─── CRUD PAGES ───────────────────────────────────────────
const CONFIG = {
  alunos: {
    title: 'Alunos', label: 'Aluno',
    cols: ['ra','nome','cpf','email_pessoal','telefone','data_nasc','cidade','turma_nome'],
    headers: ['RA','Nome','CPF','Email','Telefone','Nasc.','Cidade','Turma'],
    renderRow: r => [r.ra, r.nome, r.cpf, r.email_pessoal, r.telefone, fmtDate(r.data_nasc), r.cidade, tag(r.turma_nome||'—','blue')],
    pkCol: 'ra',
    form: formAluno,
  },
  professores: {
    title: 'Professores', label: 'Professor',
    cols: ['rp','nome','cpf','email_pessoal','telefone','cidade'],
    headers: ['RP','Nome','CPF','Email','Telefone','Cidade'],
    renderRow: r => [r.rp, r.nome, r.cpf, r.email_pessoal, r.telefone, r.cidade],
    pkCol: 'rp',
    form: formProfessor,
  },
  cursos: {
    title: 'Cursos', label: 'Curso',
    cols: ['codcurso','nome','carga_horaria','modalidade','tipo_curso'],
    headers: ['Cód','Nome','Carga H.','Modalidade','Tipo'],
    renderRow: r => [r.codcurso, r.nome, r.carga_horaria+'h', tag(r.modalidade,'green'), tag(r.tipo_curso,'purple')],
    pkCol: 'codcurso',
    form: formCurso,
  },
  disciplinas: {
    title: 'Disciplinas', label: 'Disciplina',
    cols: ['coddisc','nome','carga_horaria','prof_nome'],
    headers: ['Cód','Nome','Carga H.','Professor'],
    renderRow: r => [r.coddisc, r.nome, r.carga_horaria+'h', r.prof_nome||tag('Sem prof.','yellow')],
    pkCol: 'coddisc',
    form: formDisciplina,
  },
  turmas: {
    title: 'Turmas', label: 'Turma',
    cols: ['codturma','nome','curso_nome'],
    headers: ['Cód','Nome','Curso'],
    renderRow: r => [r.codturma, r.nome, r.curso_nome||'—'],
    pkCol: 'codturma',
    form: formTurma,
  },
  item_disc_curso: {
    title: 'Disciplinas por Curso', label: 'Vínculo',
    cols: ['coditem','disc_nome','curso_nome'],
    headers: ['Cód','Disciplina','Curso'],
    renderRow: r => [r.coditem, r.disc_nome, r.curso_nome],
    pkCol: 'coditem',
    form: formItemDiscCurso,
  },
};

async function renderCRUD(table) {
  const cfg = CONFIG[table];
  const main = document.getElementById('main-content');
  main.innerHTML = `
    <div class="page-header">
      <div class="page-title">
        <h2>${cfg.title}</h2>
        <p>fatec / ${table}</p>
      </div>
      <button class="btn-primary" onclick="openCreateModal('${table}')">
        + Novo ${cfg.label}
      </button>
    </div>
    <div class="table-wrap">
      <div class="table-toolbar">
        <input class="search-box" placeholder="Buscar ${cfg.title.toLowerCase()}..." oninput="filterTable(this.value)">
        <span class="count-badge" id="row-count">— registros</span>
      </div>
      <div id="table-body"><div class="loading">Carregando...</div></div>
    </div>
  `;
  loadTable(table);
}

async function loadTable(table) {
  const cfg = CONFIG[table];
  const data = await apiFetch('list', table);
  const tbody = document.getElementById('table-body');
  
  document.getElementById('row-count').textContent = `${data.length} registros`;
  
  if(!data.length) {
    tbody.innerHTML = `<div class="empty-state"><div class="empty-icon">📭</div><p>Nenhum registro encontrado.</p></div>`;
    return;
  }

  tbody.innerHTML = `
    <table id="data-table">
      <thead><tr>${cfg.headers.map(h=>`<th>${h}</th>`).join('')}<th>Ações</th></tr></thead>
      <tbody>
        ${data.map(r => `
          <tr>
            ${cfg.renderRow(r).map((v,i)=>`<td ${i===1?'class="name-cell"':''}>${v??'—'}</td>`).join('')}
            <td><div class="actions">
              <button class="btn-edit" onclick='openEditModal("${table}", ${JSON.stringify(r)})'>Editar</button>
              <button class="btn-del" onclick='confirmDelete("${table}", ${r[cfg.pkCol]}, "${r.nome||r.coditem||'#'+r[cfg.pkCol]}")'>Excluir</button>
            </div></td>
          </tr>
        `).join('')}
      </tbody>
    </table>
  `;
}

function filterTable(q) {
  const rows = document.querySelectorAll('#data-table tbody tr');
  q = q.toLowerCase();
  let visible = 0;
  rows.forEach(r => {
    const match = r.textContent.toLowerCase().includes(q);
    r.style.display = match ? '' : 'none';
    if(match) visible++;
  });
  document.getElementById('row-count').textContent = `${visible} registros`;
}

// ─── MODAL HELPERS ────────────────────────────────────────
function openModal(title, bodyHTML, footerHTML) {
  document.getElementById('modal-title').textContent = title;
  document.getElementById('modal-body').innerHTML = bodyHTML;
  document.getElementById('modal-footer').innerHTML = footerHTML;
  document.getElementById('modal-overlay').classList.add('show');
}
function closeModal() { document.getElementById('modal-overlay').classList.remove('show'); }

function openCreateModal(table) {
  const cfg = CONFIG[table];
  cfg.form(null, table);
}
function openEditModal(table, data) {
  const cfg = CONFIG[table];
  cfg.form(data, table);
}

// ─── FORM BUILDERS ────────────────────────────────────────
function buildForm(fields, data) {
  return `<div class="form-grid">${fields.map(f => `
    <div class="form-group ${f.full?'full':''}">
      <label>${f.label}</label>
      ${f.type==='select'
        ? `<select name="${f.name}" id="f_${f.name}">
            ${f.options.map(o=>`<option value="${o.v}" ${data&&data[f.name]==o.v?'selected':''}>${o.l}</option>`).join('')}
           </select>`
        : `<input type="${f.type||'text'}" name="${f.name}" id="f_${f.name}"
             value="${data?.[f.name]??''}" placeholder="${f.placeholder||''}">`
      }
    </div>`).join('')}</div>`;
}

async function formAluno(data, table) {
  const turmas = await apiFetch('list','turmas');
  const fields = [
    {name:'nome',label:'Nome Completo',full:true,placeholder:'Ex: João da Silva'},
    {name:'cpf',label:'CPF',placeholder:'000.000.000-00'},
    {name:'telefone',label:'Telefone',placeholder:'(11) 99999-9999'},
    {name:'email_pessoal',label:'Email Pessoal',placeholder:'email@gmail.com'},
    {name:'email_institucional',label:'Email Institucional',placeholder:'aluno@fatec.sp.gov.br'},
    {name:'data_nasc',label:'Data de Nascimento',type:'date'},
    {name:'endereco',label:'Endereço',full:true,placeholder:'Rua, número, bairro'},
    {name:'cidade',label:'Cidade',placeholder:'São Paulo'},
    {name:'codturma',label:'Turma',type:'select',options:[{v:'',l:'Sem turma'},...turmas.map(t=>({v:t.codturma,l:t.nome}))]},
  ];
  openModal(data?'Editar Aluno':'Novo Aluno', buildForm(fields, data),
    `<button class="btn-cancel" onclick="closeModal()">Cancelar</button>
     <button class="btn-primary" onclick="saveRecord('${table}','${data?.ra||''}','ra')">${data?'Salvar':'Cadastrar'}</button>`);
}

async function formProfessor(data, table) {
  const fields = [
    {name:'nome',label:'Nome Completo',full:true},
    {name:'cpf',label:'CPF',placeholder:'000.000.000-00'},
    {name:'telefone',label:'Telefone'},
    {name:'email_pessoal',label:'Email Pessoal'},
    {name:'email_institucional',label:'Email Institucional'},
    {name:'data_nasc',label:'Data de Nascimento',type:'date'},
    {name:'endereco',label:'Endereço',full:true},
    {name:'cidade',label:'Cidade'},
  ];
  openModal(data?'Editar Professor':'Novo Professor', buildForm(fields, data),
    `<button class="btn-cancel" onclick="closeModal()">Cancelar</button>
     <button class="btn-primary" onclick="saveRecord('${table}','${data?.rp||''}','rp')">${data?'Salvar':'Cadastrar'}</button>`);
}

function formCurso(data, table) {
  const fields = [
    {name:'nome',label:'Nome do Curso',full:true},
    {name:'carga_horaria',label:'Carga Horária (h)',type:'number'},
    {name:'modalidade',label:'Modalidade',type:'select',options:[
      {v:'Presencial',l:'Presencial'},{v:'Semipresencial',l:'Semipresencial'},{v:'EAD',l:'EAD'}]},
    {name:'tipo_curso',label:'Tipo',type:'select',options:[
      {v:'Bacharelado',l:'Bacharelado'},{v:'Licenciatura',l:'Licenciatura'},{v:'Tecnólogo',l:'Tecnólogo'}]},
  ];
  openModal(data?'Editar Curso':'Novo Curso', buildForm(fields, data),
    `<button class="btn-cancel" onclick="closeModal()">Cancelar</button>
     <button class="btn-primary" onclick="saveRecord('${table}','${data?.codcurso||''}','codcurso')">${data?'Salvar':'Cadastrar'}</button>`);
}

async function formDisciplina(data, table) {
  const profs = await apiFetch('list','professores');
  const fields = [
    {name:'nome',label:'Nome da Disciplina',full:true},
    {name:'carga_horaria',label:'Carga Horária (h)',type:'number'},
    {name:'codprof',label:'Professor',type:'select',options:[{v:'',l:'Sem professor'},...profs.map(p=>({v:p.rp,l:p.nome}))]},
  ];
  openModal(data?'Editar Disciplina':'Nova Disciplina', buildForm(fields, data),
    `<button class="btn-cancel" onclick="closeModal()">Cancelar</button>
     <button class="btn-primary" onclick="saveRecord('${table}','${data?.coddisc||''}','coddisc')">${data?'Salvar':'Cadastrar'}</button>`);
}

async function formTurma(data, table) {
  const cursos = await apiFetch('list','cursos');
  const fields = [
    {name:'nome',label:'Nome da Turma',full:true},
    {name:'codcurso',label:'Curso',type:'select',options:[{v:'',l:'Selecione'},...cursos.map(c=>({v:c.codcurso,l:c.nome}))]},
  ];
  openModal(data?'Editar Turma':'Nova Turma', buildForm(fields, data),
    `<button class="btn-cancel" onclick="closeModal()">Cancelar</button>
     <button class="btn-primary" onclick="saveRecord('${table}','${data?.codturma||''}','codturma')">${data?'Salvar':'Cadastrar'}</button>`);
}

async function formItemDiscCurso(data, table) {
  const [discs, cursos] = await Promise.all([apiFetch('list','disciplinas'), apiFetch('list','cursos')]);
  const fields = [
    {name:'coddisc',label:'Disciplina',type:'select',options:[{v:'',l:'Selecione'},...discs.map(d=>({v:d.coddisc,l:d.nome}))]},
    {name:'codcurso',label:'Curso',type:'select',options:[{v:'',l:'Selecione'},...cursos.map(c=>({v:c.codcurso,l:c.nome}))]},
  ];
  openModal(data?'Editar Vínculo':'Novo Vínculo', buildForm(fields, data),
    `<button class="btn-cancel" onclick="closeModal()">Cancelar</button>
     <button class="btn-primary" onclick="saveRecord('${table}','${data?.coditem||''}','coditem')">${data?'Salvar':'Cadastrar'}</button>`);
}

// ─── SAVE ─────────────────────────────────────────────────
async function saveRecord(table, pk, pkCol) {
  const inputs = document.querySelectorAll('#modal-body input, #modal-body select');
  const payload = { table, pk: pk||'', pkCol };
  inputs.forEach(el => { if(el.name) payload[el.name] = el.value; });

  const action = pk ? 'update' : 'create';
  const res = await apiFetch(action, table, payload);
  
  if(res.success) {
    closeModal();
    showAlert(pk ? 'Registro atualizado!' : 'Registro criado!', 'success');
    loadTable(table);
  } else {
    showAlert('Erro: ' + (res.error||'Falha na operação'), 'error');
  }
}

// ─── DELETE ───────────────────────────────────────────────
function confirmDelete(table, pk, name) {
  document.getElementById('confirm-msg').textContent = `Excluir "${name}"? Esta ação não pode ser desfeita.`;
  document.getElementById('confirm-overlay').classList.add('show');
  document.getElementById('confirm-btn').onclick = async () => {
    const cfg = CONFIG[table];
    const res = await apiFetch('delete', table, {table, pk, pkCol: cfg.pkCol});
    closeConfirm();
    if(res.success) {
      showAlert('Registro excluído.', 'success');
      loadTable(table);
    } else {
      showAlert('Erro ao excluir: ' + (res.error||''), 'error');
    }
  };
}
function closeConfirm() { document.getElementById('confirm-overlay').classList.remove('show'); }

// ─── API ──────────────────────────────────────────────────
async function apiFetch(action, table, payload={}, mode='') {
  try {
    const res = await fetch(`${API}?action=${action}&table=${table}${mode?'&mode='+mode:''}`, {
      method: 'POST',
      headers: {'Content-Type':'application/json'},
      body: JSON.stringify(payload)
    });
    return await res.json();
  } catch(e) {
    showAlert('Erro de conexão com o servidor.', 'error');
    return [];
  }
}

// ─── UTILS ────────────────────────────────────────────────
function tag(text, color) {
  return `<span class="tag tag-${color}">${text}</span>`;
}
function fmtDate(d) {
  if(!d) return '—';
  return new Date(d+'T00:00:00').toLocaleDateString('pt-BR');
}
function showAlert(msg, type='success') {
  const el = document.createElement('div');
  el.className = `alert ${type}`;
  el.innerHTML = `<span class="alert-dot"></span>${msg}`;
  document.body.appendChild(el);
  setTimeout(() => el.remove(), 3000);
}

// ─── INIT ─────────────────────────────────────────────────
loadPage('dashboard');
</script>
</body>
</html>