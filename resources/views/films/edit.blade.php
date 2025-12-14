<h2>Edit Film</h2>

<form method="POST" action="/films/{{ $film['id'] }}">
    @csrf
    @method('PUT')

    <input name="nama" value="{{ $film['nama'] }}"><br>
    <input name="deskripsi" value="{{ $film['deskripsi'] }}"><br>
    <input type="date" name="tanggal_rilis" value="{{ $film['tanggal_rilis'] }}"><br>
    <input name="rating" value="{{ $film['rating'] }}"><br>

    <button>Update</button>
</form>
