<?php
/**
 * Plugin Name: Acessibilidade Integrada (PAI)
 * Version: 5.2.0
 * Author: Camila L. Oliveira
 * Description: Widget de acessibilidade para WordPress com alto contraste, ajuste de fonte, filtros de daltonismo e tradução em Libras. Use o botão azul no canto inferior direito.
 * Plugin URI: http://wordpress.org/plugins/acessibilidade-integrada/
 * Author URI: https://go.camilaloliveira.com/dev
 * Text Domain: acessibilidade-integrada
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Carrega os arquivos CSS e JS
add_action( 'wp_enqueue_scripts', 'pai_plugin_assets' );
function pai_plugin_assets() {
    // Estilos do Google (Ícones)
    wp_enqueue_style('material-symbols', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200');

    // Seu CSS à parte
    wp_enqueue_style('style', plugins_url( '/assets/css/style.css', __FILE__ ), [], '5.2.0');

    // Script do vLibras (Externo)
    wp_enqueue_script('vlibras-externo', 'https://vlibras.gov.br/app/vlibras-plugin.js', [], null, true);

    // Seu JS à parte (dependente do vLibras)
    wp_enqueue_script('script', plugins_url( '/assets/js/script.js', __FILE__ ), ['vlibras-externo'], '5.2.0', true);
}

// 2. Renderiza apenas o HTML no footer
add_action( 'wp_footer', 'pai_render_widget' );
function pai_render_widget() {
    ?>
    <svg style="display:none">
        <defs>
            <filter id="pai-f-p"><feColorMatrix values="0.567, 0.433, 0, 0, 0, 0.558, 0.442, 0, 0, 0, 0, 0.242, 0.758, 0, 0, 0, 0, 0, 1, 0"/></filter>
            <filter id="pai-f-d"><feColorMatrix values="0.625, 0.375, 0, 0, 0, 0.7, 0.3, 0, 0, 0, 0, 0.3, 0.7, 0, 0, 0, 0, 0, 1, 0"/></filter>
            <filter id="pai-f-t"><feColorMatrix values="0.95, 0.05, 0, 0, 0, 0, 0.433, 0.567, 0, 0, 0, 0.475, 0.525, 0, 0, 0, 0, 0, 1, 0"/></filter>
        </defs>
    </svg>

    <button id="pai-btn" aria-label="Acessibilidade">
        <span class="material-symbols-outlined">accessibility_new</span>
    </button>

    <div id="pai-menu" style="display:none;">
        <h3 style="margin:0 0 12px; text-align:center; font-size: 16px;">♿ Acessibilidade</h3>
        
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
        <button class="pai-opt d-opt" data-filter="pai-protanopia">Protanopia</button>
        <button class="pai-opt d-opt" data-filter="pai-deuteranopia">Deuteranopia</button>
        <button class="pai-opt d-opt" data-filter="pai-tritanopia">Tritanopia</button>
        <button class="pai-opt d-opt" data-filter="pai-achromatopsia">Achromatopsia</button>
        
        <div class="pai-section-title">Libras</div>
        <button id="toggle-vlibras">
            <span class="material-symbols-outlined" id="vlibras-icon">waving_hand</span>
            <span id="vlibras-text">Ativar Tradução</span>
        </button>

        <div class="pai-vlibras-container" id="vlibras-host">
            <div vw class="enabled v-libras-wrapper">
                <div vw-access-button></div>
                <div vw-plugin-wrapper><div class="vw-plugin-top-wrapper"></div></div>
            </div>
        </div>

        <button class="pai-opt" id="pai-reset" style="margin-top:10px; color:#c0392b; border-color:#c0392b;">
            <span class="material-symbols-outlined">restart_alt</span> Resetar Tudo
        </button>
    </div>
    <?php
}
