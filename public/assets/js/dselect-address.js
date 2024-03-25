const provinsiEl = document.getElementById("provinsi");
const kabupatenEl = document.getElementById("kabupaten");
const kecamatanEl = document.getElementById("kecamatan");
const kelurahanEl = document.getElementById("kelurahan");
var dselectAddressRemoveOptionOnChange = true;

function initializeDselect() {
    dselect(provinsiEl, { search: true });
    dselect(kabupatenEl, { search: true });
    dselect(kecamatanEl, { search: true });
    dselect(kelurahanEl, { search: true });
}

function removeOption(selectEl) {
    selectEl.value = "";
    for (let i = selectEl.length - 1; i >= 0; i--) {
        if (selectEl.options[i].value === "") continue;
        selectEl.remove(i);
    }
}

fetch("https://mkthulu.github.io/api-wilayah-indonesia/api/provinces.json")
    .then((response) => response.json())
    .then((provinces) => {
        provinces.forEach((province) => {
            const optionEl = document.createElement("option");
            optionEl.text = province.name;
            optionEl.value = province.id + "," + province.name;
            provinsiEl.add(optionEl);
            initializeDselect();
        });
    })
    .catch((e) => {
        document.body.innerHTML = `<div style="height: 100vh; display: flex; flex-direction: column; justify-content:center; align-items:center;">
                <p style='font-weight: bold; color: red;'>Error!</p>
                <p style='margin:0'>Host API wilayah Indonesia sedang tidak aktif</p>
                <p style='margin:0'>Coba akses kembali di lain waktu</p>
            </div>`;
    });

provinsiEl.onchange = () => {
    if (dselectAddressRemoveOptionOnChange) {
        removeOption(kabupatenEl);
        removeOption(kecamatanEl);
        removeOption(kelurahanEl);
    }
    fetch(
        "https://mkthulu.github.io/api-wilayah-indonesia/api/regencies/" +
            provinsiEl.value.split(",")[0] +
            ".json"
    )
        .then((response) => response.json())
        .then((regencies) => {
            regencies.forEach((regency) => {
                const optionEl = document.createElement("option");
                optionEl.text = regency.name;
                optionEl.value = regency.id + "," + regency.name;
                kabupatenEl.add(optionEl);
                initializeDselect();
            });
        });
};

kabupatenEl.onchange = () => {
    if (dselectAddressRemoveOptionOnChange) {
        removeOption(kecamatanEl);
        removeOption(kelurahanEl);
    }
    fetch(
        "https://mkthulu.github.io/api-wilayah-indonesia/api/districts/" +
            kabupatenEl.value.split(",")[0] +
            ".json"
    )
        .then((response) => response.json())
        .then((districts) => {
            districts.forEach((district) => {
                const optionEl = document.createElement("option");
                optionEl.text = district.name;
                optionEl.value = district.id + "," + district.name;
                kecamatanEl.add(optionEl);
                initializeDselect();
            });
        });
};

kecamatanEl.onchange = () => {
    if (dselectAddressRemoveOptionOnChange) removeOption(kelurahanEl);
    fetch(
        "https://mkthulu.github.io/api-wilayah-indonesia/api/villages/" +
            kecamatanEl.value.split(",")[0] +
            ".json"
    )
        .then((response) => response.json())
        .then((villages) => {
            villages.forEach((village) => {
                const optionEl = document.createElement("option");
                optionEl.text = village.name;
                optionEl.value = village.id + "," + village.name;
                kelurahanEl.add(optionEl);
                initializeDselect();
            });
        });
};
