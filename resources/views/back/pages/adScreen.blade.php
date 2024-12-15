@extends('back.layouts.master')

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 100%; max-width: 600px;">
            <div class="card-header">
                <h3 class="text-center">Ad Details</h3>
            </div>
            <div class="card-body">
                <!-- عرض البيانات فقط -->
                <form action="{{ route('ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $ad->title }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" readonly>{{ $ad->message }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" disabled>
                        @if($ad->image)
                            <img src="{{ asset('storage/'.$ad->image) }}" alt="Ad Image" class="img-fluid mt-2" width="100">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="updated_at" class="form-label">Last Update</label>
                        <input type="date" class="form-control" id="updated_at" name="updated_at" value="{{ $ad->updated_at->format('Y-m-d') }}" readonly>
                    </div>


                    <!-- زر تعديل البيانات -->
                    <button type="button" class="btn btn-primary" id="editBtn">Update</button>

                    <!-- زر حفظ التعديلات بعد التعديل -->
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
