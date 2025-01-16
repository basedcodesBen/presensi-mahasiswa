@extends('layouts.master')

@section('title', 'Attendance Details')

@section('content')
<div class="col-lg-12">
    <div class="col-lg-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5>Attendance Details</h5>
                <p class="mb-0">Show this QR code to your students for attendance.</p>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <p><strong>Lecturer Name:</strong> {{ auth()->user()->nama }}</p>
                    <p><strong>Lecturer ID (NIK):</strong> {{ auth()->user()->nik }}</p>
                    <p><strong>Course:</strong> {{ $dhmd->mataKuliah->nama_matakuliah }} ({{ $dhmd->id_matakuliah }})</p>
                    <p><strong>Date and Time:</strong> {{ \Carbon\Carbon::parse($dhmd->tanggal)->format('d-m-Y H:i') }}</p>
                    <p><strong>Meeting Number:</strong> {{ $dhmd->pertemuan }}</p>
                </div>
            </div>
            <h1>Take a Photo for Attendance</h1>
        
            <video id="video" width="640" height="480" autoplay></video>
            <canvas id="canvas" width="640" height="480" style="display: none;"></canvas>
            <button id="capture">Capture Photo</button>
            <form id="photoForm" action={{route('user.save')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idPresensi" id="idPresensi" value="{{$dhmd->idpresensi}}">
                <input type="file" name="photo" id="photoInput" style="display:none;">
                <button type="submit" style="display:none;" id="submitPhoto">Submit Photo</button>
            </form>
        </div>
    </div>


    <script>
        
        const video = document.getElementById('video');
        const captureButton = document.getElementById('capture');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');
        const photoForm = document.getElementById('photoForm');
        const photoInput = document.getElementById('photoInput');
        const submitPhotoButton = document.getElementById('submitPhoto');

        // Access the user's webcam
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                video.srcObject = stream;
            })
            .catch(function (err) {
                console.log("Error accessing webcam: " + err);
            });

        // Capture the image
        captureButton.addEventListener('click', function () {
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageBlob = dataURLtoBlob(canvas.toDataURL('image/png')); // Convert base64 to Blob

            // Set the file input with the image blob
            const file = new File([imageBlob], "attendance_photo.png", { type: 'image/png' });
            const formData = new FormData(photoForm);
            formData.set('photo', file); // Append the photo file
            formData.set('idPresensi', document.getElementById('idPresensi').value);

            // Submit the form with the image data
            fetch('/save-attendance-photo', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.redirect_url) {
                    // Handle redirect using JavaScript
                    window.location.href = data.redirect_url;
                } else {
                    console.log(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });

        });

        // Helper function to convert dataURL to Blob
        function dataURLtoBlob(dataURL) {
            const [metadata, base64] = dataURL.split(',');
            const mime = metadata.match(/:(.*?);/)[1];
            const binary = atob(base64);
            const length = binary.length;
            const buffer = new ArrayBuffer(length);
            const view = new Uint8Array(buffer);
            for (let i = 0; i < length; i++) {
                view[i] = binary.charCodeAt(i);
            }
            return new Blob([view], { type: mime });
        }

    </script>
</div>
@endsection

