(function () {

    /* ─────────────────────────────
       Estado persistido
    ───────────────────────────── */
    let state;
    try {
        state = JSON.parse(localStorage.getItem('pai_v5')) || {
            contrast: false,
            fontSize: 0,
            filter: ''
        };
    } catch (e) {
        state = { contrast: false, fontSize: 0, filter: '' };
    }

    const menu = document.getElementById('pai-menu');
    const btn = document.getElementById('pai-btn');

    const allFilters = [
        'pai-protanopia',
        'pai-deuteranopia',
        'pai-tritanopia',
        'pai-achromatopsia'
    ];

    const FONT_MIN = -10;
    const FONT_MAX = 20;

    /* ─────────────────────────────
       Módulo vLibras (Refatorado)
    ───────────────────────────── */
    let vlibrasWidget = null;

    function initVlibras() {
        if (window.VLibras && typeof window.VLibras.Widget === 'function' && !vlibrasWidget) {
            vlibrasWidget = new window.VLibras.Widget('https://vlibras.gov.br/app');
        } else if (!vlibrasWidget) {
            setTimeout(initVlibras, 500);
        }
    }

    initVlibras();

    function toggleVlibras() {
        const wrapper = document.querySelector('.v-libras-wrapper');
        const pluginWrapper = document.querySelector('[vw-plugin-wrapper]');
        
        // Verifica se o widget já está visível/ativo
        const isActive = wrapper.classList.contains('active') || 
                         (pluginWrapper && pluginWrapper.classList.contains('active'));

        if (isActive) {
            // AÇÃO: ENCERRAR
            const closeBtn = document.querySelector('.vp-close-button');
            if (closeBtn) {
                closeBtn.click();
            } else {
                // Fallback: tenta clicar no botão de acesso original para alternar
                const accessButton = document.querySelector('[vw-access-button]');
                if (accessButton) accessButton.click();
            }
            // Força a atualização da UI do menu PAI
            updateVlibrasButton(false);
        } else {
            // AÇÃO: ATIVAR
            const accessButton = document.querySelector('[vw-access-button]');
            if (accessButton) {
                accessButton.click();
                
                // Aguarda o carregamento e sincroniza
                setTimeout(() => {
                    const checkActive = document.querySelector('.v-libras-wrapper').classList.contains('active')
                        || (document.querySelector('[vw-plugin-wrapper]') && document.querySelector('[vw-plugin-wrapper]').classList.contains('active'));
                    
                    updateVlibrasButton(checkActive);
                }, 500);
            }
        }
    }

    function updateVlibrasButton(active) {
        const icon = document.getElementById('vlibras-icon');
        const text = document.getElementById('vlibras-text');
        const button = document.getElementById('toggle-vlibras');
        const container = document.getElementById('vlibras-host');
        const wrapper = document.querySelector('.v-libras-wrapper');
        const menuElement = document.getElementById('pai-menu');

        if (icon) icon.textContent = active ? 'close' : 'waving_hand';
        if (text) text.textContent = active ? 'Encerrar Tradução' : 'Ativar Tradução';
        if (button) button.classList.toggle('active', active);

        if (container && wrapper) {
            if (active) {
                container.classList.add('active');
                wrapper.classList.add('active');
                setTimeout(() => {
                    menuElement.scrollTo({
                        top: menuElement.scrollHeight,
                        behavior: 'smooth'
                    });
                }, 300);
            } else {
                container.classList.remove('active');
                wrapper.classList.remove('active');
            }
        }
    }

    // Eventos do vLibras
    document.getElementById('toggle-vlibras').addEventListener('click', toggleVlibras);

    window.addEventListener('vp-widget-close', () => {
        updateVlibrasButton(false);
    });

    /* ─────────────────────────────
       Aplicação das Opções (Acessibilidade)
    ───────────────────────────── */
    function apply() {
        document.body.classList.toggle('pai-high-contrast', state.contrast);
        document.getElementById('pai-contrast-btn').classList.toggle('active', state.contrast);

        allFilters.forEach(filter => document.body.classList.remove(filter));
        if (state.filter) document.body.classList.add(state.filter);

        document.querySelectorAll('.d-opt').forEach(button => {
            button.classList.toggle('active', button.dataset.filter === state.filter);
        });

        document.querySelectorAll('p, h1, h2, h3, a, li, td, th, blockquote').forEach(el => {
            let base = parseFloat(el.getAttribute('data-base') || window.getComputedStyle(el).fontSize);
            if (!el.getAttribute('data-base')) el.setAttribute('data-base', base);
            el.style.fontSize = (base + state.fontSize) + 'px';
        });

        const upBtn = document.getElementById('pai-font-up');
        const downBtn = document.getElementById('pai-font-down');
        upBtn.disabled = state.fontSize >= FONT_MAX;
        downBtn.disabled = state.fontSize <= FONT_MIN;
        upBtn.style.opacity = state.fontSize >= FONT_MAX ? '0.4' : '1';
        downBtn.style.opacity = state.fontSize <= FONT_MIN ? '0.4' : '1';

        try {
            localStorage.setItem('pai_v5', JSON.stringify(state));
        } catch (e) { }
    }

    /* ─────────────────────────────
       Controles do Menu e Botões
    ───────────────────────────── */
    btn.onclick = () => {
        const isClosed = menu.style.display === 'none' || menu.style.display === '';
        menu.style.display = isClosed ? 'flex' : 'none';
        btn.setAttribute('aria-expanded', String(isClosed));
    };

    document.getElementById('pai-contrast-btn').onclick = () => {
        state.contrast = !state.contrast;
        apply();
    };

    document.getElementById('pai-font-up').onclick = () => {
        if (state.fontSize < FONT_MAX) {
            state.fontSize += 2;
            apply();
        }
    };

    document.getElementById('pai-font-down').onclick = () => {
        if (state.fontSize > FONT_MIN) {
            state.fontSize -= 2;
            apply();
        }
    };

    document.querySelectorAll('.d-opt').forEach(button => {
        button.onclick = () => {
            state.filter = state.filter === button.dataset.filter ? '' : button.dataset.filter;
            apply();
        };
    });

    document.getElementById('pai-reset').onclick = () => {
        state.contrast = false;
        state.fontSize = 0;
        state.filter = '';
        document.querySelectorAll('[data-base]').forEach(el => {
            el.removeAttribute('data-base');
            el.style.fontSize = '';
        });
        
        // Se o vLibras estiver ativo, encerra ele também no reset
        if (document.querySelector('.v-libras-wrapper.active')) {
            toggleVlibras();
        }

        apply();
    };

    // Inicialização padrão
    apply();

})();