<div class="ad-container" id="ad-container">
    <span class="close-btn" id="close-btn">X</span>
    <a href="{{ route('promotion.index') }}" target="_blank">
        <img src="{{ asset('storage/' . $ad->image) }}" alt="Ads">
    </a>
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
        width: 80%; /* عرض متغير بنسبة 80% من العرض الكلي */
        max-width: 600px; /* الحد الأقصى للعرض على شاشات كبيرة */
    }

    .ad-container img {
        width: 100%;
        height: auto;
        cursor: pointer;
        margin-top: 5%;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 13px;
        font-size: 25px;
        cursor: pointer;
        color: #000;
    }

    .close-btn:hover {
        color: #ff0000;
    }

    /* استجابة للهواتف والأجهزة اللوحية */
    @media screen and (max-width: 768px) {
        .ad-container {
            width: 90%; /* تقليص العرض ليكون أكبر قليلاً على الأجهزة الصغيرة */
            max-width: 400px; /* تحديد الحد الأقصى للأبعاد على الأجهزة الصغيرة */
        }
    }

    @media screen and (max-width: 480px) {
        .ad-container {
            width: 95%; /* زيادة عرض الإعلان على الهواتف الصغيرة */
            max-width: 320px; /* الحد الأقصى للعرض */
        }
    }
</style>

<script>
    // إغلاق الإعلان عند الضغط على X
    document.getElementById("close-btn").addEventListener("click", function() {
        document.getElementById("ad-container").style.display = "none";
    });
</script>
