<style>
    /* Keep intrinsic table widths inside their own scroll area, including modals. */
    .fi-modal-content,
    .fi-main, .fi-page, .fi-sc, .fi-sc-component, .fi-section,
    .fi-section-content, .fi-ta, .fi-ta-ctn, .fi-ta-main, .fi-ta-content-ctn {
        min-width: 0;
        max-width: 100%;
    }
    .fi-modal-window-ctn { grid-template-columns: minmax(0, 1fr); }
    .fi-modal-window { min-width: 0; }
    .fi-ta-content-ctn, .fi-ta-table-scroll-ctn, .admin-table-scroll {
        max-width: 100%;
        overflow-x: auto;
        overscroll-behavior-x: contain;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }
    .fi-ta-content-ctn > table, .fi-ta-table-scroll-ctn > table, .admin-table-scroll > table {
        width: max-content;
        min-width: 100%;
        table-layout: auto;
    }
    .fi-ta-table th, .admin-table-scroll th { white-space: nowrap; }
    .fi-ta-table td { min-width: 7rem; }
    .fi-ta-table .fi-ta-text { max-width: 32rem; }
    @media (prefers-reduced-motion: reduce) {
        .fi-ta-content-ctn, .fi-ta-table-scroll-ctn, .admin-table-scroll { scroll-behavior: auto; }
    }
</style>
