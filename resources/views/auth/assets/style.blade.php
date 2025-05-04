<style>
    :root {
        --primary: #0D723B;
        --secondary: #F7B731;
        --accent: #D32F2F;
        --light: #F0F4F8;
        --dark: #1A202C;
    }

    .bg-gradient {
        background: linear-gradient(135deg, #0D723B 0%, #11954e 100%);
    }

    .animated-bg {
        background: linear-gradient(-45deg, #0D723B, #138347, #F7B731, #0D723B);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.4;
        z-index: 0;
    }

    .input-valid {
        border-color: #0D723B !important;
        /* warna hijau */
        box-shadow: 0 0 0 2px rgba(13, 114, 59, 0.2);
        /* efek ring tipis */
    }
</style>
