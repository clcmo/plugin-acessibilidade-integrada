<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PAI — Plugin de Acessibilidade Integrado</title>
  <meta name="description" content="Página de demonstração do plugin de acessibilidade PAI com alto contraste, ajuste de fonte, daltonismo e tradução em Libras." />
  <meta property="og:title" content="Diário de Acessibilidade — PAI v5.2.0" />
  <meta property="og:description" content="Demonstrativo do plugin de acessibilidade com recursos para alto contraste, ajuste de fonte, daltonismo e tradução em Libras." />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://clcmo.github.io/plugin-acessibilidade-integrada/" />
  <meta property="og:image" content="https://og-image.vercel.app/Di%C3%A1rio%20de%20Acessibilidade.png?theme=light&md=0&fontSize=85px&title=Di%C3%A1rio%20de%20Acessibilidade&subtitle=PAI%20v5.2.0" />
  <meta property="og:image:type" content="image/png" />
  <meta property="og:image:alt" content="Visual de compartilhamento do Diário de Acessibilidade PAI" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Diário de Acessibilidade — PAI v5.2.0" />
  <meta name="twitter:description" content="Plugin de acessibilidade com alto contraste, ajuste de fonte, daltonismo e tradução em Libras." />
  <meta name="twitter:image" content="https://og-image.vercel.app/Di%C3%A1rio%20de%20Acessibilidade.png?theme=light&md=0&fontSize=85px&title=Di%C3%A1rio%20de%20Acessibilidade&subtitle=PAI%20v5.2.0" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/style.css">

  <style>
    /* ── Reset & tokens ── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --ink:        #0f0e0d;
      --ink-soft:   #4a4742;
      --paper:      #faf8f4;
      --paper-warm: #f2ede4;
      --rule:       #e2dbd0;
      --accent:     #1a56db;
      --accent-alt: #b45309;
      --red:        #dc2626;
      --green:      #16a34a;
      --blue:       #2563eb;

      --fix:  #dcfce7; --fix-text: #15803d;
      --new:  #dbeafe; --new-text: #1d4ed8;
      --ok:   #fef9c3; --ok-text:  #854d0e;

      --font-display: 'DM Serif Display', Georgia, serif;
      --font-body:    'DM Sans', system-ui, sans-serif;

      --r-sm: 6px;
      --r-md: 12px;
      --r-lg: 20px;

      --shadow-sm: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.06);
      --shadow-md: 0 4px 16px rgba(0,0,0,.10), 0 2px 6px rgba(0,0,0,.07);
      --shadow-lg: 0 12px 40px rgba(0,0,0,.12), 0 4px 12px rgba(0,0,0,.08);
    }

    /* ── High-contrast override ── */
    body.pai-high-contrast {
      --ink: #ffffff; --ink-soft: #cccccc;
      --paper: #000000; --paper-warm: #111111; --rule: #444444;
      --accent: #ffff00; --accent-alt: #ff8800;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: var(--font-body);
      font-size: 16px;
      line-height: 1.7;
      color: var(--ink);
      background: var(--paper);
      -webkit-font-smoothing: antialiased;
    }

    /* ── Skip link ── */
    .skip-link {
      position: absolute; top: -999px; left: 1rem;
      background: var(--accent); color: #fff;
      padding: .4rem 1rem; border-radius: var(--r-sm);
      font-size: .85rem; font-weight: 500; z-index: 9999;
      text-decoration: none;
      transition: top .15s;
    }
    .skip-link:focus { top: 1rem; }

    /* ── Header ── */
    header {
      position: sticky; top: 0; z-index: 100;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 2.5rem;
      height: 60px;
      background: rgba(250,248,244,.92);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid var(--rule);
    }

    .site-name {
      font-family: var(--font-display);
      font-size: 1.15rem;
      color: var(--ink);
      letter-spacing: -.01em;
    }

    header nav { display: flex; gap: 2rem; }
    header nav a {
      font-size: .875rem;
      font-weight: 500;
      color: var(--ink-soft);
      text-decoration: none;
      letter-spacing: .02em;
      transition: color .2s;
    }
    header nav a:hover { color: var(--accent); }

    /* ── Hero ── */
    .hero {
      position: relative;
      overflow: hidden;
      padding: 7rem 2.5rem 5rem;
      text-align: center;
      background: var(--paper-warm);
      border-bottom: 1px solid var(--rule);
    }

    /* Decorative rule lines behind hero */
    .hero::before {
      content: '';
      position: absolute; inset: 0;
      background-image: repeating-linear-gradient(
        0deg,
        transparent,
        transparent 39px,
        var(--rule) 39px,
        var(--rule) 40px
      );
      opacity: .35;
      pointer-events: none;
    }

    .hero-inner { position: relative; max-width: 680px; margin: 0 auto; }

    .hero-badge {
      display: inline-block;
      font-size: .75rem;
      font-weight: 500;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--accent-alt);
      border: 1px solid currentColor;
      padding: .25rem .75rem;
      border-radius: 999px;
      margin-bottom: 1.5rem;
    }

    .hero h1 {
      font-family: var(--font-display);
      font-size: clamp(2.4rem, 6vw, 4rem);
      line-height: 1.1;
      letter-spacing: -.03em;
      color: var(--ink);
      margin-bottom: 1.25rem;
    }

    .hero p {
      font-size: 1.05rem;
      color: var(--ink-soft);
      max-width: 520px;
      margin: 0 auto 2rem;
    }

    .hero-cta {
      display: inline-flex; align-items: center; gap: .5rem;
      background: var(--accent);
      color: #fff;
      padding: .7rem 1.6rem;
      border-radius: var(--r-md);
      font-size: .9rem;
      font-weight: 500;
      text-decoration: none;
      box-shadow: var(--shadow-md);
      transition: background .2s, transform .15s;
    }
    .hero-cta:hover { background: #1446c0; transform: translateY(-1px); }

    /* ── Layout ── */
    .container {
      max-width: 860px;
      margin: 0 auto;
      padding: 0 2rem 6rem;
    }

    /* ── Section wrapper ── */
    .section {
      padding: 4.5rem 0;
      border-bottom: 1px solid var(--rule);
    }
    .section:last-child { border-bottom: none; }

    .section-label {
      display: flex; align-items: center; gap: .6rem;
      font-size: .72rem;
      font-weight: 600;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--ink-soft);
      margin-bottom: 1rem;
    }
    .section-label::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--rule);
    }

    h2 {
      font-family: var(--font-display);
      font-size: clamp(1.6rem, 4vw, 2.4rem);
      line-height: 1.15;
      letter-spacing: -.025em;
      color: var(--ink);
      margin-bottom: 1rem;
    }

    h3 {
      font-family: var(--font-display);
      font-size: 1.25rem;
      color: var(--ink);
      margin: 2rem 0 .75rem;
    }

    p { color: var(--ink-soft); margin-bottom: 1rem; }
    p:last-child { margin-bottom: 0; }

    a { color: var(--accent); }
    a:hover { text-decoration: underline; }

    code {
      font-family: 'Courier New', monospace;
      font-size: .85em;
      background: var(--paper-warm);
      border: 1px solid var(--rule);
      padding: .1em .35em;
      border-radius: 4px;
      color: var(--ink);
    }

    blockquote {
      border-left: 3px solid var(--accent-alt);
      margin: 2rem 0;
      padding: 1rem 1.5rem;
      background: var(--paper-warm);
      border-radius: 0 var(--r-sm) var(--r-sm) 0;
      font-family: var(--font-display);
      font-style: italic;
      font-size: 1.05rem;
      color: var(--ink);
    }

    /* ── Feature grid ── */
    .feature-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 1rem;
      margin: 2rem 0;
    }

    .feature-card {
      display: flex; flex-direction: column; gap: .4rem;
      padding: 1.4rem 1.2rem;
      background: var(--paper-warm);
      border: 1px solid var(--rule);
      border-radius: var(--r-md);
      transition: box-shadow .2s, transform .2s;
    }
    .feature-card:hover {
      box-shadow: var(--shadow-md);
      transform: translateY(-2px);
    }
    .feature-card .icon { font-size: 1.6rem; margin-bottom: .2rem; }
    .feature-card strong { font-size: .95rem; color: var(--ink); }
    .feature-card span { font-size: .82rem; color: var(--ink-soft); }

    /* ── Table ── */
    .test-table {
      width: 100%;
      border-collapse: collapse;
      font-size: .9rem;
      margin-top: 1.5rem;
      border-radius: var(--r-md);
      overflow: hidden;
      box-shadow: var(--shadow-sm);
    }

    .test-table thead tr {
      background: var(--ink);
      color: var(--paper);
    }

    .test-table th {
      padding: .85rem 1rem;
      text-align: left;
      font-size: .75rem;
      font-weight: 600;
      letter-spacing: .08em;
      text-transform: uppercase;
    }

    .test-table td {
      padding: .85rem 1rem;
      border-bottom: 1px solid var(--rule);
      color: var(--ink-soft);
      vertical-align: middle;
    }

    .test-table tbody tr { background: var(--paper); transition: background .15s; }
    .test-table tbody tr:hover { background: var(--paper-warm); }
    .test-table tbody tr:last-child td { border-bottom: none; }

    .badge {
      display: inline-block;
      font-size: .7rem;
      font-weight: 600;
      padding: .2rem .6rem;
      border-radius: 999px;
      letter-spacing: .04em;
    }
    .badge-fix  { background: var(--fix);  color: var(--fix-text); }
    .badge-new  { background: var(--new);  color: var(--new-text); }
    .badge-ok   { background: var(--ok);   color: var(--ok-text);  }

    /* ── Color palettes ── */
    .palette-block {
      margin: 2rem 0;
      padding: 2rem;
      background: var(--paper-warm);
      border: 1px solid var(--rule);
      border-radius: var(--r-lg);
    }

    .palette-block h3 {
      font-size: .8rem;
      font-weight: 600;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--ink-soft);
      margin: 0 0 1rem;
    }

    .color-palette {
      display: flex;
      gap: .6rem;
      flex-wrap: wrap;
    }

    .swatch {
      width: 56px; height: 56px;
      border-radius: var(--r-sm);
      box-shadow: var(--shadow-sm);
      position: relative;
      cursor: default;
      transition: transform .2s;
    }
    .swatch:hover { transform: scale(1.12); }
    .swatch[title]::after {
      content: attr(title);
      position: absolute;
      bottom: calc(100% + 6px); left: 50%;
      transform: translateX(-50%);
      background: var(--ink);
      color: var(--paper);
      font-size: .7rem;
      padding: .2rem .5rem;
      border-radius: 4px;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: opacity .15s;
    }
    .swatch:hover::after { opacity: 1; }

    .filter-note {
      display: flex; align-items: flex-start; gap: .75rem;
      margin-top: 1.5rem;
      padding: 1rem 1.25rem;
      background: var(--paper);
      border: 1px solid var(--rule);
      border-radius: var(--r-md);
      font-size: .875rem;
      color: var(--ink-soft);
    }
    .filter-note .material-symbols-outlined { font-size: 1.2rem; color: var(--accent); flex-shrink: 0; margin-top: .1rem; }

    /* ── Contact form ── */
    .contact-grid {
      display: grid;
      grid-template-columns: 1fr 1.6fr;
      gap: 3rem;
      align-items: start;
      margin-top: 2rem;
    }

    @media (max-width: 640px) {
      .contact-grid { grid-template-columns: 1fr; gap: 2rem; }
    }

    .contact-info h3 { margin-top: 0; }

    .contact-info p {
      font-size: .9rem;
      margin-bottom: 1.25rem;
    }

    .contact-detail {
      display: flex; align-items: center; gap: .6rem;
      font-size: .875rem;
      color: var(--ink-soft);
      margin-bottom: .6rem;
      text-decoration: none;
    }
    .contact-detail .material-symbols-outlined { font-size: 1.1rem; color: var(--accent); }
    a.contact-detail:hover { color: var(--accent); }

    .form-card {
      background: var(--paper-warm);
      border: 1px solid var(--rule);
      border-radius: var(--r-lg);
      padding: 2rem;
      box-shadow: var(--shadow-sm);
    }

    .form-group {
      margin-bottom: 1.25rem;
    }

    .form-group label {
      display: block;
      font-size: .8rem;
      font-weight: 600;
      letter-spacing: .06em;
      text-transform: uppercase;
      color: var(--ink-soft);
      margin-bottom: .4rem;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: .7rem 1rem;
      font-family: var(--font-body);
      font-size: .925rem;
      color: var(--ink);
      background: var(--paper);
      border: 1px solid var(--rule);
      border-radius: var(--r-sm);
      outline: none;
      transition: border-color .2s, box-shadow .2s;
      resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(26,86,219,.12);
    }

    .form-group textarea { min-height: 120px; }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    @media (max-width: 480px) {
      .form-row { grid-template-columns: 1fr; }
    }

    .btn-submit {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: .5rem;
      width: 100%;
      padding: .85rem 1.5rem;
      background: var(--accent);
      color: #fff;
      font-family: var(--font-body);
      font-size: .95rem;
      font-weight: 500;
      border: none;
      border-radius: var(--r-md);
      cursor: pointer;
      box-shadow: var(--shadow-sm);
      transition: background .2s, transform .15s, box-shadow .2s;
      margin-top: .5rem;
    }
    .btn-submit:hover {
      background: #1446c0;
      transform: translateY(-1px);
      box-shadow: var(--shadow-md);
    }
    .btn-submit:active { transform: translateY(0); }

    /* ── Footer ── */
    footer {
      border-top: 1px solid var(--rule);
      padding: 2.5rem;
      text-align: center;
      font-size: .85rem;
      color: var(--ink-soft);
      background: var(--paper-warm);
    }

    footer a { color: var(--accent-alt); text-decoration: none; }
    footer a:hover { text-decoration: underline; }

    /* ── PAI widget styles (kept from original) ── */
    #pai-btn {
      position: fixed;
      bottom: 2rem; right: 2rem;
      width: 52px; height: 52px;
      border-radius: 50%;
      background: var(--accent);
      color: #fff;
      border: none;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      box-shadow: var(--shadow-lg);
      z-index: 1000;
      transition: transform .2s, background .2s;
    }
    #pai-btn:hover { background: #1446c0; transform: scale(1.08); }

    #pai-menu {
      position: fixed;
      bottom: 5.5rem; right: 2rem;
      width: 240px;
      background: var(--paper);
      border: 1px solid var(--rule);
      border-radius: var(--r-lg);
      padding: 1.25rem;
      box-shadow: var(--shadow-lg);
      z-index: 999;
      display: flex;
      flex-direction: column;
      gap: .4rem;
    }

    #pai-menu h3 {
      font-size: .9rem;
      font-weight: 600;
      color: var(--ink);
      text-align: center;
      margin: 0 0 .6rem;
    }

    .pai-opt, #toggle-vlibras {
      display: flex;
      align-items: center;
      gap: .5rem;
      width: 100%;
      padding: .55rem .85rem;
      font-family: var(--font-body);
      font-size: .85rem;
      color: var(--ink);
      background: var(--paper-warm);
      border: 1px solid var(--rule);
      border-radius: var(--r-sm);
      cursor: pointer;
      transition: background .15s, border-color .15s;
      text-align: left;
    }
    .pai-opt:hover, #toggle-vlibras:hover {
      background: var(--rule);
      border-color: var(--ink-soft);
    }
    .pai-opt .material-symbols-outlined,
    #toggle-vlibras .material-symbols-outlined {
      font-size: 1.1rem;
      color: var(--accent);
    }

    .pai-section-title {
      font-size: .68rem;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--ink-soft);
      margin: .4rem 0 .2rem;
      padding-left: .2rem;
    }

    .pai-vlibras-container { display: none; }

    /* ── Responsive ── */
    @media (max-width: 640px) {
      header { padding: 0 1.25rem; }
      header nav { gap: 1.2rem; }
      .hero { padding: 4rem 1.25rem 3rem; }
      .container { padding: 0 1.25rem 4rem; }
      .feature-grid { grid-template-columns: 1fr 1fr; }
      .test-table { font-size: .8rem; }
      .test-table th, .test-table td { padding: .65rem .75rem; }
    }

    @media (max-width: 420px) {
      header nav { display: none; }
      .feature-grid { grid-template-columns: 1fr; }
    }

    /* ── Fade-in on load ── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .hero-inner  { animation: fadeUp .6s ease both; }
    .feature-card { animation: fadeUp .5s ease both; }
    .feature-card:nth-child(1) { animation-delay: .05s; }
    .feature-card:nth-child(2) { animation-delay: .10s; }
    .feature-card:nth-child(3) { animation-delay: .15s; }
    .feature-card:nth-child(4) { animation-delay: .20s; }
  </style>
</head>

<body>
  <a href="#main" class="skip-link">Pular para o conteúdo</a>

  <!-- ── Cabeçalho ── -->
  <header>
    <span class="site-name">Diário de Acessibilidade</span>
    <nav aria-label="Navegação principal">
      <a href="#sobre">Sobre</a>
      <a href="#testes">Testes</a>
      <a href="#cores">Cores</a>
      <a href="#contato">Contato</a>
    </nav>
  </header>

  <!-- ── Hero ── -->
  <div class="hero" role="banner">
    <div class="hero-inner">
      <div class="hero-badge">Demonstração · PAI v5.2.0</div>
      <h1>Acessibilidade para<br><em>todos</em> os usuários</h1>
      <p>Widget de acessibilidade para WordPress com alto contraste, ajuste de fonte, filtros de daltonismo e tradução em Libras.</p>
      <a href="#sobre" class="hero-cta">
        <span class="material-symbols-outlined" style="font-size:1.1rem;">arrow_downward</span>
        Explorar o plugin
      </a>
    </div>
  </div>

  <!-- ── Conteúdo principal ── -->
  <main id="main" class="container">

    <!-- ── Sobre ── -->
    <section id="sobre" class="section" aria-labelledby="h-sobre">
      <div class="section-label">01 · Sobre</div>
      <h2 id="h-sobre">O que este plugin oferece</h2>
      <p>O <strong>PAI</strong> é um widget de acessibilidade que pode ser adicionado a qualquer site WordPress sem configuração. Ele persiste as preferências do usuário entre visitas e funciona em todos os navegadores modernos.</p>

      <div class="feature-grid" role="list">
        <div class="feature-card" role="listitem">
          <div class="icon">🌑</div>
          <strong>Alto Contraste</strong>
          <span>Modo escuro forçado para baixa visão</span>
        </div>
        <div class="feature-card" role="listitem">
          <div class="icon">🔤</div>
          <strong>Ajuste de Fonte</strong>
          <span>±2px com limites de segurança</span>
        </div>
        <div class="feature-card" role="listitem">
          <div class="icon">👁</div>
          <strong>Daltonismo</strong>
          <span>4 filtros via SVG feColorMatrix</span>
        </div>
        <div class="feature-card" role="listitem">
          <div class="icon">🤟</div>
          <strong>Libras</strong>
          <span>vLibras com botão customizado</span>
        </div>
      </div>

      <h3>Como as preferências são salvas</h3>
      <p>Cada ajuste é gravado no <code>localStorage</code> do navegador sob a chave <code>pai_v5</code>. Ao recarregar a página, o estado é restaurado automaticamente. Clique em <em>Resetar</em> para voltar ao padrão.</p>

      <blockquote>
        "Acessibilidade não é uma funcionalidade opcional — é um requisito fundamental para qualquer produto digital que respeite seus usuários."
      </blockquote>

      <p>Links para testar o comportamento com alto contraste ativo: <a href="#">Política de privacidade</a>, <a href="#">Termos de uso</a> e <a href="#contato">Contato</a>.</p>
    </section>

    <!-- ── Testes ── -->
    <section id="testes" class="section" aria-labelledby="h-testes">
      <div class="section-label">02 · Testes</div>
      <h2 id="h-testes">Correções aplicadas na v5.2.0</h2>
      <p>Seis bugs foram identificados e corrigidos antes do lançamento desta versão. Use os botões de <em>Aumentar Texto</em> e <em>Diminuir Texto</em> no menu e observe como a tabela abaixo escala em tempo real.</p>

      <table class="test-table" role="table" aria-label="Registro de bugs corrigidos na v5.2.0">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Bug</th>
            <th scope="col">Impacto</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td><code>--pai-menu-border</code> não declarada</td>
            <td>Borda invisível no menu</td>
            <td><span class="badge badge-fix">Corrigido</span></td>
          </tr>
          <tr>
            <td>2</td>
            <td>Filtros tritanopia/achromatopsia não removidos</td>
            <td>Filtro preso ao trocar</td>
            <td><span class="badge badge-fix">Corrigido</span></td>
          </tr>
          <tr>
            <td>3</td>
            <td>vLibras inicializado antes do script carregar</td>
            <td>Erro silencioso no console</td>
            <td><span class="badge badge-fix">Corrigido</span></td>
          </tr>
          <tr>
            <td>4</td>
            <td>Botões de tritanopia e achromatopsia ausentes</td>
            <td>Funcionalidade inacessível</td>
            <td><span class="badge badge-new">Adicionado</span></td>
          </tr>
          <tr>
            <td>5</td>
            <td><code>localStorage</code> sem try/catch</td>
            <td>Quebra em modo privado</td>
            <td><span class="badge badge-fix">Corrigido</span></td>
          </tr>
          <tr>
            <td>6</td>
            <td>Fonte sem limite de tamanho</td>
            <td>Layout quebrado</td>
            <td><span class="badge badge-ok">Limitado</span></td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- ── Cores ── -->
    <section id="cores" class="section" aria-labelledby="h-cores">
      <div class="section-label">03 · Cores</div>
      <h2 id="h-cores">Paleta para teste de daltonismo</h2>
      <p>Ative os filtros de daltonismo no menu e observe como estas cores mudam. Cada filtro simula um tipo diferente de deficiência na percepção cromática.</p>

      <div class="palette-block">
        <h3>Espectro primário</h3>
        <div class="color-palette" role="list" aria-label="Swatches de cores primárias">
          <div class="swatch" role="listitem" style="background:#e74c3c;" title="Vermelho"></div>
          <div class="swatch" role="listitem" style="background:#e67e22;" title="Laranja"></div>
          <div class="swatch" role="listitem" style="background:#f1c40f;" title="Amarelo"></div>
          <div class="swatch" role="listitem" style="background:#2ecc71;" title="Verde"></div>
          <div class="swatch" role="listitem" style="background:#1abc9c;" title="Turquesa"></div>
          <div class="swatch" role="listitem" style="background:#3498db;" title="Azul"></div>
          <div class="swatch" role="listitem" style="background:#9b59b6;" title="Roxo"></div>
          <div class="swatch" role="listitem" style="background:#e91e63;" title="Rosa"></div>
        </div>
      </div>

      <div class="palette-block">
        <h3>Gradiente vermelho → verde</h3>
        <div class="color-palette" role="list" aria-label="Swatches de gradiente vermelho-verde">
          <div class="swatch" role="listitem" style="background:#c0392b;"></div>
          <div class="swatch" role="listitem" style="background:#e74c3c;"></div>
          <div class="swatch" role="listitem" style="background:#f1948a;"></div>
          <div class="swatch" role="listitem" style="background:#fadbd8;"></div>
          <div class="swatch" role="listitem" style="background:#d5f5e3;"></div>
          <div class="swatch" role="listitem" style="background:#82e0aa;"></div>
          <div class="swatch" role="listitem" style="background:#27ae60;"></div>
          <div class="swatch" role="listitem" style="background:#1e8449;"></div>
        </div>
      </div>

      <div class="filter-note" role="note">
        <span class="material-symbols-outlined" aria-hidden="true">info</span>
        <span>Com <strong>Achromatopsia</strong> ativa, todas as cores acima aparecem em escala de cinza, simulando ausência total de percepção cromática. Com <strong>Protanopia</strong> ou <strong>Deuteranopia</strong>, o gradiente vermelho–verde torna-se quase indistinguível.</span>
      </div>
    </section>

    <!-- ── Contato ── -->
    <section id="contato" class="section" aria-labelledby="h-contato">
      <div class="section-label">04 · Contato</div>
      <h2 id="h-contato">Fale com a gente</h2>

      <div class="contact-grid">

        <div class="contact-info">
          <h3>Entre em contato</h3>
          <p>Dúvidas sobre o plugin, sugestões de melhoria ou quer colaborar? Preencha o formulário ou escreva diretamente por e-mail.</p>
          <a href="mailto:ola@camilaloliveira.com" class="contact-detail">
            <span class="material-symbols-outlined" aria-hidden="true">mail</span>
            ola@camilaloliveira.com
          </a>
          <a href="https://github.com/clcmo/plugin-acessibilidade-integrada" target="_blank" rel="noopener" class="contact-detail">
            <span class="material-symbols-outlined" aria-hidden="true">code</span>
            Ver código no GitHub
          </a>
          <a href="https://github.com/sponsors/clcmo" target="_blank" rel="noopener" class="contact-detail">
            <span class="material-symbols-outlined" aria-hidden="true">favorite</span>
            Apoiar o projeto
          </a>
        </div>

        <div class="form-card">
          <!--
            O formulário usa action="mailto:" para abrir o cliente de e-mail
            do usuário com os campos preenchidos. Para um envio server-side
            real, substitua o action por um endpoint próprio (ex: Formspree,
            Netlify Forms ou uma rota PHP/Node).
          -->
          <form
            id="contact-form"
            action="mailto:ola@camilaloliveira.com"
            method="GET"
            enctype="text/plain"
            aria-label="Formulário de contato"
            onsubmit="return buildMailto(event)"
          >
            <div class="form-row">
              <div class="form-group">
                <label for="contact-name">Nome</label>
                <input
                  type="text"
                  id="contact-name"
                  name="name"
                  placeholder="Seu nome"
                  required
                  autocomplete="name"
                  aria-required="true"
                >
              </div>
              <div class="form-group">
                <label for="contact-email">E-mail</label>
                <input
                  type="email"
                  id="contact-email"
                  name="email"
                  placeholder="seu@email.com"
                  required
                  autocomplete="email"
                  aria-required="true"
                >
              </div>
            </div>

            <div class="form-group">
              <label for="contact-subject">Assunto</label>
              <select id="contact-subject" name="subject" aria-required="true">
                <option value="Dúvida sobre o PAI">Dúvida sobre o plugin</option>
                <option value="Sugestão de melhoria">Sugestão de melhoria</option>
                <option value="Reporte de bug">Reporte de bug</option>
                <option value="Colaboração">Quero colaborar</option>
                <option value="Outro">Outro assunto</option>
              </select>
            </div>

            <div class="form-group">
              <label for="contact-message">Mensagem</label>
              <textarea
                id="contact-message"
                name="message"
                placeholder="Descreva sua dúvida ou sugestão…"
                required
                aria-required="true"
              ></textarea>
            </div>

            <button type="submit" class="btn-submit">
              <span class="material-symbols-outlined" aria-hidden="true" style="font-size:1.1rem;">send</span>
              Enviar mensagem
            </button>
          </form>
        </div>

      </div>
    </section>

  </main>

  <!-- ── Rodapé ── -->
  <footer>
    <p>
      <strong>PAI v5.2.0</strong> · Desenvolvido por
      <a href="mailto:ola@camilaloliveira.com">Camila</a> ·
      <a href="https://github.com/clcmo/plugin-acessibilidade-integrada" target="_blank" rel="noopener">Ver código-fonte</a> ·
      Licença MIT
    </p>
  </footer>

  <!-- ════════════════════════════════════════════
       FILTROS SVG DE DALTONISMO
  ════════════════════════════════════════════ -->
  <svg style="display:none" aria-hidden="true">
    <defs>
      <filter id="pai-f-p">
        <feColorMatrix values="0.567, 0.433, 0, 0, 0,
                               0.558, 0.442, 0, 0, 0,
                               0,     0.242, 0.758, 0, 0,
                               0,     0,     0, 1, 0" />
      </filter>
      <filter id="pai-f-d">
        <feColorMatrix values="0.625, 0.375, 0, 0, 0,
                               0.7,   0.3,   0, 0, 0,
                               0,     0.3,   0.7, 0, 0,
                               0,     0,     0, 1, 0" />
      </filter>
      <filter id="pai-f-t">
        <feColorMatrix values="0.95, 0.05,  0,     0, 0,
                               0,    0.433, 0.567, 0, 0,
                               0,    0.475, 0.525, 0, 0,
                               0,    0,     0,     1, 0" />
      </filter>
    </defs>
  </svg>

  <!-- ── Botão flutuante de acessibilidade ── -->
  <button id="pai-btn" aria-label="Abrir menu de acessibilidade" aria-expanded="false" aria-controls="pai-menu">
    <span class="material-symbols-outlined" style="font-size:26px;">accessibility_new</span>
  </button>

  <!-- ── Menu de acessibilidade ── -->
  <div id="pai-menu" style="display:none;" role="dialog" aria-modal="true" aria-label="Opções de acessibilidade">
    <h3>♿ Acessibilidade</h3>

    <button class="pai-opt" id="pai-contrast-btn">
      <span class="material-symbols-outlined">contrast</span> Alto Contraste
    </button>
    <button class="pai-opt" id="pai-font-up">
      <span class="material-symbols-outlined">text_increase</span> Aumentar Texto
    </button>
    <button class="pai-opt" id="pai-font-down">
      <span class="material-symbols-outlined">text_decrease</span> Diminuir Texto
    </button>

    <div class="pai-section-title">Daltonismo</div>
    <button class="pai-opt d-opt" data-filter="pai-protanopia">
      <span class="material-symbols-outlined">palette</span> Protanopia
    </button>
    <button class="pai-opt d-opt" data-filter="pai-deuteranopia">
      <span class="material-symbols-outlined">palette</span> Deuteranopia
    </button>
    <button class="pai-opt d-opt" data-filter="pai-tritanopia">
      <span class="material-symbols-outlined">palette</span> Tritanopia
    </button>
    <button class="pai-opt d-opt" data-filter="pai-achromatopsia">
      <span class="material-symbols-outlined">palette</span> Achromatopsia
    </button>

    <div class="pai-section-title">Tradução em Libras</div>
    <button id="toggle-vlibras">
      <span class="material-symbols-outlined" id="vlibras-icon">waving_hand</span>
      <span id="vlibras-text">Ativar Tradução</span>
    </button>

    <button class="pai-opt" id="pai-reset" style="margin-top:8px; color:#dc2626; border-color:#dc2626;">
      <span class="material-symbols-outlined">restart_alt</span> Resetar tudo
    </button>

    <div class="pai-vlibras-container" id="vlibras-host">
      <div vw class="enabled v-libras-wrapper">
        <div vw-access-button></div>
        <div vw-plugin-wrapper>
          <div class="vw-plugin-top-wrapper"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ── Scripts ── -->
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script src="./assets/js/script.js"></script>

  <script>
    /**
     * buildMailto — monta um link mailto: com os campos do formulário
     * e redireciona o navegador para ele, abrindo o cliente de e-mail.
     * Usado como fallback para ambientes sem back-end (GH Pages).
     */
    function buildMailto(e) {
      e.preventDefault();

      const name    = document.getElementById('contact-name').value.trim();
      const email   = document.getElementById('contact-email').value.trim();
      const subject = document.getElementById('contact-subject').value;
      const message = document.getElementById('contact-message').value.trim();

      const body = [
        `Nome: ${name}`,
        `E-mail de resposta: ${email}`,
        '',
        message
      ].join('\n');

      const mailto =
        'mailto:ola@camilaloliveira.com' +
        '?subject=' + encodeURIComponent(subject) +
        '&body='    + encodeURIComponent(body);

      window.location.href = mailto;
      return false;
    }
  </script>

</body>
</html>
