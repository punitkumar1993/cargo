@if ( \App\Helpers\SponsorVideo::checkActive() == 'y' )
    <aside>
        <h1 class="aside-title" style="font-size: 14px;font-weight: normal;text-transform: inherit;">
            {{ \App\Helpers\SponsorVideo::editionLabel() }}
        </h1>
        <div class="aside-body">
            <figure class="ads">
                @if ( \App\Helpers\SponsorVideo::checkSponsorVideoURL() != '' )
                    <div id="ytplayer"></div>

                    <script>
                        // Load the IFrame Player API code asynchronously.
                        var tag = document.createElement('script');
                        tag.src = "https://www.youtube.com/player_api";
                        var firstScriptTag = document.getElementsByTagName('script')[0];
                        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                        // Replace the 'ytplayer' element with an <iframe> and
                        // YouTube player after the API code downloads.
                        var player;
                        function onYouTubePlayerAPIReady() {
                            player = new YT.Player('ytplayer', {
                                height: '358',
                                width: '100%',
                                videoId: '{{ \App\Helpers\SponsorVideo::SponsorVideoUrl() }}',
                                playerVars: {
                                    'autoplay': 1,
                                    'showinfo': 1,
                                    'controls': 1,
                                    'accelerometer': 1,
                                    'encrypted-media': 1,
                                    'gyroscope': 1,
                                    'picture-in-picture': 1,
                                    'playsinline': 1
                                },
                                events: {
                                    'onReady': onPlayerReady,
                                    // 'onStateChange': onPlayerStateChange
                                }
                            });
                        }

                        function onPlayerReady(event) {
                            player.mute();
                            player.playVideo();
                        }
                    </script>
                @else
                    <iframe style="width: 100%" height="345" src="{{ asset('themes/magz/images/ad.png') }}"></iframe>
                @endif
            </figure>
        </div>
    </aside>
@endif

