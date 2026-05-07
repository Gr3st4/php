// ============ DATA ============
let products = [
    {
        id: 1,
        sku: "TND-001",
        nama: "Tenda Dome 2P Waterproof",
        kategori: "Tenda",
        harga: 850000,
        stok: 15,
        kondisi: "Baru",
        merk: "Consina",
        desc: "Tenda 2 orang, lapisan waterproof 3000mm",
    },
    {
        id: 2,
        sku: "TND-002",
        nama: "Tenda Ridge 4P Family",
        kategori: "Tenda",
        harga: 1450000,
        stok: 5,
        kondisi: "Baru",
        merk: "Rei",
        desc: "Tenda keluarga 4 orang kapasitas besar",
    },
    {
        id: 3,
        sku: "SLB-001",
        nama: "Sleeping Bag -5°C Mummy",
        kategori: "Sleeping",
        harga: 320000,
        stok: 28,
        kondisi: "Baru",
        merk: "Eiger",
        desc: "Sleeping bag untuk suhu dingin",
    },
    {
        id: 4,
        sku: "SLB-002",
        nama: "Sleeping Bag Envelope 0°C",
        kategori: "Sleeping",
        harga: 180000,
        stok: 0,
        kondisi: "Bekas",
        merk: "-",
        desc: "Bekas pakai, kondisi masih bagus",
    },
    {
        id: 5,
        sku: "PKN-001",
        nama: "Jaket Fleece Anti-Angin",
        kategori: "Pakaian",
        harga: 275000,
        stok: 40,
        kondisi: "Baru",
        merk: "Consina",
        desc: "Jaket fleece tebal untuk gunung",
    },
    {
        id: 6,
        sku: "PKN-002",
        nama: "Celana Cargo Hiking",
        kategori: "Pakaian",
        harga: 195000,
        stok: 3,
        kondisi: "Baru",
        merk: "Rhino",
        desc: "Celana cepat kering untuk hiking",
    },
    {
        id: 7,
        sku: "NAV-001",
        nama: "Kompas Baseplate Brunton",
        kategori: "Navigasi",
        harga: 420000,
        stok: 12,
        kondisi: "Baru",
        merk: "Brunton",
        desc: "Kompas presisi untuk navigasi lapangan",
    },
    {
        id: 8,
        sku: "TAS-001",
        nama: "Carrier 60L Deuter",
        kategori: "Tas",
        harga: 1200000,
        stok: 8,
        kondisi: "Baru",
        merk: "Deuter",
        desc: "Carrier besar untuk pendakian 3 hari+",
    },
    {
        id: 9,
        sku: "TAS-002",
        nama: "Daypack 25L Trail",
        kategori: "Tas",
        harga: 350000,
        stok: 2,
        kondisi: "Baru",
        merk: "Eiger",
        desc: "Tas gunung ringan untuk day hike",
    },
    {
        id: 10,
        sku: "MSK-001",
        nama: "Nesting Cook Set Titanium",
        kategori: "Masak",
        harga: 285000,
        stok: 20,
        kondisi: "Baru",
        merk: "Trangia",
        desc: "Set masak titanium ultra-ringan",
    },
];

let nextId = 11;
let editingId = null;
let deleteTargetId = null;

const icons = {
    Tenda: "⛺",
    Sleeping: "🛌",
    Pakaian: "🧥",
    Navigasi: "🧭",
    Tas: "🎒",
    Masak: "🍳",
};
const badgeClass = {
    Tenda: "badge-tenda",
    Sleeping: "badge-sleeping",
    Pakaian: "badge-pakaian",
    Navigasi: "badge-navigasi",
    Tas: "badge-tas",
    Masak: "badge-masak",
};

// ============ RENDER ============
function formatRp(n) {
    return "Rp " + n.toLocaleString("id-ID");
}

