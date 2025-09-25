<?php

error_reporting(0);

header("Content-Type: application/json");

function req(string $url, string $method = 'GET', array $headers = [], string $body = '')
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.maharprod.com' . $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => $body,
        CURLOPT_HTTPHEADER => $headers,
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return json_encode(['Error' => $err]);
    }
    return $response;
}

function token(): string|null
{
    try {
        $rp = req('/profile/v1/RefreshToken', 'POST', [
            'Content-Type: application/json'
        ], '{"refreshToken": "AMf-vBwNKNmDEzv4BXB8X2s50f-TLJJG3qpf_UuhaobP8jmtm2wbj5hSf1OgE1vuPia3nV8_D2ksrJ-FyETShA6sciBh2UiOhZxFpPmFZs6SL5jsPsG5ptmVxIKopcFiuUxYXxbVN68N5JuDEqMd68HZH8UY_rtWIvofEq0y4v5eP7GEzVXil0Y"}');
        $rp = json_decode($rp, true);
        if (array_key_exists('access_token', $rp)) {
            return $rp['access_token'];
        }
        return null;
    } catch (Exception $e) {
        return null;
    }
}

function details(): array
{
    $file = fopen('details.json', 'r');
    $con = json_decode(fread($file, filesize('details.json')), true);
    fclose($file);
    return $con;
}

class Item
{
    public string $id;
    public string $contentId;
    public string $type;
    public string $titleEn;
    public string $titleMm;
    public string $posterPortrait;
    public string $posterLandscape;
    public string $duration;
    public array $fileSize;
    public array $tags;
    public array $casts;
    public string $description;

    public function __construct(
        string $id,
        string $contentId,
        string $type,
        string $titleEn,
        string $titleMm,
        string $posterPortrait,
        string $posterLandscape,
        array $tags,
        array $casts,
        string $duration,
        string $description
    ) {
        $this->id = $id;
        $this->contentId = $contentId;
        $this->type = $type;
        $this->titleEn = $titleEn;
        $this->titleMm = $titleMm;
        $this->posterPortrait = $posterPortrait;
        $this->posterLandscape = $posterLandscape;
        $this->description = $description;
        $this->tags = $tags;
        $this->casts = $casts;
        $this->duration = $duration;
    }

    public static function all()
    {
        $all = [];
        foreach (details() as $item) {
            $it = new Item(
                id: $item['id'],
                contentId: '',
                type: $item['type'],
                titleEn: $item['titleEn'],
                titleMm: $item['titleMm'],
                posterPortrait: $item['posterPortrait'] ?: '',
                posterLandscape: $item['posterLandscape'] ?: '',
                tags: [],
                casts: [],
                duration: $item['duration'],
                description: $item['overview']['descriptionMm']
            );
            if ($it->type == 'series') {
                $it->contentId = $item['seriesId'];
            } else {
                $it->contentId = $item['contentId'];
            }
            $it->fileSize = [
                'sd' => $item['sdFileSize'],
                'hd' => $item['hdFileSize'],
                'fullHd' => $item['fullHdFileSize']
            ];
            foreach ($item['categories'] as $cat) {
                $it->tags[] = $cat['nameMm'];
            }
            foreach ($item['artists'] as $as) {
                $it->casts[] = $as['nameMm'];
            }
            $all[] = $it;
        }
        return $all;
    }
}

/*
if (isset($_SERVER['PATH_INFO']) and $_SERVER['PATH_INFO'] = '/all') {
    echo json_encode(Item::all(), JSON_UNESCAPED_UNICODE);
}
*/

function home()
{
    $res = [];
    $re = [];
    $token = token();
    foreach (['movie', 'series'] as $con) {
        $n = 1;
        while (true) {
            $re = json_decode(req("/display/v1/{$con}builder?pageNumber=$n", headers: ['Authorization: Bearer ' . $token]), true)["value"];
            if (count($re) == 0)
                break;
            foreach ($re as $r) {
                $res[] = $r;
            }
            $n++;
        }
    }
    return $res;
}

function unavailable() {
    echo json_encode(['details' => 'Unavailable']);
}

if (isset($_GET['m'])) {
    switch ($_GET['m']) {
        case 'home': {
            echo json_encode(home(), JSON_UNESCAPED_UNICODE);
            break;
        }

        case 'list': {
            if (!isset($_GET['id']) and !isset($_GET['pn'])) {
                unavailable();
                break;
            }
            $token = token();
            $id = $_GET['id'];
            $pn = (int) $_GET['pn'];
            $res = json_decode(req("/display/v1/playlistDetail?id={$id}&pageNumber={$pn}", headers: ["Authorization: Bearer {$token}"]), true)['value'];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            break;
        }

        case 'content': {
            if (!isset($_GET['type']) and !isset($_GET['id'])) {
                unavailable();
                break;
            }
            $token = token();
            $id = $_GET['id'];
            if ($_GET['type'] == 'movie') {
                $res = json_decode(req("/revenue/url?type=movie&contentId={$id}&isPremiumUser=true&isPremiumContent=true&source=mobile", headers: ["Authorization: Bearer {$token}"]), true)['value'];
                echo json_encode($res, JSON_UNESCAPED_UNICODE);
            }
            break;
        }
    }
} else {
    unavailable();
}