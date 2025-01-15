<style>
    .modal {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}
</style>

<div id="myModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>قسطها على 4 دفعات بدون فوائد</h2>
        <!-- محتوى البوب أب -->
        <button id="sendButton">إرسل</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // عرض البوب أب عند الضغط على الزر
        $('#showModalButton').on('click', function() {
            $('#myModal').show();
        });

        // إغلاق البوب أب عند الضغط على زر الإغلاق
        $('.close').on('click', function() {
            $('#myModal').hide();
        });

        // إغلاق البوب أب عند النقر خارج المحتوى
        $(window).on('click', function(event) {
            if ($(event.target).is('#myModal')) {
                $('#myModal').hide();
            }
        });

        // العمليات المطلوبة عند الضغط على زر "إرسل"
        $('#sendButton').on('click', function() {
            // أضف الإجراءات التي تريد تنفيذها
            alert('تم الإرسال');
            $('#myModal').hide();
        });
    });
</script>