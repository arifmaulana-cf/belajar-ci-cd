#!/usr/bin/env python3
"""Generate Laporan Observasi Lapangan Penelitian (DigiFlora) as PDF.

Portable: fonts are bundled in ./fonts so this runs on Linux and Windows.
"""
import os
import sqlite3
from PIL import Image

from fpdf import FPDF

BASE = os.path.dirname(os.path.abspath(__file__))
PROJECT_ROOT = os.path.dirname(BASE)  # folder digiflora
DB_PATH = os.path.join(PROJECT_ROOT, "database", "database.sqlite")
IMG_DIR = os.path.join(PROJECT_ROOT, "storage", "app", "public")
FONT_DIR = os.path.join(BASE, "fonts")
OUT_PDF = os.path.join(PROJECT_ROOT, "Laporan_Observasi_DigiFlora.pdf")

META = {
    "judul": "LAPORAN OBSERVASI LAPANGAN PENELITIAN",
    "subjudul": "Koleksi Tumbuhan Digital - DigiFlora",
    "pengamat": "Ahsanal Yasir",
    "institusi": "Universitas Islam Negeri Ar-raniry",
    "lokasi": "Stasiun Penelitian Soraya, Kawasan Ekosistem Leuser",
    "tanggal": "29 Agustus 2026",
}

# Warna (tanpa hijau): hitam / abu-abu
BLACK = (0, 0, 0)
DARK = (45, 45, 45)
GREY = (110, 110, 110)
LINE = (180, 180, 180)
ZEBRA = (244, 244, 244)
HEADER_FILL = (220, 220, 220)


def load_plants():
    con = sqlite3.connect(DB_PATH)
    con.row_factory = sqlite3.Row
    cur = con.cursor()
    cur.execute(
        "SELECT kode_tumbuhan, nama_tumbuhan, nama_latin, famili, deskripsi, gambar "
        "FROM plants ORDER BY id"
    )
    rows = [dict(r) for r in cur.fetchall()]
    con.close()
    return rows


def fmt(v):
    return v.strip() if v and str(v).strip() else "Belum terdata"


class Report(FPDF):
    def header(self):
        if self.page_no() == 1:
            return
        self.set_font("DejaVu", "", 8)
        self.set_text_color(*GREY)
        self.cell(0, 6, "Laporan Observasi Lapangan - DigiFlora", align="L")
        self.cell(0, 6, META["lokasi"], align="R", new_x="LMARGIN", new_y="NEXT")
        self.set_draw_color(*LINE)
        self.set_line_width(0.3)
        self.line(self.l_margin, self.get_y() + 1, self.w - self.r_margin, self.get_y() + 1)
        self.ln(4)

    def footer(self):
        self.set_y(-12)
        self.set_font("DejaVu", "", 8)
        self.set_text_color(*GREY)
        self.cell(0, 6, f"Halaman {self.page_no()}", align="C")


def cover(pdf):
    pdf.add_page()
    pdf.ln(28)
    pdf.set_fill_color(*BLACK)
    pdf.rect(0, pdf.get_y(), pdf.w, 2, "F")
    pdf.ln(10)
    pdf.set_font("DejaVu", "B", 20)
    pdf.set_text_color(*BLACK)
    pdf.multi_cell(0, 10, META["judul"], align="C")
    pdf.ln(2)
    pdf.set_font("DejaVu", "", 13)
    pdf.set_text_color(*DARK)
    pdf.multi_cell(0, 7, META["subjudul"], align="C")
    pdf.ln(14)

    pdf.set_font("DejaVu", "", 11)
    info = [
        ("Pengamat / Peneliti", META["pengamat"]),
        ("Institusi", META["institusi"]),
        ("Lokasi Situs", META["lokasi"]),
        ("Tanggal Observasi", META["tanggal"]),
        ("Sumber Data", "Aplikasi Web DigiFlora (database plants)"),
        ("Jumlah Taxon Tercatat", str(len(plants))),
    ]
    for label, val in info:
        pdf.set_x(35)
        pdf.set_font("DejaVu", "B", 11)
        pdf.set_text_color(*BLACK)
        pdf.cell(55, 8, label)
        pdf.set_font("DejaVu", "", 11)
        pdf.set_text_color(*DARK)
        pdf.multi_cell(0, 8, str(val), new_x="LMARGIN", new_y="NEXT")
    pdf.ln(20)
    pdf.set_font("DejaVu", "I", 9)
    pdf.set_text_color(*GREY)
    pdf.multi_cell(
        0, 5,
        "Dokumen ini dihasilkan secara otomatis dari basis data DigiFlora "
        "(manajemen koleksi tumbuhan digital berbasis Laravel).",
        align="C",
    )


