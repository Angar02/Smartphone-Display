$(document).ready(function() {
    // Hilangkan tombol cari
    $('#tombol-cari').hide();

    // Event ketika keyword ditulis
    $('#keyword').on('keyup', function() {
        // Munculkan icon Loading
        // $('.loading').show();

        // Ajax menggunakan load
        // $('#container').load('ajax/smartphones.php?keyword=' + $('#keyword').val())

        // Ajax menggunakan $.get()
        $.get('ajax/smartphones.php?keyword=' + $('#keyword').val(), function(data) {
            $('#container').html(data);
            // $('.loading').hide();
        });
    });

    $(document).on('click', '.pagination', function (e) {
        e.preventDefault();

        let halaman = $(this).data('halaman');

        $('#container').load('ajax/smartphones.php?keyword=' + $('#keyword').val() + '&halaman=' + halaman);
    });
});

// Source - https://stackoverflow.com/a
// Posted by aelor, modified by community. See post 'Timeline' for change history
// Retrieved 2025-12-21, License - CC BY-SA 3.0

// // Ambil elemen yang dibutuhkan
// let keyword     = document.getElementById('keyword');
// let tombolCari  = document.getElementById('tombol-cari');
// let container   = document.getElementById('container');

// // Tambahkan event ketika keyword ditulis
// keyword.addEventListener('keyup', function() {
//     // Buat object ajax
//     let ajax = new XMLHttpRequest();

//     // Cek kesiapan ajax
//     ajax.onreadystatechange = function() {
//         if( ajax.readyState == 4 && ajax.status == 200 ) {
//             container.innerHTML = ajax.responseText;
//         }
//     }

//     // Eksekusi ajax
//     ajax.open('GET', 'ajax/smartphones.php?keyword=' + keyword.value, true);
//     ajax.send();
// });

// document.addEventListener('click', function(e) {
//     if (e.target.classList.contains('pagination')) {
//         e.preventDefault();

//         let halaman = e.target.dataset.halaman;

//         let ajax = new XMLHttpRequest();
//         ajax.onreadystatechange = function () {
//             if (ajax.readyState == 4 && ajax.status == 200) {
//                 container.innerHTML = ajax.responseText;
//             }
//         };

//         ajax.open(
//             'GET',
//             'ajax/smartphones.php?keyword=' + keyword.value + '&halaman=' + halaman,
//             true
//         );
//         ajax.send();
//     }
// });
