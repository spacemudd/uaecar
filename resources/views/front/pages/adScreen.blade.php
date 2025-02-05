<div class="ad-container" id="ad-container">
    <span class="close-btn" id="close-btn">X</span>
    <a href="{{ route('promotion.index') }}" target="_blank">
    <img src="{{ asset('storage/' . $ad->image) }}" alt="Ads">    </a>
</div>

<style>
    /* نمط الإعلان */
    .ad-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        z-index: 9999;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .ad-container img {
        max-width: 100%;
        height: auto;
        cursor: pointer;
    }
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
        color: #000;
    }
    .close-btn:hover {
        color: #ff0000;
    }
</style>

<script>
    // إغلاق الإعلان عند الضغط على X
    document.getElementById("close-btn").addEventListener("click", function() {
        document.getElementById("ad-container").style.display = "none";
    });
</script>
