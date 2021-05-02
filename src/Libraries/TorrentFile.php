<?php


namespace App\Libraries;

use Rhilip\Bencode\Bencode;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class TorrentFile
{
    private $file;

    public function __construct(UploadedFile $file = null)
    {
        if($file) {
            $this->file = Bencode::load($file->getRealPath());
            unset($this->file['announce-list']);
            //$this->file['announce'] = "";
            $this->file['info']['private'] = 1;
            $this->file['comment'] = "Torrent created for ADC";
            $this->file['created by'] = "ADC Team";
        }
    }

    public function getTorrentSize(): int
    {
        $size = 0;
        if(isset($this->file['info']['files'])) {
            foreach ($this->file['info']['files'] as $value) {
                $size += $value['length'];
            }
            return $size;
        }
        else
            return $this->file['info']['length'];
    }
    public function getTorrentFiles(): array
    {
        $files['total'] = isset($this->file['info']['files']) ? count($this->file['info']['files']) : 1;
        $files['info_hash'] = sha1(Bencode::encode($this->file['info']));
        return $files;
    }

    public function makeTorrentFile($path){
        Bencode::dump($path . "/data/torrents/" . $this->getTorrentFiles()['info_hash'] . ".torrent", $this->file);
    }

    public function getTorrentFile(){
        return $this->file;
    }
}