function getStockStatus(s) {
    if (s === 0) return { cls: "stock-empty", label: "Habis" };
    if (s <= 5) return { cls: "stock-low", label: s + " (Rendah)" };
    return { cls: "stock-ok", label: s };
}

function renderTable() {
    const search = document.getElementById("searchInput").value.toLowerCase();
    const kat = document.getElementById("filterKategori").value;
    const stokF = document.getElementById("filterStok").value;

    let filtered = products.filter((p) => {
        const matchSearch =
            p.nama.toLowerCase().includes(search) ||
            p.sku.toLowerCase().includes(search) ||
            p.kategori.toLowerCase().includes(search);
        const matchKat = !kat || p.kategori === kat;
        const matchStok =
            !stokF ||
            (stokF === "ok" && p.stok > 5) ||
            (stokF === "low" && p.stok > 0 && p.stok <= 5) ||
            (stokF === "empty" && p.stok === 0);
        return matchSearch && matchKat && matchStok;
    });

    const tbody = document.getElementById("productTable");
    const empty = document.getElementById("emptyState");

    if (filtered.length === 0) {
        tbody.innerHTML = "";
        empty.style.display = "block";
    } else {
        empty.style.display = "none";
        tbody.innerHTML = filtered
            .map((p, i) => {
                const ss = getStockStatus(p.stok);
                return `<tr>
        <td style="color:var(--muted);font-family:var(--font-mono);font-size:0.8rem">${i + 1}</td>
        <td>
          <div class="product-info">
            <div class="product-icon">${icons[p.kategori] || "📦"}</div>
            <div>
              <div class="product-name">${p.nama}</div>
              <div class="product-sku">${p.sku} · ${p.merk || "-"}</div>
            </div>
          </div>
        </td>
        <td><span class="badge ${badgeClass[p.kategori] || ""}">${p.kategori}</span></td>
        <td class="price">${formatRp(p.harga)}</td>
        <td class="${ss.cls}">${ss.label}</td>
        <td><span class="badge" style="${p.kondisi === "Baru" ? "background:rgba(39,174,96,0.15);color:#52be80;border:1px solid rgba(39,174,96,0.3)" : "background:rgba(243,156,18,0.15);color:#f0a500;border:1px solid rgba(243,156,18,0.3)"}">${p.kondisi}</span></td>
        <td>
          <div style="display:flex;gap:6px">
            <button class="btn btn-warning btn-sm" onclick="openModal('edit',${p.id})">✏️ Edit</button>
            <button class="btn btn-danger btn-sm" onclick="openDelete(${p.id})">🗑️</button>
          </div>
        </td>
      </tr>`;
            })
            .join("");
    }

    updateStats();
    document.getElementById("pageInfo").textContent =
        `Menampilkan ${filtered.length} dari ${products.length} produk`;
    renderCards(filtered);
}

function updateStats() {
    document.getElementById("stat-total").textContent = products.length;
    const totalStok = products.reduce((a, p) => a + p.stok, 0);
    document.getElementById("stat-stok").textContent = totalStok;
    document.getElementById("stat-habis").textContent = products.filter(
        (p) => p.stok === 0,
    ).length;
    const nilai = products.reduce((a, p) => a + p.harga * p.stok, 0);
    document.getElementById("stat-nilai").textContent =
        nilai >= 1000000
            ? "Rp " + (nilai / 1000000).toFixed(1) + "jt"
            : formatRp(nilai);
}

function filterProducts() {
    renderTable();
}

