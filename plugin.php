<?php
/**
 * Plugin Name: Plugin de Acessibilidade Integrado (PAI)
 * Description: Botão flutuante com vLibras, controle de contraste e tamanho de fonte — com conformidade WCAG 2.1 AA.
 * Version: 4.0.0
 * Author: Camila
 * Text Domain: pai-accessibility
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'pai_plugin_assets' );
function pai_plugin_assets() {
    /**
     * Material Symbols – Google Fonts (versão atual: 0.44.6 / maio 2025)
     * Fonte variável com eixos: Fill, Weight (wght), Grade (GRAD), Optical Size (opsz)
     * Documentação: https://developers.google.com/fonts/docs/material_symbols
     */
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
           Version: 4.0.0
           WCAG 2.1 AA compliant
        ============================================= */

        /* Variáveis padrão e modo escuro/alto contraste */
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

        /* Alto contraste — troca as variáveis; sem filter: invert() */
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
        body.pai-high-contrast a,
        body.pai-high-contrast p,
        body.pai-high-contrast h1,
        body.pai-high-contrast h2,
        body.pai-high-contrast h3,
        body.pai-high-contrast h4,
        body.pai-high-contrast h5,
        body.pai-high-contrast h6,
        body.pai-high-contrast li,
        body.pai-high-contrast span {
            color: #ffffff !important;
            background-color: transparent !important;
        }

        /* Botão flutuante */
        #pai-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--pai-bg);
            color: #fff;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            border: 2px solid transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10000;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: transform 0.2s, background 0.2s;
        }
        #pai-btn:hover,
        #pai-btn:focus-visible {
            transform: scale(1.1);
            background: var(--pai-bg-hover);
            outline: 3px solid #fff;
            outline-offset: 2px;
        }

        /* Menu */
        #pai-menu {
            position: fixed;
            bottom: 85px;
            right: 20px;
            background: var(--pai-menu-bg);
            border: 1px solid var(--pai-menu-border);
            padding: 20px;
            border-radius: 12px;
            z-index: 9999;
            width: 260px;
            box-shadow: 0 10px 25px var(--pai-shadow);
            font-family: sans-serif;
            color: var(--pai-menu-text);
        }
        #pai-menu[hidden] { display: none; }

        #pai-menu h3 {
            margin: 0 0 15px 0;
            font-size: 18px;
            color: var(--pai-menu-text);
            text-align: center;
        }

        .pai-opt {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 8px;
            border: 2px solid var(--pai-btn-border);
            background: transparent;
            color: var(--pai-btn-color);
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: background 0.15s, color 0.15s;
        }
        .pai-opt:hover,
        .pai-opt:focus-visible {
            background: var(--pai-btn-hover-bg);
            color: var(--pai-btn-hover-fg);
            outline: 3px solid var(--pai-btn-border);
            outline-offset: 2px;
        }

        /* Separador */
        .pai-divider {
            margin: 15px 0;
            border: 0;
            border-top: 1px solid var(--pai-menu-border);
        }

        /* ── Material Symbols ──────────────────────────── */
        /* Fonte variável – eixos configurados via font-variation-settings  */
        .pai-icon {
            font-family: 'Material Symbols Outlined', sans-serif;
            font-size: 28px;
            line-height: 1;
            display: inline-block;
            vertical-align: middle;
            user-select: none;
            /* wght 400 | GRAD 0 | opsz 24 | FILL 0 */
            font-variation-settings: 'wght' 400, 'GRAD' 0, 'opsz' 24, 'FILL' 0;
            transition: font-variation-settings 0.2s;
        }
        /* Ícone do botão flutuante — maior e preenchido ao hover */
        #pai-btn .pai-icon {
            font-size: 30px;
            font-variation-settings: 'wght' 300, 'GRAD' 0, 'opsz' 48, 'FILL' 0;
        }
        #pai-btn:hover .pai-icon,
        #pai-btn:focus-visible .pai-icon {
            font-variation-settings: 'wght' 500, 'GRAD' 0, 'opsz' 48, 'FILL' 1;
        }
        /* Ícones inline dos botões do menu */
        .pai-opt .pai-icon {
            font-size: 18px;
            margin-right: 8px;
            font-variation-settings: 'wght' 400, 'GRAD' 0, 'opsz' 20, 'FILL' 0;
            vertical-align: text-bottom;
        }
        .pai-opt:hover .pai-icon,
        .pai-opt:focus-visible .pai-icon {
            font-variation-settings: 'wght' 500, 'GRAD' 0, 'opsz' 20, 'FILL' 1;
        }
    </style>

    <!-- Botão flutuante -->
    <button
        id="pai-btn"
        aria-haspopup="dialog"
        aria-expanded="false"
        aria-controls="pai-menu"
        aria-label="Abrir menu de acessibilidade"
    >
        <!-- accessibility_new = ícone de acessibilidade universal do Material Symbols -->
        <span class="material-symbols-outlined pai-icon" aria-hidden="true">accessibility_new</span>
    </button>

    <!-- Menu de acessibilidade -->
    <div
        id="pai-menu"
        role="dialog"
        aria-modal="false"
        aria-label="Opções de acessibilidade"
        hidden
    >
        <h3 id="pai-menu-title">Acessibilidade</h3>

        <button class="pai-opt" id="pai-contrast-btn" aria-pressed="false">
            <span class="material-symbols-outlined pai-icon" aria-hidden="true">contrast</span>
            Alto Contraste
        </button>
        <button class="pai-opt" id="pai-font-up-btn" aria-label="Aumentar tamanho do texto">
            <span class="material-symbols-outlined pai-icon" aria-hidden="true">text_increase</span>
            Aumentar Texto
        </button>
        <button class="pai-opt" id="pai-font-down-btn" aria-label="Diminuir tamanho do texto">
            <span class="material-symbols-outlined pai-icon" aria-hidden="true">text_decrease</span>
            Diminuir Texto
        </button>
        <button class="pai-opt" id="pai-reset-btn">
            <span class="material-symbols-outlined pai-icon" aria-hidden="true">settings_backup_restore</span>
            Resetar
        </button>

        <hr class="pai-divider" aria-hidden="true">

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

        /* ── Constantes ─────────────────────────────────── */
        var FONT_STEP   = 2;
        var FONT_MIN    = 10;
        var FONT_MAX    = 32;
        var STORAGE_KEY = 'pai_prefs';

        /* ── Elementos ──────────────────────────────────── */
        var btn         = document.getElementById('pai-btn');
        var menu        = document.getElementById('pai-menu');
        var contrastBtn = document.getElementById('pai-contrast-btn');
        var fontUpBtn   = document.getElementById('pai-font-up-btn');
        var fontDownBtn = document.getElementById('pai-font-down-btn');
        var resetBtn    = document.getElementById('pai-reset-btn');

        /* ── Estado ─────────────────────────────────────── */
        var state = loadPrefs();

        /* ── vLibras ─────────────────────────────────────── */
        if (window.VLibras) {
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        }

        /* ── Aplicar estado salvo ao carregar ───────────── */
        applyState();

        /* ── Abrir / fechar menu ────────────────────────── */
        btn.addEventListener('click', toggleMenu);

        btn.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleMenu();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !menu.hidden) {
                closeMenu();
                btn.focus();
            }
        });

        /* Fechar ao clicar fora */
        document.addEventListener('click', function (e) {
            if (!menu.hidden && !menu.contains(e.target) && e.target !== btn) {
                closeMenu();
            }
        });

        /* ── Ações ──────────────────────────────────────── */
        contrastBtn.addEventListener('click', function () {
            state.contrast = !state.contrast;
            applyState();
            savePrefs();
        });

        fontUpBtn.addEventListener('click', function () {
            state.fontSize = Math.min(state.fontSize + FONT_STEP, FONT_MAX);
            applyState();
            savePrefs();
        });

        fontDownBtn.addEventListener('click', function () {
            state.fontSize = Math.max(state.fontSize - FONT_STEP, FONT_MIN);
            applyState();
            savePrefs();
        });

        resetBtn.addEventListener('click', function () {
            state = defaultState();
            applyState();
            savePrefs();
        });

        /* ── Funções auxiliares ─────────────────────────── */
        function toggleMenu() {
            if (menu.hidden) {
                openMenu();
            } else {
                closeMenu();
            }
        }

        function openMenu() {
            menu.hidden = false;
            btn.setAttribute('aria-expanded', 'true');
            /* Move o foco para o primeiro botão do menu */
            var firstFocusable = menu.querySelector('button');
            if (firstFocusable) firstFocusable.focus();
        }

        function closeMenu() {
            menu.hidden = true;
            btn.setAttribute('aria-expanded', 'false');
        }

        function applyState() {
            /* Alto contraste */
            document.body.classList.toggle('pai-high-contrast', state.contrast);
            contrastBtn.setAttribute('aria-pressed', String(state.contrast));

            /* Tamanho de fonte */
            var elements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, li, a, span');
            elements.forEach(function (el) {
                if (state.fontSize === 0) {
                    el.style.fontSize = '';
                } else {
                    var base = parseFloat(el.getAttribute('data-pai-base') || window.getComputedStyle(el).fontSize);
                    if (!el.getAttribute('data-pai-base')) {
                        el.setAttribute('data-pai-base', base);
                    }
                    el.style.fontSize = Math.min(Math.max(base + state.fontSize, FONT_MIN), FONT_MAX) + 'px';
                }
            });
        }

        function defaultState() {
            return { contrast: false, fontSize: 0 };
        }

        function savePrefs() {
            try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
            } catch (e) { /* localStorage indisponível */ }
        }

        function loadPrefs() {
            try {
                var raw = localStorage.getItem(STORAGE_KEY);
                return raw ? JSON.parse(raw) : defaultState();
            } catch (e) {
                return defaultState();
            }
        }
    })();
    </script>
    <?php
}