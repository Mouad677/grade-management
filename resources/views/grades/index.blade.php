<style>
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .pagination .page-item {
        list-style: none;
    }

    .pagination .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.25rem 0.75rem;
        border-radius: 0.375rem;
        background: white;
        border: 1px solid #e2e8f0;
        color: #4a5568;
        font-size: 0.75rem;
        transition: all 0.2s;
    }

    .pagination .page-link:hover {
        background: #f7fafc;
        border-color: #cbd5e0;
    }

    .pagination .page-item.active .page-link {
        background: #4f46e5;
        border-color: #4f46e5;
        color: white;
    }

    .pagination .page-item.disabled .page-link {
        background: #f7fafc;
        color: #a0aec0;
        cursor: not-allowed;
    }

    /* Cacher les numéros de page */
    .pagination .page-item:not(:first-child):not(:last-child) {
        display: none;
    }

    /* Style pour les boutons Next/Previous */
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
    }
</style> 