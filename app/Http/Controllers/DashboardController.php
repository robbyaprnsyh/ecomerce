<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\RefundProduk;
use App\Models\RiwayatProduk;
use App\Models\Transaksi;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $date = new DateTime();
        // $pendapatan_voucher = VoucherUser::join('vouchers', 'voucher_users.voucher_id', '=', 'vouchers.id')->whereYear('voucher_users.created_at', $date->format('Y'))->sum("vouchers.harga");
        $pendapatan_transaksi = Transaksi::whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_jan = Transaksi::whereMonth('created_at', '01')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_feb = Transaksi::whereMonth('created_at', '02')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_mar = Transaksi::whereMonth('created_at', '03')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_apr = Transaksi::whereMonth('created_at', '04')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_mei = Transaksi::whereMonth('created_at', '05')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_jun = Transaksi::whereMonth('created_at', '06')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_jul = Transaksi::whereMonth('created_at', '07')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_agu = Transaksi::whereMonth('created_at', '08')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_sep = Transaksi::whereMonth('created_at', '09')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_okt = Transaksi::whereMonth('created_at', '10')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_nov = Transaksi::whereMonth('created_at', '11')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        $pendapatan_transaksi_des = Transaksi::whereMonth('created_at', '12')->whereYear('created_at', $date->format('Y'))->sum('total_harga');
        // $total_pendapatan = ($pendapatan_voucher + $pendapatan_transaksi);

        // pembelianVoucher
        $pembelian_produk_jan = DetailTransaksi::whereMonth('created_at', '01')->whereYear('created_at', $date->format('Y'))->count();
        $pembelian_produk_feb = DetailTransaksi::whereMonth('created_at', '02')->whereYear('created_at', $date->format('Y'))->count();
        $pembelian_produk_mar = DetailTransaksi::whereMonth('created_at', '03')->whereYear('created_at', $date->format('Y'))->count();
        $pembelian_produk_apr = DetailTransaksi::whereMonth('created_at', '04')->whereYear('created_at', $date->format('Y'))->count();
        $pembelian_produk_mei = DetailTransaksi::whereMonth('created_at', '05')->whereYear('created_at', $date->format('Y'))->count();
        $pembelian_produk_jun = DetailTransaksi::whereMonth('created_at', '06')->whereYear('created_at', $date->format('Y'))->count();
        $pembelian_produk_jul = DetailTransaksi::whereMonth('created_at', '07')->whereYear('created_at', $date->format('Y'))->count();
        $pembelian_produk_agu = DetailTransaksi::whereMonth('created_at', '08')->whereYear('created_at', $date->format('Y'))->count();
        $pembelian_produk_sep = DetailTransaksi::whereMonth('created_at', '09')->whereYear('created_at', $date->format('Y'))->count();
        $pembelian_produk_okt = DetailTransaksi::whereMonth('created_at', '10')->whereYear('created_at', $date->format('Y'))->count();
        $pembelian_produk_nov = DetailTransaksi::whereMonth('created_at', '11')->whereYear('created_at', $date->format('Y'))->count();
        $pembelian_produk_des = DetailTransaksi::whereMonth('created_at', '12')->whereYear('created_at', $date->format('Y'))->count();
        //endPembelianVoucher

        // pembelianVoucher
        // $pembelian_voucher_jan = VoucherUser::whereMonth('created_at', '01')->whereYear('created_at', $date->format('Y'))->count();
        // $pembelian_voucher_feb = VoucherUser::whereMonth('created_at', '02')->whereYear('created_at', $date->format('Y'))->count();
        // $pembelian_voucher_mar = VoucherUser::whereMonth('created_at', '03')->whereYear('created_at', $date->format('Y'))->count();
        // $pembelian_voucher_apr = VoucherUser::whereMonth('created_at', '04')->whereYear('created_at', $date->format('Y'))->count();
        // $pembelian_voucher_mei = VoucherUser::whereMonth('created_at', '05')->whereYear('created_at', $date->format('Y'))->count();
        // $pembelian_voucher_jun = VoucherUser::whereMonth('created_at', '06')->whereYear('created_at', $date->format('Y'))->count();
        // $pembelian_voucher_jul = VoucherUser::whereMonth('created_at', '07')->whereYear('created_at', $date->format('Y'))->count();
        // $pembelian_voucher_agu = VoucherUser::whereMonth('created_at', '08')->whereYear('created_at', $date->format('Y'))->count();
        // $pembelian_voucher_sep = VoucherUser::whereMonth('created_at', '09')->whereYear('created_at', $date->format('Y'))->count();
        // $pembelian_voucher_okt = VoucherUser::whereMonth('created_at', '10')->whereYear('created_at', $date->format('Y'))->count();
        // $pembelian_voucher_nov = VoucherUser::whereMonth('created_at', '11')->whereYear('created_at', $date->format('Y'))->count();
        // $pembelian_voucher_des = VoucherUser::whereMonth('created_at', '12')->whereYear('created_at', $date->format('Y'))->count();
        //endPembelianVoucher

        // BarangMasukBulan
        $barang_masuk_bulan_jan = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '01')->whereYear('created_at', $date->format('Y'))->count();
        $barang_masuk_bulan_feb = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '02')->whereYear('created_at', $date->format('Y'))->count();
        $barang_masuk_bulan_mar = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '03')->whereYear('created_at', $date->format('Y'))->count();
        $barang_masuk_bulan_apr = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '04')->whereYear('created_at', $date->format('Y'))->count();
        $barang_masuk_bulan_mei = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '05')->whereYear('created_at', $date->format('Y'))->count();
        $barang_masuk_bulan_jun = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '06')->whereYear('created_at', $date->format('Y'))->count();
        $barang_masuk_bulan_jul = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '07')->whereYear('created_at', $date->format('Y'))->count();
        $barang_masuk_bulan_agu = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '08')->whereYear('created_at', $date->format('Y'))->count();
        $barang_masuk_bulan_sep = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '09')->whereYear('created_at', $date->format('Y'))->count();
        $barang_masuk_bulan_okt = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '10')->whereYear('created_at', $date->format('Y'))->count();
        $barang_masuk_bulan_nov = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '11')->whereYear('created_at', $date->format('Y'))->count();
        $barang_masuk_bulan_des = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '12')->whereYear('created_at', $date->format('Y'))->count();
        // endBarangMasukBulan

        // BarangKeluarBulan
        $barang_keluar_bulan_jan = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '01')->whereYear('created_at', $date->format('Y'))->count();
        $barang_keluar_bulan_feb = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '02')->whereYear('created_at', $date->format('Y'))->count();
        $barang_keluar_bulan_mar = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '03')->whereYear('created_at', $date->format('Y'))->count();
        $barang_keluar_bulan_apr = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '04')->whereYear('created_at', $date->format('Y'))->count();
        $barang_keluar_bulan_mei = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '05')->whereYear('created_at', $date->format('Y'))->count();
        $barang_keluar_bulan_jun = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '06')->whereYear('created_at', $date->format('Y'))->count();
        $barang_keluar_bulan_jul = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '07')->whereYear('created_at', $date->format('Y'))->count();
        $barang_keluar_bulan_agu = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '08')->whereYear('created_at', $date->format('Y'))->count();
        $barang_keluar_bulan_sep = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '09')->whereYear('created_at', $date->format('Y'))->count();
        $barang_keluar_bulan_okt = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '10')->whereYear('created_at', $date->format('Y'))->count();
        $barang_keluar_bulan_nov = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '11')->whereYear('created_at', $date->format('Y'))->count();
        $barang_keluar_bulan_des = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '12')->whereYear('created_at', $date->format('Y'))->count();
        // endBarangKeluarBulan

        // BarangMasuk
        $barang_masuk = RiwayatProduk::where('type', 'masuk')->whereYear('created_at', $date->format('Y'))->count();
        // endBarangMasuk

        // BarangKeluar
        $barang_keluar = RiwayatProduk::where('type', 'keluar')->whereYear('created_at', $date->format('Y'))->count();
        // endBarangKeluar

        $users = User::where('role', 'costumer')->whereYear('created_at', $date->format('Y'))->count();
        $produks = DetailTransaksi::join('keranjangs', 'detail_transaksis.keranjang_id', '=', 'keranjangs.id')->whereYear('detail_transaksis.created_at', $date->format('Y'))->
            sum("keranjangs.jumlah");
        $refunds = RefundProduk::whereYear('created_at', $date->format('Y'))->count();

        if ($request->tahun) {
            // $pendapatan_voucher = VoucherUser::join('vouchers', 'voucher_users.voucher_id', '=', 'vouchers.id')->whereYear('voucher_users.created_at', $request->tahun)->sum("vouchers.harga");
            $pendapatan_transaksi = Transaksi::whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_jan = Transaksi::whereMonth('created_at', '01')->whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_feb = Transaksi::whereMonth('created_at', '02')->whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_mar = Transaksi::whereMonth('created_at', '03')->whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_apr = Transaksi::whereMonth('created_at', '04')->whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_mei = Transaksi::whereMonth('created_at', '05')->whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_jun = Transaksi::whereMonth('created_at', '06')->whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_jul = Transaksi::whereMonth('created_at', '07')->whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_agu = Transaksi::whereMonth('created_at', '08')->whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_sep = Transaksi::whereMonth('created_at', '09')->whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_okt = Transaksi::whereMonth('created_at', '10')->whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_nov = Transaksi::whereMonth('created_at', '11')->whereYear('created_at', $request->tahun)->sum('total_harga');
            $pendapatan_transaksi_des = Transaksi::whereMonth('created_at', '12')->whereYear('created_at', $request->tahun)->sum('total_harga');

            // $total_pendapatan = ($pendapatan_voucher + $pendapatan_transaksi);

            // pembelianVoucher
            $pembelian_produk_jan = DetailTransaksi::whereMonth('created_at', '01')->whereYear('created_at', $request->tahun)->count();
            $pembelian_produk_feb = DetailTransaksi::whereMonth('created_at', '02')->whereYear('created_at', $request->tahun)->count();
            $pembelian_produk_mar = DetailTransaksi::whereMonth('created_at', '03')->whereYear('created_at', $request->tahun)->count();
            $pembelian_produk_apr = DetailTransaksi::whereMonth('created_at', '04')->whereYear('created_at', $request->tahun)->count();
            $pembelian_produk_mei = DetailTransaksi::whereMonth('created_at', '05')->whereYear('created_at', $request->tahun)->count();
            $pembelian_produk_jun = DetailTransaksi::whereMonth('created_at', '06')->whereYear('created_at', $request->tahun)->count();
            $pembelian_produk_jul = DetailTransaksi::whereMonth('created_at', '07')->whereYear('created_at', $request->tahun)->count();
            $pembelian_produk_agu = DetailTransaksi::whereMonth('created_at', '08')->whereYear('created_at', $request->tahun)->count();
            $pembelian_produk_sep = DetailTransaksi::whereMonth('created_at', '09')->whereYear('created_at', $request->tahun)->count();
            $pembelian_produk_okt = DetailTransaksi::whereMonth('created_at', '10')->whereYear('created_at', $request->tahun)->count();
            $pembelian_produk_nov = DetailTransaksi::whereMonth('created_at', '11')->whereYear('created_at', $request->tahun)->count();
            $pembelian_produk_des = DetailTransaksi::whereMonth('created_at', '12')->whereYear('created_at', $request->tahun)->count();
            //endPembelianVoucher

            // // pembelianVoucher
            // $pembelian_voucher_jan = VoucherUser::whereMonth('created_at', '01')->whereYear('created_at', $request->tahun)->count();
            // $pembelian_voucher_feb = VoucherUser::whereMonth('created_at', '02')->whereYear('created_at', $request->tahun)->count();
            // $pembelian_voucher_mar = VoucherUser::whereMonth('created_at', '03')->whereYear('created_at', $request->tahun)->count();
            // $pembelian_voucher_apr = VoucherUser::whereMonth('created_at', '04')->whereYear('created_at', $request->tahun)->count();
            // $pembelian_voucher_mei = VoucherUser::whereMonth('created_at', '05')->whereYear('created_at', $request->tahun)->count();
            // $pembelian_voucher_jun = VoucherUser::whereMonth('created_at', '06')->whereYear('created_at', $request->tahun)->count();
            // $pembelian_voucher_jul = VoucherUser::whereMonth('created_at', '07')->whereYear('created_at', $request->tahun)->count();
            // $pembelian_voucher_agu = VoucherUser::whereMonth('created_at', '08')->whereYear('created_at', $request->tahun)->count();
            // $pembelian_voucher_sep = VoucherUser::whereMonth('created_at', '09')->whereYear('created_at', $request->tahun)->count();
            // $pembelian_voucher_okt = VoucherUser::whereMonth('created_at', '10')->whereYear('created_at', $request->tahun)->count();
            // $pembelian_voucher_nov = VoucherUser::whereMonth('created_at', '11')->whereYear('created_at', $request->tahun)->count();
            // $pembelian_voucher_des = VoucherUser::whereMonth('created_at', '12')->whereYear('created_at', $request->tahun)->count();
            // //endPembelianVoucher

            // BarangMasukBulan
            $barang_masuk_bulan_jan = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '01')->whereYear('created_at', $request->tahun)->count();
            $barang_masuk_bulan_feb = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '02')->whereYear('created_at', $request->tahun)->count();
            $barang_masuk_bulan_mar = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '03')->whereYear('created_at', $request->tahun)->count();
            $barang_masuk_bulan_apr = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '04')->whereYear('created_at', $request->tahun)->count();
            $barang_masuk_bulan_mei = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '05')->whereYear('created_at', $request->tahun)->count();
            $barang_masuk_bulan_jun = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '06')->whereYear('created_at', $request->tahun)->count();
            $barang_masuk_bulan_jul = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '07')->whereYear('created_at', $request->tahun)->count();
            $barang_masuk_bulan_agu = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '08')->whereYear('created_at', $request->tahun)->count();
            $barang_masuk_bulan_sep = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '09')->whereYear('created_at', $request->tahun)->count();
            $barang_masuk_bulan_okt = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '10')->whereYear('created_at', $request->tahun)->count();
            $barang_masuk_bulan_nov = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '11')->whereYear('created_at', $request->tahun)->count();
            $barang_masuk_bulan_des = RiwayatProduk::where('type', 'masuk')->whereMonth('created_at', '12')->whereYear('created_at', $request->tahun)->count();
            // endBarangMasukBulan

            // BarangKeluarBulan
            $barang_keluar_bulan_jan = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '01')->whereYear('created_at', $request->tahun)->count();
            $barang_keluar_bulan_feb = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '02')->whereYear('created_at', $request->tahun)->count();
            $barang_keluar_bulan_mar = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '03')->whereYear('created_at', $request->tahun)->count();
            $barang_keluar_bulan_apr = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '04')->whereYear('created_at', $request->tahun)->count();
            $barang_keluar_bulan_mei = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '05')->whereYear('created_at', $request->tahun)->count();
            $barang_keluar_bulan_jun = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '06')->whereYear('created_at', $request->tahun)->count();
            $barang_keluar_bulan_jul = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '07')->whereYear('created_at', $request->tahun)->count();
            $barang_keluar_bulan_agu = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '08')->whereYear('created_at', $request->tahun)->count();
            $barang_keluar_bulan_sep = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '09')->whereYear('created_at', $request->tahun)->count();
            $barang_keluar_bulan_okt = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '10')->whereYear('created_at', $request->tahun)->count();
            $barang_keluar_bulan_nov = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '11')->whereYear('created_at', $request->tahun)->count();
            $barang_keluar_bulan_des = RiwayatProduk::where('type', 'keluar')->whereMonth('created_at', '12')->whereYear('created_at', $request->tahun)->count();
            // endBarangKeluarBulan

            // BarangMasuk
            $barang_masuk = RiwayatProduk::where('type', 'masuk')->whereYear('created_at', $request->tahun)->count();
            // endBarangMasuk

            // BarangKeluar
            $barang_keluar = RiwayatProduk::where('type', 'keluar')->whereYear('created_at', $request->tahun)->count();
            // endBarangKeluar

            $users = User::where('role', 'costumer')->whereYear('created_at', $request->tahun)->count();
            $produks = DetailTransaksi::join('keranjangs', 'detail_transaksis.keranjang_id', '=', 'keranjangs.id')->whereYear('detail_transaksis.created_at', $request->tahun)->
                sum("keranjangs.jumlah");
            $refunds = RefundProduk::whereYear('created_at', $request->tahun)->count();

        }

        return view('admin.index', compact(
            // 'pendapatan_voucher',
            'pendapatan_transaksi',
            'pendapatan_transaksi_jan',
            'pendapatan_transaksi_feb',
            'pendapatan_transaksi_mar',
            'pendapatan_transaksi_apr',
            'pendapatan_transaksi_mei',
            'pendapatan_transaksi_jun',
            'pendapatan_transaksi_jul',
            'pendapatan_transaksi_agu',
            'pendapatan_transaksi_sep',
            'pendapatan_transaksi_okt',
            'pendapatan_transaksi_nov',
            'pendapatan_transaksi_des',
            // 'total_pendapatan',
            // 'pembelian_voucher_jan',
            // 'pembelian_voucher_feb',
            // 'pembelian_voucher_mar',
            // 'pembelian_voucher_apr',
            // 'pembelian_voucher_mei',
            // 'pembelian_voucher_jun',
            // 'pembelian_voucher_jul',
            // 'pembelian_voucher_agu',
            // 'pembelian_voucher_sep',
            // 'pembelian_voucher_okt',
            // 'pembelian_voucher_nov',
            // 'pembelian_voucher_des',
            'pembelian_produk_jan',
            'pembelian_produk_feb',
            'pembelian_produk_mar',
            'pembelian_produk_apr',
            'pembelian_produk_mei',
            'pembelian_produk_jun',
            'pembelian_produk_jul',
            'pembelian_produk_agu',
            'pembelian_produk_sep',
            'pembelian_produk_okt',
            'pembelian_produk_nov',
            'pembelian_produk_des',
            'barang_masuk_bulan_jan',
            'barang_masuk_bulan_feb',
            'barang_masuk_bulan_mar',
            'barang_masuk_bulan_apr',
            'barang_masuk_bulan_mei',
            'barang_masuk_bulan_jun',
            'barang_masuk_bulan_jul',
            'barang_masuk_bulan_agu',
            'barang_masuk_bulan_sep',
            'barang_masuk_bulan_okt',
            'barang_masuk_bulan_nov',
            'barang_masuk_bulan_des',
            'barang_keluar_bulan_jan',
            'barang_keluar_bulan_feb',
            'barang_keluar_bulan_mar',
            'barang_keluar_bulan_apr',
            'barang_keluar_bulan_mei',
            'barang_keluar_bulan_jun',
            'barang_keluar_bulan_jul',
            'barang_keluar_bulan_agu',
            'barang_keluar_bulan_sep',
            'barang_keluar_bulan_okt',
            'barang_keluar_bulan_nov',
            'barang_keluar_bulan_des',
            'barang_masuk',
            'barang_keluar',
            'users',
            'produks',
            'refunds'
        ));
    }

}
