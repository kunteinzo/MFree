## Refresh Token

```
AMf-vBwNKNmDEzv4BXB8X2s50f-TLJJG3qpf_UuhaobP8jmtm2wbj5hSf1OgE1vuPia3nV8_D2ksrJ-FyETShA6sciBh2UiOhZxFpPmFZs6SL5jsPsG5ptmVxIKopcFiuUxYXxbVN68N5JuDEqMd68HZH8UY_rtWIvofEq0y4v5eP7GEzVXil0Y
```

## Urls

&emsp;&emsp;Domain: `https://api.maharprod.com`

- ### Refresh Token
    `/profile/v1/RefreshToken`  
    Method: `POST`  
    Content-Type: `application/json`  
    Body: `{"refreshToken":"refresh_token"}`

- ### Live TV
    `"/content/v1/titles?select=id,titleEn,titleMm,descriptionEn,descriptionMm,type,isPremium,resolution,rating,sorting,status&filter=type%20eq%20'channel'&expand=media(select=imageType,image),channel(select=streamingUrl)"`

- ### Playlist
    `/display/v1/playlistDetail?id={playlist_id}&pageNumber={page_num}`

- ### Movie Urls
    `/display/v1/moviebuilder?pageNumber={page_num}`  
    `/content/v1/Genres?&filter=type+eq+%27movie%27and+status+eq+true&select=nameMm%2CnameEn%2Cid%2Ctype`  
    `content/v1/MovieFilter?categoryId={category_id}&pageNumber={page_num}`  
    `content/v1/MovieDetail/{movie_id}`  
    `revenue/url?type=movie&contentId={content_id}&isPremiumUser=true&isPremiumContent=true&source=mobile`  
    `content/v1/download?type=movie&contentId={content_id}&isPremiumUser=true&isPremiumContent=true&fileSize={quality}`  
    `display/v1/seriesbuilder?pageNumber={page_num}`  
    `content/v1/Genres?&filter=type+eq+%27series%27and+status+eq+true&select=nameMm%2CnameEn%2Cid%2Ctype`  
    `content/v1/SeriesFilter?categoryId={category_id}&pageNumber={page_num}`  
    `content/v1/SeriesDetail/{series_id}`  
    `content/v1/Seasons?&filter=seriesId+eq+{series_id}&select=nameMm%2CnameEn%2Cid`  
    `content/v1/Episodes?&filter=status+eq+true+and+seasonId+eq+{season_id}&orderby=sorting+{sorting}&top={top}&skip={skip}`  
    `revenue/url?type=episodes&contentId={content_id}&isPremiumUser=true&isPremiumContent=true&source=mobile`  
    `content/v1/download?type=episodes&contentId={content_id}&isPremiumUser=true&isPremiumContent=true&fileSize={quality}`
