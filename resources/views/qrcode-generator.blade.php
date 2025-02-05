<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #32CD32 0%, #228B22 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(50, 205, 50, 0.4);
        }

        .qr-result {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .qr-image {
            padding: 1rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .qr-image:hover {
            transform: scale(1.02);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .alert-success {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            color: #1a5928;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ffb199 0%, #ff0844 100%);
            color: white;
        }

        .floating-label {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .floating-label label {
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .icon-container {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0 text-center text-white">
                            <i class="bi bi-qr-code me-2"></i>Generator QR Code Modern
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <div class="icon-container">
                                    <i class="bi bi-check-circle-fill"></i>
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('qrcode.generate') }}" method="POST">
                            @csrf
                            <div class="floating-label mb-4">
                                <label for="content" class="form-label">
                                    <i class="bi bi-keyboard me-2"></i>Masukkan Teks atau URL
                                </label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3"
                                    placeholder="Contoh: https://www.website-anda.com atau teks yang ingin di-generate" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="floating-label mb-4">
                                <label for="size" class="form-label">
                                    <i class="bi bi-arrows-angle-expand me-2"></i>Ukuran QR Code
                                </label>
                                <select class="form-select @error('size') is-invalid @enderror" id="size"
                                    name="size">
                                    <option value="100" {{ old('size') == 100 ? 'selected' : '' }}>100 x 100 px
                                        (Kecil)</option>
                                    <option value="200" {{ old('size') == 200 || !old('size') ? 'selected' : '' }}>
                                        200 x 200 px (Sedang)</option>
                                    <option value="300" {{ old('size') == 300 ? 'selected' : '' }}>300 x 300 px
                                        (Besar)</option>
                                    <option value="400" {{ old('size') == 400 ? 'selected' : '' }}>400 x 400 px
                                        (Sangat Besar)</option>
                                </select>
                                @error('size')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-qr-code me-2"></i>Generate QR Code
                                </button>
                            </div>
                        </form>

                        @if (session('qrcode'))
                            <div class="qr-result text-center">
                                <h5 class="mb-4">
                                    <i class="bi bi-check2-circle me-2"></i>QR Code Berhasil Dibuat
                                </h5>
                                <div class="qr-image mb-4">
                                    <img src="{{ session('qrcode') }}" alt="QR Code" class="img-fluid">
                                </div>
                                <a href="{{ route('qrcode.download', session('filename')) }}"
                                    class="btn btn-success btn-lg">
                                    <i class="bi bi-download me-2"></i>Download QR Code
                                </a>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mt-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="bi bi-exclamation-triangle me-2"></i>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
