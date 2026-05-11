<?php
/**
 * Plugin Name: Plugin de Acessibilidade Integrado (PAI)
 * Description: Versão 5.0.0: Botão flutuante com vLibras, controle de contraste, tamanho de fonte e filtros de daltonismo (WCAG 2.1 AA).
 * Version: 5.0.0
 * Author: Camila
 * Text Domain: pai-accessibility
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'pai_plugin_assets' );
function pai_plugin_assets() {
    wp_enqueue_style(
        'material-symbols-outlined',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200',
        [],
        '0.44.6'
    );
}

add_action( 'wp_footer', 'pai_render_widget' );
function pai_render_widget() {
    ?>
    <style>
        /* =============================================
           PAI – Plugin de Acessibilidade Integrado
           Version: 5.0.0
        ============================================= */

        :root {
            --pai-bg:           #0073aa;
            --pai-bg-hover:     #005a87;
            --pai-menu-bg:      #ffffff;
            --pai-menu-border:  #dddddd;
            --pai-menu-text:    #333333;
            --pai-btn-border:   #0073aa;
            --pai-btn-color:    #0073aa;
            --pai-btn-hover-bg: #0073aa;
            --pai-btn-hover-fg: #ffffff;
            --pai-shadow:       rgba(0,0,0,0.2);
        }

        body.pai-high-contrast {
            --pai-bg:           #ffff00;
            --pai-bg-hover:     #cccc00;
            --pai-menu-bg:      #000000;
            --pai-menu-border:  #ffff00;
            --pai-menu-text:    #ffffff;
            --pai-btn-border:   #ffff00;
            --pai-btn-color:    #ffff00;
            --pai-btn-hover-bg: #ffff00;
            --pai-btn-hover-fg: #000000;
            background-color:   #000000 !important;
            color:              #ffffff !important;
        }

        /* Daltonismo - Classes de Filtro */
        .pai-protanopia { filter: url('#pai-filter-protanopia'); }
        .pai-deuteranopia { filter: url('#pai-filter-deuteranopia'); }
        .pai-tritanopia { filter: url('#pai-filter-tritanopia'); }
        .pai-achromatopsia { filter: grayscale(1); }

        /* Botão flutuante */
        #pai-btn {
            position: fixed; bottom: 20px; right: 20px;
            background: var(--pai-bg); color: #fff;
            width: 55px; height: 55px; border-radius: 50%;
            border: 2px solid transparent; display: flex;
            align-items: center; justify-content: center;
            cursor: pointer; z-index: 10000;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: transform 0.2s, background 0.2s;
        }
        #pai-btn:hover, #pai-btn:focus-visible {
            transform: scale(1.1); background: var(--pai-bg-hover);
            outline: 3px solid #fff; outline-offset: 2px;
        }

        /* Menu */
        #pai-menu {
            position: fixed; bottom: 85px; right: 20px;
            background: var(--pai-menu-bg); border: 1px solid var(--pai-menu-border);
            padding: 20px; border-radius: 12px; z-index: 9999;
            width: 280px; box-shadow: 0 10px 25px var(--pai-shadow);
            font-family: sans-serif; color: var(--pai-menu-text);
            max-height: 80vh; overflow-y: auto;
        }
        #pai-menu[hidden] { display: none; }
        #pai-menu h3 { margin: 0 0 15px 0; font-size: 18px; text-align: center; }

        .pai-section-title {
            font-size: 12px; font-weight: bold; margin: 15px 0 8px;
            color: var(--pai-menu-text); text-transform: uppercase; opacity: 0.7;
        }

        .pai-opt {
            display: flex; align-items: center; width: 100%;
            padding: 10px; margin-bottom: 6px;
            border: 2px solid var(--pai-btn-border);
            background: transparent; color: var(--pai-btn-color);
            border-radius: 5px; cursor: pointer;
            font-weight: bold; font-size: 14px; text-align: left;
        }
        .pai-opt:hover, .pai-opt:focus-visible, .pai-opt.active {
            background: var(--pai-btn-hover-bg); color: var(--pai-btn-hover-fg);
        }

        .pai-icon {
            font-family: 'Material Symbols Outlined'; font-size: 20px;
            margin-right: 10px; font-variation-settings: 'FILL' 0;
        }
        .pai-opt.active .pai-icon { font-variation-settings: 'FILL' 1; }

        .pai-divider { margin: 15px 0; border: 0; border-top: 1px solid var(--pai-menu-border); }
    </style>

    <!-- Filtros SVG para Daltonismo -->
    <svg style="display:none" aria-hidden="true">
        <defs>
            <filter id="pai-filter-protanopia"><feColorMatrix values="0.567, 0.433, 0, 0, 0, 0.558, 0.442, 0, 0, 0, 0, 0.242, 0.758, 0, 0, 0, 0, 0, 1, 0"/></filter>
            <filter id="pai-filter-deuteranopia"><feColorMatrix values="0.625, 0.375, 0, 0, 0, 0.7, 0.3, 0, 0, 0, 0, 0.3, 0.7, 0, 0, 0, 0, 0, 1, 0"/></filter>
            <filter id="pai-filter-tritanopia"><feColorMatrix values="0.95, 0.05, 0, 0, 0, 0, 0.433, 0.567, 0, 0, 0, 0.475, 0.525, 0, 0, 0, 0, 0, 1, 0"/></filter>
        </defs>
    </svg>

    <button id="pai-btn" aria-haspopup="dialog" aria-expanded="false" aria-controls="pai-menu" aria-label="Menu de acessibilidade">
        <span class="material-symbols-outlined pai-icon" style="font-size:30px; margin:0;">accessibility_new</span>
    </button>

    <div id="pai-menu" role="dialog" aria-label="Opções de acessibilidade" hidden>
        <h3>Acessibilidade</h3>

        <div class="pai-section-title">Visual</div>
        <button class="pai-opt" id="pai-contrast-btn" aria-pressed="false">
            <span class="material-symbols-outlined pai-icon">contrast</span> Alto Contraste
        </button>
        <button class="pai-opt" id="pai-font-up-btn" aria-label="Aumentar texto">
            <span class="material-symbols-outlined pai-icon">text_increase</span> Aumentar Texto
        </button>
        <button class="pai-opt" id="pai-font-down-btn" aria-label="Diminuir texto">
            <span class="material-symbols-outlined pai-icon">text_decrease</span> Diminuir Texto
        </button>

        <div class="pai-section-title">Daltonismo</div>
        <button class="pai-opt pai-filter-opt" data-filter="pai-protanopia">Protanopia</button>
        <button class="pai-opt pai-filter-opt" data-filter="pai-deuteranopia">Deuteranopia</button>
        <button class="pai-opt pai-filter-opt" data-filter="pai-tritanopia">Tritanopia</button>
        <button class="pai-opt pai-filter-opt" data-filter="pai-achromatopsia">Acromatopsia</button>

        <button class="pai-opt" id="pai-reset-btn" style="margin-top:10px; border-color:#cc0000; color:#cc0000;">
            <span class="material-symbols-outlined pai-icon">settings_backup_restore</span> Resetar Tudo
        </button>

        <hr class="pai-divider">

        <!-- vLibras -->
        <div vw class="enabled" style="position:relative!important;left:0!important;top:0!important;margin:0 auto;">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper><div class="vw-plugin-top-wrapper"></div></div>
        </div>
    </div>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
    (function () {
        'use strict';
        const STORAGE_KEY = 'pai_prefs_v5';
        const state = JSON.parse(localStorage.getItem(STORAGE_KEY)) || { contrast: false, fontSize: 0, filter: '' };

        const btn = document.getElementById('pai-btn');
        const menu = document.getElementById('pai-menu');
        const filterBtns = document.querySelectorAll('.pai-filter-opt');

        if (window.VLibras) new window.VLibras.Widget('https://vlibras.gov.br/app');

        function applyState() {
            // Contraste
            document.body.classList.toggle('pai-high-contrast', state.contrast);
            document.getElementById('pai-contrast-btn').setAttribute('aria-pressed', state.contrast);
            document.getElementById('pai-contrast-btn').classList.toggle('active', state.contrast);

            // Filtros Daltonismo
            document.body.classList.remove('pai-protanopia', 'pai-deuteranopia', 'pai-tritanopia', 'pai-achromatopsia');
            filterBtns.forEach(b => b.classList.remove('active'));
            if (state.filter) {
                document.body.classList.add(state.filter);
                const activeBtn = document.querySelector(`[data-filter="${state.filter}"]`);
                if (activeBtn) activeBtn.classList.add('active');
            }

            // Fonte
            document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, li, a, span').forEach(el => {
                let base = parseFloat(el.getAttribute('data-pai-base') || window.getComputedStyle(el).fontSize);
                if (!el.getAttribute('data-pai-base')) el.setAttribute('data-pai-base', base);
                el.style.fontSize = state.fontSize === 0 ? '' : (Math.min(Math.max(base + state.fontSize, 10), 32)) + 'px';
            });

            localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
        }

        // Handlers
        btn.onclick = () => {
            menu.hidden = !menu.hidden;
            btn.setAttribute('aria-expanded', !menu.hidden);
            if (!menu.hidden) menu.querySelector('button').focus();
        };

        document.getElementById('pai-contrast-btn').onclick = () => { state.contrast = !state.contrast; applyState(); };
        document.getElementById('pai-font-up-btn').onclick = () => { state.fontSize += 2; applyState(); };
        document.getElementById('pai-font-down-btn').onclick = () => { state.fontSize -= 2; applyState(); };
        
        filterBtns.forEach(fBtn => {
            fBtn.onclick = () => {
                state.filter = (state.filter === fBtn.dataset.filter) ? '' : fBtn.dataset.filter;
                applyState();
            };
        });

        document.getElementById('pai-reset-btn').onclick = () => {
            state.contrast = false; state.fontSize = 0; state.filter = '';
            applyState();
        };

        // Fechar com ESC ou clique fora
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !menu.hidden) { menu.hidden = true; btn.focus(); } });
        document.addEventListener('click', (e) => { if (!menu.hidden && !menu.contains(e.target) && e.target !== btn) menu.hidden = true; });

        applyState();
    })();
    </script>
    <?php
}