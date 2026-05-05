@extends('layouts_admin.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
@endpush

@section('content')
    <div class="dashboard-page">
        <section class="metric-grid" aria-label="Ringkasan dashboard">
            <article class="metric-card">
                <div class="metric-card__icon metric-card__icon--blue">
                    <i class="bi bi-people-fill"></i>
                </div>
                <span class="metric-card__badge">UPDATE</span>
                <p>Total Mahasiswa</p>
                <h2>{{ number_format($totalMahasiswa) }}</h2>
                <small><i class="bi bi-arrow-up-short"></i> +12% dari bulan lalu</small>
            </article>

            <article class="metric-card metric-card--warm">
                <div class="metric-card__icon metric-card__icon--orange">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
                <span class="metric-card__badge">AKTIF</span>
                <p>Total Lowongan</p>
                <h2>{{ number_format($totalLowongan) }}</h2>
                <small><i class="bi bi-arrow-up-short"></i> +8% dari bulan lalu</small>
            </article>

            <article class="metric-card">
                <div class="metric-card__icon metric-card__icon--indigo">
                    <i class="bi bi-buildings-fill"></i>
                </div>
                <span class="metric-card__badge">MITRA</span>
                <p>Perusahaan Aktif</p>
                <h2>{{ number_format($totalPerusahaan) }}</h2>
                <small><i class="bi bi-arrow-up-short"></i> Stabil</small>
            </article>

            <article class="metric-card metric-card--primary">
                <div class="metric-card__icon">
                    <i class="bi bi-stars"></i>
                </div>
                <span class="metric-card__badge">AI ENGINE</span>
                <p>Rekomendasi Terproses</p>
                <h2>{{ number_format($totalRekomendasi) }}</h2>
                <small><i class="bi bi-arrow-up-short"></i> 18.2% accuracy</small>
            </article>
        </section>

        <section class="dashboard-grid">
            <article class="chart-panel">
                <div class="section-heading">
                    <div>
                        <h3>Grafik Pendaftar Magang</h3>
                        <p>Statistik pendaftaran 7 hari terakhir</p>
                    </div>
                    <div class="segmented">
                        <button type="button">Mingguan</button>
                        <button type="button" class="active">Bulanan</button>
                    </div>
                </div>

                <div class="chart-shell">
                    <div class="chart-line"></div>
                    <div class="chart-labels">
                        <span>Sen</span>
                        <span>Sel</span>
                        <span>Rab</span>
                        <span>Kam</span>
                        <span>Jum</span>
                        <span>Sab</span>
                        <span>Min</span>
                    </div>
                </div>
            </article>

            <article class="activity-panel">
                <h3>Aktivitas Terbaru</h3>
                <ul>
                    <li>
                        <span class="activity-dot activity-dot--blue"></span>
                        <strong>AI</strong>
                        <p>Artikel menyetujui lowongan baru dari PT Teknologi Maju.</p>
                        <small>2 menit yang lalu</small>
                    </li>
                    <li>
                        <span class="activity-dot activity-dot--orange"></span>
                        <strong>Update Profil Perusahaan</strong>
                        <p>CV Sukses Mandiri mengubah data kontak HR.</p>
                        <small>15 menit yang lalu</small>
                    </li>
                    <li>
                        <span class="activity-dot activity-dot--green"></span>
                        <strong>Rekomendasi Berhasil</strong>
                        <p>Sistem memproses 45 mahasiswa untuk lowongan UI/UX.</p>
                        <small>1 jam yang lalu</small>
                    </li>
                    <li>
                        <span class="activity-dot activity-dot--gray"></span>
                        <strong>Login Sistem</strong>
                        <p>Super Admin login melalui IP 192.168.1.1.</p>
                        <small>4 jam yang lalu</small>
                    </li>
                </ul>
                <button type="button">Lihat Semua Log</button>
            </article>
        </section>

        <section class="table-panel">
            <div class="table-panel__header">
                <h3>Status Pendaftaran Terakhir</h3>
                <div>
                    <select aria-label="Filter status">
                        <option>Semua Status</option>
                        <option>Terverifikasi</option>
                        <option>Proses</option>
                    </select>
                    <button type="button" aria-label="Filter">
                        <i class="bi bi-funnel"></i>
                    </button>
                </div>
            </div>

            <div class="dashboard-table-wrap">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Perusahaan</th>
                            <th>Posisi</th>
                            <th>Rekomendasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestLowongan as $index => $lowongan)
                            <tr>
                                <td>{{ $lowongan->perusahaan->nama_perusahaan ?? 'Perusahaan' }}</td>
                                <td>{{ $lowongan->posisi }}</td>
                                <td>
                                    <span class="match-bar">
                                        <i style="width: {{ [82, 78, 65][$index] ?? 70 }}%"></i>
                                    </span>
                                    {{ [82, 78, 65][$index] ?? 70 }}%
                                </td>
                                <td>
                                    <span class="status-pill {{ $index === 1 ? 'status-pill--process' : '' }}">
                                        {{ $index === 1 ? 'Proses' : 'Terverifikasi' }}
                                    </span>
                                </td>
                                <td>
                                    <button class="row-action" type="button" aria-label="Aksi">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Shopie Indonesia</td>
                                <td>Frontend Developer</td>
                                <td><span class="match-bar"><i style="width: 82%"></i></span>82%</td>
                                <td><span class="status-pill">Terverifikasi</span></td>
                                <td><button class="row-action" type="button"><i class="bi bi-three-dots-vertical"></i></button></td>
                            </tr>
                            <tr>
                                <td>Gojek</td>
                                <td>UX Researcher</td>
                                <td><span class="match-bar"><i style="width: 78%"></i></span>78%</td>
                                <td><span class="status-pill status-pill--process">Proses</span></td>
                                <td><button class="row-action" type="button"><i class="bi bi-three-dots-vertical"></i></button></td>
                            </tr>
                            <tr>
                                <td>PT Telkom Indonesia</td>
                                <td>System Analyst</td>
                                <td><span class="match-bar"><i style="width: 65%"></i></span>65%</td>
                                <td><span class="status-pill">Terverifikasi</span></td>
                                <td><button class="row-action" type="button"><i class="bi bi-three-dots-vertical"></i></button></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
