try {
    var halaman = location.pathname;
    halaman = halaman.split('/');
    if (halaman[halaman.length-1]=='') $('#beranda').addClass('active');
    else $('#'+halaman[halaman.length-1]).addClass('active');    
} catch (error) {}

function hapus_pengguna(username) {
    c = confirm('Anda yakin ingin menghapus?');
    if (c) location.href='./hapus-pengguna?username='+username;
}

function hapus_kriteria(id) {
    c = confirm('Anda yakin ingin menghapus?');
    if (c) location.href='./hapus-kriteria?id='+id;
}
function hapus_alternatif(id) {
    c = confirm('Anda yakin ingin menghapus?');
    if (c) location.href='./hapus-alternatif?id='+id;
}
function hapus_nilai_alternatif(id,periode) {
    c = confirm('Anda yakin ingin menghapus nilai?');
    if (c) location.href='./hapus-nilai-alternatif?id='+id+'&periode='+periode;
}

function hapus_hasil(periode){
	c = confirm('Anda yakin ingin menghapus hasil?');
	if (c) location.href='./reset-hasil?periode='+periode;
}

function tambah_nilai(periode){
	c = confirm('tambah nilai alternatif?');
	if (c) location.href='./tambah-nilai-alternatif?periode='+periode;
}
function tambah_kriteria(periode){
	c = confirm('tambah kriteria?');
	if (c) location.href='./tambah-kriteria?periode='+periode;
}


function cek_isian_matrix_perbandingan() {
    
}

$('#form-perbandingan-matrix').submit(function(e){
    names = [];c = 0;
    $('input').each(function() {
        if (!names.includes(this.name)) {
            if (this.name!='') names.push(this.name);
        }
        if (this.checked) c++;
    });
    if (names.length!=c) {
        $('#pesan-error').html('<div class="alert alert-dismissable alert-danger"><b>Terdapat perbandingan yang belum terisi</b>, silahkan cek kembali.</div>');
        return false;
    } else return true;
});