function renderCards(filtered) {
    const container = document.getElementById("productCards");
    if (!container) return;
    if (!filtered || filtered.length === 0) {
        container.innerHTML = "";
        return;
    }
    container.innerHTML = filtered
        .map((p) => {
            const ss = getStockStatus(p.stok);
            const kondisiStyle =
                p.kondisi === "Baru"
                    ? "background:rgba(39,174,96,0.15);color:#52be80;border:1px solid rgba(39,174,96,0.3)"
                    : "background:rgba(243,156,18,0.15);color:#f0a500;border:1px solid rgba(243,156,18,0.3)";
            return `<div class="product-card">
      <div class="product-card-top">
        <div class="product-icon" style="width:44px;height:44px;font-size:1.4rem">${icons[p.kategori] || "📦"}</div>
        <div class="product-card-info">
          <div class="product-name" style="font-size:0.95rem">${p.nama}</div>
          <div class="product-sku">${p.sku} · ${p.merk || "-"}</div>
        </div>
        <div class="product-card-price">${formatRp(p.harga)}</div>
      </div>
      <div class="product-card-meta">
        <span class="badge ${badgeClass[p.kategori] || ""}">${p.kategori}</span>
        <span class="badge" style="${kondisiStyle}">${p.kondisi}</span>
        <span class="${ss.cls}" style="font-size:0.82rem">Stok: ${ss.label}</span>
      </div>
      <div class="product-card-actions">
        <button class="btn btn-warning btn-sm" onclick="openModal('edit',${p.id})">✏️ Edit</button>
        <button class="btn btn-danger btn-sm" onclick="openDelete(${p.id})">🗑️ Hapus</button>
      </div>
    </div>`;
        })
        .join("");
}

// ============ MODAL ============
function openModal(mode, id = null) {
    clearErrors();
    editingId = null;
    if (mode === "create") {
        document.getElementById("modalTitle").textContent = "TAMBAH PRODUK";
        document.getElementById("btnSave").textContent = "💾 Simpan Produk";
        ["f_nama", "f_harga", "f_stok", "f_merk", "f_deskripsi"].forEach(
            (id) => (document.getElementById(id).value = ""),
        );
        document.getElementById("f_kategori").value = "";
        document.getElementById("f_kondisi").value = "Baru";
    } else {
        const p = products.find((x) => x.id === id);
        if (!p) return;
        editingId = id;
        document.getElementById("modalTitle").textContent = "EDIT PRODUK";
        document.getElementById("btnSave").textContent = "💾 Update Produk";
        document.getElementById("f_nama").value = p.nama;
        document.getElementById("f_kategori").value = p.kategori;
        document.getElementById("f_harga").value = p.harga;
        document.getElementById("f_stok").value = p.stok;
        document.getElementById("f_kondisi").value = p.kondisi;
        document.getElementById("f_merk").value = p.merk || "";
        document.getElementById("f_deskripsi").value = p.desc || "";
    }
    document.getElementById("modalOverlay").classList.add("open");
}

function closeModal() {
    document.getElementById("modalOverlay").classList.remove("open");
}

function clearErrors() {
    document
        .querySelectorAll(".form-group")
        .forEach((g) => g.classList.remove("has-error"));
}

function setError(fieldId, errId) {
    document
        .getElementById(fieldId)
        .closest(".form-group")
        .classList.add("has-error");
}

function saveProduct() {
    clearErrors();
    const nama = document.getElementById("f_nama").value.trim();
    const kat = document.getElementById("f_kategori").value;
    const harga = parseFloat(document.getElementById("f_harga").value);
    const stok = parseInt(document.getElementById("f_stok").value);
    const kondisi = document.getElementById("f_kondisi").value;
    const merk = document.getElementById("f_merk").value.trim();
    const desc = document.getElementById("f_deskripsi").value.trim();

    let valid = true;
    if (!nama || nama.length > 100) {
        setError("f_nama");
        valid = false;
    }
    if (!kat) {
        setError("f_kategori");
        valid = false;
    }
    if (!harga || harga < 1000) {
        setError("f_harga");
        valid = false;
    }
    if (isNaN(stok) || stok < 0) {
        setError("f_stok");
        valid = false;
    }

    if (!valid) {
        showToast("Periksa kembali isian form!", "error");
        return;
    }

    if (editingId) {
        const idx = products.findIndex((p) => p.id === editingId);
        products[idx] = {
            ...products[idx],
            nama,
            kategori: kat,
            harga,
            stok,
            kondisi,
            merk,
            desc,
        };
        showToast("✅ Produk berhasil diperbarui!");
    } else {
        const sku =
            kat.substring(0, 3).toUpperCase() +
            "-" +
            String(nextId).padStart(3, "0");
        products.push({
            id: nextId++,
            sku,
            nama,
            kategori: kat,
            harga,
            stok,
            kondisi,
            merk,
            desc,
        });
        showToast("✅ Produk berhasil ditambahkan!");
    }

    closeModal();
    renderTable();
}

