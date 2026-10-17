<script data-navigate-once>
    // Cremona's native table wheel scrolling, scoped to actual table scrollports.
    if (! window.__marcosTableWheelScroll) {
        window.__marcosTableWheelScroll = true;

        document.addEventListener('wheel', (event) => {
            if (event.defaultPrevented || event.ctrlKey || Math.abs(event.deltaX) > Math.abs(event.deltaY)) {
                return;
            }

            const target = event.target instanceof Element ? event.target : null;
            const container = target?.closest('.admin-data-table .fi-ta-content-ctn, .admin-table-scroll');

            // Preserve native interaction in controls and the floating action menus.
            if (! container || target.closest('input, textarea, select, [contenteditable="true"], .fi-dropdown-panel')) {
                return;
            }

            const maximum = container.scrollWidth - container.clientWidth;
            const unit = event.deltaMode === 1 ? 16 : event.deltaMode === 2 ? container.clientWidth : 1;
            const nextPosition = Math.max(0, Math.min(maximum, container.scrollLeft + event.deltaY * unit));

            // At either edge, leave the wheel available for normal page scrolling.
            if (maximum <= 0 || nextPosition === container.scrollLeft) {
                return;
            }

            container.scrollLeft = nextPosition;
            event.preventDefault();
        }, { passive: false });
    }
</script>
