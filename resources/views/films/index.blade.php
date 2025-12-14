<h2>Tambah Film</h2>

<form method="POST" action="/films">
    @csrf
    <input name="nama" placeholder="Nama"><br>
    <input name="deskripsi" placeholder="Deskripsi"><br>
    <input type="date" name="tanggal_rilis"><br>
    <input name="rating" placeholder="Rating"><br>
    <button type="submit">Tambah</button>
</form>

<hr>

<h2>Daftar Film</h2>
<table border="1">
<tr>
    <th>Nama</th>
    <th>Rating</th>
    <th>Aksi</th>
</tr>

@foreach($films as $film)
<tr>
    <td>{{ $film['nama'] }}</td>
    <td>{{ $film['rating'] }}</td>
    <td>
        <a href="/films/{{ $film['id'] }}/edit">Edit</a>

        <form action="/films/{{ $film['id'] }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button>Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
