@extends('back.layouts.master')



@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 100%; max-width: 600px;">
            <div class="card-header">
                <h3 class="text-center">Instagram</h3>
            </div>
            <div class="card-body">
                <!-- عرض البيانات فقط -->
                <form action="{{ route('instagram.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Post 1</label>
                        <input type="text" class="form-control" id="title" name="title" value="titel" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Post 2</label>
                        <input type="text" class="form-control" id="title" name="title" value="titel" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Post 3</label>
                        <input type="text" class="form-control" id="title" name="title" value="titel" readonly>
                    </div>

                  
                    <button type="button" class="btn btn-primary" id="editBtn">Update</button>

                    <button type="submit" class="btn btn-success" id="saveBtn" style="display:none;">حفظ التعديلات</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // عند الضغط على زر تعديل البيانات
        document.getElementById('editBtn').addEventListener('click', function() {
            // جعل الحقول قابلة للتعديل
            document.getElementById('title').readOnly = false;
            document.getElementById('message').readOnly = false;
            document.getElementById('image').disabled = false;
            document.getElementById('updated_at').readOnly = false;

            // إخفاء زر تعديل البيانات وظهور زر حفظ التعديلات
            document.getElementById('editBtn').style.display = 'none';
            document.getElementById('saveBtn').style.display = 'block';
        });
    </script>
@endsection
