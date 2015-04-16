<?php namespace App\Generators;

use Carbon\Carbon;

class TorrentFile
{
    /**
     * Update torrent file
     *
     * @param \PHP\BitTorrent\Torrent $torrent
     * @param array $data
     * @param $fileName
     * @return $this|\PHP\BitTorrent\Torrent
     */
    public function update(\PHP\BitTorrent\Torrent $torrent, array $data, $fileName)
    {
        $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', $data['created_at']);
        $info = $torrent->getInfo();
        $info['name'] = $data['name'];
        $info['files'] = $this->generateFiles($data['files']);
        $torrent->setComment($data['comment']);
        $torrent->setCreatedAt($createdAt->timestamp);
        $torrent->setCreatedBy($data['created_by']);
        $torrent->setInfo($info);
        $torrent->setAnnounceList($this->generateAnnounces($data['announces']));

        return $torrent->save($fileName);
    }

    /**
     * Generate correct announces for update
     *
     * @param array $announces
     * @return array
     */
    private function generateAnnounces(array $announces)
    {
        $correctAnnounces = [];
        foreach ($announces as $key => $announce) {
            $correctAnnounces[$key][] = $announce;
        }

        return $correctAnnounces;
    }

    /**
     * Generate correct files array
     *
     * @param array $files
     * @return array
     */
    private function generateFiles(array $files)
    {
        $correctFiles = [];

        foreach ($files['path'] as $key => $file) {
            $correctFiles[$key]['length'] = $files['length'][$key];
            $correctFiles[$key]['path'][] = $files['path'][$key];
        }

        return $correctFiles;
    }
}