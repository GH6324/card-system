<?php
namespace App\Mail; use Illuminate\Bus\Queueable; use Illuminate\Mail\Mailable; use Illuminate\Queue\SerializesModels; use Illuminate\Contracts\Queue\ShouldQueue; class ProductCountWarn extends Mailable { use Queueable, SerializesModels; public $tries = 3; public $timeout = 20; public $product = null; public $product_count = null; public function __construct($spb395ca, $spf082ae) { $this->product = $spb395ca; $this->product_count = $spf082ae; } public function build() { return $this->subject('您的商品库存不足-' . config('app.name'))->view('emails.product_count_warn'); } }