// Ambil elemen2 yang dibutuhkan
var keyword = document.getElementById("keyword");
var search = document.getElementById("search");
var container = document.getElementById("container");

// Tambahkan event ketika keyword ditulis
keyword.addEventListener("keyup", function () {
  console.log("test");

    // Buat objek AJAX
  var xhr = new XMLHttpRequest();

  // Cek kesiapan AJAX
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      container.innerHTML = xhr.responseText;
    }
  };

  // Eksekusi AJAX
  xhr.open("GET", "ajax/art.php?keyword=" + keyword.value, true);
  xhr.send();
});