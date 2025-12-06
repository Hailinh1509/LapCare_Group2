<x-guest-layout>

    <h4 class="mb-3 text-center">Quên mật khẩu</h4>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" required class="form-control @error('email') is-invalid @enderror">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary w-100">Gửi link đặt lại mật khẩu</button>
    </form>

</x-guest-layout>
