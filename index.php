<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAI — Página de Teste</title>
    <meta name="description"
        content="Página de demonstração do plugin de acessibilidade PAI com alto contraste, ajuste de fonte, daltonismo e tradução em Libras." />
    <meta property="og:title" content="Diário de Acessibilidade — PAI v5.2.0" />
    <meta property="og:description"
        content="Demonstrativo do plugin de acessibilidade com recursos para alto contraste, ajuste de fonte, daltonismo e tradução em Libras." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://example.com/" />
    <meta property="og:image"
        content="https://og-image.vercel.app/Di%C3%A1rio%20de%20Acessibilidade.png?theme=light&md=0&fontSize=85px&title=Di%C3%A1rio%20de%20Acessibilidade&subtitle=PAI%20v5.2.0" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:alt" content="Visual de compartilhamento do Diário de Acessibilidade PAI" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Diário de Acessibilidade — PAI v5.2.0" />
    <meta name="twitter:description"
        content="Plugin de acessibilidade com alto contraste, ajuste de fonte, daltonismo e tradução em Libras." />
    <meta name="twitter:image"
        content="https://og-image.vercel.app/Di%C3%A1rio%20de%20Acessibilidade.png?theme=light&md=0&fontSize=85px&title=Di%C3%A1rio%20de%20Acessibilidade&subtitle=PAI%20v5.2.0" />
    <meta name="twitter:image:alt" content="Visual de compartilhamento do Diário de Acessibilidade PAI" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@400;500&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <!-- ── Cabeçalho ── -->
    <header>
        <span class="site-name">Diário de Acessibilidade</span>
        <nav>
            <a href="#sobre">Sobre</a>
            <a href="#testes">Testes</a>
            <a href="#cores">Cores</a>
            <a href="#contato">Contato</a>
        </nav>
    </header>

    <!-- ── Hero ── -->
    <div class="hero">
        <div class="hero-badge">Página de demonstração · PAI v5.2.0</div>
        <h1>Acessibilidade para<br>todos os usuários</h1>
        <p>Esta página foi criada para testar todas as funcionalidades do Plugin de Acessibilidade Integrado. Use o
            botão azul no canto inferior direito.</p>
    </div>

    <!-- ── Conteúdo principal ── -->
    <div class="container">

        <article id="sobre">
            <h2>O que este plugin oferece</h2>
            <p>O <strong>PAI</strong> é um widget de acessibilidade que pode ser adicionado a qualquer site WordPress
                sem configuração. Ele persiste as preferências do usuário entre visitas e funciona em todos os
                navegadores modernos.</p>

            <div class="feature-grid">
                <div class="feature-card">
                    <div class="icon">🌑</div>
                    <strong>Alto Contraste</strong>
                    <span>Modo escuro forçado para baixa visão</span>
                </div>
                <div class="feature-card">
                    <div class="icon">🔤</div>
                    <strong>Ajuste de Fonte</strong>
                    <span>±2px com limites de segurança</span>
                </div>
                <div class="feature-card">
                    <div class="icon">👁</div>
                    <strong>Daltonismo</strong>
                    <span>4 filtros via SVG feColorMatrix</span>
                </div>
                <div class="feature-card">
                    <div class="icon">🤟</div>
                    <strong>Libras</strong>
                    <span>vLibras com botão customizado</span>
                </div>
            </div>

            <h3>Como as preferências são salvas</h3>
            <p>Cada ajuste é gravado no <code>localStorage</code> do navegador sob a chave <code>pai_v5</code>. Ao
                recarregar a página, o estado é restaurado automaticamente. Clique em <em>Resetar</em> para voltar ao
                padrão.</p>

            <blockquote>
                "Acessibilidade não é uma funcionalidade opcional — é um requisito fundamental para qualquer produto
                digital que respeite seus usuários."
            </blockquote>

            <p>Links para testar o comportamento com alto contraste ativo: <a href="#">Política de privacidade</a>, <a
                    href="#">Termos de uso</a> e <a href="#">Contato</a>.</p>
        </article>

        <article id="testes">
            <h2>Correções aplicadas na v5.2.0</h2>
            <p>Seis bugs foram identificados e corrigidos antes do lançamento desta versão:</p>

            <table class="test-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bug</th>
                        <th>Impacto</th>
                        <th>Status</th>
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
        </article>

        <article id="cores">
            <h2>Paleta para teste de daltonismo</h2>
            <p>Ative os filtros de daltonismo no menu e observe como estas cores mudam. Cada filtro simula um tipo
                diferente de deficiência na percepção de cores:</p>

            <h3>Vermelho · Verde · Azul</h3>
            <div class="color-palette">
                <div class="swatch" style="background:#e74c3c;" title="Vermelho"></div>
                <div class="swatch" style="background:#e67e22;" title="Laranja"></div>
                <div class="swatch" style="background:#f1c40f;" title="Amarelo"></div>
                <div class="swatch" style="background:#2ecc71;" title="Verde"></div>
                <div class="swatch" style="background:#1abc9c;" title="Turquesa"></div>
                <div class="swatch" style="background:#3498db;" title="Azul"></div>
                <div class="swatch" style="background:#9b59b6;" title="Roxo"></div>
                <div class="swatch" style="background:#e91e63;" title="Rosa"></div>
            </div>

            <h3>Tons e saturação</h3>
            <div class="color-palette">
                <div class="swatch" style="background:#c0392b;"></div>
                <div class="swatch" style="background:#e74c3c;"></div>
                <div class="swatch" style="background:#f1948a;"></div>
                <div class="swatch" style="background:#fadbd8;"></div>
                <div class="swatch" style="background:#d5f5e3;"></div>
                <div class="swatch" style="background:#82e0aa;"></div>
                <div class="swatch" style="background:#27ae60;"></div>
                <div class="swatch" style="background:#1e8449;"></div>
            </div>

            <p>Com <strong>Achromatopsia</strong> ativa, todas as cores acima aparecem em escala de cinza, simulando
                ausência total de percepção cromática.</p>
        </article>

        <article id="contato">
            <h2>Texto longo — teste de ajuste de fonte</h2>
            <p>Use os botões <em>Aumentar Texto</em> e <em>Diminuir Texto</em> no menu e observe como este parágrafo, os
                títulos e os links abaixo se ajustam em tempo real.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus
                et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget,
                tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est.
                Mauris placerat eleifend leo.</p>

            <h3>Subtítulo também deve escalar</h3>
            <p>Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo
                vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci,
                sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut
                felis.</p>

            <ol>
                <li>Primeiro item da lista para verificar escalagem</li>
                <li>Segundo item com <a href="#">link interno</a></li>
                <li>Terceiro item com texto mais longo para testar quebra de linha no novo tamanho</li>
            </ol>
        </article>

        <article id="vlibras-features" class="vlibras-features" aria-hidden="true">
            <h2>Funcionalidades do vLibras</h2>
            <ul>
                <li>Tradução automática de conteúdo em Libras</li>
                <li>Avatar intérprete com interface acessível</li>
                <li>Suporte para leitura de textos e navegação</li>
                <li>Compatível com navegadores modernos</li>
            </ul>
        </article>

    </div>

    <!-- ── Rodapé ── -->
    <footer>
        <p>Página de teste do <strong>PAI v5.2.0</strong> · Desenvolvido por Camila · <a href="#">Ver código-fonte</a>
        </p>
    </footer>

    <!-- ════════════════════════════════════════════
         PLUGIN PAI — embutido diretamente (sem WP)
    ════════════════════════════════════════════ -->

    <!-- Filtros SVG de daltonismo -->
    <svg style="display:none">
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

    <!-- Botão principal de acessibilidade -->
    <button id="pai-btn" aria-label="Abrir menu de acessibilidade" aria-expanded="false">
        <span class="material-symbols-outlined" style="font-size:26px;">accessibility_new</span>
    </button>

    <!-- Menu de acessibilidade -->
    <div id="pai-menu" style="display:none;" role="dialog" aria-label="Opções de acessibilidade">
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
        <!--
            Botão que o usuário vê e clica.
            O JS aciona programaticamente o [vw-access-button] real do vLibras,
            que está no DOM fora do menu (opacity:0, pointer-events:none).
        -->
        <button id="toggle-vlibras">
            <span class="material-symbols-outlined" id="vlibras-icon">waving_hand</span>
            <span id="vlibras-text">Ativar Tradução</span>
        </button>

        <button class="pai-opt" id="pai-reset" style="margin-top:10px; color:#c0392b; border-color:#c0392b;">
            <span class="material-symbols-outlined">restart_alt</span> Resetar tudo
        </button>

        <!-- Container reservado para o bonequinho -->
        <div class="pai-vlibras-container" id="vlibras-host">
            <div vw class="enabled v-libras-wrapper">
                <div vw-access-button></div>
                <div vw-plugin-wrapper>
                    <div class="vw-plugin-top-wrapper"></div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

    <script src="./assets/js/script.js"></script>

</body>

</html>