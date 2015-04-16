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
        $torrent->setComment($data['comment']);
        $torrent->setCreatedAt($createdAt->timestamp);
        $torrent->setCreatedBy($data['created_by']);
        $torrent->setInfo($info);
        $torrent->setAnnounceList($this->generateAnnounces($data['announces']));

        return $torrent->save($fileName);
    }

    private function generateAnnounces(array $announces)
    {
        $newAnnounces = [];
        foreach ($announces as $key => $announce) {
            $newAnnounces[$key][] = $announce;
        }

        return $newAnnounces;
    }
}