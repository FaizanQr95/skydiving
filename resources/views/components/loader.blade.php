<!-- resources/views/components/loader.blade.php -->

<style>
    #global-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #0f0; /* neon green background */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        animation: fadeIn 0.3s ease-in-out;
    }

    #global-loader img {
        width: 150px;
        height: auto;
        animation: pulse 1.5s infinite ease-in-out;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

<div id="global-loader">
    <img src="{{ asset('loader/skydiving.png') }}" alt="Loading...">
</div>

<script>
    window.addEventListener("load", function () {
        document.getElementById("global-loader").style.display = "none";
        document.getElementById("page-content").style.display = "block";
    });
</script>
