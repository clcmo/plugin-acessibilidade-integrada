<?php
/**
 * Plugin Name: Plugin de Acessibilidade Integrado (PAI)
 * Description: Versão 5.1.0: Menu flutuante auto-ajustável, vLibras padronizado e filtros de daltonismo.
 * Version: 5.1.0
 * Author: Camila
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
        :root {
            --pai-bg: #0073aa;
            --pai-menu-bg: #ffffff;
            --pai-menu-text: #333333;
            --pai-btn-border: #0073aa;
            --pai-shadow: rgba(0,0,0,0.2);
        }

        body.pai-high-contrast {
            --pai-menu-bg: #000000;
            --pai-menu-text: #ffffff;
            --pai-btn-border: #ffff00;
            background-color: #000 !important;
            color: #fff !important;
        }

        /* Classes de Filtro */
        .pai-protanopia { filter: url('#pai-f-p'); }
        .pai-deuteranopia { filter: url('#pai-f-d'); }
        .pai-tritanopia { filter: url('#pai-f-t'); }
        .pai-achromatopsia { filter: grayscale(1); }

        #pai-btn {
            position: fixed; bottom: 20px; right: 20px;
            background: var(--pai-bg); color: #fff;
            width: 55px; height: 55px; border-radius: 50%;
            border: none; cursor: pointer; z-index: 10001;
            box-shadow: 0 4px 10px var(--pai-shadow);
        }

        #pai-menu {
            position: fixed; bottom: 85px; right: 20px;
            background: var(--pai-menu-bg); border: 1px solid var(--pai-menu-border);
            padding: 15px; border-radius: 12px; z-index: 10000;
            width: 280px; box-shadow: 0 10px 25px var(--pai-shadow);
            display: flex; flex-direction: column;
            height: auto; /* Altura automática */
        }

        .pai-section-title { font-size: 11px; font-weight: bold; margin: 10px 0 5px; opacity: 0.7; text-transform: uppercase; }

        .pai-opt {
            display: flex; align-items: center; width: 100%;
            padding: 10px; margin-bottom: 5px;
            border: 2px solid var(--pai-btn-border);
            background: transparent; color: var(--pai-btn-border);
            border-radius: 6px; cursor: pointer; font-weight: bold;
        }

        .pai-opt:hover, .pai-opt.active { background: var(--pai-bg); color: #fff; }

        /* Ajuste vLibras para parecer um botão do menu */
        .v-libras-wrapper {
            position: relative !important;
            width: 100% !important;
            height: 45px !important;
            border: 2px solid var(--pai-btn-border);
            border-radius: 6px;
            overflow: hidden;
            margin-top: 5px;
        }
        /* Esconde o boneco inicial do vLibras para não flutuar fora do menu */
        [vw-access-button] { 
            position: relative !important; 
            top: 0 !important; right: 0 !important; 
            width: 100% !important; height: 100% !important; 
            background-color: transparent !important;
            box-shadow: none !important;
        }
    </style>

    <svg style="display:none">
        <defs>
            <filter id="pai-f-p"><feColorMatrix values="0.567, 0.433, 0, 0, 0, 0.558, 0.442, 0, 0, 0, 0, 0.242, 0.758, 0, 0, 0, 0, 0, 1, 0"/></filter>
            <filter id="pai-f-d"><feColorMatrix values="0.625, 0.375, 0, 0, 0, 0.7, 0.3, 0, 0, 0, 0, 0.3, 0.7, 0, 0, 0, 0, 0, 1, 0"/></filter>
            <filter id="pai-f-t"><feColorMatrix values="0.95, 0.05, 0, 0, 0, 0, 0.433, 0.567, 0, 0, 0, 0.475, 0.525, 0, 0, 0, 0, 0, 1, 0"/></filter>
        </defs>
    </svg>

    <button id="pai-btn"><span class="material-symbols-outlined">accessibility_new</span></button>

    <div id="pai-menu" style="display:none;">
        <h3 style="margin:0 0 10px; text-align:center;">Acessibilidade</h3>
        
        <button class="pai-opt" id="pai-contrast-btn">Contraste</button>
        <button class="pai-opt" id="pai-font-up">Aumentar Texto</button>
        <button class="pai-opt" id="pai-font-down">Diminuir Texto</button>

        <div class="pai-section-title">Daltonismo</div>
        <button class="pai-opt d-opt" data-filter="pai-protanopia">Protanopia</button>
        <button class="pai-opt d-opt" data-filter="pai-deuteranopia">Deuteranopia</button>
        
        <div class="pai-section-title">Tradução</div>
        <div vw class="enabled v-libras-wrapper">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper><div class="vw-plugin-top-wrapper"></div></div>
        </div>

        <button class="pai-opt" id="pai-reset" style="margin-top:10px; color:red; border-color:red;">Resetar</button>
    </div>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
    (function () {
        const state = JSON.parse(localStorage.getItem('pai_v5')) || { contrast: false, fontSize: 0, filter: '' };
        const menu = document.getElementById('pai-menu');
        const btn = document.getElementById('pai-btn');

        if(window.VLibras) new window.VLibras.Widget('https://vlibras.gov.br/app');

        function apply() {
            document.body.classList.toggle('pai-high-contrast', state.contrast);
            document.body.classList.remove('pai-protanopia', 'pai-deuteranopia');
            if (state.filter) document.body.classList.add(state.filter);
            
            document.querySelectorAll('.d-opt').forEach(b => b.classList.toggle('active', b.dataset.filter === state.filter));
            
            document.querySelectorAll('p, h1, h2, h3, a').forEach(el => {
                let base = parseFloat(el.getAttribute('data-base') || window.getComputedStyle(el).fontSize);
                if(!el.getAttribute('data-base')) el.setAttribute('data-base', base);
                el.style.fontSize = (base + state.fontSize) + 'px';
            });
            localStorage.setItem('pai_v5', JSON.stringify(state));
        }

        btn.onclick = () => {
            const isOpening = menu.style.display === 'none';
            menu.style.display = isOpening ? 'flex' : 'none';
            
            // Se fechar o menu, encerra o vLibras (limpa a instância visual se aberta)
            if (!isOpening && window.VLibras) {
                const closeV = document.querySelector('.vw-plugin-top-wrapper .access-button-close');
                if(closeV) closeV.click();
            }
        };

        document.getElementById('pai-contrast-btn').onclick = () => { state.contrast = !state.contrast; apply(); };
        document.getElementById('pai-font-up').onclick = () => { state.fontSize += 2; apply(); };
        document.getElementById('pai-font-down').onclick = () => { state.fontSize -= 2; apply(); };
        
        document.querySelectorAll('.d-opt').forEach(b => {
            b.onclick = () => { state.filter = (state.filter === b.dataset.filter) ? '' : b.dataset.filter; apply(); };
        });

        document.getElementById('pai-reset').onclick = () => {
            state.contrast = false; state.fontSize = 0; state.filter = '';
            apply();
        };

        apply();
    })();
    </script>
    <?php
}