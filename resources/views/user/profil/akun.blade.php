@extends('user.profil')

@section('profil')
    <form action="{{ route('profil.update', $users->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-process">
            <div class="css3-spinner">
                <div class="css3-spinner-scaler"></div>
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-12 form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control required" value="{{ $users->name }}">
        </div>
        <div class="col-12 form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control required" value="{{ $users->email }}">
        </div>
        <div class="col-12 form-group">
            <label>No telepon</label>
            <input type="number" min="0" name="no_telepon" class="form-control numbers required"
                value="{{ $users->no_telepon }}">
        </div>
        <div class="col-12 form-group">
            <label>Jenis Kelamin</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input required" id="Laki-laki" type="radio" name="jenis_kelamin"
                    value="Laki-laki" {{ $users->jenis_kelamin == 'Laki-laki' ? 'checked' : null }}>
                <label class="form-check-label nott ms-2" for="Laki-laki">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="Perempuan" type="radio" name="jenis_kelamin" value="Perempuan"
                    {{ $users->jenis_kelamin == 'Perempuan' ? 'checked' : null }}>
                <label class="form-check-label nott ms-2" for="Perempuan">Perempuan</label>
            </div>
        </div>
        <div class="col-12 form-group">
            <label>tanggal lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control required" value="{{ $users->tanggal_lahir }}">
        </div>
        <div class="col-12 form-group">
            <label>Foto Profil</label>
            <input type="file" name="profile" class="form-control required" value="{{ $users->profile }}">
        </div>
        <div class="col-12">
            <button type="submit" class="button button-black">simpan</button>
        </div>
    </form>
@endsection
