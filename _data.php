<?php

function get_token(bool $new = false)
{
    if ($new) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.maharprod.com/profile/v1/RefreshToken',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"refreshToken": "AMf-vBwNKNmDEzv4BXB8X2s50f-TLJJG3qpf_UuhaobP8jmtm2wbj5hSf1OgE1vuPia3nV8_D2ksrJ-FyETShA6sciBh2UiOhZxFpPmFZs6SL5jsPsG5ptmVxIKopcFiuUxYXxbVN68N5JuDEqMd68HZH8UY_rtWIvofEq0y4v5eP7GEzVXil0Y"}',
            CURLOPT_COOKIE => 'AWSALB=2nWdtc/2d2lSqFAc0HRhRSu9Jj0vkeLeko5jtAwcTPCl4czu8zqDXTQPNYUeAAy5Gk435evwnnusIalLB1pZnrb1+iy17dXUQkBFD4/zeqDYyTweVuf8faNwX8XQ; AWSALBCORS=2nWdtc/2d2lSqFAc0HRhRSu9Jj0vkeLeko5jtAwcTPCl4czu8zqDXTQPNYUeAAy5Gk435evwnnusIalLB1pZnrb1+iy17dXUQkBFD4/zeqDYyTweVuf8faNwX8XQ',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IjJiN2JhZmIyZjEwY2FlMmIxZjA3ZjM4MTZjNTQyMmJlY2NhNWMyMjMiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vbWFoYXItY2MyOTMiLCJhdWQiOiJtYWhhci1jYzI5MyIsImF1dGhfdGltZSI6MTc1MzE2Mzc2NSwidXNlcl9pZCI6IjZKc0dDTTFHZWtjWFBDazFvOTdsQTgyU3hidDEiLCJzdWIiOiI2SnNHQ00xR2VrY1hQQ2sxbzk3bEE4MlN4YnQxIiwiaWF0IjoxNzU1MTgwNzM0LCJleHAiOjE3NTUxODQzMzQsImZpcmViYXNlIjp7ImlkZW50aXRpZXMiOnt9LCJzaWduX2luX3Byb3ZpZGVyIjoiY3VzdG9tIn19.I7it6Bw9cKESC8VJmqwHwWvbEO9mWPZLo6fXbkAJ3N-2v7re47fgIisdtVlBlnnb05S3PKcksB7Zm2WGttQz05kC9CQK8aEUjuWeedEMqy-D8vsk3vKD52-lvPFLseAqP-rEaulVhqqL9D6OnXy0JejdsAnn2hkCFpZKGq1Z1s4JFn_oNrJRaCQDTME6ev-CfTOG5yeiNRpgROh_jgnGfLxYzbk2XUpCAWodW4ScKbHCwQntBP681n71NUS8TKH0eL3QEYc7l6kBjw7nUC9A_7vBmMoug4rnNBEASiawkv3sGUqRy3Vqe83OdySfzaQm6fO29YpL318JP6dE-jKP-A',
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return 'cURL Error #:' . $err;
        } else {
            $resp = json_decode((string)$response);
            return $resp->access_token;
        }
    }
    //$r = get_tk()[0];
    //if ($r['exp'] > time()) return $r['_key'];
    return get_token(true);
}

function mov_home(string|null $pn = '1')
{
    if ($pn == null) $pn = '1';
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.maharprod.com/display/v1/moviebuilder?pageNumber=' . $pn,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . get_token(),
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return 'cURL Error #:' . $err;
    } else {
        return $response;
    }
}

function series_home(string|null $pn = '1')
{
    if ($pn == null) $pn = '1';
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.maharprod.com/display/v1/seriesbuilder?pageNumber=' . $pn,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . get_token(),
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return 'cURL Error #:' . $err;
    } else {
        return $response;
    }
}

function get_movie(string $id)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.maharprod.com/content/v1/MovieDetail/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_COOKIE => 'AWSALB=OXGdTl7bKcXX0SAFosA5AdTibhPoGQ4Lrj2ubvw9xB3AoU575xw1aa8GZmqYEYXHbjJnlB0FM6JxoMt0hESxe2qcyHjPDu8oPWP0juEkd2oB8QB4l3b4cZqe7dCc; AWSALBCORS=OXGdTl7bKcXX0SAFosA5AdTibhPoGQ4Lrj2ubvw9xB3AoU575xw1aa8GZmqYEYXHbjJnlB0FM6JxoMt0hESxe2qcyHjPDu8oPWP0juEkd2oB8QB4l3b4cZqe7dCc',
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.get_token(),
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return json_encode(['cURL Error #:' => $err]);
    } else {
        return $response;
    }
}

function watch_movie(string $contentId)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.maharprod.com/revenue/url?type=movie&contentId=$contentId&isPremiumUser=true&isPremiumContent=true&source=mobile",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_COOKIE => 'AWSALB=tE80TpkulM2m10R6eXUOyfSZpRUV9XB8EnNLw5qv7KmjaxFO4MU1vwBvQVGUe5neP+hHaO7uMtoldQl7ZNfmStLhzwdMC6t84B2dM0fEi9LjhEsc0zE++Fgy/Z/M; AWSALBCORS=tE80TpkulM2m10R6eXUOyfSZpRUV9XB8EnNLw5qv7KmjaxFO4MU1vwBvQVGUe5neP+hHaO7uMtoldQl7ZNfmStLhzwdMC6t84B2dM0fEi9LjhEsc0zE++Fgy/Z/M',
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.get_token(),
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return json_encode(['cURL Error #:'=> $err]);
    } else {
        return $response;
    }
}