def section(pdf, title):
    pdf.ln(2)
    pdf.set_font("DejaVu", "B", 14)
    pdf.set_text_color(*BLACK)
    pdf.multi_cell(0, 8, title, new_x="LMARGIN", new_y="NEXT")
    pdf.set_draw_color(*BLACK)
    pdf.set_line_width(0.3)
    pdf.line(pdf.l_margin, pdf.get_y() + 0.5, pdf.l_margin + 40, pdf.get_y() + 0.5)
    pdf.ln(2)


def body(pdf, text):
    pdf.set_font("DejaVu", "", 10.5)
    pdf.set_text_color(*DARK)
    pdf.multi_cell(0, 5.5, text, new_x="LMARGIN", new_y="NEXT")
    pdf.ln(1)


def intro_method(pdf):
    section(pdf, "1. Pendahuluan")
    body(pdf,
         "DigiFlora adalah aplikasi web berbasis Laravel untuk manajemen koleksi "
         "tumbuhan digital (kebun raya / herbarium). Sistem ini memungkinkan "
         "pengelolaan data tanaman, pembuatan label QR Code, serta halaman publik "
         "untuk pengunjung dan peneliti di lapangan. Observasi lapangan ini bertujuan "
         "mendokumentasikan dan menginventarisasi koleksi tumbuhan yang telah "
         "tercatat dalam basis data DigiFlora di situs penelitian, sebagai bahan "
         "pendukung penelitian keanekaragaman hayati.")
    section(pdf, "2. Metode Observasi")
    body(pdf,
         "Kegiatan observasi dilakukan melalui tahapan: (1) Identifikasi dan "
         "pendataan tanaman di lapangan; (2) Dokumentasi visual (foto) setiap "
         "taxon menggunakan perangkat DigiFlora; (3) Pencatatan atribut taksonomi "
         "meliputi nama lokal, nama latin, famili, dan deskripsi ekologis; "
         "(4) Pelabelan menggunakan QR Code yang terhubung ke halaman detail "
         "tanaman; dan (5) Integrasi seluruh hasil ke dalam basis data aplikasi "
         "untuk keperluan analisis dan publikasi.")


