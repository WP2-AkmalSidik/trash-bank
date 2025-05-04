<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background-color: #F0F4F8;
        color: #1A202C;
    }

    .nav-icon {
        width: 24px;
        height: 24px;
    }

    .page {
        display: none;
    }

    .page.active {
        display: block;
    }

    .wave-header {
        position: relative;
        background-color: #0D723B;
        height: 130px;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
    }

    .card-balance {
        background: linear-gradient(135deg, #0D723B, #13A15E);
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(13, 114, 59, 0.2);
    }

    .card-price {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .card-news {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .mini-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .text-primary {
        color: #0D723B;
    }

    .text-secondary {
        color: #F7B731;
    }

    .text-danger {
        color: #D32F2F;
    }

    .bg-primary {
        background-color: #0D723B;
    }

    .bg-secondary {
        background-color: #F7B731;
    }

    .bg-danger {
        background-color: #D32F2F;
    }

    .bg-light {
        background-color: #F0F4F8;
    }

    .bg-dark {
        background-color: #1A202C;
    }

    .progress-bar {
        height: 10px;
        border-radius: 5px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background-color: #0D723B;
        border-radius: 5px;
    }
</style>
