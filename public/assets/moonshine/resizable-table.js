/*
 * Drag the right edge of a header cell to resize its column. Widths are kept
 * per table in localStorage; double-click an edge to reset that column.
 * Cell values are also copied into title="" so a clipped value (some clients
 * send very long User-Agent strings) can be read on hover.
 *
 * Opt in with <table data-resizable="key" data-resizable-defaults='{"col":px}'>;
 * columns are matched by the th's data-column-selection attribute.
 */
(() => {
    const MIN_WIDTH = 50;
    const FALLBACK_WIDTH = 140;

    const read = (key) => {
        try {
            return JSON.parse(localStorage.getItem(key) || '{}') || {};
        } catch (e) {
            return {};
        }
    };

    const write = (key, value) => {
        try {
            localStorage.setItem(key, JSON.stringify(value));
        } catch (e) {
            // storage unavailable: widths just won't persist
        }
    };

    const init = (table) => {
        const headers = [...table.querySelectorAll('thead th[data-column-selection]')];

        if (!headers.length || table.dataset.resizableReady) {
            return;
        }

        table.dataset.resizableReady = '1';

        const storageKey = 'ms-resizable:' + table.dataset.resizable;
        let defaults = {};
        try {
            defaults = JSON.parse(table.dataset.resizableDefaults || '{}');
        } catch (e) {
            defaults = {};
        }
        const saved = read(storageKey);

        const columnOf = (th) => th.dataset.columnSelection;
        const widthOf = (th) => saved[columnOf(th)] ?? defaults[columnOf(th)] ?? FALLBACK_WIDTH;

        const apply = () => {
            let total = 0;

            headers.forEach((th) => {
                const width = widthOf(th);
                th.style.width = width + 'px';
                total += width;
            });

            table.style.width = total + 'px';
        };

        headers.forEach((th) => {
            const handle = document.createElement('span');
            handle.className = 'col-resizer';
            handle.title = 'Потяните, чтобы изменить ширину; двойной клик — сбросить';
            th.appendChild(handle);

            // The header is also a sort link: never let a resize act as a click.
            handle.addEventListener('click', (event) => event.stopPropagation());

            handle.addEventListener('dblclick', (event) => {
                event.stopPropagation();
                delete saved[columnOf(th)];
                write(storageKey, saved);
                apply();
            });

            handle.addEventListener('pointerdown', (event) => {
                event.preventDefault();
                event.stopPropagation();
                handle.setPointerCapture(event.pointerId);
                handle.classList.add('is-active');

                const startX = event.clientX;
                const startWidth = widthOf(th);

                const move = (e) => {
                    saved[columnOf(th)] = Math.max(MIN_WIDTH, Math.round(startWidth + e.clientX - startX));
                    apply();
                };

                const stop = () => {
                    handle.classList.remove('is-active');
                    handle.removeEventListener('pointermove', move);
                    handle.removeEventListener('pointerup', stop);
                    handle.removeEventListener('pointercancel', stop);
                    write(storageKey, saved);
                };

                handle.addEventListener('pointermove', move);
                handle.addEventListener('pointerup', stop);
                handle.addEventListener('pointercancel', stop);
            });
        });

        table.querySelectorAll('tbody td').forEach((td) => {
            const text = td.textContent.trim();

            if (text) {
                td.title = text;
            }
        });

        apply();
    };

    const scan = () => document.querySelectorAll('table[data-resizable]').forEach(init);

    // Lists are re-rendered over XHR (sorting, paging, filters): new <table>.
    new MutationObserver(scan).observe(document.documentElement, {childList: true, subtree: true});
    document.addEventListener('DOMContentLoaded', scan);
    scan();
})();
