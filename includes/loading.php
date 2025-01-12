<style>

.rotate {

    height: 150px;
    width: 150px;
    animation: rotate 1s linear infinite;
}

@keyframes rotate {

    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

</style>

<div id="rotate" style="
    position: fixed;
    background-color: #F2EEF7;
    height: 100vh;
    width: 100vw;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9;">
    <img class="rotate" src="../../images/page-load.png">
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("rotate").style.display = "none";

    });
</script>