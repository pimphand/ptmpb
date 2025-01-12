@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Starter</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Starter</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4 text-center">
            <img src="{{'admin/assets'}}/images/starter.png" class="mb-4" alt="starter">
            <h3 class="fs-4 mb-4 m-auto" style="max-width: 500px;">Create something beautiful, like a masterpiece or a really good sandwich.</h3>
            <a href="index.html" class="btn btn-primary text-decoration-none py-2 px-3 fs-16 fw-medium">
                <span class="d-inline-block py-1">Getting Started</span>
            </a>
        </div>
    </div>
@endsection
