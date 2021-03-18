<?php


namespace App\Libraries;


use Rhilip\Bencode\Bencode;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class TorrentFile
{
    private $file;

    public function __construct(UploadedFile $file = null)
    {
        dump($file->getRealPath());
        $this->file = Bencode::load($file->getRealPath());
        dump($this->file);
    }

    public function getDecodedTorrentFile(){

    }
}