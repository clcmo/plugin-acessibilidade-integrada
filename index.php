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
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@400;500&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

  <!-- ✅ Caminho correto que o script.js e style.css esperam -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <style>
    /*
     * Estilos COMPLEMENTARES ao style.css original.
     * Cobrem apenas elementos novos desta página:
     * seções numeradas, paleta de cores, formulário de contato.
     * Nenhuma regra do style.css é redeclarada aqui.
     */

    /* ── Skip link ── */
    .skip-link {
      position: absolute; top: -999px; left: 1rem;
      background: var(--c-accent); color: #fff;
      padding: .35rem .9rem; border-radius: 6px;
      font-size: .82rem; font-weight: 500;
      z-index: 9999; text-decoration: none;
      transition: top .15s;
    }
    .skip-link:focus { top: 1rem; }

    /* ── Wrapper de seções ── */
    .section {
      padding: 3.5rem 0;
      border-bottom: 1px solid var(--c-border);
    }
    .section:last-child { border-bottom: none; }

    /* Rótulo numerado acima do h2 */
    .section-label {
      display: flex; align-items: center; gap: .6rem;
      font-size: .7rem; font-weight: 700;
      letter-spacing: .14em; text-transform: uppercase;
      color: var(--c-muted); margin-bottom: .9rem;
    }
    .section-label::after {
      content: ''; flex: 1;
      height: 1px; background: var(--c-border);
    }

    /* ── Tipografia das seções ── */
    .section h2 {
      font-family: var(--font-serif);
      font-size: clamp(1.5rem, 3.5vw, 2.2rem);
      line-height: 1.2; letter-spacing: -.02em;
      color: var(--c-ink); margin-bottom: .85rem;
    }
    .section h3 {
      font-family: var(--font-serif);
      font-size: 1.1rem; color: var(--c-ink);
      margin: 1.75rem 0 .6rem;
    }
    .section p {
      color: var(--c-muted); margin-bottom: .9rem; font-size: .95rem;
    }
    .section p:last-child { margin-bottom: 0; }
    .section a { color: var(--c-accent); }
    .section a:hover { text-decoration: underline; }

    blockquote {
      border-left: 3px solid var(--c-accent);
      margin: 1.75rem 0; padding: .9rem 1.4rem;
      background: #f0f4f9;
      border-radius: 0 6px 6px 0;
      font-family: var(--font-serif);
      font-style: italic; font-size: 1rem;
      color: var(--c-ink);
    }
    body.pai-high-contrast blockquote {
      background: #111; border-color: var(--c-accent);
    }

    /* ── Feature grid ── */
    .feature-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(175px, 1fr));
      gap: .9rem; margin: 1.75rem 0;
    }
    .feature-card {
      display: flex; flex-direction: column; gap: .35rem;
      padding: 1.25rem 1.1rem;
      background: var(--c-bg);
      border: 1px solid var(--c-border);
      border-radius: 10px;
      transition: box-shadow .2s, transform .2s;
    }
    .feature-card:hover {
      box-shadow: 0 4px 14px rgba(0,0,0,.09);
      transform: translateY(-2px);
    }
    .feature-card .icon { font-size: 1.5rem; margin-bottom: .15rem; }
    .feature-card strong { font-size: .9rem; color: var(--c-ink); }
    .feature-card span  { font-size: .8rem;  color: var(--c-muted); }

    /* ── Tabela de testes ── */
    .test-table {
      width: 100%; border-collapse: collapse;
      font-size: .88rem; margin-top: 1.4rem;
      border-radius: 10px; overflow: hidden;
      box-shadow: 0 1px 4px rgba(0,0,0,.07);
    }
    .test-table thead tr { background: var(--c-ink); color: #fff; }
    .test-table th {
      padding: .8rem 1rem; text-align: left;
      font-size: .72rem; font-weight: 700;
      letter-spacing: .09em; text-transform: uppercase;
    }
    .test-table td {
      padding: .8rem 1rem;
      border-bottom: 1px solid var(--c-border);
      color: var(--c-muted); vertical-align: middle;
    }
    .test-table tbody tr { background: var(--c-surface); transition: background .15s; }
    .test-table tbody tr:hover { background: var(--c-bg); }
    .test-table tbody tr:last-child td { border-bottom: none; }
    body.pai-high-contrast .test-table tbody tr { background: #111; }
    body.pai-high-contrast .test-table thead tr { background: #333; }

    /* badge-new ausente no style.css original */
    .badge-new { background: #dbeafe; color: #1d4ed8; }

    /* ── Paleta de cores ── */
    .palette-block {
      margin: 1.5rem 0; padding: 1.5rem;
      background: var(--c-bg);
      border: 1px solid var(--c-border);
      border-radius: 12px;
    }
    .palette-block > p {
      font-size: .78rem; font-weight: 700;
      letter-spacing: .1em; text-transform: uppercase;
      color: var(--c-muted); margin: 0 0 .9rem;
    }
    .color-palette { display: flex; gap: .55rem; flex-wrap: wrap; }
    .swatch {
      width: 52px; height: 52px;
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0,0,0,.12);
      position: relative; cursor: default;
      transition: transform .18s;
    }
    .swatch:hover { transform: scale(1.13); }
    .swatch[title]::after {
      content: attr(title);
      position: absolute; bottom: calc(100% + 6px); left: 50%;
      transform: translateX(-50%);
      background: var(--c-ink); color: var(--c-surface);
      font-size: .67rem; padding: .2rem .45rem;
      border-radius: 4px; white-space: nowrap;
      opacity: 0; pointer-events: none; transition: opacity .15s;
    }
    .swatch:hover::after { opacity: 1; }

    .filter-note {
      display: flex; align-items: flex-start; gap: .65rem;
      margin-top: 1.25rem; padding: .9rem 1.1rem;
      background: var(--c-surface); border: 1px solid var(--c-border);
      border-radius: 8px; font-size: .85rem; color: var(--c-muted);
    }
    .filter-note .material-symbols-outlined {
      font-size: 1.1rem; color: var(--c-accent);
      flex-shrink: 0; margin-top: .1rem;
    }

    /* ── Formulário de contato ── */
    .contact-grid {
      display: grid;
      grid-template-columns: 1fr 1.65fr;
      gap: 2.5rem; align-items: start;
      margin-top: 1.75rem;
    }
    @media (max-width: 620px) {
      .contact-grid { grid-template-columns: 1fr; gap: 1.75rem; }
    }

    .contact-info h3 { margin-top: 0; }
    .contact-info p  { font-size: .88rem; margin-bottom: 1.1rem; }

    .contact-detail {
      display: flex; align-items: center; gap: .55rem;
      font-size: .85rem; color: var(--c-muted);
      text-decoration: none; margin-bottom: .55rem;
      transition: color .2s;
    }
    .contact-detail .material-symbols-outlined {
      font-size: 1.05rem; color: var(--c-accent);
    }
    a.contact-detail:hover { color: var(--c-accent); }

    .form-card {
      background: var(--c-surface);
      border: 1px solid var(--c-border);
      border-radius: 14px; padding: 1.75rem;
      box-shadow: 0 2px 8px rgba(0,0,0,.06);
    }
    body.pai-high-contrast .form-card { background: #111; border-color: #444; }

    .form-group { margin-bottom: 1.1rem; }
    .form-group label {
      display: block; font-size: .75rem; font-weight: 700;
      letter-spacing: .07em; text-transform: uppercase;
      color: var(--c-muted); margin-bottom: .35rem;
    }
    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%; padding: .65rem .9rem;
      font-family: var(--font-body); font-size: .9rem;
      color: var(--c-ink); background: var(--c-bg);
      border: 1px solid var(--c-border); border-radius: 7px;
      outline: none; resize: vertical;
      transition: border-color .2s, box-shadow .2s;
    }
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      border-color: var(--c-accent);
      box-shadow: 0 0 0 3px rgba(42,100,150,.13);
    }
    .form-group textarea { min-height: 115px; }
    body.pai-high-contrast .form-group input,
    body.pai-high-contrast .form-group textarea,
    body.pai-high-contrast .form-group select {
      background: #000; color: #fff; border-color: #555;
    }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: .9rem; }
    @media (max-width: 460px) { .form-row { grid-template-columns: 1fr; } }

    .btn-submit {
      display: flex; align-items: center;
      justify-content: center; gap: .45rem;
      width: 100%; padding: .8rem 1.4rem;
      background: var(--c-accent); color: #fff;
      font-family: var(--font-body); font-size: .9rem;
      font-weight: 500; border: none; border-radius: 9px;
      cursor: pointer; margin-top: .25rem;
      box-shadow: 0 2px 8px rgba(42,100,150,.25);
      transition: background .2s, transform .15s, box-shadow .2s;
    }
    .btn-submit:hover {
      background: #1f4f78;
      transform: translateY(-1px);
      box-shadow: 0 4px 14px rgba(42,100,150,.3);
    }
    .btn-submit:active { transform: translateY(0); }

    /* ── Hero CTA ── */
    .hero-cta {
      display: inline-flex; align-items: center; gap: .45rem;
      background: rgba(255,255,255,.18);
      border: 1px solid rgba(255,255,255,.45);
      color: #fff; padding: .6rem 1.4rem;
      border-radius: 8px; font-size: .875rem;
      font-weight: 500; text-decoration: none;
      margin-top: 1.5rem;
      transition: background .2s, transform .15s;
    }
    .hero-cta:hover {
      background: rgba(255,255,255,.28);
      transform: translateY(-1px);
    }

    /* ── Responsivo ── */
    @media (max-width: 600px) {
      .feature-grid { grid-template-columns: 1fr 1fr; }
      .test-table   { font-size: .78rem; }
      .test-table th, .test-table td { padding: .6rem .7rem; }
    }
    @media (max-width: 400px) {
      .feature-grid { grid-template-columns: 1fr; }
    }
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
    <div class="hero-badge">Demonstração · PAI v5.2.0</div>
    <h1>Acessibilidade para<br>todos os usuários</h1>
    <p>Widget de acessibilidade para WordPress com alto contraste, ajuste de fonte, filtros de daltonismo e tradução em Libras. Use o botão azul no canto inferior direito.</p>
    <a href="#sobre" class="hero-cta">
      <span class="material-symbols-outlined" style="font-size:1rem;">arrow_downward</span>
      Explorar o plugin
    </a>
  </div>

  <!-- ── Conteúdo principal ── -->
  <main id="main">
    <div class="container">

      <!-- 01 · Sobre -->
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

      <!-- 02 · Testes -->
      <section id="testes" class="section" aria-labelledby="h-testes">
        <div class="section-label">02 · Testes</div>
        <h2 id="h-testes">Correções aplicadas na v5.2.0</h2>
        <p>Seis bugs foram identificados e corrigidos antes do lançamento desta versão. Use os botões <em>Aumentar Texto</em> e <em>Diminuir Texto</em> no menu e observe como a tabela escala em tempo real.</p>

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

      <!-- 03 · Cores -->
      <section id="cores" class="section" aria-labelledby="h-cores">
        <div class="section-label">03 · Cores</div>
        <h2 id="h-cores">Paleta para teste de daltonismo</h2>
        <p>Ative os filtros de daltonismo no menu e observe como estas cores mudam. Cada filtro simula um tipo diferente de deficiência na percepção cromática.</p>

        <div class="palette-block">
          <p>Espectro primário</p>
          <div class="color-palette" role="list" aria-label="Cores primárias">
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
          <p>Gradiente vermelho → verde</p>
          <div class="color-palette" role="list" aria-label="Gradiente vermelho-verde">
            <div class="swatch" role="listitem" style="background:#c0392b;" title="#c0392b"></div>
            <div class="swatch" role="listitem" style="background:#e74c3c;" title="#e74c3c"></div>
            <div class="swatch" role="listitem" style="background:#f1948a;" title="#f1948a"></div>
            <div class="swatch" role="listitem" style="background:#fadbd8;" title="#fadbd8"></div>
            <div class="swatch" role="listitem" style="background:#d5f5e3;" title="#d5f5e3"></div>
            <div class="swatch" role="listitem" style="background:#82e0aa;" title="#82e0aa"></div>
            <div class="swatch" role="listitem" style="background:#27ae60;" title="#27ae60"></div>
            <div class="swatch" role="listitem" style="background:#1e8449;" title="#1e8449"></div>
          </div>
        </div>

        <div class="filter-note" role="note">
          <span class="material-symbols-outlined" aria-hidden="true">info</span>
          <span>Com <strong>Achromatopsia</strong> ativa, todas as cores aparecem em escala de cinza, simulando ausência total de percepção cromática. Com <strong>Protanopia</strong> ou <strong>Deuteranopia</strong>, o gradiente vermelho–verde torna-se quase indistinguível.</span>
        </div>
      </section>

      <!-- 04 · Contato -->
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
            <form
              id="contact-form"
              aria-label="Formulário de contato"
              onsubmit="return buildMailto(event)"
            >
              <div class="form-row">
                <div class="form-group">
                  <label for="contact-name">Nome</label>
                  <input type="text" id="contact-name" name="name"
                    placeholder="Seu nome" required autocomplete="name" aria-required="true">
                </div>
                <div class="form-group">
                  <label for="contact-email">E-mail</label>
                  <input type="email" id="contact-email" name="email"
                    placeholder="seu@email.com" required autocomplete="email" aria-required="true">
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
                <textarea id="contact-message" name="message"
                  placeholder="Descreva sua dúvida ou sugestão…"
                  required aria-required="true"></textarea>
              </div>

              <button type="submit" class="btn-submit">
                <span class="material-symbols-outlined" aria-hidden="true" style="font-size:1rem;">send</span>
                Enviar mensagem
              </button>
            </form>
          </div>

        </div>
      </section>

    </div><!-- /.container -->
  </main>

  <!-- ── Rodapé ── -->
  <footer>
    <p>
      <strong>PAI v5.2.0</strong> · Desenvolvido por
      <a href="mailto:ola@camilaloliveira.com" style="color:var(--c-accent)">Camila</a> ·
      <a href="https://github.com/clcmo/plugin-acessibilidade-integrada" target="_blank" rel="noopener" style="color:var(--c-accent)">Ver código-fonte</a> ·
      Licença MIT
    </p>
  </footer>

  <!-- ════════════════════════════════════════════
       FILTROS SVG DE DALTONISMO
       IDs devem coincidir com o style.css:
         .pai-protanopia   → filter: url('#pai-f-p')
         .pai-deuteranopia → filter: url('#pai-f-d')
         .pai-tritanopia   → filter: url('#pai-f-t')
         .pai-achromatopsia → filter: grayscale(1)  (sem SVG)
  ════════════════════════════════════════════ -->
  <svg style="display:none" aria-hidden="true">
    <defs>
      <filter id="pai-f-p">
        <feColorMatrix values="0.567, 0.433, 0,     0, 0,
                               0.558, 0.442, 0,     0, 0,
                               0,     0.242, 0.758, 0, 0,
                               0,     0,     0,     1, 0" />
      </filter>
      <filter id="pai-f-d">
        <feColorMatrix values="0.625, 0.375, 0,   0, 0,
                               0.7,   0.3,   0,   0, 0,
                               0,     0.3,   0.7, 0, 0,
                               0,     0,     0,   1, 0" />
      </filter>
      <filter id="pai-f-t">
        <feColorMatrix values="0.95, 0.05,  0,     0, 0,
                               0,    0.433, 0.567, 0, 0,
                               0,    0.475, 0.525, 0, 0,
                               0,    0,     0,     1, 0" />
      </filter>
    </defs>
  </svg>

  <!-- ── Botão flutuante ── -->
  <button id="pai-btn"
    aria-label="Abrir menu de acessibilidade"
    aria-expanded="false"
    aria-controls="pai-menu">
    <span class="material-symbols-outlined" style="font-size:26px;">accessibility_new</span>
  </button>

  <!-- ── Menu de acessibilidade ── -->
  <!--
    display:none aqui é gerenciado pelo script.js (ele usa toggle),
    portanto NÃO adicionamos nenhum style inline de layout — o style.css
    já define #pai-menu com flex-direction:column e os demais estilos.
  -->
  <div id="pai-menu"
    style="display:none;"
    role="dialog"
    aria-modal="true"
    aria-label="Opções de acessibilidade">

    <h3 style="margin:0 0 10px; font-size:.9rem; text-align:center; color:var(--pai-menu-text);">♿ Acessibilidade</h3>

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

    <button class="pai-opt" id="pai-reset"
      style="margin-top:8px; color:#c0392b; border-color:#c0392b;">
      <span class="material-symbols-outlined">restart_alt</span> Resetar tudo
    </button>

    <!--
      Container do vLibras.
      Altura controlada pelo style.css:
        .pai-vlibras-container         → height:0; opacity:0; overflow:hidden
        .pai-vlibras-container.active  → height:320px; opacity:1; overflow:visible
      O script.js alterna a classe .active aqui e em .v-libras-wrapper.
    -->
    <div class="pai-vlibras-container" id="vlibras-host">
      <div vw class="enabled v-libras-wrapper">
        <div vw-access-button></div>
        <div vw-plugin-wrapper>
          <div class="vw-plugin-top-wrapper"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ✅ script.js (não pai-script.js) -->
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script src="./assets/js/script.js"></script>

  <script>
    /**
     * buildMailto — monta mailto: com os campos preenchidos e
     * abre o cliente de e-mail padrão do usuário.
     * Solução 100% estática compatível com GitHub Pages.
     */
    function buildMailto(e) {
      e.preventDefault();
      const name    = document.getElementById('contact-name').value.trim();
      const email   = document.getElementById('contact-email').value.trim();
      const subject = document.getElementById('contact-subject').value;
      const message = document.getElementById('contact-message').value.trim();

      const body = [
        'Nome: '               + name,
        'E-mail de resposta: ' + email,
        '',
        message
      ].join('\n');

      window.location.href =
        'mailto:ola@camilaloliveira.com' +
        '?subject=' + encodeURIComponent(subject) +
        '&body='    + encodeURIComponent(body);

      return false;
    }
  </script>

</body>
</html>
