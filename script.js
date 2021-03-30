const url = "http://localhost/native-restserver/Endpoint.php";
document.addEventListener("DOMContentLoaded", async function (e) {
  const karyawan = await getKaryawan();
  updateUI(karyawan);
});
document.addEventListener("click", async function (e) {
  if (e.target.classList.contains("search-button")) {
    try {
      const inputKeyword = document.querySelector(".input-keyword");
      const karyawan = await getKaryawanByCond(inputKeyword);
      updateUI(karyawan);
      inputKeyword.value = "";
    } catch (Error) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: `${Error}`,
      });
    }
  }
});

function getKaryawan() {
  return fetch(`${url}`)
    .then((response) => response.json())
    .then((data) => data.EMP);
}

function getKaryawanByCond(keyword) {
  return fetch(`${url}?kondisi=${keyword.value}`)
    .then((response) => response.json())
    .then((data) => data.Data);
}

function showKaryawan({ NAMA, NO_BADGE, UNIT_KERJA }) {
  return `
  <div class="col-md-3 my-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">${NAMA}</h5>
        <h6 class="card-subtittle">${NO_BADGE}</h6>
        <h6 class="card-subtittle mb-2 text-muted">${UNIT_KERJA}</h6>
        </div>
    </div>
  </div>
  `;
}

function updateUI(karyawan) {
  const karyawanContainer = document.querySelector(".karyawan-container");
  karyawanContainer.innerHTML = karyawan.map((m) => showKaryawan(m)).join("");
}