def results_table(pdf):
    section(pdf, "3. Hasil dan Pembahasan")
    body(pdf,
         f"Tercatat sebanyak {len(plants)} taxon dalam basis data DigiFlora di "
         f"situs {META['lokasi']}. Berikut adalah dokumentasi tiap tanaman dalam "
         "bentuk tabel (foto, nama, dan detail taksonomi). Tanaman dengan atribut "
         "yang belum lengkap masih dalam proses identifikasi lebih lanjut.")
    pdf.ln(3)
    pdf.add_page()

    margin = pdf.l_margin
    usable = pdf.w - 2 * margin
    w_foto = 38
    w_nama = 42
    w_detail = usable - w_foto - w_nama
    col_x = [margin, margin + w_foto, margin + w_foto + w_nama]
    widths = [w_foto, w_nama, w_detail]
    bottom_limit = pdf.h - pdf.b_margin
    row_h = 42  # cukup untuk foto max 36 mm + teks

    # Header tabel
    def draw_header():
        pdf.set_font("DejaVu", "B", 9.5)
        pdf.set_fill_color(*HEADER_FILL)
        pdf.set_text_color(*BLACK)
        pdf.set_draw_color(*LINE)
        pdf.set_line_width(0.3)
        y = pdf.get_y()
        pdf.rect(margin, y, usable, 8, "DF")
        heads = ["Foto", "Nama Tumbuhan", "Detail Taksonomi"]
        for i, h in enumerate(heads):
            pdf.set_xy(col_x[i] + 2, y + 1.5)
            pdf.cell(widths[i] - 4, 5, h)
        pdf.set_y(y + 8)

    draw_header()

    for idx, p in enumerate(plants):
        if pdf.get_y() + row_h > bottom_limit:
            pdf.add_page()
            draw_header()

        y0 = pdf.get_y()
        # zebra background
        pdf.set_fill_color(*(ZEBRA if idx % 2 == 0 else (255, 255, 255)))
        pdf.rect(margin, y0, usable, row_h, "F")

        # --- Foto ---
        img_path = os.path.join(IMG_DIR, p["gambar"]) if p.get("gambar") else ""
        if img_path and os.path.exists(img_path):
            try:
                with Image.open(img_path) as im:
                    iw, ih = im.size
                max_h, max_w = 36, w_foto - 6
                scale = min(max_w / iw, max_h / ih)
                dw, dh = iw * scale, ih * scale
                ix = col_x[0] + (w_foto - dw) / 2
                iy = y0 + (row_h - dh) / 2
                pdf.image(img_path, x=ix, y=iy, w=dw, h=dh)
            except Exception:
                pass

        # --- Nama ---
        pdf.set_xy(col_x[1] + 2, y0 + 3)
        pdf.set_font("DejaVu", "B", 9)
        pdf.set_text_color(*BLACK)
        pdf.multi_cell(w_nama - 4, 4.5, fmt(p["kode_tumbuhan"]), new_x="LMARGIN", new_y="NEXT")
        pdf.set_x(col_x[1] + 2)
        pdf.set_font("DejaVu", "", 8.5)
        pdf.set_text_color(*DARK)
        pdf.multi_cell(w_nama - 4, 4, fmt(p["nama_tumbuhan"]), new_x="LMARGIN", new_y="NEXT")

        # --- Detail ---
        pdf.set_xy(col_x[2] + 2, y0 + 3)
        pdf.set_font("DejaVu", "", 8)
        pdf.set_text_color(*DARK)
        detail = (
            f"Nama latin : {fmt(p['nama_latin'])}\n"
            f"Famili     : {fmt(p['famili'])}\n"
            f"Deskripsi  : {fmt(p['deskripsi'])}"
        )
        pdf.multi_cell(w_detail - 4, 3.8, detail, new_x="LMARGIN", new_y="NEXT")

        # --- garis bawah baris ---
        pdf.set_draw_color(*LINE)
        pdf.set_line_width(0.2)
        pdf.line(margin, y0 + row_h, margin + usable, y0 + row_h)
        pdf.set_y(y0 + row_h)


def closing(pdf):
    pdf.add_page()
    section(pdf, "4. Penutup")
    body(pdf,
         "Observasi lapangan ini telah mendokumentasikan koleksi tumbuhan digital "
         "DigiFlora di situs Stasiun Penelitian Soraya. Data yang terhimpun diharapkan "
         "menjadi dasar bagi pengelolaan konservasi dan pengembangan penelitian "
         "keanekaragaman hayati Kawasan Ekosistem Leuser. Rekomendasi tindak lanjut "
         "meliputi pelengkapan identifikasi taksonomi untuk tanaman yang belum terdata "
         "lengkap serta integrasi data ke publikasi ilmiah.")
    pdf.ln(10)
    pdf.set_font("DejaVu", "", 11)
    pdf.set_text_color(*DARK)
    pdf.cell(0, 7, "Disusun oleh,", new_x="LMARGIN", new_y="NEXT")
    pdf.ln(14)
    pdf.set_font("DejaVu", "B", 11)
    pdf.set_text_color(*BLACK)
    pdf.cell(0, 7, META["pengamat"], new_x="LMARGIN", new_y="NEXT")
    pdf.set_font("DejaVu", "", 10)
    pdf.set_text_color(*GREY)
    pdf.cell(0, 6, META["institusi"], new_x="LMARGIN", new_y="NEXT")
    pdf.cell(0, 6, f"Tanggal: {META['tanggal']}")


if __name__ == "__main__":
    plants = load_plants()
    pdf = Report(orientation="P", unit="mm", format="A4")
    pdf.set_auto_page_break(auto=True, margin=15)
    pdf.add_font("DejaVu", "", os.path.join(FONT_DIR, "DejaVuSans.ttf"))
    pdf.add_font("DejaVu", "B", os.path.join(FONT_DIR, "DejaVuSans-Bold.ttf"))
    pdf.add_font("DejaVu", "I", os.path.join(FONT_DIR, "DejaVuSans-Oblique.ttf"))
    pdf.set_title(META["judul"])
    pdf.set_author(META["pengamat"])

    cover(pdf)
    intro_method(pdf)
    results_table(pdf)
    closing(pdf)

    pdf.output(OUT_PDF)
    print(f"PDF berhasil dibuat: {OUT_PDF}")
    print(f"Jumlah tanaman: {len(plants)}")
