<?php
namespace App; use Illuminate\Database\Eloquent\Model; class File extends Model { protected $guarded = array(); public $timestamps = false; function deleteFile() { try { Storage::disk($this->driver)->delete($this->path); } catch (\Exception $sp7900a2) { \Log::error('File.deleteFile Error: ' . $sp7900a2->getMessage(), array('exception' => $sp7900a2)); } } public static function getProductFolder() { return 'images/product'; } }