// ============ DELETE ============
function openDelete(id) {
    const p = products.find((x) => x.id === id);
    deleteTargetId = id;
    document.getElementById("deleteProductName").textContent = p.nama;
    document.getElementById("deleteOverlay").classList.add("open");
}

function closeDeleteModal() {
    document.getElementById("deleteOverlay").classList.remove("open");
}

function confirmDelete() {
    products = products.filter((p) => p.id !== deleteTargetId);
    closeDeleteModal();
    renderTable();
    showToast("🗑️ Produk berhasil dihapus!", "warning");
}

// ============ TOAST ============
function showToast(msg, type = "success") {
    const c = document.getElementById("toastContainer");
    const t = document.createElement("div");
    t.className =
        "toast " +
        (type === "error" ? "error" : type === "warning" ? "warning" : "");
    t.textContent = msg;
    c.appendChild(t);
    setTimeout(() => t.remove(), 3000);
}

// ============ NAVIGATION ============
function showSection(name, e, fromBottomNav) {
    document
        .querySelectorAll('[id^="section-"]')
        .forEach((s) => (s.style.display = "none"));
    document.getElementById("section-" + name).style.display = "block";
    document
        .querySelectorAll(".nav-item")
        .forEach((n) => n.classList.remove("active"));
    document
        .querySelectorAll(".bottom-nav-item")
        .forEach((n) => n.classList.remove("active"));
    // highlight sidebar item
    if (
        e &&
        e.currentTarget &&
        e.currentTarget.classList.contains("nav-item")
    ) {
        e.currentTarget.classList.add("active");
    }
    // highlight bottom nav
    const bn = document.getElementById("bn-" + name);
    if (bn) bn.classList.add("active");
    // close sidebar on mobile after nav
    if (window.innerWidth <= 768) {
        const sidebar = document.getElementById("sidebarEl");
        const overlay = document.getElementById("sidebarOverlay");
        const btn = document.getElementById("hamburgerBtn");
        if (sidebar) sidebar.classList.remove("open");
        if (overlay) overlay.classList.remove("open");
        if (btn) btn.classList.remove("open");
    }
}

function toggleSidebar() {
    const sidebar = document.getElementById("sidebarEl");
    const overlay = document.getElementById("sidebarOverlay");
    const btn = document.getElementById("hamburgerBtn");
    sidebar.classList.toggle("open");
    overlay.classList.toggle("open");
    btn.classList.toggle("open");
}

// ============ TABS ============
function switchTab(tabId, containerId) {
    const container = document.getElementById(containerId);
    container
        .querySelectorAll(".tab-content")
        .forEach((t) => t.classList.remove("active"));
    document.getElementById(tabId).classList.add("active");
    // update tab buttons
    event.target
        .closest(".laravel-section")
        .querySelectorAll(".tab")
        .forEach((t) => t.classList.remove("active"));
    event.target.classList.add("active");
}

// Close overlay on background click
document.getElementById("modalOverlay").addEventListener("click", (e) => {
    if (e.target === e.currentTarget) closeModal();
});
document.getElementById("deleteOverlay").addEventListener("click", (e) => {
    if (e.target === e.currentTarget) closeDeleteModal();
});

// Init
renderTable();
